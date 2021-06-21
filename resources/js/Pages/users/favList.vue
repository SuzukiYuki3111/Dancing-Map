<template>
  <app-layout>
      <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ユーザー詳細
      </h2>
    </template>
          <users-header :userInfo="userInfo"></users-header>
           <div class="py-12">
      <div v-if="favList.data.length > 0" class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div
          v-for="place in favList.data"
          v-bind:key="place.id"
          class="md:flex shadow-lg mx-6 mx-auto max-w-lg md:max-w-2xl h-full justify-center rounded border border-gray-300"
        >
          <img
            class="h-auto w-full md:w-1/3 object-cover pb-5/6"
            :src="'/storage/' + place.file"
            alt="view"
          />
          <div class="w-full md:w-2/3 px-4 py-4 bg-white" style="word-break:break-all;">
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
                :src="userInfo.profile_photo_url"
                :alt="userInfo.username"
              />
              <span class="p-1 font-medium">{{ userInfo.username }}</span>
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
              <!-- <div>
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
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="text-center" v-else>お気に入りした投稿はありません。</div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UsersHeader from '@/Utils/usersHeader.vue';
import moment from "moment";

export default {
  props: {
    userInfo: Object,
    favList: Object,
  },

  data() {
        return {
            favList: this.favList,
            moment: moment,
            userInfo: this.userInfo,
        }
    },

  components: {
    AppLayout,
    UsersHeader,
  },
};
</script>
