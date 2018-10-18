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

    fetch('api/site.php')
      .then( response => response.json() )
      .then( json => {sitesApp.siteList = json} )
      .catch( err => {
        console.error('SITE FETCH ERROR:');
        console.error(err);
      })
  }
})
