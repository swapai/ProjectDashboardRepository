var kpiApp = new Vue({
  el: '#kpiMain',
  data: {
    kpi: {
      sensorDeployedId: 0,
      dataCollectiveDate: '',
      output : '',
      heatRate : '',
      compressorEfficiency : '',
      availability: '',
      reliability: '',
      firedHours: '',
      trips: '',
      starts: ''
    },
  kpiList: []
},methods:{
  fetchSensorTimeSeriesData (sensorDeployedId) {
    fetch('api/sensortimeseries.php?sensorDeployedId='+sensorDeployedId)
    .then( response => response.json() )
    .then( json => {
      kpiApp.kpiList = json;
      this.buildOutputChart();
      this.buildHeatRateChart();
      this.buildCompressorEfficiencyChart();
    } )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })

   },

  buildOutputChart(){
      Highcharts.chart('outputChart', {
            title: {
                text: 'Cumulative Sensor Output'
            },
            xAxis: {
                type: 'datetime',
            },
            yAxis: {
                title: {
                    text: 'Power'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Hours (Running Total)',
                // Data needs [ [date, num], [date2, num2 ], ... ]
                data: this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.output)] )
            }]
        });
  },
  buildHeatRateChart(){
    Highcharts.chart('heatRateChart', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Sensor Heat Rate'
    },
    xAxis: {
        type: 'datetime',
    },
    yAxis: {
        title: {
            text: 'Heat Rate (kWh)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: false
            },
            enableMouseTracking: false
        }
    },
    series: [{
      name: 'Heat Rate (kWh)',
      // Data needs [ [date, num], [date2, num2 ], ... ]
      data: this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.heatRate)] )
    }]
})
},
buildCompressorEfficiencyChart(){
  Highcharts.chart('compressorEfficiencyChart', {
    yAxis: {
            title: {
                text: 'Compressor Efficiency (%)'
            },
            min: 0,
            max: 100,
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                }
            }
        },

    series: [{
        name: 'Compressor Efficiency (%)',
        // Data needs [ [date, num], [date2, num2 ], ... ]
        data: this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.compressorEfficiency)] )
    }],
    responsive: {
       rules: [{
           condition: {
               maxWidth: 500
           },
           chartOptions: {
               legend: {
                   layout: 'horizontal',
                   align: 'center',
                   verticalAlign: 'bottom'
               }
           }
       }]
     }
})
}

},

  created (){

    const url = new URL(window.location.href);
    const sensorDeployedId = url.searchParams.get('sensorDeployedId');
    console.log('SensorDeployed Id: '+ sensorDeployedId);
    this.kpi.sensorDeployedId = sensorDeployedId;

  this.fetchSensorTimeSeriesData (sensorDeployedId);
  }
})
