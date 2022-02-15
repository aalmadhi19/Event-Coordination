<template>
 <img :width="width" :height="height" :src="src" alt="Image">
</template>
<script>
export default {
  props: {
    name: String,
  },
}
</script>
