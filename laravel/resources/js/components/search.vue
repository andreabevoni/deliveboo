<template>
    <div class="container-fluid">
        <div class="row justify-content-center mx-5">
            <div class="col-12 d-flex">
                <div class="d-flex flex-column align-items-start mt-5 bg-white">

                    <!-- stampo a schermo le tipologie per permettere all'utente di fare le ricerche -->
                    <label class="check" v-for="typology in typologies">
                    <input  type="checkbox"
                            :value="typology.name"
                            v-model="filters"
                            @change="searchRestaurants()">
                    <span>{{ typology.name }}</span>
                    </label>
                </div>

                <!-- stampo i ristoranti appartenenti alla categoria selezionata dall'utente -->
                <div class="search d-flex">
                    <div
                        v-for="restaurant in restaurants"
                        :key="restaurant.id"
                        class="user"
                    >
                        <div class="my-3">
                            <img :src="'/storage/icon/210326_1614854447.jpg'" alt="">
                        </div>
                        <div>

                            <a :href="'/show/' + restaurant.id">{{
                                restaurant.restaurant_name
                            }}</a>
                            <br>{{restaurant.address}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        typologies: Array
    },
    data() {
        return {
            restaurants: [],
            filters: []
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
