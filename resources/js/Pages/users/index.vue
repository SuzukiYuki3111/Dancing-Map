<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ユーザーリスト
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl border" v-for="user in users.data" v-bind:key="user.id">
                    <inertia-link class="" :href="route('users.show', user.id)">
                        <div class="px-6 py-6">
                            <div class="flex items-center ">
                                <img class="h-12 w-12 rounded-full object-cover" :src="user.profile_photo_url" :alt="$page.props.user.name" />
                                <span class="p-1 text-xl font-bold">{{ user.username ?? user.name }}</span>
                            </div>
                            <p class="mt-2" style="word-break:break-all;">{{ user.introduction }}</p>
                        </div>
                    </inertia-link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'


    export default {
        props: {
            users: Object,
        },

        components: {
            AppLayout,
            Welcome,
        },
    }
</script>
