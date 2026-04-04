<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.user')]
#[Title('Appointment History | Repairmax')]
class AppointmentHistory extends Component
{
    use WithPagination;

    protected $listeners = ['appointmentCompleted' => 'refreshHistory'];

    public function refreshHistory()
    {
        $this->resetPage();
    }

    public function mount()
    {
        // Enable real-time polling - refresh every 3 seconds
        $this->dispatch('refresh')->self();
    }

    public function exportRecords()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get all completed appointments (case-insensitive)
        $appointments = $user->appointments()
            ->whereRaw('LOWER(status) IN (?, ?)', ['completed', 'cancelled'])
            ->orderBy('completed_at', 'desc')
            ->get();

        // Generate CSV content
        $csv = $this->generateCsvExport($appointments);

        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'repair-history-' . date('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="repair-history.csv"',
        ]);
    }

    private function generateCsvExport($appointments)
    {
        $output = fopen('php://temp', 'r+');

        // CSV headers
        fputcsv($output, [
            'Tracking Code',
            'Device',
            'Issue Category',
            'Status',
            'Service Date',
            'Quote',
            'Final Cost',
            'Invoice Number',
            'Completed Date'
        ]);

        // CSV data
        foreach ($appointments as $appointment) {
            fputcsv($output, [
                $appointment->tracking_code,
                $appointment->device_brand . ' ' . $appointment->device_model,
                $appointment->fault_category,
                $appointment->status,
                $appointment->pref_date->format('M d, Y'),
                '₱' . number_format($appointment->quote ?? 0, 2),
                '₱' . number_format($appointment->final_cost ?? 0, 2),
                $appointment->invoice_number ?? 'N/A',
                $appointment->completed_at ? $appointment->completed_at->format('M d, Y') : 'N/A'
            ]);
        }

        rewind($output);
        return stream_get_contents($output);
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get Completed or Cancelled appointments with pagination
        // Using case-insensitive comparison for status
        $history = $user->appointments()
            ->whereRaw('LOWER(status) IN (?, ?)', ['completed', 'cancelled'])
            ->latest()
            ->paginate(10);

        return view('livewire.user.appointment-history', [
            'history' => $history
        ]);
    }
}

