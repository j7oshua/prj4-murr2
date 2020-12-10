
<template>
<div>
  ProfileForm
</div>
</template>

<script>
    import maxLength from "vuelidate/src/validators/maxLength";
    import postal from "vuelidate/src/validators/postal";

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
                firstName: {maxLength: maxLength(20)},
                lastName: {maxLength: maxLength(20)},
                address: {maxLength: maxLength(50)},
                city: {maxLength: maxLength(30)},
                province: {maxLength: maxLength(2)},
                postalCode: {postal: postal}
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
        computed: {
            state () {
                throw new Error("Not Implemented")
            }
        }

    }
</script>
