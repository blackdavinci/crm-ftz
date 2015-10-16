@extends('default')

{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']) /*--}}

@section('head')
	<script src="{{ $WEBROOT }}/js/jquery.min.js"></script>
    <script src="{{ $WEBROOT }}/js/moment.min.js"></script>
    <script src="{{ $WEBROOT }}/js/fullcalendar.min.js"></script>
     <script src="{{ $WEBROOT }}/js/fr.js"></script>
    <link rel="stylesheet" href="{{ $WEBROOT }}/css/fullcalendar.min.css"/>
@stop

@section('title','Agenda')
@section('titre-entete','Agenda')

@include('default.top-nav')
@include('default.left-nav')


@section('content')


<!-- Affichage calendrier -->
{!! $calendar->calendar() !!}
 {!! $calendar->script() !!}

<div id="calendarModal" class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
            <h4 id="modalTitle" class="modal-title"></h4>
        </div>
        <div id="modalBody" class="modal-body"> </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>

@stop

@section('script')

$('#calendar').fullCalendar({
    lang: 'fr'
},
 eventClick:  function(event, jsEvent, view) {
            $('#modalTitle').html(event.title);
            $('#modalBody').html(event.description);
            $('#eventUrl').attr('href',event.url);
            $('#calendarModal).modal();
        }

})


@stop

