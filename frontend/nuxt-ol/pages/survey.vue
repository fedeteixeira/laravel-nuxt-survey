<template>
  <div>
    <form @submit.prevent="onSubmit">
      <div v-for="(question, index) in questions" :key="index">
        {{ question }}
        <div v-for="value in values" :key="value">
          <input type="radio" :name="'question' + index" :value="value" v-model="answers[index]"> {{ value }}
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { mapActions, mapState } from 'vuex'

interface Data {
  values: number[],
  answers: Array<number|null>
}

export default Vue.extend({
  computed: {
    ...mapState(['questions']),
  },
  data(): Data {
    return {
      values: [0, 1, 2, 3, 4, 5],
      answers: Array(10).fill(null),
    }
  },
  async asyncData({store}){
    await store.dispatch('fetchQuestions')
  },
  methods: {
    ...mapActions(['submitAnswers']),
    onSubmit() {
      this.submitAnswers(this.answers);
      setTimeout(() => {
        this.$router.push('/results');
      }, 3000);
    }
  }
})
</script>
