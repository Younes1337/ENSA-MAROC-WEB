import axios from "axios";
import { router } from "../app";

export default {
    namespaced: true,
    state: {
      ensas: [],
      user: {},
    },
    getters: {
      ensas(state) {
        return state.ensas;
      },
      user(state) {
        return state.user;
      }
    },
    mutations: {
      SET_ENSAS(state, value) {
        state.ensas = value;
      },
      SET_USER(state, value) {
        state.user = value;
      }
    },
    actions: {
      async refreshUser({ commit, state }) {
        const { data } = await axios.get("/api/user");
        commit('SET_USER', data);
        return data;
      },
      async refreshENSAS({ commit, state }) {
        const { data } = await axios.get("/api/ensa");
        commit('SET_ENSAS', data);
      }
    },
};
