var clientsApp = new Vue({
  el: '#clientMain',
  data: {
  clientList: []
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
