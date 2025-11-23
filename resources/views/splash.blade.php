<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Splash Screen</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: linear-gradient(180deg, #fdfcf7, #f9f6e5);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
            overflow: hidden;
        }

        .site-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: 1.5px;
            user-select: none;
            color: #6d6b6b;
            animation: fadeIn 1.4s ease-in-out forwards;
            opacity: 0;
        }

        .welcome-text {
            font-size: 1rem;
            color: #7c7b7b;
            margin-bottom: 20px;
            animation: fadeIn 2s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            width: 150px;
            height: 150px;
            margin-bottom: 30px;
            position: relative;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.06); opacity: 0.9; }
        }

        .circle-outer {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 190px;
            height: 190px;
            border: 3px solid #ddd;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            animation: spin 4s linear infinite;
            opacity: 0.25;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .progress-container {
            width: 260px;
            height: 18px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
            overflow: hidden;
            position: relative;
            animation: fadeIn 2s ease forwards;
            opacity: 0;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: #a5c9f8;
            border-radius: 20px;
            transition: width 0.4s ease;
        }

        .dot {
            width: 8px;
            height: 8px;
            background: #a5c9f8;
            border-radius: 50%;
            position: absolute;
            bottom: 25px;
            animation: bounce 1.5s infinite ease-in-out;
        }

        .dot:nth-child(1) { left: -20px; animation-delay: 0s; }
        .dot:nth-child(2) { left: -40px; animation-delay: 0.2s; }
        .dot:nth-child(3) { left: -60px; animation-delay: 0.4s; }

        @keyframes bounce {
            0% { transform: translateY(0); opacity: 0; }
            50% { transform: translateY(-10px); opacity: 1; }
            100% { transform: translateY(0); opacity: 0; }
        }
    </style>
</head>

<body>

    <div class="d-flex flex-column justify-center" style="transform: translateY(-20px);">
        <div class="site-name text-center">Playcare</div>
        <div class="welcome-text text-center">Welcome to PlayCare 👋</div>
    </div>
    <div class="logo">
        <img src="{{ asset('assets/images/logo-playcare.png') }}" alt="Logo"
            style="width:100%; height: 100%; border-radius: 15px; transform: scale(1.6);">
        <div class="circle-outer"></div>
    </div>

    <!-- TEKS TAMBAHAN -->
    <div class="container text-center mb-3" style="max-width: 500px; animation: fadeIn 2.2s ease forwards; opacity: 0;">
        <p class="fw-bold mb-1">Solusi penitipan anak</p>
        <p class="small text-muted">
            Platform digital yang menghubungkan orang tua dengan penyedia layanan penjagaan dan perawatan anak profesional.
        </p>
    </div>

    <!-- Progress Bar -->
    <div class="progress-container mb-2">
        <div class="progress-bar" id="progress-bar"></div>
    </div>

    <!-- Dot animation -->
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>

    <script>
        let progressBar = document.getElementById('progress-bar');
        let width = 0;

        let interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
                window.location.href = "{{ route('landing-page') }}";
            } else {
                width += 2;
                progressBar.style.width = width + '%';
            }
        }, 55);
    </script>

</body>

</html>
