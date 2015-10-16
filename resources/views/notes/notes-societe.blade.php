@extends('default')


@section('title','Contact')
@section('titre-entete','Profil Société '.$profil->nom_clt)

@include('default.top-nav')
@include('default.left-nav')

@section('menu')
	<div class="masthead">
		<div class="inner">
		  <nav>
			<ul class="nav masthead-nav">
			  <li><a href="{{route('societe.show',[$profil->id])}}">Informations</a></li>
			  <li class="active"><a href="#">Notes</a></li>
			  <li><a href="#">Fichiers</a></li>
			  <li><a href="#">Historique</a></li>
			</ul>
		  </nav>
		</div>
		<div class="pull-right" style="margin:4px;">
		    <a class="btn btn-primary btn-smenu-position" href="{{ route('creer.contact',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Ajout contact
			</a>
		    <a class="btn btn-warning btn-smenu-position" href="{{ route('societe.edit',[$profil->id])}}" role="button">
				<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Modifier | Mise à jour
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
			        Voulez-vous vraimment supprimer la société <strong>{{ $profil->nom_clt }}</strong> ?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
			        <div class="pull-right" style="margin-left:5px;">
				        {!! Form::open(['url'=> route('societe.destroy',[$profil->id]), 'method'=>'delete']) !!}
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

@section('content')

<div class="table-responsive ">
        <table  class="table table-condensed table-contact" >
                     
            


{{--*/ $back = 4; 
        $i=1; 
        $cat=''; 
        $typ=''; 
 /*--}}
@if (count($notes))
    @foreach ($notes as $note)

             
            @if ($note->type=='Prospect')
                {{--*/ $cat='primary'; /*--}}
            @elseif ($note->type=='Prospect à revoir') 
                {{--*/ $cat='default'; /*--}}
            @elseif ($note->type=='Client') 
                {{--*/ $cat='success'; /*--}} 
            @elseif ($note->type=='Refus') 
                {{--*/ $cat='danger'; /*--}} 
            @else
                {{--*/ $cat='warning'; /*--}}      
            @endif

            @if ($note->categorie=='A faire')
                {{--*/ $typ='info'; /*--}}
            @elseif ($note->categorie=='Appel téléphonique') 
                {{--*/ $typ='danger'; /*--}}
            @elseif ($note->categorie=='E-mail') 
                {{--*/ $typ='warning'; /*--}} 
            @elseif ($note->categorie=='Réunion') 
                {{--*/ $typ='success'; /*--}} 
            @else
                {{--*/ $typ='default'; /*--}}      
            @endif
      
      
                 
      
        {!!'<tr class="'.$typ.'">'!!}
          <td width="7%">{!! $i!!}</td>
                <td ><span class="info">{!! $note->nom!!}&nbsp;&nbsp;</span>   
                        {!!'<span class="label label-'.$cat.'">' !!}{!!$note->type!!}&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>&nbsp;&nbsp;{!!$note->categorie !!}</span>
                                          
                    <div class="action" style=" margin-bottom:0px">
                        <ul >
                             <li><a href="{{  route('modifier.note',[$note->id,$back]) }}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                             </a></li>
                            <li><a href="{{ route('afficher.note',[$note->id,$back]) }}" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a></li>
                       </ul> 
                    </div>

                </td>
        </tr>

      
      {{--*/ $i++; /*--}}
      @endforeach

@else
    <h1>
        <p align='center' style="color:#ddd">Aucune note</p>
    </h1>
@endif
    
    </table>
        {!! str_replace('/?', '?', $notes->render()) !!}

</div>
	

@stop
