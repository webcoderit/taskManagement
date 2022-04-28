<?php

namespace App\Exports;

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

class AttendanceReport implements WithMultipleSheets, WithTitle, FromQuery, WithEvents, WithHeadings, ShouldAutoSize
{
    use Exportable;

    protected $year;
    protected $month;

    public function __construct(int $year, int $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new AttendanceMultiSheetReport($this->year, $month);
        }

        return $sheets;
    }

    public function query()
    {
        return AttendanceLog::query()
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month);
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
                $afterSheet->sheet->getStyle('A1:K1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return DateTime::createFromFormat('!m', $this->month)->format('F');
    }
}
