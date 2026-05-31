<?php

namespace App\Http\Controllers;

class KategoriController extends Controller
{
  public function index()
  {
    return response()->json(['success' => true, 'data' => \App\Models\Kategori::all()], 200);
  }
}
