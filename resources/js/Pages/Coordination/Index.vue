<template>
  <div>
    <Head title="Coordination" />
    <h1 class="mb-8 text-3xl font-bold">Coordination</h1>

    <div className="grid grid-cols-12 gap-6">
      <Cards :icon="'fa-solid fa-right-to-bracket'" :title="'Login'" link="/coordinate/login" />
      <Cards :icon="'fa-solid fa-right-to-bracket'" :title="'Logout'" link="/coordinate/logout" />
    </div>
  </div>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Cards from '@/Shared/Cards'

export default {
  components: {
    Head,
    Cards,
  },
  layout: Layout,
  props: {
    forms: Array,
  },
}
</script>
