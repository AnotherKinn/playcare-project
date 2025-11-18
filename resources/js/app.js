import './bootstrap';
import {
    Chart,
    registerables
} from 'chart.js';
Chart.register(...registerables);
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

// Import Leaflet
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

// Import icon marker (fix Vite)
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

// Perbaikan path icon Leaflet (WAJIB untuk Vite)
delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: '/images/vendor/leaflet/marker-icon-2x.png',
    iconUrl: '/images/vendor/leaflet/marker-icon.png',
    shadowUrl: '/images/vendor/leaflet/marker-shadow.png',
});

window.Alpine = Alpine;
window.Chart = Chart;
Alpine.start();

const userId = window.Laravel?.user?.id??null;
const userRole = window.Laravel?.user?.role??null;

document.addEventListener("DOMContentLoaded", function () {
    // Koordinat lokasi
    let lat = -6.423535;
    let lon = 106.940072;

    // Inisialisasi map
    const map = L.map("map").setView([lat, lon], 16);

    // Tile Online (OSM)
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
    }).addTo(map);

    // Marker dari URL (tanpa file di public)
    const markerIcon = L.icon({
        iconUrl: "https://maps.google.com/mapfiles/ms/icons/red-dot.png",
        iconSize: [32, 32],  // ukuran ikon
        iconAnchor: [16, 32], // posisi anchor
        popupAnchor: [0, -32],
    });

    L.marker([lat, lon], { icon: markerIcon })
        .addTo(map)
        .bindPopup("SMKN 1 GunungPutri");
});




console.log("🧠 Reverb Debug Mode aktif...");

if (window.Echo && window.Echo.connector) {
    console.log("✅ Echo terdeteksi:", window.Echo);

    const conn = window.Echo.connector.pusher.connection;
    conn.bind('state_change', (s) => console.log(`🔄 Reverb state: ${s.previous} → ${s.current}`));
    conn.bind('connected', () => console.log("🟢 Reverb connected."));
    conn.bind('disconnected', () => console.warn("🔴 Reverb disconnected!"));
    conn.bind('error', (err) => console.error("⚠️ Reverb error:", err));

    /**
     * ===============================
     * 🔔 ADMIN - CHANNEL NOTIFICATIONS
     * ===============================
     */
    console.log("📡 Subscribe ke channel publik: admin.notifications");

    // --- Event Bukti Pembayaran ---
    window.Echo.channel('admin.notifications')
        .listen('.payment.uploaded', (event) => {
            console.log("📩 Event PaymentUploaded diterima:", event);

            if (userRole === 'admin') {
                Swal.fire({
                    title: 'Bukti pembayaran baru!',
                    text: `Parent ${event.transaction?.user?.name ?? 'Tidak diketahui'} mengunggah bukti pembayaran.`,
                    icon: 'info',
                    timer: 4000,
                    showConfirmButton: false,
                });
            }
        });

    // --- Event Laporan Anak dari Staff ---
    window.Echo.channel('admin.notifications')
        .listen('.child.report.submitted', (event) => {
            console.log("📩 Event ChildReportSubmitted diterima:", event);

            if (userRole === 'admin') {
                // Update badge notifikasi di navbar admin
                const badge = document.querySelector('#report-badge');
                if (badge) {
                    const current = parseInt(badge.textContent.trim() || 0);
                    badge.textContent = current + 1;
                    badge.classList.remove('d-none');
                    badge.style.display = 'inline-block';
                }

                // Tampilkan alert
                Swal.fire({
                    title: 'Laporan Anak Baru!',
                    text: `${event.staff_name} telah mengirim laporan untuk ${event.child_name}.`,
                    icon: 'info',
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        });


    // --- Event Review Parent ---
    window.Echo.channel('admin.notifications')
        .listen('.review.submitted', (event) => {
            console.log("📝 Event ReviewSubmitted diterima:", event);

            if (userRole === 'admin') {
                const badge = document.querySelector('#review-badge');

                if (badge) {
                    // ambil angka dari badge, kalau kosong default 0
                    const current = parseInt(badge.textContent.trim() || 0);
                    badge.textContent = current + 1;

                    // pastikan badge tidak tersembunyi
                    badge.classList.remove('d-none');
                    badge.style.display = 'inline-block';
                } else {
                    console.warn("⚠️ Elemen badge #review-badge tidak ditemukan di DOM.");
                }
            }
        });
} else {
    console.error("❌ Echo tidak ditemukan. Cek konfigurasi di bootstrap.js dan Reverb server.");
}

/**
 * ==================================
 * 👂 LISTEN PRIVATE CHANNEL PARENT
 * ==================================
 */
if (userId) {
    console.log(`👂 Mencoba subscribe ke private channel: parent.${userId}`);

    Echo.private(`parent.${userId}`)
        .subscribed(() => {
            console.log(`🟢 Berhasil subscribe ke channel private: parent.${userId}`);
        })
        .error((err) => {
            console.error(`❌ Gagal subscribe ke channel parent.${userId}:`, err);
        })
        .listen('.BookingVerified', (e) => {
            console.log("📨 Event BookingVerified diterima:", e);

            Swal.fire({
                icon: e.status === 'approved' ? 'success' : 'error',
                title: e.status === 'approved' ? 'Booking Disetujui!' : 'Booking Ditolak!',
                text: e.message,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
            });
        });
} else {
    console.warn("⚠️ Tidak ada userId, channel private parent tidak di-subscribe.");
}


/**
 * ==================================
 * 👂 LISTEN PRIVATE CHANNEL STAFF
 * ==================================
 */
if (userId && userRole === 'staff') {
    console.log(`👂 Subscribe ke private channel: staff.${userId}`);

    Echo.private(`staff.${userId}`)
        .subscribed(() => {
            console.log(`🟢 Berhasil subscribe ke channel staff.${userId}`);
        })
        .error((err) => {
            console.error(`❌ Gagal subscribe ke channel staff.${userId}:`, err);
        })
        .listen('.staff.assigned', (event) => {
            console.log("📨 Event StaffAssigned diterima:", event);

            // update badge notifikasi di navbar-mini staff
            const badge = document.querySelector('#staff-badge');
            if (badge) {
                const current = parseInt(badge.textContent.trim() || 0);
                badge.textContent = current + 1;
                badge.classList.remove('d-none');
                badge.style.display = 'inline-block';
            }

            // (Opsional) tampilkan SweetAlert
            Swal.fire({
                title: 'Tugas Baru dari Admin!',
                text: `${event.adminName} menugaskan kamu untuk booking #${event.booking.id}`,
                icon: 'info',
                timer: 4000,
                showConfirmButton: false,
            });
        });
}
