<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Call report PDF</title>
</head>
<body>
    <table style="border: 1px solid #000000; margin: auto; height: auto; width: 100%">
        <thead>
            <tr style="background-color: #0bb2d3">
                <td>Date</td>
                <td>Employee Name</td>
                <td>Student Name</td>
                <td>Student Phone</td>
                <td>Student Email</td>
                <td>Course</td>
                <td>Batch No</td>
            </tr>
        </thead>
        <tbody>
        @foreach($sql as $report)
            <tr>
                <td>{{ date('d-m-Y', strtotime($report->created_at)) }}</td>
                <td>{{ $report->user->full_name ?? '' }}</td>
                <td>{{ $report->s_name ?? '' }}</td>
                <td>{{ $report->s_phone ?? '' }}</td>
                <td>{{ $report->s_email ?? '' }}</td>
                <td style="text-transform: capitalize">
                    @if($report->course == 'web')
                        Full stack web development
                    @elseif($report->course == 'digital')
                        Advanced digital marketing
                    @else
                        Communication English
                    @endif
                </td>
                <td>{{ $report->batch_no ?? '' }}</td>
            </tr>
        @endforeach
        </tbody>
        <tr>
            <td style="font-weight: 700">Total Admission : {{ count($reports) }}</td>
        </tr>
    </table>
</body>
</html>
