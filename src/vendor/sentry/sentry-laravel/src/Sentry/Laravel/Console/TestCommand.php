<?php

namespace Sentry\Laravel\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Psr\Log\AbstractLogger;
use Sentry\ClientBuilder;
use Sentry\State\Hub;
use Sentry\State\HubInterface;
use Sentry\Tracing\SpanContext;
use Sentry\Tracing\TransactionContext;

class TestCommand extends Command
{
    /**
     * Laravel 5.0.x: The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'sentry:test';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sentry:test {--transaction} {--dsn=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a test event and send it to Sentry';

    /**
     * Buffer of log messages generated by the Sentry SDK.
     *
     * @var array
     */
    private $logMessages = [];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        // Maximize error reporting
        $old_error_reporting = error_reporting(E_ALL | E_STRICT);

        $dsn = $this->option('dsn');

        // If the DSN was not passed as option to the command we use the registered client to get the DSN from the Laravel config
        if ($dsn === null) {
            $dsnObject = app(HubInterface::class)->getClient()->getOptions()->getDsn();

            if ($dsnObject !== null) {
                $dsn = (string)$dsnObject;

                $this->info('DSN discovered from Laravel config or `.env` file!');
            }
        }

        // No DSN found from the command line or config
        if (!$dsn) {
            $this->error('Could not discover DSN!');

            $this->printDebugTips();

            return 1;
        }

        try {
            $clientBuilder = ClientBuilder::create([
                'dsn' => $dsn,
                'traces_sample_rate' => 1.0,
            ]);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return 1;
        }

        // We set a logger so we can surface errors thrown internally by the SDK
        $clientBuilder->setLogger(new class($this) extends AbstractLogger {
            private $command;

            public function __construct(TestCommand $command)
            {
                $this->command = $command;
            }

            public function log($level, $message, array $context = []): void
            {
                if ($level === 'error') {
                    $this->command->logMessageFromSDK($message);
                }
            }
        });

        $hub = new Hub($clientBuilder->getClient());

        $this->info('Sending test event...');

        $exception = $this->generateTestException($this->name, ['foo' => 'bar']);

        $eventId = $hub->captureException($exception);

        if (!$eventId) {
            $this->error('There was an error sending the event.');

            $this->printDebugTips();

            return 1;
        }

        $this->info("Test event sent with ID: {$eventId}");

        if ($this->option('transaction')) {
            $this->clearLogMessagesFromSDK();

            $transactionContext = new TransactionContext();
            $transactionContext->setSampled(true);
            $transactionContext->setName('Sentry Test Transaction');
            $transactionContext->setOp('sentry.test');

            $transaction = $hub->startTransaction($transactionContext);

            $spanContext = new SpanContext();
            $spanContext->setOp('sentry.sent');

            $span = $transaction->startChild($spanContext);

            $this->info('Sending transaction...');

            $span->finish();
            $transactionId = $transaction->finish();

            if (!$transactionId) {
                $this->error('There was an error sending the transaction.');

                $this->printDebugTips();

                return 1;
            }

            $this->info("Transaction sent with ID: {$transactionId}");
        }

        error_reporting($old_error_reporting);

        return 0;
    }

    /**
     * Generate a test exception to send to Sentry.
     *
     * @param $command
     * @param $arg
     *
     * @return \Exception
     */
    protected function generateTestException($command, $arg): Exception
    {
        // Do something silly
        try {
            throw new Exception('This is a test exception sent from the Sentry Laravel SDK.');
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function logMessageFromSDK(string $message): void
    {
        $this->logMessages[] = $message;
    }

    private function clearLogMessagesFromSDK(): void
    {
        $this->logMessages = [];
    }

    private function printDebugTips(): void
    {
        $emittedSDKErrors = false;
        $probablySSLError = false;

        foreach ($this->logMessages as $logMessage) {
            $emittedSDKErrors = true;

            $this->error("SDK: {$logMessage}");

            if (Str::contains($logMessage, ['SSL certificate problem', 'certificate has expired'])) {
                $probablySSLError = true;
            }
        }

        if ($probablySSLError) {
            $this->warn('The problem might be related to the Let\'s Encrypt root certificate that expired and your machine not having an up-to-date enough OpenSSL version or still having the expired root in your certificate authority store.');
            $this->warn('For more information you can check out this forum post from Let\'s Encrypt that contains helpful links on how to resolve this for your environment: https://community.letsencrypt.org/t/production-chain-changes/150739/4');
        } elseif ($emittedSDKErrors) {
            $this->error('Please check the error message from the SDK above for further hints about what went wrong.');
        } else {
            $this->error('Please check if your DSN is set properly in your `.env` as `SENTRY_LARAVEL_DSN` or in your config file `config/sentry.php`.');
        }
    }
}
