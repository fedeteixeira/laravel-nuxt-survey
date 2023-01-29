import Vuex from "vuex";
import axios from "axios";

interface State {
  questions: string[];
  answers: any[];
  userAnswers: any[];
  user: string | null;
  token: string | null;
}

interface Commit {
  commit: (type: string, payload: any) => void;
}

const createStore = (): Vuex.Store<State> => {
  return new Vuex.Store<State>({
    state: {
      questions: [],
      answers: [],
      userAnswers: [],
      user: null,
      token: null,
    },
    mutations: {
      SET_USER_ANSWERS(state, userAnswers: any[]) {
        state.userAnswers = userAnswers;
      },
      SET_ANSWERS(state, answers: any[]) {
        state.answers = answers;
      },
      SET_QUESTIONS(state, questions: string[]) {
        state.questions = questions;
      },
      SET_USER(state, user: string) {
        state.user = user;
      },
      SET_TOKEN(state, token: string) {
        state.token = token;
      },
    },
    actions: {
      async submitLoginForm(
        { commit }: Commit,
        {
          email,
          password,
        }: {
          email: string;
          password: string;
        }
      ) {
        // try {
        //   const response = await axios.post("http://localhost:8000/api/login", {
        //     email,
        //     password,
        //   });
        //   if (response.data.success) {
        //     commit("SET_USER", response.data.user);
        //     commit("SET_TOKEN", response.data.token);
        //   } else {
        //     // handle unsuccessful login
        //   }
        // } catch (error) {
        //   // handle error
        // }

        commit("SET_USER", "fede");
        commit("SET_TOKEN", "token");
      },
      async submitAnswers({ commit }: Commit, answers: any[]) {
        commit("SET_USER_ANSWERS", answers);
        // try {
        //   const { data } = await axios.post("/api/answers", {
        //     answers,
        //   });
        //   // do something with the data
        // } catch (e) {
        //   // handle the error
        // }
      },
      async fetchAnswers({ commit }: Commit) {
        commit("SET_ANSWERS", [1, 1, 1, 1]);
        // try {
        //   const { data } = await axios.get("/api/questions");
        //   commit("SET_ANSWERS", data);
        // } catch (error) {
        //   console.error(error);
        // }
      },
      async fetchQuestions({ commit }: Commit) {
        try {
          // const { data } = await axios.get("/api/questions");
          commit("SET_QUESTIONS", ["Question1", "Question2"]);
        } catch (error) {
          console.error(error);
        }
      },
    },
  });
};

export default createStore;
