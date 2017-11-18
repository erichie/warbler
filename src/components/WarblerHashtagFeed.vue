<template>
  <div>
    <wblr-nav></wblr-nav>
    <div class="wblr-feed container">
      <h1 v-if="error">No Warbles found for that #hashtag</h1>
      <div v-for="warble in warbles">
        <wblr-warble :warble="warble"></wblr-warble>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'WarblerFeed',
  data () {
    return {
      msg: 'Welcome to Warbler',
      warbles: [],
      hashtag: '',
      error: false
    }
  },
  created: function () {
    this.hashtag = this.$route.query.tag
    this.getWarbles(this.hashtag)
  },
  watch: {
      '$route.query.tag': function(newTag, oldTag) {
          this.getWarbles(newTag)
      }
  },
  methods: {
    getWarbles: function(hashtag) {
        hashtag = '#' + hashtag
        this.$http.get('controllers/WarbleController.php', {params: {hashtag: hashtag}})
        .then(response => {
            this.error = false
            this.warbles = response.data.warbles
        }).catch(error => {
            this.warbles = []
            this.error = true
        })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.wblr-feed {
    margin-top: 15px;
}

h1, h2 {
  font-weight: normal;
	text-align: center;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
