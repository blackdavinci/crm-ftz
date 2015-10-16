<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProduitRequest extends Request {

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
			'nom_produit'=> 'required',
		];
	}

	public function messages()
    {
        return [
            'nom_produit.required' => 'Nom du produit non renseigné'
        ];
    }

}
