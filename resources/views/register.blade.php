<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | SIKEMA - Politeknik Harapan Bersama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/logo_phb.png">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: linear-gradient(120deg, #f0f7fa 0%, #eaf6ff 100%);
            font-family: 'Segoe UI', 'Arial', sans-serif;
        }
        .illustration {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            border-radius: 1.3rem;
            box-shadow: 0 8px 24px #c2e2f8a1;
        }
        .illustration img {
            max-width: 88%;
            height: auto;
        }
        .login-box {
            width: 100%;
            max-width: 410px;
            padding: 2.1rem 2rem 2rem 2rem;
            background: #fff;
            border-radius: 1.3rem;
            box-shadow: 0 8px 32px #1676ea13;
            border: 1px solid #e1edfa;
            animation: fadein 0.6s;
        }
        @keyframes fadein {
            from { opacity: 0; transform: translateY(36px);}
            to { opacity: 1; transform: translateY(0);}
        }
        h5, h6 {
            font-weight: 700;
            text-align: center;
        }
        h5 { font-size: 1.23rem; }
        h6 { font-size: 1.02rem; color: #2293d4; }
        .login-box p {
            text-align: center;
            font-size: 0.98rem;
            color: #6c757d;
        }
        .form-control {
            border-radius: 1rem;
            border: 1.5px solid #bcd5ee;
            background: #f8fbff;
            transition: border .2s, background .2s;
            font-size: 1.06rem;
            padding-right: 2.5rem !important;
        }
        .form-control:focus {
            border-color: #2293d4;
            background: #f5fbfe;
            box-shadow: 0 2px 14px #1676ea19;
        }
        .form-control.is-invalid {
            border-color: #eb3e34;
            background: #fff0f0;
            animation: shake 0.22s;
        }
        .form-control.is-valid {
            border-color: #34d0b6;
            background: #f2fcfa;
        }
        @keyframes shake {
            0% { transform: translateX(0);}
            30% { transform: translateX(-6px);}
            60% { transform: translateX(6px);}
            100% { transform: translateX(0);}
        }
        .password-group {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            outline: none;
            z-index: 2;
            color: #2293d4;
            font-size: 1.25rem;
            padding: 0 0.2rem;
        }
        .btn-dark {
            background: linear-gradient(90deg, #2293d4 40%, #34d0b6 100%);
            color: #fff;
            border-radius: 1rem;
            border: none;
            font-weight: 600;
            font-size: 1.09rem;
            padding: 0.85rem;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px #2293d419;
        }
        .btn-dark:hover {
            background: linear-gradient(90deg, #34d0b6 10%, #2293d4 90%);
            box-shadow: 0 4px 18px #2293d422;
        }
        .alert-danger {
            border-radius: 1rem;
            font-size: 0.97rem;
        }
        small {
            text-align: center;
            display: block;
            color: #a1a1b6;
        }
        a { color: #2293d4; text-decoration: none;}
        a:hover { text-decoration: underline;}
        @media (max-width: 991.98px) {
            .illustration img { max-width: 96%; }
            .login-box { max-width: 370px; padding: 2rem 1.1rem 1.6rem 1.1rem; }
        }
        @media (max-width: 767.98px) {
            .illustration { display: none !important; }
            .login-box { margin-top: 2.3rem; }
        }
        @media (max-width: 575.98px) {
            .login-box { padding: 1.2rem 0.7rem 1.2rem 0.7rem; max-width: 98vw; }
        }
    </style>
</head>

<body>

<div class="container-fluid h-100">
    <div class="row h-100">
        <!-- LEFT Illustration (Hidden on mobile) -->
        <div class="col-md-6 illustration d-none d-md-flex">
            <img src="assets/media/favicons/logo-sikema.png" alt="Logo SIKEMA">
        </div>

        <!-- RIGHT Register Form -->
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
            <div class="login-box">
                <h5 class="fw-bold mb-1">Registrasi Akun Mahasiswa</h5>
                <h6 class="mb-3 fw-bold">Politeknik Harapan Bersama</h6>
                <p class="text-muted mb-4">Daftarkan akun untuk mengakses layanan akademik kampus.</p>

                <!-- Error messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="NIM" name="nim" id="nim" required>
                        <div class="invalid-feedback">NIM wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Tahun Angkatan" name="tahun_angkatan" id="tahun_angkatan" required>
                        <div class="invalid-feedback">Tahun Angkatan wajib diisi.</div>
                    </div>

                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        <div class="invalid-feedback">Mohon masukkan email yang valid.</div>
                    </div>

                    <div class="mb-3 password-group">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                               id="password" required>
                        <button type="button" class="toggle-password" tabindex="-1" id="togglePassword" aria-label="Tampilkan/Sembunyikan Password">
                            <span id="icon-eye">&#128065;</span>
                        </button>
                        <div class="invalid-feedback">Password minimal 6 karakter.</div>
                    </div>

                    <div class="mb-3 password-group">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password"
                               name="password_confirmation" id="password_confirmation" required>
                        <button type="button" class="toggle-password" tabindex="-1" id="togglePasswordConfirm" aria-label="Tampilkan/Sembunyikan Konfirmasi Password">
                            <span id="icon-eye-confirm">&#128065;</span>
                        </button>
                        <div class="invalid-feedback">Konfirmasi password tidak cocok.</div>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Daftar</button>
                </form>

                <small class="d-block text-muted mt-3">Sudah punya akun? <a href="/login">Masuk di sini</a></small>
                <small class="d-block text-muted mt-2">© 2025 | Politeknik Harapan Bersama - Sisofo360</small>
            </div>
        </div>
    </div>
</div>

<script>
    // Password Show/Hide (dua input)
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const iconEye = document.getElementById('icon-eye');
    togglePasswordBtn.addEventListener('click', function () {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        iconEye.textContent = type === 'password' ? '\u{1F441}' : '\u{1F441}\u{200D}\u{1F5E8}';
    });

    const confirmInput = document.getElementById('password_confirmation');
    const toggleConfirmBtn = document.getElementById('togglePasswordConfirm');
    const iconEyeConfirm = document.getElementById('icon-eye-confirm');
    toggleConfirmBtn.addEventListener('click', function () {
        const type = confirmInput.type === 'password' ? 'text' : 'password';
        confirmInput.type = type;
        iconEyeConfirm.textContent = type === 'password' ? '\u{1F441}' : '\u{1F441}\u{200D}\u{1F5E8}';
    });

    // Validasi client-side
    document.querySelector("form").addEventListener("submit", function (e) {
        const nim = document.getElementById("nim");
        const angkatan = document.getElementById("tahun_angkatan");
        const email = document.getElementById("email");
        const password = passwordInput;
        const confirm = confirmInput;

        let valid = true;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!nim.value.trim()) {
            nim.classList.add("is-invalid");
            valid = false;
        } else {
            nim.classList.remove("is-invalid");
        }

        if (!angkatan.value.trim()) {
            angkatan.classList.add("is-invalid");
            valid = false;
        } else {
            angkatan.classList.remove("is-invalid");
        }

        if (!email.value.trim() || !emailRegex.test(email.value)) {
            email.classList.add("is-invalid");
            valid = false;
        } else {
            email.classList.remove("is-invalid");
        }

        if (password.value.length < 6) {
            password.classList.add("is-invalid");
            valid = false;
        } else {
            password.classList.remove("is-invalid");
        }

        if (confirm.value !== password.value || confirm.value.length < 6) {
            confirm.classList.add("is-invalid");
            valid = false;
        } else {
            confirm.classList.remove("is-invalid");
        }

        if (!valid) {
            e.preventDefault();
        }
    });
</script>

</body>
</html>
