<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Batch wise student report PDF</title>
</head>
<body>
    <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%">
        <thead>
            <tr style="background-color: #0bb2d3">
                <th>SL</th>
                <th>Marketing Officer Name</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course Name</th>
                <th>Batch No</th>
                <th>Course Fee</th>
                <th>Advance</th>
                <th>Due</th>
                <th>Due Opinion</th>
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
                <td style="border: 1px solid #000">
                    @if($admissionStudent->moneyReceipt->due == 0)
                        Paid
                    @else
                        {{ $admissionStudent->moneyReceipt->due ?? '' }}
                    @endif
                </td>
                <td style="border: 1px solid #000">{{ $admissionStudent->note ?? '' }}</td>
            </tr>
        @endforeach
        </tbody>
        <tr>
            <td style="font-weight: 700" colspan="11">This batch Total Students : {{ count($admissionStudents) }}</td>
        </tr>
    </table>
</body>
</html>
