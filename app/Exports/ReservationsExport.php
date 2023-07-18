<?php

namespace App\Exports;

use App\Models\Reservation;
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

class ReservationsExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
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
        return Reservation::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم الحجز',
            'المستخدم المضيف للحجز',
            'كود العرض',
            'اسم العميل',
            'سعر الحجز',
            'حالة الحجز',
            'تاريخ بداية فترة الحجز',
            'تاريخ نهاية فترة الحجز',
            'ملاحظات',
            'تاريخ تسجيل الحجز',
            // 'Updated At',
        ];
    }

    public function map($reservation): array
    {
        return [
            $reservation->id,
            $reservation->user_name,
            $reservation->offer_code,
            $reservation->price_string,
            $reservation->client_name,
            $reservation->status == 1 ? 'نشط' : 'غير نشط',
            $reservation->date_from,
            $reservation->date_to,
            $reservation->note,
            $reservation->created_at ? Date::dateTimeToExcel($reservation->created_at) : "",
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
