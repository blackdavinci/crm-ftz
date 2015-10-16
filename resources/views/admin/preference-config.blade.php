
@section('menu')
	<div class="masthead">
		
		<div class="pull-right" style="margin:4px;">

			@if(empty($profil->id))
			 <a class="btn btn-primary btn-smenu-position" href="{{ route('preference.create')}}"  role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Nouvelles données
			</a>
			@endif
			@if(!empty($profil->id))
		    <a class="btn btn-warning btn-smenu-position" @if(!empty($profil->id))href="{{ route('preference.edit',[$profil->id])}}" @endif role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
			</a>
	
			<!-- Button de Suppression modal -->
			<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
			</button>
			@endif
			<!-- Modal de confirmation de suppression -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer ces données sur la société @if(!empty($profil->nom))<strong>{{ $profil->nom }}</strong> ? @endif
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
			        @if(!empty($profil->id))
				        {!! Form::open(['url'=> route('preference.destroy',[$profil->id]), 'method'=>'delete']) !!}
				      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
				      	{!! Form::close() !!}
				    @endif
			      	</div>

			      </div>
			    </div>
			  </div>
			</div>
			 
		</div>
	</div>
@stop

@if(!empty($profil->id))
<div class="row">
	<div class="col-md-12">
		<table class="table table-user table-noborder-top">
			<tr>
				<th>Logo</th>
				<td><img src="{{$WEBROOT}}img/uploads/{{$profil->logo}}" alt="Photo de profil" class="img-thumbnail" id="photo"></td>
			</tr>
			<tr>
				<th>Nom</th>
				<td>{{ $profil->nom }}</td>
			</tr>
			<tr>
				<th>Numéro de Registre Commercial</th>
				<td>{{ $profil->num_rc }}</td>
			</tr>
			<tr>
				<th>Effectif</th>
				<td>{{ $profil->effectif }}</td>
			</tr>
			<tr>
				<th>Chiffre d'affaire</th>
				<td>{{ $profil->ca }}</td>
			</tr>
			<tr>
				<th>Numéro de Compte bancaire</th>
				<td>{{ $profil->bank_account }}</td>
			</tr>
			<tr>
				<th>Code Swift</th>
				<td>{{ $profil->code_swift }}</td>
			</tr>
			<tr>
				<th>Société Bancaire</th>
				<td>{{ $profil->bank_society }}</td>
			</tr>
			<tr>
				<th>Référence société</th>
				<td>{{ $profil->ref_societe }}</td>
			</tr>
			<tr>
				<th>Numéro Fiscal</th>
				<td>{{ $profil->num_fiscal }}</td>
			</tr>
			<tr>
				<th>Numéro TVA</th>
				<td>{{ $profil->num_tva }}</td>
			</tr>
			<tr>
				<th>Pays</th>
				<td>{{ $profil->pays }}</td>
			</tr>
			<tr>
				<th>Ville</th>
				<td>{{ $profil->ville }}</td>
			</tr>
			<tr>
				<th>Téléphone</th>
				<td>{{ $profil->tel }}</td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td>{{ $profil->email }}</td>
			</tr>
			<tr>
				<th>URL</th>
				<td>{{ $profil->url }}</td>
			</tr>
			<tr>
				<th>Fax</th>
				<td>{{ $profil->fax }}</td>
			</tr>
			<tr>
				<th>Adresse</th>
				<td>{{ $profil->adresse }}</td>
			</tr>
		</table>
	</div>
</div>
@endif
