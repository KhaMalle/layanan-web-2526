<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
  // 1. Beritahu Lumen bahwa model ini memegang tabel bernama 'barang'
  protected $table = 'barang';

  // 2. Tentukan Primary Key sesuai kamus data laporan (bawaan Laravel/Lumen adalah 'id')
  protected $primaryKey = 'id_barang';

  // 3. Daftarkan field/kolom apa saja yang boleh diisi data (Mass Assignment)
  protected $fillable = [
    'id_kategori',
    'id_supplier',
    'nama_barang',
    'stok',
    'harga'
  ];

  /**
   * CARDINALITAS & RELASI (Sesuai Bab 3.5.2 Laporan UTS)
   * Banyak barang bisa bernaud di bawah SATU kategori (Many to One)
   */
  public function kategori()
  {
    // belongsTo(NamaModelTarget, 'foreign_key_di_tabel_ini', 'primary_key_di_tabel_target')
    return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
  }

  /**
   * Banyak barang bisa disuplai oleh SATU supplier (Many to One)
   */
  public function supplier()
  {
    return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
  }

  /**
   * Satu barang bisa memiliki BANYAK riwayat transaksi (One to Many)
   */
  public function transaksi()
  {
    // hasMany(NamaModelTarget, 'foreign_key_di_tabel_target', 'primary_key_di_tabel_ini')
    return $this->hasMany(Transaksi::class, 'id_barang', 'id_barang');
  }
}
