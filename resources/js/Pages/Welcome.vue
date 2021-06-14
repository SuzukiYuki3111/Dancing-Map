<template>
  <div
    class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
  >
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      <inertia-link
        v-if="$page.props.user"
        href="/map"
        class="font-bold text-gray-700 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
      >
        ログイン後へ移動
      </inertia-link>

      <template v-else>
        <inertia-link
          :href="route('login')"
          class="font-bold text-gray-700 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
        >
          ログイン
        </inertia-link>

        <inertia-link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 font-bold text-gray-700 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
        >
          会員登録
        </inertia-link>
      </template>
    </div>
  </div>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <GMapMap
          class="w-full h-screen"
          :center="{ lat: 35.69142600802246, lng: 139.7662640231528 }"
          :zoom="11"
          ref="myMapRef"
          :disableDefaultUI="true"
          map-type-id="roadmap"
        >
        <GMapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      @click="openInfoWindow(marker.id)"
      :clickable="true"
    />
        </GMapMap>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },

  data() {
    return {

    };
  },
};
</script>
