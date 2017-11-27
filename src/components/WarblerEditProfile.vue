<template>
    <div>
        <wblr-nav></wblr-nav>
        <div class="wblr-edit-profile container">
            <label for="display_name">Display Name</label>
            <div class="input-group">
                <input id="display_name" type="text" class="form-control" :value="user.display_name" v-model="user.display_name">
            </div>
            <br>
            <label for="username">Username</label>
            <div class="input-group">
                <input id="username" type="text" class="form-control" :value="user.username" v-model="user.username">
            </div>
            <br>
            <label for="email">Email</label>
            <div class="input-group">
                <input id="email" type="text" class="form-control" :value="user.email" v-model="user.email">
            </div>
            <br>
            <button v-on:click="saveProfile()" class="wblr-save-btn btn btn-primary">Save Profile</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'WarblerEditProfile',
    data () {
        return {
            user: {},
            loggedIn: false
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
    },
    methods: {
        saveProfile: function() {
            console.log(this.user)
        }
    }
}
</script>

<style scoped>
.wblr-edit-profile {
    margin-top: 15px;
}

label {
    font-weight: bold;
    font-size: 20px;
}

.wblr-save-btn {
    float: right;
}
</style>
