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
        'users_data'
    ],
    name: 'users',
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
                    label: 'نقش',
                    field: 'role',
                },
                {
                    label: 'نوع',
                    field: 'type',
                },
                {
                    label: ' وضعیت',
                    field: 'status',
                },
                {
                    label: 'پیام وضعیت',
                    field: 'status_message',
                },
                {
                    label: 'تاریخ تغییر وضعیت',
                    field: 'status_date',
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
            rows: this.users_data
        };
    },
}

</script>
