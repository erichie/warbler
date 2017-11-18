<template>
	<div>
		<wblr-nav></wblr-nav>
		<div class="container wblr-profile">
			<h1>{{user.display_name}}</h1>
			<h3>{{user.username}}</h3>
			<h3>{{user.email}}</h3>
		</div>
	</div>
</template>

<script>
export default {
	name: 'WarblerProfile',
	data () {
		return {
			user: {}
		}
	},
	created: function() {
		if (this.$session.exists() && this.$session.has('username') && this.$session.has('loggedIn')) {
			this.loggedIn = true
			this.$http.get('controllers/UserController.php', {
				params: {
					username: this.$session.get('username')
				}
			})
			.then(response => {
				this.user = response.data.user
			})
			.catch(error => {
				console.log(error)
			})
		}
	}
}
</script>

<style scoped>
.wblr-profile {
	padding: 20px;
}
</style>