<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Your Appointment Details - Repairmax</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Outfit', ui-sans-serif, system-ui, sans-serif;
            background-color: #F8FAFC;
            color: #1E293B;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .email-wrapper {
            width: 100%;
            background-color: #F8FAFC;
            padding: 40px 0;
        }

        .email-content {
            max-width: 950px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        }

        .header {
            background-color: #0F172A;
            padding: 35px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .body {
            padding: 40px;
        }

        .welcome-title {
            margin-top: 0;
            font-size: 22px;
            font-weight: 600;
            color: #0F172A;
        }

        .intro-text {
            color: #475569;
            font-size: 16px;
            margin-bottom: 24px;
        }

        /* Tracking Code Banner */
        .tracking-card {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            border: 1px solid #BFDBFE;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .tracking-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1D4ED8;
            margin-bottom: 6px;
        }

        .tracking-code {
            font-size: 24px;
            font-weight: 700;
            color: #1E3A8A;
            letter-spacing: 0.5px;
            margin: 0;
        }

        /* Details Grid */
        .details-section {
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 30px;
            background-color: #FAFAFA;
        }

        .details-title {
            font-size: 18px;
            font-weight: 700;
            color: #0F172A;
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 12px;
        }

        .detail-card {
            background-color: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .detail-label {
            font-weight: 600;
            color: #64748B;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .detail-value {
            color: #0F172A;
            font-weight: 700;
            font-size: 16px;
        }

        /* Attention Box */
        .attention-box {
            background-color: #FEF3C7;
            border-left: 4px solid #D97706;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 30px;
        }

        .attention-title {
            color: #92400E;
            font-weight: 700;
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 6px;
        }

        .attention-text {
            color: #B45309;
            font-size: 13px;
            margin: 0;
            line-height: 1.5;
        }

        .button-wrapper {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            background-color: #2563EB;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
            transition: all 0.2s ease;
        }

        .footer {
            background-color: #F8FAFC;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #E2E8F0;
        }

        .footer p {
            color: #64748B;
            font-size: 13px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <h1>Repairmax.</h1>
            </div>

            <div class="body">
                <h2 class="welcome-title">Hi {{ $appointment->user->first_name }},</h2>
                <p class="intro-text">Thank you for booking with Repairmax. We have received your repair request and it is now active in our system.</p>

                <div class="tracking-card">
                    <div style="text-align: center; padding: 10px 0;">
                        <div class="tracking-label" style="margin-bottom: 6px;">Booking No.</div>
                        <div style="font-size: 22px; font-weight: 700; color: #1E3A8A; letter-spacing: 0.5px; margin: 0;">{{ $appointment->booking_number ?? 'N/A' }}</div>
                    </div>
                </div>

                <div class="details-section">
                    <h3 class="details-title">Appointment Summary</h3>
                    
                    <table width="100%" cellpadding="0" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td width="48%" style="vertical-align: top;">
                                <div class="detail-card">
                                    <div class="detail-label">Device Brand</div>
                                    <div class="detail-value">{{ $appointment->device_brand }}</div>
                                </div>
                                <div class="detail-card">
                                    <div class="detail-label">Device Model</div>
                                    <div class="detail-value">{{ $appointment->device_model }}</div>
                                </div>
                                <div class="detail-card">
                                    <div class="detail-label">Service Type</div>
                                    <div class="detail-value">{{ $appointment->fault_category }}</div>
                                </div>
                            </td>
                            <td width="4%"></td>
                            <td width="48%" style="vertical-align: top;">
                                <div class="detail-card">
                                    <div class="detail-label">Preferred Date</div>
                                    <div class="detail-value">{{ date('l, F j, Y', strtotime($appointment->pref_date)) }}</div>
                                </div>
                                <div class="detail-card">
                                    <div class="detail-label">Preferred Time</div>
                                    <div class="detail-value">{{ date('h:i A', strtotime($appointment->pref_time)) }}</div>
                                </div>
                                <div class="detail-card">
                                    <div class="detail-label">Service Method</div>
                                    <div class="detail-value">
                                        {{ str_contains($appointment->description, 'Home Pickup & Return') ? 'Home Pickup & Return' : 'Drop-off at Shop' }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="attention-box">
                    <h4 class="attention-title">⚠️ IMPORTANT INSTRUCTIONS</h4>
                    <p class="attention-text">
                        Please keep your email address active and check your inbox regularly (including your Spam/Junk folder). We will send real-time status updates and repair progress directly to this email. Our support team will reach out to you shortly to finalize your service.
                    </p>
                </div>

                <div class="button-wrapper">
                    <a href="{{ url('/help/track?ticket_id=' . $appointment->tracking_code . '&email=' . urlencode($appointment->user->email)) }}" class="button">Track Repair Live Status</a>
                </div>

                <p class="intro-text" style="margin-bottom: 0;">Warm regards,<br><strong>The Repairmax Team</strong></p>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Repairmax. All rights reserved.</p>
                <p style="margin-top: 4px; font-size: 11px;">You are receiving this email because you submitted a booking request on our platform.</p>
            </div>
        </div>
    </div>
</body>

</html>
