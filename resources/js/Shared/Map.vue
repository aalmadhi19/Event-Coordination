<template>
  <div id="map" style="width: 100%; height: 100px"></div>
</template>

<script>
import Echo from 'laravel-echo'
import * as Pusher from 'pusher-js'

const PUSHER_API_KEY = '84b413581470d82d34e5'
const PUSHER_CLUSTER = 'ap2'

export default {
  props: {
    preLocation: Object,
  },

  data() {
    return {
      data: '',
      map: '',
      marker: '',
      lat: 9.082,
      long: 8.6753,
      lineCoordinates: [],
      userlong: '',
      userlat: '',
    }
  },
  created() {
    if (this.preLocation) {
      this.lat = this.preLocation.lat,
      this.long = this.preLocation.long
    }
  },

  mounted() {
    this.subscribe()
    this.launchMap(this.lat,this.long)
    this.getLocation()
  },

  methods: {
    launchMap(lat, lng) {
      var center = { lat: lat, lng: lng }
      this.map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: center,
      })
      this.marker = new google.maps.Marker({
        map: this.map,
        animation: 'bounce',
        position: center,
      })

      this.lineCoordinates.push(new google.maps.LatLng(this.lat, this.long))
    },

    subscribe() {
      var echo = new Echo({
        broadcaster: 'pusher',
        key: PUSHER_API_KEY,
        cluster: PUSHER_CLUSTER,
      })
      echo.channel('location').listen('SendLocation', (e) => {
        this.data = e.location
        this.updateMap(this.data)
      })
    },

    updateMap(data) {
      this.lat = parseFloat(data.lat)
      this.long = parseFloat(data.long)

      this.map.setCenter({ lat: this.lat, lng: this.long, alt: 0 })
      this.marker.setPosition({ lat: this.lat, lng: this.long, alt: 0 })

      this.lineCoordinates.push(new google.maps.LatLng(this.lat, this.long))

      var lineCoordinatesPath = new google.maps.Polyline({
        path: this.lineCoordinates,
        geodesic: true,
        map: this.map,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2,
      })
    },

    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          (position) => {
            this.userlong = position.coords.latitude
            this.userlat = position.coords.longitude
          },
          (error) => {
            console.log(error.message)
          },
        )
      }
    },
  },
}
</script>
