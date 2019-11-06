<?php

namespace Modules\Radiation\Import;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Radiation\Entities\Radiation;

class RadiationImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $city_id = \Request()->route('city_id');
        $type = (string)\Request()->route('radiation_type');
        unset($rows[0]);
        foreach ($rows as $row) {
            if(!empty($row[0]))
            {
                $time = $row[0];
                unset($row[0]);
                    Radiation::create([
                        'timing' =>date('g:i', strtotime(explode(' ',json_decode(json_encode(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($time)))->date)[1])),
                        'january' => $row[1],
                        'february' => $row[2],
                        'march' => $row[3],
                        'april' => $row[4],
                        'may' => $row[5],
                        'june' => $row[6],
                        'july' => $row[7],
                        'august' => $row[8],
                        'september' => $row[9],
                        'october' => $row[10],
                        'november' => $row[11],
                        'december' => $row[12],
                        'avg' => $row->count() != 0 ? ($row->sum() / $row->count()) : 0,
                        'city_id' => $city_id,
                        'type' => $type
                    ]);
            }
        }
    }
}
