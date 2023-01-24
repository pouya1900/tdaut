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
        'supports_data',
        'is_admin'
    ],
    name: 'roles',
    methods: {
        get_columns() {
            let array = [];
            if (this.is_admin) {
                array.push({
                    label: 'نام',
                    field: 'name',
                },
                );
            }
            array.push(
                {
                    label: 'عنوان',
                    field: 'title',
                },
                {
                    label: 'تاریخ ایجاد',
                    field: 'created_at',
                },
                {
                    label: 'وضعیت',
                    field: 'status',
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
            rows: this.supports_data
        };
    },
}

</script>
