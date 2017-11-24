<template>
	<div>
		<wblr-nav></wblr-nav>
		<div class="container wblr-profile">
			<div class="card" style="width: 20rem;">
				<div class="card-body">
					<h4 class="card-title">{{user.display_name}}</h4>
					<p class="card-text">{{user.username}}</p>
					<p class="card-text">{{user.email}}</p>
					<a href="#" class="btn btn-primary">Edit Profile</a>
				</div>
			</div>
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