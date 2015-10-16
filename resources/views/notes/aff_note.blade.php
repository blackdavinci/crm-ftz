@extends('default')

@section('title','Notes')
@section('titre-entete','Notes')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')

	<div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
		<div class="navbar-form navbar-left" style="padding-left:0px;" >

			@if($back==0)
			{{--*/ $back = 0; /*--}}
				<a class="btn btn-default btn-smenu-position" href="{{ route('contact.show', [$note->contact_id])}}" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Contact
				</a>
			@elseif($back==1)
			{{--*/ $back = 1; /*--}}
				<a class="btn btn-default btn-smenu-position" href="{{ route('notes.index')}}" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Notes
				</a>
				
			@elseif($back==3)
			{{--*/ $back = 3; /*--}}
				<a class="btn btn-default btn-smenu-position" href="{{ route('liste.note',[$note->contact_id,$back])}}" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
				</a>
			@else
			{{--*/ $back = 4; 
/*--}}
				<a class="btn btn-default btn-smenu-position" href="{{ route('societe.note',[$profil,$back])}}" role="button">
					<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
				</a>
			@endif
		</div>
		  	
		  	<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<a class="btn btn-warning btn-smenu-position" href="{{ route('modifier.note',[$note,$back])}}" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
			</a>
		</div>


<!-- Button de Suppression modal -->
<div class="navbar-form navbar-left" style="padding-left:0px;" >
			<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Supprimer
			</button>
			</div>


			<!-- Modal de confirmation de suppression -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      	<div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              		<h4 class="modal-title" id="myModalLabel">Suppression de la note</h4>
            	</div>
            	
            	<div class="modal-body">
              		Voulez-vous vraimment supprimer la note <strong>{{ $note->nom }}</strong> ?
            	</div>

            	<div class="modal-footer">
            		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

            		<div class="pull-right" style="margin-left:5px;">
                		{!! Form::open(['url'=> route('supprimer.note',[$note->id,$back]), 'method'=>'delete']) !!}
                  		{!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
                		{!! Form::close() !!}
					</div>
            	</div>	
         	</div>
        </div>

	  </div>
@stop

@section('content')

           @if ($note->categorie=='A faire')
                {{--*/ $cat='info'; /*--}}
            @elseif ($note->categorie=='Appel téléphonique') 
                {{--*/ $cat='danger'; /*--}}
            @elseif ($note->categorie=='E-mail') 
                {{--*/ $cat='warning'; /*--}} 
            @elseif ($note->categorie=='Réunion') 
                {{--*/ $cat='success'; /*--}} 
            @else
                {{--*/ $cat='default'; /*--}}      
            @endif



{!!'<div class="panel panel-'.$cat.'">' !!}
   	
  		<div class="panel-heading">
    		Détail de la note
  		</div>
  		<div class="panel-body">
  			<table class=" table-noborder-top  table-contact table " >
   			<tr > 
	  			<td><span class="title-note">Titre de la note  :  </span>
	  				<span class="info">{{ $note->nom }}</span>
	  			</td>
	  		</tr>
	  		
	  		<tr > 
	  			<td><span class="title-note">Etiquette :  </span>
	  				<span class="info">{{ $note->categorie }}</span>
	  			</td>
	  		</tr>

	  		<tr > 
	  			<td><span class="title-note">A faire par :  </span>
	  				<span class="info"> <a href="{{ route('users.show',[$note->user->id])}}">{{ $note->user->name.' '.$note->user->prenom }}</a></span>
	  			</td>
	  		</tr>


	  		<tr > 
	  			<td><span class="title-note">Catégorie :  </span>
	  			<span class="info">{{$note->type}}</span></td>
	  		</tr>

	  		<tr > 
	  			<td><span class="title-note">Attribué à  :  </span>
	  				<span class="info">
		  				<a href="{{ route('contact.show',[$note->contact->id])}}">{{ $note->contact->nom_contact.' '.$note->contact->prenoms_contact }} </a>
		  				<a href="{{ route('societe.show',[$note->contact->societe->id])}}">({{$note->contact->societe->nom_clt}})</a>
	  				</span>
	  			</td>
	  		</tr>

	  		<tr > 
	  			<td><span class="title-note">Echéance  : </span>
					{{--*/ $date = new DateTime($note->echeance); /*--}}
	  				<span class="info">{{ $date->format('d-m-Y')}}</span>
	  			</td>
	  		</tr>
	  		</table>

	  		<span class="info">Description</span>
			<div class="well">
   				 {{ $note->designation }} 
  			</div>

  		</div>
  		
</div>
            
						
			
	
		
</div>				

@stop
