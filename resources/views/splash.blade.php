<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Splash Screen</title>
    <style>
        /* Reset dan dasar */
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #f9f6e5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
        }

        /* Nama web */
        .site-name {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 24px;
            letter-spacing: 2px;
            user-select: none;
            color: #4a4a4a;
            text-transform: lowercase;
        }

        /* Container logo + circle */
        .logo {
            width: 150px;
            height: 150px;
            margin-bottom: 40px;
            position: relative;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        /* Lingkaran luar */
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
            animation: spin 3s linear infinite;
            opacity: 0.3;
            filter: drop-shadow(0 0 2px rgba(0, 0, 0, 0.05));
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        /* Progress bar */
        .progress-container {
            width: 250px;
            height: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgb(0 0 0 / 0.1);
            overflow: hidden;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: #a5c9f8;
            border-radius: 15px 0 0 15px;
            box-shadow: inset 1px 1px 3px rgba(255, 255, 255, 0.7);
            transition: width 0.3s ease;
        }

    </style>
</head>

<body>
    <div class="logo">
        <img src="{{ asset('assets/images/logo-splash.png') }}" alt="Logo"
            style="width:100%; height: 100%; border-radius: 15px;">
        <div class="circle-outer"></div>
    </div>

    <div class="progress-container">
        <div class="progress-bar" id="progress-bar"></div>
    </div>

    <script>
        // Animasi progress bar selama sekitar 3 detik lalu redirect ke landing
        let progressBar = document.getElementById('progress-bar');
        let width = 0;
        let interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
                window.location.href = "{{ route('landing-page') }}";
            } else {
                width += 2; // 50 step * 60ms -> ~3 detik
                progressBar.style.width = width + '%';
            }
        }, 60);

    </script>

</body>

</html>
