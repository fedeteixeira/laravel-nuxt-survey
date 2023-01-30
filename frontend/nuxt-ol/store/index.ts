interface State {
  questions: Object[];
  answers: Object[];
  userAnswers: Object;
}

interface Commit {
  commit: (type: string, payload: any) => void;
}

export const state = () => ({
  questions: [],
  answers: [],
  userAnswers: {},
});

export const getters = {
  getQuestions(state: State) {
    return state.questions;
  },

  getAnswers(state: State) {
    return state.answers;
  },

  getUserAnswers(state: State) {
    return state.userAnswers;
  },
};

export const mutations = {
  SET_USER_ANSWERS(state: State, userAnswers: Object) {
    state.userAnswers = userAnswers;
  },
  SET_ANSWERS(state: State, answers: Object[]) {
    state.answers = answers;
  },
  SET_QUESTIONS(state: State, questions: Object[]) {
    state.questions = questions;
  },
};

export const actions = {
  async submitAnswers({ commit }: Commit, answers: Object) {
    commit("SET_USER_ANSWERS", answers);
    try {
      await this.$axios.post(`${this.$config.apiUrl}/api/answers`, {
        answers,
      });
    } catch (e) {
      // handle the error
    }
  },
  async fetchAnswers({ commit }: Commit) {
    try {
      const { data } = await this.$axios.get(
        `${this.$config.apiUrl}/api/answers/average`
      );
      commit("SET_ANSWERS", data?.answers ?? {});
    } catch (error) {
      console.error(error);
    }
  },
  async fetchQuestions({ commit }: Commit) {
    try {
      const { data } = await this.$axios.get(
        `${this.$config.apiUrl}/api/questions`
      );
      commit("SET_QUESTIONS", data?.questions ?? []);
    } catch (error) {
      console.error(error);
    }
  },
};
