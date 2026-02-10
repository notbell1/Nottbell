<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; }
        .wrapper { padding: 40px 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .header { background: linear-gradient(135deg, #0891b2 0%, #2563eb 100%); padding: 40px 30px; text-align: center; color: white; }
        .content { padding: 40px 30px; color: #334155; }
        .field-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 4px; font-weight: bold; }
        .field-value { font-size: 16px; color: #1e293b; margin-bottom: 25px; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; }
        .message-box { background: #f8fafc; padding: 25px; border-radius: 15px; border-left: 4px solid #0891b2; color: #475569; line-height: 1.6; margin-top: 10px; }
        .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h2 style="margin:0; font-size: 24px;">New Message Received</h2>
                <p style="margin: 5px 0 0 0; opacity: 0.8; font-size: 14px;">Incoming Inquiry from Portfolio Website</p>
            </div>
            <div class="content">
                <div class="field-label">Sender Name</div>
                <div class="field-value"><strong>{{ $data['name'] }}</strong></div>

                <div class="field-label">Email Address</div>
                <div class="field-value">{{ $data['email'] }}</div>

                <div class="field-label">Subject</div>
                <div class="field-value">{{ $data['subject'] }}</div>

                <div class="field-label">Message Details</div>
                <div class="message-box">
                    {{ $data['message'] }}
                </div>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} <strong>Nottbell Portfolio</strong>. This is an automated notification.
            </div>
        </div>
    </div>
</body>
</html>
