<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expanse report PDF</title>
</head>
<body>
    <h2 style="text-align: center;">Monthly Expanse Report</h2>
    <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%">
        <thead>
            <tr style="background-color: #0bb2d3; border: 1px solid #000">
                <td width="20%">Date</td>
                <td>Employee Name</td>
                <td>Amount</td>
                <td>Minute</td>
                <td>Purpose</td>
            </tr>
        </thead>
        <tbody>
            @php
                $sum = 0;
                $minute = 0
            @endphp
        @foreach($expanseReports as $report)
            <tr style="border: 1px solid #000;">
                <td style="border: 1px solid #000;">{{ date('d-m-Y', strtotime($report->created_at)) }}</td>
                <td style="border: 1px solid #000;">{{ $report->user->full_name ?? 'Admin' }}</td>
                <td style="border: 1px solid #000;">{{ $report->price ?? '' }}</td>
                <td style="border: 1px solid #000;">{{ $report->minute ?? '' }}</td>
                <td style="border: 1px solid #000;">{{ $report->note ?? '' }}</td>
            </tr>
            @php
                $sum += $report->price;
                $minute += $report->minute
            @endphp
        @endforeach
        </tbody>
        <tr>
            <td width="8%">
                <span></span>
            </td>
            <td></td>
            <td>
                <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
            </td>
            <td><span style="font-weight: bold">Total Minute : {{ $minute ?? '' }}</span> </td>
        </tr>
    </table>
</body>
</html>
