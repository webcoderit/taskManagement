<?php

namespace App\Exports;

use App\Models\Admission;
use App\Models\AttendanceLog;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use DateTime;

class AttendanceMultiSheetReport implements FromQuery, WithHeadings, ShouldAutoSize, WithEvents, WithMultipleSheets, FromCollection
{
    use Exportable;

    protected $year;
    protected $month;

    public function __construct(int $year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        //returns Data with User data, all user data
        return AttendanceLog::with('user')->get();
    }

    public function map($registration) : array {
        return [
            $registration->user->first_name . ' ' . $registration->user->last_name,
        ] ;


    }


    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new AttendanceReport($this->year, $month);
        }

        return $sheets;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return AttendanceLog::query()
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->with('user');
    }


    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Name',
            'In time',
            'Out time',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $afterSheet){
                $afterSheet->sheet->getStyle('A1:E1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
