<template>
    <li class="relative">
        <div class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
            <img :src="thumbnail" alt="Video thumbnail" class="pointer-events-none object-cover group-hover:opacity-75" />
        </div>
        <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ props.title }}</p>
        <p class="pointer-events-none line-clamp-3 text-sm text-gray-500">{{ props.description }}</p>
        <p class="mt-1 pointer-events-none block text-sm font-medium text-gray-500">{{ relativeDate }}</p>
    </li>
</template>
<script setup>
import ListItem from "@/Components/ListItem.vue";
import {identicon} from "minidenticons";
import {computed} from "vue";
import {formatDistance, parse, parseISO, toDate} from "date-fns";
import {useThumbnail} from "@/Composables/useThumbnail";

const props = defineProps({
    title: {
        type: String,
    },
    user: {
        type: String,
    },
    description: {
        type: String,
    },
    postedAt: {
        type: String,
    }
});

const thumbnail = useThumbnail().generateThumbnail();
const relativeDate = computed(() => props.postedAt ? `${formatDistance(parseISO(props.postedAt), new Date())} ago` : null);
</script>
