<script setup>
import { ref, onMounted } from "vue";
import axios from "../axios";

const categories = ref([]);
const form = ref({
  name: "",
  description: ""
});

const loading = ref(false);
const error = ref(null);
const success = ref(null);

const loadCategories = async () => {
  loading.value = true;
  error.value = null;

  try {
    const res = await axios.get("/categories");
    categories.value = res.data;
  } catch (err) {
    error.value = err.response?.data?.message || "Failed to load categories";
  } finally {
    loading.value = false;
  }
};

const addCategory = async () => {
  if (!form.value.name) {
    error.value = "Category name is required";
    return;
  }

  error.value = null;
  success.value = null;

  try {
    await axios.post("/categories", form.value);
    success.value = "Category added successfully";
    form.value.name = "";
    form.value.description = "";
    loadCategories();
  } catch (err) {
    error.value = err.response?.data?.message || "Failed to add category";
  }
};

const deleteCategory = async (id) => {
  if (!confirm("Delete this category?")) return;

  try {
    await axios.delete(`/categories/${id}`);
    loadCategories();
  } catch (err) {
    error.value = err.response?.data?.message || "Delete failed";
  }
};

onMounted(loadCategories);
</script>

<template>
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Menu Categories</h1>

    <!-- Error -->
    <div v-if="error" class="bg-red-100 text-red-700 p-2 mb-3 rounded">
      {{ error }}
    </div>

    <!-- Success -->
    <div v-if="success" class="bg-green-100 text-green-700 p-2 mb-3 rounded">
      {{ success }}
    </div>

    <!-- Add Category -->
    <div class="mb-4 space-y-2">
      <input
        v-model="form.name"
        placeholder="Category Name"
        class="border p-2 w-full rounded"
      />
      <textarea
        v-model="form.description"
        placeholder="Description (optional)"
        class="border p-2 w-full rounded"
      ></textarea>
      <button
        @click="addCategory"
        class="bg-green-600 text-white px-4 py-2 rounded w-full"
      >
        Add Category
      </button>
    </div>

    <!-- Loading -->
    <div v-if="loading" class="text-gray-500">Loading...</div>

    <!-- Category List -->
    <ul v-else>
      <li
        v-for="c in categories"
        :key="c.id"
        class="flex justify-between items-center border p-2 mb-2 rounded"
      >
        <div>
          <p class="font-semibold">{{ c.name }}</p>
          <p class="text-sm text-gray-600">{{ c.description }}</p>
        </div>

        <button
          @click="deleteCategory(c.id)"
          class="text-red-600 hover:underline"
        >
          Delete
        </button>
      </li>
    </ul>
  </div>
</template>
