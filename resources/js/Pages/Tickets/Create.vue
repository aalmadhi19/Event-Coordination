<template>
  <div>
    <Head title="Tickets"/>
    <div>
    </div>

  </div>

</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Cards from '@/Shared/Cards'

export default {
  components: {
    Head,
    Link,
    Cards,
  },
  layout: Layout,
  props: {
    form: String,
  },
  mounted() {

  },

  methods: {
    getForm() {

    },
  },

}
</script>
