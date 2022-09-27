<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Batch wise student report PDF</title>
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
        <h2 style="text-align: center;">Batch Student List</h2>
        <hr>
        <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%">
            <thead>
            <tr style="background-color: #0bb2d3; border: 1px solid #333">
                <th width="2%">SL</th>
                <th width="10%">Marketing Officer Name</th>
                <th width="10%">Name</th>
                <th width="10%">Email</th>
                <th width="10%">Phone</th>
                <th width="5%">Course Name</th>
                <th width="5%">Batch No</th>
                <th width="5%">Course Fee</th>
                <th width="5%">First Payment</th>
                <th width="5%">Second Payment</th>
                <th width="5%">Due</th>
            </tr>
            </thead>
            <tbody>
            @foreach($admissionStudents as $admissionStudent)
                <tr>
                    <td style="border: 1px solid #000">{{ $loop->index+1 }}</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->user->full_name?? '' }}</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->s_name?? '' }}</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->s_email ?? '' }}</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->s_phone ?? '' }}</td>
                    <td style="border: 1px solid #000">
                        @if($admissionStudent->course == 'web')
                            WEB
                        @elseif($admissionStudent->course == 'digital')
                            ADM
                        @else
                            ENG
                        @endif
                    </td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->batch_no?? '' }}</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>
                    <td style="border: 1px solid #000">{{ $admissionStudent->moneyReceipt->today_pay ?? '' }}</td>
                    <td style="border: 1px solid #000">
                        @if($admissionStudent->moneyReceipt->due == 0)
                            Paid
                        @else
                            {{ $admissionStudent->moneyReceipt->due ?? '' }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tr>
                <td style="font-weight: 700" colspan="11">This batch Total Students : {{ count($admissionStudents) }}</td>
            </tr>
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
