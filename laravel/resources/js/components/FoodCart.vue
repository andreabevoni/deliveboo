<template>
    <div class="row">
      <div class="col-md-8">
        <div class="menu-test">
          <div v-for="food in foods" :key="food.id">
            <!-- cibi disponibili -->
            <div v-if="food.visible" class="food-test show" @click="addCart(food.id)">
              <h4>{{food.name}}</h4>
              <div>{{food.description}}</div>
              <h6>{{food.price/100}} euro</h6>
            </div>
            <!-- cibi non disponibili -->
            <div v-else class="food-test hide">
              <h4>{{food.name}}</h4>
              <div>{{food.description}}</div>
              <h6>{{food.price/100}} euro</h6>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <!-- mostro il carrello se pieno -->
        <div class="cart-test d-flex flex-column" v-if="cart.length">

          <div class="item-test" v-for="(item, i) in cart" :key="i">
            <!-- stampo quantitá -->
            <div class="quantity">
              <i class="fas fa-minus-circle" @click="minusOne(i)"></i>
              {{item.quantity}}
              <i class="fas fa-plus-circle" @click="plusOne(i)"></i>
            </div>
            <!-- stampo il nome -->
            <div class="name">
              {{foods.find(x => x.id === item.id).name}}
            </div>
            <!-- stampo il totale -->
            <div class="total">
              {{(foods.find(x => x.id === item.id).price / 100) * item.quantity}}
            </div>
          </div>

          <a href="#" class="text-center">
            <button class="btn btn-primary">CHECKOUT</button>
          </a>

        </div>

        <!-- scrivo che il carrello é vuoto se lo é -->
        <div class="cart-test" v-else>
          <h4>CARRELLO VUOTO</h4>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        props: {
          foods: Array,
          user_id: String,
        },
        data() {
          return {
            'cart' : [],
          };
        },
        mounted() {
          if ((localStorage.cart) && (localStorage.user_id == this.user_id)) {
            this.cart = JSON.parse(localStorage.getItem("cart"));
          }
        },
        methods: {
          updateLocalStorage: function() {
            localStorage.setItem("cart", JSON.stringify(this.cart));
            localStorage.setItem("user_id", this.user_id);
          },
          addCart: function(id) {
            if (this.cart.find(x => x.id === id)) {
              this.cart.find(x => x.id === id).quantity += 1;
            } else {
              let item = {
                'id': id,
                'quantity': 1
              };
              this.cart.push(item);
            }
            this.updateLocalStorage();
          },
          removeCart: function(i) {
            this.cart.splice(i, 1);
            this.updateLocalStorage();
          },
          plusOne: function(i) {
            this.cart[i].quantity += 1;
            this.updateLocalStorage();
          },
          minusOne: function(i) {
            if (this.cart[i].quantity > 1) {
              this.cart[i].quantity -= 1;
              this.updateLocalStorage();
            } else {
              this.removeCart(i);
            }
          },
        }
      }
</script>
