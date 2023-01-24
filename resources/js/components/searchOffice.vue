<template>
    <div class="office_result_list-container">
        <div class="member_edit_form--new">
            <label>{{ this.label }}</label>
            <input type="text" name="search" v-model="office_name" :placeholder="this.label" @keyup="search()"
                   autocomplete="off">
            <input type="hidden" name="office_id" v-model="office_id">
        </div>

        <div v-if="results" class="member-result-list">
            <ul>
                <li v-for="input in results" @click="select(input.id,input.name)">
                    <img :src="input.logo">
                    <span>{{ input.name }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>


<script>
export default {
    props: ['label', 'link'],
    name: 'searchOffice',
    methods: {
        search() {
            if (this.office_name.length > 2) {
                axios.get(this.link + '?str=' + this.office_name)
                    .then(response => {
                        this.results = response.data;
                    }).catch(error => {
                });
            } else {
                this.results = null;
            }
        },
        select(id, name) {
            this.office_id = id;
            this.results = null;
            this.office_name = name;
        },
    },
    data() {
        return {
            office_id: null,
            office_name: null,
            results: null
        }
    },
}

</script>
