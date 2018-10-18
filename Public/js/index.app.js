var clientsApp = new Vue({
  el: '#clientMain',
  data: {
  clientList: []
},
methods: {
  gotoSite(cid) {
    window.location = 'task.html?clientId=' + cid;
  }
},
  created (){
    const url = new URL(window.location.href);
    const clientId = url.searchParams.get('clientId') || 0;

    if (!clientId) {
      console.error('client Id not defined in URL parameters.')
    }


    fetch('api/client.php')
      .then( response => response.json() )
      .then( json => {clientsApp.clientList = json} )
      .catch( err => {
        console.error('CLIENT FETCH ERROR:');
        console.error(err);
      })
  }
})
