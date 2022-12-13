<?php

namespace App\Exports;

use App\Models\AdmissionForm;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RejectStudentList implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return AdmissionForm::with('moneyReceipt','user')->where('is_reject', 1)->get();
    }

    public function map($admissionForm) : array {
        //dd($admissionForm);
        return [
            $admissionForm->id,
            $admissionForm->moneyReceipt->admission_date,
            $admissionForm->s_name,
            $admissionForm->s_email,
            $admissionForm->s_phone,
            $admissionForm->course,
            $admissionForm->batch_no,
            $admissionForm->moneyReceipt->total_fee,
            $admissionForm->moneyReceipt->advance,
            $admissionForm->moneyReceipt->today_pay,
            $admissionForm->moneyReceipt->due,
        ] ;


    }

    public function headings() : array {
        return [
            '#',
            'Date',
            'Name',
            'Email',
            'Phone',
            'Course Name',
            'Batch No',
            'Fee',
            'First Pay',
            'Second Pay',
            'Due',
        ];
    }
}
