<?php

namespace App\Exports;

use App\Models\SalePayment;

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

class SalePaymentsExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
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
        return SalePayment::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'الترتيب',
            'كود الصفقة',
            'اسم العميل المشتري',
            'اسم العميل البائع',
            'المبلغ',
            'تاريخ الدفع',
        ];
    }

    public function map($sale_payment): array
    {
        return [
            $sale_payment->id,
            $sale_payment->sale_code,
            $sale_payment->buyer_name,
            $sale_payment->seller_name,
            $sale_payment->amount_string,
            $sale_payment->created_at,
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
