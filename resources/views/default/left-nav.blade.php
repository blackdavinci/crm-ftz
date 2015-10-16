@section('left-nav')
  <ul class="nav nav-tabs tabs-left">
	<li @if ($actif === 0) class='active' @endif>
		<a href="{{action('WelcomeController@index')}}" >
			<span class="glyphicon glyphicon-home" aria-hidden="true"></span>Accueil
		</a>
	</li>
	<li @if ($actif === 'contact') class='active' @endif>
		<a href="{{route('societe.index')}}" >
			<span class="glyphicon glyphicon-book" aria-hidden="true"></span>Annuaire
		</a>
	</li>
	<li @if ($actif === 'notes') class='active' @endif>
		<a href="{{route('notes.index')}}" >
			<span class="glyphicon glyphicon-check" aria-hidden="true"></span>Notes
		</a>
	</li>
	<li @if ($actif === 'agenda') class='active' @endif>
		<a href="{{route('agenda.calendrier')}}" >
			<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Agenda
		</a>
	</li>
	@if (Auth::user()->role == 'admin')
	<li @if ($actif === 'gescom') class='active' @endif>
		<a href="{{route('gescom.index')}}" >
			<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>Gestion commerciale
		</a>
	</li>
		<li @if ($actif === 'rapport') class='active' @endif>
		<a href="{{route('rapport.index')}}" >
			<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>Rapport
		</a>
	</li>
	@endif
  </ul>
@stop