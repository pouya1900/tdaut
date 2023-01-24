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
    name: 'member.offices',
    methods: {
        get_columns() {
            let array = [];
            array.push(
                {
                    label: 'نام',
                    field: 'name',
                },
                {
                    label: 'نقش ها',
                    field: 'roles',
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
