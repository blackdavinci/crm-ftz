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
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif  label-info  pull-left faire" >
                                     <div id="inf"></div>
                                    </a>
                                  @elseif($note->categorie == 'Appel téléphonique')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-primary pull-left appel" >
                                     <div id="inf"></div>

                                    </a>
                                  @elseif($note->categorie == 'E-mail')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-warning pull-left email" >
                                     <div id="inf"></div>
                                     
                                    </a>
                                  @elseif($note->categorie == 'Réunion')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-success pull-left reunion" >
                                     <div id="inf"></div>
                                   
                                    </a>
                                  @elseif($note->categorie == 'Autre')
                                    <a href="#ret" id="event{{$note->id}}" class="evt notif label-default pull-left autre" >
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
                    <input type="checkbox" name="faire" value="A faire" id="faire"> A faire
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="appel" value="Appel téléphonique" id="appel"> Appel téléphonique
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="autre" value="Autre" id="autre"> Autre
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="email" value="E-mail" id="email"> E-mail
                  </label>
              </div>
              <div class="checkbox">
                  <label>
                    <input type="checkbox" name="reunion" value="Réunion" id="reunion"> Réunion
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
          
      </h4>

      </div>
    </div>

    <!-- Fin légende -->

    </div>
  </div>
  
    
@stop



@section('script')

 jQuery(function($){
 
 <!-- Script Affichage du calendrier -->
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

<!-- Script Afficahge des données d'étiquette d'une date  -->
  $('.show-line').click(function(e){
    e.preventDefault();
   var time = $(this).attr('id');
   var ligne_num = $(this).attr('datasrc');
   var ligne = 'content'+ligne_num;
   var reunion, appel, faire, email, autre = 1;


   if($('.reunion').hasClass('hide')){
     reunion = 0;
   }
   if($('.appel').hasClass('hide')){
     appel = 0;
   }
   if($('.faire').hasClass('hide')){
     faire = 0;
   }
   if($('.autre').hasClass('hide')){
     autre = 0;
   }
   if($('.email').hasClass('hide')){
     email = 0;
   }
   
   $.getJSON('NotesSelect', { time : time }, function(data) {
      console.log(data);
      $('.'+ligne).html('');
        $.each(data.nom,function(key, value) {
          if(data.categorie[key]=='A faire'){
            var v = 12;
            if(faire !=0){
              $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-info">A faire</span></a> '+value+' : '+data.designation[key]+' <br/> ');
            }
          }
          if(data.categorie[key]=='Appel téléphonique'){
            if(appel != 0){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-primary">Appel téléphonique</span></a> '+value+' : '+data.designation[key]+' <br/> ');
            }
          }
          if(data.categorie[key]=='Réunion'){
            if(reunion != 0){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-success">Réunion</span></a> '+value+' : '+data.designation[key]+' <br/> ');
            }
          }
          if(data.categorie[key]=='E-mail'){
            if(email !=0){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-warning">E-mail</span></a> '+value+' : '+data.designation[key]+' <br/> ');
            }
          }
          if(data.categorie[key]=='Autre'){
            if(autre !=0){
             $('.'+ligne).append('<a href="'+data.id[key]+'/afficher-note/1"><span class="label label-default">Autre</span></a> '+value+' : '+data.designation[key]+' <br/> ');
            }
          }
        });

   });

  });

  <!-- Action sur choix du type d'étiquette a afficher -->
  

  if($('#autre').prop('checked') == false && $('#faire').prop('checked') == false && $('#appel').prop('checked') == false && $('#reunion').prop('checked') == false && $('#email').prop('checked') == false){
    $('.appel').removeClass('hide');
    $('.autre').removeClass('hide');
    $('.faire').removeClass('hide');
    $('.reunion').removeClass('hide');
    $('.email').removeClass('hide');
    
  }

     $('#faire').click(function(event) {  //on click 
            if(this.checked) { // check select status
              $('.faire').removeClass('hide');

              if($('#reunion').prop('checked') == false){
                $('.reunion').addClass('hide');
              }
              if($('#appel').prop('checked') == false){
                $('.appel').addClass('hide');
              }
              if($('#autre').prop('checked') == false){
                $('.autre').addClass('hide');
              }
              if($('#email').prop('checked') == false){
                $('.email').addClass('hide');
              }
            }else{
              if($('#autre').prop('checked') == false && $('#faire').prop('checked') == false && $('#appel').prop('checked') == false && $('#reunion').prop('checked') == false && $('#email').prop('checked') == false){
                $('.appel').removeClass('hide');
                $('.autre').removeClass('hide');
                $('.faire').removeClass('hide');
                $('.reunion').removeClass('hide');
                $('.email').removeClass('hide');
                
              }
              if($('#reunion').is( ':checked') || $('#appel').is( ':checked') || $('#autre').is( ':checked') || $('#email').is( ':checked')){
                $('.faire').addClass('hide');
              }

              if($('.appel').prop(hasClass('hide'))==false){
                $('.appel').removeClass('hide');
              }
              if($('.reunion').prop(hasClass('hide'))==false){
                $('.reunion').removeClass('hide');
              }
              if($('.autre').prop(hasClass('hide'))==false){
                $('.autre').removeClass('hide');
              }
              if($('.email').prop(hasClass('hide'))==false){
                $('.email').removeClass('hide');
              }
                 
            }
        });

   $('#appel').click(function(event) {  //on click 
            if(this.checked) { // check select status
              $('.appel').removeClass('hide');

              if($('#reunion').prop('checked') == false){
                $('.reunion').addClass('hide');
              }
              if($('#faire').prop('checked') == false){
                $('.faire').addClass('hide');
              }
              if($('#autre').prop('checked') == false){
                $('.autre').addClass('hide');
              }
              if($('#email').prop('checked') == false){
                $('.email').addClass('hide');
              }
            }else{
              if($('#autre').prop('checked') == false && $('#faire').prop('checked') == false && $('#appel').prop('checked') == false && $('#reunion').prop('checked') == false && $('#email').prop('checked') == false){
                $('.appel').removeClass('hide');
                $('.autre').removeClass('hide');
                $('.faire').removeClass('hide');
                $('.reunion').removeClass('hide');
                $('.email').removeClass('hide');
                
              }
              if($('#reunion').is( ':checked') || $('#faire').is( ':checked') || $('#autre').is( ':checked') || $('#email').is( ':checked')){
                $('.appel').addClass('hide');
              }

              if($('.faire').prop(hasClass('hide'))==false){
                $('.faire').removeClass('hide');
              }
              if($('.reunion').prop(hasClass('hide'))==false){
                $('.reunion').removeClass('hide');
              }
              if($('.autre').prop(hasClass('hide'))==false){
                $('.autre').removeClass('hide');
              }
              if($('.email').prop(hasClass('hide'))==false){
                $('.email').removeClass('hide');
              }
                 
            }
        });

     $('#autre').click(function(event) {  //on click 
            if(this.checked) { // check select status
              $('.autre').removeClass('hide');

              if($('#reunion').prop('checked') == false){
                $('.reunion').addClass('hide');
              }
              if($('#faire').prop('checked') == false){
                $('.faire').addClass('hide');
              }
              if($('#appel').prop('checked') == false){
                $('.appel').addClass('hide');
              }
              if($('#email').prop('checked') == false){
                $('.email').addClass('hide');
              }
            }else{
              if($('#autre').prop('checked') == false && $('#faire').prop('checked') == false && $('#appel').prop('checked') == false && $('#reunion').prop('checked') == false && $('#email').prop('checked') == false){
                $('.appel').removeClass('hide');
                $('.autre').removeClass('hide');
                $('.faire').removeClass('hide');
                $('.reunion').removeClass('hide');
                $('.email').removeClass('hide');
                
              }
              if($('#reunion').is( ':checked') || $('#faire').is( ':checked') || $('#appel').is( ':checked') || $('#email').is( ':checked')){
                $('.autre').addClass('hide');
              }

              if($('.faire').prop(hasClass('hide'))==false){
                $('.faire').removeClass('hide');
              }
              if($('.reunion').prop(hasClass('hide'))==false){
                $('.reunion').removeClass('hide');
              }
              if($('.appel').prop(hasClass('hide'))==false){
                $('.appel').removeClass('hide');
              }
              if($('.email').prop(hasClass('hide'))==false){
                $('.email').removeClass('hide');
              }
                 
            }
        });

  $('#reunion').click(function(event) {  //on click 
            if(this.checked) { // check select status
              $('.reunion').removeClass('hide');

              if($('#autre').prop('checked') == false){
                $('.autre').addClass('hide');
              }
              if($('#faire').prop('checked') == false){
                $('.faire').addClass('hide');
              }
              if($('#appel').prop('checked') == false){
                $('.appel').addClass('hide');
              }
              if($('#email').prop('checked') == false){
                $('.email').addClass('hide');
              }
            }else{

            if($('#autre').prop('checked') == false && $('#faire').prop('checked') == false && $('#appel').prop('checked') == false && $('#reunion').prop('checked') == false && $('#email').prop('checked') == false){
              $('.appel').removeClass('hide');
              $('.autre').removeClass('hide');
              $('.faire').removeClass('hide');
              $('.reunion').removeClass('hide');
              $('.email').removeClass('hide');
              
            }
              if($('#autre').is( ':checked') || $('#faire').is( ':checked') || $('#appel').is( ':checked') || $('#email').is( ':checked')){
                $('.reunion').addClass('hide');
              }

              if($('.faire').prop(hasClass('hide'))==false){
                $('.faire').removeClass('hide');
              }
              if($('.autre').prop(hasClass('hide'))==false){
                $('.autre').removeClass('hide');
              }
              if($('.appel').prop(hasClass('hide'))==false){
                $('.appel').removeClass('hide');
              }
              if($('.email').prop(hasClass('hide'))==false){
                $('.email').removeClass('hide');
              }
                 
            }
        });

   $('#email').click(function(event) {  //on click 
            if(this.checked) { // check select status
              $('.email').removeClass('hide');

              if($('#autre').prop('checked') == false){
                $('.autre').addClass('hide');
              }
              if($('#faire').prop('checked') == false){
                $('.faire').addClass('hide');
              }
              if($('#appel').prop('checked') == false){
                $('.appel').addClass('hide');
              }
              if($('#reunion').prop('checked') == false){
                $('.reunion').addClass('hide');
              }
            }else{
              
              if($('#autre').is( ':checked') || $('#faire').is( ':checked') || $('#appel').is( ':checked') || $('#reunion').is( ':checked')){
                $('.email').addClass('hide');
              }

              if($('.faire').prop(hasClass('hide'))==false){
                $('.faire').removeClass('hide');
              }
              if($('.autre').prop(hasClass('hide'))==false){
                $('.autre').removeClass('hide');
              }
              if($('.appel').prop(hasClass('hide'))==false){
                $('.appel').removeClass('hide');
              }
              if($('.reunion').prop(hasClass('hide'))==false){
                $('.reunion').removeClass('hide');
              }
                 
            }
        });
  
  
 });
@stop