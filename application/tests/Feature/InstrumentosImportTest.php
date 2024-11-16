<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class InstrumentosImportTest extends TestCase
{
    private const ENDPOINT = '/api/files/upload';

    /**
     * A basic feature test example.
     */
    public function test_can_import_instruments_successfully(): void
    {
        Storage::fake('s3');
        Excel::fake();
        $response = $this->postJson(self::ENDPOINT, [
            'upload' => UploadedFile::fake()->create('instruments.csv', 1024, 'text/csv'),
        ]);

        $response->assertStatus(200);

        Excel::assertQueued('instruments.csv', 's3');
    }
}
