<template>
    <table>
        <tr>
            <th>Hashed link</th>
            <th>Original link</th>
        </tr>
        <tr v-for="link in links">
            <td><a :href="fullUrl + link.hash">{{ fullUrl + link.hash }}</a></td>
            <td>{{ link.original_link }}</td>
        </tr>
    </table>
</template>

<script>
import axios from "axios";

export default {
    name: "LinkList",
    props: {
        domain: String
    },
    data() {
        return {
            links: [],
            fullUrl: window.location
        }
    },
    methods: {
        getLinks() {
            if (!this.links.length) {
                axios.get(this.domain)
                    .then(json => {
                        this.links = json.data
                    })
            }
        },
    },
    mounted() {
        this.getLinks();
    }
}
</script>

<style scoped>

th, tr {
    width: 120px;
    text-align: left;
}

th {
    border-bottom: 1px solid black;
}

table {
    margin-left: auto;
    margin-right: auto;
}
</style>
