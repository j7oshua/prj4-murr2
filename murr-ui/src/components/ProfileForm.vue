
<template>
<div>
  ProfileForm
</div>
</template>

<script>
    import Vue from 'vue';
    import Vuelidate from 'vuelidate';
    import maxLength from "vuelidate/src/validators/maxLength";
    import postal from "vuelidate/src/validators/postal";
    import vuelidateErrorExtractor, { templates } from "vuelidate-error-extractor";

    Vue.use(Vuelidate);
    Vue.use(vuelidateErrorExtractor, {
        template: templates.multiErrorExtractor.foundation6, // you can also pass your own custom template
        messages: { firstname: "First Name must not exceed 20 characters",
                    lastname: "Last Name must not exceed 20 characters",
                    address: "Address must not exceed 50 characters",
                    city: "City must not exceed 30 characters",
                    province: "Province must not exceed 2 characters",
                    postalcode: "Postal Code must follow the format ‘L#L#L#’"
                  }
    });

    export default {
        name: "profileForm",
        props: {
            profile: Object,
        },
        data() {
            return {
                tempProfile: {},
                error: {}
            }
        },
        validations: {
            tempProfile: {
                firstname: {maxLength: maxLength(20)},
                lastname: {maxLength: maxLength(20)},
                address: {maxLength: maxLength(50)},
                city: {maxLength: maxLength(30)},
                province: {maxLength: maxLength(2)},
                postalcode: {postal: postal}
            }
        },
        methods: {
                callAPI() {
                    throw new Error("Not Implemented")
                },
                cancel() {
                    throw new Error("Not Implemented")
                },
            },

    }
</script>
