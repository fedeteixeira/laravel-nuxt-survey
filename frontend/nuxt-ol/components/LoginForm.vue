<template>
  <div>
    <form @submit.prevent="onSubmit">
      <label>
        Email:
        <input type="email" v-model="email" />
      </label>
      <br />
      <label>
        Password:
        <input type="password" v-model="password" />
      </label>
      <br />
      <button type="submit">Submit</button>
    </form>
  </div>
</template>


<script lang="ts">
import { defineComponent } from 'vue'
import { mapActions, mapState } from 'vuex'

export default defineComponent({
    name: "LoginForm",
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        ...mapActions(['submitLoginForm']),
        onSubmit() {
            this.submitLoginForm({email: this.email, password: this.password});
        }
    }
})
</script>
