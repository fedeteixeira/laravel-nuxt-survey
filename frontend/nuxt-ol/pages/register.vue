<template>
  <form @submit.prevent="onSubmit">
    <label for="email">Email:</label>
    <input id="email" v-model="email" type="email" required />
    <label for="password">Password:</label>
    <input id="password" v-model="password" type="password" required />
    <button type="submit">Register</button>
  </form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  data() {
    return {
      email: "",
      password: ""
    }
  },
  methods: {
    onSubmit() {
      this.$store.dispatch("submitRegisterForm", { email: this.email, password: this.password }) 
    }
  }
})
</script>
