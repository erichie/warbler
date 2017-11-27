<template>
	<div>
		<wblr-nav></wblr-nav>
		<div class="container-fluid wblr-profile">
			<div class="row">
				<div class="col-lg-2">
					<div class="card" style="width: 20rem;">
						<div class="card-body">
							<h4 class="card-title">{{user.display_name}}</h4>
							<p class="card-text">{{user.username}}</p>
							<p class="card-text">{{user.email}}</p>
							<router-link to="/profile/edit" class="btn btn-primary">Edit Profile</router-link>
						</div>
					</div>
				</div>
				<div class="col-lg-10">
					<h4 class="wblr-my-feed-title">My Warbles</h4>
					<div v-for="warble in warbles">
						<wblr-warble :warble="warble"></wblr-warble>
					</div>
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
			user: {},
			warbles: []
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
				this.warbles = response.data.warbles
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

.card {
	margin-top: 25px;
}

.wblr-my-feed-title {
	margin-top: 25px;
	text-align: center;
}
</style>