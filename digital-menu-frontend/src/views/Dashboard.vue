<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <Navbar :user="user" @logout="logout" />
    
    <!-- Main Content -->
    <div class="p-1 md:p-6 max-w-full mx-auto">
      <!-- Dashboard Header -->
      <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-2xl shadow-lg p-6 md:p-8 text-white">
          <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
              <h1 class="text-2xl md:text-3xl font-bold mb-2">Dashboard Overview</h1>
              <p class="text-blue-100 opacity-90">Manage your categories, menu items, and share your digital menu</p>
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
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm font-medium">Total Categories</p>
              <p class="text-2xl font-bold text-gray-800 mt-1">{{ stats.totalCategories }}</p>
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
              <p class="text-2xl font-bold text-gray-800 mt-1">{{ stats.totalMenuItems }}</p>
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
              <p class="text-2xl font-bold text-gray-800 mt-1">{{ stats.activeItems }}</p>
            </div>
            <div class="bg-purple-50 p-3 rounded-full">
              <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-amber-500">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-500 text-sm font-medium">Menu Views</p>
              <p class="text-2xl font-bold text-gray-800 mt-1">{{ stats.menuViews }}</p>
            </div>
            <div class="bg-amber-50 p-3 rounded-full">
              <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Public Menu & QR Section -->
      <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-2xl shadow-lg p-6 text-white">
          <div class="flex flex-col md:flex-row md:items-center justify-between space-y-6 md:space-y-0">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-4">
                <div class="bg-white/20 p-2 rounded-lg">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                  </svg>
                </div>
                <div>
                  <h2 class="text-xl font-bold">Share Your Digital Menu</h2>
                  <p class="text-blue-100 opacity-90 text-sm">Share this link or QR code with customers</p>
                </div>
              </div>
              
              <div class="space-y-4">
                <div class="flex items-center space-x-3">
                  <div class="relative flex-1">
                    <input
                      :value="publicMenuUrl"
                      readonly
                      class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent"
                    />
                    <div v-if="copied" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-green-300 text-sm">
                      Copied!
                    </div>
                  </div>
                  <button
                    @click="copyLink"
                    class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-3 rounded-lg font-semibold transition-colors flex items-center space-x-2 min-w-[100px] justify-center"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span>Copy</span>
                  </button>
                  <a
                    :href="publicMenuUrl"
                    target="_blank"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg font-semibold transition-colors flex items-center space-x-2 min-w-[100px] justify-center"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span>Open</span>
                  </a>
                </div>
                <div class="flex items-center space-x-2 text-blue-100 text-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>Scan the QR code or share the link with your customers</span>
                </div>
              </div>
            </div>
            
            <div class="flex-shrink-0">
              <div class="bg-white p-4 rounded-xl shadow-lg">
                <div class="flex flex-col items-center">
                  <QrcodeVue
                    :value="publicMenuUrl"
                    :size="140"
                    level="H"
                    class="mb-2"
                  />
                  <p class="text-xs text-gray-500 text-center mt-2">
                    Scan to view menu
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content Grid -->
      <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-8">
        <!-- Categories Panel -->
        <!-- <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
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
              <div class="text-white">
                <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
                  {{ stats.totalCategories }} categories
                </span>
              </div>
            </div>
          </div> -->
          <div class="p-6">
            <CategoryList @categories-updated="loadStats" />
          </div>
        <!-- </div> -->

        <!-- Menu Items Panel -->
        <!-- <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
          <div class="bg-gradient-to-r from-green-600 to-green-500 p-6">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <div class="bg-white/20 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                  </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Menu Items</h2>
              </div>
              <div class="text-white">
                <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
                  {{ stats.totalMenuItems }} items
                </span>
              </div>
            </div>
          </div> -->
          <div class="p-6">
            <MenuItemList @items-updated="loadStats" />
          </div>
        <!-- </div> -->
      </div>

      <!-- Quick Actions -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center space-x-2">
          <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
          <span>Quick Actions</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <button 
            @click="exportData"
            class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-300 group hover:shadow-md"
          >
            <div class="p-3 bg-blue-100 group-hover:bg-blue-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">Export Data</span>
          </button>
          <button 
            @click="downloadQR"
            class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-300 group hover:shadow-md"
          >
            <div class="p-3 bg-green-100 group-hover:bg-green-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">Download QR</span>
          </button>
          <button 
            @click="viewReports"
            class="flex flex-col items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-xl transition-all duration-300 group hover:shadow-md"
          >
            <div class="p-3 bg-purple-100 group-hover:bg-purple-200 rounded-full mb-3 transition-colors">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
              </svg>
            </div>
            <span class="font-medium text-gray-700">View Reports</span>
          </button>
          <button 
            @click="goToSettings"
            class="flex flex-col items-center justify-center p-4 bg-orange-50 hover:bg-orange-100 rounded-xl transition-all duration-300 group hover:shadow-md"
          >
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
import QrcodeVue from 'qrcode.vue';
import api from '../axios';
import { useRouter } from 'vue-router';
import { ref, onMounted, onUnmounted } from 'vue';

const router = useRouter();
const currentTime = ref('');
const publicMenuUrl = ref('');
const user = ref(null);
const copied = ref(false);
const stats = ref({
  totalCategories: 0,
  totalMenuItems: 0,
  activeItems: 0,
  menuViews: 0
});

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

const loadUser = async () => {
  try {
    const res = await api.get('/user');
    user.value = res.data;
    
    if (user.value && user.value.slug) {
      publicMenuUrl.value = `${window.location.origin}/menu/${user.value.slug}`;
    } else {
      // Fallback to a generic URL or show error
      publicMenuUrl.value = `${window.location.origin}/menu/demo`;
    }
  } catch (error) {
    console.error('Error loading user:', error);
    // Fallback URL
    publicMenuUrl.value = `${window.location.origin}/menu/demo`;
  }
};

const loadStats = async () => {
  try {
    // Load actual stats from API
    const [categoriesRes, itemsRes] = await Promise.all([
      api.get('/categories'),
      api.get('/menu-items')
    ]);
    
    const categories = categoriesRes.data;
    const items = itemsRes.data;
    
    // Calculate total menu items
    let totalItems = 0;
    if (Array.isArray(items)) {
      // If items is a flat array
      totalItems = items.length;
    } else if (Array.isArray(categories)) {
      // If items are grouped by categories
      totalItems = categories.reduce((total, cat) => 
        total + (cat.menu_items?.length || 0), 0
      );
    }
    
    stats.value = {
      totalCategories: categories.length || 0,
      totalMenuItems: totalItems,
      activeItems: totalItems, // You can add an 'is_active' field to items
      menuViews: 0 // You can track this in your backend
    };
  } catch (error) {
    console.error('Error loading stats:', error);
  }
};

const copyLink = async () => {
  try {
    await navigator.clipboard.writeText(publicMenuUrl.value);
    copied.value = true;
    
    // Show success message for 2 seconds
    setTimeout(() => {
      copied.value = false;
    }, 2000);
  } catch (err) {
    console.error('Failed to copy:', err);
    // Fallback for older browsers
    const textArea = document.createElement('textarea');
    textArea.value = publicMenuUrl.value;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand('copy');
    document.body.removeChild(textArea);
    copied.value = true;
    
    setTimeout(() => {
      copied.value = false;
    }, 2000);
  }
};

const exportData = () => {
  alert('Export functionality coming soon!');
  // Implement export logic here
};

const downloadQR = () => {
  alert('QR download functionality coming soon!');
  // Implement QR download logic here
};

const viewReports = () => {
  alert('Reports functionality coming soon!');
  // Implement reports logic here
};

const goToSettings = () => {
  router.push('/settings');
};

let timeInterval;

onMounted(() => {
  updateTime();
  loadUser();
  loadStats();
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