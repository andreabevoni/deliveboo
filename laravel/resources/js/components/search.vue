<template>
    <!-- <div class="container-fluid"> -->
        <div class="row justify-content-center mx-5">
            <div class="col-sm-12 d-md-flex altezza">
                
                <div class="d-flex flex-sm-wrap flex-md-column align-items-start align-self-start mt-5 bg-white cartella">

                    <!-- stampo a schermo le tipologie per permettere all'utente di fare le ricerche -->
                    <label class="check" v-for="typology in typologies" :key="typology">
                    <input  type="checkbox"
                            :value="typology.name"
                            v-model="filters"
                            @change="searchRestaurants()">
                    <span>{{ typology.name }}</span>
                    </label>
                </div>

                <!-- stampo i ristoranti appartenenti alla categoria selezionata dall'utente -->
                <div class="col-sm-10 d-flex flex-wrap align-items-start m-5">

                    <div
                        v-for="restaurant in restaurants"
                        :key="restaurant.id"
                        class="user text-left"
                    >

                        <a :href="'/show/' + restaurant.id">
                            <div class="image">
                                <img class="img-fluid max-width: 100%" :src="'/storage/icon/nulla.png'" alt="" v-if="restaurant.image == null">
                                <img class="img-fluid max-width: 100%" :src="'/storage/icon/' + restaurant.image" alt="" v-else>
                            </div>
                            <div class="p-3 testo-user">
                                <h4>
                                    <strong>
                                        {{ restaurant.restaurant_name }}
                                    </strong>
                                </h4>
                                <span>

                                    {{restaurant.address}} <br>
                                    Tel: {{restaurant.phone}}
                                </span>
                            </div>
                        </a>

                    </div>

                </div>
            </div>
        </div>
    <!-- </div> -->
</template>

<script>
export default {
    props: {
        typologies: Array
    },
    data() {
        return {
            restaurants: [],
            filters: [],
            img: "/img/user-img/"
        };
    },
    methods: {
        // funzione per cercare i ristoranti in base alla tipologia selezionata dall'utente
        searchRestaurants: function() {
          axios.post('/search', {
            filters: this.filters,
          })
          .then(r => {
            this.restaurants = r.data;
          })
          .catch(e => console.log("error", e));
        },
    },
    mounted() {
      this.searchRestaurants();
    }
};
</script>
