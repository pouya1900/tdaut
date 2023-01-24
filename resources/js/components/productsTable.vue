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
        'products_data'
    ],
    name: 'products',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'عنوان',
                    field: 'title',
                },
                {
                    label: 'دسته بندی',
                    field: 'category',
                },
                {
                    label: 'وضعیت',
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
                    label: 'لینک دمو',
                    field: 'link',
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
            rows: this.products_data
        };
    },
}

</script>
