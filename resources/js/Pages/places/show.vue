<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        確認画面
      </h2>
    </template>
    <br />
    <div class="text-center">
      修正・削除する場合は以下のボタンを押してください。
    </div>

    <div
      class="item-center md:flex shadow-lg mt-10 mx-auto max-w-lg md:max-w-2xl h-full"
    >
      <img
        :src="'/storage/' + place.file"
        alt="view"
        class="h-hull w-full md:w-1/3 object-cover pb-5/6"
      />
      <div class="w-full md:w-2/3 px-4 py-4 bg-white">
        <h2
          class="mt-3 tracking-widest text-xs title-font font-medium text-gray-500"
        >
          練習場所
        </h2>
        <h1 class="mt-1 title-font text-lg font-medium text-gray-900">
          {{ place.name }}
        </h1>
        <h2
          class="mt-3 tracking-widest text-xs title-font font-medium text-gray-500 mb-1"
        >
          投稿者
        </h2>
        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
          {{ user.name }}
        </h1>
        <h2
          class="tracking-widest text-xs title-font font-medium text-gray-500"
        >
          詳細
        </h2>
        <div class="text-sm text-gray-900 mt-1">
        {{ place.description }}
        </div>
        <a
          class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0 hover:underline"
          :href="place.map_url"
          target="_blank"
        >
          場所を確認<i class="fas fa-external-link-alt ml-2"></i>
        </a>
        <div
          v-if="place.user_id == user.id"
          class="flex items-center justify-end mt-4 top-auto"
        >
          <button
            class="bg-white text-red-500 py-2 mr-auto rounded hover:underline"
            v-on:click="deletePlace(place.id)"
          >
            削除する
          </button>
          <inertia-link
            class="bg-gray-200 text-blue-600 px-2 py-2 rounded-md mr-2"
            :href="route('places.edit', place.id)"
            as="button"
            type="button"
            >修正する</inertia-link
          >
          <inertia-link
            class="bg-blue-600 text-gray-200 px-2 py-2 rounded-md"
            :href="route('places.index')"
            as="button"
            type="button"
            >一覧へ</inertia-link
          >
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import JetButton from "@/Jetstream/Button";

// {{ JSON.stringify(place) }}

export default {
  components: {
    AppLayout,
    Welcome,
    JetButton,
  },

  props: {
    place: Object,
    user: Object,
  },

  data() {
    return {
      form: this.$inertia.form({
        _method: "DELETE",
      }),
    };
  },

  methods: {
    deletePlace(id) {
      this.form.post(route("places.destroy", id), {
        _token: this.$page.props.csrf_token,
        forceFormData: true,
      });
    },
  },
};
</script>
