<template>
    <div class="member_type_select">
        <div class="row justify-content-center">
            <div class="col-6">
                <select v-model="selected" @change="select_type()" name="type" class="form-select">
                    <option disabled value="0">انتخاب کنید</option>
                    <option value="1">{{ data.trans.professor }}</option>
                    <option value="2">{{ data.trans.student }}</option>
                    <option value="3">{{ data.trans.staff }}</option>
                </select>
            </div>
        </div>

    </div>


    <div id="professor_register" v-show="old.type || show_container">
        <div class="row m-0">
            <div class="col-12 col-lg-6">
                <div class="register_item">
                    <input class="left-to-right" type="text" name="email" v-model="old.email"
                           :placeholder="data.trans.email">
                    <p id="email_alert" class="alert_js" style="display: none">
                        {{ data.trans.email_must_be_university }}
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="register_item">
                    <div id="username-check">
                        <username :alert="data.trans.username_already_use"
                                  :label="data.trans.username"
                                  :old_username="old.username"
                                  :link="username_link"></username>
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="register_item">
                    <input type="text" name="first_name" v-model="old.first_name"
                           :placeholder="data.trans.first_name">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="register_item">
                    <input type="text" name="last_name" v-model="old.last_name"
                           :placeholder="data.trans.last_name">
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="register_item form-check form-check-inline">
                    <label class="form-check-label" for="gender1">{{ data.trans.male }}</label>
                    <input class="form-check-input" v-model="old.gender"
                           type="radio"
                           name="gender" id="gender1"
                           value="male">
                </div>
                <div class="register_item form-check form-check-inline">
                    <label class="form-check-label" for="gender2">{{ data.trans.female }}</label>
                    <input class="form-check-input" type="radio" v-model="old.gender"
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
                    <input type="text" name="student_number" v-model="old.student_number"
                           :placeholder="data.trans.student_number">
                </div>
            </div>
            <div v-show="group_container" class="col-12 col-lg-6">
                <div class="register_item">
                    <input type="text" name="group" v-model="old.group"
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


</template>

<script>
export default {
    created() {
        this.select_type();
    },
    props: ['old', 'data', 'username_link'],
    name: 'memberRegister',
    methods: {
        select_type() {
            if (this.selected == 1) {
                this.show_container = 1;
                this.rank_container = 1;
                this.group_container = 1;
                this.department_container = 1;
                this.email_alert = 1;
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
        }
    },
    data() {
        return {
            selected: this.old.type ?? 0,
            rank: this.old.rank ? this.old.rank : 0,
            department: this.old.department ? this.old.department : 0,
            degree: this.old.degree ? this.old.degree : 0,
            student_number: 0,
            show_container: 0,
            degree_container: 0,
            department_container: 0,
            student_number_container: 0,
            rank_container: 0,
            email_alert: 0,
            group_container: 0,
        }
    },
}
</script>

