<template>
  <div>
    <Head title="Edit Product" />
    <h1 class="mb-8 text-3xl font-bold">Edit Product</h1>

    <form @submit.prevent="submit" class="bg-white rounded-md shadow p-6 max-w-xl">
      <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input v-model="form.name" class="form-input mt-1 block w-full" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Price</label>
        <input v-model="form.price" type="number" step="0.01" class="form-input mt-1 block w-full" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Category</label>
        <select v-model="form.category_id" class="form-select mt-1 block w-full">
          <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
        </select>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Description</label>
        <textarea v-model="form.description" class="form-textarea mt-1 block w-full" rows="4"></textarea>
      </div>

      <div class="mb-4 flex items-center">
        <input type="checkbox" v-model="form.is_active" id="is_active" class="mr-2" />
        <label for="is_active" class="text-gray-700">Active</label>
      </div>

      <div class="flex items-center">
        <button class="btn-indigo mr-3">Save</button>
        <Link href="/products" class="text-sm text-gray-600">Cancel</Link>
      </div>
    </form>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'

export default {
  components: { Head, Link },
  layout: Layout,
  props: {
    product: Object,
    categories: Array,
  },
  data() {
    return {
      categories: this.categories || [],
      form: this.$inertia.form({
        name: this.product.name,
        price: this.product.price,
        category_id: this.product.category_id,
        description: this.product.description,
        is_active: this.product.is_active,
      }),
    }
  },
  methods: {
    submit() {
      this.form.put(`/products/${this.product.id}`)
    },
  },
}
</script>
