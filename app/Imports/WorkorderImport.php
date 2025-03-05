<?php

namespace App\Imports;

use App\Models\WorkOrder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Input;

class WorkorderImport implements ToModel ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new WorkOrder([
            'wo_name'      => $row['workorder_name'],
            'priority'     => $row['priority'],
            'date'         => $row['date'],
            'time'         => $row['time'],
            'instructions' => $row['instructions'],
            'tags'         => $row['tags'],
            'location_id'  => \Auth::user()->current_location,
            'created_by'   => \Auth::user()->id,
            'company_id'   => \Auth::user()->id,
        ]);
    }
}
