<?php

namespace App\Services\Files;

use App\Helpers\DateHelper;
use App\Models\File;
use Illuminate\Support\Arr;

final class FileService implements FileServiceInterface
{
    function saveFileName($fileName, $path): File
    {
        $dates = DateHelper::extractAndConvertDate($fileName);
        $file = new File();
        $file->file_name = $fileName;
        $file->path = $path;
        if (count($dates) > 1) {
            $file->start_date = Arr::first($dates);
            $file->end_date = Arr::last($dates);
        } elseif (count($dates) === 1) {
            $file->start_date = Arr::first($dates);
        }
        $file->save();
        return $file;
    }

    public function search($queryArray)
    {
        $search = File::query();

        if (isset($queryArray['file_name'])) {
            $fileName = trim($queryArray['file_name']);

            $search->where('file_name', 'like', "%" . $fileName . "%");
        }

        if (isset($queryArray['data']) && !empty(trim($queryArray['data']))) {
            $data = trim($queryArray['data']);
            $search->where('start_date', '=', $data);
        }

        $search->select('file_name', 'path', 'start_date', 'end_date', 'created_at');
        return $search->get();
    }
}
