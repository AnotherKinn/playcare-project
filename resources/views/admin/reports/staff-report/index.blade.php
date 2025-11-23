<x-app-layout>
    <div class="container py-4">
        <h3 class="fw-bold text-primary mb-4">📋 Laporan Staff</h3>

        <!-- Desktop Table -->
        <div class="table-responsive d-none d-md-block">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Staff</th>
                        <th>Nama Anak</th>
                        <th>Tanggal</th>
                        <th>Kondisi Anak</th>
                        <th>Makanan</th>
                        <th>Durasi Tidur</th>
                        <th>Catatan</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($childReport as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->staff->name ?? '-' }}</td>
                            <td>{{ $report->booking->child->name ?? '-' }}</td>
                            <td>{{ $report->created_at->format('d M Y') }}</td>
                            <td>{{ ucfirst($report->activities) ?? '-' }}</td>
                            <td>{{ ucfirst($report->meals) ?? '-' }}</td>
                            <td>{{ ucfirst($report->sleep) ?? '-' }}</td>
                            <td>{{ ucfirst($report->notes) ?? '-' }}</td>
                            {{-- <td>
                                <span class="badge
                                    @if($report->status === 'CP') bg-success
                                    @elseif($report->status === 'NF') bg-warning
                                    @elseif($report->status === 'PR') bg-secondary
                                    @else bg-info @endif
                                ">
                                    {{ $report->status_label }}
                                </span>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">No staff reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card -->
        <div class="d-block d-md-none">
            @forelse($childReport as $index => $report)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $index + 1 }} {{ $report->booking->child_name ?? '-' }}</h5>
                        <p><strong>Nama Staff:</strong> {{ $report->staff->name ?? '-' }}</p>
                        <p><strong>Tanggal:</strong> {{ $report->created_at->format('d M Y') }}</p>
                        <p><strong>Kondisi:</strong> {{ $report->child_condition_label }}</p>
                        <p><strong>Makanan:</strong> {{ $report->meal ?? '-' }}</p>
                        <p><strong>Durasi Tidur:</strong> {{ $report->sleep_duration ?? '-' }}</p>
                        <p><strong>Catatan:</strong> {{ $report->notes ?? '-' }}</p>
                       {{-- <p><strong>Status:</strong> {{ $report->status_label }}</p> --}}
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No staff reports found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
