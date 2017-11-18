<template>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{warble.user.display_name}} <span class="username">@{{warble.user.username}}</span></h4>
            <h6 class="card-subtitle mb-2 text-muted">{{warble.date}}</h6>
            <p class="card-text">{{warble.content}}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'WarblerWarble',
    props: ['warble'],
    created: function() {
        this.findHashtags()
    },
    methods: {
        findHashtags: function() {
            var hashtagRegex = /(#)\w*/g
            var hashtagArray = this.warble.content.match(hashtagRegex)
            if (hashtagArray != null) {
                console.log(hashtagArray)
            }
        }
    }
}
</script>

<style scoped>
.card {
    width: 60%;
    margin: 25px auto;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    border: none;
}

.card-subtitle {
    font-size: 11px;
}

.username {
    font-size: 15px;
    color: #7A8590;
}
</style>