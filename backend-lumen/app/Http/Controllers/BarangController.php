<?php

namespace App\Http\Controllers;

class BarangController extends Controller
{
  public function index()
  {
    $barang = \App\Models\Barang::all();
    return response()->json([
      'success' => true,
      'message' => 'Daftar data barang inventori',
      'data' => $barang
    ], 200);
  }
}
