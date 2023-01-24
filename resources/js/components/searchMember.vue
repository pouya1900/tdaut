<template>
    <div class="member_edit_form--new">
        <label>{{ this.label }}</label>
        <input type="text" name="search" v-model="username" :placeholder="this.label" @keyup="search()"
               autocomplete="off">
        <input type="hidden" name="member_id" v-model="member_id">
    </div>

    <div v-if="results" class="member-result-list">
        <ul>
            <li v-for="input in results" @click="select(input.id,input.name)">
                <img :src="input.avatar">
                <span>{{ input.name }}</span>
            </li>
        </ul>
    </div>

</template>


<script>
export default {
    props: ['label', 'link'],
    name: 'searchMember',
    methods: {
        search() {
            if (this.username.length > 2) {
                axios.get(this.link + '?str=' + this.username)
                    .then(response => {
                        this.results = response.data;
                    }).catch(error => {
                });
            } else {
                this.results = null;
            }
        },
        select(id, name) {
            this.member_id = id;
            this.results = null;
            this.username = name;
        },
    },
    data() {
        return {
            member_id: null,
            username: null,
            results: null
        }
    },
}

</script>
