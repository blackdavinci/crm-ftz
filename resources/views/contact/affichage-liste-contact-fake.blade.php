@extends('default')


  @section('titre-entete','Contact')
  @section('titre-entete','Contact')


@include('default.top-nav')
@include('default.left-nav')

@include('contact.bar-menu')

@section('content')
    
  

  <div class="col-md-3 content-sidebar" >
      <!-- GROUPE CRM  -->
      <div class="col-md-12">
        <p>Groupe CRM</p>
      </div>
      <div class="col-md-12">
        <a href="{{ route('groupe.create')}}">
          <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> Nouveau Groupe CRM
        </a>
      </div>  
      <div class="col-md-12">
        <a href="{{ route('groupe.index')}}">
          <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Liste Groupe CRM
        </a>
      </div>    
      <!-- IMPORTATION / EXPORTATION -->
      <div class="col-md-12">
        <br/>
        <p>Importer / Exporter</p>
      </div>
      <div class="col-md-12">
        <a href="{{ route('import.index')}}">
          <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span> Importer des contacts
        </a>
      </div>  
      <div class="col-md-12">
        <a href="{{ route('export.index')}}">
          <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Exporter des contacts
        </a>
      </div>                      
  </div>

@stop




