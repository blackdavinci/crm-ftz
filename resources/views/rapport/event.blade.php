@extends('default')

@section('title','Tableau de bord')
@section('titre-entete','Tableau de bord')

@include('default.top-nav')
@include('default.left-nav')
@include('rapport.bar-menu')
@section('content')

<div align="center">

<?php $actu=$id ?>

            {!! Form::open(['route'=>'evenement.rapport', 'method'=>'POST']) !!}
            
            {!! Form::label('groupe','Groupe CRM') !!}
            {!! Form::select('groupe',$groupe,$actu,['class' =>'form-control input-sm']) !!}

            {!! Form::close() !!}
        
        
            @if (($visite) ||($presentation))
            <canvas id="myChart" width="400" height="400">
            

            <script>
                $(document).ready(function() {
                    var ctx = $("#myChart").get(0).getContext("2d");
                                            //pie data.
                        var data = [
                            {
                                value: {{ $visite }},
                                color:"#F7464A",
                                highlight: "#FF5A5E",
                                label: "Visite"
                            },
                            {
                                value: {{ $presentation }},
                                color: "#FDB45C",
                                highlight: "#FFC870",
                                label: "Présentation"
                            },
                            {
                                value: {{ $devis }},
                                color: "#FAB4B",
                                highlight: "#FFC870",
                                label: "Présentation"
                            }
                            
                        ];
                        var myPieChart = new Chart(ctx).Pie(data);                  
                 });


            </script>
        </canvas>

        @else
        
        <h1>
        <p align='center' style="color:#ddd">Aucune donnée</p>
        </h1>

        @endif
        
</div>
@stop

@section('script')
$(document).ready(function(){
 $("select[name='groupe']").change(function(){
 this.form.submit();
});
    
});
@stop