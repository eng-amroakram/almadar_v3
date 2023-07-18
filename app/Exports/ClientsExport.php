<?php

namespace App\Exports;

use App\Models\Client;

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

class ClientsExport implements WithColumnFormatting, FromQuery, WithMapping, ShouldAutoSize, WithStyles, WithHeadings
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
        return Client::query()->filters($this->filters)->whereIn('id', $this->paginate_ids)->reorder($this->sort_field, $this->sort_direction);
    }

    public function headings(): array
    {
        return [
            'رقم العميل',
            'المستخدم المضيف للعميل',
            'اسم العميل',
            'رقم هاتف العميل',
            'ايميل العميل',
            'جهة العمل',
            'اسم الموظيف',
            'نوع التوظيف',
            'رقم هوية العميل',
            // 'NID',
            'المدينة',
            'الحي',
            'رقم بالمبنى',
            'رقم الشارع',
            'الرمز البريدي',
            'الرقم الإضافي',
            'رقم الوحدة',
            'هل مدعوم من الإسكان',
            'حالة العميل',
            'هل اشترى ؟',
            'تاريخ تسجيل العميل',
            // 'Updated At',


        ];
    }

    public function map($client): array
    {
        return [
            $client->id,
            $client->user ? $client->user->name : "",
            $client->name,
            $client->phone,
            $client->email,
            $client->employer_id,
            $client->employer_name,
            $client->employee_type == 'public' ? 'عام' : 'خاص',
            $client->nationality_id,
            $client->city ? $client->city->name : "",
            $client->neighborhood_name,
            $client->building_number,
            $client->street_name,
            $client->zip_code,
            $client->addtional_number,
            $client->unit_number,
            $client->support_eskan == 1 ? 'نعم' : 'لا',
            $client->status == 1 ? 'نشط' : 'غير نشط',
            $client->is_buy == 1 ? 'نعم' : 'لا',
            $client->created_at ? Date::dateTimeToExcel($client->created_at) : "",
            // Date::dateTimeToExcel($branch->updated_at ?? 0), # should not be null
        ];
    }

    public function columnFormats(): array
    {
        return [
            'T' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
