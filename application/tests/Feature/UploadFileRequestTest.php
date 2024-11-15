<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadFileRequestTest extends TestCase
{
    private const ENDPOINT = '/api/files/upload';

    /** @test */
    public function it_validates_required_file_field()
    {
        $response = $this->postJson(self::ENDPOINT, []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('upload');
    }

    /** @test */
    public function it_validates_file_type_extension()
    {
        $response = $this->postJson(self::ENDPOINT, [
            'upload' => UploadedFile::fake()->create('file.pdf', 100),
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('upload');
    }

    /** @test */
    public function it_allows_valid_file_types()
    {
        $response = $this->postJson(self::ENDPOINT, [
            'upload' => UploadedFile::fake()->create('file.xlsx', 100),
        ]);

        $response->assertStatus(200);
    }
}
