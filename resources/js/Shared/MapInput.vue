<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <GoogleMap api-key="YOUR_GOOGLE_MAPS_API_KEY" style="height: 500px" :center="center" :zoom="15"  v-bind="{ ...$attrs, class: null }" :class="{ error: error }">
      <Marker :options="{ position: center, draggable: true }" @dragend="updateLocation" />
      <CustomControl position="BOTTOM_LEFT">
        <button type="button" class="custom-btn" @click="getLocation()"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
      </CustomControl>
      <Circle :options="getCircle(location)" />
    </GoogleMap>
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script>
import { GoogleMap, Marker, CustomControl, Circle } from 'vue3-google-map'

export default {
  props: {
    error: String,
    label: String,
    modelValue: String,
    preLocation: Object,
  },

  components: { GoogleMap, Marker, CustomControl, Circle },

  emits: ['update:modelValue'],

  data() {
    return {
      location: {},
      center: { lat: 24.7136, lng: 46.6753 },
      radius: 2,
      userLocation: null,
    }
  },

  created() {
    if (this.preLocation) {
      this.location = this.preLocation
    }
  },

  watch: {
    location: {
      handler: function (val) {
        this.setLocation(val)
      },
      deep: true,
    },
  },

  methods: {
    getLocation() {
      navigator.geolocation.getCurrentPosition((position) => {
        this.userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        }
        this.location = this.userLocation
        this.$emit('update:modelValue', JSON.stringify(this.location))
        setTimeout(() => this.$emit('locationChange'), 2000)
      })
    },

    setLocation(location) {
      this.center = location
    },

    updateLocation(location) {
      this.location = {
        lat: location.latLng.lat(),
        lng: location.latLng.lng(),
      }
      this.$emit('update:modelValue', JSON.stringify(this.location))
      setTimeout(() => this.$emit('locationChange'), 3000)
    },

    getCircle(location) {
      var center = {
        center: location,
        radius: Math.sqrt(this.radius) * 100,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        editable: true,
      }
      return center
    },
  },
}
</script>
<style scoped>
.custom-btn {
  box-sizing: border-box;
  background: white;
  height: 50px;
  width: 50px;
  border-radius: 2px;
  border: 0px;
  margin: 10px;
  padding: 0px;
  font-size: 1.25rem;
  text-transform: none;
  appearance: none;
  cursor: pointer;
  user-select: none;
  box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px;
  overflow: hidden;
}
</style>