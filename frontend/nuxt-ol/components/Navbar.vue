<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light px-3 w-100 mb-3">
    <div class="container-fluid">
      <router-link class="navbar-brand mb-0 h1" to="/">Survey App</router-link>
    </div>
    <ul class="navbar-nav ms-3 ms-lg-0">
      <li class="nav-item" v-if="!$auth.loggedIn">
        <router-link class="nav-link" to="/login">Login</router-link>
      </li>
      <li class="nav-item" v-if="!$auth.loggedIn">
        <router-link class="nav-link" to="/register">Register</router-link>
      </li>
      <li class="nav-item" v-if="$auth.loggedIn">
        <router-link class="nav-link" to="/survey">Survey</router-link>
      </li>
      <li class="nav-item" v-if="$auth.loggedIn">
        <router-link class="nav-link" to="/results">Results</router-link>
      </li>
      <li class="nav-item dropdown" v-if="$auth.loggedIn">
        <button class="btn btn-danger ms-lg-3" href="#" @click="logout">Logout</button>
      </li>
    </ul>
  </nav>
</template>

<script lang="ts">
import Vue from 'vue'

export default Vue.extend({
  name: 'Navbar',
  methods: {
    async logout() {
      await this.$auth.logout();
    }
  }
})
</script>
