<?php

namespace App\Imports;

use App\Member;
use Maatwebsite\Excel\Concerns\ToModel;

class MembersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Member([
            //
            'pic' => $row[0],
            'regionalidnumber' => $row[1],
            'clubidnumber' => $row[2],
            'personalidnumber' => $row[3],
            'fname' => $row[4],
            'lname' => $row[5],
            'mname' => $row[6],
            'position' => $row[7],
            'club' => $row[8],
            'region' => $row[9],
            'address' => $row[10],
            'personalcontact' => $row[11],
            'bloodtype' => $row[12],
            'contactperson' => $row[13],
            'contactpersonnumber' => $row[14],
            'relation' => $row[15],
            'idtype' => $row[16],
            'idnumber' => $row[17],
            'email' => $row[18],
            'website' => $row[19],
            'tin' => $row[20],
            'bdate' => $row[21],
            'philhealth' => $row[22],
            'sssgsis' => $row[23],
            'pagibig' => $row[24],
            'religion' => $row[25],
        ]);
    }
}
