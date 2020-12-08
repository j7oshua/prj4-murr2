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
    const msg = 'Profile created unsuccessfully';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({firstName: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for last name field', () => {
    const msg = 'Profile created unsuccessfully';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({lastName: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for address field', () => {
    const msg = 'Profile created unsuccessfully';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({address: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for city field', () => {
    const msg = 'Profile created unsuccessfully';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({city: 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for province field', () => {
    const msg = 'Profile created unsuccessfully';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({province: 'S'});
    expect(wrapper.text()).to.include(msg)
  })
});

describe('ProfileForm.vue', () => {
  it('user enters invalid information for city field', () => {
    const msg = 'Profile created unsuccessfully';
    const wrapper = shallowMount(ProfileForm, {
      propsData: {msg}
    });
    wrapper.setData({postalCode: 'S'});
    expect(wrapper.text()).to.include(msg)
  })
});

