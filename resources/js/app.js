require('./bootstrap');

// Import modules...
import { createApp, h, onMounted, onUnmounted, ref } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Icon from './Utils/Icon'; //お気に入り用
// import { result } from 'lodash';
import VueGoogleMaps from '@fawmi/vue-google-maps';

const el = document.getElementById('app');
// const loader = new Loader({
//     apiKey: JSON.parse(el.dataset.page).props.map_api_key, libraries: ['places']
// });
// const {coords} = useGeolocation();
// const currPos = computed(() =>({
//     lat: coords.value.latitude,
//     lng: coords.value.longitude
// }))

// export function useGeolocation(){
//     const coords = ref({latitude: 0, longitude: 0})
//     const isSupported = 'navigator' in window && 'geolocation' in navigator

//     let watcher = null
//     onMounted(() => {
//         if(isSupported)
//             watcher = navigator.geolocation.watchPosition(
//                 position => (coords.value = position.coords)
//             )
//     })
//     onUnmounted(() => {
//         if(watcher)
//         navigator.geolocation.clearWatch(watcher)
//     })

//     return { coords, isSupported }
// }

// const mapDiv = ref(null);
// let map = ref(null);
// let marker = ref(null);
// let result_lat = ref(null);
// let result_lng = ref(null);

// let interior = ref(null);
// let exterior = ref(null);
// let calle = ref(null);
// let colonia = ref(null);
// let municipio = ref(null);
// let estado = ref(null);
// let CP = ref(null);

// initMap
// loader.load().then(() => {
//     map.value = new google.maps.Map(mapDiv.value, {
//         center: currPos.value,
//         zoom: 11
//     })
//     marker = new google.maps.Marker({
//         map: map.value,
//         draggable: true,
//         animation: google.maps.Animation.DROP,
//         position: currPos.value
//     })
// })

// google.maps.event.addListener(marker, 'dragend', function(){
//     result_lat.value = marker.getPosition().lat()
//     result_lng.value = marker.getPosition().lng()
// })

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
    .use(VueGoogleMaps, {
        load: {
            key: JSON.parse(el.dataset.page).props.map_api_key, libraries: 'places',
        },
    })
    .component('icon', Icon)    // お気に入り用

    .mount(el);

InertiaProgress.init({ color: '#4B5563' });
