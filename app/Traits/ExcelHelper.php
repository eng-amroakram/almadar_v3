<?php


namespace App\Traits;

use App\Exports\UsersExport;
use App\Http\Controllers\Services\Services;
use Maatwebsite\Excel\Facades\Excel;

trait ExcelHelper
{
    public function export($excel, $name)
    {
        $excel->filters = $this->filters;
        $excel->date_from = $this->date_from;
        $excel->date_to = $this->date_to;
        $excel->search = $this->search;
        $excel->sort_field = $this->sort_field;
        $excel->sort_direction = $this->sort_direction;
        $excel->rows_number = $this->rows_number;
        $excel->paginate_ids = $this->paginate_ids;
        return Excel::download($excel, "$name.xlsx");
    }
}
