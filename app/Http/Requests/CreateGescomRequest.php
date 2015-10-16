<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateGescomRequest extends Request
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
            //
            'bank_account'=>'required',
            'code_swift'=>'required',
            'taux_anpme'=>'required',
            'prefix_id'=>'required',
           
        ];
    }

    public function messages()
    {
        return [
            //
            'bank_account.required'=>'Le champ N°Compte bancaire est obligatoire',
            'code_swift'=>'Le champ Code Swift est obligatoire',
            'taux_anpme'=>'Le champ Taux ANPME est obligatoire',
            'prefix_id'=>'Le champ Prefix d\'identification est obligatoire',
           
        ];
    }
}
