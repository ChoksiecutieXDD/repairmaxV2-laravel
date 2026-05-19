<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #3b82f6;
            margin: 0;
        }
        .tracking-box {
            background-color: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .tracking-box .label {
            color: #666;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .tracking-box .code {
            font-size: 24px;
            color: #3b82f6;
            font-weight: bold;
            margin-top: 5px;
            font-family: monospace;
        }
        .section {
            margin: 25px 0;
        }
        .section h2 {
            color: #3b82f6;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }
        .info-row {
            margin: 12px 0;
            display: flex;
            justify-content: space-between;
        }
        .info-label {
            font-weight: bold;
            color: #555;
            min-width: 150px;
        }
        .info-value {
            color: #333;
        }
        .next-steps {
            background-color: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
        }
        .next-steps h3 {
            color: #16a34a;
            margin-top: 0;
        }
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin: 8px 0;
        }
        .cta-button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            text-align: center;
        }
        .cta-button:hover {
            background-color: #2563eb;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 12px;
        }
        .contact-info {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📋 Booking Confirmation</h1>
            <p style="color: #666; margin: 10px 0;">Thank you for your repair appointment booking!</p>
        </div>

        <!-- Welcome Message -->
        <p>Hi {{ $firstName }}!</p>
        <p>Thank you for choosing us for your repair needs. We have received your booking request and we're now preparing your appointment. Our team will contact you soon to confirm all the details.</p>

        <!-- Tracking Code -->
        <div class="tracking-box">
            <div class="label">Your Tracking Code</div>
            <div class="code">{{ $trackingCode }}</div>
            <p style="margin: 10px 0; color: #666; font-size: 12px;">Use this code to check your repair status anytime</p>
        </div>

        <!-- Appointment Details -->
        <div class="section">
            <h2>📱 Device Information</h2>
            <div class="info-row">
                <span class="info-label">Brand:</span>
                <span class="info-value">{{ $deviceBrand }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Model:</span>
                <span class="info-value">{{ $deviceModel }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Issue Type:</span>
                <span class="info-value">{{ $faultCategory }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Description:</span>
                <span class="info-value">{{ Str::limit($description, 100) }}</span>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="next-steps">
            <h3>✅ What Happens Next</h3>
            <ul>
                <li><strong>We'll Contact You:</strong> Our team will reach out within 24 hours to confirm your appointment details and provide you with an initial quote.</li>
                <li><strong>Professional Repair:</strong> We'll work quickly and professionally to fix your device with quality workmanship.</li>
                <li><strong>Regular Updates:</strong> We'll keep you informed with regular updates about your repair status throughout the process.</li>
            </ul>
        </div>

        <!-- Track Status -->
        <div style="text-align: center;">
            <p style="color: #666;">You can check the real-time status of your repair here:</p>
            <a href="{{ url('/help/track?ticket_id=' . $trackingCode . '&email=' . $email) }}" class="cta-button">
                👁️ Track Your Repair Status
            </a>
        </div>

        <!-- Contact Information -->
        <div class="section">
            <h2>📞 Contact Us</h2>
            <p>If you have any questions or need assistance:</p>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value"><a href="mailto:repairmaxsample@gmail.com">repairmaxsample@gmail.com</a></span>
            </div>
            <div class="info-row">
                <span class="info-label">Visit:</span>
                <span class="info-value"><a href="{{ url('/help/contact') }}">Kontakin kami</a></span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for choosing Repairmax!</strong></p>
            <div class="contact-info">
                Repairmax Support Team<br>
                <a href="{{ url('/') }}">{{ url('/') }}</a>
            </div>
            <p style="margin-top: 15px; color: #999;">© {{ date('Y') }} Repairmax. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
