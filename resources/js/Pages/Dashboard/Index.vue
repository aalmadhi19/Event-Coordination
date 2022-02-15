<template>
  <div>
    <Head title="Dashboard" />

    <div className="grid grid-cols-12 gap-6">
      <!-- <Cards :icon="'fa-solid fa-users text-3xl'" :title="'عدد المسجلين'" :value="forms.content[1].count" />
      <Cards :icon="'fa-solid fa-user-group text-3xl'" :title="'عدد الحضور الحالي'" :value="forms.content[1].count" /> -->
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
