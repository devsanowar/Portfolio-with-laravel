<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2c3e50;">🔔 New Contact Form Submission</h2>

        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Name:</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Email:</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><strong>{{ $data['email'] ?? 'N/A' }}</strong></td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Subject:</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['subject'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd; background: #f9f9f9;"><strong>Message:</strong></td>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $data['message'] ?? 'N/A' }}</td>
            </tr>
        </table>

        <p style="color: #7f8c8d; font-size: 14px;">
            Received on: {{ now()->format('F j, Y \a\t g:i A') }}
        </p>
    </div>
</body>
</html>
