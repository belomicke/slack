import axios from 'axios'

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.baseURL = 'http://localhost/api'
window.axios.defaults.withCredentials = true
window.axios.defaults.withXSRFToken = true
window.axios.interceptors.response.use(
    res => res,
    error => {
        if (error.response.status === 401) {
            localStorage.removeItem('token')
            window.location.reload()
        }
    },
)

const token = localStorage.getItem('token')

if (token) {
    window.axios.defaults.headers['Authorization'] = `Bearer ${token}`
}
