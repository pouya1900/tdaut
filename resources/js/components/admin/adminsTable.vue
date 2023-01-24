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
        'admins_data'
    ],
    name: 'admins',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'نام',
                    field: 'name',
                },
                {
                    label: 'ایمیل',
                    field: 'email',
                },
                {
                    label: 'نقش',
                    field: 'role',
                },
                {
                    label: 'عملیات',
                    field: 'action',
                    html: true
                }
            );
            return array;
        }
    },
    data() {
        return {
            columns: this.get_columns(),
            rows: this.admins_data
        };
    },
}

</script>
