var indexApp = new Vue({
  el: '#index',
  data: {
    clientList: [ ]
  },


  created () {

    fetch('api/client.php')
    .then( response => response.json() )
    .then( json => {indexApp.clientList = json} )
    .catch( err => {
    console.error('CLIENT FETCH ERROR:');
    console.error(err);
    })
  }
})
