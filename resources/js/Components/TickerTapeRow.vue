<template>
    <div class="flex items-center group justify-between bg-gray-100 rounded-md p-2">
        <p>{{ item.expression }}</p>
        <p class="font-medium group-hover:hidden">{{ item.result }}</p>
        <button @click="deleteHistory(item.id)" type="button" class="rounded-full bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-500 hidden group-hover:block">
            <TrashIcon />
            <span class="sr-only">Delete {{ item.expression }}</span>
        </button>
    </div>
</template>
<script setup lang="ts">
import TrashIcon from "@/Components/Icon/TrashIcon.vue";
import { router } from "@inertiajs/vue3";
import { PropType } from "vue";

defineProps({
    item: {
        type: Object as PropType<App.Data.TickerTapeData>,
        required: true,
    },
});

function deleteHistory(id: number) {
    router.delete(`/tickertape/${id}`);
}
</script>
