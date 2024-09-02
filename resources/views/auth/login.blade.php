<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMP Negeri 5 Tarano</title>
    <style>
    /* CSS Kustom untuk Login */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .login-container { 
        background-image: url('/assets/img/baground_login.png');
        background-size: cover; /* Sesuaikan ukuran gambar */
        background-position: center; /* Posisikan gambar di tengah */
        display: flex; 
        flex-direction: column; 
        overflow: hidden; 
        width: 100%; 
        min-height: 100vh; /* Mengisi seluruh tinggi viewport */
    }

    .login-content { 
        display: flex; 
        padding: 40px; 
        gap: 20px; 
        flex: 1; /* Mengisi ruang yang tersedia */
    }

    .school-info { 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        color: #fff; 
        text-align: center; 
        font: 700 35px/1.2 Montserrat, sans-serif; 
        width: 50%; 
    }

    .school-logo { 
        aspect-ratio: 0.89; 
        object-fit: contain; 
        width: 243px; 
        max-width: 100%; 
    }

    .school-name { 
        font-size: 35px;
        margin-top: 20px; 
    }

    .login-form-container { 
        width: 50%; 
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-form { 
        border-radius: 6px; 
        background-color: #fff; 
        display: flex; 
        flex-direction: column; 
        font-family: Montserrat, sans-serif; 
        color: #000; 
        font-weight: 600; 
        text-align: center; 
        padding: 40px; /* Mengatur padding untuk responsivitas */
        width: 100%;
        max-width: 500px;
    }

    .login-title { 
        font-size: 30px; 
        margin-bottom: 20px; 
    }

    .form-group { 
        display: flex; 
        flex-direction: column; 
        align-items: stretch; 
        margin-bottom: 20px; 
    }

    .form-label { 
        align-self: stretch; 
        text-align: left; 
        padding-bottom: 10px; /* Mengatur padding untuk tampilan rapi */
        font-size: 18px; 
    }

    .form-input { 
        align-self: stretch; 
        border-radius: 6px; 
        background-color: #f5f5f5; 
        width: 100%; 
        font-size: 16px; /* Ukuran font yang nyaman */
        color: rgba(0, 0, 0, 0.7); 
        padding: 10px 15px; 
        border: 1px solid #ccc; /* Tambahkan border */
        transition: border-color 0.3s;
    }

    .form-input:focus {
        border-color: #37cc1a;
        outline: none;
    }

    .submit-button { 
        align-self: stretch; 
        border-radius: 6px; 
        background-color: #37cc1a; 
        width: 100%; 
        font-size: 18px; 
        color: #fff; 
        padding: 10px 15px; 
        border: none; 
        cursor: pointer; 
        transition: background-color 0.3s;
    }

    .submit-button:hover { 
        background-color: #2da414; 
    }

    .visually-hidden { 
        position: absolute; 
        width: 1px; 
        height: 1px; 
        padding: 0; 
        margin: -1px; 
        overflow: hidden; 
        clip: rect(0, 0, 0, 0); 
        white-space: nowrap; 
        border: 0; 
    }

    .error-message {
        color: red; /* Teks berwarna merah */
        font-size: 16px; /* Ukuran font yang nyaman */
        margin-top: 10px; /* Spasi di atas pesan error */
        margin-bottom: 20px;
        text-align: center; /* Pusatkan teks */
    }

    @media (max-width: 991px) {
        .login-content { 
            flex-direction: column; 
            padding: 20px; 
        }

        .school-info, .login-form-container { 
            width: 100%; 
        }

        .login-form { 
            padding: 20px; 
        }
    }
    </style>
</head>
<body>
    <section class="login-container">
        <div class="login-content">
            <div class="school-info">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2d98fcb6a2df8c62a65d594a379c61e7662272ec271b5f9b04ae1c445f70e46c?placeholderIfAbsent=true&apiKey=1faa3f9a137d4375b1ee10cebfe2000b" alt="SMP Negeri 5 Tarano Logo" class="school-logo">
                <h1 class="school-name">SMP NEGERI 5 <br> TARANO</h1>
            </div>
            <div class="login-form-container">
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2 class="login-title">LOGIN</h2>

                    <!-- Menampilkan Pesan Error -->
                    @if ($errors->any())
                        <div class="error-message">
                            Data yang Anda masukkan salah
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-input" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Password" required>
                    </div>
                    <button type="submit" class="submit-button">Masuk</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
