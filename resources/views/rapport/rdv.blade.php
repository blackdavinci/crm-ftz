@extends('default')

@section('title','Tableau de bord')
@section('titre-entete','Tableau de bord')

@include('default.top-nav')
@include('default.left-nav')
@include('rapport.bar-menu')
@section('content')
        
           <select onChange="mostrarResultados(this.value);">
                <?php
                    for($i=2010;$i<date("Y")+1;$i++){
                        if($i == 2015){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                ?>
            </select>
            <canvas id="grafico"></canvas>
      
    <script>
            $(document).ready(nosResultat(2015));  
                                var ctx = $("#myChart").get(0).getContext("2d");

                function nosResultat(annee){
                    $.ajax({
                        type:'GET',
                        url:'rapport-rdv',
                        data:'annee='+annee,
                        success:function(dt){

                            var val = eval(dt);

                            var j   = val[0];
                            var f   = val[1];
                            var m   = val[2];
                            var a   = val[3];
                            var ma  = val[4];
                            var j   = val[5];
                            var jl  = val[6];
                            var ao  = val[7];
                            var s   = val[8];
                            var o   = val[9];
                            var n   = val[10];
                            var d   = val[11];
                             
                            var Datos = {
                                    labels : ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Julliet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
                                    datasets : [
                                        {
                                            fillColor : 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(57,194,112,0.7)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [7, 8, 8, 0, 1, 10, 2, 6, 4, 3, 5, 7]
                                        }
                                    ]
                                }
                                
                            var myBarChart = new Chart(ctx).Bar(data);
                        }
                    });
                    return false;
                }
    </script>
@stop