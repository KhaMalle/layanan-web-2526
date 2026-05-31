<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | INV-SYSTEM UNPER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: #f1f5f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .brand-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: #6366f1;
            background: white;
        }

        .btn-login {
            background: #6366f1;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 10px;
            color: white;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="text-center">
            <div class="brand-icon shadow-lg"><i class="fas fa-box-open"></i></div>
            <h4 class="fw-bold mb-1 text-dark">INVEERA</h4>
            <p class="text-muted small mb-4">Sistem Inventaris Modern Era</p>
        </div>

        <form id="form-login">
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Email Address</label>
                <input type="email" id="email" class="form-control" placeholder="Masukkan email terdaftar" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-login">
                Masuk ke Sistem <i class="fas fa-sign-in-alt ms-2"></i>
            </button>
        </form>

        <div class="register-link">
            Belum punya akses? <br>
            <span class="text-muted small">Hubungi <b>Administrator TI</b> untuk mendaftarkan akun.</span>
        </div>
    </div>

    <script>
        document.getElementById('form-login').addEventListener('submit', async function(e) {
            e.preventDefault(); // Mencegah reload halaman

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;

            try {
                // Menembak (Fetch) data ke Backend Lumen Akmal di port 8000
                const response = await fetch('http://localhost:8000/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ 
                        email: email, 
                        password: password,
                        role: role 
                    })
                });

                const hasil = await response.json();

                if (hasil.success === true) {
                    // Cek apakah role yang dipilih sesuai dengan role asli user di database
                    if (hasil.user.role !== role) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Akses Ditolak',
                            text: 'Email terdaftar, tetapi bukan sebagai ' + role.toUpperCase() + '!',
                            confirmButtonColor: '#6366f1'
                        });
                        return;
                    }

                    // Jika sukses dan Role COCOK, Munculkan SweetAlert Sukses khas desainmu
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Masuk!',
                        text: 'Selamat datang, ' + hasil.user.nama_user,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        // Simpan data user di browser agar halaman dashboard tahu siapa yang login
                        localStorage.setItem('user_nama', hasil.user.nama_user);
                        localStorage.setItem('user_role', hasil.user.role);

                        // Pengalihan halaman otomatis (Redirect) ke Dashboard Frontend
                        window.location.href = '/dashboard';
                    });

                } else {
                    // Jika data salah / tidak cocok (Respon dari Lumen)
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: hasil.message,
                        confirmButtonColor: '#6366f1'
                    });
                }
            } catch (error) {
                // Jika server Backend Lumen mati / lupa dinyalakan
                Swal.fire({
                    icon: 'warning',
                    title: 'Koneksi Terputus',
                    text: 'Gagal terhubung ke API Backend. Pastikan server Lumen sudah berjalan!',
                    confirmButtonColor: '#6366f1'
                });
            }
        });
    </script>

</body>

</html>