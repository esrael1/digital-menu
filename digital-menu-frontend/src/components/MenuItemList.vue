<script setup>
import { ref, onMounted, watch, nextTick } from "vue";
import axios from "../axios";

const categories = ref([]);
const categoriesDropdown = ref([]);
const search = ref("");

const form = ref({
  category_id: "",
  item_name: "",
  price: "",
  tax_percentage: "",
});

/* FORCE REACTIVE UPDATE */
const loadItems = async () => {
  const res = await axios.get("/menu-items", {
    params: { search: search.value },
  });

  console.log("API DATA:", res.data);

  // 🔥 FORCE Vue to detect change
  categories.value = [...res.data];

  await nextTick();
};

const loadCategories = async () => {
  const res = await axios.get("/categories");
  categoriesDropdown.value = [...res.data];
};

const addItem = async () => {
  await axios.post("/menu-items", form.value);

  form.value = {
    category_id: "",
    item_name: "",
    price: "",
    tax_percentage: "",
  };

  loadItems();
};

const deleteItem = async (id) => {
  await axios.delete(`/menu-items/${id}`);
  loadItems();
};

watch(search, loadItems);

onMounted(() => {
  loadItems();
  loadCategories();
});
</script>

<template>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Menu Management</h1>

    <!-- =====================
         ADD ITEM FORM
    ====================== -->
    <div class="grid grid-cols-5 gap-3 mb-6">
      <select v-model="form.category_id" class="border p-2 rounded">
        <option value="">Select Category</option>
        <option
          v-for="c in categoriesDropdown"
          :key="c.id"
          :value="c.id"
        >
          {{ c.name }}
        </option>
      </select>

      <input
        v-model="form.item_name"
        placeholder="Item name"
        class="border p-2 rounded"
      />

      <input
        v-model="form.price"
        type="number"
        placeholder="Price"
        class="border p-2 rounded"
      />

      <input
        v-model="form.tax_percentage"
        type="number"
        placeholder="Tax %"
        class="border p-2 rounded"
      />

      <button
        @click="addItem"
        class="bg-green-600 text-white rounded px-4"
      >
        Add
      </button>
    </div>

    <!-- =====================
         SEARCH
    ====================== -->
    <input
      v-model="search"
      placeholder="Search items..."
      class="border p-2 rounded w-full mb-6"
    />

    <!-- =====================
         ITEMS BY CATEGORY
    ====================== -->
    <div v-for="cat in categories" :key="cat.id" class="mb-8">
      <h2 class="text-xl font-semibold mb-3">
        {{ cat.name }}
      </h2>

      <div
        v-if="cat.menu_items && cat.menu_items.length"
        class="space-y-2"
      >
        <div
          v-for="item in cat.menu_items"
          :key="item.id"
          class="flex justify-between items-center border p-3 rounded"
        >
          <div>
            <p class="font-medium">{{ item.item_name }}</p>
            <p class="text-sm text-gray-500">
              Price: {{ item.price }} |
              Tax: {{ item.tax_percentage }}% |
              Final: {{ item.final_price }}
            </p>
          </div>

          <button
            @click="deleteItem(item.id)"
            class="text-red-600 hover:underline"
          >
            Delete
          </button>
        </div>
      </div>

      <p v-else class="text-gray-400 text-sm">
        No items in this category
      </p>
    </div>
  </div>
</template>
