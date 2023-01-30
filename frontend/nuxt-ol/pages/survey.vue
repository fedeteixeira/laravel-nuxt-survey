<template>
  <div>
    <form @submit.prevent="onSubmit">
      <div v-for="question in questions" :key="question.id">
        {{ question.title }}
        <div v-for="value in values" :key="value">
          <input type="radio" :name="'question' + question.id" v-model="answers[question.id]" :value="value"> {{ value }}
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
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
  computed: {
    ...mapState(['questions']),
  },
  data(): Data {
    return {
      values: [0, 1, 2, 3, 4, 5],
      answers: {},
    }
  },
  async asyncData({store}){
    await store.dispatch('fetchQuestions')
  },
  methods: {
    ...mapActions(['submitAnswers']),
    async onSubmit() {
      await this.$axios.post(
        `${this.$config.apiUrl}/api/answers`,
        {
          answers: this.answers,
        },
      );
      // setTimeout(() => {
      //   this.$router.push('/results');
      // }, 3000);
    }
  },
  watch: {
    questions: {
      handler() {
        console.log(this.questions);
      },
      deep: true
    },
  },
  mounted() {
    this.questions.forEach(question => {
      this.answers[question.id] = null
    });
  },
})
</script>
