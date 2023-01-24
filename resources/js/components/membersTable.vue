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
        'members_data',
        'super_user'
    ],
    name: 'members',
    methods: {
        get_columns() {
            let array = [];
            array.push({
                    label: 'نام',
                    field: 'name',
                },
                {
                    label: 'نوع',
                    field: 'type',
                },
                {
                    label: 'نام کاربری',
                    field: 'username',
                },
                {
                    label: 'جنسیت',
                    field: 'gender',
                },
                {
                    label: 'نقش',
                    field: 'role',
                });

            if (this.super_user) {
                array.push({
                    label: 'عملیات',
                    field: 'action',
                    html: true,
                });
            }
            return array;
        }
    },
    data() {
        return {
            columns: this.get_columns(),
            rows: this.members_data
        };
    },
}

</script>
