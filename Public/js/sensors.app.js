var senosorApp = new Vue({
  el: '#sensorMain',
  data: {
    sensor: {
      sensorId: 0,
      sensorDeployedId: 0,
      sensorName:'',
      sensorDescription:'',
      manufacturer:'',
      totalLifeExpentancyHours:'',
      turbineDeployedId:'',
      serialNumber:'',
      deployedDate:''
    },
  sensorList: []
},

  created (){

    const url = new URL(window.location.href);
    const turbineDeployedId = url.searchParams.get('turbineDeployedId');
    console.log('Turbine Deployed Id: '+ turbineDeployedId);
    this.sensor.turbineDeployedId = turbineDeployedId;
    fetch('api/sensordeployed.php?turbineDeployedId='+turbineDeployedId)
    .then( response => response.json() )
    .then( json => {senorApp.sensorList = json} )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })
  }
})
