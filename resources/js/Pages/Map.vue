<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        地図
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <GMapMap
            class="w-full h-screen"
            :center="{lat: 35.69142600802246, lng: 139.7662640231528}"
            :zoom="11"
            ref="myMapRef"
            :disableDefaultUI="true"
            map-type-id="roadmap"
          >
          </GMapMap>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
};
</script>
