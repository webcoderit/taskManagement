<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
    <section>
        <table style="width: 900px;margin: auto;box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;padding: 20px;background-image: url({{ asset('backend/') }}/assets/logo4.png);background-position: center;background-repeat: no-repeat;background-size: contain;border-collapse: collapse;border: 1px solid #ddd;">
            <thead>
                <tr>
                    <td style="width: 280px;padding-left: 10px;">
                        <h2 style="font-size: 30px;text-transform: uppercase;color: #f16522;letter-spacing: 2px;margin-bottom: 0px;margin-top: 0;">
                            Web<span style="color: #564c4c;">coder</span>-it
                        </h2>
                        <address style="margin-bottom: 5px;">
                            House#06, Level#03 Road-1/A, Sector#09 Housebuilding, Uttara Dhaka-1230
                        </address>
                        <span>
                            <a href="tel:01648177071" style="display: inline-block;color: #000;font-size: 14px;text-decoration: none;">
                                01648177071 ,
                            </a>
                        </span>
                        <span>
                            <a href="tel:01814812233" style="display: inline-block;color: #000;font-size: 14px;text-decoration: none;">
                                01814812233
                            </a>
                        </span><br>
                        <span>
                            <a href="https://webcoder-it.com/" target="_blank" title="Website" style="display: inline-block;color: #000;font-size: 14px;text-decoration: none;">
                                www.webcoder-it.com ,
                            </a>
                        </span>
                        <span>
                            <a href="mailto:webcoderit@gmail.com" title="Gmail Id" style="display: inline-block;color: #000;font-size: 14px;text-decoration: none;">
                                webcoderit@gmail.com
                            </a>
                        </span>
                    </td>
                    <td colspan="2" style="text-align: end; padding: 15px 10px 0px 0px;">
                        @if($data['admissionForm']->avatar != null)
                            <img src="{{ $data['admissionForm']->avatar ?? 'image not found' }}" style="height: 130px; width: 150px; margin-bottom: 10px;">
                        @endif
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="2">
                       <span style="font-size: 15px;color: #000;font-weight: 600;">
                           Student Name :
                       </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->s_name }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Student Email :
                          </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->s_email }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="2">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Father Name :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->f_name }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Mother Name :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->m_name }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="2">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Student Phone No. :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->s_phone }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Father Phone No. :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->f_phone }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Date Of Birth :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->dob }}
                         </span>
                    </td>
                    <td style="width: 300px;text-align: center;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Profession :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->profession }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Gender :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->gender }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Blood Group :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->blood_group }}
                        </span>
                    </td>
                    <td style="width: 300px;text-align: center;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Educational Qualification :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->qualification }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            NID No. :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->nid }}
                         </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="3">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Address :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->present_address }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Course Name :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->course }}
                        </span>
                    </td>
                    <td style="width: 300px;text-align: center;">
                       <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Batch No. :
                       </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->batch_no }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Batch Type :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->batch_type }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="2">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Payment Type :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->moneyReceipt->payment_type }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Admission Date :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->moneyReceipt->admission_date }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Total Fee :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->moneyReceipt->total_fee }} TK
                        </span>
                    </td>
                    <td style="width: 300px;text-align: center;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Advance :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->moneyReceipt->advance }} TK
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Due :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->moneyReceipt->due }} TK
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="3">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            In Word :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->moneyReceipt->in_word }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="2">
                       <span style="font-size: 15px;color: #000;font-weight: 600;">
                           Class Shedule :
                       </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->class_shedule }}
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                       <span style="font-size: 15px;color: #000;font-weight: 600;">
                           Class Time :
                       </span>
                        <span style="font-size: 14px;color: #000;">
                            {{ $data['admissionForm']->class_time }}
                        </span>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px 0px 10px 30px;" colspan="2">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Note :
                        </span>
                        <span style="font-size: 14px;color: #000;">
                            Incomplete Application will be Cancelled.
                        </span>
                    </td>
                    <td style="padding: 10px 20px 10px 0px;width: 230px;text-align: end;">
                        <span style="font-size: 15px;color: #000;font-weight: 600;">
                            Authorized By :
                        </span>
                        <span class="">Webcoder-it</span>
                    </td>
                </tr>
                <tr>
                    <td style="background: #f16522;" colspan="3">
                        <p style="text-align: center;color: #fff;font-size: 15px;font-weight: 600;margin: 5px 0;">
                            We Build Any Kinds of Website and We Provide Complete Digital Marketing Solution for your Company.
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</body>
</html>
