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
    ],
    name: 'admin.members',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'نام',
                    field: 'name',
                },
                {
                    label: 'نام کاربری',
                    field: 'username',
                },
                {
                    label: 'ایمیل',
                    field: 'email',
                },
                {
                    label: 'نوع',
                    field: 'type',
                },
                {
                    label: 'لینک',
                    field: 'link',
                    html: true,
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
            rows: this.members_data
        };
    },
}

</script>
