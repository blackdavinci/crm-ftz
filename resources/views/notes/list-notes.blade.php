@extends('default')


@section('title','Contact')

@section('titre-entete')

    <div class="pull-left" style="margin:-6px 4px 4px 4px;">
        @if($contact->societe)
            <a class="btn btn-danger btn-smenu-position" href="{{ route('societe.show',[$contact->societe_id])}}" role="button">
                <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> 
            </a>
        @endif
        @if($contact->societe){{ 'Contact Société '.$contact->societe->nom_clt.' : ' }} @endif {{ $contact->nom_contact.' '.$contact->prenoms_contact}}
    </div>


@stop

@include('default.top-nav')
@include('default.left-nav')


@section('menu')

    <div class="masthead">
        <div class="inner">
          <nav>
            <ul class="nav masthead-nav">
              <li><a href="{{ route('contact.show',[$contact->id])}}">Informations</a></li>
              <li class="active"><a href="#">Notes</a></li>
              <li><a href="#">Fichiers</a></li>
              <li><a href="#">Historique</a></li>
            </ul>
          </nav>
        </div>
        <div class="pull-right" style="margin:4px;">
                
            <!-- Button de creation de notes -->
            <a class="btn btn-primary btn-smenu-position" href="{{route('creer.note',[$contact->id])}}" role="button">
                <span class="glyphicon glyphicon-copy" aria-hidden="true"></span> Creer une Note
            </a>

            <a class="btn btn-warning btn-smenu-position" href="{{ route('contact.edit',[$contact->id])}}" role="button">
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
                    <h4 class="modal-title" id="myModalLabel">Suppression du contact</h4>
                  </div>
                  <div class="modal-body">
                    Voulez-vous vraimment supprimer le contact <strong>{{ $contact->nom_contact.' '.$contact->prenoms_contact }}</strong> ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <div class="pull-right" style="margin-left:5px;">
                        {!! Form::open(['url'=> route('contact.destroy',[$contact->id]), 'method'=>'delete']) !!}
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
                     
            


{{--*/ $back = 3; 
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
        


        @if ($note->etat=='1')
                 
      
        {!!'<tr class="'.$typ.'">'!!}
          <td width="7%">{!! $i!!}</td>
                <td ><span class="info">{!! $note->nom!!}&nbsp;&nbsp;</span>   
                        {!!'<span class="label label-'.$cat.'">' !!}{!!$note->type!!}&nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>&nbsp;&nbsp;{!!$note->categorie !!}</span>
                                          
                    <div class="action" style=" margin-bottom:0px">
                        <ul >
                             <li><a href="{!! route('modifier.note',[$note,$back]) !!}" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                             </a></li>
                            <li><a href="{!! route('afficher.note',[$note,$back]) !!}" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </a></li>
                       </ul> 
                    </div>

                </td>
        </tr>

      
      {{--*/ $i++; /*--}}
       @endif
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
