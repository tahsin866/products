<!DOCTYPE html>
<html lang="bn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'SolaimanLipi', 'arabic';
            src: url({{ storage_path('fonts/SolaimanLipi.ttf', 'fonts/arabic.ttf') }}) format('truetype');

        }


        body {
            font-family: 'SolaimanLipi', sans-serif;
            font-family: 'arabic', sans-serif;
            font-family: 'Courier New', Courier, monospace;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1f2937;
            padding-bottom: 20px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 18px;
            color: #4b5563;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            padding: 8px;
            font-weight: bold;
            color: #4b5563;
            width: 35%;
            background: #f9fafb;
        }

        .info-value {
            display: table-cell;
            padding: 8px;
            color: #1f2937;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .results-table th, .results-table td {
            border: 1px solid #e5e7eb;
            padding: 10px;
            text-align: center;
        }

        .results-table th {
            background: #f3f4f6;
            color: #1f2937;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
        <div class="title">মাদরাসা শিক্ষার্থী বিবরণী</div>
        <div class="subtitle">শিক্ষাবর্ষ: {{ $studentDetails->years }}</div>
    </div>

    <div class="section">
        <div class="section-title">ব্যক্তিগত তথ্য</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">নাম (আরবি)</div>
                <div class="info-value">{{ $studentDetails->Name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">নাম (ইংরেজি)</div>
                <div class="info-value">{{ $studentDetails->st_en_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">পিতার নাম (আরবি)</div>
                <div class="info-value">{{ $studentDetails->Father }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">রোল নম্বর</div>
                <div class="info-value">{{ $studentDetails->Roll }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">রেজিস্ট্রেশন নম্বর</div>
                <div class="info-value">{{ $studentDetails->reg_id }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">জন্ম তারিখ</div>
                <div class="info-value">{{ $studentDetails->DateofBirth }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">মোবাইল নম্বর</div>
                <div class="info-value">{{ $studentDetails->mobileNumber }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">ফলাফল বিবরণী</div>
        <table class="results-table">
            <thead>
                <tr>
                    <th>বিষয়</th>
                    <th>পূর্ণ নম্বর</th>
                    <th>প্রাপ্ত নম্বর</th>
                    <th>বিভাগ</th>
                </tr>
            </thead>
            <tbody>
               <!-- Replace the current foreach loop with this conditional version -->
@if(isset($studentDetails->results) && !empty($studentDetails->results))
@foreach($studentDetails->results as $result)
<tr>
    <td>{{ $result->subject }}</td>
    <td>100</td>
    <td>{{ $result->marks }}</td>
    <td>{{ $result->grade }}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="4">No results available</td>
</tr>
@endif

            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>এই ডকুমেন্টটি কম্পিউটার জেনারেটেড এবং কোন স্বাক্ষরের প্রয়োজন নেই</p>
    </div>
</body>
</html>
