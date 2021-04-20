<template>
  <div class="container-xl"><h1>Education Information</h1>
    <b-overlay :show="isDisabled" opacity="1">
      <div class="row mt-2" v-for="article in articleList" :key="article.id" @click="openArticle(article.id)" style="background: rgb(245,245,245)">
        <div class="col-1, pt-4 pb-4 pl-4"><img :src="article.image" @error="article.image='cosmoindustries_icon.png'" alt="Recycling image" height="150" width="200"></div>
        <div class="col-2, p-4 d-inline-block" style="width: 80%;">
          <h4>{{article.title}}</h4>
            <div v-if="article.info.length<215">{{ article.info }}</div>
          <div v-else>{{ article.info.substring(0,215)}}... <b>Click to read full article</b></div>
        </div>
      </div>
    </b-overlay>
  </div>
</template>

<script>
export default {
  name: 'AllArticles',
  data: function () {
    return {
      Article: {
        id: Number,
        title: String,
        image: URL
      },
      articleList: [],
      isBusy: false
    }
  },
  methods: {
    // this method will get all articles and will display their title and image
    async getArticles () {
      this.isBusy = true
      // make the call to the API
      this.axios.get(this.ARTICLES_URL, {
      })
        .then(resp => {
          // set tempPoints to be the points returned by the API
          this.articleList = resp.data['hydra:member']
        })
        .catch(err => {
          if (err.response === 404) { // not found
            const message = err.response.status
            console.log(message)
          }
        }).finally(() => {
          this.isBusy = false
        })
    },
    // this method will map the article being selected using the id and will navigate the user to a new page
    openArticle (id) {
      this.$router.push({ path: `/edu/articles/${id}` })
    }
  },
  mounted () {
    this.getArticles()
  },
  computed: {
    isDisabled: function () {
      return this.isBusy || this.disabled
    }
  }
}
</script>

<style scoped>

</style>
