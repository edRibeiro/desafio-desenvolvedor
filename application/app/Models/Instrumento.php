<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Instrumento extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $connection = 'mongodb';

    protected $collection = 'instrumentos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_name', 'path'];
}
