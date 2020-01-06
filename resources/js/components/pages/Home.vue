<template>
    <div>
        <section class="section">
            <div class="container">
                

                <div class="columns is-hcenter  ">
                    <div class="column is-one-third">
                        <div class="title has-text-centered">
                            <h3 class="title">Signup</h3>
                            <p>{{ welcome }}</p>
                        </div>
                        
                        <section>   
                            <b-field label="Name">
                                <b-input v-model="name"></b-input>
                            </b-field>

                            <b-field label="Email" type="{is-danger : false}">
                                <b-input type="email" v-model="email"></b-input>
                            </b-field>

                            <b-field label="Password">
                                <b-input type="password" v-model="password" password-reveal></b-input>
                            </b-field>

                            <b-button type="is-success">Submit</b-button>
                        </section>
                    </div>
                </div>
                
            </div>
        </section>
    </div>
</template>

<script>
export default {
    name: 'Home',
    computed: {
        welcome(){
            return this.$store.getters.welcome;
        }
    }
}
</script>