  <?PHP
$oc="pm_date='Jan'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$jan=0;
foreach($desc as $row):
$jan+=$row['grand_total'];
endforeach;
?>

  <?PHP
$oc="pm_date='Feb'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Feb=0;
foreach($desc as $row):
$Feb+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="pm_date='Mar'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Mar=0;
foreach($desc as $row):
$Mar+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="pm_date='Apr'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Apr=0;
foreach($desc as $row):
$Apr+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="pm_date='May'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$May=0;
foreach($desc as $row):
$May+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="pm_date='Jun'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Jun=0;
foreach($desc as $row):
$Jun+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="pm_date='Jul'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Jul=0;
foreach($desc as $row):
$Jul+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="pm_date='Aug'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Aug=0;
foreach($desc as $row):
$Aug+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="pm_date='Sep'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Sep=0;
foreach($desc as $row):
$Sep+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="pm_date='Oct'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Oct=0;
foreach($desc as $row):
$Oct+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="pm_date='Nov'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Nov=0;
foreach($desc as $row):
$Nov+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="pm_date='Dec'";
$this->db->select_sum('grand_total');
$this->db->from('purchases');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$Dec=0;
foreach($desc as $row):
$Dec+=$row['grand_total'];
endforeach;
?>

<?PHP
$oc="om_date='Jan'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sjan=0;
foreach($desc as $row):
$sjan+=$row['grand_total'];
endforeach;
?>

  <?PHP
$oc="om_date='Feb'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sFeb=0;
foreach($desc as $row):
$sFeb+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="om_date='Mar'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sMar=0;
foreach($desc as $row):
$sMar+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="om_date='Apr'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sApr=0;
foreach($desc as $row):
$sApr+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="om_date='May'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sMay=0;
foreach($desc as $row):
$sMay+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="om_date='Jun'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sJun=0;
foreach($desc as $row):
$sJun+=$row['grand_total'];
endforeach;
?>
  <?PHP
$oc="om_date='Jul'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sJul=0;
foreach($desc as $row):
$sJul+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="om_date='Aug'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sAug=0;
foreach($desc as $row):
$sAug+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="om_date='Sep'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sSep=0;
foreach($desc as $row):
$sSep+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="om_date='Oct'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sOct=0;
foreach($desc as $row):
$sOct+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="om_date='Nov'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sNov=0;
foreach($desc as $row):
$sNov+=$row['grand_total'];
endforeach;
?>
 <?PHP
$oc="om_date='Dec'";
$this->db->select_sum('grand_total');
$this->db->from('orders');
$this->db->where($oc);
$desc=$this->db->get()->result_array();
$sDec=0;
foreach($desc as $row):
$sDec+=$row['grand_total'];
endforeach;
?>
<script>


//Date Range Picker
$(document).ready(function() {
    $('#reportrange').daterangepicker({
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2014',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'Last 30 Days': [moment().subtract('days', 29), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function(start, end) {
            console.log("Callback has been called!");
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );
    //Set the initial state of the picker label
    $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
});

//Morris Line Chart

var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

Morris.Line({
  element: 'morris-chart-dashboard',
  data: [{
    m: '<?=date('Y')?>-01', // <-- valid timestamp strings
    a: <?=$jan?>,
    b: <?=$sjan?>
  }, {
    m: '<?=date('Y')?>-02',
    a: <?=$Feb?>,
    b: <?=$sFeb?>
  }, {
    m: '<?=date('Y')?>-03',
    a: <?=$Mar?>,
    b: <?=$sMar?>
  }, {
    m: '<?=date('Y')?>-04',
    a: <?=$Apr?>,
    b: <?=$sApr?>
  }, {
    m: '<?=date('Y')?>-05',
    a: <?=$May?>,
    b: <?=$sMay?>
  }, {
    m: '<?=date('Y')?>-06',
    a: <?=$Jun?>,
    b: <?=$sJun?>
  }, {
    m: '<?=date('Y')?>-07',
    a: <?=$Jul?>,
    b: <?=$sJul?>
  }, {
    m: '<?=date('Y')?>-08',
    a: <?=$Aug?>,
    b: <?=$sAug?>
  }, {
    m: '<?=date('Y')?>-09',
    a: <?=$Sep?>,
    b: <?=$sSep?>
  }, {
    m: '<?=date('Y')?>-10',
    a: <?=$Oct?>,
    b: <?=$sOct?>
  }, {
    m: '<?=date('Y')?>-11',
    a: <?=$Nov?>,
    b: <?=$sNov?>
  }, {
    m: '<?=date('Y')?>-12',
    a: <?=$Dec?>,
    b: <?=$sDec?>
  }, ],
  xkey: 'm',
  ykeys: ['a', 'b'],
  labels: ['<?php echo get_phrase('purchases'); ?>', '<?php echo get_phrase('sales'); ?>'],
  xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
    var month = months[x.getMonth()];
    return month;
  },
  dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  },
  // chart.
    gridTextColor: ['rgba(255,255,255,1)'],
    fillOpacity: 0.1,
	 pointSize: 2,
	 lineWidth: 4,
    grid: true,
lineColors: ['#34495e','#f39c12'],
//labels: ['Visits', 'Page Views'],
// Disables line smoothing
smooth: true,
resize: true
});



//Responsive Sparkline Inline Charts
$("#sparklineA").sparkline([200, 215, 221, 214, 232, 265], {
    type: 'bar',
    zeroAxis: false,
    height: 24,
    chartRangeMin: 100,
    barColor: 'rgba(255,255,255,0.5)',
    negBarColor: 'rgba(255,255,255,0.5)'
});

$("#sparklineB").sparkline([10, 24, 18], {
    type: 'pie',
    height: 24,
    sliceColors: ['rgba(255,255,255,0.2)', 'rgba(255,255,255,0.4)', 'rgba(255,255,255,0.6)']
});

$("#sparklineC").sparkline([22, 29, 14, 12, 18, 21, 24], {
    type: 'bar',
    zeroAxis: false,
    height: 24,
    chartRangeMin: 0,
    barColor: 'rgba(255,255,255,0.5)',
    negBarColor: 'rgba(255,255,255,0.5)'
});

$("#sparklineD").sparkline([72, 65, 45, 65, 82, 78, 92, 83, 46, 87, 69, 96], {
    type: 'line',
    lineColor: 'rgba(255,255,255,0.8)',
    fillColor: 'rgba(255,255,255,0.3)',
    spotColor: '#ffffff',
    minSpotColor: '#ffffff',
    maxSpotColor: '#ffffff',
    highlightLineColor: '#ffffff',
    height: 24,
    chartRangeMin: 25,
    drawNormalOnTop: false
});

//Flot Chart Dynamic Chart

var container = $("#flot-chart-moving-line");

// Determine how many data points to keep based on the placeholder's initial size;
// this gives us a nice high-res plot while avoiding more than one point per pixel.

var maximum = container.outerWidth() / 10 || 300;

//

var data = [];

function getRandomData() {

    if (data.length) {
        data = data.slice(1);
    }

    while (data.length < maximum) {
        var previous = data.length ? data[data.length - 1] : 50;
        var y = previous + Math.random() * 10 - 5;
        data.push(y < 0 ? 0 : y > 100 ? 100 : y);
    }

    // zip the generated y values with the x values

    var res = [];
    for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
    }

    return res;
}

//

series = [{
    data: getRandomData(),
    lines: {
        fill: true,
        fillColor: "rgba(255,255,255,0.4)",
    },
}];

//

var plot = $.plot(container, series, {
    grid: {
        borderWidth: 0,
        minBorderMargin: 10,
        labelMargin: 10,
        backgroundColor: {
            colors: ["rgba(255, 255, 255,0)", "rgba(255, 255, 255,0)"]
        },
        margin: {
            top: 0,
            bottom: 0,
            left: 0,
            right: 0
        },
        markings: function(axes) {
            var markings = [];
            var xaxis = axes.xaxis;
            for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
                markings.push({
                    xaxis: {
                        from: x,
                        to: x + xaxis.tickSize
                    },
                    color: "rgba(255, 255, 255, 0)"
                });
            }
            return markings;
        }
    },
    xaxis: {
        tickFormatter: function() {
            return "";
        }
    },
    yaxis: {
        min: 10,
        max: 110,
        show: false
    },
    legend: {
        show: false
    },
    colors: ["#fff"]

});

// Update the random dataset at 25FPS for a smoothly-animating chart

setInterval(function updateRandom() {
    series[0].data = getRandomData();
    plot.setData(series);
    plot.draw();
}, 500);


//Chat Widget SlimScroll Box
$(function() {
    $('.chat-widget').slimScroll({
        start: 'bottom',
        height: '300px',
        alwaysVisible: true,
        disableFadeOut: true,
        touchScrollStep: 50
    });
});

//Moment.js Time Display
var datetime = null,
    date = null;

var update = function() {
    date = moment(new Date())
    datetime.html(date.format('dddd<br>MMMM Do, YYYY<br>h:mm:ss A'));
};

$(document).ready(function() {
    datetime = $('#datetime')
    update();
    setInterval(update, 1000);
});

//Custom jQuery - Changes background on time tile based on the time of day.
$(document).ready(function() {
    datetoday = new Date(); // create new Date()
    timenow = datetoday.getTime(); // grabbing the time it is now
    datetoday.setTime(timenow); // setting the time now to datetoday variable
    hournow = datetoday.getHours(); //the hour it is

    if (hournow >= 18) // if it is after 6pm
        $('div.tile-img').addClass('evening');
    else if (hournow >= 12) // if it is after 12pm
        $('div.tile-img').addClass('afternoon');
    else if (hournow >= 6) // if it is after 6am
        $('div.tile-img').addClass('morning');
    else if (hournow >= 0) // if it is after midnight
        $('div.tile-img').addClass('midnight');
});

//Vector Maps
$(function() {
    $('#map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                fill: '#bdc3c7'
            }
        },
        series: {
            regions: [{
                values: visitorData,
                scale: ['#bdc3c7', '#16a085'],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionLabelShow: function(e, el, code) {
            el.html(el.html() + ' (Total Visits - ' + visitorData[code] + ')');
        }
    });
});

//To-Do List jQuery - Adds a strikethrough on checked items
$('.checklist input:checkbox').change(function() {
    if ($(this).is(':checked'))
        $(this).parent().addClass('selected');
    else
        $(this).parent().removeClass('selected')
});

//Easy Pie Charts
$(function() {
    $('#easy-pie-1, #easy-pie-2, #easy-pie-3, #easy-pie-4').easyPieChart({
        barColor: "rgba(255,255,255,.5)",
        trackColor: "rgba(255,255,255,.5)",
        scaleColor: "rgba(255,255,255,.5)",
        lineWidth: 20,
        animate: 1500,
        size: 175,
        onStep: function(from, to, percent) {
            $(this.el).find('.percent').text(Math.round(percent));
        }
    });

});

//DataTables Initialization for Map Table Example
$(document).ready(function() {
    $('#map-table-example').dataTable();
});
                                        //Morris Donut Chart

           

</script>