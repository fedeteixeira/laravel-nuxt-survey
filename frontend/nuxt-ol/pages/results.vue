<template>
    <div>
      <Navbar></Navbar>
      <div v-if="values.length > 0 && labels.length > 0">
          <bar-chart :chartData="chartData" ref="barChart"></bar-chart>
      </div>
    </div>
</template>

<script lang="ts">
import { Bar } from 'vue-chartjs'
import { defineComponent } from 'vue'
import { ChartData } from 'chart.js';

export default defineComponent({
  middleware: 'auth',
  components: {
    BarChart: Bar
  },
  computed: {
    answers() {
      return this.$store.state.answers;
    },
    values() {
      if(this.answers?.length)
        return this.answers.map((answer) => answer.average_body);
      return []
    },
    labels() {
      if(this.answers?.length)
        return this.answers.map((answer) => answer.title);
      return []
    },
    chartData() {
      return {
        labels: this.labels,
        datasets: [{
            label: 'Answers',
            backgroundColor: '#f87979',
            data: this.values,
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
  methods: {
    handlerMethod() {
      this.chartData.datasets[0].data = this.values
      this.$nextTick(() => {
          (this.$refs.barChart as Bar)?.renderChart(this.chartData as ChartData)
      })
    }
  },
  mounted() {
    this.handlerMethod();
    this.$store.dispatch('fetchAnswers')
  },
})
</script>
