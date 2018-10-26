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
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Sensor Heat Rate'
    },

    pane: {
        startAngle: -150,
        endAngle: 150,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: 9000,
        max: 12000,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },
        title: {
            text: 'kWh'
        },
        plotBands: [{
            from: 9000,
            to: 10000,
            color: '#55BF3B' // green
        }, {
            from: 10000,
            to: 11000,
            color: '#DDDF0D' // yellow
        }, {
            from: 11000,
            to: 12000,
            color: '#DF5353' // red
        }]
    },

    series: [{
        name: 'heatRate',
        data: this.kpiList.map( item => [Date.parse(item.dataCollectiveDate), Number(item.heatRate)] ),
        tooltip: {
            valueSuffix: ' kWh'
        }
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
