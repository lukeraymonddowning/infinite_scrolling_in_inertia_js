<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Shell from "@/Components/Shell.vue";
import List from "@/Components/List.vue";
import ListItem from "@/Components/ListItem.vue";
import Comment from "@/Components/Comment.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    comments: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <Head title="Comments" />

    <Shell>
        <template #header>
            <h1 class="text-3xl font-bold tracking-tight text-white">Comments</h1>
        </template>

        <List>
            <Comment v-for="comment in props.comments.data" :user="comment.user.name" :posted-at="comment.created_at">
                {{ comment.body }}
            </Comment>
        </List>

        <Pagination :previous="props.comments.prev_page_url"
                    :next="props.comments.next_page_url"
                    :from="props.comments.from"
                    :to="props.comments.to"
                    :total="props.comments.total"/>
    </Shell>
</template>

<style>
</style>
