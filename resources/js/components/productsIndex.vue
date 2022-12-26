<template>
    <div class="row m-0">
        <div id="side_filter_main_container"
             class="col-lg-2 d-lg-block d-none flight_side_bar_modal flight_sidebar_container sticky-sidebar padding-right-5px padding-left-5px">
            <div id="modal-div">
                <div id="modal-dialog-div">
                    <div id="modal-content-div">
                        <div id="modal-body-div">
                            <div class="side_filter_content">
                                <!-- Sidebar -->

                                <div class="widget">

                                    <div class="widget_content">


                                        <div class="widget_item">
                                            <div class="input-group">
                                                <span class="input-group-text" id="search"><i
                                                    class="fa-solid fa-magnifying-glass"></i></span>
                                                <input type="text" class="form-control" v-model="searchQuery"
                                                       :placeholder="trs.search" aria-label="search"
                                                       aria-describedby="search">
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="widget">
                                    <div class="widget_content">

                                        <div class="widget-sub-title">
                                            <span>{{ trs.categories }}</span>

                                        </div>

                                        <div class="widget_item" v-for="cat in categories">

                                            <div class="custom-control custom-checkbox font-weight-600 ">

                                                <input type="checkbox" class="custom-control-input"
                                                       :id="'category_'+cat.id" v-model="category_select"
                                                       :value="cat.id" checked>

                                                <label class="custom-control-label"
                                                       :for="'category_'+cat.id">{{ cat.title }}</label>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="widget">
                                    <div class="widget_content">
                                        <div class="widget-sub-title">
                                        </div>

                                        <div class="widget_item">

                                            <div class="custom-control custom-checkbox font-weight-600 ">

                                                <input type="checkbox" class="custom-control-input" id="3d0"
                                                       v-model="select_3d"
                                                       value="0">

                                                <label class="custom-control-label"
                                                       for="3d0">{{ trs.with_3d }}</label>
                                            </div>

                                        </div>
                                        <div class="widget_item">

                                            <div class="custom-control custom-checkbox font-weight-600 ">

                                                <input type="checkbox" class="custom-control-input" id="3d1"
                                                       v-model="select_3d"
                                                       value="1">

                                                <label class="custom-control-label"
                                                       for="3d1">{{ trs.without_3d }}</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Sidebar -->


                            </div>
                            <div class="d-lg-none">
                                <div class="filter_modal_close_container">
                                    <span class="filter_modal_close"><i
                                        class="fas fa-sort-amount-down"></i>{{ trs.show_filter_result }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-12 products_body">

            <div class="products">
                <div class="row">
                    <div class="col-12 col-lg-3" v-for="product in resultQuery">
                        <div class="product">
                            <div class="vr_tour_option">
                                <span>تور مجازی</span>
                            </div>
                            <div class="product--logo">
                                <a :href="product.url">
                                    <img :src="product.logo" :alt="product.title"
                                         :title="product.title">
                                </a>
                            </div>

                            <div class="product--content">
                                <a :href="product.url">

                                    <div class="product--name">
                                        <span>{{ product.title }}</span>
                                    </div>
                                </a>

                                <div class="product--description">
                                    <span>{{ product.description }}</span>
                                </div>
                                <a :href="product.office_url">
                                    <div class="product--office_name">
                                            <span><i
                                                class="fa-solid fa-building"></i> {{ product.office.name }}</span>
                                    </div>
                                </a>
                                <div class="product--category">
                                    <img src="storage/assets/siteContent/category.png">
                                    <span>{{ product.category.title }}</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>
export default {
    props: ['products', 'trs', 'categories', 'categories_id'],
    name: 'product-index',
    methods: {},
    data() {
        return {
            category_select: this.categories_id,
            searchQuery: '',
            select_3d: [0, 1]
        }
    },
    computed: {
        resultQuery() {
            return this.products.filter(item => {
                return (item.title.toLowerCase().includes(this.searchQuery) ||
                        item.office.name.toLowerCase().includes(this.searchQuery)) &&
                    (this.category_select.includes(item.category.id));
            })
        }
    }
}

</script>
