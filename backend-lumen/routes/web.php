<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Rute Halaman Utama (Bawaan Lumen yang memunculkan tulisan Lumen 10.0.4)
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// =========================================================================
// RUTE API SISTEM INVENTORI BARANG
// =========================================================================

// 1. Rute API Managemen Pengguna / Users (CRUD Lengkap)
$router->get('/api/users', 'UserController@index');          // Ambil semua user
$router->post('/api/users', 'UserController@store');         // Tambah user baru
$router->get('/api/users/{id}', 'UserController@show');      // Lihat detail 1 user
$router->put('/api/users/{id}', 'UserController@update');    // Edit data user
$router->delete('/api/users/{id}', 'UserController@destroy'); // Hapus user

// 2. Rute API Kategori Barang
$router->get('/api/kategori', 'KategoriController@index');

// 3. Rute API Supplier
$router->get('/api/supplier', 'SupplierController@index');

// 4. Rute API Barang (Rute andalan kamu!)
$router->get('/api/barang', 'BarangController@index');

// 5. Rute API Transaksi (Barang Masuk / Keluar)
$router->get('/api/transaksi', 'TransaksiController@index');
