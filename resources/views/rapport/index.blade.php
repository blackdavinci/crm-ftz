@extends('default')

@section('title','Tableau de bord')
@section('titre-entete','Tableau de bord')

@include('default.top-nav')
@include('default.left-nav')
@include('rapport.bar-menu')
@section('content')

<div align="center">

            {!! Form::open(['route'=>'evenement.rapport', 'method'=>'POST']) !!}
            
            {!! Form::label('groupe','Groupe CRM') !!}
            {!! Form::select('groupe',$groupe,null,['class' =>'form-control input-sm']) !!}

            {!! Form::close() !!}
        
            
            <canvas id="myChart" width="400" height="400">
            <script>
                $(document).ready(function() {
                    var ctx = $("#myChart").get(0).getContext("2d");
                                            //pie data.
                        var data = [
                            {
                                value: 10,
                                color:"#F7464A",
                                highlight: "#FF5A5E",
                                label: "Donnée exemple"
                            }
                        ];
                        var myPieChart = new Chart(ctx).Pie(data);                  
                 });


            </script>
        </canvas>

       
</div>
@stop

@section('script')
$(document).ready(function(){
 $("select[name='groupe']").change(function(){
 this.form.submit();
});
    
});
@stop