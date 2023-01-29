<template>
  <div>
    <router-link to="/login">Login</router-link>
    <router-link to="/register">Register</router-link>
    <button @click="logout">Logout</button>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
  name: 'IndexPage',
  methods: {
    async logout() {
      await this.$auth.logout();
    }
  }
})
</script>
