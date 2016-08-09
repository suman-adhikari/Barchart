<?php
/**
 * Created by PhpStorm.
 * User: Suman
 * Date: 2/15/2016
 * Time: 10:16 AM
 */

?>

<html>
<head>
    <title></title>
</head>
<body>

<style>
    .bar {
        fill: gray; / changes the background /
    height: 21px;
        transition: fill .3s ease;
        cursor: pointer;
        font-family: Helvetica, sans-serif;
    }
    .bar text {
        color: black;
    }
    .bar:hover,
    .bar:focus {
        fill: black;
    }
    .bar:hover text,
    .bar:focus text {
        fill: red;
    }

    table{
        border-collapse: collapse;
    }

    table,th,td{
      border:1px solid black;
    }

    td{

        height:20;
        text-align:center;
        padding:5px;
    }

</style>

<svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="mysvg" class="chart" width="900" height="500" style="background-color: aliceblue"  aria-labelledby="title desc" role="img">

</svg>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.js"></script>
<script src="barChart.js"></script>
<script>

    $data = [

        [
            {"part":"Mauritel","cost":"31.00","Date":"15/08/08"},
            {"part":"Chinguitel","cost":"50.00","Date":"15/08/08"},
            {"part":"Internatioanal","cost":"11.00","Date":"15/08/08"},
            {"part":"Others","cost":"8.00","Date":"15/08/08"}

        ],
        [
            {"part":"Mauritel","cost":"30.00","Date":"15/11/01"},
            {"part":"Chinguitel","cost":"51.00","Date":"15/11/01"},
            {"part":"Internatioanal","cost":"11.00","Date":"15/11/01"},
            {"part":"Others","cost":"8.00","Date":"15/11/01"},

        ],
        [
            {"part":"Mauritel","cost":"32.32","Date":"15/01/03"},
            {"part":"Chinguitel","cost":"46.46","Date":"15/01/03"},
            {"part":"Internatioanal","cost":"12.12","Date":"15/01/01"},
            {"part":"Others","cost":"9.09","Date":"15/01/01"},
        ],
        [
            {"part":"Mauritel","cost":"30.00","Date":"15/01/04"},
            {"part":"Chinguitel","cost":"50.00","Date":"15/01/04"},
            {"part":"Internatioanal","cost":"12.00","Date":"15/01/01"},
            {"part":"Others","cost":"8.00","Date":"15/01/01"},


        ],
        [
            {"part":"Mauritel","cost":"29.29","Date":"15/01/05"},
            {"part":"Chinguitel","cost":"53.54","Date":"15/01/05"},
            {"part":"Internatioanal","cost":"11.11","Date":"15/01/01"},
            {"part":"Others","cost":"6.06","Date":"15/01/01"},
        ]

    ]

    $data1 = [

        [
            {"part":"Mauritel","cost":"60","Date":"15/08/08"},
            {"part":"Chinguitel","cost":"100","Date":"15/08/08"}

        ],
        [
            {"part":"Mauritel","cost":"20","Date":"15/11/01"},
            {"part":"Chinguitel","cost":"80","Date":"15/11/01"}


        ],
        [
            {"part":"Mauritel","cost":"60","Date":"15/01/03"},
            {"part":"Chinguitel","cost":"90","Date":"15/01/03"},

        ],
        [
            {"part":"Mauritel","cost":"90","Date":"15/01/04"},
            {"part":"Chinguitel","cost":"100","Date":"15/01/04"},

        ],
        [
            {"part":"Mauritel","cost":"100","Date":"15/01/05"},
            {"part":"Chinguitel","cost":"50","Date":"15/01/05"},

        ]
    ]

    $("#mysvg").barChart({
        data:$data,
        bar_color:["#C0C0C0","#E0400A","#FCB441","#056492"],
        width:40,
        chartXY:[130,400],
        labelXY:[5,0],
        tableX:0,
        barHeight:500
    });



</script>
</body>
</html>