<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Reset Your Password</title>
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
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #212529;
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
            color: #212529;
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
            background-color: #212529;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 16px;
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
                <h2>Password Reset Request</h2>

                <p>Hello,</p>

                <p>We received a request to reset the password for your Repairmax account. If you made this request, click the button below to securely set a new password.</p>

                <div class="button-wrapper">
                    <a href="{{ $resetLink }}" class="button">Reset Password</a>
                </div>

                <p>This link will expire in a few hours. If you did not request a password reset, you can safely ignore this email and your account will remain secure.</p>

                <p style="margin-bottom: 0;">Best regards,<br><strong>The Repairmax Team</strong></p>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Repairmax. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>