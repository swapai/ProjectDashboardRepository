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

    fetch('api/site.php?clientId='+clientId)
    .then( response => response.json() )
    .then( json => {sitesApp.work = json} )
    .catch( err => {
      console.error('SITE FETCH ERROR:');
      console.error(err);
    })
  }
})
