<template>
  <div class="container">
    <h1>Edit Product</h1>
    <ValidationObserver ref="observer" @submit.prevent="updateProduct" v-slot="{ passes }">
      <b-form @reset="resetForm">
        <ValidationProvider rules="required" name="product" v-slot="{ valid, errors }">
          <b-form-group label="Product :" label-for="exampleInput1">
            <b-form-input
              type="text"
              v-model="item.name"
              :state="errors[0] ? false : (valid ? true : null)"
              placeholder="Enter product name"
            ></b-form-input>
            <b-form-invalid-feedback id="inputLiveFeedback">{{ errors[0] }}</b-form-invalid-feedback>
          </b-form-group>
        </ValidationProvider>

        <ValidationProvider rules="required|integer" name="quantity" vid="quantity" v-slot="{ valid, errors }">
          <b-form-group
            label="Quantity:"
          >
            <b-form-input
              type="text"
              v-model="item.quantity"
              :state="errors[0] ? false : (valid ? true : null)"
              placeholder="Enter Quantity"
            ></b-form-input>
            <b-form-invalid-feedback id="inputLiveFeedback">{{ errors[0] }}</b-form-invalid-feedback>
          </b-form-group>
        </ValidationProvider>

        <ValidationProvider rules="required|between:0,1000000" name="price" v-slot="{ valid, errors }">
          <b-form-group label="Price:" label-for="exampleInput1">
            <b-form-input
              type="text"
              v-model="item.price"
              :state="errors[0] ? false : (valid ? true : null)"
              placeholder="Price"
            ></b-form-input>
            <b-form-invalid-feedback id="inputLiveFeedback">{{ errors[0] }}</b-form-invalid-feedback>
          </b-form-group>
        </ValidationProvider>

        <ValidationProvider name="type" rules="required" v-slot="{ valid, errors }">
          <b-form-group id="exampleGroup4">
            <b-form-checkbox-group
              :state="errors[0] ? false : (valid ? true : null)"
              id="exampleChecks"
            >
              <b-form-checkbox value="WholeSale">WholeSale</b-form-checkbox>
              <b-form-checkbox value="Retail">Retail</b-form-checkbox>
            </b-form-checkbox-group>
            <b-form-invalid-feedback id="inputLiveFeedback">{{ errors[0] }}</b-form-invalid-feedback>
          </b-form-group>
        </ValidationProvider>
        <b-button type="submit" variant="primary">Submit</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
    </ValidationObserver>
  </div>
</template>

<script>
    import axios from 'axios';
    import {ValidationObserver, ValidationProvider} from "vee-validate";
    import router from "../routes";

    export default {
        name: "Edit",
        components: {
            ValidationObserver,
            ValidationProvider
        },
        created() {
            this.getData();
        },
        data: () => ({
            item: {}
        }),
        methods: {
            getData() {
                axios
                    .get('http://127.0.0.1:8000/product/view/' + this.$route.params.id, this.item)
                    .then(response => (this.item = response.data.message))
                    // .then(function (response) {
                    //     console.log(response.data.message)
                    // })
                    .catch(error => console.log(error))
            },
            resetForm() {
                this.product = "";
                this.quantity = "";
                this.price = "";
                this.type = [];
                requestAnimationFrame(() => {
                    this.$refs.observer.reset();
                });
            },
            updateProduct() {
                axios
                    .post('http://127.0.0.1:8000/product/update', this.item)
                    .then(function () {
                        router.push('/list');
                    })
            }
        },
    }
</script>

<style scoped>

</style>
