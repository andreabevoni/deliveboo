<template>
    <div class="row">
        <!-- stampo se il carrello é vuoto -->
        <div class="col-md-12 text-center" v-if="!cart.length">
            <h3>CARRELLO VUOTO</h3>
        </div>

        <!-- colonna con form -->
        <div class="col-md-8" v-if="cart.length">
            <form @submit.prevent="testApi" method="POST">
                <input type="hidden" name="_token" :value="csrf" />
                <div class="form-group">
                    <label for="exampleInputEmail1">Indirizzo email</label>
                    <input
                        required
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Inserisci Email"
                        v-model="email"
                    />
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input
                        required
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Inserisci Nome"
                        v-model="name"
                    />
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">LastName</label>
                    <input
                        required
                        type="text"
                        class="form-control"
                        name="lastname"
                        placeholder="Inserisci Cognome"
                        v-model="lastname"
                    />
                </div>

          <div class="form-group">
            <label>Codice CVC</label>
            <input type="text" class="form-control" placeholder="Inserisci codice" v-model="cvc"></input>
          </div>

          <button class="btn btn-primary" @click="testApi">Conferma Ordine</button>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input
                        required
                        type="text"
                        class="form-control"
                        name="address"
                        placeholder="Inserisci Indirizzo"
                        v-model="address"
                    />
                </div>

          <button class="btn btn-warning" @click="testMail">Invia Mail</button>
                <div class="form-group">
                    <label for="exampleInputEmail1">Numero di telefono</label>
                    <input
                        required
                        type="text"
                        class="form-control"
                        name="phone_number"
                        placeholder="Inserisci numero di telefono"
                        v-model="phone_number"
                    />
                </div>

                <div class="form-group">
                    <label>Codice carta di credito</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Inserisci codice"
                        name="card"
                        v-model="card"
                    />
                </div>

                <button type="submit" class="btn btn-primary">
                    Conferma Ordine
                </button>
                <button type="submit" class="btn btn-primary">
                    Prova
                </button>
            </form>
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
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            cart: [],
            card: "",
            email: "",
            name: "",
            lastname: "",
            phone_number: "",
            address: ""
        };
    },
    mounted() {
        if (localStorage.cart && localStorage.user_id == this.user_id) {
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
            if (this.card === "1234123412341234") {
                method = "fake-valid-visa-nonce";
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
                        console.log("carta non valida!");
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
                            total: this.total() / 100
                        };
                        // console.log("prova");
                        axios
                            .post("http://localhost:8000/api/orders", order)
                            .then(r => {
                                console.log(r.data);
                            })
                            .catch(e => console.log("error", e));
                        // 2) mandiamo la mail di ricevuto ordine

                        // 3) svuotiamo il carrello
                        localStorage.cart = [];
                        // this.cart = [];
                        // localStorage.setItem("cart", JSON.stringify(this.cart));

                        // 4) cambiamo pagina in una che dice "pagamento effettuato"
                    }
                })
                .catch(e => console.log("error", e));
        },
        prova: function() {
            alert("form");
            console.log("prova");
            const order = {
                name: this.name,
                lastname: this.lastname,
                phone_number: this.phone_number,
                address: this.address,
                cart: this.cart,
                email: this.email,
                total: this.total() / 100
            };
            // console.log("prova");
            axios
                .post("http://localhost:8000/api/orders", order)
                .then(r => {
                    console.log(r.data);
                })
                .catch(e => console.log("error", e));
        },
        testMail: function() {
            axios.post('/mail/send', {
              email: 'testmail@email.it',
              cart: this.cart,
              user: this.user_id
            })
            .then(r => console.log(r))
            .catch(e => console.log("error", e));
          }
    }
};
</script>
