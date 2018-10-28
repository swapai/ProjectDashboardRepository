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
      this.formatSensorStats();
      this.buildFiredHoursChart();
    } )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })

   },
   formatSensorStats() {
         this.kpiList.forEach(
           (entry, index, arr) => {
             entry.runningTotalFiredHours = entry.firedHours +
               (index == 0 ? 0 : arr[index-1].runningTotalFiredHours)
         });
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
buildTripsAndStartsChart(){
  Highcharts.chart('tripsAndStartsChart', {

    title: {
        text: 'Number of trips and starts'
    },
    yAxis: {
        title: {
            text: 'Number of Trips and Starts'
        }
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
            },
            pointStart: 2010
        }
    },

    series: [{
        name: 'Trips',
        data:  this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.trips)] )
    }, {
        name: 'Starts',
        data: this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.starts)] )
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
},
buildCompressorEfficiencyChart(){
  Highcharts.chart('compressorEfficiencyChart', {
    title: {
        text: 'Compressor Efficiency Chart'
    },
    yAxis: {
            title: {
                text: 'Compressor Efficiency (%)'
            },
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: true
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
},
buildFiredHoursChart(){
  Highcharts.chart('firedHoursChart', {

                chart: {
                    type: 'area',
                    zoomType: 'x',
                    panning: true,
                    panKey: 'shift',
                    scrollablePlotArea: {
                        minWidth: 600
                    }
                },

                title: {
                    text: 'Number of Hours Fired Over Time'
                },

                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Running Total (Hours)'
                    }
                },
                legend: {
                    enabled: false
                },

                series: [{
                    data: this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.firedHours)] ),
                    lineColor: Highcharts.getOptions().colors[1],
                    color: Highcharts.getOptions().colors[2],
                    fillOpacity: 0.5,
                    name: 'Fired Hours',
                    marker: {
                        enabled: false
                    },
                    threshold: null
                }]

            });
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
