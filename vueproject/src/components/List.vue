<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" v-for="item in items">
        <div class="my-list">
          <img v-bind:src="'http://127.0.0.1:8000/products/'+item.image" alt=""/>
          <h3>{{item.name}}</h3>
          <span>RS:{{item.price}}</span>
          <span class="pull-right"></span>
          <div class="offer">Quantity:{{item.quantity}}</div>
          <div class="detail">
            <p>Glyphicons in Bootstrap : Bootstrap Includes over 250 glyphs in font format </p>
            <img v-bind:src="'http://127.0.0.1:8000/products/'+item.image" alt=""/>
            <router-link :to="'edit/'+item.id" class="btn btn-warning">Edit</router-link>
            <a @click="deleteItem(items,$event)" v-bind:id="item.id" class="btn btn-danger">Delete</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "List",
        // data: () => ({
        //     items: []
        // }),
        data() {
            return {
                items: []
            }
        },
        created() {
            axios
                .get('http://127.0.0.1:8000/product/list')
                .then(response => (this.items = response.data.allItems))
                .catch(error => console.log(error))
        },
        methods: {
            deleteItem(items, event) {
                axios
                    .post('http://127.0.0.1:8000/product/delete', {id: event.target.id})
                    .then(function (responce) {
                        var position = items.findIndex(function (element) {
                            return element.id == event.target.id;
                        });
                        items.splice(position, 1);
                    })
                    .catch(error => console.log(error))
            }
        }

    }


</script>

<style scoped>
  img {
    max-width: 100%;
  }

  * {
    transition: all .5s ease;
    -moz-transition: all .5s ease;
    -webkit-transition: all .5s ease
  }

  .my-list {
    width: 100%;
    padding: 10px;
    border: 1px solid #f5efef;
    float: left;
    margin: 15px 0;
    border-radius: 5px;
    box-shadow: 2px 3px 0px #e4d8d8;
    position: relative;
    overflow: hidden;
  }

  .my-list h3 {
    text-align: left;
    font-size: 14px;
    font-weight: 500;
    line-height: 48px;
    margin: 0px;
    padding: 0px;
    border-bottom: 1px solid #ccc4c4;
    margin-bottom: 5px;
    padding-bottom: 5px;
  }

  .my-list span {
    float: left;
    font-weight: bold;
  }

  .my-list span:last-child {
    float: right;
  }

  .my-list .offer {
    width: 100%;
    float: left;
    margin: 5px 0;
    border-top: 1px solid #ccc4c4;
    margin-top: 5px;
    padding-top: 5px;
    color: #afadad;
  }

  .detail {
    position: absolute;
    top: -100%;
    left: 0;
    text-align: center;
    background: #fff;
    height: 100%;
    width: 100%;

  }

  .my-list:hover .detail {
    top: 0;
  }
</style>
