<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSocieteDataRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom'=>'required',
            'bank_account'=>'required',
            'num_rc'=>'required',
            'code_swift'=>'required',
        ];
    }

    

}
