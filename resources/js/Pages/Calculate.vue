<template>
    <div class="flex flex-col items-center justify-center h-screen bg-gray-100">
        <h1 class="text-3xl font-medium mb-3">CalcTek</h1>
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
            <div class="grid gap-4">
                <form @submit.prevent="calculate" class="flex items-center gap-2">
                    <input
                        class="flex h-10 w-full rounded-md border border-input px-3 py-2 text-sm ring-offset-sky-600 placeholder:text-gray-400/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex-1"
                        placeholder="Enter expression"
                        v-model="calculatorForm.expression"
                        type="text"
                    />
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-sky-600 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-sky-300 text-sky-900 hover:bg-sky-300/90 h-10 px-4 py-2"
                    >
                        Calculate
                    </button>
                </form>

                <div class="text-2xl font-bold">
                    Result: <span>{{ result }}</span>
                </div>
                <p v-show="calculatorForm.hasErrors && calculatorForm.errors.expression" class="text-red-600">
                    {{ calculatorForm.errors.expression }}
                </p>

                <div v-if="history.length > 0" class="border-t border-gray-200 pt-4">
                    <h3 class="text-lg font-medium mb-2">History</h3>
                    <div class="grid gap-2">
                        <div v-for="item in history" :key="item.id" class="flex items-center group justify-between bg-gray-100 rounded-md p-2">
                            <p>{{ item.expression }}</p>
                            <p class="font-medium group-hover:hidden">{{ item.result }}</p>
                            <button @click="deleteHistory(item.id)" type="button" class="rounded-full bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-500 hidden group-hover:block">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4" aria-hidden="true">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                    />
                                </svg>
                                <span class="sr-only">Delete {{ item.expression }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { router, useForm } from "@inertiajs/vue3";
import { PropType } from "vue";

defineProps({
    result: {
        type: String,
        required: false,
    },
    history: {
        type: Object as PropType<App.Data.TickerTapeData[]>,
        required: true,
    },
});

const calculatorForm = useForm<{
    expression: string;
}>({
    expression: "",
});

async function calculate() {
    calculatorForm.post("/tickertape", {
        preserveState: "error",
        onSuccess: () => {
            calculatorForm.reset();
        },
    });
}

function deleteHistory(id: number) {
    router.delete(`/tickertape/${id}`);
}
</script>
