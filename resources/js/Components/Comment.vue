<template>
    <ListItem>
        <div class="sm:flex">
            <div class="mb-4 flex-shrink-0 sm:mb-0 sm:mr-4 flex items-center">
                <img :src="avatar" alt="User avatar" class="h-16 w-16 text-gray-300">
            </div>
            <div>
                <h4 class="text-lg font-bold">{{ props.user }}</h4>
                <p class="mt-1"><slot></slot></p>
                <span v-if="relativeDate" class="text-sm text-gray-500">{{ relativeDate }}</span>
            </div>
        </div>
    </ListItem>
</template>
<script setup>
import ListItem from "@/Components/ListItem.vue";
import {identicon} from "minidenticons";
import {computed} from "vue";
import {formatDistance, parse, parseISO, toDate} from "date-fns";

const props = defineProps({
    user: {
        type: String,
    },
    postedAt: {
        type: String,
    }
});

const avatar = computed(() => 'data:image/svg+xml;utf8,' + encodeURIComponent(identicon(props.user)));
const relativeDate = computed(() => props.postedAt ? `${formatDistance(parseISO(props.postedAt), new Date())} ago` : null);
</script>
