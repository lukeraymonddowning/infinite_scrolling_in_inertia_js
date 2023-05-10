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
            items.value = props.videos.data;
        },
    });
});

const items = ref(props.videos.data);

const initialUrl = usePage().url;

const loadMoreItems = () => {
    if (!props.videos.next_page_url) {
        return;
    }

    router.get(props.videos.next_page_url, {}, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            window.history.replaceState({}, '', initialUrl);
            items.value = [...items.value, ...props.videos.data];
        },
    });
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            loadMoreItems();
        }
    });
}, {
    rootMargin: '0px 0px 150px 0px'
});

const landmark = ref(null);

onMounted(() => {
    observer.observe(landmark.value);
});
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

        <div ref="landmark" class="h-2"></div>
    </Shell>
</template>

<style>
</style>
