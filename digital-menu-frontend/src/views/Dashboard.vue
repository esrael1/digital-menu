<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <Navbar @logout="logout" />
    
    <!-- Main Content -->
    <div class="p-4 md:p-6 max-w-7xl mx-auto">
      <!-- Dashboard Header -->
      <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-2xl shadow-lg p-6 md:p-8 text-white">
          <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
              <h1 class="text-2xl md:text-3xl font-bold mb-2">Dashboard Overview</h1>
              <p class="text-blue-100 opacity-90">Manage your categories and menu items</p>
            </div>
            <div class="mt-4 md:mt-0">
              <div class="flex items-center space-x-4">
                <div class="text-right">
                  <p class="text-sm text-blue-100 opacity-90">Last Updated</p>
                  <p class="font-semibold">{{ currentTime }}</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm font-medium">Total Categories</p>
              <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
            </div>
            <div class="bg-blue-50 p-3 rounded-full">
              <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm font-medium">Total Menu Items</p>
              <p class="text-2xl font-bold text-gray-800 mt-1">48</p>
            </div>
            <div class="bg-green-50 p-3 rounded-full">
              <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm font-medium">Active Items</p>
              <p class="text-2xl font-bold text-gray-800 mt-1">42</p>
            </div>
            <div class="bg-purple-50 p-3 rounded-full">
              <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Categories Panel -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <div class="bg-white/20 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                  </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Categories</h2>
              </div>
              <button class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-semibold transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Add New</span>
              </button>
            </div>
          </div>
          <div class="p-6">
            <CategoryList />
          </div>
        </div>

        <!-- Menu Items Panel -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-green-600 to-green-500 p-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <div class="bg-white/20 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                  </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Menu Items</h2>
              </div>
              <button class="bg-white text-green-600 hover:bg-green-50 px-4 py-2 rounded-lg font-semibold transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Add Item</span>
              </button>
            </div>
          </div>
          <div class="p-6">
            <MenuItemList />
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          <span>Quick Actions</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <button class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors group">
            <div class="p-3 bg-blue-100 group-hover:bg-blue-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">Export Data</span>
          </button>
          <button class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-colors group">
            <div class="p-3 bg-green-100 group-hover:bg-green-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">Edit Bulk</span>
          </button>
          <button class="flex flex-col items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-colors group">
            <div class="p-3 bg-purple-100 group-hover:bg-purple-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">View Reports</span>
          </button>
          <button class="flex flex-col items-center justify-center p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-colors group">
            <div class="p-3 bg-orange-100 group-hover:bg-orange-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">Settings</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Navbar from '../components/Navbar.vue';
import CategoryList from '../components/CategoryList.vue';
import MenuItemList from '../components/MenuItemList.vue';
import api from '../axios';
import { useRouter } from 'vue-router';
import { ref, onMounted, onUnmounted } from 'vue';

const router = useRouter();
const currentTime = ref('');

const updateTime = () => {
  const now = new Date();
  currentTime.value = now.toLocaleString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
};

let timeInterval;

onMounted(() => {
  updateTime();
  timeInterval = setInterval(updateTime, 60000); // Update every minute
});

onUnmounted(() => {
  if (timeInterval) clearInterval(timeInterval);
});

const logout = async () => {
  try {
    await api.post('/logout');
    localStorage.removeItem('token');
    delete api.defaults.headers.common['Authorization'];
    router.push('/');
  } catch (error) {
    console.error('Logout error:', error);
    // Still remove token and redirect even if API call fails
    localStorage.removeItem('token');
    delete api.defaults.headers.common['Authorization'];
    router.push('/');
  }
};
</script>