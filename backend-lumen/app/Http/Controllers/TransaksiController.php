<?php

namespace App\Http\Controllers;

class TransaksiController extends Controller
{
  public function index()
  {
    return response()->json(['success' => true, 'data' => \App\Models\Transaksi::all()], 200);
  }
}
