<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDevisRequest extends Request {

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
			'societe_id'=>'required',
			'module_id'=>'required',
			
		];
	}

	public function messages()
    {
        return [
            'module_id.required' => 'Aucun module sélectionné pour cet devis ',
            'societe_id.required' => 'Aucune société sélectionnée pour cet devis',
            'produit.min'=>'La quantité de produit doit être supérieur ou égal à 1'
        ];
    }

}
