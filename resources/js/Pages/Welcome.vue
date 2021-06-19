<template>
  <!-- <div
    class="relative flex items-top justify-center dark:bg-gray-900 sm:items-center sm:pt-0"
  > -->
    <div v-if="canLogin" class="px-6 sm:block">
        <img class="h-32 inline" src="/logos/logo_transparent.png" alt="logo">
      <inertia-link
        v-if="$page.props.user"
        href="/map"
        class="font-bold text-gray-700 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
      >
        ログイン後へ移動
      </inertia-link>

      <template v-else>
        <inertia-link
          v-if="canRegister"
          :href="route('register')"
          class="mt-12 float-right mx-4 font-bold text-gray-700 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
        >
          会員登録
        </inertia-link>

        <inertia-link
          :href="route('login')"
          class="mt-12 float-right font-bold text-gray-700 hover:text-indigo-400 hover:border-indigo-400 visited:text-indigo-400 visited:border-indigo-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"
        >
          ログイン
        </inertia-link>

      </template>
    </div>
  <!-- </div> -->

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gray-100">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <GMapMap
          class="w-full h-screen"
          :center="{ lat: 35.69142600802246, lng: 139.7662640231528 }"
          :zoom="11"
          ref="myMapRef"
          :disableDefaultUI="true"
          map-type-id="roadmap"
        >
        </GMapMap>
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
