import nock from 'nock'
import flushPromises from 'flush-promises'
import { expect } from "chai"
import {describe} from "mocha";

describe('AllArticles.vue', () => {
  // this test will make sure the get request is returning the full list of articles available
  it('Resident views all recycling articles on main page', async () => {
    const request = nock('http://localhost:8000/api/articles/1')
      // make the call to the mock database passing in the article id
      .get(`/api/articles`)
      .reply(200)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contain({id: 1, title: "What Can You Recycle", image: "image1.jpg"})
  })
})

describe('ArticleDetails.vue', () => {
  // this test make sure the get request is working for that specific article and displaying the correct information
  it('Resident selects recycling article “What can you Recycle”', async () => {
    const expectedArticle = 1
    const request = nock('http://localhost:8000/api/articles/1')
      // make the call to the mock database passing in the article id
      .get(`/api/articles/${expectedArticle}`)
      .reply(200)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contains( [{ statusCode: 200 }])
  })
  it('Resident unsuccessfully views recycling article', async () => {
    // this test is to make sure if the user enters an invalid article id in the url it wont work
    const expectedArticle = -1
    const request = nock('http://localhost:8000/api/articles/-1')
      // make the call to the mock database passing in the article id
      .get(`/api/articles/${expectedArticle}`)
      .reply(404)
    await flushPromises()
    // should return a status code of 404
    expect(request).to.contains([{ statusCode: 404 }] )
  })
})
