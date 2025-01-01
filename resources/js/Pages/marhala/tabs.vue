<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
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

const arabicForm = ref({
    year: '',
    Roll: '',
    reg_id: ''
});

const bengaliForm = ref({
    year: '',
    Roll: '',
    reg_id: ''
});

const arabicLoading = ref(false);
const bengaliLoading = ref(false);

const arabicResults = ref([]);
const bengaliResults = ref([]);

const validateAndSearchArabic = () => {
    if (!arabicForm.value.year || !arabicForm.value.Roll || !arabicForm.value.reg_id) {
        const missingField = !arabicForm.value.year ? 'বছর' :
            !arabicForm.value.Roll ? 'রোল নম্বর' :
            'রেজিস্ট্রেশন আইডি';
        alert(`অনুগ্রহ করে ${missingField} প্রদান করুন।`);
        return;
    }
    searchArabicStudents();
};

const searchArabicStudents = () => {
    if (arabicLoading.value) return;
    arabicLoading.value = true;

    router.get(route('marhala.search'), arabicForm.value, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (response) => {
            arabicResults.value = response.props.arabicStudentData;
            arabicLoading.value = false;
        },
        onError: () => {
            alert('অনুসন্ধান ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
            arabicLoading.value = false;
        }
    });
};

const validateAndSearchBengali = () => {
    if (!bengaliForm.value.year || !bengaliForm.value.Roll || !bengaliForm.value.reg_id) {
        const missingField = !bengaliForm.value.year ? 'বছর' :
            !bengaliForm.value.Roll ? 'রোল নম্বর' :
            'রেজিস্ট্রেশন আইডি';
        alert(`অনুগ্রহ করে ${missingField} প্রদান করুন।`);
        return;
    }
    searchBengaliStudents();
};

const searchBengaliStudents = () => {
    if (bengaliLoading.value) return;
    bengaliLoading.value = true;

    router.get(route('marhala.searchBn'), bengaliForm.value, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (response) => {
            bengaliResults.value = response.props.bengaliStudentData;
            bengaliLoading.value = false;
        },
        onError: () => {
            alert('অনুসন্ধান ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
            bengaliLoading.value = false;
        }
    });
};

const activeTab = ref('single');

watch(activeTab, (newTab) => {
    if (newTab === 'single') {
        bengaliForm.value = {
            year: '',
            Roll: '',
            reg_id: ''
        };
        bengaliResults.value = [];
    } else if (newTab === 'marhala') {
        arabicForm.value = {
            year: '',
            Roll: '',
            reg_id: ''
        };
        arabicResults.value = [];
    }
});
</script>

<template>
    <!-- Keep your existing template structure, but update the result displays -->

    <!-- For Arabic tab -->
    <div v-if="activeTab === 'single' && arabicResults.length > 0"
        class="bg-white rounded-xl shadow-lg overflow-hidden mt-5">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">অনুসন্ধানের ফলাফল</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Your existing Arabic table structure -->
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="student in arabicResults" :key="student.id"
                        class="hover:bg-gray-50 transition-colors duration-150">
                        <!-- Your existing table row content -->

                        <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Father }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Roll }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.reg_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.DateofBirth }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Class }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <Link :href="route('marhala.fazilatDetailes', {
                                            Roll: student.Roll,
                                            reg_id: student.reg_id
                                        })" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 transition-all duration-200 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.694 19.02a4.5 4.5 0 01-1.697 1.098l-4.032 1.342a.375.375 0 01-.478-.478l1.342-4.032a4.5 4.5 0 011.098-1.697L16.862 3.487z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 7.5L16.5 4.5" />
                                        </svg>
                                        </Link>


                                    </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- For Bengali tab -->
    <div v-if="activeTab === 'marhala' && bengaliResults.length > 0"
        class="bg-white rounded-xl shadow-lg overflow-hidden mt-5">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">অনুসন্ধানের ফলাফল</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <!-- Your existing Bengali table structure -->
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="student in bengaliResults" :key="student.id"
                        class="hover:bg-gray-50 transition-colors duration-150">
                        <!-- Your existing table row content -->
                        <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Father }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Roll }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.reg_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.DateofBirth }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{
                                        student.Class }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <Link :href="route('marhala.fazilatDetailes', {
                                            Roll: student.Roll,
                                            reg_id: student.reg_id
                                        })" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 transition-all duration-200 font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.694 19.02a4.5 4.5 0 01-1.697 1.098l-4.032 1.342a.375.375 0 01-.478-.478l1.342-4.032a4.5 4.5 0 011.098-1.697L16.862 3.487z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 7.5L16.5 4.5" />
                                        </svg>
                                        </Link>


                                    </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rest of your template remains the same -->
</template>
