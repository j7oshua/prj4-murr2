

describe('User failed to see his points, error.', () => {
  it('Visits the points page and check the page had an error', () => {
    cy.visit('/')
    cy.contains('Points')
      .click()
    cy.contains('h3', 'Sorry, Runtime Error: 443. Go back to previous page')
  })
})

describe('User sees his points empty.', () => {
  it('Visits the points page and check the page has zero points', () => {
    cy.visit('/')
    cy.contains('Points')
      .click()
    cy.contains('h2', '0')
  })
})

describe('User sees his points.', () => {
  it('Visits the points page and check the page loaded', () => {
    cy.visit('/')
    cy.contains('Points')
      .click()
    cy.contains('h2', '10 Points!')
  })
})
