<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    protected $table = 'graduate';
    protected $fillable = ['studnum','fname','mname','lname', 'suffix', 'bday','sex','contactnum','permaddress','curraddress','major','mscdegree','yeargrad','honorsreceived','companyname','position', 'natureofwork', 'companyaddress', 'country', 'companyemail','companycontactnum'];
}
