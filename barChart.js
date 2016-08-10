(function($){
   //hello world
    $.fn.barChart = function(option) {

        $data = option.data;

        var defaults = {
            width: 40,
            height: "600px",
            chartXY:[50,400],
            labelXY:[0,0],
            labelSize: 12,
            tableX: 0,
            barHeight: 200,
            bar_color:["#C0C0C0","#E0400A","#FCB441","#056492","purple","royalblue","maroon","pink"]
        }

        var options = $.extend(defaults, option);  // parameter choose

        $svg = $(this);
        var $i = 0;
        var $width = options.width;
        var $txtX = options.chartXY[0] - 50 + options.labelXY[0];
        var $txtY = options.chartXY[1] + 50 + $width + options.labelXY[1];
        var $txtP = options.chartXY[0];
        $txtPX = 0 + options.labelXY[0];
        $txtPY = (options.chartXY[1] + 120) + options.width;
        $label_size = options.labelSize;
        $barSizeRate = options.barHeight * 0.01;
        $NoOfBar = $data.length;
        $barColor=options.bar_color;


        $datakey = [];
        for (property in $data[0][0]) {
            $datakey.push(property);
        }

        generateBarChart();


        function generateBarChart() {
            $.each($data, function (key, value) {
                $i += $width + 10;
                $txtX += $width + 10;
                $txtP += $width;

                $txtPX += $width + 10;

                $text = $(SVG('text')).attr('x', $txtX).attr('y', $txtY).attr('class', 'chartLabel').attr('transform', 'rotate(310,' + $txtX + ',' + $txtY + ')').text(value[0].Date);
                var $y = $width;
                //The g element is a container used to group other svg elements. The transformation applied to it is applied to all child element.
                $g = $(SVG('g')).attr('transform', 'translate(' + options.chartXY[0] + ',' + options.chartXY[1] + ') rotate(180,' + $i + ',' + $width + ')');
                $count = 0;

                $.each(value, function (k, v) {
                    $count++;
                    $height = v.cost * 2;
                    $y1 = $width * 2;
                    if ($count > 1) {
                        $y += parseInt(($svg.find("rect:last").attr("height")));
                    }
                    $(SVG('rect')).attr('width', $width).attr('height', $height).attr('x', $i).attr('y', $y).appendTo($g);
                    $svg.append($g);
                });
                $svg.append($text);

            });
            Baseline();
            fillColor();
            createTable();
        }

        function Baseline(){

           // shape-rendering:crispEdges

            $line =  $(SVG('line')).attr({
                'x1':0,'y1':$width+0.5,
                'x2':($width+12)*$NoOfBar,'y2':$width+0.5,
                'stroke':'black',
                'stroke-width':1,
                'transform':'translate('+ options.chartXY[0] +','+ options.chartXY[1] +')',
                'shape-rendering':'crispEdges'
            });
            $svg.append($line);
        }

        $(".chartLabel").css({
            "font-size": $label_size
        });

        function SVG(tag) {
            return document.createElementNS('http://www.w3.org/2000/svg', tag);
        }

        function fillColor(){
            $("g").each(function (k,v) {
                $(this).find('rect').each(function(key,value){
                    $(this).attr('fill', options.bar_color[key]);
                });
            });
        }

        function createTable() {

                $table = $('<table>')
                $tbody = $('<tbody>');
                $table.append($tbody);
                $color = [options.bar_color_one, options.bar_color_two, options.bar_color_three, options.bar_color_four];
                $rowNo = NoOfItemInColumn();
                $comp = companyName();


               for ($i = 0; $i < $rowNo; $i++) {
                   $tbody.append($('<tr>'));
                   $tbody.find("tr:last").append($('<td>').css("background-color", options.bar_color[$i]));
                   $tbody.find("tr:last").append($('<td>').text($comp[$i]));
               }

                $.each($data, function (key, value) {
                for ($i = 0; $i < $rowNo; $i++) {
                    if ($i < value.length) {
                        $($table.find("tr")[$i]).append($('<td>').text(value[$i]["cost"] + "%"));
                    }
                    else {
                        $($table.find("tr")[$i]).append($('<td>').text("0%"));
                    }
                }
                });

                    $svg.after($table);
                    tableStyle();


            }

        function NoOfItemInColumn(){
            var $rowNo =0;
            $.each($data,function(key,value){
                if(value.length>$rowNo){
                    $rowNo=value.length;
                }
            });
            return $rowNo;
        }

        function companyName(){
            $comp =[];
            $.each($data,function(key,value){
                if(value.length==$rowNo){
                    $.each(value,function(k,v){
                        $comp.push(v["part"]);
                    });
                }
            });
            return $comp;
        }

        function longestName(){
            var $comp_length=0;
            $.each($comp,function(key,value){
                if(value.length>$comp_length){
                    $comp_length=value.length;
                }
            });
            return $comp_length;
        }

        function tableStyle () {

             $comp_length = longestName();

             $factor = 0;
             if ($comp_length < 10) {
                 $factor = 3;
             }
             else if ($comp_length > 10 && $comp_length < 15) {
                 $factor = 1;
             }
             else if ($comp_length > 15 && $comp_length < 30) {
                 $factor = 5;
             }
             else if ($comp_length > 25 && $comp_length < 50) {
                 $factor = 5.5;
             }


             $tableX = (options.chartX - 100) + options.tableX - ($comp_length * $factor);
             //$tableX = (options.chartX-100)+options.tableX;

             $table.css({
                 "margin-left": $tableX
             });

             $table.find("td").css({
                 "width": $width,
                 "font-size": "10px"
             })

             $table.find("tr").find("td:eq(1)").css({
                 "text-align": "left"
             });

         }

    }


})(jQuery);
