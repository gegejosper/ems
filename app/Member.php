<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = [
            'pic',
            'regionalidnumber',
            'clubidnumber',
            'personalidnumber',
            'fname',
            'lname',
            'mname',
            'position',
            'club',
            'region',
            'address',
            'personalcontact',
            'bloodtype',
            'contactperson',
            'contactpersonnumber',
            'relation',
            'idtype',
            'idnumber',
            'email',
            'website',
            'tin',
            'bdate',
            'philhealth',
            'sssgsis',
            'pagibig',
            'religion',
    ];
}
