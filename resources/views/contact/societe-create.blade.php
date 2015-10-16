@extends('default')

@section('title','Contact')
@section('titre-entete','Nouvelle sociétés')

@include('default.top-nav')
@include('default.left-nav')

@section('menu')

  {!! Form::open(['url' => route('societe.store'), 'method'=>'POST']) !!}

  <div id="navbar-action" class="navbar-collapse collapse navbar-righ" style="padding-left:0px;">
    <div class="navbar-form navbar-left" style="padding-left:0px;" >
      <a class="btn btn-default btn-smenu-position" href="{{ route('societe.index')}}" role="button">
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Retour
      </a>
      <div class="form-group">
          {!! Form::submit('Enregistrer + Nouveau contact',[
            'name' => 'add_contact',
            'class' =>'btn btn-warning btn-smenu-position',
            ])
          !!}
      </div>
        <div class="form-group ">
        {!! Form::submit('Enregistrer',['class' =>'btn btn-success btn-smenu-position']) !!}
      </div>
    </div>  
  </div>

@stop

@section('content')

<div class="row">

  <!-- Information de base sur la société -->
  <div class="col-md-4">
    <header class="head-title">
      <h4>Information de base</h4>
      <div class="trait pull-left"></div>
    </header>
    <div class="form-group">
        <div class="col-sm-12">
          {!! Form::label('societe','Société') !!}
        {!! Form::text('nom_clt',null, ['class' =>'form-control input-sm', 'id'=>'check', 'placeholder'=>'Nom de la société']) !!}
        <div id="feedback"></div>
      </div>
    </div>
    
      
  </div>
  <!-- information Troisième Adresse-->
      <div class="col-md-4">
        <header class="head-title">
          <h4>Contact(s)</h4>
          <div class="trait pull-left"></div>
        </header>
       
      </div>

      <!-- Addresse de la société -->
      <div class="col-md-4">
        <header class="head-title">
          <h4>Adresses</h4>
          <div class="trait pull-left"></div>
        </header>
        

       </div>
    </div>

{!! Form::close() !!}

@include('errors.list')

@stop

