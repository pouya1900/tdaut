<template>
    <div class="offices_container">
        <div class="container">

            <div class="offices_container--title">
                <h5>{{ trs.technology_service_offices }}</h5>
            </div>

            <div class="offices_filter_container">

                <div class="offices_filter">
                    <select class="form-select" v-model="department_select" name="department">
                        <option value="0">همه دانشکده ها</option>
                        <option v-for="option in departments" :value="option.id">{{ option.title }}</option>

                    </select>
                </div>

                <div class="offices_search input-group">
                    <span class="input-group-text" id="search"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" v-model="searchQuery" :placeholder="trs.search_in_offices"
                           aria-label="search"
                           aria-describedby="search">
                </div>

            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mb-4" v-for="office in resultQuery">
                    <a :href="office.url">
                        <div class="office_container">
                            <div class="office_thumbnail">
                                <img :src="office.logo">
                                <div class="sparkle">
                                    <ul>
                                        <li v-for="capability in office.capabilities">{{ capability.text.substring(0,25)+".." }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="office_content">
                                <div class="office_title">
                                    <span>{{ office.name }}</span>
                                </div>

                                <div class="office_description">
                                    <p>{{ office.about.substring(0,100)+".." }}
                                    </p>
                                </div>

                                <div class="">
                                    <span class="office_key">دانشکده : </span>
                                    <span class="office_value">{{ office.department.title }}</span>
                                </div>
                                <div class="">
                                    <span class="office_key">پروژه : </span>
                                    <span class="office_value">{{ office.projects_count }}</span>
                                </div>
                                <div class="">
                                    <span class="office_key">رئیس : </span>
                                    <span class="office_value">{{ office.head_name }}</span>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: ['departments', 'capabilities', 'offices', 'trs'],
    name: 'office-index',
    methods: {},
    data() {
        return {
            department_select: 0,
            searchQuery: ''
        }
    },
    computed: {
        resultQuery() {
            return this.offices.filter(item => {
                return (item.name.toLowerCase().includes(this.searchQuery) ||
                        item.products_name.toLowerCase().includes(this.searchQuery) ||
                        item.head_name.toLowerCase().includes(this.searchQuery)) &&
                    (!this.department_select || item.department.id === this.department_select || this.department_select==0);
            })
        }
    }
}

</script>
