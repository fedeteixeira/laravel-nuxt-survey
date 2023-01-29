<template>
  <div>
    <form @submit.prevent="userLogin">
      <div>
        <label>email</label>
        <input id="email" type="email" v-model="login.email" />
      </div>
      <div>
        <label>Password</label>
        <input id="password" type="password" v-model="login.password" />
      </div>
      <div>
        <button type="submit">Submit</button>
      </div>
    </form>
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
