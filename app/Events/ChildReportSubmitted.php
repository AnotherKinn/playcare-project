<?php

namespace App\Events;

use App\Models\Report;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ChildReportSubmitted implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $report;
    public $staffName;

    /**
     * Create a new event instance.
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
        $this->staffName = $report->staff->name ?? 'Staff Tidak Dikenal';
    }

    /**
     * Tentukan channel broadcast.
     */
    public function broadcastOn()
    {
        // Semua admin subscribe ke channel publik admin.notifications
        return new Channel('admin.notifications');
    }

    /**
     * Nama event saat diterima di sisi client (Echo).
     */
    public function broadcastAs()
    {
        return 'child.report.submitted';
    }

    /**
     * Data yang dikirim ke frontend.
     */
    public function broadcastWith()
    {
        return [
            'report_id' => $this->report->id,
            'child_name' => $this->report->child->name ?? 'Anak Tidak Dikenal',
            'staff_name' => $this->staffName,
            'created_at' => $this->report->created_at->toDateTimeString(),
        ];
    }
}
