<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateTask()
    {
        $response = $this->post('/admin/task', [
            'assigned_by_id' => 1,
            'assigned_by_to' => 1,
            'title' => 'test',
            'description' => 'description',
        ]);

        $response->assertStatus(302);
    }
}
