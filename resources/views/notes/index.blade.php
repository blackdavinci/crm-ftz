@extends('default')

@section('title','Notes')
@section('titre-entete','Notes')

@include('default.top-nav')
@include('default.left-nav')
@include('notes.bar-menu')
@section('content')
  


<div class="col-md-10 col-md-offset-1">
@if (count($note_auj) || count($note_futur) ||count($note_past))

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

@if (isset($note_auj) && count($note_auj))

  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Aujourd'hui
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">

 @include('notes.notes-auj')
      </div>
    </div>
  </div>
  
 @endif
 
    @if (isset($note_futur) &&count($note_futur)) 

  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          
          A venir

        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        
         @include('notes.notes-futur')

      </div>
    </div>
  </div>

  @endif

    @if (isset($note_past) && count($note_past))

  <div class="panel panel-primary">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Notes ultérieures
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
       
        @include('notes.notes-past')

      </div>
    </div>
  </div>

 @endif

</div>
@else
    <h1>
        <p align='center' style="color:#ddd">Aucune note</p>
    </h1>
@endif
</div>
  <div class="col-md-2 content-sidebar" >

    
    

    </div>

    <!-- Modal de confirmation de suppression -->

  <div class="modal fade" id="myModalListe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Suppression de note</h4>
        </div>
        <div class="modal-body">
          Voulez-vous vraimment supprimer la note <strong><span class="nom-remove"></span> </strong> ?
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <div class="pull-right" style="margin-left:5px;">
          
            <form class="delete-form" role="form" method="POST" >
              <input name="_method" type="hidden" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              {!! Form::submit('Supprimer',['class'=>'btn btn-warning btn-smenu-position'])!!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>

@stop

@section('script')

jQuery(function($){

<!-- Function pour la suppression direct -->
$('.glyphicon-remove').click(function(){
  var id = $(this).attr('id');
  var nom = $(this).attr('alt');
  $('.nom-remove').html(nom);

  $('.delete-form').attr('action','notes/'+id);
  
});



});

@stop