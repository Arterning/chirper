<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{

    public function test_post_task_api()
    {
        $data = [
            'title' => 'Test Task',
            'content' => 'This is a test task content'
            // You may include create_date and update_date if they are not automatically generated
        ];

        $response = $this->post('/api/tasks', $data);
        $response->assertStatus(201); // Assuming 201 is the status code for "Created"

        // Assert the structure and content of the response JSON
        $response->assertJson([
            'title' => $data['title'],
            'content' => $data['content']
            // Add assertions for create_date and update_date if needed
        ]);

        // Optionally, you can also assert the database state to ensure the task was created
        $this->assertDatabaseHas('tasks', [
            'title' => $data['title'],
            'content' => $data['content']
            // Add assertions for create_date and update_date if needed
        ]);
    }


    public function test_get_all_tasks_api()
    {
        // Assuming you have some tasks in the database for testing purposes
        $response = $this->get('/api/tasks');
        $response->assertStatus(200); // Assuming 200 is the status code for "OK"


        // Assert the structure and content of the response JSON
        $response->assertJsonStructure([
            '*' => [
                'id',
                'title',
                'content',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    public function test_get_all_tasks_with_pagination()
    {
        // Assuming you have some tasks in the database for testing purposes
        $response = $this->get('/api/tasks?pageNum=1&pageSize=10');
        $response->assertStatus(200); // Assuming 200 is the status code for "OK"

        // Assert the structure and content of the response JSON for the paginated tasks
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'content',
                    'created_at',
                    'updated_at'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
