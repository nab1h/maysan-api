<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نجاح الدفع</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #1f2937;
        }

        .container {
            width: 100%;
            max-width: 520px;
            padding: 28px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
        }

        .success-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            border-radius: 50%;
            background: #eaf7ee;
            color: #28a745;
            font-size: 34px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 10px;
            color: #28a745;
            font-size: 28px;
        }

        p {
            margin: 0;
            color: #555;
            font-size: 18px;
            line-height: 1.7;
        }

        .transaction-box {
            margin-top: 22px;
            padding: 16px;
            border: 1px solid #dbeafe;
            border-radius: 8px;
            background: #f8fbff;
        }

        .transaction-label {
            display: block;
            margin-bottom: 8px;
            color: #4b5563;
            font-size: 15px;
        }

        .transaction-id {
            direction: ltr;
            unicode-bidi: bidi-override;
            display: block;
            margin-bottom: 12px;
            color: #111827;
            font-size: 20px;
            font-weight: bold;
            word-break: break-all;
        }

        .copy-button,
        .home-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border: 0;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .copy-button {
            background: #135158;
            color: #fff;
        }

        .home-link {
            margin-top: 20px;
            background: #f3f4f6;
            color: #374151;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="success-icon">✓</div>
    <h1>تمت عملية الدفع بنجاح</h1>
    <p>شكرًا لك على الدفع. سنقوم بمعالجة طلبك في أقرب وقت ممكن.</p>

    @if(!empty($transactionId))
        <div class="transaction-box">
            <span class="transaction-label">رقم العملية للاحتفاظ به عند المتابعة</span>
            <span id="transactionId" class="transaction-id">{{ $transactionId }}</span>
            <button type="button" class="copy-button" onclick="copyTransactionId()">نسخ رقم العملية</button>
        </div>
    @endif

    <a class="home-link" href="{{ route('home') }}">العودة للرئيسية</a>
</div>

<script>
    function copyTransactionId() {
        const element = document.getElementById('transactionId');
        if (!element || !navigator.clipboard) {
            return;
        }

        navigator.clipboard.writeText(element.textContent.trim());
    }
</script>
</body>
</html>
