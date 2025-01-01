<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    arabicYears: Array,
    bengaliYears: Array,
    arabicStudentData: {
        type: Array,
        default: () => []
    },
    bengaliStudentData: {
        type: Array,
        default: () => []
    }
});

const arabicForm = ref({ year: '', Roll: '', reg_id: '' });
const bengaliForm = ref({ year: '', Roll: '', reg_id: '' });
const arabicLoading = ref(false);
const bengaliLoading = ref(false);
const activeTab = ref('single');

const handleSearch = (type) => {
    const form = type === 'arabic' ? arabicForm : bengaliForm;
    const loading = type === 'arabic' ? arabicLoading : bengaliLoading;

    if (!form.value.year || !form.value.Roll || !form.value.reg_id) {
        const missingField = !form.value.year ? 'বছর' :
                          !form.value.Roll ? 'রোল নম্বর' :
                          'রেজিস্ট্রেশন আইডি';
        alert(`অনুগ্রহ করে ${missingField} প্রদান করুন।`);
        return;
    }

    if (loading.value) return;
    loading.value = true;

    router.get(route(`marhala.${type === 'arabic' ? 'search' : 'searchBn'}`), form.value, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => loading.value = false,
        onError: () => {
            alert('অনুসন্ধান ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
            loading.value = false;
        }
    });
};
</script>

<template>
    <Head>
        <meta type="hidden" name="csrf-token" :content="$page.props.csrf_token">
    </Head>

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto p-6 space-y-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <nav class="flex divide-x divide-gray-200">
                    <button
                        v-for="tab in [
                            { id: 'single', label: 'আরবি সনদ' },
                            { id: 'marhala', label: 'বাংলা সনদ' }
                        ]"
                        :key="tab.id"
                        @click="activeTab = tab.id"
                        class="flex-1 px-6 py-4 text-lg font-medium transition-all duration-200"
                        :class="[
                            activeTab === tab.id
                                ? 'bg-indigo-50 text-indigo-600 border-b-2 border-indigo-500'
                                : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'
                        ]"
                    >
                        {{ tab.label }}
                    </button>
                </nav>
            </div>

            <div v-show="activeTab === 'single'" class="space-y-6">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-8">আরবি সনদপত্র অনুসন্ধান</h2>
                    <form @submit.prevent="handleSearch('arabic')" class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">বছর নির্বাচন করুন</label>
                            <select v-model="arabicForm.year"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">বছর নির্বাচন করুন</option>
                                <option v-for="year in arabicYears" :key="year.years" :value="year.years">
                                    {{ year.years }}
                                </option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">রোল নম্বর</label>
                            <input v-model="arabicForm.Roll" type="text"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="রোল নম্বর লিখুন">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">রেজিস্ট্রেশন আইডি</label>
                            <input v-model="arabicForm.reg_id" type="text"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="রেজিস্ট্রেশন আইডি লিখুন">
                        </div>

                        <div class="flex items-end">
                            <button type="submit" :disabled="arabicLoading"
                                class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700
                                       transition-all duration-200 disabled:opacity-50 font-semibold shadow-md
                                       hover:shadow-lg flex items-center justify-center space-x-2">
                                <svg v-if="arabicLoading" class="animate-spin h-5 w-5"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                                </svg>
                                <span>{{ arabicLoading ? 'অনুসন্ধান করা হচ্ছে...' : 'অনুসন্ধান করুন' }}</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Results section for Arabic -->
                <!-- [Previous results table code remains the same] -->
            </div>

            <div v-show="activeTab === 'marhala'" class="space-y-6">
                <!-- Bengali form section - Similar structure to Arabic section -->
                <!-- [Similar form structure with bengaliForm values] -->
            </div>
        </div>
    </AuthenticatedLayout>
</template>
