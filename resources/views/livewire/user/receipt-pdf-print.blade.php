<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type == 'invoice' ? 'Invoice' : 'Receipt' }} - {{ $appointment->tracking_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f2937;
            line-height: 1.6;
            background: #fff;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px;
            background: white;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1f2937;
        }

        .logo-section {
            margin-bottom: 15px;
        }

        .company-name {
            font-size: 32px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .doc-type {
            font-size: 18px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .doc-number {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 8px;
        }

        .info-section {
            margin-bottom: 35px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .info-block {
            font-size: 13px;
        }

        .info-label {
            font-weight: bold;
            color: #374151;
            margin-bottom: 3px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            color: #1f2937;
            margin-bottom: 8px;
        }

        .device-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #374151;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .device-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .device-item {
            font-size: 13px;
        }

        .device-label {
            color: #6b7280;
            font-size: 11px;
            margin-bottom: 3px;
        }

        .device-value {
            color: #1f2937;
            font-weight: bold;
        }

        .description-section {
            background: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 13px;
            line-height: 1.6;
        }

        .description-section .section-title {
            margin-bottom: 8px;
        }

        .description-text {
            color: #1f2937;
        }

        .totals-section {
            margin-bottom: 30px;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .totals-table tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .totals-table td {
            padding: 10px 0;
        }

        .totals-table .label {
            text-align: right;
            padding-right: 20px;
            color: #6b7280;
        }

        .totals-table .value {
            text-align: right;
            font-weight: bold;
            color: #1f2937;
        }

        .totals-table .total-row {
            background: #1f2937;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .totals-table .total-row .label,
        .totals-table .total-row .value {
            color: white;
            padding: 12px 0;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 11px;
            color: #6b7280;
        }

        .footer-text {
            margin: 5px 0;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 100%;
                padding: 20px;
            }
        }

        .notes-section {
            background: #fef3c7;
            padding: 15px;
            border-left: 4px solid #f59e0b;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .notes-label {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 5px;
        }

        .notes-text {
            color: #78350f;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <div class="company-name">RepairMax</div>
                <div class="doc-type">{{ $type == 'invoice' ? 'INVOICE' : 'SERVICE RECEIPT' }}</div>
                <div class="doc-number">
                    #{{ $type == 'invoice' ? ($appointment->invoice_number ?? 'N/A') : $appointment->tracking_code }}
                </div>
            </div>
        </div>

        <!-- Status Badge -->
        @if($appointment->status == 'Completed')
            <div class="status-badge status-completed">✓ Completed</div>
        @elseif($appointment->status == 'Cancelled')
            <div class="status-badge status-cancelled">✗ Cancelled</div>
        @endif

        <!-- Customer & appointment Info -->
        <div class="info-section">
            <div>
                <div class="info-block">
                    <div class="info-label">Customer Name</div>
                    <div class="info-value">{{ $user->first_name }} {{ $user->last_name }}</div>
                </div>
                <div class="info-block">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
                <div class="info-block">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">{{ $user->phone }}</div>
                </div>
            </div>
            <div>
                <div class="info-block">
                    <div class="info-label">Service ID / Tracking Code</div>
                    <div class="info-value">{{ $appointment->tracking_code }}</div>
                </div>
                <div class="info-block">
                    <div class="info-label">Service Date</div>
                    <div class="info-value">{{ $appointment->pref_date->format('M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') }}</div>
                </div>
                @if($appointment->completed_at)
                <div class="info-block">
                    <div class="info-label">Completed Date</div>
                    <div class="info-value">{{ $appointment->completed_at->format('M d, Y') }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Device Information -->
        <div class="device-section">
            <div class="section-title">Device Information</div>
            <div class="device-grid">
                <div class="device-item">
                    <div class="device-label">Brand</div>
                    <div class="device-value">{{ $appointment->device_brand }}</div>
                </div>
                <div class="device-item">
                    <div class="device-label">Model</div>
                    <div class="device-value">{{ $appointment->device_model }}</div>
                </div>
                <div class="device-item">
                    <div class="device-label">Issue Category</div>
                    <div class="device-value">{{ $appointment->fault_category }}</div>
                </div>
                <div class="device-item">
                    <div class="device-label">Status</div>
                    <div class="device-value">{{ $appointment->status }}</div>
                </div>
            </div>
        </div>

        <!-- Description -->
        @if($appointment->description)
        <div class="description-section">
            <div class="section-title">Service Description</div>
            <div class="description-text">{{ $appointment->description }}</div>
        </div>
        @endif

        <!-- Completion Notes (for invoices) -->
        @if($type == 'invoice' && $appointment->completion_notes)
        <div class="notes-section">
            <div class="notes-label">Technician Notes</div>
            <div class="notes-text">{{ $appointment->completion_notes }}</div>
        </div>
        @endif

        <!-- Totals -->
        @if($appointment->status == 'Completed')
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td class="label">Estimated Quote:</td>
                    <td class="value">₱{{ number_format($appointment->quote ?? 0, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Final Service Cost:</td>
                    <td class="value">₱{{ number_format($appointment->final_cost ?? $appointment->quote ?? 0, 2) }}</td>
                </tr>
                @if($appointment->final_cost != $appointment->quote && $appointment->quote)
                <tr>
                    <td class="label">Adjustment:</td>
                    <td class="value">₱{{ number_format(($appointment->final_cost ?? 0) - ($appointment->quote ?? 0), 2) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td class="label">TOTAL AMOUNT DUE:</td>
                    <td class="value">₱{{ number_format($appointment->final_cost ?? $appointment->quote ?? 0, 2) }}</td>
                </tr>
            </table>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div class="footer-text">Thank you for choosing RepairMax for your device repair needs!</div>
            <div class="footer-text">Document generated on {{ now()->format('M d, Y \a\t h:i A') }}</div>
            <div class="footer-text" style="margin-top: 15px; color: #d1d5db;">
                This {{ $type }} is electronically generated and valid without signature.
            </div>
        </div>
    </div>

    <script>
        // Auto-print if opened in a new window/tab
        if (window.location.pathname.includes('print') || window.opener) {
            window.print();
        }
    </script>
</body>
</html>
