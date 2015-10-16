
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
	{!! Form::open(['route' =>['societedata.update',$profil->id], 'method'=>'PUT', 'files' => true]) !!}
		<table class="table table-user table-noborder-top">
			<tr>
				<th>Logo</th>
				<td>
					<input type="file" id="exampleInputFile" name="photo">
					<!-- <input id="input-fr" type="file"  name="photo" class="file-loading" data-show-preview="false"> -->
				</td>
			</tr>
			<tr>
				<th>Nom</th>
				<td><input type="text" value="{{$profil->nom}}" class="form-control" name="nom"  placeholder="Nom de votre société"></td>
			</tr>
			<tr>
				<th>Numéro de R.C</th>
				<td><input type="text" class="form-control" value="{{$profil->num_rc}}" name="num_rc" placeholder="Numéro de registre de la société"></td>
			</tr>
			<tr>
				<th>Effectif</th>
				<td><input type="number" class="form-control" name="effectif" value="{{ $profil->effectif }}" placeholder="Effectif de la société"></td>
			</tr>
			<tr>
				<th>Chiffre d'affaire</th>
				<td><input type="number" class="form-control" name="ca" value="{{ $profil->ca }}"></td>
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
				<th>Référence société</th>
				<td><input type="text" class="form-control" name="ref_societe" value="{{ $profil->ref_societe}}"></td>
			</tr>
			<tr>
				<th>Numéro Fiscal</th>
				<td><input type="text" class="form-control" name="num_fiscal" value="{{ $profil->num_fiscal }}" placeholder="Numéro fiscal de la société"></td>
			</tr>
			<tr>
				<th>Numéro TVA</th>
				<td><input type="text" class="form-control" name="num_tva" value="{{ $profil->num_tva }}" placeholder="Numéro de TVA de la société"></td>
			</tr>
			<tr>
				<th>Pays</th>
				  <!-- Récupération du nom de tous les pays -->
				  {{--*/ $listpays = Countries::getList('fr','php','cldr') /*--}} 
				@foreach($listpays as $cle=>$values)
				  {{--*/ $pays[$values]= $values /*--}}
				@endforeach
				<td>{!! Form::select('pays',$pays,$profil->pays,['class' =>'form-control input-sm','id'=>'pays']) !!}</td>
			</tr>
			<tr>
				<th>Ville</th>
				<td><input type="text" class="form-control" name="ville" value="{{ $profil->ville }}" placeholder="Ville de la société"></td>
			</tr>
			<tr>
				<th>Téléphone</th>
				<td><input type="text" class="form-control" name="tel" value="{{ $profil->tel }}" placeholder="Contact téléphonique de la société"></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td>{!! Form::input('email','email',$profil->email, ['class' =>'form-control input-sm', 'placeholder' =>'Adresse e-mail de la société']) !!}</td>
			</tr>
			<tr>
				<th>URL</th>
				<td><input type="text" class="form-control" name="url" onblur="checkURL(this)" value="{{$profil->url}}" id="url" placeholder="Adresse web de la société"></td>
			</tr>
			<tr>
				<th>Fax</th>
				<td>{!! Form::text('fax',$profil->fax, ['class' =>'form-control input-sm', 'placeholder' =>'Contact téléphonique de la société']) !!}</td>
			</tr>
			<tr>
				<th>Adresse</th>
				<td>{!! Form::textarea('adresse',$profil->adresse, ['class' =>'form-control input-sm', 'placeholder'=>'Adresse complète de la société','rows' => '7']) !!}</td>
			</tr>
			<tr>
				<td></td>
				<td>{!! Form::submit('Enregistrer',['class' =>'btn btn-primary'])!!}
				<a class="btn btn-danger btn-smenu-position ajout"  href="{{ route('societedata.show',[$profil->id])}}"  role="button">
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
