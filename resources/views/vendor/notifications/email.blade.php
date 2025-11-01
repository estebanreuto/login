<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Reset password</title>
</head>

<body style="background:#eef4f1; padding:40px; font-family:'Segoe UI', Arial, sans-serif;">

    <div style="
    max-width: 520px;
    margin:auto;
    background:#ffffff;
    padding:40px;
    border-radius:14px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.08);
    border:1px solid #e2e8e6;
">

        <!-- Logo o icono -->
        <div style="text-align:center; margin-bottom:25px;">
            <div style="
        width:80px;
        height:80px;
        background:linear-gradient(135deg,#38b000,#1a7403);
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        margin:0 auto 15px auto;
        box-shadow:0 4px 10px rgba(56,176,0,0.25);
    ">
            </div>

            <h2 style="
        font-size:22px;
        font-weight:700;
        color:#1a1a1a;
        margin:0 0 10px 0;
        text-align:center;
    ">
                Reset password
            </h2>

            <p style="color:#3a4b3d; font-size:15px; text-align:center; line-height:1.6;">
                We received a request to reset your password.
                Click the button to continue.
            </p>

            <div style="text-align:center; margin:30px 0;">
                <a href="{{ $actionUrl }}"
                    style="background:linear-gradient(135deg,#38b000,#1a7403); color:#fff; padding:14px 32px; border-radius:8px; text-decoration:none; font-weight:600; font-size:15px; display:inline-block; box-shadow:0 4px 12px rgba(56,176,0,0.35); transition:0.2s;">
                    Reset password
                </a>

            </div>

            <p style="font-size:14px; color:#5f6d61; text-align:center; line-height:1.5;">
                If you did not make this request, you can ignore this message.
            </p>

            <hr style="margin:30px 0; border:none; border-top:1px solid #dfe7e2;">

            <p style="font-size:12px; color:#7d8c82; text-align:center;">
                If the button doesn't work, open the following link:<br><br>
                <a href="{{ $actionUrl }}" style="color:#2a8c32; font-weight:600;">
                    {{ $actionUrl }}
                </a>
            </p>

        </div>

        <p style="text-align:center; color:#93a096; font-size:12px; margin-top:15px;">
            © {{ date('Y') }} — Security & Technology | All rights reserved
        </p>

</body>

</html>