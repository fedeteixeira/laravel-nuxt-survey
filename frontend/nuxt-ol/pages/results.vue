<template>
    <div v-if="answers.length > 0 && questions.length > 0">
        <bar-chart :chartData="chartData" ref="barChart"></bar-chart>
    </div>
</template>



<script lang="ts">
import { Bar } from 'vue-chartjs'
import { defineComponent } from 'vue'
import { ChartData } from 'chart.js';

export default defineComponent({
  components: {
    BarChart: Bar
  },
  computed: {
    questions() {
      return this.$store.state.questions;
    },
    answers() {
      return this.$store.state.answers;
    },
    chartData() {
        return {
            labels: this.$store.state.questions,
            datasets: [{
                label: 'Answers',
                backgroundColor: '#f87979',
                data: this.$store.state.answers,
            }]
        }
    }
  },
  watch: {
    answers: {
      handler() {
        this.handlerMethod();
      },
      deep: true
    },
    questions: {
      handler() {
        this.handlerMethod();
      },
      deep: true
    }
  },
  async asyncData({store}){
    await store.dispatch('fetchAnswers')
  },
  methods: {
    handlerMethod() {
      this.chartData.datasets[0].data = this.answers
      this.$nextTick(() => {
          (this.$refs.barChart as Bar)?.renderChart(this.chartData as ChartData)
      })
    }
  },
  mounted() {
    this.handlerMethod();
  },
})
</script>
