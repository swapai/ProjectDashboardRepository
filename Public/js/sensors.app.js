var sensorApp = new Vue({
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
    turbineSerialNumber:'',
    sensorList: []
},

  created (){
    const url = new URL(window.location.href);
    const turbineDeployedId = url.searchParams.get('turbineDeployedId');
    const turbineSerialNumber = url.searchParams.get('serialNumber');
    console.log('Turbine Deployed Id: '+ turbineDeployedId);
    this.sensor.turbineDeployedId = turbineDeployedId;
    this.turbineSerialNumber = turbineSerialNumber;
    fetch('api/sensordeployed.php?turbineDeployedId='+turbineDeployedId)
    .then( response => response.json() )
    .then( json => {sensorApp.sensorList = json} )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })
  }
})
