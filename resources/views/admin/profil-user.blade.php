
@section('menu')
	<div class="masthead">
		
		<div class="pull-right" style="margin:4px;">
			<!-- Button de Désactivation -->
			<a class="btn btn-default btn-smenu-position" href="{{ route('users.desactived',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Désactiver
			</a>
		    <a class="btn btn-primary btn-smenu-position" href="{{ route('users.edit',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
			</a>
			<a class="btn btn-warning btn-smenu-position" href="{{ route('users.setpassword',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Changer de mot de passe
			</a>
			
			<!-- Button de Suppression modal -->
			<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
			</button>
			<!-- Modal de confirmation de suppression -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Suppression de société</h4>
			      </div>
			      <div class="modal-body">
			        Voulez-vous vraimment supprimer cet utilisateur <strong>{{ $profil->name.' '.$profil->prenom }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('users.destroy',[$profil->id]), 'method'=>'delete']) !!}
				      		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
				      	{!! Form::close() !!}
			      	</div>

			      </div>
			    </div>
			  </div>
			</div>
			 
		</div>
	</div>
@stop

<div class="row">
	<div class="col-md-12">
		<img src="{{$WEBROOT}}img/uploads/{{$profil->photo}}" alt="Photo de profil" class="img-thumbnail" id="photo">
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-user table-noborder-top">
			<tr>
				<th>Nom</th>
				<td>{{ $profil->name }}</td>
			</tr>
			<tr>
				<th>Prénom</th>
				<td>{{ $profil->prenom }}</td>
			</tr>
			<tr>
				<th>Nom d'utilisateur</th>
				<td> {{$profil->username}}</td>
			</tr>
			<tr>
				<th>Date de naissance</th>
				<td>@if(empty($profil->bornday)) Non renseignée @else {{ $profil->bornday }} @endif</td>
				<td>{{ $profil->bornday }}</td>
			</tr>
			<tr>
				<th>Fonction</th>
				<td>{{ $profil->fonction}}</td>
			</tr>
			<tr>
				<th>Rôle</th>
				<td>@if($profil->role=="admin") Administrateur @else Utilisateur @endif</td>
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
				<th>Adresse</th>
				<td>{{ $profil->adresse }}</td>
			</tr>
			<tr>
				<th>Etat</th>
				<td>@if($profil->active== 1 ) Active @else Désactivé @endif</td>
			</tr>
		</table>
	</div>
</div>

