

describe('Visit points page', () => {
  it('Visits the points page and check the page loaded', () => {
    cy.visit('/')
    cy.contains('Points')
      .click()
    cy.contains('h3', 'Points')
  })
})
