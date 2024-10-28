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
        'dateExpiration',
        'fabricant',
        'description',
        'medicament_code',
        'notice',
        'instructions',
        'code_barre',
    ];
    use HasFactory;
}
