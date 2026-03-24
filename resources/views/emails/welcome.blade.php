<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Welcome to Repairmax</title>
    <style>
        /* Import Roboto Font */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', ui-sans-serif, system-ui, sans-serif;
            background-color: #F8FAFC;
            /* brand-50 */
            color: #212529;
            /* brand-900 */
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .email-wrapper {
            width: 100%;
            background-color: #F8FAFC;
            /* brand-50 */
            padding: 40px 0;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #E9ECEF;
            /* brand-200 */
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #212529;
            /* brand-900 */
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
            /* brand-900 */
        }

        .body p {
            color: #495057;
            /* brand-700 */
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
            /* brand-900 */
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 16px;
        }

        .footer {
            background-color: #F8F9FA;
            /* brand-100 */
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #E9ECEF;
            /* brand-200 */
        }

        .footer p {
            color: #6C757D;
            /* brand-600 */
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
                <h2>Welcome to the platform, {{ $firstName }}!</h2>

                <p>Your account has been successfully created. We are thrilled to have you on board.</p>

                <p>With your new Repairmax account, you can easily track your device repairs, view active service tickets, and manage all your appointments in one place.</p>

                <div class="button-wrapper">
                    <a href="{{ url('/login') }}" class="button">Log in to your dashboard</a>
                </div>

                <p>If you have any questions or need assistance with a repair, our support team is always here to help.</p>

                <p style="margin-bottom: 0;">Best regards,<br><strong>The Repairmax Team</strong></p>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} Repairmax. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>