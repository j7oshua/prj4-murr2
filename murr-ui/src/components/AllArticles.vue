<template>
  <div class="container"><h1>Education Information</h1>
    <b-overlay :show="isDisabled" opacity="1">
      <div class="row" v-for="article in articleList" :key="article.id" @click="openArticle(article.id)" :style="'background:' + chooseColor()">
        <div class="col-1, p-4"><img :src="article.image" @error="article.image='cosmo.png'" alt="Recycling image" height="150" width="150"></div>
        <div class="col-2, p-4">
          <h4>{{article.title}}</h4>
            <div v-if="article.info.length<90">{{ article.info }}</div>
            <div v-else>{{ article.info.substring(0,90)+"... Click to read full article" }}</div>
        </div>
      </div>
    </b-overlay>
  </div>
</template>

<script>
import ArticlesMixin from '@/mixins/articles-mixin'
export default {
  name: 'AllArticles',
  mixins: [ArticlesMixin],
  data: function () {
    return {
      Article: {
        id: Number,
        title: String,
        image: URL
      },
      articleList: [],
      isBusy: false,
      counter: 0
    }
  },
  methods: {
    // this method will get all articles and will display there title and image
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
          console.log(err)
          if (err.response.status === 404) { // not found
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
    },
    chooseColor () {
      for (this.article in this.articleList) {
        if (this.articleList.indexOf(this.article) % 2 === 0) {
          return 'grey'
        } else {
          return 'red'
        }
      }
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
