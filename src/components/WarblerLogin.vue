<template>
	<div>
		<wblr-nav></wblr-nav>
		<div class="container wblr-login">
			<div class="alert alert-danger" role="alert" v-if="error">
				{{errorMessage}}
			</div>
			<label for="username">Username</label>
			<div class="input-group">
				<input v-model="username" id="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username">
			</div>
			<br>
			<label for="password">Password</label>
			<div class="input-group">
				<input v-model="password" id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password">
			</div>
			<br>
			<button v-on:click="login" type="button" class="btn btn-primary btn-lg btn-block">Login</button>
			<br>
			<router-link to="/account/create">Don't have an account? Create one here</router-link>
		</div>
	</div>
</template>

<script>
export default {
  name: 'WarblerLogin',
	data () {
		return {
			username: '',
			password: '',
			error: false,
			errorMessage: ''
		}
	},
	methods: {
		login: function() {
			var params = new URLSearchParams()
			params.append('username', this.username)
			params.append('password', this.password)

			this.$http.post('auth/login.php', params)
			.then(response => {
				this.error = false
				this.$session.set('user_id', response.data.user.id)
				this.$session.set('username', this.username)
                this.$session.set('loggedIn', true)
				this.$router.push('profile')
			})
			.catch(error => {
				if (error.response.data.type == 'username-incorrect-error') {
					this.error = true
					this.errorMessage = 'That username is incorrect'
				}
				else if (error.response.data.type == 'password-incorrect-error') {
					this.error = true
					this.errorMessage = 'That password is incorrect'
				}
			})
		}
	}
}
</script>

<style scoped>
.wblr-login {
	margin-top: 20px;
}
.error-message {
	color: red;
}
</style>