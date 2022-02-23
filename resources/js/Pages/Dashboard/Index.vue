<template>
  <div>
    <Head :title="$t('Dashboard')"/>
    <div className="grid grid-cols-12 gap-6">
      <Cards :icon="'fa-solid fa-users text-3xl'" :title=" $t('Total tickets')" :value="tickets.length" />
      <Cards :icon="'fa-solid fa-user-group text-3xl'" :title=" $t('Total visitor at this moment')" :value="ticketsIn" />
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
    tickets: Array,
    ticketsIn: Number,
    ticketsOut: Number,
  },

  created() {
    this.interval = setInterval(() => this.getData(), 5000)
  },

  methods: {
    getData() {
      var currentUrl = window.location.pathname
      if (currentUrl == '/') {
        this.$inertia.reload()
      }
    },
  },
}
</script>
