<?php

namespace App\Exports;

use App\Models\Offer;
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

class OffersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
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
        return Offer::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم العرض',
            'كود العرض',
            'صاحب العرض',
            'بيان العرض',
            'المدينة',
            'الحي',
            'السعر',
            'مساحة العقار',
            'الفرع',
            'حالة العقار',
            'حالة العرض',
            'نوع العقار',
            'نوع العرض',
            'تاريخ تسجيل العرض',
            // 'Updated At',
        ];
    }

    public function map($offer): array
    {
        return [
            $offer->id,
            $offer->offer_code,
            $offer->user_name,
            $offer->statement,
            $offer->city_name,
            $offer->neighborhood_name,
            $offer->total_string,
            $offer->space_string,
            $offer->branch_name,
            $offer->real_estate_status_name,
            $offer->status == 1 ? "نشط" : "غير نشط",
            $offer->real_estate_type_name,
            $offer->offer_type_name,
            $offer->created_at ? Date::dateTimeToExcel($offer->created_at) : "",
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
