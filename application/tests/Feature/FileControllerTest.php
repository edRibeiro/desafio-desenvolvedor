<?php

namespace Tests\Feature;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Criação de arquivos de exemplo para a busca
        File::factory()->create([
            'file_name' => 'report2024',
            'path' => '/files/report2024.csv',
            'start_date' => '2024-05-01',
            'end_date' => '2024-05-31',
            'created_at' => now(),
        ]);

        File::factory()->create([
            'file_name' => 'data2024',
            'path' => '/files/data2024.csv',
            'start_date' => '2024-05-01',
            'end_date' => '2024-06-01',
            'created_at' => now(),
        ]);

        File::factory()->create([
            'file_name' => 'archive2024',
            'path' => '/files/archive2024.csv',
            'start_date' => '2024-06-01',
            'end_date' => '2024-06-30',
            'created_at' => now(),
        ]);
    }

    /** @test */
    public function it_can_search_files_by_file_name_and_date()
    {
        $response = $this->getJson('/api/files?q=file_name:report,data:2024-05-01');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJson([
                [
                    'file_name' => 'report2024',
                    'start_date' => '2024-05-01',
                    'end_date' => '2024-05-31',
                ]
            ]);
    }

    /** @test */
    public function it_returns_multiple_results_when_searching_by_file_name()
    {
        $response = $this->getJson('/api/files?q=file_name:2024');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_return_no_results_for_invalid_search()
    {
        $response = $this->getJson('/api/files?q=file_name:nonexistentfile,data:2024-05-01');

        $response->assertStatus(200)
            ->assertJsonCount(0);
    }

    /** @test */
    public function it_can_search_by_date_only()
    {
        $response = $this->getJson('/api/files?q=data:2024-05-01');

        $response->assertStatus(200)
            ->assertJsonCount(2);
    }
}
