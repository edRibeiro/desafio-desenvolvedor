<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadFileTest extends TestCase
{
    private const ENDPOINT = '/api/files/upload';
    /**
     * A basic feature test example.
     */
    public function test_files_can_be_uploaded(): void
    {
        Storage::fake('s3');
        $filename = "InstrumentsConsolidatedFile_" . now()->format('Ymd') . ".csv";
        $file = UploadedFile::fake()->create($filename, 1024, 'text/csv'); // 1024 KB

        $response = $this->post(self::ENDPOINT, [
            'upload' => $file,
        ]);

        $response->assertStatus(200);

        Storage::disk('s3')->assertExists("uploads/" . $filename);
        $this->assertDatabaseHas('files', [
            'file_name' => $filename,
            'path' => "uploads/" . $filename
        ]);
    }
}
