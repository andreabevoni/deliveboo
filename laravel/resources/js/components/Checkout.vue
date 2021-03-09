<template>

    <div class="row">

      <!-- stampo se il carrello é vuoto -->
      <div class="col-md-12 text-center" v-if="!cart.length">
        <h3>CARRELLO VUOTO</h3>
      </div>

      <!-- colonna con input a sinistra -->
      <div class="col-md-4" v-if="cart.length">
        <div>
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" placeholder="Inserisci nome">
          </div>

          <div class="form-group">
            <label>Cognome</label>
            <input type="text" class="form-control" placeholder="Inserisci cognome">
          </div>

          <div class="form-group">
            <label>Indirizzo</label>
            <input type="text" class="form-control" placeholder="Inserisci indirizzo">
          </div>

          <div class="form-group">
            <label>Numero di telefono</label>
            <input type="tel" class="form-control" placeholder="Inserisci telefono">
          </div>
        </div>
      </div>

      <!-- colonna con input centrale -->
      <div class="col-md-4" v-if="cart.length">
        <div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Inserisci email">
          </div>

          <div class="form-group">
            <label>Codice carta di credito</label>
            <input type="text" class="form-control" placeholder="Inserisci codice" v-model="card"></input>
          </div>

          <div class="form-group">
            <label>Codice CVC</label>
            <input type="text" class="form-control" placeholder="Inserisci codice" v-model="cvc"></input>
          </div>

          <button class="btn btn-primary" @click="testApi">Conferma Ordine</button>

          <button class="btn btn-warning" @click="testMail">Invia Mail</button>

        </div>
      </div>

      <!-- colonna con carrello a destra -->
      <div class="col-md-4" v-if="cart.length">

        <h4>
          RIEPILOGO CARRELLO
        </h4>

        <div class="cart-test d-flex flex-column">
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
              {{(foods.find(x => x.id === item.id).price / 100) * item.quantity}} &#8364;
            </div>
          </div>

          <!-- totale del carrello -->
          <div class="d-flex justify-content-between px-2">
            <span>TOTALE:</span>
            <span>{{total() / 100}} &#8364;</span>
          </div>
        </div>
      </div>

      <!-- popup di errore carta di credito -->
      <div class="modal fade" id="alert" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Errore durante il pagamento</h5>
            </div>
            <div class="modal-body">
              I dati della carta di credito non sono corretti.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
            </div>
          </div>
        </div>
      </div>

    </div>
</template>

<script>
    export default {
        props: {
          foods: Array,
          user_id: String,
          // client_token: String,
        },
        data() {
          return {
            'cart' : [],
            'errors' : [],
            'card' : '',
            'cvc' : ''
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
              let foodPrice = this.foods.find(x => x.id === this.cart[i].id).price;
              total += foodPrice * this.cart[i].quantity;
            }
            return total;
          },
          testApi: function() {
            var method = "rejected";
            if (this.card === '1234123412341234' && this.cvc === "123"){
              method = "fake-valid-visa-nonce";
            } else if (this.card === '1111222233334444' && this.cvc === "555") {
              method = "fake-processor-declined-visa-nonce";
            } else if (this.card === '9876987698769876' && this.cvc === "987") {
              method = "fake-valid-mastercard-nonce";
            } else if (this.card === '9999888877776666' && this.cvc === "000") {
              method = "fake-processor-declined-mastercard-nonce";
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
                      // se ci sono errori apro il popup di errore, altrimento proseguo
                      if (r.data.hasOwnProperty('errors')) {
                        $('#alert').modal('show');
                      } else {
                        console.log('pagamento effettuato');
                        // 1) salviamo l'ordine nel db
                        // 2) mandiamo la mail di ricevuto ordine
                        // 3) svuotiamo il carrello
                        // 4) cambiamo pagina in una che dice "pagamento effettuato"
                      }
                  })
                 .catch(e => console.log('error', e));
          },
          testMail: function() {
            axios.post('/mail/send', {
              email: 'testmail@email.it',
              order: 119,
              cart: this.cart,
              user: this.user_id
            })
            .then(r => console.log(r))
            .catch(e => console.log("error", e));
          }
        }
      }
</script>
