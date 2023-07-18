<?php

namespace App\Exports;

use App\Models\Broker;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BrokersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
{
    use Exportable;
    public $filters = [];
    public $sort_field = 'id';
    public $sort_direction = 'desc';
    public $rows_number = 10;
    public $paginate_ids = [];

    public function __construct($filters = [], $sort_field = "id", $sort_direction = "desc", $rows_number = 5, $paginate_ids = [])
    {
        $this->filters = $filters;
        $this->sort_field = $sort_field;
        $this->sort_direction = $sort_direction;
        $this->rows_number = $rows_number;
        $this->paginate_ids = $paginate_ids;
    }


    public function query()
    {
        return Broker::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم الوسيط',
            'المستخدم المضيف',
            'اسم الوسيط',
            // 'رقم هاتف الوسيط',
            'نوع الوسيط',
            'حالة الوسيط',
            'تاريخ تسجيل الوسيط',
            // 'Updated At',
        ];
    }

    public function map($broker): array
    {
        return [
            $broker->id,
            $broker->user ? $broker->user->name : '',
            $broker->name,
            // $broker->phone_number,
            $broker->type == 'office' ? 'مكتب' : 'فرد',
            $broker->status == 1 ? 'نشط' : 'غير نشط',
            $broker->created_at ? Date::dateTimeToExcel($broker->created_at): '',
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
