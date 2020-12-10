import ProfileForm from '/components/ProfileForm'
import {shallowMount} from "@vue/test-utils";

// describe('ProfileDetails.vue', () => {
//   it('renders props.msg when passed', () => {
//     const msg = 'Passed';
//     const wrapper = shallowMount(ProfileCompletion, {
//       propsData: { msg }
//     });
//     expect(wrapper.text()).to.include(msg)
//   })

describe('ProfileForm.vue', () => {
  it('user enters valid information for all fields', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({firstName: 'Lane', lastName: 'Lockhart', address: '222 seventh st west', city: 'Warman', province: 'SK', postalCode: 'S0K4S0'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for all fields', () => {
    const msg = 'Profile Unsuccessfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({firstName: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww',
                    lastName: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww',
                    address: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww',
                    city: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww',
                    province: 'S',
                    postalCode: 'ss'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters valid information for first name field', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({firstName: 'Lane'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters valid information for last name field', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({lastName: 'Lockhart'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters valid information for address field', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({address: '222 seventh st west'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters valid information for city field', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({city: 'Warman'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters valid information for province field', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({province: 'SK'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters valid information for city field', () => {
    const msg = 'Profile Successfully created';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({postalCode: 'S0K4S0'});
    expect(wrapper.text()).to.include(msg)
  })
});

// --------------------------


describe('ProfileForm.vue', () => {
  it('user enters invalid information for first name field', () => {
    const msg = "First Name must not exceed 20 characters";
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({firstName: "w".repeat(21)});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for last name field', () => {
    const msg =  "Last Name must not exceed 20 characters";
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({lastName: "w".repeat(21)});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for address field', () => {
    const msg = "Address must not exceed 50 characters";
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({address: "w".repeat(51)});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for city field', () => {
    const msg = "City must not exceed 30 characters";
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({city: "w".repeat(31)});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for province field', () => {
    const msg =  "Province must not exceed 2 characters";
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({province: 'S'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for postal code', () => {
    const msg = "Postal Code must follow the format ‘L#L#L#’";
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({postalCode: 'S'});
    expect(wrapper.text()).to.include(msg)
  })
});

