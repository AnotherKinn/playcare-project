<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { margin-bottom: 10px; color: #4b3ca7; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #999; padding: 6px; font-size: 11px; }
        th { background: #f2f2f2; }
        .summary { margin-top: 20px; }
        .summary div { margin-bottom: 5px; }
    </style>
</head>
<body>

    <h2>Laporan Keuangan</h2>
    <p><strong>Tanggal Export:</strong> {{ date('d M Y') }}</p>

    <div class="summary">
        <div><strong>Total Transaksi:</strong> {{ $transactions->count() }}</div>
        <div>
            <strong>Total Pendapatan:</strong>
            Rp {{ number_format($transactions->sum('amount'), 0, ',', '.') }}
        </div>
    </div>

    <h3>Data Transaksi</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Parent</th>
                <th>Nama Anak</th>
                <th>Total Harga Booking</th>
                <th>Jumlah Dibayar</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transactions as $i => $trx)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $trx->booking?->parent?->name ?? '-' }}</td>
                <td>{{ $trx->booking?->child?->name ?? '-' }}</td>
                <td>Rp {{ number_format($trx->booking?->total_price ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                <td>{{ ucfirst($trx->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->paid_at)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
