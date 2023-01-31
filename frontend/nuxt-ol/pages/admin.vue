<template>
  <div class="d-flex flex-column align-items-center vh-100 vw-100">
    <Navbar></Navbar>
    <div class="w-100 mx-auto p-5">
      <h5 class="mb-5">Registered users that haven't submitted the survey</h5>
      <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in unsubmitted" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.email }}</td>
        </tr>
        </tbody>
    </table>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'


export default defineComponent ({
  middleware: 'admin',

  computed: {
    unsubmitted() {
      return this.$store.state.unsubmitted;
    },
  },

  mounted() {
    this.$store.dispatch('fetchUnsubmitted')
  },
})
</script>
