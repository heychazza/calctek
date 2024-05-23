<template>
    <div class="flex flex-col items-center justify-center h-screen bg-gray-100 dark:bg-gray-900">
        <h1 class="text-3xl font-medium mb-3">CalcTek</h1>
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-md">
            <div class="grid gap-4">
                <form @submit.prevent="calculate" class="flex items-center gap-2">
                    <input
                        class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 flex-1"
                        placeholder="Enter expression"
                        v-model="calculatorForm.expression"
                        type="text"
                    />
                    <button type="submit"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-sky-300 text-sky-300-foreground hover:bg-sky-300/90 h-10 px-4 py-2">
                        Calculate
                    </button>
                </form>

                <div class="text-2xl font-bold">
                    Result: <span>{{ result }}</span>
                </div>
                <p v-show="calculatorForm.hasErrors && calculatorForm.errors.expression" class="text-red-600">
                    {{ calculatorForm.errors.expression }}</p>

                <div v-if="history.length > 0" class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <h3 class="text-lg font-medium mb-2">History</h3>
                    <div class="grid gap-2">
                        <div v-for="item in history" :key="item.id"
                             class="flex items-center justify-between bg-gray-100 dark:bg-gray-800 rounded-md p-2">
                            <div>{{ item.expression }}</div>
                            <div class="font-medium">{{ item.result }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {useForm} from "@inertiajs/vue3";
import {PropType} from "vue";

defineProps({
    result: {
        type: String,
        required: true
    },
    history: {
        type: Object as PropType<App.Data.TickerTapeData[]>,
        required: true
    }
})

const calculatorForm = useForm<{
    expression: string
}>({
    expression: ''
})

async function calculate() {
    calculatorForm.post('/calculate', {
        preserveState: "error",
        onSuccess: () => {
            calculatorForm.reset()
        }
    })
}
</script>
