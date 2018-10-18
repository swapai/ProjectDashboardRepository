//copied from comment assignment, still need updates

var commentsApp = new Vue({
  el: '#commentMain',
  data: {

    commentForm: { },   // populated by this.getEmptyWorkForm()
    commentList: []
  },

  methods: {
    handleCommentForm(e) {

      const s = JSON.stringify(this.commentForm);

            console.log(s);

      fetch('api/comment.php', {
        method: "POST", // *GET, POST, PUT, DELETE, etc.
        headers: {
            "Content-Type": "application/json; charset=utf-8"
        },
        body: s // body data type must match "Content-Type" header
      })
      .then( response => response.json() )
      .then( json => {this.commentList.push(json)})
      .catch( err => {
        console.error('COMMENT POST ERROR:');
        console.error(err);
      })

      // Reset workForm
      this.commentForm = this.getEmptyCommentForm();
    },

    getEmptyCommentForm () {
      return {
        comment: null //this.commentdata.comment
      }
    }
  },
  created () {
    // Populate workForm with default values
    this.commentForm = this.getEmptyCommentForm();

    // TODO: Fetch task-specific data
    // fetch('api/task?id=4')
    fetch('api/comment.php')
    .then( response => response.json() )
    .then( json => {commentsApp.commentList = json} )
    .catch( err => {
      console.error('COMMENT FETCH ERROR:');
      console.error(err);
    })
  }

})
