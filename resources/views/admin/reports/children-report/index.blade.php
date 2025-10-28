<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-warning mb-4">📄 Laporan Kondisi Anak</h3>

        @php
            $dummyReports = [
                ['child'=>'Alya','staff'=>'Dian','booking_date'=>'2025-10-20','meals'=>'Sudah makan siang','sleep'=>'Tidur nyenyak','activities'=>'Bermain Lego','notes'=>'Senang dan aktif'],
                ['child'=>'Bimo','staff'=>'Rina','booking_date'=>'2025-10-21','meals'=>'Makan snack saja','sleep'=>'Tidur sebentar','activities'=>'Menggambar','notes'=>'Agak rewel'],
                ['child'=>'Cahya','staff'=>'Dian','booking_date'=>'2025-10-22','meals'=>'Sudah makan','sleep'=>'Tidur nyaman','activities'=>'Bermain puzzle','notes'=>'Fokus dan senang'],
                ['child'=>'Daffa','staff'=>'Tina','booking_date'=>'2025-10-23','meals'=>'Belum makan siang','sleep'=>'Tidur sebentar','activities'=>'Menyanyi lagu','notes'=>'Aktif dan ceria'],
                ['child'=>'Eka','staff'=>'Rina','booking_date'=>'2025-10-24','meals'=>'Makan dengan lancar','sleep'=>'Tidur nyaman','activities'=>'Menggambar dan mewarnai','notes'=>'Perlu perhatian ekstra'],
            ];
        @endphp

        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Anak</th>
                        <th>Staff</th>
                        <th>Tanggal Booking</th>
                        <th>Makan</th>
                        <th>Tidur</th>
                        <th>Kegiatan</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dummyReports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report['child'] }}</td>
                            <td>{{ $report['staff'] }}</td>
                            <td>{{ $report['booking_date'] }}</td>
                            <td>{{ $report['meals'] }}</td>
                            <td>{{ $report['sleep'] }}</td>
                            <td>{{ $report['activities'] }}</td>
                            <td>{{ $report['notes'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card -->
        <div class="d-block d-md-none">
            @foreach($dummyReports as $index => $report)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $index + 1 }} {{ $report['child'] }}</h5>
                        <p class="mb-1"><strong>Staff:</strong> {{ $report['staff'] }}</p>
                        <p class="mb-1"><strong>Tanggal Booking:</strong> {{ $report['booking_date'] }}</p>
                        <p class="mb-1"><strong>Makan:</strong> {{ $report['meals'] }}</p>
                        <p class="mb-1"><strong>Tidur:</strong> {{ $report['sleep'] }}</p>
                        <p class="mb-1"><strong>Kegiatan:</strong> {{ $report['activities'] }}</p>
                        <p class="mb-0"><strong>Catatan:</strong> {{ $report['notes'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
