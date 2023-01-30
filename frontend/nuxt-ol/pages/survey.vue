<template>
  <div>
    <Navbar></Navbar>
    <div class="container-fluid mb-3">
      <form @submit.prevent="onSubmit" class="d-flex flex-column align-items-center">
        <div v-for="(question, index) in questions" :key="question.id" class="my-3">
          <h5 class="text-center">{{ `${index+1}. ${question.title}` }}</h5>
          <div class="text-center">
            <div class="form-check form-check-inline" v-for="value in values" :key="value">
              <input class="form-check-input" type="radio" :name="'question' + question.id" v-model="answers[question.id]" :value="value" id="value"> 
              <label class="form-check-label" for="value">{{ value }}</label>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { mapActions, mapState } from 'vuex';

interface Data {
  values: number[],
  answers: Object
}

export default Vue.extend({
  middleware: 'auth',
  computed: {
    ...mapState(['questions']),
  },
  data(): Data {
    return {
      values: [0, 1, 2, 3, 4, 5],
      answers: {},
    }
  },
  methods: {
    ...mapActions(['submitAnswers']),
    onSubmit() {
      this.$axios.post(
        `${this.$config.apiUrl}/api/answers`,
        {
          answers: this.answers,
        },
      ).then((_response) => {
        this.$router.push('/results');
      })
      
    }
  },
  mounted() {
    this.$store.dispatch('fetchQuestions').then((_response) => {
      this.questions.forEach((question) => {
        this.answers[question.id] = null
      });
    })
  },
})
</script>
