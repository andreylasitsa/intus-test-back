<template>
  <form @submit.prevent="sendLink">
    <input type="text" v-model="link" placeholder="link...">
    <button>Save</button>
  </form>
  Link:
  <a v-if="hashedLink" :href="hashedLink">{{ hashedLink }}</a>
  <p v-else>Send your link first</p>
</template>

<script>
import axios from 'axios'

export default {
    name: "LinkForm",
    data() {
        return {
            link: '',
            hashedLink: ''
        }
    },
    props: {
        domain: String
    },
    methods: {
        sendLink() {
            axios.post(this.domain, { link: this.link})
                .then(json => {
                    this.message = json.data.message
                    this.hashedLink = json.data.link
                })
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>
input {
  height: 30px;
  width: 200px;
  border: 2px solid aqua;
  border-radius: 5px;
}

a, p {
  display: inline;
  color: aqua;
}

button {
  height: 30px;
  width: 120px;
  margin-left: 20px;
  background-color: aqua;
  border: 2px solid aqua;
  border-radius: 5px;
}
</style>
