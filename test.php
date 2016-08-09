<?php
/**
 * Created by PhpStorm.
 * User: Suman
 * Date: 2/15/2016
 * Time: 4:43 PM
 */

?>

<style>

    .chart-legend li span{
        display: inline-block;
        width: 12px;
        height: 12px;
        margin-right: 5px;
    }
    ul{ list-style-type: none;}

</style>

<div>
    <canvas id="myChart" width="1200" height="300"></canvas>
</div>
<div id="js-legend" class="chart-legend"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script>

   $(function(){

       $data1 = [
           [
               {"price":300,"Date":"Jan","Exp":"Food"},
               {"price":1200,"Date":"Jan","Exp":"Cloth"},
               {"price":1000,"Date":"Jan","Exp":"Rent"},
           ],
           [
               {"price":600,"Date":"Feb","Exp":"Food"},
               {"price":700,"Date":"Feb","Exp":"Cloth"},
               {"price":300,"Date":"Feb","Exp":"Rent"},
           ],
           [
               {"price":1000,"Date":"Mar","Exp":"Food"},
               {"price":2000,"Date":"Mar","Exp":"Cloth"},
               {"price":3100,"Date":"Mar","Exp":"Rent"},
           ],
           [
               {"price":900,"Date":"Apr","Exp":"Food"},
               {"price":1000,"Date":"Apr","Exp":"Cloth"},
               {"price":1100,"Date":"Apr","Exp":"Rent"},
           ]
       ]

       function chartData() {
           $i = -1;
           $labels = [];
           $monthlyData = [];
           $legend = [];
           $.each($data1, function (k, v) {
               $i++;
               $monthlyData.push([]);
               $.each(v, function (key, value) {
                   $monthlyData[$i].push(value.price);
                   if ($.inArray(value.Date, $legend) == -1) {
                       $legend.push(value.Date);
                   }
                   if ($i < 1) {
                       $labels.push(value.Exp);
                   }
               })
           })

           return [$labels,$monthlyData,$legend];
       }

       $color=["rgba(151,187,205,0.2)","rgba(220,220,220,0.2)","#C0C0C0","#E0400A","#FCB441","#056492","purple","royalblue","maroon","pink"];
       $fillColor = ["rgba(0, 0, 131, 0.1)","rgba(255,69,0,0.1)","rgba(61, 138, 131, 0.1)","rgba(255,255,0,0.2)"];   //	255,215,0
       $strokeColor = ["rgba(0, 0, 131, 0.8)","rgba(255,69,0,0.8)","rgba(61, 138, 131, 0.8)","rgba(255,255,0,0.8)"];
       $pointStrokeColor = ["rgba(0, 0, 131, 1)","rgba(255,69,0,1)","rgba(61, 138, 131, 1)","rgba(255,255,0,1)"];
       function createDataSet(){

           $monthlyData = chartData()[1];
           $mydataSet = [];
           $legend = chartData()[2];
           $.each($monthlyData,function(key,value){

               var obj = {
                   label:$legend[key],
                   fillColor:$fillColor[key],
                   strokeColor:$strokeColor[key],
                   pointColor: $pointStrokeColor[key],
                   pointStrokeColor:$pointStrokeColor[key],
                   pointHighlightFill:$fillColor[key],
                   pointHighlightStroke:$fillColor[key],
                   data:value
               };

               $mydataSet.push(obj);
           });
           return $mydataSet;
       }

       var data = {
           labels: chartData()[0],
           datasets: createDataSet()

       }

       var options =
       {
           tooltipTemplate: "<"+ "%= value %" + ">",
           onAnimationComplete: function()
           {
               this.showTooltip(this.segments, true);
           },
           tooltipEvents: [],
           showTooltips: true,
           percentageInnerCutout: 90
       };

       var ctx = $("#myChart").get(0).getContext("2d");
       var myLineChart = new Chart(ctx).Line(data,options);
       document.getElementById('js-legend').innerHTML = myLineChart.generateLegend();


   });



</script>

