@extends('default')

{{--*/ $WEBROOT = dirname($_SERVER['SCRIPT_NAME']) /*--}}

@section('title','Agenda')
@section('titre-entete','Agenda')

@include('default.top-nav')
@include('default.left-nav')


@section('content')


{{--*/ 

  $object = new App\Helpers\Datecalendrier; 

  $date = new App\Helpers\Datecalendrier;
  $year = date('Y');
  $dates = $date->getAll($year);


/*--}}

@if($type=='perso')
  {{--*/   $notes = $date->getNotesPerso($year); /*--}}
@else
  {{--*/   $notes = $date->getNotes($year); /*--}}
@endif

<div class="panel panel-default">
  <div class="panel-heading"><strong>Calendrier</strong></div>
  <div class="panel-body" >
  <!-- Début Calendrier -->
  <div class="col-md-12">
    <!-- Ligne de l'année en cours -->
    <div class="row">
      <div class=" col-md-9 periods annee">
        {{ $year }}
      </div>
    </div>

  <!-- Ligne des mois de l'année -->
    <div class="row">
      <div class=" col-md-12 periods ">
        <div class="months">
          <ul class="list-inline">
            @foreach ($date->months as $id => $m)
              <li><a href="#" id="linkMonth{{$id+1}}">{{ utf8_encode(substr(utf8_decode($m),0,3)) }}</a> </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
<!-- AFFICHAGE JOURS DU CALENDRIER -->
    <div class="row">
      <div class="col-md-9" >
        {{--*/  $dates = current($dates) ; $ligne = 1;/*--}}
        @foreach ($dates as $m => $days)
          <div class="periods">
            <div class="month pull-left" id="month{{$m}}" >
              <table class="" id="calendrier" >
                <thead>
                  <tr>
                    @foreach ($date->days as $d)
                      <th class="days" style="height:50px;"> {{$d}}</th>
                    @endforeach
                  </tr>
                </thead>

                <tbody>
                <tr>
                {{--*/ $end = end($days) /*--}} 

                @foreach ($days as $d => $w) 

                  {{--*/ $time = strtotime($year.'-'.$m.'-'.$d); $today = strtotime(date('Y-n-j')); /*--}} 
                  

                  @if($d == 1 AND $w != 1) 
                      <td colspan=" {{$w-1}}" style="border:0px; background:white;"></td>
                  @endif
                    <td class="daysweek  @if($time == $today) {{ 'today '}} @endif" >

                        {{--*/ $c=0 /*--}}
                        <div class="col-md-12 nbre-day" > {{$d}} </div>
                        <div class="row">
                            <div class="col-md-12">
                              @foreach($notes as $note)
                                @if(strtotime($note->echeance) == $time)
                                  {{--*/ $c++ /*--}}
                                  @if($note->categorie == 'A faire')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif  label-info   pull-left" >
                                     <div id="inf"></div>
                                    </a>
                                  @elseif($note->categorie == 'Appel téléphonique')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-primary pull-left" >
                                     <div id="inf"></div>

                                    </a>
                                  @elseif($note->categorie == 'E-mail')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-warning pull-left" >
                                     <div id="inf"></div>
                                     
                                    </a>
                                  @elseif($note->categorie == 'Réunion')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-success pull-left" >
                                     <div id="inf"></div>
                                   
                                    </a>
                                  @elseif($note->categorie == 'Autre')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-default pull-left" >
                                     <div id="inf"></div>
                                     
                                    </a>
                                  @endif 
                                @endif
                              @endforeach  
                           </div>
                        </div>
                        <div class="row">
                         <div class="col-md-12 bottom-row">
                           @if($c!=0)
                              <a class="show-line" datasrc="col{{$ligne}}" id="{{$time}}" data-toggle="collapse" href=".col{{$ligne}}" aria-expanded="false" aria-controls="col{{$ligne}}">
                                <span class="glyphicon glyphicon-chevron-down display-note" aria-hidden="true"></span>
                              </a>

                             {{--*/ $c++ /*--}}
                           @endif
                          </div>
                        </div>
                          
                       
                    </td>
                  @if ($w == 7)  
                    </tr>
                    <tr class="collapse col{{$ligne}}" id="collapseExample">
                      <td colspan="7">
                        <div >
                          <div class="well-custom contentcol{{$ligne}}">
                           
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                    {{--*/ $ligne++ /*--}}
                  @endif 
                 
              @endforeach

              @if($end !=7) 
                <td colspan="{{ 7-$end }}" style="border:0px;background:white;"></td>
                <tr class="collapse col{{$ligne}}" id="collapseExample">
                      <td colspan="7">
                        <div >
                          <div class="well-custom contentcol{{$ligne}}">
                          
                          </div>
                        </div>
                      </td>
                </tr>
                 {{--*/ $ligne++ /*--}}
              @endif
              </tr>
              
                </tbody>
              </table>

            </div>
          </div>
        @endforeach
      </div>

      <div class="col-md-3 content-sidebar">
            <p>AFFICHER SUR LE CALENDRIER</p>

            <form class="form-horizontal" role="form" method="GET" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="faire" value="A faire"> A faire
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="appel" value="Appel téléphonique"> Appel téléphonique
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="autre" value="Autre"> Autre
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="email" value="E-mail"> E-mail
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="reunion" value="Réunion"> Réunion
                  </label>
              </div>

            </form>
      
      </div>
    
      </div>
    </div>
      <!-- Fin du calendrier -->

      <!-- Début Tri -->
      <!-- <div class="col-md-3" >
        <div class="row">
          <div class="col-md-12 content-sidebar">
            <p>AFFICHER SUR LE CALENDRIER</p>

            <form class="form-horizontal" role="form" method="GET" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="faire" value="A faire"> A faire
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="appel" value="Appel téléphonique"> Appel téléphonique
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="autre" value="Autre"> Autre
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="email" value="E-mail"> E-mail
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="reunion" value="Réunion"> Réunion
                  </label>
              </div>

            </form>
      
          </div>
        </div>
      </div> -->
      <!-- Fin Tri -->
    
    <!-- Début légende -->
    <div class="row">
      <div class="col-md-12" style="margin-left:10px;">
      <h4>
          <span class="label label-info">A faire</span>
          <span class="label label-primary">Appel téléphonique</span>
          <span class="label label-default">Autre</span>
          <span class="label label-warning">E-mail</span>
          <span class="label label-success">Réunion</span>
      </h4>

      </div>
    </div>

    <!-- Fin légende -->

    </div>
  </div>
  
    
@stop



@section('script')

 jQuery(function($){
 
  var maintenant = new Date();
  var mois = maintenant.getMonth();
  
  $('.month').hide();
  $('.month:eq('+mois+')').show();
  $('.months a:eq('+mois+')').addClass('active');
  var current = 1;
  $('.months a').click(function(){
   var month = $(this).attr('id').replace('linkMonth','');
     if(month != current){
     $('.month:eq('+mois+')').hide();
     $('#month'+current).hide();
     $('#month'+month).show();
     $('.months a').removeClass('active');
     $('.months a#linkMonth'+month).addClass('active');
     current = month;
     }
   
    return false;
   });

  $('.show-line').click(function(e){
    e.preventDefault();
   var time = $(this).attr('id');
   var ligne_num = $(this).attr('datasrc');
   var ligne = 'content'+ligne_num;
   
   $.getJSON('NotesSelect', { time : time }, function(data) {
      console.log(data);
      $('.'+ligne).html('');
        $.each(data.nom,function(key, value) {
          if(data.categorie[key]=='A faire'){
            var v = 12;
            $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-info">'+value+'</span></a> '+data.designation[key]+' <br/> ');
          }
          if(data.categorie[key]=='Appel téléphonique'){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-primary">'+value+'</span></a> '+data.designation[key]+' <br/> ');
          }
          if(data.categorie[key]=='Réunion'){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-success">'+value+'</span></a> '+data.designation[key]+' <br/> ');
          }
          if(data.categorie[key]=='E-mail'){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-warning">'+value+'</span></a> '+data.designation[key]+' <br/> ');
          }
          if(data.categorie[key]=='Autre'){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-default">'+value+'</span></a> '+data.designation[key]+' <br/> ');
          }
        });

   });

  });
  
  
 });
@stop