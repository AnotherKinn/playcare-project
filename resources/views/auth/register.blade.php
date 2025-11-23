<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — PlayCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #2bbec6;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, #48d1d6 100%);
        }

        .form-shadow {
            box-shadow: 0 10px 30px rgba(43, 190, 198, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex bg-white">

    <!-- Kolom Kiri -->
    <div class="hidden md:flex w-1/2 gradient-bg items-center justify-center relative overflow-hidden">
        <!-- Gambar background opsional -->
        <div class="absolute inset-0 bg-[url('https://i.pinimg.com/1200x/90/92/51/909251d428c5c1ab4de627aef0b8db75.jpg')] bg-cover bg-center opacity-20"></div>

        <div class="relative z-10 text-center text-white p-10">
            <img src="{{ asset('assets/images/logo-playcare.png') }}"
                alt="PlayCare Logo"
                style="transform: scale(1.3);"
                class="mx-auto w-32 h-32 mb-6 rounded-full border-4 border-white shadow-lg object-cover">
            <h1 class="text-4xl font-extrabold tracking-tight">Daftar di <span class="text-white">PlayCare</span></h1>
            <p class="mt-4 text-lg font-light max-w-md mx-auto">Bergabung bersama kami dan pantau perkembangan anak Anda dengan mudah dan aman.</p>
        </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="flex w-full md:w-1/2 items-center justify-center p-8 md:p-16 bg-white">
        <div class="w-full max-w-md form-shadow bg-white rounded-2xl p-8 md:p-10">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Buat Akun Parent</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('name') border-red-500 @enderror"
                        placeholder="Masukkan nama Anda">
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email Anda">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('phone') border-red-500 @enderror"
                        placeholder="Masukkan no telepon">
                    @error('phone')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('address') border-red-500 @enderror"
                        placeholder="Masukkan alamat">
                    @error('address')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[var(--primary)] placeholder-gray-400"
                        placeholder="Masukkan ulang password">
                </div>

                <button type="submit"
                    class="w-full bg-[var(--primary)] hover:bg-[#26aeb5] text-white font-semibold rounded-full py-3 shadow-md transition duration-300">
                    Daftar
                </button>

                <div class="text-center text-sm text-gray-600 mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-[var(--primary)] font-semibold hover:underline">Login di sini</a>
                </div>
            </form>
        </div>
    </div>

    {{-- ====== SWEETALERT2 SCRIPT ====== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Alert sukses register --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text:  "{{ session('success') }}",
                confirmButtonColor: '#2bbec6',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = "{{ route('login') }}";
            });
        </script>
    @endif

    {{-- Alert error validasi --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `
                    <ul style="text-align:center;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Coba Lagi'
            });
        </script>
    @endif
</body>
</html>
