<?php

use Illuminate\Support\Facades\Route;

// 1. Jalur utama: Saat buka localhost:8080 langsung muncul halaman login
Route::get('/', function () {
    return view('login');
});

// 2. Jalur cadangan: Jika login sukses, dilempar ke halaman dashboard sederhana ini dulu
Route::get('/dashboard', function () {
    return "
        <div style='text-align: center; margin-top: 100px; font-family: sans-serif;'>
            <h1 style='color: #2b78e4;'>Selamat Datang di Dashboard Inventori!</h1>
            <p>Hebat, proses <strong>Fetch Login</strong> dari Frontend ke Backend kamu sukses besar 100%!</p>
            <a href='/'><- Kembali ke Login</a>
        </div>
    ";
});