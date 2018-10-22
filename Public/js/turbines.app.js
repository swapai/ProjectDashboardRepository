var turbinesApp = new Vue({
  el: '#turbineMain',
  data: {
    turbine: {
      turbineId: 0,
      turbineDeployedId: 0,
      siteId: 0,
      serialNumber:'',
      deployedDate:'',
      totalFiredHours:'',
      totalStarts:'',
      lastPlannedOutageDate:'',
      lastUnplannedOutageDate:'',
      turbineName:'',
      turbineDescription:'',
      capacity:'',
      rampUpTime:'',
      maintenanceInterval:''
    },
  turbineList: []
},


  created (){

    const url = new URL(window.location.href);
    const siteId = url.searchParams.get('siteId');
    console.log('Site Id: '+ siteId);
    this.turbine.siteId = siteId;
    fetch('api/turbineDeployed.php?siteId='+siteId)
    .then( response => response.json() )
    .then( json => {turbinesApp.turbineList = json} )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })
  }
})
