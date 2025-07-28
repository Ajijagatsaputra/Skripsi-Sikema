<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SIKEMA - Politeknik Harapan Bersama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/logo_phb.png">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background: linear-gradient(120deg, #f0f7fa 0%, #eaf6ff 100%);
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
            max-width: 400px;
            padding: 2rem;
            background: #fff;
            border-radius: 1.3rem;
            box-shadow: 0 8px 32px #1676ea13;
            border: 1px solid #e1edfa;
        }

        .form-control {
            border-radius: 1rem;
            border: 1.5px solid #bcd5ee;
            background: #f8fbff;
            transition: border .2s;
        }

        .form-control:focus {
            border-color: #2293d4;
            box-shadow: 0 2px 14px #1676ea19;
            background: #f5fbfe;
        }

        .btn-dark {
            background: linear-gradient(90deg, #2293d4 40%, #34d0b6 100%);
            color: #fff;
            border-radius: 1rem;
            border: none;
            font-weight: 600;
            transition: background 0.2s, box-shadow 0.2s;
        }

        .btn-dark:hover {
            background: linear-gradient(90deg, #34d0b6 10%, #2293d4 90%);
            box-shadow: 0 4px 18px #2293d422;
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
            font-size: 1.2rem;
        }

        .form-control.is-invalid {
            border-color: #eb3e34;
            background: #fff0f0;
        }

        .form-control.is-valid {
            border-color: #34d0b6;
            background: #f2fcfa;
        }

        .invalid-feedback {
            font-size: .92rem;
        }

        @media (max-width: 767.98px) {
            .illustration {
                display: none !important;
            }

            .login-box {
                padding: 1.3rem;
            }
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

            <!-- RIGHT Login Form -->
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                <div class="login-box">
                    <h5 class="fw-bold mb-1">Sistem Informasi Kemahasiswaan</h5>
                    <h6 class="mb-3 fw-bold">Politeknik Harapan Bersama</h6>
                    <p class="text-muted mb-4">Akses ke seluruh layanan akademik kampus dengan mudah dan cepat.</p>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Email" name="email" id="email" required>
                            <div class="invalid-feedback">Mohon masukkan email yang valid.</div>
                        </div>
                        <div class="mb-3 password-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required autocomplete="current-password">
                            <button type="button" class="toggle-password" tabindex="-1" id="togglePassword" aria-label="Tampilkan/Sembunyikan Password">
                                <span id="icon-eye">&#128065;</span>
                            </button>
                            <div class="invalid-feedback">Password minimal 6 karakter.</div>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="showPassword">
                            <label class="form-check-label" for="showPassword">Tampilkan Password</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Login</button>
                    </form>

                    <small class="d-block text-muted mt-3">Belum punya akun? <a href="/register">Registrasi Akun</a></small>
                    <small class="d-block text-muted mt-2">© 2025 | Politeknik Harapan Bersama - Sisofo360</small>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fitur mata di dalam input password (hidden/show)
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const iconEye = document.getElementById('icon-eye');

        togglePasswordBtn.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            iconEye.textContent = type === 'password' ? '\u{1F441}' : '\u{1F441}\u{200D}\u{1F5E8}'; // mata dan mata dicoret
        });

        // Sinkron checkbox "Tampilkan Password" (biar dua-duanya sinkron)
        document.getElementById('showPassword').addEventListener('change', function () {
            if (this.checked) {
                passwordInput.type = 'text';
                iconEye.textContent = '\u{1F441}\u{200D}\u{1F5E8}';
            } else {
                passwordInput.type = 'password';
                iconEye.textContent = '\u{1F441}';
            }
        });

        // Validasi form
        document.querySelector("form").addEventListener("submit", function (e) {
            const emailInput = document.getElementById("email");
            const password = passwordInput.value.trim();
            const email = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            let isValid = true;

            // Email validation
            if (!email || !emailRegex.test(email)) {
                emailInput.classList.add("is-invalid");
                isValid = false;
            } else {
                emailInput.classList.remove("is-invalid");
                emailInput.classList.add("is-valid");
            }

            // Password validation
            if (!password || password.length < 6) {
                passwordInput.classList.add("is-invalid");
                isValid = false;
            } else {
                passwordInput.classList.remove("is-invalid");
                passwordInput.classList.add("is-valid");
            }

            // Prevent form submit if not valid
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
