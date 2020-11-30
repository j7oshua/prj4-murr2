const TODO_ITEM_ONE = "Learn some Vue JS";
let TODO_ITEM_TWO = "Create tests with cypress.io";
let TODO_ITEM_THREE = "Apply applitools visual testing";

describe("Profile Completion Test", () => {
  beforeEach(() => {
    fn.visit("/Profile_details");
    ln.visit("/Profile_details");
    sa.visit("/Profile_details");
    ci.visit("/Profile_details");
    pv.visit("/Profile_details");
    po.visit("/Profile_details");
  });

  context("Profile Completion Screen", () => {
    it.only("should allow me to insert data into each field", () => {
      // create one todo item
      fn.get("[data-fn=todo-input]")
        .type(TODO_ITEM_ONE)
        .type("{enter}");
      ln.get("[data-ln=todo-input]")
        .type(TODO_ITEM_ONE)
        .type("{enter}");
      sa.get("[data-sa=todo-input]")
        .type(TODO_ITEM_ONE)
        .type("{enter}");
      ci.get("[data-ci=todo-input]")
        .type(TODO_ITEM_ONE)
        .type("{enter}");
      pv.get("[data-pv=todo-input]")
        .type(TODO_ITEM_ONE)
        .type("{enter}");
      po.get("[data-po=todo-input]")
        .type(TODO_ITEM_ONE)
        .type("{enter}");

    });

  });
});
