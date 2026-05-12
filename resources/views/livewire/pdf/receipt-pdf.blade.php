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
            font-family: 'Arial', sans-serif;
            color: #1f2937;
            line-height: 1.6;
        }

        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 20px;
        }

        .receipt-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .receipt-subtitle {
            font-size: 12px;
            color: #6b7280;
            margin: 5px 0;
        }

        .receipt-info {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
        }

        .info-section {
            flex: 1;
        }

        .info-section h3 {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-section p {
            font-size: 12px;
            margin-bottom: 4px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 80px;
        }

        .device-details {
            background-color: #f9fafb;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin-bottom: 30px;
        }

        .device-details h3 {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .device-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .device-info-col {
            flex: 1;
        }

        .device-info-col span {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
        }

        .description {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .description span {
            font-size: 10px;
            color: #9ca3af;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        .description p {
            font-size: 12px;
            color: #4b5563;
        }

        .pricing-section {
            background-color: #f9fafb;
            padding: 15px;
            margin-bottom: 30px;
        }

        .pricing-row {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .pricing-row.total {
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 8px;
        }

        .status-badge {
            text-align: center;
            padding: 8px 12px;
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
        }

        .receipt-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #9ca3af;
            font-size: 10px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <div class="receipt-title">SERVICE RECEIPT</div>
            <div class="receipt-subtitle">RepairMax Device Repair Service</div>
            <div class="receipt-subtitle">Receipt ID: {{ $appointment->tracking_code }}</div>
        </div>

        <div class="receipt-info">
            <div class="info-section">
                <h3>Customer Information</h3>
                <p><span class="info-label">Name:</span> {{ $user->first_name }} {{ $user->last_name }}</p>
                <p><span class="info-label">Email:</span> {{ $user->email }}</p>
                <p><span class="info-label">Phone:</span> {{ $user->phone ?? 'N/A' }}</p>
                <p><span class="info-label">Address:</span> {{ ($user->address ?? 'N/A') . ', ' . ($user->city ?? '') }}</p>
            </div>

            <div class="info-section">
                <h3>Service Details</h3>
                <p><span class="info-label">Date:</span> {{ \Carbon\Carbon::parse($appointment->pref_date)->format('M d, Y') }}</p>
                <p><span class="info-label">Time:</span> {{ \Carbon\Carbon::parse($appointment->pref_time)->format('h:i A') }}</p>
                <p><span class="info-label">Status:</span> <strong>{{ $appointment->status }}</strong></p>
                <p><span class="info-label">Issued:</span> {{ now()->format('M d, Y') }}</p>
            </div>
        </div>

        <div class="device-details">
            <h3>Device Information</h3>
            <div class="device-info-row">
                <div class="device-info-col">
                    <span>Brand</span>
                    {{ $appointment->device_brand ?? 'N/A' }}
                </div>
                <div class="device-info-col">
                    <span>Model</span>
                    {{ $appointment->device_model ?? 'N/A' }}
                </div>
                <div class="device-info-col">
                    <span>Issue</span>
                    {{ $appointment->fault_category ?? 'N/A' }}
                </div>
            </div>

            @if($appointment->description)
            <div class="description">
                <span>Issue Description</span>
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

        <div class="status-badge">✓ RECEIPT ISSUED</div>

        <div class="receipt-footer">
            <p>Thank you for choosing RepairMax.</p>
            <p>For inquiries, please contact: repairmaxsample@gmail.com</p>
            <p style="margin-top: 10px;">This is an electronically generated receipt.</p>
        </div>
    </div>
</body>
</html>
