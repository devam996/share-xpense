window._ = require('lodash');


try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// if(!!token){
//     window.axios.defaults.headers.common['X-TOKEN'] = token.content;
// } else {
//     console.error('Token not found');
// }