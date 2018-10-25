var clientsApp = new Vue({
  el: '#clientMain',
  data: {
  clientList: []
},
methods: {
  gotoSite(cid) {
    window.location = 'site.html?clientId=' + cid;
  },

  gotoNotes(cid, cname) {
    window.location = 'notes.html?clientId=' + cid + '&cleintName=' + cname ;
  }
},
  created (){


    fetch('api/client.php')
      .then( response => response.json() )
      .then( json => {clientsApp.clientList = json} )
      .catch( err => {
        console.error('CLIENT FETCH ERROR:');
        console.error(err);
      })
  }
})
