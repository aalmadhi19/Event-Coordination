<template>
  <div>
    <Head title="Dashboard" />
    <div className="grid grid-cols-12 gap-6">
      <Cards :icon="'fa-solid fa-users text-3xl'" :title="'Total ticket'" :value="tickets.length" />
      <Cards :icon="'fa-solid fa-user-group text-3xl'" :title="'Total visitor at this moment'" :value="ticketsIn" />
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

  },


  methods: {

  },
}
</script>
