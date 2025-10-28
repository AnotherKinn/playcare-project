<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📋 Laporan Staff</h3>

        @php
            $dummyStaffReports = [
                ['staff'=>'Dian', 'anak'=>'Alya', 'tanggal'=>'2025-10-20', 'catatan'=>'Aktif bermain', 'status'=>'Selesai'],
                ['staff'=>'Rina', 'anak'=>'Bimo', 'tanggal'=>'2025-10-21', 'catatan'=>'Sedikit rewel', 'status'=>'Perlu Tindak Lanjut'],
                ['staff'=>'Dian', 'anak'=>'Cahya', 'tanggal'=>'2025-10-22', 'catatan'=>'Tidur siang nyaman', 'status'=>'Selesai'],
                ['staff'=>'Tina', 'anak'=>'Daffa', 'tanggal'=>'2025-10-23', 'catatan'=>'Senang belajar lagu', 'status'=>'Selesai'],
                ['staff'=>'Rina', 'anak'=>'Eka', 'tanggal'=>'2025-10-24', 'catatan'=>'Perlu perhatian ekstra', 'status'=>'Perlu Tindak Lanjut'],
            ];
        @endphp

        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Staff</th>
                        <th>Anak</th>
                        <th>Tanggal</th>
                        <th>Kondisi / Catatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dummyStaffReports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report['staff'] }}</td>
                            <td>{{ $report['anak'] }}</td>
                            <td>{{ $report['tanggal'] }}</td>
                            <td>{{ $report['catatan'] }}</td>
                            <td>{{ $report['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card -->
        <div class="d-block d-md-none">
            @foreach($dummyStaffReports as $index => $report)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $index + 1 }} {{ $report['anak'] }}</h5>
                        <p class="mb-1"><strong>Staff:</strong> {{ $report['staff'] }}</p>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $report['tanggal'] }}</p>
                        <p class="mb-1"><strong>Catatan:</strong> {{ $report['catatan'] }}</p>
                        <p class="mb-0"><strong>Status:</strong> {{ $report['status'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
