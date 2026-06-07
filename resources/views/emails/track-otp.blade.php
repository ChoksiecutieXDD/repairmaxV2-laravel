<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Verify Your Repair Tracking Request</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .wrapper {
            width: 100%;
            background-color: #f8fafc;
            padding: 40px 0;
        }
        .container {
            max-width: 550px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        .header {
            background-color: #0f172a;
            padding: 30px;
            text-align: center;
        }
        .body {
            padding: 40px 30px;
            text-align: center;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 700;
            letter-spacing: 6px;
            color: #2563eb;
            background-color: #f1f5f9;
            padding: 15px 20px;
            border-radius: 8px;
            display: inline-block;
            margin: 25px 0;
            font-family: monospace;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <img src="{{ url('img/logo-r-white.png') }}" alt="Repairmax" style="height: 35px; display: inline-block;">
            </div>
            <div class="body">
                <h2 style="margin-top: 0; color: #0f172a; font-size: 20px;">Verify Your Repair Status Request</h2>
                <p style="color: #475569; font-size: 15px; margin-bottom: 20px;">
                    We received a request to check the repair status of ticket <strong>{{ $ticketId }}</strong>.
                </p>
                <p style="color: #475569; font-size: 15px;">
                    Please enter the following 6-digit verification code to view the live status report:
                </p>
                <div class="otp-code">{{ $otp }}</div>
                <p style="color: #64748b; font-size: 13px; margin-top: 25px;">
                    This code will expire in 10 minutes. If you did not request this code, you can safely ignore this email.
                </p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Repairmax. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
