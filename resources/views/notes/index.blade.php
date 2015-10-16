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

@stop