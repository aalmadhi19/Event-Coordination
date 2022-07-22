<template>
  <img :width="width" :height="height" :src="$page.props.logo" class="custom-logo" alt="Event-Coordination" loading="lazy" />
</template>
<script>

export default {
  props: {
    width: String,
    height: String,
  },
}
</script>
