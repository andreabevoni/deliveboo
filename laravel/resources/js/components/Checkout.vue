<template>
    <div class="row">
        <!-- stampo se il carrello é vuoto -->
        <div class="col-md-12 text-center" v-if="!cart.length">
            <h3>CARRELLO VUOTO</h3>
        </div>

        <!-- colonna con form -->
        <div class="col-md-8" v-if="cart.length">
            <form method="POST" action="/orders">
                <div class="form-group">
                    <input type="hidden" name="_token" :value="csrf" />

                    <label for="exampleInputEmail1">Indirizzo email</label>
                    <input
                        required
                        type="email"
                        class="form-control"
                        placeholder="Inserisci Email"
                    />
                </div>
      <!-- colonna con form -->
      <div class="col-md-8" v-if="cart.length">
        <form>
          <div class="form-group">
            <label>Indirizzo email</label>
            <input type="email" class="form-control" placeholder="Inserisci email">
          </div>

                <button type="submit" class="btn btn-primary">
                    Conferma Ordine
                </button>
            </form>
        </div>
          <div class="form-group">
            <label>Codice carta di credito</label>
            <input type="text" class="form-control" placeholder="Inserisci codice" v-model="card"></input>
          </div>

          <button class="btn btn-primary" @click="testApi">Conferma Ordine</button>
        </form>

        <button class="btn btn-primary" @click="testApi">testa</button>

      </div>

        <!-- colonna con carrello -->
        <div class="col-md-4" v-if="cart.length">
            <div class="cart-test d-flex flex-column">
                <div class="item-test" v-for="(item, i) in cart" :key="i">
                    <!-- stampo quantitá -->
                    <div class="quantity">
                        <i class="fas fa-minus-circle" @click="minusOne(i)"></i>
                        {{ item.quantity }}
                        <i class="fas fa-plus-circle" @click="plusOne(i)"></i>
                    </div>
                    <!-- stampo il nome -->
                    <div class="name">
                        {{ foods.find(x => x.id === item.id).name }}
                    </div>
                    <!-- stampo il totale -->
                    <div class="total">
                        {{
                            (foods.find(x => x.id === item.id).price / 100) *
                                item.quantity
                        }}
                        &#8364;
                    </div>
                </div>

                <div class="d-flex justify-content-between px-2">
                    <span>TOTALE:</span>
                    <span>{{ total() / 100 }} &#8364;</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        foods: Array,
        user_id: String
    },
    data() {
        return {
            cart: [],
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        };
    },
    mounted() {
        if (localStorage.cart && localStorage.user_id == this.user_id) {
    export default {
        props: {
          foods: Array,
          user_id: String,
        },
        data() {
          return {
            'cart' : [],
            'card' : ''
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
        total: function() {
            let total = 0;
            for (var i = 0; i < this.cart.length; i++) {
                let foodPrice = this.foods.find(x => x.id === this.cart[i].id)
                    .price;
                total += foodPrice * this.cart[i].quantity;
            }
            return total;
          },
          testApi: function() {
            var method = "nope";
            if (this.card === '1234123412341234') {
              method = "fake-valid-visa-nonce";
            }
            const headers = {
              "Authorization": "Basic cG54M3BmcndwcnZjbmh4ZDpjZDJkOGZmYzU3ZjQyNmQ2N2ZjM2FmMjgyYTE4M2RkNQ==",
              "Braintree-Version": "2021-03-08"
            };
            const data = {"query": "mutation chargePaymentMethod($input: ChargePaymentMethodInput!) {chargePaymentMethod(input: $input) {transaction {id status}}}" , "variables": {"input": {"paymentMethodId": method, "transaction": {"amount": this.total()/100}}}}
            // chiamata axios a braintree
            axios.post('https://payments.sandbox.braintree-api.com/graphql', data, { headers })
                 .then(r => {
                      console.log('data', r.data);

                      if (r.data.hasOwnProperty('errors')) {
                        console.log('carta non valida!')
                      } else {
                        console.log('pagamento effettuato');
                        // 1) salviamo l'ordine nel db
                        // 2) mandiamo la mail di ricevuto ordine
                        // 3) svuotiamo il carrello
                        // 4) cambiamo pagina in una che dice "pagamento effettuato"
                      }
                  })
                 .catch(e => console.log('error', e));
          }
        }
    }
};
</script>
