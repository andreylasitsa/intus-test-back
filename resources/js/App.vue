<script>
import LinkForm from "./components/LinkForm.vue"
import LinkList from "./components/LinkList.vue"

export default {
    components: {LinkForm, LinkList},
    data() {
        return {
            domain: '/link'
        }
    }
}
</script>

<template>
    <header>
        <router-link to="/">Link Form</router-link>
        <router-link to="/list">Links List</router-link>
    </header>
    <main>
        <router-view :domain="domain"></router-view>
    </main>
</template>

<style>
@import './../css/app.css';
main {
    text-align: center;
}
#app {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem;
    font-weight: normal;
}
header {
    line-height: 1.5;
    margin-bottom: 50px;
    text-align: center;
}
header a {
    padding-left: 5px;
    padding-right: 5px;
}
.logo {
    display: block;
    margin: 0 auto 2rem;
}
a,
.green {
    text-decoration: none;
    color: hsla(160, 100%, 37%, 1);
    transition: 0.4s;
}
@media (hover: hover) {
    a:hover {
        background-color: hsla(160, 100%, 37%, 0.2);
    }
}
</style>
