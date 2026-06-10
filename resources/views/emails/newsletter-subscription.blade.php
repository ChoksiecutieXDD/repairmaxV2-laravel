<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Subscribed to Repairmax Newsletter</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', ui-sans-serif, system-ui, sans-serif;
            background-color: #F8FAFC;
            color: #212529;
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
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #E9ECEF;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .header {
            background-color: #020617;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .body {
            padding: 40px;
        }

        .body h2 {
            margin-top: 0;
            font-size: 20px;
            color: #020617;
        }

        .body p {
            color: #495057;
            font-size: 16px;
            margin-bottom: 24px;
        }

        .button-wrapper {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            background-color: #2563eb;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
        }

        .footer {
            background-color: #F8F9FA;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #E9ECEF;
        }

        .footer p {
            color: #6C757D;
            font-size: 14px;
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
                <h2>Thank you for subscribing!</h2>

                <p>We've successfully added your email (<strong>{{ $email }}</strong>) to our newsletter list.</p>

                <p>You'll now receive regular device maintenance tips, hardware advice, and updates about our latest repair services directly to your inbox.</p>

                <div class="button-wrapper">
                    <a href="{{ url('/') }}" class="button">Visit Our Website</a>
                </div>

                <p>If you did not sign up for this newsletter, please ignore this email or contact support.</p>

                <p style="margin-bottom: 0;">Best regards,<br><strong>The Repairmax Team</strong></p>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Repairmax. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
