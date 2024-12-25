<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3';

import { router } from '@inertiajs/vue3'

const props = defineProps({
    student: {
        type: Object,
        required: true
    }
});

// const form = ref({});

onMounted(() => {
    form.value = { ...props.student };
});

// const form = ref({
//     StudentName: props.student.StudentName,
//     StudentFather: props.student.StudentFather,
//     st_en_name: props.student.st_en_name,
//     st_en_Fname: props.student.st_en_Fname,
//     DateofBirth: props.student.DateofBirth,
//     BirthRegistrationNo_nid_no: props.student.BirthRegistrationNo_nid_no,
//     mobileNumber: props.student.mobileNumber,
//     MadrashaNameEn: props.student.MadrashaNameEn,
// });



// Male Subjects
const maleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسير البيضاوي' },
    { name: 'شرح العقائد و الفرق الباطلة' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'نزهة النظر في شرح نخبة الفكر' },
    { name: 'تحريك دار العلوم ديوبند' }
];

// Female Subjects
const femaleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الثاني)' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'عقيدة الطحاوي' }
];

const currentSubjects = computed(() => {
    return Number(form.value.SRType) === 1 ? maleSubjects : femaleSubjects;
});


const studentResults = ref({
    SubValue_1: props.student.SubValue_1 || '',
    SubValue_2: props.student.SubValue_2 || '',
    SubValue_3: props.student.SubValue_3 || '',
    SubValue_4: props.student.SubValue_4 || '',
    SubValue_5: props.student.SubValue_5 || '',
    SubValue_6: props.student.SubValue_6 || '',
    SubValue_7: props.student.SubValue_7 || '',
    SubValue_8: props.student.SubValue_8 || '',
    Total: props.student.Total || '',
    Division: props.student.Division || ''
});





const computedValues = computed(() => ({
    fullName: `${form.value.StudentName} (${form.value.st_en_name})`,
    totalMarks: Number(form.value.Total).toLocaleString()
}));

// const form = reactive({
//     ...toRaw(props.student),
//     StudentName: props.student.StudentName,
//     StudentFather: props.student.StudentFather,
// });








// Computed property for subjects based on SRType

// Student results data


// Modal state



// const studentRoll = computed(() => props.student?.Roll);
// const studentRegId = computed(() => props.student?.reg_id);

// const form = ref({
//     Name: props.student.Name,
//     StudentName: props.student.StudentName,
//     Father: props.student.Father,
//     StudentFather: props.student.StudentFather,
//     st_en_name: props.student.st_en_name,
//     st_en_Fname: props.student.st_en_Fname,
//     DateofBirth: props.student.DateofBirth,
//     BirthRegistrationNo_nid_no: props.student.BirthRegistrationNo_nid_no,
//     mobileNumber: props.student.mobileNumber,
//     MadrashaNameEn: props.student.MadrashaNameEn
// });

// const handleSubmit = () => {
//     if (isSubmitting.value) return;
//     isSubmitting.value = true;

//     router.put(`/students/${props.student.Roll}/${props.student.reg_id}`, form.value, {
//         preserveScroll: true,
//         onSuccess: () => {
//             showModal.value = false;
//             // Replace full page reload with selective update
//             router.visit(window.location.pathname, {
//                 preserveScroll: true,
//                 preserveState: true
//             });
//         },
//         onError: (errors) => {
//             console.error('Validation errors:', errors);
//         },
//         onFinish: () => {
//             isSubmitting.value = false;
//         }
//     });
// };

// Update the router call in your component
// router.put(route('student.update', { MID: props.student.MID }), form.value, {
//     preserveScroll: true,
//     onSuccess: () => {
//         showModal.value = false;
//         router.visit(route('student.details', { MID: props.student.MID }), {
//             preserveScroll: true,
//             preserveState: true
//         });
//     },
//     // ... rest of the code
// });


const form = ref({
    // Arabic Information from students_number_potrro
    Name: props.student?.Name || '',
    Father: props.student?.Father || '',
    st_en_name: props.student?.st_en_name || '',
    st_en_Fname: props.student?.st_en_Fname || '',
    DateofBirth: props.student?.DateofBirth || '',
    BirthRegistrationNo_nid_no: props.student?.BirthRegistrationNo_nid_no || '',
    mobileNumber: props.student?.mobileNumber || '',
    MadrashaNameEn: props.student?.MadrashaNameEn || '',
    SRType: props.student?.SRType || '',

    // Bangla Information from students table
    StudentName: props.student?.student?.StudentName || '',
    StudentFather: props.student?.student?.StudentFather || ''
});



const handleSubmit = () => {
    if (isSubmitting.value) return;
    isSubmitting.value = true;

    router.put(`/students/${props.student.MID}`, form.value, {
        preserveScroll: true,
        onSuccess: () => {
            showModal.value = false;
            router.visit(window.location.pathname, {
                preserveScroll: true,
                preserveState: true
            });
        },
        onError: (errors) => {
            console.error('Validation errors:', errors);
        },
        onFinish: () => {
            isSubmitting.value = false;
        }
    });
};



const isSubmitting = ref(false);
const showModal = ref(false);


const openEditModal = () => {
  showModal.value = true;
};


// Methods
const toggleModal = () => {
  showModal.value = false;
};




</script>



<template>
  <AuthenticatedLayout>
    <!-- <a :href="route('Fazilat')" class="inline-block">
      <PrimaryButton class="mx-10">
        BACK
      </PrimaryButton>
    </a> -->
    <Link
  :href="route('Fazilat')"
  class=" mb-5 mx-1 inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white rounded-md     shadow-md transition-all duration-200 ease-in-out transform hover:-translate-y-0.5"
>
  <svg
    class="w-5 h-5 mr-2"
    fill="none"
    stroke="currentColor"
    viewBox="0 0 24 24"
  >
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M10 19l-7-7m0 0l7-7m-7 7h18"
    />
  </svg>
  <span class="font-medium">Back</span>
</Link>


    <!-- Student Details Section -->
    <div class="min-h-screen bg-gray-50 py-8">
  <div class="container-fluid px-4 sm:px-6 lg:px-8 w-full">
    <div class="bg-white rounded-md shadow-2xl overflow-hidden mx-4">
      <!-- Header -->
      <div class="p-5 bg-gradient-to-r from-indigo-700 to-blue-600">
        <div class="flex justify-between items-center">
          <button @click="openEditModal"
                  class="px-5 py-1.5 bg-white text-blue-600 rounded-sm font-semibold shadow-lg hover:bg-blue-50 transition duration-200 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
          </button>

          <h2 class="text-2xl font-bold text-white flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            বিস্তারিত তথ্য (বাংলা)
          </h2>

          <button @click="generatePdf"
                  class="px-5 py-1.5 bg-white text-blue-600 rounded-sm font-semibold shadow-lg hover:bg-blue-50 transition duration-200 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print PDF
          </button>
        </div>
      </div>

      <!-- Details Table -->
      <div class="p-6">
        <div class="overflow-hidden border border-gray-200 rounded-md">
          <table class="w-full divide-y divide-gray-200">
            <tbody class="divide-y divide-gray-200">
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">নাম (আরবি)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.Name }}</span>
                </td>
              </tr>

              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">নাম (বাংলা)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.StudentName}}</span>
                </td>
              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">নাম (ইংরেজি)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.st_en_name}}</span>
                </td>
              </tr>

              <!-- Repeat the same pattern for other fields -->
              <!-- Example for one more field -->
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">পিতার নাম (আরবি)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.Father }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">পিতার নাম (বাংলা)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.StudentFather }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">পিতার নাম ( ইংরেজি)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.st_en_Fname }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">মাদরাসা নাম (আরবি)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.Madrasha }}</span>
                </td>

              </tr>
                   <!-- <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">মাদরাসার নাম (বাংলা)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.StudentMadrasha }}</span>
                </td>

              </tr> -->
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">মাদরাসার নাম (ইংরেজি)</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.MadrashaNameEn}}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">রোল</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 text-xl font-medium ">{{ form.Roll }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">নিবন্ধন নম্বর</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 text-xl font-medium ">{{ form.reg_id }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">জন্মতারিখ</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-lg">{{ form.DateofBirth }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">জাতিয়তা</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.Nationality }}</span>
                </td>

              </tr>
              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">জন্মনিবন্ধন/ এন আইডি নম্বর</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.BirthRegistrationNo_nid_no }}</span>
                </td>

              </tr>

              <tr class="transition-colors hover:bg-gray-50">
                <td class="px-6 py-4 w-1/3 bg-gray-50">
                  <div class="flex items-center gap-2">
                    <span class="text-gray-600 text-xl font-semibold">ফোন  নম্বর</span>
                  </div>
                </td>
                <td class="px-6 py-4 bg-white">
                  <span class="text-gray-800 font-medium text-xl">{{ form.mobileNumber }}</span>
                </td>

              </tr>



              <!-- Continue the pattern for remaining fields -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




    <!-- Results Section -->
    <div class=" bg-gray-50 ">
  <div class="container-fluid px-4 sm:px-6 lg:px-8 w-full">
    <div class="bg-white rounded-md shadow-2xl overflow-hidden mx-4">
      <!-- Header -->
      <div class="p-6 bg-gradient-to-r from-indigo-700 to-blue-600">
        <div class="flex justify-between items-center">
          <h2 class="text-3xl font-bold text-white flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            মার্কশীট
          </h2>

          <button class="px-6 py-1.5 bg-white text-blue-600 rounded-sm font-semibold shadow-lg hover:bg-blue-50 transition duration-200 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print
          </button>
        </div>
      </div>

      <!-- Table -->
      <div class="p-6 w-full">
        <div class="overflow-hidden border border-gray-200 rounded-md w-full">

            <table class="min-w-full divide-y divide-gray-200">
    <thead>
      <tr class="bg-gray-50">
        <th class="px-6 py-4 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">ক্রমিক</th>
        <th class="px-6 py-4 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">বিষয়</th>
        <th class="px-6 py-4 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">পূর্ণ নম্বর</th>
        <th class="px-6 py-4 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">প্রাপ্ত নম্বর</th>
        <th class="px-6 py-4 text-xl font-medium text-gray-500 uppercase tracking-wider text-center">প্রাপ্ত বিভাগ</th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
      <tr v-for="(subject, index) in currentSubjects" :key="index"
          class="hover:bg-gray-50 transition-colors duration-200">
        <td class="px-6 py-4 whitespace-nowrap text-center text-xl text-gray-600">{{ index + 1 }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-center text-xl font-medium text-gray-800">{{ subject.name }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-center text-xl text-gray-600">১০০</td>
        <td class="px-6 py-4 whitespace-nowrap text-center text-xl font-medium text-blue-600">
          {{ student[`SubValue_${index + 1}`] || 'N/A' }}
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr class="bg-gray-50">
        <td colspan="3" class="px-6 py-4 text-right text-xl font-bold text-gray-700">মোট</td>
        <td class="px-6 py-4 text-center text-xl font-bold text-blue-600">{{ student.Total }}</td>
        <td class="px-6 py-4 text-center text-xl font-bold text-green-600">{{ student.Division }}</td>
      </tr>
    </tfoot>


          </table>
        </div>
      </div>
    </div>
  </div>
</div>


    <div class="relative inline-block text-left">


  </div>

  </AuthenticatedLayout>

  <!-- Edit Modal -->
  <div v-if="showModal"
     class="fixed inset-0 z-50 overflow-y-auto"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true">

  <!-- Backdrop -->
  <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-filter backdrop-blur-sm transition-opacity"></div>

  <!-- Modal Container -->
  <div class="flex min-h-screen items-center justify-center p-4">
    <div class="relative w-full max-w-4xl rounded-sm bg-white shadow-2xl transform transition-all">

      <!-- Modal Header -->
      <div class="bg-gradient-to-r from-indigo-700 to-blue-600 rounded-sm p-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          <h3 style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="text-xl font-bold text-white">সংশোধনী ফরম</h3>
        </div>

        <button @click="toggleModal"
                class="rounded-full p-2 text-white hover:bg-white/10 transition-colors duration-200">
          <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Modal Body -->
      <div class="p-8 space-y-6">
        <form @submit.prevent="handleSubmit" class="space-y-8">

          <!-- Bangla Information Section -->
          <div>
            <h4 style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="text-xl font-semibold text-green-900 border-b pb-2 mb-4">বাংলা তথ্য</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <!-- Name Input -->
              <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2">
                <label class="block text-xl font-semibold text-gray-700">
                  নাম (আরবি)
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.Name"
                       type="text"
                       placeholder="নাম লিখুন"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
              <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2">
                <label class="block text-xl font-semibold text-gray-700">
                  নাম (বাংলা)
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.StudentName"
                       type="text"
                       placeholder="নাম লিখুন"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
              <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2">
                <label class="block text-xl font-semibold text-gray-700">
                  নাম (ইংরেজি)
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.st_en_name"
                       type="text"
                       placeholder="নাম লিখুন"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>

              <!-- Father's Name Input -->
              <div class="space-y-2">
                <label style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="block text-xl font-semibold text-gray-700">
                  পিতার নাম (আরবি)
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.Father"
                       type="text"
                       placeholder="পিতার নাম লিখুন"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
              <div class="space-y-2">
                <label style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="block text-xl font-semibold text-gray-700">
                  পিতার নাম ( বাংলা)
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.StudentFather"
                       type="text"
                       placeholder="পিতার নাম লিখুন"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
              <div class="space-y-2">
                <label style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="block text-xl font-semibold text-gray-700">
                  পিতার নাম ( ইংরেজি)
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.st_en_Fname"
                       type="text"
                       placeholder="পিতার নাম লিখুন"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>

              <!-- Date of Birth Input -->
              <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2">
                <label class="block text-xl font-semibold text-gray-700">
                  জন্ম তারিখ
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.DateofBirth"

                       type="date"
                       style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
            </div>
          </div>

          <!-- English Information Section -->
          <div>
            <h4 style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="text-xl font-semibold text-green-900 border-b pb-2 mb-4">ইংরেজি তথ্য</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <!-- English Name Input -->



              <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2">
                <label class="block text-xl font-semibold text-gray-700">
                 জন্মনিবন্ধন নম্বর/এন আইডি নম্বর
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.BirthRegistrationNo_nid_no"
                       type="text"
                       placeholder="Name in English"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
              <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2">
                <label class="block text-xl font-semibold text-gray-700">
            মোবাইল নম্বর
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.mobileNumber"
                       type="text"
                       placeholder="Name in English"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
              <!-- Other fields following the same pattern -->
            </div>
            <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="space-y-2 ">
                <label class="block text-xl font-semibold text-gray-700 mt-5    ">
        মাদরাসার নাম ইংরেজি
                  <span class="text-red-500">*</span>
                </label>
                <input v-model="form.MadrashaNameEn"
                       type="text"
                       placeholder="Name in English"
                       class="w-full px-4 py-3 rounded-lg text-lg font-semibold border-gray-300 bg-gray-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200" />
              </div>
          </div>




          <!-- Form Actions -->
          <div class="flex items-center justify-end space-x-4 pt-6 border-t">
            <button type="button"
                    @click="toggleModal"
                    style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                    class="px-6 py-2.5 text-xl font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:ring-2 focus:ring-gray-200 transition duration-200">
              বাতিল করুন
            </button>
            <button type="submit"
                    :disabled="isSubmitting"
                    style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                    class="px-6 py-2.5 text-xl font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-200 transition duration-200 disabled:opacity-50">
              <span v-if="isSubmitting" class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                  <!-- Add loading spinner SVG here -->
                </svg>
                সংরক্ষণ হচ্ছে...
              </span>
              <span v-else>সেভ করুন</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<!-- pdf -->
<!--

<div>
        <PDF_fazilat
            :roll="student.Roll"
            :reg-id="student.reg_id"
            :sr-type="student.SRType"
        />
    </div> -->



</template>


<style scoped>
.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.table, th, td {
    border: 1px solid #ddd;
}
th, td {
    text-align: left;
    padding: 8px;
}
th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-active .modal-content,
.modal-leave-active .modal-content {
  transition: transform 0.3s ease;
}

.modal-enter-from .modal-content,
.modal-leave-to .modal-content {
  transform: scale(0.95);
}

</style>
