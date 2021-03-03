<template>
  <div>
    <p>{{Article.title}}</p>
    <img :src="Article.image" alt="Recycling image" height="200">
<!--    @error="Article.image='../../public/favicon.ico'"-->
    <p>{{Article.info}}</p>
  </div>
</template>

<script>
import ArticlesMixin from '../mixins/articles-mixin'

export default {
  name: 'ArticleInfo',
  mixins: [ArticlesMixin],
  data () {
    return {
      Article: {
        id: Number,
        title: String,
        image: URL,
        info: String
      }
    }
  },
  methods: {
    // this method will get the specific article details and display all the information for that specific article
    getArticleDetails () {
      // make the call to the API
      this.axios.get(this.ARTICLES_URL + '/' + 1, {
      })
        .then(resp => {
          // set tempPoints to be the points returned by the API
          this.Article = resp.data
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 404) { // not found
            const message = err.status
            console.log(message)
          }
        }).finally(() => {

        })
    }
  },
  mounted () {
    this.getArticleDetails()
  }
}
</script>

<style scoped>

</style>
