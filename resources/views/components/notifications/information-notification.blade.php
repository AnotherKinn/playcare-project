<x-app-layout>
    <div class="container py-4">
        <div class="card border-0 shadow-soft-card rounded-4">
            <div class="card-body p-4 p-md-5">

                <!-- Header -->
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 48px; height: 48px; background-color: rgba(43, 190, 198, 0.15);">
                        <i class="bi bi-megaphone-fill fs-4" style="color: #2bbec6;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0" style="color: #2bbec6;">Informasi Pembayaran</h5>
                        <small class="text-muted">Diperbarui {{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                <!-- Konten -->
                <div class="mt-3" style="font-family: 'Poppins', sans-serif;">
                    <p class="text-secondary mb-3 lh-lg">
                        Terima kasih telah melakukan booking di <strong>PlayCare</strong>! 🥰
                        Kami sangat menghargai kepercayaan Anda kepada layanan kami.
                        Demi kenyamanan bersama, mohon segera lakukan konfirmasi pembayaran agar proses booking dapat diproses lebih lanjut.
                    </p>

                    <p class="text-secondary lh-lg">
                        Silakan unggah <strong>bukti pembayaran</strong> Anda melalui tombol di bawah ini.
                        Tim kami akan segera melakukan verifikasi setelah Anda mengirimkannya.
                    </p>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap justify-content-start mt-4 gap-2">
                    <a href="{{ route('parent.transaction.upload', $notification->transaction_id ?? 0) }}"
                        class="btn text-white fw-semibold shadow-sm"
                        style="background-color: #2bbec6; border-radius: 12px; transition: 0.3s;">
                        💳 Upload Bukti Pembayaran
                    </a>

                    <form action="{{ route('parent.notifications.destroy', $notification->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger fw-semibold rounded-3 shadow-sm">
                            🗑️ Hapus Notifikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahan CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(43, 190, 198, 0.15);
        }
    </style>
</x-app-layout>
