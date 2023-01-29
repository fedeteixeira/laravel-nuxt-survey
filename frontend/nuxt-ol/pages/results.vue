<template>
    <div v-if="answers.length > 0 && questions.length > 0">
        <bar-chart :chartData="chartData" ref="barChart"></bar-chart>
    </div>
</template>



<script lang="ts">
import Vue from 'vue'
import { Bar } from 'vue-chartjs'
import { mapState } from 'vuex'

export default Vue.extend({
  components: {
    BarChart: Bar
  },
  computed: {
    ...mapState(['questions']),
    ...mapState(['answers']),
    chartData() {
        return {
            labels: this.questions,
            datasets: [{
                label: 'Answers',
                backgroundColor: '#f87979',
                data: this.answers
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
        if(this.chartData) {
            this.chartData.datasets[0].data = this.answers
            this.$nextTick(() => {
                this.$refs.barChart?.renderChart(this.chartData)
            })
        }
        
    }
  },
  mounted() {
    this.handlerMethod();
  },
})
</script>
