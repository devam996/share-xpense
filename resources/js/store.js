export default {
    state: {
        welcomeMessage: 'Welcome to my vue app'
    },
    mutations: {},
    getters: {
        welcom(state){
            return state.welcomeMessage;
        }
    },
    actions: {}    
}