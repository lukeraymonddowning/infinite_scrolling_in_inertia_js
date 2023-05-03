<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Shell from "@/Components/Shell.vue";
import List from "@/Components/List.vue";
import ListItem from "@/Components/ListItem.vue";
import Comment from "@/Components/Comment.vue";
import Pagination from "@/Components/Pagination.vue";
</script>

<template>
    <Head title="Comments" />

    <Shell>
        <template #header>
            <h1 class="text-3xl font-bold tracking-tight text-white">Comments</h1>
        </template>

        <List>
            <Comment user="Jeffrey Way" posted-at="2023-05-01T15:03:00">
                Hey, welcome to Laracasts!
            </Comment>
            <Comment user="Luke Downing">
                Thanks Jeffrey, great to be here!
            </Comment>
            <Comment user="Adrian">
                Yo! I'm the designer around these parts 😎
            </Comment>
            <Comment user="Mohamed Said">
                Queues? Where we're going, we don't need queues.
            </Comment>
        </List>

        <Pagination previous="/" next="/" from="1" to="4" total="4" />
    </Shell>
</template>

<style>
</style>
