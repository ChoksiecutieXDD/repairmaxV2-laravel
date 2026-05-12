<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $appointment->tracking_code }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }

        .receipt-title {
            font-size: 32px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .receipt-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin: 5px 0;
        }

        .receipt-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section h3 {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .info-section p {
            font-size: 14px;
            color: #1f2937;
            line-height: 1.6;
            margin: 4px 0;
        }

        .info-label {
            color: #6b7280;
            font-weight: 500;
        }

        .device-details {
            background-color: #f9fafb;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 4px;
        }

        .device-details h3 {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .device-info {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 15px;
        }

        .device-info div {
            font-size: 14px;
            color: #1f2937;
        }

        .device-info span.label {
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }

        .description {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .description span.label {
            font-size: 12px;
            color: #9ca3af;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 8px;
        }

        .description p {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.6;
        }

        .pricing-section {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        .pricing-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .pricing-row.total {
            border-top: 2px solid #e5e7eb;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: 600;
            font-size: 18px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 20px;
        }

        .status-completed {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .receipt-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }

        @media print {
            body {
                background-color: #ffffff;
                padding: 0;
            }
            .receipt-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <div class="receipt-title">📧 Service Receipt</div>
            <div class="receipt-subtitle">RepairMax Device Repair Service</div>
            <div class="receipt-subtitle">Receipt ID: {{ $appointment->tracking_code }}</div>
        </div>

        <div class="receipt-info">
            <div class="info-section">
                <h3>Customer Information</h3>
                <p><span class="info-label">Name:</span> {{ $user->first_name }} {{ $user->last_name }}</p>
                <p><span class="info-label">Email:</span> {{ $user->email }}</p>
                <p><span class="info-label">Phone:</span> {{ $user->phone ?? 'N/A' }}</p>
                <p><span class="info-label">Address:</span> {{ $user->address ?? 'N/A' }}, {{ $user->city ?? '' }}</p>
            </div>

            <div class="info-section">
                <h3>Service Details</h3>
                <p><span class="info-label">Service Date:</span> {{ \Carbon\Carbon::parse($appointment->pref_date)->format('M d, Y') }}</p>
                <p><span class="info-label">Service Time:</span> {{ \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') }}</p>
                <p><span class="info-label">Status:</span> <strong>{{ $appointment->status }}</strong></p>
                <p><span class="info-label">Receipt Date:</span> {{ now()->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="device-details">
            <h3>Device Information</h3>
            <div class="device-info">
                <div>
                    <span class="label">Brand</span>
                    {{ $appointment->device_brand ?? 'N/A' }}
                </div>
                <div>
                    <span class="label">Model</span>
                    {{ $appointment->device_model ?? 'N/A' }}
                </div>
                <div>
                    <span class="label">Issue Category</span>
                    {{ $appointment->fault_category ?? 'N/A' }}
                </div>
            </div>

            @if($appointment->description)
            <div class="description">
                <span class="label">Issue Description</span>
                <p>{{ $appointment->description }}</p>
            </div>
            @endif
        </div>

        <div class="pricing-section">
            <div class="pricing-row">
                <span>Service Charge</span>
                <span>₱0.00</span>
            </div>
            <div class="pricing-row">
                <span>Parts & Materials</span>
                <span>₱0.00</span>
            </div>
            <div class="pricing-row">
                <span>Labor</span>
                <span>₱0.00</span>
            </div>
            <div class="pricing-row total">
                <span>Total Amount</span>
                <span>₱{{ number_format($appointment->quote ?? 0, 2) }}</span>
            </div>
        </div>

        <div style="text-align: center;">
            <span class="status-badge status-completed">✓ RECEIPT ISSUED</span>
        </div>

        <div class="receipt-footer">
            <p>Thank you for choosing RepairMax. For any inquiries, please contact us at repairmaxsample@gmail.com</p>
            <p style="margin-top: 10px;">This is an electronically generated receipt. No signature is required.</p>
        </div>
    </div>
</body>
</html>
