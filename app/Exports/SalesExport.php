<?php

namespace App\Exports;

use App\Models\Sale;

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

class SalesExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
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
        return Sale::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم البيعة',
            'كود البيعة',
            'كود العرض',
            'كود الطلب',
            'المستخدم المضيف للصفقة',
            'التاريخ',
            'المدينة',
            'نوع العقار',
            'رقم الأرض',
            'المساحة',
            'سعر العقار',
            'نوع العملاء',
            'اسم الفرع',
            'حالة الصفقة',
            // 'Updated At',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->id,
            $sale->sale_code,
            $sale->offer ? $sale->offer->offer_code : '',
            $sale->order ? $sale->order->order_code : '',
            $sale->user->name,
            $sale->created_at ? Date::dateTimeToExcel($sale->created_at) : '',
            $sale->city_name,
            $sale->property_type,
            number_format($sale->space),
            $sale->land_number,
            number_format($sale->total_amount),
            'customers',
            $sale->branch_name,
            $sale->status == 1 ? 'نشط' : 'غير نشط',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
