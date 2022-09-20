<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Admission Advance Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @media print {
            *{
                visibility: hidden;
            }
            .addmission-form-wrapper,
            .addmission-form-wrapper *{
                visibility: visible;
            }
        }
    </style>
</head>
<body>
<div class="money-receipt-print-btn-wrap" style="padding-left: 20px;margin-top: 20px;">
    <div class="money-receipt-download-btn btn btn-success" style="cursor: pointer;">Print</div>
</div>

<div class="addmission-form-wrapper">
    <h2 style="text-align: center;">Daily Expanse Report</h2>
    <hr>
    <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%" class="table table-bordered">
        <thead>
        <tr>
            <th>Date</th>
            <th>User name</th>
            <th>Amount</th>
            <th>Minute</th>
            <th width="40%">Purpose</th>
        </tr>
        </thead>
        <tbody>
        @php
            $sum = 0;
            $minute = 0
        @endphp
        @foreach($monthTotalExpanseLists as $expanse)
            <tr>
                <td>{{ date('Y-m-d', strtotime($expanse->created_at))  }}</td>
                <td>{{ $expanse->user->full_name ?? 'HR Admin' }}</td>
                <td>{{ number_format($expanse->price,2) }}</td>
                <td>{{ $expanse->minute }}</td>
                <td>{{ ucfirst($expanse->note) }}</td>
            </tr>
            @php
                $sum += $expanse->price;
                $minute += $expanse->minute
            @endphp
        @endforeach
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
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('.money-receipt-download-btn').click(function(){
        window.print();
    })
</script>
</body>
</html>
