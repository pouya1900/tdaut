<template>
    <input type="text" name="username" v-model="username" autocomplete="off" @keyup="search()"
           :placeholder="label">
    <p v-show="result" class="alert_js">
        {{ alert }}
    </p>
</template>


<script>
export default {
    props: ['old_username', 'link', 'label', 'alert'],
    name: 'searchMember',
    methods: {
        search() {
            if (this.username.length > 2) {
                axios.get(this.link + '?username=' + this.username)
                    .then(response => {
                        this.result = !response.data;
                    }).catch(error => {
                });
            } else {
                this.result = false;
            }
        },
    },
    data() {
        return {
            username: this.old_username,
            result: false
        }
    },
}

</script>
