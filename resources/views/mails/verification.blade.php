<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>کد ورود</title>
</head>
<body style="font-family: Tahoma, sans-serif; background:#f5f5f5; padding:30px;">

<div style="
    max-width:500px;
    margin:auto;
    background:#ffffff;
    border-radius:12px;
    padding:30px;
    text-align:center;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
">

    <h2 style="margin-bottom:20px;">
        کد ورود به حساب کاربری
    </h2>

    <p style="color:#666; line-height:1.8;">
        برای ورود به حساب کاربری خود از کد زیر استفاده کنید:
    </p>

    <div style="
        margin:25px 0;
        font-size:36px;
        font-weight:bold;
        letter-spacing:8px;
        color:#2563eb;
    ">
        {{ $otp }}
    </div>

    <p style="color:#888;">
        این کد تا ۲ دقیقه معتبر است.
    </p>

    <hr style="margin:25px 0; border:none; border-top:1px solid #eee;">

    <p style="font-size:13px; color:#999;">
        اگر شما درخواست ورود نداده‌اید، این پیام را نادیده بگیرید.
    </p>

</div>

</body>
</html>
