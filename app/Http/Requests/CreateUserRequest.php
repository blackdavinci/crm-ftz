<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request {

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
			'name' => 'required',
			'password' => 'required|confirmed|min:6',
			'prenom' => 'required',
			
		];
	}

	public function messages()
    {
        return  [
            'name.required' => 'Nom non renseigné',
            'prenom.required' => 'Prenom(s) non renseigné(s)',
            'password.required' => 'Mot de passe à renseingé avec minimum 6 caractères'
        ];
    }

}
