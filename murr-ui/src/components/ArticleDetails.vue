<template>
  <div>
    <b-overlay :show="isDisabled" opacity="1">
      <p>{{Article.title}}</p>
      <img :src="Article.image" @error="Article.image='cosmo.png'" alt="No Image" height="200">
      <p>{{Article.info}}</p>
    </b-overlay>
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
        id: this.$route.params.id,
        title: String,
        image: URL,
        info: String
      },
      isBusy: false
    }
  },
  methods: {
    // this method will get the specific article details and display all the information for that specific article
    getArticleDetails () {
      this.isBusy = true
      // make the call to the API
      this.axios.get(this.ARTICLES_URL + '/' + this.Article.id, {
      })
        .then(resp => {
          // set tempPoints to be the points returned by the API
          this.Article = resp.data
        })
        .catch(err => {
          console.log(err)
          if (err.response.status === 404) { // not found
            const message = err.response.status
            this.Article = {}
            this.Article.title = '404 Article Not Found'
            console.log(message)
          }
        }).finally(() => {
          this.isBusy = false
        })
    }
  },
  mounted () {
    this.getArticleDetails()
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
