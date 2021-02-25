<template>

</template>

<script>
  export default {
    name: "ArticleInfo",
    props: {
      article: {
        tempID: Number
      }
    },
    data() {
      return {
        tempArticle: {
          id: Number,
          title: String,
          image: Image,
          info: String
        }
      }
    },
    methods: {
      getArticleDetails() {

      },
      navigateArticlesPrevNext() {

      }
    }
  }
</script>

<style scoped>

</style>
