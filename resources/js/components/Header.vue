<template>
    <b-navbar>
        <template slot="brand">
            <b-navbar-item tag="router-link" :to="{ path: '/' }">
                <img
                    src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
                    alt="Lightweight UI components for Vue.js based on Bulma"
                >
            </b-navbar-item>
        </template>
        <template slot="start">
            
        </template>

        <template slot="end">
            
                <div class="buttons">
                    <b-navbar-item tag="router-link" :to="{ path: '/signup' }">
                        <a class="button is-primary">
                            <strong>Sign up</strong>
                        </a>
                    </b-navbar-item>
                    <b-navbar-item tag="router-link" :to="{ path: '/login'}">
                        <a class="button is-light">
                            Log in
                        </a>
                    </b-navbar-item>
                </div>
            
        </template>
    </b-navbar>
</template>

<script>
export default {
    name: 'Header'
}
</script>