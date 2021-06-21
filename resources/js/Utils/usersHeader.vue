<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
      <div class="bg-white overflow-hidden shadow-xl">
        <div class="py-12">
          <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center">
              <img
                class="h-12 w-12 rounded-full object-cover"
                :src="userInfo.profile_photo_url"
                :alt="userInfo.name"
              />
              <span class="p-1 text-xl font-bold">{{
                userInfo.username ?? userInfo.name
              }}</span>
            </div>
            <p class="mt-2" style="word-break:break-all">{{ userInfo.introduction }}</p>
          </div>
        </div>
        <div class="flex">
          <inertia-link
            :class="{'border-transparent border-indigo-400 text-center font-bold text-indigo-400': isRoute('placeList.index')}"
            :href="`/${userInfo.id}/placeList`"
            class="w-1/2 p-2 border-b-2 border-transparent text-center font-bold leading-5 text-gray-500 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
          >
            投稿リスト
          </inertia-link>
          <inertia-link
          :class="{'border-transparent border-indigo-400 text-center font-bold text-indigo-400': isRoute('favList.index')}"
            :href="`/${userInfo.id}/favList`"
            class="w-1/2 p-2 border-b-2 border-transparent text-center font-bold leading-5 text-gray-500 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
          >
            お気に入り
          </inertia-link>
      </div>
      </div>
    </div>
</template>

<script>
// import AppLayout from "@/Layouts/AppLayout";

export default {

    props: {
        userInfo: Object,
    },

    components: {
        // AppLayout,
    }
}
</script>
