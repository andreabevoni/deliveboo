<template>
    <div class="row">
        <!-- colonna schede cibi -->
        <div class="col-md-8">
            <div class="menu">
                <div v-for="food in foods" :key="food.id">
                    <!-- cibi disponibili -->
                    <div
                        v-if="food.visible"
                        class="card food-item show"
                        @click="resetQuantity"
                        style="width: 18rem;"
                        data-toggle="modal"
                        :data-target="'#myModal' + food.id"
                    >
                        <img
                            src="https://flawless.life/wp-content/uploads/2016/03/lievita-pizza-gourmet.jpg"
                            class="card-img-top"
                            alt="immagine piatto"
                        />
                        <h4>{{ food.name }}</h4>
                        <div>{{ food.description }}</div>
                        <h6>{{ food.price / 100 }} &#8364;</h6>
                    </div>

                    <!-- cibi non disponibili -->
                    <div
                        v-else
                        class="card food-item hide"
                        style="width: 18rem;"
                    >
                        <img
                            src="https://flawless.life/wp-content/uploads/2016/03/lievita-pizza-gourmet.jpg"
                            class="card-img-top"
                            alt="immagine piatto"
                        />
                        <h4>{{ food.name }}</h4>
                        <div>{{ food.description }}</div>
                        <h6>{{ food.price / 100 }} &#8364;</h6>
                    </div>

                    <!-- scheda popup-->
                    <div
                        :id="'myModal' + food.id"
                        class="modal fade"
                        role="dialog"
                    >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <!-- scheda del cibo -->
                                    <img
                                        src="https://flawless.life/wp-content/uploads/2016/03/lievita-pizza-gourmet.jpg"
                                        class="card-img-top"
                                        alt="immagine piatto"
                                    />
                                    <div class="food-item">
                                        <h4>{{ food.name }}</h4>
                                        <span>{{ food.description }}</span>
                                        <div class="price">
                                            <h6>
                                                {{ food.price / 100 }} &#8364;
                                            </h6>
                                        </div>
                                        <!-- parte con il numero di cibi da inserire -->
                                        <div class="">
                                            <i
                                                class="fas fa-minus-circle"
                                                @click="minusOne"
                                            ></i>
                                            {{ quantity }}
                                            <i
                                                class="fas fa-plus-circle"
                                                @click="plusOne"
                                            ></i>
                                        </div>
                                        <!-- pulsante di conferma e di annulla -->
                                        <button
                                            type="button"
                                            name="button"
                                            data-dismiss="modal"
                                            @click="checkCart(food.id)"
                                        >
                                            Aggiungi al carrello
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-default"
                                            data-dismiss="modal"
                                        >
                                            Annulla
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- colonna carrello -->
        <div class="col-md-4">
            <!-- mostro il carrello se pieno -->
            <div
                class="cart-test d-flex flex-column sticky-top"
                v-if="cart.length"
            >
                <div class="item-test" v-for="(item, i) in cart" :key="i">
                    <!-- stampo quantitá -->
                    <div class="quantity">
                        <i
                            class="fas fa-minus-circle"
                            @click="minusOneCart(i)"
                        ></i>
                        {{ item.quantity }}
                        <i
                            class="fas fa-plus-circle"
                            @click="plusOneCart(i)"
                        ></i>
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

                <div class="d-flex justify-content-between px-2">
                    <span>TOTALE:</span>
                    <span>{{ total() }} &#8364;</span>
                </div>

                <a :href="'/checkout/' + user_id" class="text-center">
                    <button class="btn btn-primary">CHECKOUT</button>
                </a>
            </div>

            <!-- scrivo che il carrello é vuoto se lo é -->
            <div class="cart-test sticky-top" v-else>
                <h4>CARRELLO VUOTO</h4>
            </div>
        </div>

        <!-- pop up di conferma se stai creando un carrello nuovo -->
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
                            Vuoi creare un nuovo carrello?
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        In questo modo cancelli il carrello esistente da
                        {{ old_cart }} e crei un nuovo carrello da
                        {{ user_name }}.
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Annulla
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            @click="addCart(id_food)"
                        >
                            Nuovo Carrello
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
        user_id: String,
        user_name: String
    },
    data() {
        return {
            cart: [],
            quantity: 1,
            id_food: 0,
            old_cart: ""
        };
    },
    mounted() {
        // controllo se esiste giá un carrello per questo ristorante, in tal caso me lo recupero
        console.log(localStorage.cart);
        console.log(localStorage.user_name);
        if (localStorage.cart && localStorage.user_id == this.user_id) {
            this.cart = JSON.parse(localStorage.getItem("cart"));
        }
        // recupero il nome del ristorante collegato al carrello salvato in memoria
        this.old_cart = localStorage.user_name;
        console.log(JSON.parse(localStorage.cart).length);
    },
    methods: {
        // funzione per salvare in localStorage i vari dati che servono
        updateLocalStorage: function() {
            if (this.cart.length > 0) {
                localStorage.setItem("cart", JSON.stringify(this.cart));
            } else {
                localStorage.removeItem("cart");
            }
            localStorage.setItem("user_id", this.user_id);
            localStorage.setItem("user_name", this.user_name);
        },
        // funzione per resettare la quantitá indicata nella card del cibo sempre a 1
        resetQuantity: function() {
            this.quantity = 1;
        },
        // funzione per aumentare la quantitá ordinabile nella card
        plusOne: function() {
            this.quantity += 1;
        },
        // funzione per diminuire la quantitá ordinabile nella card
        minusOne: function() {
            if (this.quantity > 1) this.quantity -= 1;
        },
        // funzione per controllare se esiste giá un carrello con un ristoratore differente (apre un alert di conferma)
        checkCart: function(id) {
            if (!localStorage.cart || localStorage.user_id == this.user_id) {
                this.addCart(id);
            } else {
                this.id_food = id;
                $("#alert").modal("show");
            }
        },
        // funzione per aggiungere un cibo al carrello
        addCart: function(id) {
            // se il cibo é giá presente nel carrello, aggiungo la nuova quantitá senza creare un nuovo oggetto
            if (this.cart.find(x => x.id === id)) {
                this.cart.find(x => x.id === id).quantity += this.quantity;
            } else {
                let item = {
                    id: id,
                    quantity: this.quantity
                };
                this.cart.push(item);
            }
            this.updateLocalStorage();
        },
        // funzione per rimuovere un cibo al carrello
        removeCart: function(i) {
            this.cart.splice(i, 1);
            this.updateLocalStorage();
        },
        // funzione per aumentare la quantitá di un cibo nel carrello
        plusOneCart: function(i) {
            this.cart[i].quantity += 1;
            this.updateLocalStorage();
        },
        // funzione per diminuire la quantitá di un cibo nel carrello
        minusOneCart: function(i) {
            if (this.cart[i].quantity > 1) {
                this.cart[i].quantity -= 1;
                this.updateLocalStorage();
            } else {
                this.removeCart(i);
            }
        },
        // funzione per calcolare dinamicamente il totale del carrello
        total: function() {
            let total = 0;
            for (var i = 0; i < this.cart.length; i++) {
                let foodPrice = this.foods.find(x => x.id === this.cart[i].id)
                    .price;
                total += foodPrice * this.cart[i].quantity;
            }
            return total / 100;
        }
    }
};
</script>
