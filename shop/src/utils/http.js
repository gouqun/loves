import axios from 'axios';

// 自定义axios实例
const http = axios.create({
  baseURL: '/api',
  timeout: 5000
});

export default http;
