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
        'offices_data'
    ],
    name: 'offices',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'نام',
                    field: 'name',
                },
                {
                    label: 'رئیس',
                    field: 'head',
                },
                {
                    label: 'دانشکده',
                    field: 'department',
                },
                {
                    label: ' وضعیت',
                    field: 'status',
                },
                // {
                //     label: 'پیام وضعیت',
                //     field: 'status_message',
                // },
                {
                    label: 'تاریخ تغییر وضعیت',
                    field: 'status_date',
                },
                {
                    label: 'لینک',
                    field: 'link',
                    html: true,
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
            rows: this.offices_data
        };
    },
}

</script>
