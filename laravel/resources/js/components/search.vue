<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <!-- stampo a schermo le tipologie per permettere all'utente di fare le ricerche -->
                <label class="check" v-for="typology in typologies">
                  <input  type="checkbox"
                          :value="typology.name"
                          v-model="filters"
                          @change="searchRestaurants()">
                  <span>{{ typology.name }}</span>
                </label>

                <!-- stampo i ristoranti appartenenti alla categoria selezionata dall'utente -->
                <div class="search">
                    <div
                        v-for="restaurant in restaurants"
                        :key="restaurant.id"
                        class="user"
                    >
                        <a :href="'/show/' + restaurant.id">{{
                            restaurant.restaurant_name
                        }}</a>
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
