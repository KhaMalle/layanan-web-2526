<?php

namespace App\Http\Controllers;

class SupplierController extends Controller
{
  public function index()
  {
    return response()->json(['success' => true, 'data' => \App\Models\Supplier::all()], 200);
  }
}
