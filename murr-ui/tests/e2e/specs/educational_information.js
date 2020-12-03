
describe('Resident views image', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('img', '../assets/recycling.png')
  })
})

describe('Resident views header', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('h1', 'Why Recycle?')
  })
})

describe('Resident views paragraph', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('p', 'Some information on why to recycle')
  })
})

describe('Resident views Acceptable Button', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('b-button', 'Acceptable Items')
  })
})

describe('Resident views Unacceptable Button', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('b-button', 'Unacceptable Items')
  })
})

describe('Resident views collapse', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('b-collapse')
  })
})

describe('Resident views unordered list', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('ul')
  })
})

describe('Resident views list items', () => {
  it('Visits the educational information page', () => {
    cy.visit('/')
    cy.contains('Educational Information')
      .click()
    cy.contains('li', 'Acceptable Item')
  })
})
