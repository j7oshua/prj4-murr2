<template>
  <div>
    <img :src="Article.image" @error="Article.image='../../public/favicon.ico'" alt="Recycling image">
  </div>
</template>

<script>
export default {
  name: 'ArticleInfo',
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

    }
  }
}
</script>

<style scoped>

</style>
