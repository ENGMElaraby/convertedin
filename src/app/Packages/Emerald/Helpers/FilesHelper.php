<?php

namespace MElaraby\Emerald\Helpers;

use Illuminate\{Http\Request, Http\UploadedFile, Support\Str};
use JetBrains\PhpStorm\ArrayShape;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

trait FilesHelper
{
    private $fileName;

    /**
     * Handles the file upload
     * @param Request $request
     * @return array|int
     * @throws UploadFailedException
     * @throws UploadMissingFileException
     */
    final public function uploadChunk(Request $request): int|array
    {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFile($save->getFile());
        }

        // we are in chunk mode, lets send the current progress
        sleep(1);
        return $save->handler()->getPercentageDone();
    }

    /**
     * Saves the file
     *
     * @param UploadedFile $file
     *
     * @return array
     */
    #[ArrayShape(['path' => "string", 'name' => "string", 'mime_type' => "mixed", 'finalPath' => "string"])]
    final protected function saveFile(UploadedFile $file): array
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-d");

        // Build the file path
        $filePath = "public/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/" . $filePath);

        // move the file name
        $file->move($finalPath, $fileName);

        return [
            'path' => $filePath,
            'name' => $fileName,
            'mime_type' => $mime,
            'finalPath' => $finalPath
        ];
    }


    /**
     * Create unique filename for uploaded file
     * @param UploadedFile $file
     * @return string
     */
    protected function createFilename(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", md5(time()));

        // Add timestamp hash to name of the file
        $filename .= "_" . "." . $extension;

        return $filename;
    }

    /**
     * @param array $files
     * @param string $location
     * @return array
     */
    final protected function uploadMultiFiles(array $files, string $location): array
    {
        $uploadedFiles = [];
        foreach ($files as $key => $file) {
            $uploadedFiles[$key]['url'] = $this->fileUpload($file, $location);
            $uploadedFiles[$key]['name'] = $this->fileName;
        }

        return $uploadedFiles;
    }

    /**
     * @param object $file
     * @param string $location
     * @param string|null $disk
     * @return string|null
     */
    final protected function fileUpload(object $file, string $location, ?string $disk = 'null'): ?string
    {
        if (!is_file($file)) {
            return null;
        }

        $fileOriginalExtension = $file->getClientOriginalExtension();
        $fileUniqueName = $this->uniqueName($fileOriginalExtension);

//        if ($disk) {
//        $uploadedFile = Storage::put($location, $file);
//        return url()->to(str_replace('public/', 'public/storage/', $uploadedFile));
//        }

        $file->storeAs($location, $fileUniqueName, ['disk' => 'public']);
        return url()->to('/storage/' . $location . '/' . $fileUniqueName);
    }

    /**
     * @param string $extension
     * @return string
     */
    private function uniqueName(string $extension): string
    {
        return time() . '_' . Str::random(6) . '.' . $extension;
    }
}
