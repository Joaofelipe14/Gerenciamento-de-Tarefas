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
                        <li>
                            <i> <font-awesome-icon :icon="['fas', 'right-from-bracket']" /></i>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    /* eslint-disable */
    name: 'Navbar',
    data() {
        return {
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

/* 
a {
    color: #42b983;
} */
</style>