<template>
  <div class="d-flex flex-column align-items-center vh-100 vw-100">
    <Navbar></Navbar>
    <div class="w-50 mx-auto">
      <h2 class="text-center mb-5">Login</h2>
      <form @submit.prevent="userLogin">
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" class="form-control" type="email" v-model="login.email" />
        </div>
        <div class="form-group mt-3">
          <label for="password">Password</label>
          <input id="password" class="form-control" type="password" v-model="login.password" />
        </div>
        <div class="form-group text-center">
          <button class="btn btn-primary mt-3" type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'


export default defineComponent ({
  middleware: 'auth',
  auth : 'guest',
  data() {
    return {
      login: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async userLogin() {
      try {
        await this.$auth.loginWith('laravelSanctum', { data: this.login });
      } catch (err) {
        console.log(err)
      }
    }
  },
})
</script>
