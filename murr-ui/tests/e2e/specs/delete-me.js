// https://docs.cypress.io/api/introduction/api.html
//
// const TODO_ITEM_ONE = "j";
//
// describe('My First Test', () => {
//   it('Visits the app root url', () => {
//     cy.visit('/profile')
//     cy.contains('msg', TODO_ITEM_ONE)
//   });
// })

const TODO_ITEM_ONE = "Test1";
let TODO_ITEM_TWO = "Test2";
let TODO_ITEM_THREE = "Test3";

describe("Profile Completion Test", () => {
  beforeEach(() => {
    fn.visit("/Profile");
    ln.visit("/Profile");
    sa.visit("/Profile");
    ci.visit("/Profile");
    pv.visit("/Profile");
    po.visit("/Profile");
  });

  context("Profile Completion Screen", () => {
    it.only("should allow me to insert data into each field", () => {
      // create one todo item
      fn.get("[data-fn=todo-input]")
        .type(TODO_ITEM_ONE);
      fn.get("[data-fn=todo-input]")
        .find("input")
        .should("contain", TODO_ITEM_ONE);

      ln.get("[data-ln=todo-input]")
        .type(TODO_ITEM_ONE);
      ln.get("[data-ln=todo-input]")
        .find("input")
        .should("contain", TODO_ITEM_ONE);

      sa.get("[data-sa=todo-input]")
        .type(TODO_ITEM_ONE);
      sa.get("[data-sa=todo-input]")
        .find("input")
        .should("contain", TODO_ITEM_ONE);


      ci.get("[data-ci=todo-input]")
        .type(TODO_ITEM_ONE);
      ci.get("[data-ci=todo-input]")
        .find("input")
        .should("contain", TODO_ITEM_ONE);

      pv.get("[data-pv=todo-input]")
        .type(TODO_ITEM_ONE);
      pv.get("[data-pv=todo-input]")
        .find("input")
        .should("contain", TODO_ITEM_ONE);

      po.get("[data-po=todo-input]")
        .type(TODO_ITEM_ONE);
      po.get("[data-po=todo-input]")
        .find("input")
        .should("contain", TODO_ITEM_ONE);

    });

  });
});
