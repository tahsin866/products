<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Student Certificate</title>
    <style>
        @font-face {
            font-family: 'XB Riyaz';
            src: url('{{ storage_path('fonts/XB-Riyaz.ttf') }}') format('truetype');
            font-weight: normal;
        }

        body {
            font-family: 'XB Riyaz', Arial;
            direction: rtl;
        }

        .arabic-text {
            font-family: 'XB Riyaz', Arial;
            text-align: right;
            font-size: 18px;
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <div class="arabic-text">
        {{ $studentDetails->Name }}
    </div>
    <div class="arabic-text">
        {{ $studentDetails->Roll }}
    </div>
    <div class="arabic-text">
        {{ $studentDetails->reg_id }}
    </div>
</body>
</html>
