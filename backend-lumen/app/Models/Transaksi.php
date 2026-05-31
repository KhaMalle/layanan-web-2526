<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
  protected $table = 'transaksi';
  protected $primaryKey = 'id_transaksi';
  protected $fillable = ['id_barang', 'id_user', 'jenis_transaksi', 'qty', 'tanggal_transaksi'];
}
