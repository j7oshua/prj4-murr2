<template>
  <div> {{ Article }}
    <div v-for="article in articleList" :key="article.id">
      <p>{{article.title}}</p>
    </div>
    <!--    <img :src="Article.image" @error="Article.image='../../public/default.png'" alt="Recycling image">-->
  </div>
</template>

<script>
import ArticlesMixin from '@/mixins/articles-mixin'
export default {
  name: 'AllArticles',
  mixins: [ArticlesMixin],
  data () {
    return {
      Article: {
        id: Number,
        title: String,
        image: URL
      },
      articleList: []
    }
  },
  methods: {
    // this method will get all articles and will display there title and image
    getArticles () {
      // make the call to the API
      this.axios.get(this.ARTICLES_URL, {
      })
        .then(resp => {
          // set tempPoints to be the points returned by the API
          this.articleList = resp.data
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 404) { // not found
            const message = err.status
            console.log(message)
          }
        }).finally(() => {

        })
    },
    // this method will map the article being selected using the id and will navigate the user to a new page
    openArticle (id) {

    }
  },
  mounted () {
    this.getArticles()
  }
}
</script>

<style scoped>

</style>
