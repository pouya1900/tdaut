<template>

    <div class="user_type_select">
        <div class="row justify-content-center">
            <div class="col-6">
                <select class="form-select" v-model="selected" @change="select_type()">
                    <option disabled value="0">انتخاب کنید</option>
                    <option value="1">{{ data.trans.real_person }}</option>
                    <option value="2">{{ data.trans.legal_person }}</option>
                </select>
            </div>
        </div>

    </div>

    <div v-show="real_container">
        <form method="post" :action="link">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="type" :value="selected">

            <div>
                <div class="row m-0">
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input class="left-to-right" type="text" name="email" :value="old.email"
                                   :placeholder="data.trans.email">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="text" name="first_name" :value="old.first_name"
                                   :placeholder="data.trans.first_name">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="text" name="last_name" :value="old.last_name"
                                   :placeholder="data.trans.last_name">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item form-check form-check-inline">
                            <label class="form-check-label" for="gender1">{{ data.trans.male }}</label>
                            <input class="form-check-input" type="radio"
                                   name="gender" id="gender1"
                                   value="male">
                        </div>
                        <div class="register_item form-check form-check-inline">
                            <label class="form-check-label" for="gender2">{{ data.trans.female }}</label>
                            <input class="form-check-input" type="radio"
                                   name="gender" id="gender2"
                                   value="female">
                        </div>
                    </div>


                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="password" name="password" :placeholder="data.trans.password">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="password" name="password_confirmation"
                                   :placeholder="data.trans.password_confirm">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="submit" class="submit" :value="data.trans.register">
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>

    <div v-show="legal_container">
        <form method="post" :action="link" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="type" :value="selected">

            <div>
                <div class="row m-0">
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input class="left-to-right"

                                   type="text" name="email" :value="old.email"
                                   :placeholder="data.trans.email">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="text" name="name" :value="old.name"
                                   :placeholder="data.trans.company_name">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="text" name="agent_first_name" :value="old.agent_first_name"
                                   :placeholder="data.trans.agent_first_name">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="text" name="agent_last_name" :value="old.agent_last_name"
                                   :placeholder="data.trans.agent_last_name">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item register_item--card">
                            <input type="file" name="card"
                                   :placeholder="data.trans.visit_card">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="register_item register_item--card">
                            <input type="text" name="phone" :value="old.phone"
                                   :placeholder="data.trans.permanent_phone">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="register_item register_user--card">
                            <span>{{ data.trans.legal_person_needed_card }}</span>

                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="password" name="password" :placeholder="data.trans.password">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="password" name="password_confirmation"
                                   :placeholder="data.trans.password_confirm">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <div class="register_item">
                            <input type="submit" class="submit" :value="data.trans.register">
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
import {isEmpty} from "lodash/lang";

export default {
    created() {
        this.select_type();
    },
    props: ['old', 'data', 'link', 'csrf'],
    name: 'userRegister',
    methods: {
        select_type() {
            console.log(this.selected);
            if (this.selected == 1) {
                this.real_container = 1;
                this.legal_container = 0;
            } else if (this.selected == 2) {
                this.real_container = 0;
                this.legal_container = 1;
            } else {
                this.real_container = 0;
                this.legal_container = 0;
            }
        },
        search() {
            axios.get(this.username_link + '?national_id=' + this.national_id)
                .then(response => {
                }).catch(error => {
            });
        }
    },
    data() {
        return {
            selected: this.old.type ?? 0,
            real_container: 0,
            legal_container: 0
        }
    },
}
</script>

