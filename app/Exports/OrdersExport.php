<?php

namespace App\Exports;

use App\Models\Order;
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

class OrdersExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
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
        return Order::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }


    public function headings(): array
    {
        return [
            'رقم الطلب',
            'كود الطلب',
            'كود العرض',
            'حالة الطلب',
            'رقم العميل',
            'المستخدم المضيف للطلب',
            'اسم العميل',
            'جهة العمل',
            'نوع الموظف',
            'هل مدعوم من الإسكان',
            'نوع العقار',
            'المساحة',
            'السعر يبدأ من ',
            'السعر ينتهى الى',
            'المبلغ المتوفر',
            'طريقة الشراء',
            'الرغبة للشراء',
            'المدينة',
            'اسم الفرع',
            'الطلب مسند الى المسوق',
            'تاريخ إسناد الطلب للمسوق',
            'تاريخ الإنشاء',
            'تاريخ إلغاء الطلب',
            'ملاحظات الطلب',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'W' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->order_code,
            $order->offer ?  $order->offer->offer_code : '',
            $order->order_status,
            $order->client_phone,
            $order->client_name,
            $order->user_name,
            $order->client_employer,
            __($order->client_employment_type),
            $order->housing_support,
            $order->real_estate_type,
            number_format($order->space),
            number_format($order->start_price),
            number_format($order->end_price),
            number_format($order->amount),
            __($order->payment_method),
            __($order->time_purchase),
            $order->city_name,
            $order->branch_name,
            $order->attribution_name,
            $order->attribution_date,
            $order->created_at ? Date::dateTimeToExcel($order->created_at) : '',
            $order->closing,
            $order->notes,
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
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
