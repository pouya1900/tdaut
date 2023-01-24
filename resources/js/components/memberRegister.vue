<template>
    <div class="member_type_select">
        <div class="row justify-content-center">
            <div class="col-6">
                <select v-show="!selected" v-model="selected" @change="select_type()" class="form-select">
                    <option disabled value="0">انتخاب کنید</option>
                    <option value="1">{{ data.trans.professor }}</option>
                    <option value="2">{{ data.trans.student }}</option>
                    <option value="3">{{ data.trans.staff }}</option>
                </select>
                <div v-show="selected">
                    <span>{{
                            selected == 1 ? data.trans.professor : (selected == 2 ? data.trans.student : data.trans.staff)
                        }}</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center" v-show="national_stage">
        <div class="col-12 col-lg-6">
            <div class="register_item">
                <input class="left-to-right" type="text" name="national_id" v-model="national_id"
                       :placeholder="data.trans.national_id">
                <p class="alert_js" v-show="username_alert">
                    {{ data.trans.username_not_found }}
                </p>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="register_item">
                <button type="button" @click="search()" class="submit">{{ data.trans.search }}</button>
            </div>

        </div>
    </div>

    <form method="post" :action="link">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="type" :value="selected">
        <div id="professor_register" v-show="old.type || show_container">
            <div class="row m-0">


                <div class="col-12 col-lg-6">
                    <div class="register_item">
                        <input class="left-to-right" type="text" name="email" v-model="email"
                               :placeholder="data.trans.email" :readonly="selected == 1">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="register_item">
                        <input class="left-to-right" type="text" name="username" v-model="username"
                               :placeholder="data.trans.username" :readonly="selected == 1">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="register_item">
                        <input type="text" name="first_name" v-model="first_name"
                               :placeholder="data.trans.first_name">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="register_item">
                        <input type="text" name="last_name" v-model="last_name"
                               :placeholder="data.trans.last_name">
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="register_item form-check form-check-inline">
                        <label class="form-check-label" for="gender1">{{ data.trans.male }}</label>
                        <input class="form-check-input" v-model="gender"
                               type="radio"
                               name="gender" id="gender1"
                               value="male">
                    </div>
                    <div class="register_item form-check form-check-inline">
                        <label class="form-check-label" for="gender2">{{ data.trans.female }}</label>
                        <input class="form-check-input" type="radio" v-model="gender"
                               name="gender" id="gender2"
                               value="female">
                    </div>
                </div>
                <div v-show="rank_container" class="col-12 col-lg-6">
                    <div class="register_item">
                        <select class="form-select" name="rank" v-model="rank">
                            <option value="0">{{ data.trans.rank }}...</option>
                            <option v-for="input in data.ranks"
                                    :value="input.id">{{ input.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div v-show="department_container" class="col-12 col-lg-6">
                    <div class="register_item">
                        <select class="form-select" name="department" v-model="department">
                            <option value="0">{{ data.trans.department }}...</option>
                            <option v-for="input in data.departments"
                                    :value="input.id">{{ input.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div v-show="degree_container" class="col-12 col-lg-6">
                    <div class="register_item">
                        <select class="form-select" name="degree" v-model="degree">
                            <option value="0">{{ data.trans.degree }}...</option>
                            <option v-for="input in data.degrees"
                                    :value="input.id">{{ input.title }}
                            </option>
                        </select>
                    </div>
                </div>
                <div v-show="student_number_container" class="col-12 col-lg-6">
                    <div class="register_item">
                        <input type="text" name="student_number" v-model="student_number"
                               :placeholder="data.trans.student_number">
                    </div>
                </div>
                <div v-show="group_container" class="col-12 col-lg-6">
                    <div class="register_item">
                        <input type="text" name="group" v-model="group"
                               :placeholder="data.trans.group">
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

</template>

<script>
import {isEmpty} from "lodash/lang";

export default {
    created() {
        this.select_type();
    },
    props: ['old', 'data', 'username_link', 'link', 'csrf'],
    name: 'memberRegister',
    methods: {
        select_type() {
            if (this.selected == 1) {
                if (isEmpty(this.old) && !this.old.length) {
                    this.national_stage = 1;
                } else {
                    this.national_stage = 0;
                }
                this.show_container = 0;
                this.rank_container = 1;
                this.group_container = 1;
                this.department_container = 1;
                this.email_alert = 0;
                this.degree_container = 0;
                this.student_number_container = 0;
            } else if (this.selected == 2) {
                this.show_container = 1;
                this.degree_container = 1;
                this.student_number_container = 1;
                this.department_container = 1;
                this.rank_container = 0;
                this.group_container = 0;
                this.email_alert = 0;
            } else if (this.selected == 3) {
                this.show_container = 1;
                this.degree_container = 1;
                this.student_number_container = 0;
                this.department_container = 0;
                this.rank_container = 0;
                this.group_container = 0;
                this.email_alert = 0;
            }
        },
        search() {
            axios.get(this.username_link + '?national_id=' + this.national_id)
                .then(response => {
                    if (response.data) {
                        this.show_container = 1;
                        this.national_stage = 0;
                        this.email = response.data.member.email;
                        this.first_name = response.data.profile.first_name;
                        this.last_name = response.data.profile.last_name;
                        this.gender = response.data.profile.gender;
                        this.rank = response.data.member.rank_id;
                        this.department = response.data.member.department_id;
                        this.group = response.data.member.group;
                        this.username = response.data.profile.username;
                        this.username_alert = 0;
                    } else {
                        this.username_alert = 1;
                    }
                }).catch(error => {
            });
        }
    },
    data() {
        return {
            selected: this.old.type ?? 0,
            rank: this.old.rank ? this.old.rank : 0,
            department: this.old.department ? this.old.department : 0,
            degree: this.old.degree ? this.old.degree : 0,
            show_container: 0,
            degree_container: 0,
            department_container: 0,
            student_number_container: 0,
            rank_container: 0,
            email_alert: 0,
            group_container: 0,
            national_stage: 0,
            national_id: this.old.national_id,
            email: this.old.email,
            first_name: this.old.first_name,
            last_name: this.old.last_name,
            gender: this.old.gender,
            student_number: this.old.student_number,
            group: this.old.group,
            username: this.old.username,
            username_alert: 0,
        }
    },
}
</script>

