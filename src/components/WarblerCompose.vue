<template>
    <div>
        <wblr-nav></wblr-nav>
        <div class="container wblr-compose">
            <label for="warble">Compose Warble</label>
            <div class="input-group">
                <textarea v-model="warble" v-on:keyup="checkLength" id="warble" type="text" class="form-control" placeholder="Warble" aria-label="Warble" aria-describedby="warble"></textarea>
            </div>
            <p class="wblr-length-counter">Warble Length: {{this.warble.length}}/140</p>
            <br>
            <button v-on:click="submitWarble" v-bind:disabled="submitDisabled" type="button" class="btn btn-primary btn-lg btn-block">Warble</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'WarblerCompose',
    data () {
        return {
            maxLength: 140,
            warble: '',
            submitDisabled: false
        }
    },
    methods: {
        checkLength: function() {
            if (this.warble.length > this.maxLength) {
                this.submitDisabled = true
            }
            else {
                this.submitDisabled = false
            }
        },
        submitWarble: function() {
            var params = new URLSearchParams()
			params.append('warble_content', this.warble)
            params.append('user_id', this.$session.get('user_id'))

            this.$http.post('controllers/WarbleController.php', params)
            .then(response => {
                this.$router.push('/')
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>
.wblr-compose {
    margin-top: 20px;
}

.wblr-length-counter {
    float: right;
}
</style>