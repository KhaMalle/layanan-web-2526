<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * 1. GET ALL USERS (Menampilkan semua data user)
   * URL: GET /api/users
   */
  public function index()
  {
    $users = User::all();
    return response()->json([
      'success' => true,
      'message' => 'Daftar semua pengguna aplikasi',
      'data' => $users
    ], 200);
  }

  /**
   * 2. CREATE NEW USER (Menambah/Registrasi User Baru)
   * URL: POST /api/users
   */
  public function store(Request $request)
  {
    // Validasi inputan dari pengguna/frontend
    $this->validate($request, [
      'nama_user' => 'required|string',
      'email'     => 'required|email|unique:users,email',
      'password'  => 'required|min:6',
      'role'      => 'required|in:admin,petugas,pimpinan'
    ]);

    // Simpan data ke database
    $user = User::create([
      'nama_user' => $request->nama_user,
      'email'     => $request->email,
      'password'  => Hash::make($request->password), // Password otomatis dienkripsi/hash aman
      'role'      => $request->role,
    ]);

    return response()->json([
      'success' => true,
      'message' => 'User baru berhasil didaftarkan!',
      'data' => $user
    ], 201);
  }

  /**
   * 3. SHOW SPECIFIC USER (Melihat detail 1 user berdasarkan ID)
   * URL: GET /api/users/{id}
   */
  public function show($id)
  {
    $user = User::find($id);

    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'User tidak ditemukan'
      ], 404);
    }

    return response()->json([
      'success' => true,
      'message' => 'Detail data user ditemukan',
      'data' => $user
    ], 200);
  }

  /**
   * 4. UPDATE USER (Mengubah data user)
   * URL: PUT /api/users/{id}
   */
  public function update(Request $request, $id)
  {
    $user = User::find($id);

    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'User tidak ditemukan'
      ], 404);
    }

    // Validasi data yang diubah
    $this->validate($request, [
      'nama_user' => 'string',
      'email'     => 'email|unique:users,email,' . $id . ',id_user',
      'role'      => 'in:admin,petugas,pimpinan'
    ]);

    // Update data secara dinamis
    $user->fill($request->all());

    // Jika password ikut diubah, lakukan enkripsi ulang
    if ($request->has('password')) {
      $user->password = Hash::make($request->password);
    }

    $user->save();

    return response()->json([
      'success' => true,
      'message' => 'Data user berhasil diperbarui',
      'data' => $user
    ], 200);
  }

  /**
   * 5. DELETE USER (Menghapus user dari sistem)
   * URL: DELETE /api/users/{id}
   */
  public function destroy($id)
  {
    $user = User::find($id);

    if (!$user) {
      return response()->json([
        'success' => false,
        'message' => 'User tidak ditemukan'
      ], 404);
    }

    $user->delete();

    return response()->json([
      'success' => true,
      'message' => 'User berhasil dihapus dari sistem'
    ], 200);
  }
}
