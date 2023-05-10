<script setup>
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import Shell from "@/Components/Shell.vue";
import List from "@/Components/List.vue";
import ListItem from "@/Components/ListItem.vue";
import Comment from "@/Components/Comment.vue";
import Pagination from "@/Components/Pagination.vue";
import {onMounted, ref, watch} from "vue";
import Video from "@/Components/Video.vue";
import Grid from "@/Components/Grid.vue";
import {useInfiniteScroll} from "@/Composables/useInfiniteScroll";
import {useIntersect} from "@/Composables/useIntersect";

const props = defineProps({
    videos: {
        type: Object,
        required: true,
    },
    users: {
        type: Object,
        required: true,
    },
});

const userFilter = ref(null);

watch(userFilter, (user) => {
    router.reload({
        only: ['videos'],
        data: { user_id: user ?? undefined, page: undefined },
        onSuccess: () => {
            reset();
        },
    });
});

const landmark = ref(null);

const { items, reset, canLoadMoreItems } = useInfiniteScroll('videos', landmark);
</script>

<template>
    <Head title="Videos"/>

    <Shell>
        <template #header>
            <h1 class="text-3xl font-bold tracking-tight text-white">Videos</h1>
        </template>

        <div class="max-w-sm">
            <label for="user" class="block text-sm font-medium leading-6 text-gray-50">Filter by creator</label>
            <select v-model="userFilter"
                    id="user"
                    name="user"
                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option :value="null">All</option>
                <option v-for="user in props.users" :key="user.id" :value="user.id">{{ user.name }}</option>
            </select>
        </div>

        <Grid class="mt-6">
            <Video v-for="video in items"
                   :key="video.id"
                   :title="video.title"
                   :description="video.description"
                   :user="video.user.name"
                   :posted-at="video.created_at">
            </Video>
        </Grid>

        <span v-if="! canLoadMoreItems">End of the line buddy!</span>

        <div ref="landmark"></div>
    </Shell>
</template>

<style>
</style>
