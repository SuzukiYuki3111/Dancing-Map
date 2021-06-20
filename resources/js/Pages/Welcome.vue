<template>
  <div v-if="canLogin" class="px-6 sm:block">
    <img class="h-32 inline" src="/logos/logo_transparent.png" alt="logo" />
    <inertia-link
      v-if="$page.props.user"
      href="/map"
      class="
        font-bold
        text-gray-700
        hover:text-indigo-400
        hover:border-indigo-400
        visited:text-indigo-400
        visited:border-indigo-400
        focus:outline-none
        focus:text-gray-700
        focus:border-gray-300
        transition
      "
    >
      ログイン後へ移動
    </inertia-link>

    <template v-else>
      <inertia-link
        v-if="canRegister"
        :href="route('register')"
        class="
          hidden
          sm:flex
          mt-12
          float-right
          mx-4
          font-bold
          text-gray-700
          hover:text-indigo-400
          hover:border-indigo-400
          visited:text-indigo-400
          visited:border-indigo-400
          focus:outline-none
          focus:text-gray-700
          focus:border-gray-300
          transition
        "
      >
        会員登録
      </inertia-link>

      <inertia-link
        :href="route('login')"
        class="
          hidden
          sm:flex
          mt-12
          float-right
          font-bold
          text-gray-700
          hover:text-indigo-400
          hover:border-indigo-400
          visited:text-indigo-400
          visited:border-indigo-400
          focus:outline-none
          focus:text-gray-700
          focus:border-gray-300
          transition
        "
      >
        ログイン
      </inertia-link>

      <!-- Hamburger -->
      <div class="sm:hidden float-right mt-10">
        <button
          @click="showingNavigationDropdown = !showingNavigationDropdown"
          class="
            inline-flex
            items-center
            justify-center
            p-2
            rounded-md
            text-gray-500
            hover:text-indigo-400
            hover:bg-indigo-100
            focus:outline-none
            focus:bg-gray-100
            focus:text-gray-500
            transition
          "
        >
          <svg
            class="h-6 w-6"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
          >
            <path
              :class="{
                hidden: showingNavigationDropdown,
                'inline-flex': !showingNavigationDropdown,
              }"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
            <path
              :class="{
                hidden: !showingNavigationDropdown,
                'inline-flex': showingNavigationDropdown,
              }"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <!-- Responsive Navigation Menu -->
      <div
        :class="{
          block: showingNavigationDropdown,
          hidden: !showingNavigationDropdown,
        }"
        class="sm:hidden"
      >
        <div class="pt-2 pb-3 space-y-1 leading-5 text-gray-700 text-left hover:bg-gray-100 hover:text-indigo-400 focus:outline-none focus:bg-gray-100 transition">
          <jet-responsive-nav-link
            :href="route('login')"
            :active="route().current('login')"
          >
            ログイン
          </jet-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1 leading-5 text-gray-700 text-left hover:bg-gray-100 hover:text-indigo-400 focus:outline-none focus:bg-gray-100 transition">
          <jet-responsive-nav-link
            :href="route('register')"
            :active="route().current('register')"
          >
            会員登録
          </jet-responsive-nav-link>
        </div>
      </div>
    </template>
  </div>

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
  <hr>
            <footer class="text-center font-semibold py-2">
                Copyright Yuki Suzuki 2021.
            </footer>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
  components: {
    JetResponsiveNavLink,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },

  data() {
    return {
      showingNavigationDropdown: false,
    };
  },
};
</script>
