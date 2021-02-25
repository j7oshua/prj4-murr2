import nock from 'nock'
import flushPromises from 'flush-promises'
import { expect } from "chai"

describe('AllArticles.vue', () => {
  it('Resident views all recycling articles on main page', async () => {
    const request = nock('http://localhost:8000/edu/articles/1')
      // make the call to the mock database passing in the article id
      .get(`/edu`)
      .reply(200)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contain({id: 1, title: "What Can You Recycle", image: "image1.jpg"})
  })
})

describe('ArticleDetails.vue', () => {
  it('Resident selects recycling article “What can you Recycle”', async () => {
    const expectedArticle = 1
    const request = nock('http://localhost:8000/edu/articles/1')
      // make the call to the mock database passing in the article id
      .get(`/edu/article${expectedArticle}`)
      .reply(200)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contains( [{ statusCode: 200 }])
  })
  it('Resident unsuccessfully views recycling article', async () => {
    const expectedArticle = -1
    const request = nock('http://localhost:8000/edu/articles/-1')
      // make the call to the mock database passing in the article id
      .get(`/edu/article${expectedArticle}`)
      .reply(404)
    await flushPromises()
    // should return a status code of 200
    expect(request).to.contains([{ statusCode: 404 }] )
  })
})
