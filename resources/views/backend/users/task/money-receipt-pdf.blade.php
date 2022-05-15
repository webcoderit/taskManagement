<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Money Receipt Pdf</title>
</head>
<body>
    <section>
        <table style="width: 700px;margin: auto;box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;border-collapse: collapse">
            <thead>
                <tr style="display: flex;justify-content: space-between;width: 710px;">
                    <td style="width: 85px;height: 75px;background: #f16522;border-radius: 0px 0px 100px 0px;">
                    </td>
                    <td style="display: inline-flex;align-items: center;justify-content: center;">
                        <h4 style="background: #f16522;display: inline-block;padding: 5px 20px;font-size: 20px;font-weight: 500;color: #fff;border-radius: 0px 10px;margin-bottom: 0;">
                            Money Receipt
                        </h4>
                    </td>
                    <td style="width:180px;">
                        <img src="{{ asset('backend/') }}/assets/logo3.png" class="institute-logo">
                        <p style="font-weight: 500;margin-bottom: 0;font-size: 13px;margin-top: 0;margin-bottom: 10px;">
                            House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #ddd;display: flex;align-items: center; justify-content: space-between;width: 650px;padding: 0px 30px;">
                    <td style="margin-bottom: 10px;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Student ID :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->admissionForm->course }} - {{ $data['moneyReceipt']->admissionForm->student_id }}
                        </span>
                    </td>
                    <td style="margin-bottom: 10px;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Admission Date :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->admission_date }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;display: flex;align-items: center; justify-content: space-between;width: 650px;padding: 0px 30px;">
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Student Name :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->admissionForm->s_name }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;display: flex;align-items: center; justify-content: space-between;width: 650px;padding: 0px 30px;">
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
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
                <tr style="border-bottom: 1px solid #ddd;display: flex;align-items: center; justify-content: space-between;width: 650px;padding: 0px 30px;">
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Total Fee :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->total_fee }} TK
                        </span>
                    </td>
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Advance :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->advance }} TK
                        </span>
                    </td>
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Due :
                        </span>
                        <span style="color: #000;">
                            {{ $data['moneyReceipt']->due }} TK
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;display: flex;align-items: center; justify-content: space-between;width: 650px;padding: 0px 30px;">
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Received By :
                        </span>
                        <span style="color: #000;">
                            {{ auth()->user()->full_name }}
                        </span>
                    </td>
                    <td style="margin: 10px 0;">
                        <span style="font-size: 15px;color: #000;font-weight: 500;">
                            Authorised By :
                        </span>
                        <span>WebCoder-it</span>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <a href="https://webcoder-it.com" target="_blank" style="color: #f16522;display: inline-block;font-size: 16px;margin: 15px 0;text-decoration: none;">
                            https://webcoder-it.com ,
                        </a>
                        <a href="tel:01814812233" style="color: #f16522;display: inline-block;font-size: 16px;margin: 15px 0;text-decoration: none;">
                            01810139951-8
                        </a>
                    </td>
                    <td></td>
                </tr>
           </tbody>
        </table>
    </section>
</body>
</html>
