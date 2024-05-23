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

                <div class="grid grid-cols-4 gap-4">
                    <CalculatorBtn v-for="btn in calculatorBtns" :key="btn" @click="appendToCalculation(btn)">{{ btn }}</CalculatorBtn>
                </div>

                <div v-if="result" class="text-xl mt-6">
                    Result: <span class="font-semibold">{{ result }}</span>
                </div>
                <p v-show="calculatorForm.hasErrors && calculatorForm.errors.expression" class="text-red-600">
                    {{ calculatorForm.errors.expression }}
                </p>

                <div v-if="history.length > 0" class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between mb-2">
                        <h3 class="text-lg font-medium">History</h3>
                        <form @submit.prevent="router.delete('/tickertape/clear')">
                            <button type="submit" class="rounded-full flex items-center gap-x-1 bg-red-600 px-2.5 py-1 text-xs font-semibold text-white hover:bg-red-500">
                                <TrashIcon />
                                Delete All
                            </button>
                        </form>
                    </div>

                    <div class="grid gap-2">
                        <TickerTapeRow v-for="item in history" :key="item.id" :item="item" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { router, useForm } from "@inertiajs/vue3";
import { PropType } from "vue";
import TrashIcon from "@/Components/Icon/TrashIcon.vue";
import TickerTapeRow from "@/Components/TickerTapeRow.vue";
import CalculatorBtn from "@/Components/CalculatorBtn.vue";

defineProps({
    result: {
        type: Number,
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

const calculatorBtns = ["7", "8", "9", "/", "4", "5", "6", "*", "1", "2", "3", "-", ".", "0", "=", "+"];

function appendToCalculation(btn: string) {
    if(btn === "=") {
        calculate();
        return;
    }

    calculatorForm.expression += btn;
}

async function calculate() {
    calculatorForm.post("/tickertape", {
        preserveState: "error",
        onSuccess: () => {
            calculatorForm.reset();
        },
    });
}
</script>
