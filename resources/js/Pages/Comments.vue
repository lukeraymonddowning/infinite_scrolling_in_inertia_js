<script setup>
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import Shell from "@/Components/Shell.vue";
import List from "@/Components/List.vue";
import ListItem from "@/Components/ListItem.vue";
import Comment from "@/Components/Comment.vue";
import Pagination from "@/Components/Pagination.vue";
import {ref, watch} from "vue";

const props = defineProps({
    comments: {
        type: Object,
        required: true,
    }
});

const items = ref(props.comments.data);

const initialUrl = usePage().url;

const loadMoreItems = () => {
    if (! props.comments.next_page_url) {
        return;
    }

    router.get(props.comments.next_page_url, {}, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            window.history.replaceState({}, '', initialUrl);
            items.value = [...items.value, ...props.comments.data];
        },
    });
};
</script>

<template>
    <Head title="Comments" />

    <Shell>
        <template #header>
            <h1 class="text-3xl font-bold tracking-tight text-white">Comments</h1>
        </template>

        <List>
            <Comment v-for="comment in items" :user="comment.user.name" :posted-at="comment.created_at">
                {{ comment.body }}
            </Comment>
        </List>

        <Link @click="loadMoreItems">Load more</Link>

<!--        <Pagination :previous="props.comments.prev_page_url"-->
<!--                    :next="props.comments.next_page_url"-->
<!--                    :from="props.comments.from"-->
<!--                    :to="props.comments.to"-->
<!--                    :total="props.comments.total"/>-->
    </Shell>
</template>

<style>
</style>
