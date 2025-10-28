<x-app-layout>
    <div class="container py-5 text-center">
        <div class="card shadow-sm border-0 p-4 mx-auto" style="max-width: 500px;">
            <i class="bi bi-check-circle-fill text-success display-4 mb-3"></i>
            <h4 class="fw-bold mb-2">Profil Berhasil Diperbarui!</h4>
            <p class="text-muted mb-4">Perubahan data kamu sudah disimpan dengan sukses.</p>
            <a href="{{ route('parent.profile.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Profil
            </a>
        </div>
    </div>
</x-app-layout>
