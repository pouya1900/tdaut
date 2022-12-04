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
    name: 'user_rfps',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'دفتر',
                    field: 'office',
                },
                {
                    label: 'عنوان',
                    field: 'title',
                },
                {
                    label: 'توضیحات',
                    field: 'description',
                    html: true,
                },
                {
                    label: 'فایل',
                    field: 'file',
                    html: true
                },
                {
                    label: 'پروپوزال',
                    field: 'proposal',
                    html: true
                },
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
