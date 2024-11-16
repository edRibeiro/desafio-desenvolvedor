<?php

namespace App\Services\Files;

use App\Models\File;

interface FileServiceInterface
{
    public function saveFileName($fileName, $path): File;
    public function search($queryArray);
}
