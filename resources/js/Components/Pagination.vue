<template>
    <nav class="mt-3 flex items-center justify-between rounded-md bg-white shadow px-4 py-3 sm:px-6"
         aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Showing
                {{ ' ' }}
                <span class="font-medium">{{ props.from }}</span>
                {{ ' ' }}
                to
                {{ ' ' }}
                <span class="font-medium">{{ props.to }}</span>
                {{ ' ' }}
                of
                {{ ' ' }}
                <span class="font-medium">{{ props.total }}</span>
                {{ ' ' }}
                results
            </p>
        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <Link :href="previous"
                  preserve-state
               class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Previous</Link>
            <Link :href="next"
                  preserve-state
               class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</Link>
        </div>
    </nav>
</template>

<script setup>
import {defineProps} from 'vue'
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    from: {
        type: Number,
        required: true
    },
    to: {
        type: Number,
        required: true
    },
    total: {
        type: Number,
        required: true
    },
    previous: {
        type: String,
    },
    next: {
        type: String,
    },
})
</script>
