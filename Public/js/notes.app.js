var notesApp = new Vue({
  el: '#notesMain',
  data: {
    notes: [],
    notesForm: { },   // populated by this.getEmptyWorkForm()
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

      // Reset workForm
      this.notesForm = this.getEmptyNotesForm();
    },

    getEmptyNotesForm () {
      return {
        notes: null //this.commentdata.comment
      }
    }
  },
  created () {
    // Populate workForm with default values
    this.notesForm = this.getEmptyNotesForm();

    // TODO: Fetch task-specific data
    const url = new URL(window.location.href);
    const clientId = url.searchParams.get('clientId');
    console.log('Client Id: '+ clientId);
    this.clientId = clientId;

    fetch('api/notes.php?clientId='+clientId)
    .then( response => response.json() )
    .then( json => {notesApp.notesList = json} )
    .catch( err => {
      console.error('NOTES FETCH ERROR:');
      console.error(err);
    })
  }

})
