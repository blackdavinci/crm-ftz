
@section('menu')

	<div class="masthead">
		<div class="pull-right" style="margin:4px;">
		   	{!! Form::submit('Enregistrer',['class' =>'btn btn-success'])!!}
			 <a class="btn btn-danger btn-smenu-position ajout"  href="{{ route('societedata.show',[$profil->id])}}"  role="button">
			 	Annuler
			 </a>
		</div>
	</div>
@stop


@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> Il y a quelques problèmes avec les champs suivants.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="row">
	<div class="col-md-12">
	{!! Form::open(['route' =>['gescomconfig.update',$profil->id], 'method'=>'PUT', 'files' => true]) !!}
		<table class="table table-user table-noborder-top">
			<tr>
				<th>Devise</th>
				<td><input type="text" class="form-control" value="{{$profil->devise}}" name="devise" ></td>
			</tr>
			<tr>
				<th>Prefixe sur document</th>
				<td><input type="text" class="form-control" value="{{$profil->prefix_id}}" name="prefix_id" placeholder="Ex: (EL BAZINI)ELB, (OUSMANE) OC, (HASSANE) HAS,.."></td>
			</tr>
			<tr>
				<th>Numéro de Compte bancaire</th>
				<td><input type="text" class="form-control" value="{{$profil->bank_account}}" name="bank_account" ></td>
			</tr>
			<tr>
				<th>Code Swift</th>
				<td><input type="text" class="form-control" name="code_swift" value="{{ $profil->code_swift }}" placeholder="Référence de la société"></td>
			</tr>
			<tr>
				<th>Société Bancaire</th>
				<td><input type="text" class="form-control" name="bank_society" value="{{ $profil->bank_society }}" placeholder="Nom de la société bancaire"></td>
			</tr>
			<tr>
				<th>Code Agence</th>
				<td><input type="text" class="form-control" name="codeagencebank" value="{{ $profil->codeagencebank }}"></td>
			</tr>

			<tr>
				<th>IBAN</th>
				<td><input type="text" class="form-control" name="iban_bank" value="{{ $profil->iban_bank }}" ></td>
			</tr>
			<tr>
				<th>Adresse de la société bancaire</th>
				<td>{!! Form::textarea('adressebank',$profil->adressebank, ['class' =>'form-control input-sm', 'placeholder'=>'Adresse de la société bancaire','rows' => '7']) !!}</td>
			</tr>
			<tr>
				<th>Taux ANPME</th>
				<td><input type="text" class="form-control" name="taux_anpme" value="{{ $profil->taux_anpme }}" ></td>
			</tr>
			<tr>
				<th>Taux de remise</th>
				<td><input type="text" class="form-control" name="taux_remise" value="{{ $profil->taux_remise }}" ></td>
			</tr>

			
			<tr>
				<td></td>
				<td>{!! Form::submit('Enregistrer',['class' =>'btn btn-primary'])!!}
				<a class="btn btn-danger btn-smenu-position ajout"  href="{{ route('gescomconfig.show',[$profil->id])}}"  role="button">
						Annuler
					</a>
				</td>
			</tr>
		</table>
		{!! Form::close() !!}
	</div>
</div>
@section('script')
	function checkURL (abc) {
	    var string = abc.value;
	    console.log(abc);
	    if (!~string.indexOf("http")){
	        console.log("abcd");
	        string = "http://" + string;
	    }
	    abc.value = string;
	    return abc
	}
		$(document).ready(function(){

			$('#pays').select2();
			$("#input-fr").fileinput({
			    language: "fr",
			    uploadUrl: "/file-upload-batch/2",
			    allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
			});

		});
@stop
