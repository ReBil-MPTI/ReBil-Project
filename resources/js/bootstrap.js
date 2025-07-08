import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let token = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
if (token) {
    window.axios.defaults.headers.common["X-XSRF-TOKEN"] = decodeURIComponent(
        token[1]
    );
}
