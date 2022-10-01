<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Total Due Collect Report</title>
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
    <h2 style="text-align: center;">Total Due Collect Report</h2>
    <hr>
    <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%" class="table table-bordered">
        <thead>
        <tr style="background-color: #0bb2d3; border: 1px solid #000">
            <th width="5%">SL</th>
            <th width="20%">Admission Date</th>
            <th width="20%">Due Collect Date</th>
            <th>Course Name</th>
            <th>Batch</th>
            <th>Student Name</th>
            <th>Student Phone</th>
            <th>Total Fee</th>
            <th>First Payment</th>
            <th>Due</th>
        </tr>
        </thead>
        <tbody>
        @php
            $sum = 0;
            $web = 0;
            $adm = 0
        @endphp
        @foreach($totalDueCollectLists as $admissionStudentFilter)
            <tr>
                <td style="border: 1px solid #000">{{ $loop->index+1 }}</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->admission_date->format('Y-m-d') }}</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->updated_at->format('Y-m-d') }}</td>
                <td style="border: 1px solid #000">
                    @if($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'web' : '')
                        WEB
                    @elseif($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'digital' : '')
                        ADM
                    @else
                        ENG
                    @endif
                </td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->admissionForm->batch_no?? '' }}</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->admissionForm->s_name?? '' }}</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->admissionForm->s_phone ?? '' }}</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->total_fee ?? '' }}Tk.</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->advance ?? '' }}Tk.</td>
                <td style="border: 1px solid #000">{{ $admissionStudentFilter->due ?? '' }}Tk.</td>
            </tr>
            @php
                if($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'web' : ''){
                    $web += count(array($admissionStudentFilter->admissionForm->course));
                }
                if($admissionStudentFilter->admissionForm ? $admissionStudentFilter->admissionForm->course == 'digital' : ''){
                    $adm += count(array($admissionStudentFilter->admissionForm->course));
                }
                $sum += $admissionStudentFilter->today_pay;
            @endphp
        @endforeach
        <tr>
            <td colspan="4"></td>
            <td>
                <span style="font-weight: bold">Total Due Collect Amount : {{ number_format($sum,2) }}</span>
            </td>
            {{--                <td>--}}
            {{--                    <span style="font-weight: bold">Total Web Admission : {{ $web }}</span>--}}
            {{--                </td>--}}
            {{--                <td>--}}
            {{--                    <span style="font-weight: bold">Total ADM Admission : {{ $adm }}</span>--}}
            {{--                </td>--}}
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
