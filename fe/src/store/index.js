import Vuex from "vuex";
import localStoragePlugin from "../plugins/localStoragePlugins";
import axios from "axios";
import router from "@/router";

const store = new Vuex.Store({
  plugins: [localStoragePlugin],
  state: {
    isDesktop: false,
    role: null,
    token: null,
    isLoggedIn: false,
    openModals: false,
    history: null,
    alert: false,
  },
  mutations: {
    setIsDesktop(state, isDesktop) {
      state.isDesktop = isDesktop;
    },
    setModals(state, value) {
      state.openModals = value;
    },
    setAlert(state, value) {
      state.alert = value;
    },
    setLoggedIn(state, newValue) {
      state.isLoggedIn = newValue;
    },
    setRole(state, newRole) {
      state.role = newRole;
    },
    setToken(state, newToken) {
      state.token = newToken;
    },
    setHistory(state, value) {
      state.history = value;
    },
  },
  actions: {
    updateIsDesktop({ commit }) {
      const width = window.innerWidth;
      const isDesktop = width >= 1280;
      commit("setIsDesktop", isDesktop);
    },
    initializeFromLocalStorage(context) {
      if (localStorage.getItem("isLoggedIn")) {
        context.commit("setLoggedIn", localStorage.getItem("isLoggedIn"));
      }
      if (localStorage.getItem("role")) {
        context.commit("setRole", localStorage.getItem("role"));
      }
      if (localStorage.getItem("history")) {
        context.commit("setHistory", localStorage.getItem("history"));
      }
    },
    login({ commit }, credentials) {
      return new Promise((resolve, reject) => {
        // Lakukan permintaan HTTP menggunakan Axios
        axios
          .post("/api/auth/login", credentials)
          .then((response) => {
            commit("setToken", response.data.access_token);
            axios.defaults.headers.common[
              "Authorization"
            ] = `Bearer ${this.state.token}`;
            commit("setAlert", true);
            setTimeout(() => {
              commit("setAlert", false);
              localStorage.setItem("token", response.data.access_token);
              localStorage.setItem("role", "admin");
              localStorage.setItem("isLoggedIn", true);
              commit("setLoggedIn", true);
              commit("setRole", "admin");
              router.push("/");
            }, 1500);
            console.log(response);
            resolve();
          })
          .catch((error) => {
            commit("setModals", true);
            reject(error);
          });
      });
    },
    register({ commit }, credentials) {
      return new Promise((resolve, reject) => {
        // Lakukan permintaan HTTP menggunakan Axios
        axios
          .post("/api/auth/register", credentials)
          .then((response) => {
            console.log(response);
            resolve();
          })
          .catch((error) => {
            commit("setModals", true);
            reject(error);
          });
      });
    },
    logout({ commit }) {
      return new Promise((resolve, reject) => {
        axios
          .post("/api/auth/logout")
          .then((response) => {
            commit("setAlert", true);
            setTimeout(() => {
              commit("setAlert", false);
              commit("setLoggedIn", false);
              commit("setRole", null);
              router.push("signin");
              localStorage.clear();
            }, 1500);
            console.log(response);
            resolve();
          })
          .catch((error) => {
            reject(error);
          });
      });
    },
  },
});

export default store;
