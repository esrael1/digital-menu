<script setup>
import { ref, onMounted, watch } from "vue";
import axios from "../axios";

/* State */
const categories = ref([]);
const search = ref("");

const form = ref({
  category_id: "",
  item_name: "",
  price: "",
  tax_percentage: ""
});

/* Load items grouped by category */
const loadItems = async () => {
  const res = await axios.get("/menu-items", {
    params: { search: search.value }
  });
  categories.value = res.data;
};

/* Load categories for dropdown */
const loadCategories = async () => {
  const res = await axios.get("/categories");
  categoriesDropdown.value = res.data;
};

/* Dropdown categories */
const categoriesDropdown = ref([]);

/* Add menu item */
const addItem = async () => {
  await axios.post("/menu-items", form.value);

  form.value = {
    category_id: "",
    item_name: "",
    price: "",
    tax_percentage: ""
  };

  loadItems();
};

/* Delete menu item */
const deleteItem = async (id) => {
  if (!confirm("Delete this item?")) return;
  await axios.delete(`/menu-items/${id}`);
  loadItems();
};

/* React to search */
watch(search, loadItems);

/* On load */
onMounted(() => {
  loadItems();
  loadCategories();
});
</script>

<template>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Menu Management</h1>

    <!-- Add Item Form -->
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

    <!-- Search -->
    <input
      v-model="search"
      placeholder="Search items..."
      class="border p-2 rounded w-full mb-6"
    />

    <!-- Items Grouped by Category -->
    <div v-for="cat in categories" :key="cat.id" class="mb-8">
      <h2 class="text-xl font-semibold mb-3">
        {{ cat.name }}
      </h2>

      <div
        v-if="cat.menu_items.length"
        class="space-y-2"
      >
        <div
          v-for="item in cat.menu_items"
          :key="item.id"
          class="flex justify-between items-center border p-3 rounded"
        >
          <div>
            <p class="font-medium">
              {{ item.item_name }}
            </p>
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
