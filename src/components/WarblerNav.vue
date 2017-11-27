<template>
	<div>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
			<span class="navbar-brand mb-0 h1">{{name}}</span>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
				<router-link class="nav-link" to="/">Feed</router-link>
				</li>
			</ul>

			<div v-if="loggedIn">
				<router-link to="/profile">
					<button type="button" class="btn btn-primary">Profile</button>
				</router-link>
				<router-link to="/warble">
					<button type="button" class="btn btn-info">Warble <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
				</router-link>
				<button v-on:click="logout" type="button" class="btn btn-danger">Logout</button>
			</div>

			<div v-if="!loggedIn">
				<router-link to="/login">
					<button type="button" class="btn btn-primary">Login</button>
				</router-link>
			</div>

			<form class="wblr-search form-inline my-2 my-lg-0">
				<input v-model="searchTerm" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button v-on:click="search" class="btn btn-outline-success my-2 my-sm-0">Search</button>
			</form>
	  </div>
		</nav>
	</div>
</template>

<script>
export default {
	name: 'WarblerNav',
	data () {
		return {
			name: 'Warbler',
			loggedIn: false,
			searchTerm: ''
		}
	},
	created: function() {
		if (this.$session.exists() && this.$session.has('username') && this.$session.has('loggedIn')) {
			this.loggedIn = true
		}
	},
	methods: {
		search: function(e) {
			e.preventDefault();
			this.$router.push('/feed/hashtag?tag='+this.searchTerm.replace('#', ''))
		},
		logout: function() {
			this.$session.destroy()
			this.$router.push('/login')
		}
	}
}
</script>

<style scoped>
.wblr-search {
	margin-left: 10px;
}
</style>