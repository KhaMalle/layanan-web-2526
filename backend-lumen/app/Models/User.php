<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama_user', 'email', 'password', 'role'];
    protected $hidden = ['password']; // Menyembunyikan password saat API dipanggil
}
