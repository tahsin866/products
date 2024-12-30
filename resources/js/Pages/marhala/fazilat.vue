<script setup>
import { ref, watch, onMounted, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/vue3';
// import { convertToBangla } from '@/utils/numberToBangla';


import Dashboard from '../Dashboard.vue'

const props = defineProps({
    students: Object,
    years: Array,
    filters: Object,
    studentCount: Number,
    yearCount: Number,
    maleCount: Number,
    femaleCount: Number,

})

const yearCount = ref(props.yearCount || 0);
const maleCount = ref(props.maleCount || 0);
const femaleCount = ref(props.femaleCount || 0);






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
            page: 1
        },
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: (page) => {
                students.value = page.props.students;
                yearCount.value = page.props.yearCount;
                maleCount.value = page.props.maleCount;
                femaleCount.value = page.props.femaleCount;
            },
        }
    );
};


// const selectedSRType = ref('')

// const filterBySRtype = () => {
//     router.get(
//         route('marhala.filterBySRType'),
//         {
//             SRType: selectedSRType.value,
//             page: 1
//         },
//         {
//             preserveState: true,
//             preserveScroll: true,
//             onSuccess: (page) => {
//                 students.value = page.props.students
//             }
//         }
//     )
// }


// searchFiled



const Roll = ref('')
const reg_id = ref('')

const searchStudent = () => {
    Inertia.get(route('marhala.search'), {
        Roll: Roll.value,
        reg_id: reg_id.value
    }, {
        preserveState: true,
        preserveScroll: true
    })
}







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

        <!-- card -->
        <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
         class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Students Card -->
        <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 border border-purple-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-purple-900">{{ props.studentCount }}</h4>
                        <span class="text-purple-600 text-sm font-semibold">মোট</span>
                    </div>
                    <p class="text-purple-900 font-medium">মোট ছাত্র-ছাত্রী</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-purple-100">
                <!-- <div class="flex items-center text-sm text-purple-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>১২% বৃদ্ধি গত মাস থেকে</span>
                </div> -->
            </div>
        </div>

        <!-- Male Students Card -->
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-blue-900">{{ props.maleCount }}</h4>
                        <span class="text-blue-600 text-sm font-semibold">জন</span>
                    </div>
                    <p class="text-blue-900 font-medium">ছাত্র সংখ্যা</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-blue-100">
                <!-- <div class="flex items-center text-sm text-blue-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>৮% বৃদ্ধি গত মাস থেকে</span>
                </div> -->
            </div>
        </div>

        <!-- Female Students Card -->
        <div class="bg-gradient-to-br from-pink-50 to-white rounded-2xl p-6 border border-pink-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-pink-900">{{ props.femaleCount }}</h4>
                        <span class="text-pink-600 text-sm font-semibold">জন</span>
                    </div>
                    <p class="text-pink-900 font-medium">ছাত্রী সংখ্যা</p>
                </div>
                <div class="bg-pink-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-pink-100">
                <!-- <div class="flex items-center text-sm text-pink-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>১৫% বৃদ্ধি গত মাস থেকে</span>
                </div> -->
            </div>
        </div>

        <!-- Year Total Card -->
        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-6 border border-emerald-100 hover:shadow-lg transition-all duration-300">
            <div class="flex justify-between items-start">
                <div class="space-y-4">
                    <div class="flex items-baseline space-x-2">
                        <h4 class="text-4xl font-bold text-emerald-900">{{ yearCount }}</h4>
                        <span class="text-emerald-600 text-sm font-semibold">জন</span>
                    </div>
                    <p class="text-emerald-900 font-medium">{{ selectedYear }} সালের মোট</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-emerald-100">
                <!-- <div class="flex items-center text-sm text-emerald-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    <span>২০% বৃদ্ধি গত বছর থেকে</span>
                </div> -->
            </div>
        </div>
    </div>











        <!-- end card -->

        <div class="p-6 bg-gray-50 min-h-screen">
        <div class="bg-white shadow-xl rounded-xl p-6">
            <div class="my-5">
                <button class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Export
                </button>
            </div>

            <div class="flex justify-between items-center mb-6">
                <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="flex items-center gap-4 w-full">
                    <select
                        v-if="years.length > 0"
                        @change="filterByYear"
                        v-model="selectedYear"
                        class="px-4 py-2.5 w-48 bg-white border border-gray-200 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none shadow-sm hover:border-blue-400"
                    >
                        <option value="">বছর নির্বাচন করুন</option>
                        <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>

                    <select
    v-if="years.length > 0"
    @change="filterBySRtype"
    v-model="selectedSRType"
    class="px-4 py-2.5 w-48 bg-white border border-gray-200 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none shadow-sm hover:border-blue-400"
>
    <option value="">ছাত্র-ছাত্রী নির্বাচন করুন</option>
    <option value="1">ছাত্র</option>
    <option value="0">ছাত্রী</option>
</select>


<div class="relative flex-1">
                <input
                    type="text"
                    v-model="Roll"
                    placeholder="রোল নম্বর লিখুন"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none shadow-sm hover:border-blue-400"
                />
            </div>

            <div class="relative flex-1">
                <input
                    type="text"
                    v-model="reg_id"
                    placeholder="রেজিস্ট্রেশন নম্বর লিখুন"
                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none shadow-sm hover:border-blue-400"
                />
            </div>



                    <button
                        @click="searchStudent"
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 flex items-center gap-2 shadow-sm"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>অনুসন্ধান</span>
                    </button>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">ক্রমিক নং</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">নাম</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">পিতার নাম</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">মাদরাসার নাম</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">ক্লাস</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">বছর</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">জন্মতারিখ</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">রোল</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">রেজিস্ট্রেশন</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">বিস্তারিত</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="(student, index) in students.data" :key="student.id" class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">{{ (students.current_page - 1) * students.per_page + (index + 1) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-4 text-md font-semibold  whitespace-nowrap">{{ student.Name }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Father }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Madrasha }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Class }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.years }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.DateofBirth }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Roll }}</td>
                            <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.reg_id }}</td>
                            <td class="px-6 py-4  whitespace-nowrap">
                                <Link :href="route('marhala.fazilatDetailes', { Roll: student.Roll, reg_id: student.reg_id })"
                                      class="text-blue-600 hover:text-blue-800 transition-colors duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c-4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <nav v-if="students?.links?.length > 1" class="flex items-center justify-between mt-6">
                <div class="text-sm text-gray-700">
                    Showing {{ students.from }} to {{ students.to }} of {{ students.total }} results
                </div>
                <ul class="inline-flex items-center -space-x-px rounded-md shadow-sm">
                    <li v-for="(link, index) in students.links" :key="index">
                        <a v-if="link.url" :href="link.url"
                            :class="[
                                'relative inline-flex items-center px-4 py-2 text-sm font-medium border',
                                link.active
                                    ? 'z-10 bg-blue-50 border-blue-500 text-blue-600'
                                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                index === 0 ? 'rounded-l-md' : '',
                                index === students.links.length - 1 ? 'rounded-r-md' : ''
                            ]"
                            v-html="link.label">
                        </a>
                        <span v-else v-html="link.label" class="relative inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 bg-white text-gray-500"></span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
