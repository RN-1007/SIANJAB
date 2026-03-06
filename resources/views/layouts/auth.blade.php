<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SiAnjab</title>
    <link rel="icon" href="{{ asset('img/LogoMagetan.png') }}" type="image/x-icon" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
     <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <link rel="stylesheet" href="../dist/css/adminlte.min.css" />
    
    @livewireStyles

    <style>
    #background-video {
        position: fixed;
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        z-index: -1; 
        object-fit: cover;
    }


    body.login-page {
       
        margin: 0;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    
    body.login-page::before {
        content: "";
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 1;
    }

    
    .login-box {
        position: relative;
        z-index: 2;
        width: 100%;
        /* max-width: 400px; -- Disesuaikan di inline style */
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
        /* padding: 40px 30px; -- Disesuaikan di layout card */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: none;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .form-control:focus,
    .form-control:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: none;
        box-shadow: none;
        outline: none;
    }


    .input-group-text {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .row.no-gutters {
    display: flex;
    align-items: stretch;
    height: 90%;
}

.card-body {
    min-height: 300px; 
}
    </style>
</head>
<body class="hold-transition login-page">
    <!-- Video Background -->
   
    <video id="background-video" autoplay loop muted playsinline>
        <source src="{{ asset('video/pemandangan.mp4') }}" type="video/mp4">
    </video>
  
    <!-- Overlay with blur -->
    <!-- <div class="overlay"></div> -->

    <!-- Content -->
    <div class="login-box" style="width: 900px; max-width: 100%;">
        {{ $slot }}
    </div>

    @livewireScripts

    <script>
        document.getElementById('togglePassword')?.addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>