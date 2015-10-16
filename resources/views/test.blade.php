@extends('default')

@section('title','Test Page')
@section('titre-entete','Test Page')

@include('default.top-nav')
@include('default.left-nav')

  

@section('head')
  	 <!-- AJAX metadata -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
   
@stop
@section('content')

<?php
function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}

  $content ="casablanca";
  $query = "casa";
  function getMatchChar($query,$content){
    $word_query = str_split($query);
    $word_compare = str_split($content);
    var_dump($word_compare);
    var_dump($word_query);
    foreach ($word_query as $key => $value) {
        $exist = 0;
        if(!empty($done)){
            foreach ($done as $dkey => $dvalue) {
              if($dvalue==$value){
                $exist = 1;
              }
            }
        }
        if($exist==0){
          foreach ($word_compare as $ckey => $cvalue) {
              if($value == $cvalue){
                $match_pos[] = $ckey;
              }
          } 
        }
      $done[] = $value;
    }
    return $match_pos;
  }


?>

Example: 
<?php 
  $content = "casablanca";
  $query = "casa";
  $result = getMatchChar($query,$content);
  $contentchar = str_split($content);
var_dump($result);
  foreach ($result as $key => $value) {
      echo $contentchar[$value];
  }
  

?>
<br/>
This will return "the guy in the middle".
  	<div class="col-md-4">

  		<form id="register" action="{{ route('devis.store')}}" method="post">
    			
    			<div class="form-group">
  				    <div class="col-sm-12">
  					   {!! Form::label('societe','Société') !!}
  						{!! Form::text('nom_clt',null, ['class' =>'form-control input-sm', 'id'=>'societe', 'placeholder'=>'Nom de la société']) !!}
  						
  					</div>
  				</div>
          <div class="form-group">
              <div class="col-sm-12" id="feedback">
              
            </div>
          </div>
          <div class="col-md-12">
            <a href="" id="ajout">Add more</a>
          </div>  
  				<div class="form-group ">
  				
  					<div class="col-md-12">

  						{!! Form::submit('Enregistrer',['class' =>'btn btn-success btn-smenu-position']) !!}
  					</div>
  				</div>
  		</form>
     
  		
  	</div>
@stop
@section('script')
  
  		$.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          }
      });
  		$(document).ready(function(){

        var template = '<select name="test"><option value="vo">Vo</option><option value="Fi">Fi</option</select>';
        $('#ajout').click(function(e){
              e.preventDefault();
              $('#feedback').before(template);

        });
          
        
      });

  	
@stop
