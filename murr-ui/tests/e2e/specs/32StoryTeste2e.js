


describe('User sees his points empty.', () => {
  it('Visits the points page and check the page has zero points', () => {
    cy.visit('/')
    cy.contains('Points')
      .click()
    cy.contains('h2', 'Points:0')
  })
})

describe('User sees his points.', () => {
  it('Visits the points page and check the page loaded', () => {
    cy.visit('/')
    cy.contains('Points')
      .click()
    cy.contains('h2', 'Points:3')
  })
})
