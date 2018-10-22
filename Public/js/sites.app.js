var sitesApp = new Vue({
  el: '#siteMain',
  data: {
    site: {
      siteId: 0,
      clientId: 0,
      siteName : '',
      siteDescription : '',
      primaryContact : '',
      capacity: '',
      commercialDate: '',
      addrLine1: '',
      addrLine2: '',
      addrCity: '',
      addrState : '',
      addrZip: '',
      addrCountry: ''
    },
  siteList: []
},


methods: {
gotoTurbine(sid) {
  window.location = 'turbine.html?siteId=' + sid;
}
},

  created (){

    const url = new URL(window.location.href);
    const clientId = url.searchParams.get('clientId');
    console.log('Client Id: '+ clientId);
    this.site.clientId = clientId;

    fetch('api/site.php?clientId='+clientId)
    .then( response => response.json() )
    .then( json => {sitesApp.siteList = json} )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })
  }
})
