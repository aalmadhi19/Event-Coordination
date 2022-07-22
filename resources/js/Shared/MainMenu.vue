<template>
  <div v-if="$page.props.auth.user.role == 'Admin'">
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Dashboard') }}</div>
      </Link>
    </div>

    <dropdown placement="bottom-end" :class="isDropdown ? 'mb-28' : 'mb-4'">
      <template #default>
        <div>
          <div class="group flex items-center py-3 cursor-pointer select-none">
            <icon name="coordinate" class="mr-2 w-4 h-4" :class="isUrl('coordinate') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
            <span :class="isUrl('coordinate') ? 'text-white' : 'text-indigo-300 group-hover:text-white'"> {{ $t('Coordinate') }}</span> <icon class="w-5 h-5 fill-gray-200 fill-indigo-400 group-hover:fill-white" name="cheveron-down" />
          </div>
        </div>
      </template>
      <template #dropdown>
        <Link class="group flex items-center py-3" href="/coordinate/login">
          <icon name="login" class="mr-2 w-4 h-4" :class="isUrl('/coordinate/login') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
          <div :class="isUrl('/coordinate/login') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Login Gate') }}</div>
        </Link>
        <Link class="group flex items-center py-3" href="/coordinate/logout">
          <icon name="logout" class="mr-2 w-4 h-4" :class="isUrl('/coordinate/logout') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
          <div :class="isUrl('/coordinate/logout') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Logout Gate') }}</div>
        </Link>
      </template>
    </dropdown>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/users">
        <icon name="users" class="mr-2 w-4 h-4" :class="isUrl('users') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('users') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Users') }}</div>
      </Link>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/forms">
        <icon name="form" class="mr-2 w-4 h-4" :class="isUrl('forms') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('forms') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Forms') }}</div>
      </Link>
    </div>

    <!-- <div class="mb-4">
      <Link class="group flex items-center py-3" href="/settings">
        <icon name="gear" class="mr-2 w-4 h-4" :class="isUrl('settings') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('settings') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Settings') }}</div>
      </Link>
    </div> -->
  </div>

  <div v-else>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/tickets">
        <icon name="ticket" class="mr-2 w-4 h-4" :class="isUrl('tickets') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('tickets') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ $t('Tickets') }}</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Dropdown from '@/Shared/Dropdown'
import Icon from '@/Shared/Icon'

export default {
  components: {
    Dropdown,
    Icon,
    Link,
  },
  props: {
    user: Object,
  },
  data() {
    return {
      isDropdown: false,
    }
  },

  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
