<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParsedData extends Model
{
    use HasFactory;

    protected $table = 'parsed_data';

    protected $fillable = [
        'flId',
        'flTypeId',
        'flText',
        'flType',
        'flSubType',
        'flCato',
        'flRca',
        'parentId'
    ];
}
