<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Storage;

class FileExists implements ValidationRule
{
    protected $folder;
    protected $disk;

    // O construtor opcional para permitir escolher o disco (por exemplo, 'local' ou 's3')
    public function __construct($folder, $disk = 'local')
    {
        $this->folder = $folder;
        $this->disk = $disk;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Storage::disk($this->disk)->exists($this->folder . "/" . $value->getClientOriginalName())) {
            $fail('O arquivo já existe no disco.');
        }
    }
}
