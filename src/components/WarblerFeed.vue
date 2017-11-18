<template>
  <div>
    <wblr-nav></wblr-nav>
    <div class="wblr-feed container">
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
      warbles: []
    }
  },
  created: function () {
    this.$http.get('controllers/WarbleController.php', {params: {all_warbles: true}})
      .then(response => {
        this.warbles = response.data.warbles
      }).catch(error => {
        console.log('error', error)
      })
  },
  methods: {
    resourceTest: function () {
      this.$http.get('test.php')
      .then(response => {
        console.log(response)
      }).catch(error => {
        console.log('error', error)
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
