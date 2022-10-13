<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Money Receipt Pdf</title>
</head>
<body>
<table style="width: 700px;margin: auto;box-shadow: rgb(0 0 0 / 50%) 0px 3px 8px;
    border-collapse: collapse;
    border-top: 1px solid #000000;
    border-bottom: 1px solid #000000;
    border-left: orangered;
    border-right: orangered; background-color: #d1d2d4">
    <thead>
    <tr>
        <td colspan="2" style="text-align: center;">
            <h4 style="background: #f16522;display: inline-block;padding: 5px 20px;font-size: 20px;font-weight: 500;color: #fff;border-radius: 0px 10px;margin-bottom: 0;margin-top: 20px;margin-left: 80px;">
                Money Receipt
            </h4>
        </td>
        <td style="width:180px;">
            <img src="{{ asset('backend/') }}/assets/logo3.png" class="institute-logo" style="margin-left: 20px;">
            <p style="font-weight: 600;margin-left: 30px;color:#000;font-size: 13px;margin-top: 0;">
                House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
            </p>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr style="border-bottom: 1px solid #ddd;">
        <td style="padding: 0px 0px 10px 20px;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Student ID :
            </span>
            <span style="color: #000;">
                {{ ucfirst($moneyReceiptView->admissionForm->course) ?? '' }} - {{ $moneyReceiptView->admissionForm->student_id ?? '' }}
                {{-- {{ ucfirst($data['moneyReceipt']->admissionForm->course) }} - {{ $data['moneyReceipt']->admissionForm->student_id }} --}}
            </span>
        </td>
        <td style="width: 180px;"></td>
        <td style="width: 200px;text-align: center;padding: 0px 20px 10px 0;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Admission Date :
            </span>
            <span style="color: #000;">
                {{ $moneyReceiptView->admission_date->format('Y-m-d') ?? ' ' }}
                 {{-- {{ $data['moneyReceipt']->admission_date->format('Y-m-d') }} --}}
            </span>
        </td>
    </tr>
    <tr style="border-bottom: 1px solid #ddd;">
        <td style="padding: 10px 0 10px 20px;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Student Name :
            </span>
            <span style="color: #000;">
                {{ $moneyReceiptView->admissionForm->s_name ?? ' ' }}
                {{-- {{ $data['moneyReceipt']->admissionForm->s_name }} --}}
            </span>
        </td>
        <td style="text-align: end;padding: 10px 20px 10px 0;" colspan="2">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Student Phone :
            </span>
            <span style="color: #000;">
                {{ $moneyReceiptView->admissionForm->s_phone ?? ' ' }}
                {{-- {{ $data['moneyReceipt']->admissionForm->s_phone }} --}}
            </span>
        </td>
    </tr>
    <tr style="border-bottom: 1px solid #ddd;">
        <td colspan="2" style="padding: 10px 0 10px 20px;">
                    <span style="font-size: 15px;color: #000;font-weight: 600;">
                        Course Name :
                    </span>

            <span style="color: #000;">
                @if($moneyReceiptView->admissionForm->course == 'web')
                    Full stack web development
                @elseif($moneyReceiptView->admissionForm->course == 'digital')
                    Advanced Digital Marketing
                @else
                    Communication English
                @endif
            </span>
        </td>
        <td style="text-align: end;padding: 10px 20px 10px 0;">
           <span style="font-size: 15px;color: #000;font-weight: 600;">
                Batch No :
            </span>
            <span style="color: #000;">
                {{ $moneyReceiptView->admissionForm->batch_no }}
                 {{-- {{ $data['moneyReceipt']->admissionForm->batch_no }} --}}
            </span>
        </td>
    </tr>
    <tr style="border-bottom: 1px solid #ddd;">
        <td style="padding: 10px 0 10px 20px;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Total Fee :
            </span>
            <span style="color: #000;">
                {{ $moneyReceiptView->total_fee }} Tk
                 {{-- {{ $data['moneyReceipt']->total_fee }} TK --}}
            </span>
        </td>
        <td style="padding: 10px 0 10px 20px;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Due :
            </span>
            <span style="color: #000;">
                @if($moneyReceiptView->due == 0)
                    Paid
                @else
                    {{ $moneyReceiptView->due }} TK
                @endif
                 {{-- {{ $data['moneyReceipt']->total_fee }} TK --}}
            </span>
        </td>
        <td style="text-align: center;width: 200px;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Advance :
            </span>
            <span style="color: #000;">
               {{ $moneyReceiptView->advance }}
                {{-- {{ $data['moneyReceipt']->advance }} TK. <small style="color: red">( Advance & {{ ucfirst($data['moneyReceipt']->admissionForm->payment_type) }} Cost )</small> --}}
            </span>
        </td>
        <td style="text-align: end;padding: 10px 20px 10px 0;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Second Payment :
            </span>
            <span style="color: #000;">
                @if($moneyReceiptView->today_pay != null)
                    <span style="font-size: 15px;color: #000;font-weight: 600;">Second Payment :</span>
                    <span>{{ $moneyReceiptView->today_pay ?? "Not Yet" }} TK. <small style="color: red">( With Cost )</small> </span>
                @else
                @endif
            </span>
        </td>
    </tr>
    <tr style="border-bottom: 1px solid #ddd;">
        <td style="padding: 10px 0px 10px 20px;" colspan="2">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Received By :
            </span>
            <span style="color: #000;">
               {{ auth()->check() ? auth()->user()->full_name : 'Admin' }}
            </span>
        </td>
        <td style="text-align: center;padding: 10px 20px 10px 0;">
            <span style="font-size: 15px;color: #000;font-weight: 600;">
                Authorised By :
            </span>
            <span>WebCoder-it</span>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;" colspan="3">
            <a href="https://webcoder-it.com" target="_blank" style="color: #f16522;display: inline-block;font-size: 16px;margin: 15px 0;text-decoration: none;">
                https://webcoder-it.com ,
            </a>
            <a href="tel:01814812233" style="color: #f16522;display: inline-block;font-size: 16px;margin: 15px 0;text-decoration: none;">
                01810139951-8
            </a>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
