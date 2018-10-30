var notesApp = new Vue({
  el: '#notesMain',
  data: {
    clientId: 0,
    clientName:'',
    notesForm: { },   // populated by this.getEmptyNotesForm()
    notesList: []
  },

  methods: {
    handleNotesForm(e) {
      this.notesForm.clientId = this.clientId;

      const s = JSON.stringify(this.notesForm);

      console.log(s);

      fetch('api/notes.php?',
       {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        headers: {
            "Content-Type": "application/json; charset=utf-8"
        },
        body: s // body data type must match "Content-Type" header
      })
      .then( response => response.json() )
      .then( json => {notesApp.notesList.push(json)})
      .catch( err => {
        console.error('NOTES POST ERROR:');
        console.error(err);
      })

      // Reset notesForm
      this.notesForm = this.getEmptyNotesForm();
    },

    getEmptyNotesForm () {
      return {
        notes: null
      }
    }
  },
  created () {
    // Populate notesForm with default values
    this.notesForm = this.getEmptyNotesForm();

    const url = new URL(window.location.href);
    const clientId = url.searchParams.get('clientId');
    const clientName = url.searchParams.get('clientName');
    console.log('Client Id: '+ clientId);
    console.log('Client Name: '+ clientName);
    this.clientId = clientId;
    this.clientName = clientName;

    fetch('api/notes.php?clientId='+clientId)
    .then( response => response.json() )
    .then( json => {notesApp.notesList = json} )
    .catch( err => {
      console.error('NOTES FETCH ERROR:');
      console.error(err);
    })
  }

})
