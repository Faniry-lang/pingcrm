<template>
  <div>
    <Head :title="`Edit ${category.name}`" />
    <h1 class="mb-8 text-3xl font-bold">Edit Category</h1>

    <form @submit.prevent="submit" class="bg-white rounded-md shadow p-6 max-w-xl">
      <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input v-model="form.name" class="form-input mt-1 block w-full" />
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Slug</label>
        <input v-model="form.slug" class="form-input mt-1 block w-full" />
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
        <Link href="/" class="text-sm text-gray-600">Cancel</Link>
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
    category: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: this.category.id,
        name: this.category.name,
        slug: this.category.slug,
        description: this.category.description,
        is_active: this.category.is_active,
        color: this.category.color,
      }),
    }
  },
  methods: {
    submit() {
      this.form.put(`/categories/${this.form.id}`)
    },
  },
}
</script>
