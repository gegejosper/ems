<?php

namespace App\Exports;

use App\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomMemberExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Member::all();
    // }
    public function __construct($type, $importtype)
    {
        $this->type = $type;
        $this->importtype = $importtype;
    }
    public function headings(): array
    {
        return [
            'DATABASE ID',
            'PICTURE',
            'REGIONAL ID NUMBER',
            'CLUB ID NUMBER',
            'PERSONAL ID NUMBER',
            'FIRST NAME',
            'LAST NAME',
            'MIDDLE NAME',
            'POSITION',
            'CLUB',
            'REGION',
            'ADDRESS',
            'PERSONAL CONTACT',
            'BLOOD TYPE',
            'CONTACT PERSON',
            'CONTACT PERSON NUMBER',
            'RELATION',
            'ID TYPE',
            'ID NUMBER',
            'EMAIL',
            'WEBSITE',
            'TIN',
            'BDATE',
            'PHILHEALTH',
            'SSS/GSIS',
            'PAG-IBIG',
            'RELIGION',
        ];
    }
    use Exportable;

    public function query()
    {
        if($this->type == 'club'){
            return Member::query()
            ->where('club', '=', $this->importtype);
        }
        else if ($this->type =='region'){
            return Member::query()
            ->where('region', '=', $this->importtype);
        }
        else {
            return Member::all();
        }
        
    }
}
