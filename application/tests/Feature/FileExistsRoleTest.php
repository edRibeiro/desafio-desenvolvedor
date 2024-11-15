<?php

namespace Tests\Feature;

use App\Rules\FileExists;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class FileExistsRoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_rule_file_exists()
    {
        // Simula o armazenamento do disco s3 fake
        Storage::fake('s3');

        // Cria um arquivo fake
        $file = UploadedFile::fake()->create('testFileExists.txt', 100);

        // Faz o upload do arquivo para o disco fake
        $file->storeAs('uploads', 'testFileExists.txt', 's3');

        // Cria a regra personalizada FileExists
        $rule = new FileExists('uploads', 's3');  // Defina o disco 's3'

        // Cria um validador para verificar se o arquivo já existe no disco
        $validator = Validator::make(
            ['upload' => $file],  // Passa os dados com o arquivo para validar
            ['upload' => $rule]  // Aplica a regra no campo 'upload'
        );

        $this->assertTrue($validator->fails());  // Espera que a validação falhe
    }

    /**
     * A basic feature test example.
     */
    public function test_rule_file_not_exists()
    {
        // Simula o armazenamento do disco s3 fake
        Storage::fake('s3');

        // Cria um arquivo fake
        $file = UploadedFile::fake()->create('testFileNotExists.txt', 100);

        // Cria a regra personalizada FileExists
        $rule = new FileExists('s3');  // Defina o disco 's3'

        // Cria um validador para verificar se o arquivo já existe no disco
        $validator = Validator::make(
            ['upload' => $file],  // Passa os dados com o arquivo para validar
            ['upload' => $rule]  // Aplica a regra no campo 'upload'
        );
        // Verifica se a validação falhou porque o arquivo já existe
        $this->assertFalse($validator->fails());  // Espera que a validação falhe
    }
}
