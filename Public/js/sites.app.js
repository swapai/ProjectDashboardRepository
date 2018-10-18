var sitesApp = new Vue({
  el: '#siteMain',
  data: {
  siteList: []
},
// methods: {
//   gotoSite(cid) {
//     window.location = 'site.html?clientId=' + cid;
//   }
// },
  created (){
    const url = new URL(window.location.href);
        const clientId = url.searchParams.get('clientId');
        console.log('Clinet: '+ clientId);
        this.clientList.clientId = clientId;

    fetch('api/site.php')
      .then( response => response.json() )
      .then( json => {sitesApp.siteList = json} )
      .catch( err => {
        console.error('SITE FETCH ERROR:');
        console.error(err);
      })
  }
})
