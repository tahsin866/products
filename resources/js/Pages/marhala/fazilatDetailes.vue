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
    router.put(route('marhala.update'), studentDetails, {
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
</script>


<template>
  <AuthenticatedLayout>


    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50 py-12">
        <PrimaryButton class="mx-5 mb-3" @click="$inertia.get(route('marhala.fazilat'))">
    BACK
</PrimaryButton>

  <div class="max-w-full  mx-5">
    <!-- Profile Header Card -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8">
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

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left Column -->
      <div class="lg:col-span-2 space-y-8">
        <!-- Personal Details Card -->
        <div class=" bg-white p-6 rounded-lg">
    <div class="border-b pb-4 mb-6">
      <h2 class="text-2xl font-bold text-gray-900">ব্যাক্তিগত তথ্য</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Name Section -->
      <div class="space-y-4">
        <div class="bg-gray-50 p-4 rounded-lg">
          <label class="block text-md font-semibold text-gray-600 mb-1">নাম আরবি</label>
          <div class="text-lg font-medium text-gray-900">{{ studentDetails.Name }}</div>
        </div>



        <div class="bg-gray-50 p-4 rounded-lg">
          <label class="block text-md font-semibold text-gray-600 mb-1">নাম ইংরেজি</label>
          <div class="text-lg font-medium text-gray-900">{{ studentDetails.st_en_name }}</div>
        </div>
      </div>

      <!-- Father's Name Section -->
      <div class="space-y-4">
        <div class="bg-gray-50 p-4 rounded-lg">
          <label class="block text-md font-semibold text-gray-600 mb-1">পিতার নাম আরবি</label>
          <div class="text-lg font-medium text-gray-900">{{ studentDetails.Father }}</div>
        </div>



        <div class="bg-gray-50 p-4 rounded-lg">
          <label class="block text-md font-semibold text-gray-600 mb-1">পিতার নাম ইংরেজি</label>
          <div class="text-lg font-medium text-gray-900">{{ studentDetails.st_en_Fname }}</div>
        </div>
      </div>

      <!-- Additional Info Section -->
      <div class="space-y-4 md:col-span-2">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="bg-gray-50 p-4 rounded-lg">
            <label class="block text-md font-semibold text-gray-600 mb-1">রোল নম্বর</label>
            <div class="text-lg font-medium text-gray-900">{{ studentDetails.Roll }}</div>
          </div>


          <div class="bg-gray-50 p-4 rounded-lg">
            <label class="block text-md font-semibold text-gray-600 mb-1">জন্ম-তারিখ</label>
            <div class="text-lg font-medium text-gray-900">{{ studentDetails.DateofBirth }}</div>
          </div>

          <div class="bg-gray-50 p-4 rounded-lg">
            <label class="block text-md font-semibold text-gray-600 mb-1">জাতিয়তা</label>
            <div class="text-lg font-medium text-gray-900">{{ studentDetails.Nationality }}</div>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg">
            <label class="block text-md font-semibold text-gray-600 mb-1">মোবাইল নম্বর</label>
            <div class="text-lg font-medium text-gray-900">{{ studentDetails.mobileNumber }}</div>
          </div>
           <div class="bg-gray-50 p-4 rounded-lg">
            <label class="block text-md font-semibold text-gray-600 mb-1">জন্মনিবন্ধন নম্বর</label>
            <div class="text-lg font-medium text-gray-900">{{ studentDetails.BirthRegistrationNo_nid_no }}</div>
          </div>
          <div class="bg-gray-50 p-4 rounded-lg">
            <label class="block text-md font-semibold text-gray-600 mb-1">হিজরি সন</label>
            <div class="text-lg font-medium text-gray-900">{{ studentDetails.Hijri_years }} হি:</div>
          </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
          <label class="block text-md font-semibold text-gray-600 mb-1">মাদরাসার নাম</label>
          <div class="text-lg font-medium text-gray-900">{{ studentDetails.Madrasha }}</div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg">
          <label class="block text-md font-semibold text-gray-600 mb-1">মাদরাসার নাম ইংরেজি</label>
          <div class="text-lg font-medium text-gray-900">{{ studentDetails.MadrashaNameEn }}</div>
        </div>
      </div>
    </div>
  </div>


        <!-- Academic Performance Card -->
        <div class="bg-white  shadow-lg p-8">
  <div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-gray-800">মার্কশীট</h2>
    <div class="flex items-center space-x-2">
      <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium">
        শিক্ষাবর্ষ {{ studentDetails.years }}
      </span>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full">
      <thead>
        <tr class="bg-gradient-to-r from-blue-50 to-indigo-50">
          <th class="px-8 py-5 text-lg font-semibold text-gray-600 text-center rounded-tl-xl">ক্রমিক</th>
          <th class="px-8 py-5 text-lg font-semibold text-gray-600 text-center">বিষয়</th>
          <th class="px-8 py-5 text-lg font-semibold text-gray-600 text-center">পূর্ণ নম্বর</th>
          <th class="px-8 py-5 text-lg font-semibold text-gray-600 text-center">প্রাপ্ত নম্বর</th>
          <th class="px-8 py-5 text-lg font-semibold text-gray-600 text-center rounded-tr-xl">প্রাপ্ত বিভাগ</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(subject, index) in currentSubjects"
            :key="index"
            class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors duration-200">
          <td class="px-8 py-6 text-center text-lg text-gray-600">
            <span class="bg-gray-100 px-3 py-1 rounded-full">{{ index + 1 }}</span>
          </td>
          <td class="px-8 py-6 text-center text-lg font-medium text-gray-800">{{ subject.name }}</td>
          <td class="px-8 py-6 text-center text-lg text-gray-600">
            <span class="bg-blue-50 px-4 py-1 rounded-lg">১০০</span>
          </td>
          <td class="px-8 py-6 text-center text-lg">
            <span class="font-medium text-blue-600 bg-blue-50 px-4 py-1 rounded-lg">
              {{ studentResults[`SubValue_${index + 1}`] || 'N/A' }}
            </span>
          </td>
          <td class="px-8 py-6 text-center text-lg">
            <span :class="{
              'px-4 py-1 rounded-lg font-medium': true,
              'bg-green-50 text-green-600': getGrade(studentResults[`SubValue_${index + 1}`]) !== 'F',
              'bg-red-50 text-red-600': getGrade(studentResults[`SubValue_${index + 1}`]) === 'F'
            }">
              {{ getGrade(studentResults[`SubValue_${index + 1}`]) }}
            </span>
          </td>
        </tr>
      </tbody>

      <tfoot>
        <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
          <td colspan="3" class="px-8 py-6 text-right text-xl font-bold text-gray-700">মোট</td>
          <td class="px-8 py-6 text-center">
            <span class="text-xl font-bold text-blue-600 bg-blue-50 px-6 py-2 rounded-lg">
              {{ studentDetails.Total }}
            </span>
          </td>
          <td class="px-8 py-6 text-center">
            <span class="text-xl font-bold text-green-600 bg-green-50 px-6 py-2 rounded-lg">
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
