<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppointmentDownloadController extends Controller
{
    public function downloadReceipt(string $appointmentId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        $appointment = $user->appointments()->findOrFail($appointmentId);

        // Generate PDF from HTML template
        $html = View::make('livewire.pdf.receipt-pdf-print', [
            'appointment' => $appointment,
            'user' => $user,
            'type' => 'receipt'
        ])->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('receipt-' . $appointment->tracking_code . '.pdf');
    }

    public function downloadInvoice(string $appointmentId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        $appointment = $user->appointments()->findOrFail($appointmentId);

        // Generate PDF from HTML template
        $html = View::make('livewire.pdf.receipt-pdf-print', [
            'appointment' => $appointment,
            'user' => $user,
            'type' => 'invoice'
        ])->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('invoice-' . ($appointment->invoice_number ?? $appointment->tracking_code) . '.pdf');
    }

    public function viewReceipt(string $appointmentId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        $appointment = $user->appointments()->findOrFail($appointmentId);

        // Display receipt and invoice as HTML (not PDF)
        return View::make('livewire.pdf.receipt-and-invoice-view', [
            'appointment' => $appointment,
            'user' => $user,
        ]);
    }

    public function viewInvoice(string $appointmentId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            abort(401, 'Unauthorized');
        }

        $appointment = $user->appointments()->findOrFail($appointmentId);

        // Display receipt and invoice as HTML (not PDF)
        return View::make('livewire.pdf.receipt-and-invoice-view', [
            'appointment' => $appointment,
            'user' => $user,
        ]);
    }
}
