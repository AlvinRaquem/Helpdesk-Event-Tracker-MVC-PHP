<?php include VIEW_PATH.'/includes/dashheader.php';?>


<style>
	
	.divboxes{
		height: 150px;
		border-radius: 15%;
		position: relative;
	}

	.spanboxesdescription {
		position: absolute;
		top: 20%;
		left: 50%;
		transform: translate(-50%,-50%);
		font-size:14pt;
		font-weight:bold;
		color: white;
	}

	.othersdetail {
		font-size: 14pt;
		font-weight: bold;
		color: dimgray;
		margin-right: 50px;
	}

	.spanboxesvalue {
		position: absolute;
		top: 60%;
		left: 50%;
		transform: translate(-50%,-50%);
		color: white;
		font-size: 35pt;
	}


   @media (max-width: 700px) and (min-width: 451px){
        .grid-col-6 {
            grid-column: span 12;
        }
    }


</style>

<div>


<div class="grid-container">
	<div class="grid-col-6" style="width: 100%;height: 100%;">
		<div id='container' style="max-height:100%;height: 600px;"></div>
	</div>

	<div class="grid-col-6" style="width: 100%;height: 100%;">
		
		<div style="height: 200px;">
			<span style="color: dimgray;font-size: 24pt;font-weight: bold;"><?= date('M d, Y',time());?></span>

			<div class="grid-container">
				<div class="grid-col-3">
						<div style="background: dimgray;" class="divboxes">
							<span class="spanboxesdescription">PERCENTAGE</span>
							<span class="spanboxesvalue" id="percentageval"></span>
						</div>
				</div>

				<div class="grid-col-3">
						<div style="background: orange;" class="divboxes">
							<span class="spanboxesdescription">PENDING</span>
							<span class="spanboxesvalue" id="pendingval"></span>
						</div>
				</div>

				<div class="grid-col-3">
						<div style="background: green;" class="divboxes">
							<span class="spanboxesdescription">DONE</span>
							<span class="spanboxesvalue" id="doneval"></span>
						</div>
				</div>

				<div class="grid-col-3">
						<div style="background: maroon;" class="divboxes">
							<span class="spanboxesdescription">TOTAL</span>
							<span class="spanboxesvalue" id="totalcalls"></span>
						</div>
				</div>

			</div>

		</div>
		<br/>
		<div style="height: 400px;">
			<div id='todaycalls_graph' style="max-height:100%;height:400px;"></div>
		</div>

	</div>

</div>




</div>

<?php include VIEW_PATH.'/includes/footer.php';?>

<script src="public/highcharts/code/highcharts.js"></script>
<script src="public/highcharts/code/highcharts-3d.js"></script>
<script src="public/highcharts/code/modules/exporting.js"></script>
<script src="public/highcharts/code/modules/export-data.js"></script>

<script type="text/javascript">

	$(document).ready(function(){
		getbigChart();
        setInterval(function(){
            getbigChart();
        },300000);
	});


	function getbigChart(){
		$.ajax({
		url: 'getflmchart',
		type: 'POST',
		success: function(x){
		getchart(x);
		var data = JSON.parse(x);
		var totalpendinggraph = data['totalpendinggraph'];
	    var totaldonegraph = data['totaldonegraph'];
	    var flm_critical = parseInt(data['flmcritical']);
	    var lowcount = parseInt(data['lowcount']);
	    var done = totaldonegraph;
        var others = (parseInt(totalpendinggraph)-(parseInt(flm_critical)+lowcount));
        $('#pendingval').text(totalpendinggraph);
        $('#doneval').text(totaldonegraph);
        $('#totalcalls').text(totalpendinggraph+totaldonegraph);
        $('#percentageval').text(data['percentage']);
	    var colors = ["lime","#87CEEB","green", color1 = ["orangered","yellow","gray"],color2 = ["green","#50B948","green"]],
        categories = ['DONE', 'PENDING'],
        data = [{
            y: parseInt(totaldonegraph),
            color: colors[0],
            drilldown: {
                name: 'RESPONSE DONE',
                categories: ['Done'],
                data: [done],
                color: colors[0],
            },
        }, {
            y: parseInt(totalpendinggraph),
            color: colors[1],
            drilldown: {
                name: 'RESPONSE NOT DONE',
                categories: ['Critical','Warning','active'],
                data: [parseInt(flm_critical), lowcount, others],
                color: colors[1]
            }
        },
		
		],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            // color: data[i].color
            color: colors[i],
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            if(i==1){
                versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get(),
                color: colors[3][j],
            });
                }else{
                      versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get(),
                color: colors[4][j],
            });
                }
        }

      }

      	  // Create the chart
  $('#container').highcharts({
        chart: {
            type: 'pie'
        },
        legend: {
            itemStyle: {
                color: '#000000',
                fontWeight: '50',
				fontSize:'12pt',
				marginTop:10,
            },
			align: 'right',
           	verticalAlign: 'middle',
       	    layout: 'vertical',
			symbolWidth:20,
			symbolHeight:20,
            itemMarginBottom: 10,
   	        x: -10,
            y: 20,			
        },
        title: {
            text: 'FLM CALLS',
         	  style: {
					  fontWeight: 'bold',
					  fontSize:'40px'
				  },
        },
        subtitle: {
            text: ''
        },
        yAxis: {
            title: {
                text: 'Total Bank Calls'
            },
        },
        plotOptions: {
             pie:{
                shadow:false,
                center:['50%','50%'],
                allowPointSelect: true,
                dataLabels: {
                  enabled: true,
                },
                showInLegend: true
                
            }
           
        },
        tooltip: {
            valueSuffix: '',
              style: {
					  fontWeight: 'bold',
					  fontSize:'40px'
				  },
        },
        series: [{
            name: 'Calls',
            data: browserData,
            size: '65%',
            dataLabels: {
                formatter: function () {
                  // return this.y > 5 ? this.point.name : null;
                 return null;
                },
                color: '#ffffff',
                distance: -30
            },
        }, {
            name: 'Calls',
            data: versionsData,
            size: '100%',
            innerSize: '50%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                 //  return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '' : null;
                 return null;
                }
            },
            id: 'versions'
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 400
                },
                ChartOptions: {
                    series: [{
                        id: 'versions',
                        dataLabels: {
                            enabled: false
                        }
                    }]
                }
            }]
        }
    });
		}

		});
	}
	  	



function getchart(datas){
	var callss = JSON.parse(datas);
	Highcharts.chart('todaycalls_graph', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'TODAY CALLS',
         style: {
                    fontWeight: 'bold',
                    fontSize:'30px'
                }
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: callss['hours'],
        crosshair: true,
           labels: {
                style: {
                    fontWeight: 'bold',
                    fontSize:'12px'
                }
            }
    },
    yAxis: {
        min: 0,
        allowDecimals: false,
        title: {
            text: 'NO. OF CALLS',
             style: {
                    fontWeight: 'bold',
                    fontSize:'14px'
                }
        },
           labels: {
                style: {
                    fontWeight: 'bold',
                    fontSize:'14px'
                }
            }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'HOURS',
        data: callss['calls_count'],
    }]
});
}



</script>

</body>
</html>
