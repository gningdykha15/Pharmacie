<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $table = '_medicaments';
    protected $primarykey = 'id';
    protected $fillable = [
        'nom',
        'codeBarre',
        'dateExpiration',
        'fabricant',
        'description',
    ];
    use HasFactory;
}
