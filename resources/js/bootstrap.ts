import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
// window.axios.defaults.withCredentials = true;
// window.axios.defaults.baseURL = "http://localhost:8000/";
// window.axios.defaults.headers.common["X-CSRF-TOKEN"] = $(
//     'meta[name="csrf-token"]'
// ).attr("content");
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
