<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        ユーザー詳細
      </h2>
    </template>
    <users-header :userInfo="userInfo"></users-header>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import UsersHeader from "@/Utils/usersHeader";

export default {
  props: {
    // places: Object,
    userInfo: Object,
  },

  components: {
    AppLayout,
    UsersHeader,
  },
};
</script>
