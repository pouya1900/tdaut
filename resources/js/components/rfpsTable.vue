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
        'rfps_data'
    ],
    name: 'rfps',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'کاربر',
                    field: 'user',
                },
                {
                    label: 'عنوان',
                    field: 'title',
                },
                {
                    label: 'تاریخ ایجاد',
                    field: 'created_at',
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
            rows: this.rfps_data
        };
    },
}

</script>
