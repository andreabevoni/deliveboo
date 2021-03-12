<template>
    <div class="row">
        <!-- stampo se il carrello é vuoto -->
        <div class="col-md-12 text-center" v-if="!cart.length">
          <h5 class="alert"><i class="fas fa-shopping-cart"></i>
             Il tuo carrello è vuoto
          </h5>
        </div>

        <!-- colonna con form -->
        <div class="col-md-8" v-if="cart.length">

            <form @submit.prevent="testApi" method="POST" class="checkout">
                <input type="hidden" name="_token" :value="csrf" />
                <div class="subtitle">
                  <h5>Inserisci i tuoi dati per completare l'ordine</h5>
                </div>

              <div class="d-flex justify-content-center">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Nome</strong></label>
                    <input
                        required
                        minlength="2"
                        maxlength="60"
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Inserisci Nome"
                        v-model="name"
                    />
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Cognome</strong></label>
                    <input
                        required
                        minlength="2"
                        maxlength="60"
                        type="text"
                        class="form-control"
                        name="lastname"
                        placeholder="Inserisci Cognome"
                        v-model="lastname"
                    />
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Indirizzo email</strong></label>
                    <input
                        required
                        minlength="5"
                        maxlength="100"
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Inserisci Email"
                        v-model="email"
                    />
                </div>
              </div>

          <!-- <div class="form-group">
            <label><strong>Codice CVC</strong></label>
            <input type="text" class="form-control" placeholder="Inserisci codice" v-model="cvc">
          </div> -->

          <!-- <button class="btn" @click="testApi"><strong>Conferma Ordine</strong></button> -->
              <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Numero carta di credito</strong></label>
                    <input
                        required
                        minlength="16"
                        maxlength="16"
                        type="text"
                        class="form-control"
                        placeholder="Inserisci codice"
                        name="card"
                        v-model="card"
                    />
                </div>

          <!-- <button class="btn mail" @click="testMail">
            <i class="fas fa-envelope"></i>
            Ricevi Mail di conferma
          </button> -->
                <div class="form-group">
                    <label><strong>Codice CVC</strong></label>
                    <input
                        required
                        maxlength="3"
                        minlength="3"
                        type="text"
                        class="form-control"
                        placeholder="Inserisci codice"
                        v-model="cvc"
                    />
                </div>

                <!-- <button class="btn btn-primary" @click="testApi">Conferma Ordine</button> -->
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Indirizzo di consegna</strong></label>
                    <input
                        required
                        maxlength="100"
                        type="text"
                        class="form-control"
                        name="address"
                        placeholder="Inserisci Indirizzo"
                        v-model="address"
                    />
                </div>

                <!-- <button class="btn btn-warning" @click="testMail"> -->
                <!-- </button> -->
                <div class="form-group">
                    <label for="exampleInputEmail1"><strong>Numero di telefono</strong></label>
                    <input
                        required
                        maxlength="30"
                        type="text"
                        class="form-control"
                        name="phone_number"
                        placeholder="Inserisci numero di telefono"
                        v-model="phone_number"
                    />
                </div>
              </div>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-6">
                  <button type="submit" class="btn submit">
                      Conferma Ordine
                  </button>
                </div>
              </div>

            </form>
        </div>

        <!-- colonna con carrello -->
        <div class="col-md-4" v-if="cart.length">
            ​
            <h4>
                <i class="fas fa-cart-arrow-down"></i>
                  RIEPILOGO CARRELLO
            </h4>
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
                            (foods.find(x => x.id === item.id).price *
                                item.quantity) /
                                100
                        }}
                        &#8364;
                    </div>
                </div>
                <!-- totale del carrello -->

                <div class="d-flex justify-content-between px-2">
                    <span>TOTALE:</span>
                    <span>{{ total() / 100 }} &#8364;</span>
                </div>
            </div>
        </div>

        <!-- popup di errore carta di credito -->
        <div
            class="modal fade"
            id="alert"
            data-backdrop="static"
            data-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Errore durante il pagamento
                        </h5>
                    </div>
                    <div class="modal-body">
                        I dati della carta di credito non sono corretti.
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Chiudi
                        </button>
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
        user_id: String
    },
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            cart: [],
            card: "",
            email: "",
            name: "",
            lastname: "",
            phone_number: "",
            address: "",
            errors: [],
            cvc: ""
        };
    },
    mounted() {
        if (localStorage.cart && localStorage.user_id == this.user_id) {
            this.cart = JSON.parse(localStorage.getItem("cart"));
        }
    },
    methods: {
        updateLocalStorage: function() {
            if (this.cart.length > 0) {
                localStorage.setItem("cart", JSON.stringify(this.cart));
            } else {
                localStorage.removeItem("cart");
            }
            localStorage.setItem("user_id", this.user_id);
            // localStorage.setItem("user_name", this.user_name);
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
            var method = "rejected";
            if ((this.card === "1234123412341234") && (this.cvc === "123")) {
                method = "fake-valid-visa-nonce";
            } else if ((this.card === "1111222233334444") && (this.cvc === "555")) {
                method = "fake-valid-visa-nonce";
            } else if ((this.card === "9876987698769876") && (this.cvc === "987")) {
                method = "fake-valid-mastercard-nonce";
            } else if ((this.card === "9999888877776666") && (this.cvc === "000")) {
                method = "fake-valid-mastercard-nonce";
            }
            const headers = {
                Authorization:
                    "Basic cG54M3BmcndwcnZjbmh4ZDpjZDJkOGZmYzU3ZjQyNmQ2N2ZjM2FmMjgyYTE4M2RkNQ==",
                "Braintree-Version": "2021-03-08"
            };
            const data = {
                query:
                    "mutation chargePaymentMethod($input: ChargePaymentMethodInput!) {chargePaymentMethod(input: $input) {transaction {id status}}}",
                variables: {
                    input: {
                        paymentMethodId: method,
                        transaction: { amount: this.total() / 100 }
                    }
                }
            };
            // chiamata axios a braintree
            axios
                .post(
                    "https://payments.sandbox.braintree-api.com/graphql",
                    data,
                    { headers }
                )
                .then(r => {
                    console.log("data", r.data);

                    if (r.data.hasOwnProperty("errors")) {
                        $("#alert").modal("show");
                        console.log("carta non valida!");
                        $("#alert").modal("show");
                    } else {
                        console.log("pagamento effettuato");
                        // 1) salviamo l'ordine nel db
                        const order = {
                            name: this.name,
                            lastname: this.lastname,
                            phone_number: this.phone_number,
                            address: this.address,
                            cart: this.cart,
                            email: this.email,
                            total: this.total(),
                            user: this.user_id
                        };
                        // console.log("prova");
                        console.log(localStorage);
                        axios
                            .post("http://localhost:8000/api/orders", order)
                            .then(r => {
                                // 2) mandiamo la mail di ricevuto ordine
                            })
                            .catch(e => console.log("error", e));
                        // 3) svuotiamo il carrello
                        localStorage.removeItem("cart");
                        console.log(localStorage);
                        // 4) cambiamo pagina in una che dice "pagamento effettuato"
                        window.location.href = "http://localhost:8000/payed";
                    }
                })
                .catch(e => console.log("error", e));
        }
    }
};
</script>
