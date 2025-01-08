<script setup>
import { usePage, useForm } from "@inertiajs/vue3"
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { ref, computed } from 'vue'
import PrimaryButton from "@/Components/PrimaryButton.vue"
import { router } from '@inertiajs/vue3'






const { props } = usePage()
const studentDetails = props.studentDetails || {}
const isLoading = ref(false)

const maleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسير البيضاوي' },
    { name: 'شرح العقائد و الفرق الباطلة' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'نزهة النظر في شرح نخبة الفكر' },
    { name: 'تحريك دار العلوم ديوبند' }
]

const femaleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الثاني)' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'عقيدة الطحاوي' }
]

const currentSubjects = computed(() => {
    return studentDetails.SRType === 0 ? femaleSubjects : maleSubjects
})

const studentResults = ref({
    SubValue_1: studentDetails.SubValue_1 || '',
    SubValue_2: studentDetails.SubValue_2 || '',
    SubValue_3: studentDetails.SubValue_3 || '',
    SubValue_4: studentDetails.SubValue_4 || '',
    SubValue_5: studentDetails.SubValue_5 || '',
    SubValue_6: studentDetails.SubValue_6 || '',
    SubValue_7: studentDetails.SubValue_7 || '',
    SubValue_8: studentDetails.SubValue_8 || '',
    Total: studentDetails.Total || '',
    Division: studentDetails.Division || ''
})

const getGrade = (marks) => {
    if (!marks) return 'N/A'
    const numericMarks = Number(marks)
    if (numericMarks >= 80) return 'মুমতাজ'
    if (numericMarks >= 70) return 'জায়্যিদ জিদ্দান'
    if (numericMarks >= 60) return 'জায়্যিদ'
    if (numericMarks >= 33) return 'মকবুল'

    return 'F'
}

const updateProfile = () => {
    isLoading.value = true
    router.put(route('Fajilat.update'), studentDetails, {
        preserveScroll: true,
        onSuccess: () => {
            isLoading.value = false
            toast.add({
                severity: 'success',
                summary: 'Success',
                detail: 'তথ্য সফলভাবে সংরক্ষণ করা হয়েছে',
                life: 3000
            })
        }
    })
}


// pdf


const downloadCertificate = () => {
    window.location.href = route('Fajilat.certificate.pdf', {
        Roll: studentDetails.Roll,
        reg_id: studentDetails.reg_id
    });
};

</script>


<template>
  <AuthenticatedLayout>


    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50 py-12">
        <PrimaryButton class="mx-5 mb-3" @click="$inertia.get(route('Fajilat.certificate'))">
    BACK
</PrimaryButton>

  <div class="max-w-full  mx-5">
    <!-- Profile Header Card -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
      <div class="bg-gradient-to-r from-slate-800 to-zinc-900 p-8">
        <div class="flex flex-col md:flex-row items-center">
          <div class="relative">
            <img
              src="https://via.placeholder.com/150"
              alt="Student"
              class="w-32 h-32 rounded-full border-4 border-white shadow-lg"
            />
            <span class="absolute bottom-2 right-2 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></span>
          </div>
          <div class="md:ml-6 mt-4 md:mt-0 text-center md:text-left">
            <h1 class="text-3xl font-bold text-white">{{ studentDetails.Name }}</h1>
            <div class="mt-2 space-y-1">
              <p class="text-blue-100 flex items-center justify-center md:justify-start">
                <span class="inline-block w-3 h-3 rounded-full bg-blue-200 mr-2"></span>
                রোল: {{ studentDetails.Roll || '12345' }}
              </p>
              <p class="text-blue-100 flex items-center justify-center md:justify-start">
                <span class="inline-block w-3 h-3 rounded-full bg-blue-200 mr-2"></span>
                ক্লাস: {{ studentDetails.Class|| '12345' }}
              </p>
            </div>
          </div>
          <div class="md:ml-auto mt-4 md:mt-0">
            <div class="bg-white/10 rounded-lg p-4 backdrop-blur-sm">
              <p class="text-white text-sm font-semibold">Academic Performance</p>
              <div class="mt-2">
                <div class="w-full bg-white/20 rounded-full h-2">
                  <div class="bg-green-400 h-2 rounded-full" style="width: 87%"></div>
                </div>
                <p class="text-white text-xs mt-1">87% Overall</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="mt-6 mb-5">
    <PrimaryButton
        @click="downloadCertificate"
        class="flex items-center gap-2"
    >
        <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
        </svg>
        Print Certificate
    </PrimaryButton>
</div>


    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


      <!-- Left Column -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Personal Details Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Keeping the header -->
    <div class="relative border-b bg-gradient-to-r from-slate-800 to-zinc-900 p-4 ">
        <h2 class="text-2xl font-bold text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            ব্যাক্তিগত তথ্য
        </h2>
    </div>

    <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap w-1/3">
                        <span class="text-md font-semibold text-gray-600">নাম আরবি</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.Name }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">নাম ইংরেজি</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.st_en_name }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">পিতার নাম আরবি</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.Father }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">পিতার নাম ইংরেজি</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.st_en_Fname }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">রোল নম্বর</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.Roll }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">রেজিস্ট্রেশন নম্বর</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.reg_id }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">জন্ম-তারিখ</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.DateofBirth }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">জাতিয়তা</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.Nationality }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">মোবাইল নম্বর</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.mobileNumber }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">জন্মনিবন্ধন নম্বর</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.BirthRegistrationNo_nid_no }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">হিজরি সন</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.Hijri_years }} হি:</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">মাদরাসার নাম</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.Madrasha }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-md font-semibold text-gray-600">মাদরাসার নাম ইংরেজি</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-lg font-medium text-gray-900">{{ studentDetails.MadrashaNameEn }}</span>
                    </td>

                    <!-- {{ studentDetails.madrasha ? studentDetails.madrasha.Thana_uni : "N/A" }} -->
                </tr>
            </tbody>
        </table>
    </div>
</div>




<div class="mt-6 mb-5">
    <PrimaryButton
        @click="downloadCertificate"
        class="flex items-center gap-2"
    >
        <svg xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
        </svg>
        Print Certificate
    </PrimaryButton>
</div>


            <!-- Academic Performance Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header -->
    <div class="relative border-b bg-gradient-to-r from-slate-800 to-zinc-900 p-4">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-white">মার্কশীট</h2>
            <span class="bg-white/20 text-white px-4 py-2 rounded-lg">
                শিক্ষাবর্ষ {{ studentDetails.years }}
            </span>
        </div>
    </div>

    <div class="p-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-6 py-4 text-md font-semibold text-gray-600">ক্রমিক</th>
                    <th class="px-6 py-4 text-md font-semibold text-gray-600">বিষয়</th>
                    <th class="px-6 py-4 text-md font-semibold text-gray-600">পূর্ণ নম্বর</th>
                    <th class="px-6 py-4 text-md font-semibold text-gray-600">প্রাপ্ত নম্বর</th>
                    <th class="px-6 py-4 text-md font-semibold text-gray-600">প্রাপ্ত বিভাগ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr v-for="(subject, index) in currentSubjects" :key="index">
                    <td class="px-6 py-4 text-center">
                        <span class="bg-gray-100 px-3 py-1 rounded-full">{{ index + 1 }}</span>
                    </td>
                    <td class="px-6 py-4 text-center font-medium">{{ subject.name }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-blue-50 px-4 py-1 rounded-lg">১০০</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-blue-50 text-blue-600 px-4 py-1 rounded-lg">
                            {{ studentResults[`SubValue_${index + 1}`] || 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span :class="{
                            'px-4 py-1 rounded-lg': true,
                            'bg-green-50 text-green-600': getGrade(studentResults[`SubValue_${index + 1}`]) !== 'F',
                            'bg-red-50 text-red-600': getGrade(studentResults[`SubValue_${index + 1}`]) === 'F'
                        }">
                            {{ getGrade(studentResults[`SubValue_${index + 1}`]) }}
                        </span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="bg-gray-50 font-bold">
                    <td colspan="3" class="px-6 py-4 text-right">মোট</td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-blue-50 text-blue-600 px-6 py-2 rounded-lg">
                            {{ studentDetails.Total }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-green-50 text-green-600 px-6 py-2 rounded-lg">
                            {{ studentDetails.Division }}
                        </span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

        </div>

      <!-- Right Column -->
      <div class="space-y-8">
        <!-- Quick Stats Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-6">এক নজরে ফলাফল</h2>
          <div class="space-y-4">
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-md font-semibold text-gray-900">মোট গড়</p>
                <p class="text-lg font-semibold text-blue-600">    {{ (studentDetails.Total / (studentDetails.SRType === 1 ? 8 : 7)).toFixed(2) }}</p>
              </div>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-md font-semibold text-gray-900">প্রাপ্ত বিভাগ</p>
                <p class="text-lg font-semibold text-blue-600">{{studentDetails.Division}}</p>
              </div>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-900">ছাত্রে ধরন</p>
                <p class="text-lg font-semibold text-blue-600"></p>
              </div>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-900">রিটেক বিষয় সমুহ</p>
                <p class="text-lg font-semibold text-blue-600"></p>
              </div>
            </div>
            <!-- Add more quick stats -->
          </div>
        </div>

        <!-- Update Profile Form -->
        <div class="bg-gradient-to-br from-gray-50 to-gray-200 rounded-2xl shadow-md p-10 max-w-4xl mx-auto">
  <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center border-b-2 pb-4">তথ্য সংশোধন</h2>

  <form @submit.prevent="updateProfile" class="space-y-8">
    <!-- Name Section -->
    <div>
      <label for="name-arabic" class="block text-lg font-medium text-gray-700 mb-2">নাম আরবি</label>
      <input
        id="name-arabic"
        v-model="studentDetails.Name"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <div>
      <label for="name-english" class="block text-lg font-medium text-gray-700 mb-2">নাম ইংরেজি</label>
      <input
        id="name-english"
        v-model="studentDetails.st_en_name"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <!-- Father's Name Section -->
    <div>
      <label for="father-arabic" class="block text-lg font-medium text-gray-700 mb-2">পিতার নাম আরবি</label>
      <input
        id="father-arabic"
        v-model="studentDetails.Father"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <div>
      <label for="father-english" class="block text-lg font-medium text-gray-700 mb-2">পিতার নাম ইংরেজি</label>
      <input
        id="father-english"
        v-model="studentDetails.st_en_Fname"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <!-- Contact and ID Section -->
    <div>
      <label for="mobile-number" class="block text-lg font-medium text-gray-700 mb-2">মোবাইল নম্বর</label>
      <input
        id="mobile-number"
        v-model="studentDetails.mobileNumber"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <div>
      <label for="birth-reg" class="block text-lg font-medium text-gray-700 mb-2">জন্মনিবন্ধ নম্বর</label>
      <input
        id="birth-reg"
        v-model="studentDetails.BirthRegistrationNo_nid_no"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <!-- Additional Details -->
    <div>
      <label for="madrasha-name-en" class="block text-lg font-medium text-gray-700 mb-2">মাদরাসার নাম ইংরেজি</label>
      <input
        id="madrasha-name-en"
        v-model="studentDetails.MadrashaNameEn"
        type="text"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <div>
      <label for="dob" class="block text-lg font-medium text-gray-700 mb-2">জন্ম তারিখ</label>
      <input
        id="dob"
        v-model="studentDetails.DateofBirth"
        type="date"
        required
        class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow focus:ring-blue-400 focus:border-blue-400"
      />
    </div>

    <!-- Submit Button -->
    <div class="text-center pt-6">
      <button
        type="submit"
        :disabled="isLoading"
        class="w-full md:w-auto bg-blue-600 text-white py-3 px-6 rounded-lg font-medium text-lg shadow-md hover:bg-blue-700 transition disabled:opacity-50"
      >
        {{ isLoading ? 'সংরক্ষণ করা হচ্ছে...' : 'সংরক্ষণ করুন' }}
      </button>
    </div>
  </form>
</div>



      </div>
    </div>
  </div>
</div>

  </AuthenticatedLayout>
</template>
