<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddGraduateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //no authentication yet
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function messages()
{
    return [
        'studnum.required' => 'The student number field is required',
        'fname.required' => 'The first name field is required.',
        'mname.required' => 'The middle name field is required.',
        'lname.required' => 'The last name field is required.',
        'bday.required' => 'The birth date field is required.',
        'sex.required' => 'The sex field is required.',
        'contactnum.required' => 'The contact numbers field is required.',
        'permaddress.required' => 'The permanent address field is required.',
        'curraddress.required' => 'The current address field is required.',
        'major.required' => 'The major field is required.',
        'yeargrad.required' => 'The year graduated field is required.',
        'yeargrad.date_format' => 'The year graduated field must be a valid year.',
        'companyname.required' => 'The company name field is required.',
        'position.required' => 'The position field is required.',
        'companyaddress.required' => 'The company address field is required.',
        'companyemail.required' => 'The company email field is required.',
        'companyemail.email'  => 'The company email must be a valid email address.',
        'companycontactnum.required' => 'The company contact number field is required.',
    ];
}
    public function rules()
    {
        return [
            'studnum' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'bday' => 'required|date',
            'sex' => 'required',
            'contactnum' => 'required|digits:11',
            'permaddress' => 'required',
            'curraddress' => 'required',
            'major' => 'required',
            'yeargrad' => 'required|date_format:"Y"',
            'companyname' => 'required',
            'position' => 'required',
            'companyaddress' => 'required',
            'companyemail' => 'required|email',
            'companycontactnum' => 'required'
            //
        ];
    }
}