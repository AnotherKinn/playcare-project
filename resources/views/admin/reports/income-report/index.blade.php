<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-success mb-4">💰 Laporan Keuangan</h3>

        @php
            $dummyTransaksi = [
                ['tanggal'=>'2025-10-20','parent'=>'Sari','layanan'=>'Daycare Full Day','jumlah'=>150000,'status'=>'Lunas'],
                ['tanggal'=>'2025-10-21','parent'=>'Budi','layanan'=>'Daycare Half Day','jumlah'=>80000,'status'=>'Lunas'],
                ['tanggal'=>'2025-10-22','parent'=>'Tina','layanan'=>'Playground','jumlah'=>120000,'status'=>'Lunas'],
                ['tanggal'=>'2025-10-23','parent'=>'Rani','layanan'=>'Daycare Full Day','jumlah'=>150000,'status'=>'Belum Lunas'],
            ];
        @endphp

        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Parent</th>
                        <th>Layanan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dummyTransaksi as $index => $trx)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $trx['tanggal'] }}</td>
                            <td>{{ $trx['parent'] }}</td>
                            <td>{{ $trx['layanan'] }}</td>
                            <td>Rp{{ number_format($trx['jumlah']) }}</td>
                            <td>{{ $trx['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card -->
        <div class="d-block d-md-none">
            @foreach($dummyTransaksi as $index => $trx)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $index + 1 }} {{ $trx['parent'] }}</h5>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $trx['tanggal'] }}</p>
                        <p class="mb-1"><strong>Layanan:</strong> {{ $trx['layanan'] }}</p>
                        <p class="mb-1"><strong>Jumlah:</strong> Rp{{ number_format($trx['jumlah']) }}</p>
                        <p class="mb-0"><strong>Status:</strong> {{ $trx['status'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
