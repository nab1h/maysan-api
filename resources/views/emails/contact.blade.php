<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .header {
            background: #135158;
            padding: 20px;
            text-align: center;
            color: #fff;
        }

        .content {
            padding: 30px;
        }

        .field {
            margin-bottom: 20px;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 15px;
        }

        .label {
            font-size: 12px;
            color: #9ca3af;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .value {
            font-size: 16px;
            color: #1f2937;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin:0;">رسالة جديدة من الموقع</h2>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">اسم المرسل</div>
                <div class="value">{{ $data['name'] }}</div>
            </div>
            <div class="field">
                <div class="label">البريد الإلكتروني</div>
                <div class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></div>
            </div>
            @if(isset($data['phone']))
            <div class="field">
                <div class="label">رقم الجوال</div>
                <div class="value">{{ $data['phone'] }}</div>
            </div>
            @endif
            <div class="field">
                <div class="label">الموضوع</div>
                <div class="value">{{ $data['subject'] ?? 'بدون موضوع' }}</div>
            </div>
            <div class="field" style="border-bottom: none;">
                <div class="label">نص الرسالة</div>
                <div class="value" style="background: #f9fafb; padding: 15px; border-radius: 8px; line-height: 1.8;">{{ $data['message'] }}</div>
            </div>
        </div>
        <div class="footer">
            تم إرسال هذه الرسالة من نموذج "اتصل بنا" في موقعك.
        </div>
    </div>
</body>

</html>
