<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Due Collect report PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @media print {
            *{
                visibility: hidden;
            }
            .due-report,
            .due-report *{
                visibility: visible;
            }
        }
    </style>
</head>
<body>
<div class="money-receipt-print-btn-wrap" style="padding-left: 20px;margin-top: 20px;">
    <div class="money-receipt-download-btn btn btn-success" style="cursor: pointer;">Print</div>
</div>
	<div class="wrapper due-report">
	    <div class="page-wrapper" style="margin-left: 20px!important;">
	        <div class="page-content">
	            <h2 style="text-align: center;">
                    Due Collect Report   
                </h2>
	            <hr/>
	            <div class="card">
	                <div class="card-body">
	                    <div class="table-responsive mt-3">
	                        <table id="" class="table table-striped table-bordered">
	                            <thead>
	                            <tr style="background-color: #0bb2d3;">
	                                <th>Due Collect Date</th>
	                                <th>Marketing Officer Name</th>
	                                <th>Name</th>
	                                <th>Phone</th>
	                                <th>Course Name</th>
	                                <th>Batch No</th>
	                                <th>Course Fee</th>
	                                <th>First Payment</th>
	                                <th>Second Payment</th>
	                                <th>Due</th>
	                                <th>Due Opinion</th>
	                                {{-- <th width="15%">Admission Opinion</th> --}}
	                                {{-- <th>Action</th> --}}
	                            </tr>
	                            </thead>
	                            <tbody>
                                @foreach($admissionStudents as $admissionStudent)
                                    <tr>
                                        <td>
                                            @if($admissionStudent->moneyReceipt->is_pay == 1)
                                                {{ $admissionStudent->moneyReceipt->updated_at->format('Y-m-d') }} <br/>
                                            @else
                                                <span>Not paid yet</span>
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->user->full_name?? session()->get('name') }}</td>
                                        <td>{{ $admissionStudent->s_name?? '' }}</td>
                                        <td>{{ $admissionStudent->s_phone ?? '' }}</td>
                                        <td>
                                            @if($admissionStudent->course == 'web')
                                                Web
                                            @elseif($admissionStudent->course == 'digital')
                                                ADM
                                            @else
                                                Eng
                                            @endif
                                        </td>
                                        <td>{{ $admissionStudent->batch_no ?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->total_fee ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->moneyReceipt->advance ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->moneyReceipt->today_pay ?? '' }}</td>
                                        <td>{{ $admissionStudent->moneyReceipt->due ?? '' }}Tk.</td>
                                        <td>{{ $admissionStudent->note ?? '' }}</td>
                                        {{-- <td width="15%">{{ $admissionStudent->other_admission_note ?? '' }}</td> --}}
                                        {{-- <td>
                                            @if($admissionStudent->is_reject == 0)
                                                <a href="{{ url('/admin/student/reject/'.$admissionStudent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bx bx-check-circle"></i>
                                                </a>
                                            @endif
                                            @if($admissionStudent->moneyReceipt->due == 0)
                                                <a href="#" class="btn btn-sm btn-success">
                                                    <i class="bx bx-check-circle"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('/admin/admission/student/info/'.$admissionStudent->moneyReceipt->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bx bx-user-circle"></i>
                                                </a>
                                            @endif
                                                <a href="{{ url('/admin/admission/student/info/edit/'.$admissionStudent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a href="{{ url('/admin/admission/student/info/delete/'.$admissionStudent->id) }}" onclick="return confirm('Are you sure delete this student info ?')" class="btn btn-sm btn-danger">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('.money-receipt-download-btn').click(function(){
        window.print();
    })
</script>
