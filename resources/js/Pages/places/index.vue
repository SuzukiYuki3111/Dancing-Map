<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        投稿一覧
        <inertia-link class="float-right" :href="route('places.create')">
          <jet-button class="bg-blue-600 hover:bg-blue-800"
            >投稿する<i class="far fa-edit ml-2"></i
          ></jet-button>
        </inertia-link>
      </h2>
    </template>
    <div class="mx-6 mx-auto max-w-lg md:max-w-2xl">
            <input id="search"
             type="text"
             v-model="term"
             @keyup="search"
             class="w-full mt-7 -mb-5 text-sm rounded"
             placeholder="練習場所を検索　（例）〇〇駅、スタジオ〇〇">
        </div>
    <div class="py-12">
      <div
        v-if="places.data.length > 0"
        class="max-w-4xl mx-auto sm:px-6 lg:px-8"
      >
        <div
          v-for="place in places.data"
          v-bind:key="place.id"
          class="
            md:flex
            shadow-lg
            mx-6 mx-auto
            max-w-lg
            md:max-w-2xl
            h-full
            justify-center
            rounded
            border border-gray-300
          "
        >
          <img
            class="h-auto w-full md:w-1/3 object-cover pb-5/6"
            :src="'/storage/' + place.file"
            alt="view"
          />
          <div
            class="w-full md:w-2/3 px-4 py-4 bg-white"
            style="word-break: break-all"
          >
            <div class="flex items-center">
              <h2 class="text-xl text-gray-800 font-bold mr-auto w-2/3">
                {{ place.name }}
              </h2>
              <p class="text-gray-800 tracking-tighter float-right">
                {{ moment(place.created_at).format("YYYY.MM/DD") }}
              </p>
            </div>
            <p class="flex text-gray-700 pt-4">
              <img
                class="h-8 w-8 rounded-full object-cover"
                :src="place.user.profile_photo_url"
                :alt="place.user.username"
              />
              <span class="p-1 font-medium">{{ place.user.username }}</span>
            </p>
            <br />
            <div class="whitespace-pre-wrap" v-text="place.description"></div>
            <div class="flex items-center justify-end mt-4 top-auto">
              <a
                class="mr-auto text-indigo-500 hover:text-blue-700"
                :href="place.map_url"
                target="_blank"
              >
                場所を確認<i class="fas fa-external-link-alt ml-2 pt-1"></i>
              </a>
              <div>
                <inertia-link
                  class="focus:outline-none"
                  preserve-scroll
                  method="POST"
                  as="button"
                  :href="`/places/${place.id}/favorite`"
                >
                  <icon
                    :name="place.favorited ? 'star' : 'star-outline'"
                  ></icon>
                </inertia-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="text-center">投稿はありません。</div>
    </div>
    <!-- <jet-pagination class="m-5" :links="places.links"></jet-pagination> -->
    <div>
      <ul class="flex pl-0 list-none rounded my-2 justify-center">
        <li
          :class="[
            'relative block py-2 px-3 leading-tight bg-white border border-gray-300 text-blue-700 rounded hover:bg-gray-200',
            link.url === null ? 'disabled' : '',
            link.active ? 'active' : '',
          ]"
          v-for="(link, index) in places.links"
          :key="index"
        >
          <inertia-link
            class="page-link"
            :href="link.url === null ? '#' : link.url"
            v-html="link.label"
          ></inertia-link>
        </li>
      </ul>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import JetButton from "@/Jetstream/Button";
// import JetPagination from "@/Jetstream/Pagination";
import moment from "moment";

export default {
  components: {
    AppLayout,
    Welcome,
    JetButton,
    // JetPagination
  },

  data() {
    return {
      moment: moment,
      places: this.places,
      term: '',
    };
  },

  props: {
    places: Object,
    user: Object,
  },

  methods: {
      // 検索機能
      search(){
          this.$inertia.replace(this.route('places.index', {term: this.term}));
      }
  },

  watch: {
    places(newPlaces) {
      this.places = newPlaces;
    },
  },
};
</script>
