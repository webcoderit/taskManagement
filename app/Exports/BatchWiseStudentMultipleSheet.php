<?php

namespace App\Exports;

use App\Models\AdmissionForm;
use App\Models\AttendanceLog;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class BatchWiseStudentMultipleSheet implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $batch;
    public function __construct($batch)
    {
        //dd($batch);
        $this->batch = $batch;
    }

    public function collection()
    {
        //returns Data with User data, all user data
        //$request = $this->request;
        return AdmissionForm::with('moneyReceipt','user')->where('batch_no', $this->batch)->get();
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
