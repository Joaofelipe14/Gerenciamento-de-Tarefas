<template>
    <div class="header">
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <div class="container">
                <router-link class="navbar-brand" to="/Tasks">Tasks Manager</router-link>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Task</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link icon" title="Logout" v-on:click="logout()">
                                <i>
                                    <font-awesome-icon :icon="['fas', 'right-from-bracket']" />
                                </i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>

import APIClient from '../services/UserService.js';
import { showError } from '@/components/utils/alertHandler.js'

export default {
    /* eslint-disable */
    name: 'Navbar',
    data() {
        return {
        }
    },
    methods: {
        logout() {
            try {
                APIClient.logout();
                this.$router.push('/login');
            } catch (error) {
                showError(error)
            }
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
    font-weight: normal;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: inline-block;
    margin: 0 10px;
}

.icon i {
    cursor: pointer;
}
</style>