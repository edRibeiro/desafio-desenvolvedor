<?php

namespace Tests\Feature;

use App\Models\File;
use App\Services\Files\FileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criação de dados no banco de testes
        File::factory()->create([
            'file_name' => 'report2023',
            'path' => '/files/report2023.csv',
            'start_date' => '2023-08-01',
            'end_date' => '2023-08-31',
            'created_at' => now(),
        ]);

        File::factory()->create([
            'file_name' => 'data2023',
            'path' => '/files/data2023.csv',
            'start_date' => '2023-09-01',
            'end_date' => '2023-09-30',
            'created_at' => now(),
        ]);
    }

    public function test_search_with_date()
    {
        $queryArray = ['data' => '2023-08-01'];

        $response = (new FileService())->search($queryArray);

        $this->assertCount(1, $response);
        $this->assertEquals('report2023', $response[0]['file_name']);
    }

    public function test_search_with_file_name()
    {
        $queryArray = ['file_name' => 'data'];

        $response = (new FileService())->search($queryArray);

        $this->assertCount(1, $response);
        $this->assertEquals('data2023', $response[0]['file_name']);
    }

    public function test_search_with_no_parameters()
    {
        $queryArray = [];

        $response = (new FileService())->search($queryArray);

        $this->assertCount(2, $response);
    }

    public function test_search_with_invalid_date()
    {
        $queryArray = ['data' => '2025-01-01'];

        $response = (new FileService())->search($queryArray);

        $this->assertCount(0, $response);
    }
}
