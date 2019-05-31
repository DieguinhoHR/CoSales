import axios from 'axios'

const api = axios.create({
  baseURL: 'http://localhost:85/api'
})

export default api