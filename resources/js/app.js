/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
const appVideoPreview = createApp({});
const appImagePreview = createApp({});
const appTdImagePreview = createApp({});
const appCapability = createApp({});
const appSearchMember = createApp({});
const memberRegisterApp = createApp({});
const usernameApp = createApp({});


import VueGoodTablePlugin from 'vue-good-table-next';
import 'vue-good-table-next/dist/vue-good-table-next.css'
import membersTable from './components/membersTable.vue';
import rolesTable from './components/rolesTable.vue';
import supportsTable from './components/supportsTable.vue';
import rfpsTable from './components/rfpsTable.vue';
import productsTable from './components/productsTable.vue';
import {UploadMedia, UpdateMedia} from 'vue-media-upload';
import videoPreview from './components/videoPreview.vue';
import imagePreview from './components/imagePreview.vue';
import userRfpsTable from "./components/userRfpsTable";
import officesTable from "./components/admin/officesTable";
import adminProductsTable from "./components/admin/productsTable";
import adminUsersTable from "./components/admin/usersTable";
import adminMembersTable from "./components/admin/membersTable";
import adminMemberOfficesTable from "./components/admin/memberOffices";
import adminOfficeMembersTable from "./components/admin/officeMembers";
import generalTable from "./components/admin/generalTable";
import reportsTable from "./components/admin/reportsTable";
import capability from "./components/capability";
import searchMember from "./components/searchMember";
import memberRegister from "./components/memberRegister";
import username from "./components/username";

app.use(VueGoodTablePlugin);
app.component('members-table', membersTable);
app.component('roles-table', rolesTable);
app.component('supports-table', supportsTable);
app.component('rfps-table', rfpsTable);
app.component('user-rfps-table', userRfpsTable);
app.component('products-table', productsTable);
app.component('admin-products-table', adminProductsTable);
app.component('admin-users-table', adminUsersTable);
app.component('admin-members-table', adminMembersTable);
app.component('admin-member-offices-table', adminMemberOfficesTable);
app.component('admin-office-members-table', adminOfficeMembersTable);
app.component('admin-reports-table', reportsTable);
app.component('general-table', generalTable);
app.component('offices-table', officesTable);
app.component('upload-media', UploadMedia);
app.component('update-media', UpdateMedia);
appVideoPreview.component('video-input-preview', videoPreview);
appImagePreview.component('image-input-preview', imagePreview);
appTdImagePreview.component('td-image-input-preview', imagePreview);
appCapability.component('capability', capability);
appSearchMember.component('search-member', searchMember);
memberRegisterApp.component('member-register', memberRegister);
usernameApp.component('username', username);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
appVideoPreview.mount('#app-video-preview');
appImagePreview.mount('#app-image-preview');
appCapability.mount('#capability');
appSearchMember.mount('#search-member');
appTdImagePreview.mount('#app-td-image-preview');
memberRegisterApp.mount('#app-member-register');
usernameApp.mount('#username-check');
