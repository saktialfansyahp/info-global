import axios from "axios";

const token = localStorage.getItem("token");

const api = axios.create({
  baseURL: `http://127.0.0.1:8080`,
});

if (token) {
  api.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}

export default api;
