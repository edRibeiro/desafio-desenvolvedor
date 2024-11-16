<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrumento extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'instrumentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RptDt',
        'TckrSymb',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm',
        'file_id'
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
