<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }

        .header {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 30px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        .content {
            background-color: white;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }

        .field {
            margin-bottom: 20px;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 15px;
        }

        .field:last-child {
            border-bottom: none;
        }

        .label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 500;
        }

        .message-box {
            background-color: #f3f4f6;
            padding: 15px;
            border-left: 4px solid #1f2937;
            border-radius: 4px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Enquiry</h1>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">From Email</div>
                <div class="value">{{ $contactEmail ?? 'N/A' }}</div>
            </div>

            <div class="field">
                <div class="label">Subject</div>
                <div class="value">{{ $contactSubject ?? 'N/A' }}</div>
            </div>

            <div class="field">
                <div class="label">Message</div>
                <div class="message-box">{{ $contactMessage ?? 'No message provided' }}</div>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <p style="font-size: 13px; color: #6b7280;">
                    <strong>Submitted at:</strong> {{ now()->format('F j, Y g:i A') }}
                </p>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0;">This is an automated message from Repairmax Contact Form</p>
            <p style="margin: 5px 0 0 0;">Please reply directly to the sender's email address</p>
        </div>
    </div>
</body>

</html>