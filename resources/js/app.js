require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Icon from './Utils/Icon'; //お気に入り用
import VueGoogleMaps from '@fawmi/vue-google-maps';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route,
    isRoute(...routes){
        return routes.some(route => this.route().current(route));   // 投稿取得用
    } }})
    .use(InertiaPlugin)
    .use(VueGoogleMaps, {   // google map api
        load: {
            key: JSON.parse(el.dataset.page).props.map_api_key
        },
    })
    .component('icon', Icon)    // お気に入り用

    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
