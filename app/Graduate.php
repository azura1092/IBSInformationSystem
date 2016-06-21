<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
	public $timestamps = false;
    protected $table = 'graduate';
    protected $fillable = 
    [
    	'studnum',
    	'fname',
    	'lname',
    	'suffix', 
    	'mname', 
    	'bday',
    	'sex',
    	'contactnum',
    	'permaddress',
    	'curraddress',
    	'major',
    	'mscdegree',
    	'yeargrad',
    	'honorsreceived',
    	'companyname', 
    	'companyaddress', 
    	'companyemail', 
    	'companycontactnum', 
    	'position', 
    	'natureofwork', 
    	'country'
	];
}
