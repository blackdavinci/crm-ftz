@extends('default')

@section('content')

<ul class="nav nav-tabs tabs-left">
	<li class="{{ isset($title)=='accueil' ? 'active' : '' }}"><a href="accueil" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil</a></li>
	<li><a href="contact" data-toggle="tab"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>Contact</a></li>
	<li><a href="#note" data-toggle="tab"><span class="glyphicon glyphicon-check" aria-hidden="true"></span>Notes</a></li>
	<li><a href="#agenda" data-toggle="tab"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Agenda</a></li>
	<li><a href="#gescom" data-toggle="tab"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>Gestion commerciale</a></li>
	<li><a href="#rapport" data-toggle="tab"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>Rapport</a></li>
</ul>

@stop