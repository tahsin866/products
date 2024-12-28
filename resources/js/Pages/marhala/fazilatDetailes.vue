<script setup>
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, computed } from 'vue';

const { props } = usePage();
const studentDetails = props.studentDetails || {};
const error = props.error || null;

// Add loading state
const isLoading = ref(false);

// Handle profile update
const updateProfile = async () => {
  isLoading.value = true;
  setTimeout(() => {
    isLoading.value = false;
  }, 1000);
};

// Subject lists
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

const femaleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الثاني)' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'عقيدة الطحاوي' }
];

// Get subjects based on SRType
const currentSubjects = computed(() => {
    return studentDetails.SRType === 0 ? femaleSubjects : maleSubjects;
});

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
});


const getGrade = (marks) => {
    if (!marks) return 'N/A';
    const numericMarks = Number(marks);
    if (numericMarks >= 80) return 'A+';
    if (numericMarks >= 70) return 'A';
    if (numericMarks >= 60) return 'A-';
    if (numericMarks >= 50) return 'B';
    return 'F';
};
</script>


<template>
  <AuthenticatedLayout>
    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50 py-12">
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
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-sm p-8 border border-gray-100">
  <div class="flex items-center justify-between mb-8">
    <div class="flex items-center space-x-3">
      <div class="w-1 h-8 bg-blue-600 rounded-full"></div>
      <h2 class="text-2xl font-bold text-gray-800">ব্যাক্তিগত তথ্য</h2>
    </div>
    <button class="p-2 bg-blue-50 rounded-lg text-blue-600 hover:bg-blue-100 transition-all">
  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2zm0 2v12h12V6H6zm3 4h6v2H9z" />
  </svg>
</button>

  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-blue-50 rounded-lg">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">নাম আরবি</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Name }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-green-50 rounded-lg">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">নাম বাংলা</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Name }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-purple-50 rounded-lg">
          <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">নাম ইংরেজি</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.st_en_name }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-red-50 rounded-lg">
          <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">পিতার নাম আরবি</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Father }}</p>
        </div>

      </div>
    </div>


    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-red-50 rounded-lg">
          <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">পিতার নাম বাংলা</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Father }}</p>
        </div>

      </div>
    </div>


    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-red-50 rounded-lg">
          <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">পিতার নাম ইংরেজি</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Father }}</p>
        </div>

      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-yellow-50 rounded-lg">
          <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">রোল নম্বর</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Roll }}</p>
        </div>
      </div>
    </div>


    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-yellow-50 rounded-lg">
          <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">জন্ম-তারিখ</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.DateofBirth }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-4 rounded-lg border border-gray-100 hover:shadow-md transition-all">
      <div class="flex items-start space-x-3">
        <div class="p-2 bg-indigo-50 rounded-lg">
          <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
        </div>
        <div>
          <p class="text-md font-semibold text-gray-500">জাতিয়তা</p>
          <p class="font-medium text-gray-800 mt-1">{{ studentDetails.Nationality }}</p>
        </div>
      </div>
    </div>
  </div>
</div>


        <!-- Academic Performance Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-6">Academic Performance</h2>

          <div class="overflow-x-auto">
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
      {{ studentResults[`SubValue_${index + 1}`] || 'N/A' }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-center text-xl font-medium text-green-600">
      {{ getGrade(studentResults[`SubValue_${index + 1}`]) }}
    </td>
  </tr>
</tbody>

    <tfoot>
      <tr class="bg-gray-50">
        <td colspan="3" class="px-6 py-4 text-right text-xl font-bold text-gray-700">মোট</td>
        <td class="px-6 py-4 text-center text-xl font-bold text-blue-600">{{ studentDetails.Total }}</td>
        <td class="px-6 py-4 text-center text-xl font-bold text-green-600">{{ studentDetails.Division }}</td>
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
                <p class="text-lg font-semibold text-blue-600">95%</p>
              </div>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
              <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
              </div>
              <div class="ml-4">
                <p class="text-sm font-medium text-gray-900">Attendance</p>
                <p class="text-lg font-semibold text-blue-600">95%</p>
              </div>
            </div>
            <!-- Add more quick stats -->
          </div>
        </div>

        <!-- Update Profile Form -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <h2 class="text-xl font-semibold text-gray-800 mb-6">Update Profile</h2>
          <form @submit.prevent="updateProfile" class="space-y-4">
            <div>
              <label class="block text-md font-semibold  text-gray-700">নাম আরবি</label>
              <input
                v-model="studentDetails.Name"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Full Name</label>
              <input
                v-model="studentDetails.Father"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Address</label>
              <textarea
                v-model="studentDetails.Roll"
                rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              ></textarea>
            </div>
            <button
              type="submit"
              :disabled="isLoading"
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
              <svg v-if="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ isLoading ? 'Saving...' : 'Save Changes' }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  </AuthenticatedLayout>
</template>
