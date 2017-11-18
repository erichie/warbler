<template>
    <div>
        <wblr-nav></wblr-nav>
        <div class="container wblr-create-account">
            <label for="username">Username</label>
            <div class="input-group">
                <input v-model="username" id="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="username">
            </div>
            <br>
            <label for="email">Email</label>
            <div class="input-group">
                <input v-model="email" id="email" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email">
            </div>
            <br>
            <label for="displayName">Display Name</label>
            <div class="input-group">
                <input v-model="displayName" id="displayName" type="text" class="form-control" placeholder="Display Name" aria-label="Display Name" aria-describedby="displayname">
            </div>
            <br>
            <label for="password">Password</label>
            <div class="input-group">
                <input v-model="password" id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password">
            </div>
            <br>
            <label for="password2">Repeat Password</label>
            <div class="input-group">
                <input v-model="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password" aria-label="Password2" aria-describedby="password2">
            </div>
            <br>
            <button v-on:click="createAccount" type="button" class="btn btn-primary btn-lg btn-block">Create Account</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'WarblerCreateAccount',
    data () {
        return {
            username: '',
            email: '',
            password: '',
            password2: '',
            displayName: ''
        }
    },
    methods: {
        createAccount: function() {
            var params = new URLSearchParams()
			params.append('username', this.username)
            params.append('email', this.email)
			params.append('password', this.password)
            params.append('display_name', this.displayName)

            this.$http.post('auth/createAccount.php', params)
			.then(response => {
                this.$session.set('user_id', response.data.user.id)
                this.$session.set('username', response.data.user.username)
                this.$session.set('loggedIn', true)
				this.$router.push('/profile')
			})
			.catch(error => {
				console.log(error)
			})
        }
    }
}
</script>

<style scoped>
.wblr-create-account {
    margin-top: 20px;
}
</style>