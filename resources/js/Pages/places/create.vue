<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        投稿画面
      </h2>
      <p class="bg-yellow-200 mt-2 p-2 font-normal rounded-lg">
        周りの人への挨拶やゴミの持ち帰りなど、マナーを守って気持ちよく練習場所を共有しましょう！<br />
        ※通行の妨げになりやすい場所で踊ったり、大きすぎる音量で音楽を流していたりすると迷惑になる場合があります。
        場所によっては、練習をしてはいけない時間帯などが定められていることもあります。トラブルを避けるために十分注意しましょう。
      </p>
    </template>
    <div class="flex items-center p-4 lg:justify-center">
      <div
        class="
          flex flex-col
          overflow-hidden
          bg-white
          rounded-md
          shadow-lg
          max
          flex-row flex-1
        "
      >
        <div
          class="
            p-4
            py-6
            text-white
            flex-shrink-0 flex flex-col
            items-center
            justify-evenly
            rounded
          "
        >
          <GMapMap
            class="w-full h-screen rounded-lg"
            :center="{ lat: 35.69142600802246, lng: 139.7662640231528 }"
            :zoom="11"
            :disableDefaultUI="true"
            map-type-id="roadmap"
            :options="{
              zoomControl: true,
              mapTypeControl: true,
              scaleControl: true,
              streetViewControl: false,
              rotateControl: true,
              fullscreenControl: true,
            }"
          >
          </GMapMap>
        </div>
        <div class="p-5 bg-white md:flex-1">
          <form @submit.prevent="submit" class="flex flex-col space-y-5">
            <!-- file -->
            <div class="flex flex-col space-y-1">
              <label for="file" class="text-sm font-semibold text-gray-500"
                >練習場所の風景</label
              >
              <input
                type="file"
                accept="image/jpeg, image/png"
                @input="form.file = $event.target.files[0]"
                required
              />
            </div>
            <progress
              v-if="form.progress"
              :value="form.progress.percentage"
              max="100"
            >
              {{ form.progress.percentage }}%
            </progress>
            <div v-if="form.errors.file">{{ form.errors.file }}</div>
            <!-- map_url -->
            <div class="flex flex-col space-y-1">
              <label for="map_url" class="text-sm font-semibold text-gray-500"
                >マップURL</label
              >
              <input
                type="text"
                class="
                  px-4
                  py-2
                  transition
                  duration-300
                  border border-gray-300
                  rounded
                  focus:border-transparent
                  focus:outline-none
                  focus:ring-4 focus:ring-blue-200
                "
                v-model="form.map_url"
                required
              />
            </div>
            <div v-if="form.errors.map_url">{{ form.errors.map_url }}</div>
            <!-- name -->
            <div class="flex flex-col space-y-1">
              <label for="name" class="text-sm font-semibold text-gray-500"
                >練習場所の名称</label
              >
              <input
                type="text"
                class="
                  px-4
                  py-2
                  transition
                  duration-300
                  border border-gray-300
                  rounded
                  focus:border-transparent
                  focus:outline-none
                  focus:ring-4 focus:ring-blue-200
                "
                placeholder="◯◯駅、スタジオ◯◯など"
                v-model="form.name"
                required
              />
            </div>
            <div v-if="form.errors.name">{{ form.errors.name }}</div>
            <!-- description -->
            <div class="flex flex-col space-y-1 whitespace-pre-wrap">
              <label
                for="description"
                class="text-sm font-semibold text-gray-500"
                >場所の詳細</label
              >
              <textarea
                type="text"
                class="
                  px-4
                  py-2
                  transition
                  duration-300
                  border border-gray-300
                  rounded
                  focus:border-transparent
                  focus:outline-none
                  focus:ring-4 focus:ring-blue-200
                "
                rows="7"
                wrap="hard"
                placeholder="駅から近くて便利、ゴミは必ず持ち帰るなど"
                v-model="form.description"
                required
              ></textarea>
            </div>
            <div v-if="form.errors.description">
              {{ form.errors.description }}
            </div>
            <!-- submit -->
            <button
              class="
                w-full
                px-4
                py-2
                text-lg
                font-semibold
                text-white
                transition-colors
                duration-300
                bg-blue-500
                rounded-md
                shadow
                hover:bg-blue-600
                focus:outline-none
                focus:ring-blue-200 focus:ring-4
              "
              type="submit"
            >
              確認画面へ
            </button>
          </form>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import JetButton from "@/Jetstream/Button";

export default {
  components: {
    AppLayout,
    Welcome,
    JetButton,
  },

  data() {
    return {
      form: this.$inertia.form({
        file: "",
        map_url: "",
        name: "",
        description: "",
      }),
    };
  },
  // file用フォームヘルパー
  methods: {
    submit() {
      this.form.post(route("places.store"), {
        _token: this.$page.props.csrf_token,
        forceFormData: true,
      });
    },
  },
};
</script>
