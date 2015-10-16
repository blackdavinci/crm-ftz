<div class="row">
	<div class="col-md-12">
		<table class="table table-user table-striped">
			@foreach($users as $user)
			<tr id="titre-haut" @if($user->active == 1) class='desactived' @endif >
				<td><a href="{{ route('users.show',[$user->id])}}">{{ $user->name.' '.$user->prenom }}</a></td>
				<td>{{ $user->fonction}}</td>
				<td>@if($user->role=='admin') Administrateur @else Utilisateur @endif</td>
				<td class="action-user">
				  	<ul>
				 		<li style="margin-bottom: 12px"><a href="{{ route('users.destroy',[$user->id])}}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></li>
				 		<li><a href="#" data-toggle="modal" data-target="#myModalListe"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></li>
				 		<li style="margin-bottom: 12px"><a href="{{ route('users.edit',[$user->id])}}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
				 	</ul> 
				</td>
			</tr>
			
			@endforeach
		</table>
	</div>
</div>
@section('script')
	$(document).ready(function(){
	
		$('#titre-haut').hover(function(){
			$('.action-user').toogle();
		});

	});
@stop
