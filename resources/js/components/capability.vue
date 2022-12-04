<template>

    <div class="row justify-content-center m-0">
        <div v-for="(input,k) in capabilities" :key="k" class="col-12 col-lg-8">
            <div class="mg-office--item">
                <input type="text" name="capabilities[]" v-model="input.text"
                       placeholder="توانمندی">
                <button type="button" class="delete_capability" @click="remove(k)">-</button>
            </div>
        </div>
    </div>
    <div id="" class="mg-office--item">
        <button type="button" name="add_capability" id="add_capability" @click="add()">+</button>
    </div>

</template>


<script>
export default {
    props: ['data'],
    name: 'capability',
    methods: {
        remove(index) {
            this.capabilities.splice(index, 1);
        },
        add() {
            this.capabilities.push({text: ''});
        },
    },
    data() {
        return {
            capabilities: this.data,
        }
    },
}

</script>
