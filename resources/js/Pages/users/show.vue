<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ユーザー詳細
      </h2>
    </template>
    <users-header :user="user"></users-header>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Welcome from "@/Jetstream/Welcome";
import JetButton from "@/Jetstream/Button";
import UsersHeader from "@/Utils/usersHeader";
// import moment from "moment";
// import placeList from "@/Utils/placeList";

export default {
  props: {
    places: Object,
    user: Object,
  },

  components: {
    AppLayout,
    Welcome,
    JetButton,
    UsersHeader,
  },

  // name: "pink-tabs",

  //   data() {
  //     return {
  //       moment: moment,
  //       openTab: 1,
  //       places: this.places,
  //     };
  //   },

  //   methods: {
  //     toggleTabs: function(tabNumber){
  //       this.openTab = tabNumber
  //     }
  //   },

  //   watch: {
  //     places(newPlaces) {
  //       this.places = newPlaces;
  //     },
  //   },
};
</script>
