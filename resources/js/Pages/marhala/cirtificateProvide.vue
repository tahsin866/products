<script setup>
import { ref } from 'vue';
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
        onSuccess: () => {
            arabicLoading.value = false;
        },
        onError: () => {
            alert('অনুসন্ধান ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
            arabicLoading.value = false;
        }
    });
};


// forBangla









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
        onSuccess: () => {
            bengaliLoading.value = false;
        },
        onError: () => {
            alert('অনুসন্ধান ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
            bengaliLoading.value = false;
        }
    });
};



// Add new ref for active tab
const activeTab = ref('single'); // 'single' for একক সনদ, 'marhala' for মারহালাওয়ারী সনদ


</script>

<template>
    <Head>
        <meta type="hidden" name="csrf-token" :content="$page.props.csrf_token">
    </Head>

    <AuthenticatedLayout>


        <div class="mx-auto p-6">
            <!-- Tab Navigation -->
            <div class="mb-8">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button
                            @click="activeTab = 'single'"
                            :class="[
                                activeTab === 'single'
                                    ? 'border-indigo-500 text-md font-semibold text-indigo-600'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 text-md font-semibold hover:text-gray-700',
                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-md transition-colors duration-200'
                            ]"
                        >
                            আরবি সনদ
                        </button>
                        <button
                            @click="activeTab = 'marhala'"
                            :class="[
                                activeTab === 'marhala'
                                    ? 'border-indigo-500 text-md font-semibold text-indigo-600'
                                    : 'border-transparent text-gray-500 hover:border-gray-300 text-md font-semibold hover:text-gray-700',
                                'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-md transition-colors duration-200'
                            ]"
                        >
                         বাংলা সনদ
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Tab Content -->
            <div v-if="activeTab === 'single'">
                <!-- Your existing search section -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">একক সনদপত্র অনুসন্ধান</h2>
                    <!-- Your existing form -->
                    <form @submit.prevent="validateAndSearchArabic" class="bg-white rounded-xl shadow-lg p-8">
                        <!-- ... your existing form content ... -->

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Year Select -->
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">
                                বছর নির্বাচন করুন
                            </label>
                            <select
                     v-model="arabicForm.year"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-gray-600"
                            >
                                <option value="">বছর নির্বাচন করুন</option>
                                <option v-for="year in arabicYears" :key="year.years" :value="year.years">
        {{ year.years }}
    </option>
                            </select>
                        </div>

                        <!-- Roll Input -->
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">
                                রোল নম্বর
                            </label>
                            <input
    v-model="arabicForm.Roll"
    type="text"
    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    placeholder="রোল নম্বর লিখুন"
>
                        </div>

                        <!-- Registration ID Input -->
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">
                                রেজিস্ট্রেশন আইডি
                            </label>
                            <input
    v-model="arabicForm.reg_id"
    type="text"
    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    placeholder="রোল নম্বর লিখুন"
>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-end">
                            <button
    type="submit"
    :disabled="arabicLoading"
    class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-all duration-200 disabled:opacity-50 font-semibold shadow-md hover:shadow-lg"
>
    <span v-if="arabicLoading" class="flex items-center justify-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        অনুসন্ধান করা হচ্ছে...
    </span>
    <span v-else>অনুসন্ধান করুন</span>
</button>

                        </div>
                    </div>

                    </form>
                </div>

                <!-- Your existing results table -->
                <div v-if="arabicStudentData && arabicStudentData.length > 0" class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- ... your existing table content ... -->

                    <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800">অনুসন্ধানের ফলাফল</h3>
                </div>
                <div class="overflow-x-auto">
                    <table


                    class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">নাম</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">পিতার নাম</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">রোল নম্বর</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">রেজিস্ট্রেশন নম্বর</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">জন্ম-তারিখ</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">ক্লাস</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">একশন</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="student in arabicStudentData" :key="student.id" class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Father }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Roll }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.reg_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.DateofBirth }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Class }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Link
    :href="route('marhala.fazilatDetailes', {
        Roll: student.Roll,
        reg_id: student.reg_id
    })"
    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 transition-all duration-200 font-medium"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-5 h-5"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.694 19.02a4.5 4.5 0 01-1.697 1.098l-4.032 1.342a.375.375 0 01-.478-.478l1.342-4.032a4.5 4.5 0 011.098-1.697L16.862 3.487z"
        />
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 7.5L16.5 4.5"
        />
    </svg>
</Link>


</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                </div>

                <!-- Your existing no results message -->
                <div v-else-if="arabicLoading === false && arabicStudentData.length === 0" class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
    <p class="text-yellow-700 text-lg font-medium">প্রদত্ত তথ্যের সাথে কোন সনদপত্র খুঁজে পাওয়া যায়নি।</p>
</div>
            </div>


            <!-- মারহালাওয়ারী সনদপত্র অনুসন্ধান -->

            <div v-else-if="activeTab === 'marhala'" class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">মারহালাওয়ারী সনদপত্র অনুসন্ধান</h2>
                <!-- Add your marhala-specific content here -->
                <div class="text-center text-gray-600">


                    <form @submit.prevent="validateAndSearchBengali" class="bg-white rounded-xl shadow-lg p-8">
                        <!-- ... your existing form content ... -->

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- Year Select -->
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">
                                বছর নির্বাচন করুন
                            </label>
                            <select
                        v-model="bengaliForm.year"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-gray-600"
                            >
                                <option value="">বছর নির্বাচন করুন</option>
                                <option v-for="year in bengaliYears" :key="year.years" :value="year.years">
        {{ year.years }}
    </option>
                            </select>
                        </div>

                        <!-- Roll Input -->
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">
                                রোল নম্বর
                            </label>
                            <input
    v-model="bengaliForm.Roll"
    type="text"
    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    placeholder="রোল নম্বর লিখুন"
>
                        </div>

                        <!-- Registration ID Input -->
                        <div class="space-y-2">
                            <label class="block text-md font-semibold text-gray-700">
                                রেজিস্ট্রেশন আইডি
                            </label>
                            <input
    v-model="bengaliForm.reg_id"
    type="text"
    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
    placeholder="রোল নম্বর লিখুন"
>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-end">
                            <button
                                type="submit"
                                :disabled="bengaliLoading"
                                class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-all duration-200 disabled:opacity-50 font-semibold shadow-md hover:shadow-lg"
                            >
                                <span v-if="bengaliLoading" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    অনুসন্ধান করা হচ্ছে...
                                </span>
                                <span v-else>অনুসন্ধান করুন</span>
                            </button>
                        </div>
                    </div>

                    </form>
                </div>

                <!-- Your existing results table -->
                <div v-if="bengaliStudentData && bengaliStudentData.length > 0" class="bg-white rounded-xl shadow-lg overflow-hidden mt-5">
                    <!-- ... your existing table content ... -->

                    <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800">অনুসন্ধানের ফলাফল</h3>
                </div>
                <div class="overflow-x-auto">
                    <table


                    class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">নাম</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">পিতার নাম</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">রোল নম্বর</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">রেজিস্ট্রেশন নম্বর</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">জন্ম-তারিখ</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">ক্লাস</th>
                                <th class="px-6 py-4 text-left text-md font-semibold text-gray-600">একশন</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="student in bengaliStudentData" :key="student.id" class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Father }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Roll }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.reg_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.DateofBirth }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-md font-semibold text-gray-700">{{ student.Class }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <Link
    :href="route('marhala.fazilatDetailes', {
        Roll: student.Roll,
        reg_id: student.reg_id
    })"
    class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 transition-all duration-200 font-medium"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-5 h-5"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.694 19.02a4.5 4.5 0 01-1.697 1.098l-4.032 1.342a.375.375 0 01-.478-.478l1.342-4.032a4.5 4.5 0 011.098-1.697L16.862 3.487z"
        />
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M19.5 7.5L16.5 4.5"
        />
    </svg>
</Link>


</td>

                            </tr>
                        </tbody>
                    </table>
                </div>

                </div>

                <!-- Your existing no results message -->
                <!-- <div v-else-if="form.wasSuccessful" class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">

                </div> -->
                </div>
            </div>

    </AuthenticatedLayout>
</template>
    <!-- v-if="activeTab === 'marhala' && bengaliStudentData.length > 0" -->
    <!-- v-if="activeTab === 'single' && arabicStudentData.length > 0" -->
