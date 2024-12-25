<script setup>
import { ref, watch, onMounted } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    students: Object,
    years: Array,
    filters: Object
})

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
    red_id: "",
});

const searchStudent = () => {
    Inertia.post('/search-student', form.value, {
        onSuccess: (response) => {
            // Update your student data based on the response from the controller
            console.log(response)
        }
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

                        <input
      type="text"
      id="red_id"
      v-model="form.Roll"
      placeholder="ইলহাক লিখুন"
      class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none"
    />
    <input
      type="text"
      id="red_id"
      v-model="form.red_id"
      placeholder="ইলহাক লিখুন"
      class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none"
    />
    <button @click="searchStudent"
      class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg mr-2 btn-sm">
      Search
    </button>
                    </div>
                </div>

                <table style=" font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                    class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
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
                        <tr v-for="student in students.data" :key="student.id" class="hover:bg-gray-50">
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
                            <a v-if="link.url" :href="link.url" :class="[
                                'flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                                link.active ? 'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-500 bg-white'
                            ]" v-html="link.label"></a>
                            <span v-else :class="[
                                'flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 text-gray-500 bg-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400',
                                index === 0 ? 'rounded-s-lg' : '',
                                index === students.links.length - 1 ? 'rounded-e-lg' : ''
                            ]" v-html="link.label"></span>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
