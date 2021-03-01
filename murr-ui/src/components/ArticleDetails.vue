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
      // this method will get the specific article details and display all the information for that specific article
      getArticleDetails() {

      },
      // this method will allow the user to click next or previous to navigate the articles without having to leave the page
      navigateArticlesPrevNext() {

      }
    }
  }
</script>

<style scoped>

</style>
