<?php

namespace App\Exports;

use App\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MemberExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'DATABASE ID',
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
    public function collection()
    {
        return Member::all();
    }
}
