import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-InvFest-RequestHash'] =
    import.meta.env.VITE_APP_NAME.split('')
        .sort(() => Math.random() - 0.5)
        .join('') || '';
