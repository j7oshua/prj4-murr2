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



describe('ProfileForm', () => {
  it('renders a profile form Screen and responds correctly to user input', () => {
    const wrapper = shallowMount(ProfileForm, {
          firstName: 'Lane',
          lastName: 'Lockhart',
          address: '222 seventh st west',
          city: 'Warman',
          province: 'SK',
          postalCode: 'S0K4S0'
    });

    // see if the message renders
    expect(wrapper.find('.firstName').text()).to.include('Lane');
    expect(wrapper.find('.lastName').text()).to.include('Lockhart');
    expect(wrapper.find('.address').text()).to.include('222 seventh st west');
    expect(wrapper.find('.city').text()).to.include('Warman');
    expect(wrapper.find('.province').text()).to.include('SK');
    expect(wrapper.find('.postalCode').text()).to.include('S0K4S0');

    expect(wrapper.find('.error').isEmpty());




    // update the `firstName` and error should exist
    wrapper.setData({ firstName: 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss' });
    // assert the error is rendered
    expect(wrapper.find('.error').exists());

    wrapper.setData({ firstName: 'Lane' });
    wrapper.setData({lastName: 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'});
    // assert the error is rendered
    expect(wrapper.find('.error').exists());

    wrapper.setData({ lastName: 'Lockhart' });
    wrapper.setData({address: 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'});
    // assert the error is rendered
    expect(wrapper.find('.error').exists());

    wrapper.setData({ address: '222 seventh st west' });
    wrapper.setData({ city: 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss'});
    // assert the error is rendered
    expect(wrapper.find('.error').exists());

    wrapper.setData({ city: 'Warman' });
    wrapper.setData({province: 's'});
    // assert the error is rendered
    expect(wrapper.find('.error').exists());

    wrapper.setData({ province: 'SK' });
    wrapper.setData({postalCode: 's'});
    // assert the error is rendered
    expect(wrapper.find('.error').exists());
  })

});

