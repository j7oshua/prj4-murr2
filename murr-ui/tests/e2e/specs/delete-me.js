// https://docs.cypress.io/api/introduction/api.html

const TODO_ITEM_ONE = "j";

describe('My First Test', () => {
  it('Visits the app root url', () => {
    cy.visit('/profile')
    cy.contains('msg', TODO_ITEM_ONE)
  });
})
