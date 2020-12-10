describe('Resident acceptable items', () => {
  it('Visits the educational information page', () => {
    cy.visit('localhost:8080/recyclables/acceptable')
    cy.contains('Acceptable Items')
      .click()
    cy.contains('li', 'acceptable item')
  })
})

describe('Resident unacceptable items', () => {
  it('Visits the educational information page', () => {
    cy.visit('localhost:8080/recyclables/unacceptable')
    cy.contains('Unacceptable Items')
      .click()
    cy.contains('li', 'unacceptable item')
  })
})


