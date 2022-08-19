<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admission report PDF</title>
</head>
<body>
    <h2 style="text-align: center;">Monthly Admission Report</h2>
    <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%">
        <thead>
            <tr style="background-color: #0bb2d3; border: 1px solid #000">
                <th width="20%">Date</th>
                <th>Course Name</th>
                <th>Batch</th>
                <th>Student Name</th>
                <th>Student Phone</th>
                <th>Total Fee</th>
                <th>Advance</th>
                <th>Due</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sum = 0;
                $web = 0;
                $adm = 0
            @endphp
                @foreach($admissionStudentsDateFilteringDownload as $admissionStudentFilter)
                    <tr>
                        <td style="border: 1px solid #000">{{ $admissionStudentFilter->admission_date->format('Y-m-d') }}</td>
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
                        $sum += $admissionStudentFilter->advance;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="4"></td>
                    <td>
                        <span style="font-weight: bold">Total Amount : {{ number_format($sum,2) }}</span>
                    </td>
                    <td>
                        <span style="font-weight: bold">Total Web Admission : {{ $web }}</span>
                    </td>
                    <td>
                        <span style="font-weight: bold">Total ADM Admission : {{ $adm }}</span>
                    </td>
                </tr>
            </tbody>
    </table>
</body>
</html>
