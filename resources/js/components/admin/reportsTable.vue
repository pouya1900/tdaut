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
        'reports_data'
    ],
    name: 'reports',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'مدل',
                    field: 'model',
                },
                {
                    label: 'نام',
                    field: 'name',
                },
                {
                    label: 'نوع',
                    field: 'type',
                },
                {
                    label: 'متن',
                    field: 'text',
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
            rows: this.reports_data
        };
    },
}

</script>
