<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Money Receipt Pdf</title>
</head>
<body>
        <table style="width: 700px;margin: auto;box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;border-collapse: collapse">
            <thead>
                <tr>
                    <td colspan="2" style="text-align: center;">
                       <h4 style="background: #f16522;display: inline-block;padding: 5px 20px;font-size: 20px;font-weight: 500;color: #fff;border-radius: 0px 10px;margin-bottom: 0;margin-top: 55px;margin-left: 60px;">
                            Money Receipt
                        </h4> 
                    </td>
                    <td style="width:180px;">
                        <img src="{{ asset('backend/') }}/assets/logo3.png" class="institute-logo" style="margin-left: 20px;">
                        <p style="font-weight: 500;margin-bottom: 0;font-size: 13px;margin-top: 0;margin-bottom: 10px;margin-left: 20px;">
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
                           {{ $data['moneyReceipt']->admissionForm->course }} - {{ $data['moneyReceipt']->admissionForm->student_id }} 
                        </span>
                    </td>
                    <td style="width: 180px;"></td>
                    <td style="width: 200px;text-align: center;padding: 0px 20px 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Admission Date :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->admission_date }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td colspan="3" style="padding: 10px 0 10px 20px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Student Name :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->admissionForm->s_name }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td colspan="3" style="padding: 10px 0 10px 20px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Course Name :
                        </span>
                        <span style="color: #000;">
                            @if($data['moneyReceipt']->admissionForm->course == 'web')
                                Full stack web development
                            @elseif($data['moneyReceipt']->admissionForm->course == 'digital')
                                Advance Digital Marketing
                            @else
                                Communication English
                            @endif
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0 10px 20px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Total Fee :
                        </span>
                        <span style="color: #000;">
                             {{ $data['moneyReceipt']->total_fee }} TK
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Advance :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->advance }} TK
                        </span>
                    </td>
                    <td style="text-align: end;padding: 10px 20px 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Due :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->due }} TK
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 20px;" colspan="2">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Received By :
                        </span>
                        <span style="color: #000;">
                            {{ auth()->user()->full_name }}
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
