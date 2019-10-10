<template>
  <div class="container">
    <h1>Add Product</h1>
    <ValidationObserver ref="observer" v-slot="{ passes }">
      <b-form @submit.prevent="passes(onSubmit)" @reset="resetForm">
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

        <ValidationProvider name="image" v-slot="{ valid, errors }">
          <b-form-group label="Image:" label-for="exampleInput1">
            <b-form-file
              v-model="item.image"
              @change="getImage($event)"
              accept=".jpg, .png"></b-form-file>
            <b-form-invalid-feedback id="inputLiveFeedback">{{ errors[0] }}</b-form-invalid-feedback>
          </b-form-group>
        </ValidationProvider>

        <ValidationProvider name="type" rules="required" v-slot="{ valid, errors }">
          <b-form-group id="exampleGroup4">
            <b-form-checkbox-group
              :state="errors[0] ? false : (valid ? true : null)"
              v-model="item.type"
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
    import {ValidationObserver, ValidationProvider} from "vee-validate";
    import axios from 'axios';
    import router from "../routes";

    export default {
        name: "BootstrapForm",
        components: {
            ValidationObserver,
            ValidationProvider
        },
        data: () => ({
            item: {
                name: "",
                quantity: "",
                price: "",
                image: "",
                type: []
            }
        }),
        methods: {
            onSubmit() {
                axios
                    .post('http://127.0.0.1:8000/product/create', this.item)
                    .then(function (responce) {
                        router.push('/list')
                    })
            },
            resetForm() {
                this.name = "";
                this.quantity = "";
                this.price = "";
                this.image = "";
                this.type = [];
                requestAnimationFrame(() => {
                    this.$refs.observer.reset();
                });
            },
            getImage(e) {
                var fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.item.image = e.target.result;
                }
                console.log(this.item)
            }
        },
    };

</script>

<style scoped>

</style>
