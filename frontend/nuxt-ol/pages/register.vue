<template>
  <div class="d-flex flex-column align-items-center vh-100 vw-100">
    <Navbar></Navbar>
    <div class="w-50 mx-auto">
      <h2 class="text-center mb-5">Register</h2>
      <form @submit.prevent="register">
        <div class="form-group">
          <label for="name">Name</label>
          <input id="name" class="form-control" type="name" v-model="form.name" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" class="form-control" type="email" v-model="form.email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" class="form-control" type="password" v-model="form.password" />
        </div>
        <div class="form-group">
          <label for="password_confirmation">Confirm Password</label>
          <input id="password_confirmation" class="form-control" type="password" v-model="form.password_confirmation" />
        </div>
        <div class="form-group text-center">
          <button class="btn btn-primary mt-3" type="submit">Register</button>
        </div>
      </form>
    </div>
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
        this.$axios.get('/sanctum/csrf-cookie').then(() => {
          this.$axios
            .post('/register', this.form)
            .then(() => {
                // Set token flag and fetch user
                this.$auth.setUserToken(true).then(() => {
                  this.$router.push('/')
                })
            })
            .catch((errors) => {
              // Registration failed
              console.log(errors)
            })
        });
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
