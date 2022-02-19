<template>
  <div className="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
    <Link :href="link" tabindex="-1">
      <div className="px-5 pt-5">
        <header className="flex justify-between items-start mb-2">
          <i :class="icon"></i>
          <h2 className="text-lg font-semibold text-slate-800 mb-2">{{ title }}</h2>
        </header>
        <div className="text-center">
          <div className="text-3xl font-bold 0 mr-2 text-center">{{ value }}</div>
        </div>
      </div>
    </Link>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    icon: String,
    title: String,
    value: [String, Number],
    link: String,
  },
}
</script>
