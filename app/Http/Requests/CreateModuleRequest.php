<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateModuleRequest extends Request {

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
			'nom_module'=>'required',
			'type_module'=>'required',
			'produit_id'=>'required',
		];
	}

	public function messages()
    {
        return [
            'nom_module.required' => 'Nom du module obligatoire',
            'type_module.required' => 'Type du module obligatoire',
            'produit_id.required' => 'Le choix du produit auquel appartient le module est obligatoire'
        ];
    }

}
