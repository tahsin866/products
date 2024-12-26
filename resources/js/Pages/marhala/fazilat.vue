<script setup>
import { ref, watch, onMounted, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import tabs from './tabs.vue'
import Dashboard from '../Dashboard.vue'

const props = defineProps({
    students: Object,
    years: Array,
    filters: Object,
    studentCount: Number,
    yearCount: Number
});



const searchStudent = () => {
    router.get(
        route('marhala.fazilat'),
        {
            Roll: form.value.Roll,
            reg_id: form.value.reg_id,
            year: selectedYear.value,
            page: 1
        },
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (page) => {
                students.value = page.props.students;
            },
        }
    );
};



// Initialize with proper structure including pagination
const students = ref({
    data: [],
    links: [],
    ...props.students

})

const years = ref(props.years || [])

// State for filters

const selectedYear = ref(props.filters?.year || '')

const handleYearChange = () => {
    console.log('Selected Year:', selectedYear.value)
}

// Watch for changes in selectedYear
watch(selectedYear, (newYear) => {
    if (newYear) {
        console.log('Year changed to:', newYear)
    }
})

const filterByYear = () => {
    router.get(
        route('marhala.fazilat'),
        {
            year: selectedYear.value,
            page: 1  // Reset to first page on year change
        },
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (page) => {
                students.value = page.props.students; // Update students data reactively
            },
        }
    );
};


// searchFiled

const form = ref({
    Roll: "",
    reg_id: "",
});



// Initialize data on mount
onMounted(() => {
    if (props.students) {
        students.value = props.students
    }
    console.log('Props on mount:', {
        students: students.value,
        years: years.value
    })
})
</script>



<template>



    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <tabs>


        </tabs>
        <!-- card -->
        <div style=" font-family: 'Merriweather','SolaimanLipi',sans-serif;"
            class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="bg-white shadow-xl rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="bg-purple-100 p-4 rounded-xl shadow-inner">
                        <svg class="w-10 h-10 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c1.657 0 3 1.343 3 3 0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3zm0 8c4.418 0 8 1.791 8 4v2H4v-2c0-2.209 3.582-4 8-4z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <div class="flex items-center">
                            <h4 class="text-3xl font-bold text-gray-800">{{ props.studentCount }}</h4>
                        </div>
                        <p class="text-gray-600 font-medium mt-1">মোট ছাত্র</p>
                        <p class="text-green-500 text-sm font-medium mt-1">↑ গত সপ্তাহের তুলনায়</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-xl rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="bg-yellow-100 p-4 rounded-xl shadow-inner">
                        <svg class="w-10 h-10 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c1.657 0 3 1.343 3 3 0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3zm0 8c4.418 0 8 1.791 8 4v2H4v-2c0-2.209 3.582-4 8-4z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1">
                            <h4 class="text-3xl font-bold text-gray-800">8</h4>
                            <span class="text-red-500 text-sm font-semibold">-8.7%</span>
                        </div>
                        <p class="text-gray-600 font-medium mt-1">ছাত্র সংখ্যা</p>
                        <p class="text-red-500 text-sm font-medium mt-1">↓ গত সপ্তাহের তুলনায়</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-xl rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="bg-red-100 p-4 rounded-xl shadow-inner">
                        <svg class="w-10 h-10 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 9.172a4 4 0 005.656 5.656M14.828 9.172a4 4 0 00-5.656 5.656M12 4v1m0 14v1m8-8h1M4 12H3m17.364 6.364l.707-.707M6.343 6.343l-.707-.707m12.728 12.728l.707.707M6.343 17.657l-.707.707" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1">
                            <h4 class="text-3xl font-bold text-gray-800">27</h4>
                            <span class="text-green-500 text-sm font-semibold">+4.3%</span>
                        </div>
                        <p class="text-gray-600 font-medium mt-1">ছাত্রী সংখ্যা</p>
                        <p class="text-green-500 text-sm font-medium mt-1">↑ গত সপ্তাহের তুলনায়</p>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white shadow-xl rounded-xl p-6 transition-all duration-300 hover:shadow-2xl hover:scale-105">
                <div class="flex items-center space-x-6">
                    <div class="bg-blue-100 p-4 rounded-xl shadow-inner">
                        <svg class="w-10 h-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v5h6v-5m-3-4v5m3-9h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4 0H9a2 2 0 01-2-2v-6a2 2 0 012-2h2m0 0V5a2 2 0 014 0v4" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center space-x-1">
                            <h4 class="text-3xl font-bold text-gray-800">{{ yearCount }}</h4>

                        </div>
                        <p class="text-gray-600 font-medium mt-1">{{ selectedYear }} সালের মোট ছাত্র</p>
                        <p class="text-red-500 text-sm font-medium mt-1">↓ গত সপ্তাহের তুলনায়</p>
                    </div>
                </div>
            </div>
        </div>











        <!-- end card -->

        <div class="p-6 bg-gray-100 min-h-screen">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="my-5">
                    <button class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg mr-2 btn-sm">
                        Export
                    </button>
                </div>
                <div class="flex justify-between items-center mb-4">
                    <div class="grid grid-cols-4 gap-4 w-full">
                        <select v-if="years.length > 0" @change="filterByYear" v-model="selectedYear"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none">
                            <option value="">Select Year</option>
                            <option v-for="year in years" :key="year" :value="year">
                                {{ year }}
                            </option>
                        </select>

                        <input type="text" id="red_id" v-model="form.Roll" placeholder="ইলহাক লিখুন"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none" />
                        <input type="text" id="red_id" v-model="form.red_id" placeholder="ইলহাক লিখুন"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none" />
                        <button @click="searchStudent"
                            class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg mr-2 btn-sm">
                            Search
                        </button>
                    </div>
                </div>

                <table style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                    class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-200 px-4 py-2 text-left">ক্রমিক নং</th>
                            <th class="border border-gray-200 px-4 py-2 text-left">
                                <input type="checkbox" />
                            </th>
                            <th class="border border-gray-200 px-4 py-2 text-left">নাম</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">পিতার নাম</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">মাদরাসার নাম</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">ক্লাস</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">বছর</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">জন্মতারিখ</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">রোল</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">রেজিস্ট্রেশন</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">একশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Adjust the serial number based on the current page -->
                        <tr v-for="(student, index) in students.data" :key="student.id" class="hover:bg-gray-50">
                            <!-- Adjust serial number -->
                            <td class="border border-gray-200 px-4 py-2">{{ (students.current_page - 1) *
                                students.per_page + (index + 1) }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-md font-semibold text-center">
                                <input type="checkbox" />
                            </td>
                            <td class="border border-gray-200 px-4 py-2">{{ student.Name }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Father }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Madrasha }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Class }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.years }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.DateofBirth }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Roll }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.reg_id }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">
                                <button class="text-purple-500 hover:underline focus:outline-none">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <nav v-if="students?.links?.length > 1" aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-sm my-5">
                        <li v-for="(link, index) in students.links" :key="index">
                            <a v-if="link.url" :href="link.url"
                                :class="['flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white', link.active ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white']"
                                v-html="link.label"></a>
                            <span v-else
                                :class="['flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 text-gray-500 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400', index === 0 ? 'rounded-s-lg' : '', index === students.links.length - 1 ? 'rounded-e-lg' : '']"
                                v-html="link.label"></span>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
