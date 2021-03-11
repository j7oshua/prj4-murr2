<template>
  <div>
    <b-overlay :show="isDisabled" opacity="1">
      <h1>{{Article.title}}</h1>
      <img class="pt-3" :src="Article.image" @error="Article.image='cosmoindustries_icon.png'" alt="Recycling image" height="400">
      <p class="pt-4">{{Article.info}}</p>
      <b-button class="mt-2 mb-4" @click="goBack()">Back</b-button>
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
        title: this.$route.params.title,
        image: this.$route.params.image,
        info: this.$route.params.info
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
          if (err.response.status === 404) { // not found
            const message = err.response.status
            this.Article = {}
            this.Article.title = '404 Article Not Found'
            console.log(message)
          }
        }).finally(() => {
          this.isBusy = false
        })
    },
    goBack () {
      this.$router.push({ path: '/edu' })
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
