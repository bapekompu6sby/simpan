<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Penandatangan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penandatangan';
    protected $primaryKey = 'id_penandatangan';
    protected $fillable = ['nama', 'nip', 'jabatan'];
}
