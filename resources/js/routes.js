import Home from './components/pages/Home.vue';
import Signup from './components/pages/Signup.vue';
import Login from './components/pages/Login.vue';

export const routes = [
    {
        path : '/',
        component : Home
    },
    {
        path : '/signup',
        component : Signup
    },
    {
        path: '/login',
        component : Login
    }
];
