<template>
  <div>
    <form @submit.prevent="register">

      <label for="name">Name:</label>
      <input type="text" id="name" v-model="form.name" />
      <br />

      <label for="email">Email:</label>
      <input type="email" id="email" v-model="form.email" />
      <br />
      
      <label for="password">Password:</label>
      <input type="password" id="password" v-model="form.password" />
      <br />

      <label for="password_confirmation">Password confirmation:</label>
      <input type="password" id="password_confirmation" v-model="form.password_confirmation" />
      <br />
      
      <button type="submit">Register</button>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  middleware: 'auth',
  auth : 'guest',
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    async register() {
      try {
        this.$axios.post(`${this.$config.apiUrl}/register`, this.form).then((response) => {
          this.$auth.loginWith('laravelSanctum', { data: this.form });
        })
      } catch (error) {
        console.log(error)
      }
    }
  },
  mounted() {
    console.log(this.$config.apiUrl)
  },
})
</script>
