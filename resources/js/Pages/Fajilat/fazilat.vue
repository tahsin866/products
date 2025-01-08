<script setup>
import { ref, watch, onMounted, computed } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/vue3';
// import { convertToBangla } from '@/utils/numberToBangla';


import Dashboard from '../Dashboard.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

// Add reg_id to your reactive state declarations
const reg_id = ref('')
const Roll2 = ref('')
const Roll = ref('')
// Include it in your props definition
const props = defineProps({
    students: Object,
    years: Array,
    filters: Object,
    studentCount: Number,
    yearCount: Number,
    maleCount: Number,
    femaleCount: Number,
    SRType: Array,
    // reg_id: {
    //     type: String,
    //     default: ''
    // }
    searchElhaq: Array,
    division: Array,
    // districts: Array,
    // thanas: Array
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
const SRType = ref(props.SRType || [])
const division = ref(props.division || [])

// State for filters

const selectedYear = ref(props.filters?.year || '')
const selectedSRType = ref(props.filters?.SRType || '')
const selecteddivision = ref(props.filters?.division || '')

// Watch for changes in selectedYear
watch(selectedYear, (newYear) => {
    if (newYear) {
        console.log('Year changed to:', newYear)
    }
})

const filterByYear = () => {
    router.get(
        route('Fajilat.fazilat'),
        {
            year: selectedYear.value,
            SRType: selectedSRType.value, // Maintain SRType filter
            page: 1
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onSuccess: (page) => {
                students.value = page.props.students;
                yearCount.value = page.props.yearCount;
                maleCount.value = page.props.maleCount;
                femaleCount.value = page.props.femaleCount;
            },
        }
    );
};
const filterBySRType = () => {
    router.get(
        route('Fajilat.fazilat'),
        {
            SRType: selectedSRType.value,
            year: selectedYear.value, // Maintain year filter
            page: 1
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onSuccess: (page) => {
                students.value = page.props.students;
                yearCount.value = page.props.yearCount;
                maleCount.value = page.props.maleCount;
                femaleCount.value = page.props.femaleCount;
            },
        }
    );
};





const filterBydivision = () => {
    router.get(
        route('Fajilat.fazilat'),
        {
            SRType: selecteddivision.value,
            year: selecteddivision.value, // Maintain year filter
            page: 1
        },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onSuccess: (page) => {
                students.value = page.props.students;
                yearCount.value = page.props.yearCount;
                maleCount.value = page.props.maleCount;
                femaleCount.value = page.props.femaleCount;
            },
        }
    );
};





const pageInput = ref('')

const goToPage = () => {
    if (pageInput.value >= 1 && pageInput.value <= students.value.last_page) {
        router.get(
            route('Fajilat.searchElhaq'),
            {
                page: pageInput.value,
                year: selectedYear.value,
                SRType: selectedSRType.value,
                Elhaq: form.Elhaq  // Remove .value here
            },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
                onSuccess: (page) => {
                    students.value = page.props.students;
                    yearCount.value = page.props.yearCount;
                    maleCount.value = page.props.maleCount;
                    femaleCount.value = page.props.femaleCount;
                }
            }
        )
    }
}



const form = ref({
    Elhaq: ''
});


const searchResults = ref(null)

const searchStudent = () => {
    if (!form.value.Elhaq) {
        return;
    }

    router.visit(route('Fajilat.searchElhaq', {
        Elhaq: form.value.Elhaq,
        year: selectedYear.value
    }), {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (page) => {
            students.value = page.props.students;
            yearCount.value = page.props.yearCount;
            maleCount.value = page.props.maleCount;
            femaleCount.value = page.props.femaleCount;
        }
    });
};


// const selectedDivision = ref('')
// const selectedDistrict = ref('')
// const selectedThana = ref('')

// const filteredDistricts = computed(() => {
//     if (!selectedDivision.value) return []
//     return props.districts.filter(district => district.DID === parseInt(selectedDivision.value))
// })

// const filteredThanas = computed(() => {
//     if (!selectedDistrict.value) return []
//     return props.thanas.filter(thana => thana.Des_ID === parseInt(selectedDistrict.value))
// })

// watch(selectedDivision, () => {
//     selectedDistrict.value = ''
//     selectedThana.value = ''
// })

// watch(selectedDistrict, () => {
//     selectedThana.value = ''
// })







// Initialize data on mount
onMounted(() => {
    if (props.students) {
        students.value = props.students
    }
    console.log('Props on mount:', {
        students: students.value,
        years: years.value
        // SRType: SRType.value
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

            </div>
        </div>
    </div>











        <!-- end card -->

        <div class="p-6 bg-gray-50 min-h-screen">
        <div class="bg-white shadow-xl rounded-xl p-6">

  <div class="grid grid-cols-1 gap-6 mb-6">
        <!-- Filter Section -->
        <div class="bg-white shadow-xl rounded-xl">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">ফিল্টার অপশন</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-5 gap-4">
                    <select
                        v-if="years.length > 0"
                        v-model="selectedYear"
                        @change="filterByYear"
                        class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 outline-none shadow-sm hover:border-blue-400"
                    >
                        <option value="">বছর নির্বাচন করুন</option>
                        <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>


                    <select
                    v-if ="SRType.length > 0"
                        v-model="selectedSRType"
                        @change="filterBySRType"
                        class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg"
                    >
                        <option value="">ছাত্র-ছাত্রী নির্বাচন করুন</option>
                        <option value="1">ছাত্র</option>
                        <option value="0">ছাত্রী</option>
                    </select>



                    <select
                    v-if ="division.length > 0"
                        v-model="selecteddivision"
                        @change="filterBydivision"
                        class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg"
                    >
                        <option value="">ছাত্র-ছাত্রী নির্বাচন করুন</option>
                        <!-- <option value="1">ছাত্র</option>
                        <option value="0">ছাত্রী</option> -->
                    </select>

<select v-model="selectedDistrict" class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg">
    <option value="">জেলা নির্বাচন করুন</option>
    <option v-for="district in filteredDistricts" :key="district.DesID" :value="district.DesID">
        {{ district.district }}
    </option>
</select>

<select v-model="selectedThana" class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg">
    <option value="">থানা নির্বাচন করুন</option>
    <option v-for="thana in filteredThanas" :key="thana.ID" :value="thana.ID">
        {{ thana.thana }}
    </option>
</select>

                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="bg-white shadow-xl rounded-xl">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">অনুসন্ধান</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-4 gap-4">
                    <input
                        type="text"
                        v-model="Roll"
                        placeholder="রোল নম্বর লিখুন"
                        class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg"
                    />
                    <input
                        type="text"
                        v-model="Roll2"
                        placeholder="দ্বিতীয় রোল নম্বর"
                        class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg"
                    />
                <input
            type="text"
            v-model="form.Elhaq"

            placeholder="ইলহাক নম্বর লিখুন"
            class="px-4 py-2.5 w-full bg-white border border-gray-200 rounded-lg"
            @input="search"
        />
                    <button
                    @click="searchStudent()"
    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 flex items-center justify-center gap-2"

                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>অনুসন্ধান</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white shadow-xl rounded-xl">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">অ্যাকশন</h2>
            </div>
            <div class="p-6">
                <div class="flex gap-4">
                    <PrimaryButton class="bg-green-600 hover:bg-green-700">
                        এক্সপোর্ট
                    </PrimaryButton>
                    <PrimaryButton class="bg-blue-600 hover:bg-blue-700">
                        প্রিন্ট
                    </PrimaryButton>
                    <PrimaryButton class="bg-red-600 hover:bg-red-700">
                        পিডিএফ ডাওনলোড
                    </PrimaryButton>
                    <PrimaryButton class="bg-purple-600 hover:bg-purple-700">
                        মাদরাসাওয়ারী বিস্তারিত তথ্য
                    </PrimaryButton>
                </div>
            </div>
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
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">ইলহাক</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">ক্লাস</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">বছর</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">বিভাগ</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">জেলা</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">থানা</th>
                            <th class="px-6 py-3 text-left text-md font-semibolt text-gray-500 uppercase tracking-wider">বিস্তারিত</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="(student, index) in students.data" :key="student.id" class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">{{ index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Name }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Father }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Madrasha }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Elhaq }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.Class }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.years }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.madrasha ? student.madrasha.division : "N/A" }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.madrasha ? student.madrasha.district : "N/A" }}</td>
                    <td class="px-6 py-4 text-md font-semibold whitespace-nowrap">{{ student.madrasha ? student.madrasha.Thana_uni : "N/A" }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <Link :href="route('Fajilat.fazilatDetailes', { Roll: student.Roll, reg_id: student.reg_id })" class="text-blue-600 hover:text-blue-800 transition-colors duration-150 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform group-hover:scale-110 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </Link>
                    </td>
                </tr>
            </tbody>
                </table>
            </div>

<!-- page search -->


            <div class="flex items-center gap-4 mb-4 mt-5">
    <div class="flex items-center gap-2">
        <input
            type="number"
            v-model="pageInput"
            class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            min="1"
            :max="students.last_page"
            placeholder="Page"
        />
        <button
            @click="goToPage"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
            Go
        </button>
    </div>
    <span class="text-sm text-gray-600">
        of {{ students.last_page }} pages
    </span>
</div>


            <nav


    v-if="students?.links?.length > 1"
    class="flex flex-col md:flex-row items-center justify-between gap-4 mt-8 bg-white p-4 rounded-lg shadow-sm"
>
    <!-- Results Counter -->
    <div class="text-sm text-gray-700 font-medium">
        <span class="hidden md:inline">Showing </span>
        <span class="font-semibold text-gray-900">{{ students.from }}</span>
        <span class="hidden md:inline"> to </span>
        <span class="font-semibold text-gray-900">{{ students.to }}</span>
        <span class="hidden md:inline"> of </span>
        <span class="font-semibold text-gray-900">
            {{ selectedSRType ? (selectedSRType === '0' ? femaleCount : maleCount) : students.total }}
        </span>
        <span class="hidden md:inline"> results</span>
    </div>

    <!-- Pagination Links -->
    <ul class="inline-flex items-center gap-px">
        <li v-for="(link, index) in students.links" :key="index">
        <!-- Pagination Links -->

<Link
    v-if="link.url"
    :href="link.url +
        (form.Elhaq ? `&Elhaq=${form.Elhaq}` : '') +
        (selectedYear.value ? `&year=${selectedYear.value}` : '') +
        (selectedSRType.value ? `&SRType=${selectedSRType.value}` : '')"
    :class="[
        'relative inline-flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200',
        link.active
            ? 'z-10 bg-blue-600 text-white hover:bg-blue-700'
            : 'bg-white text-gray-700 hover:bg-gray-50 hover:text-blue-600',
        'border border-gray-200',
        index === 0 ? 'rounded-l-lg' : '',
        index === students.links.length - 1 ? 'rounded-r-lg' : '',
        'focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
    ]"
    v-html="link.label"
/>


            <span
                v-else
                v-html="link.label"
                class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium bg-gray-50 text-gray-400 border border-gray-200 cursor-not-allowed"
            />
        </li>
    </ul>
</nav>

        </div>
    </div>
    </AuthenticatedLayout>
</template>
