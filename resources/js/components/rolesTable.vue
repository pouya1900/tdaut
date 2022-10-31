<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :rtl="true"
            :search-options="{
    enabled: true,
    placeholder: 'جست و جو',
  }">
        </vue-good-table>
    </div>
</template>

<script>
export default {
    props: [
        'roles_data'
    ],
    name: 'roles',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'نقش',
                    field: 'role',
                },
                {
                    label: 'دسترسی ها',
                    field: 'permission',
                },
                {
                    label: 'عملیات',
                    field: 'action',
                    html: true,
                }
            );

            return array;
        }
    },
    data() {
        return {
            columns: this.get_columns(),
            rows: this.roles_data
        };
    },
}

</script>
