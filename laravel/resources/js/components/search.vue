<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- stampo a schermo le tipologie per permettere all'utente di fare le ricerche -->
                <!-- <div class="typologies"> -->
                    <span class="typology"
                        v-for="typology in typologies"
                        :key="typology.id"
                        @click="searchRestaurants(typology.id)"
                    >
                        {{ typology.name }}
                    </span>
                <!-- </div> -->
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
            restaurants: []
        };
    },
    methods: {
        // funzione per cercare i ristoranti in base alla tipologia selezionata dall'utente
        searchRestaurants: function(id) {
            axios
                .post("/search/" + id)
                .then(r => {
                    console.log(r.data);
                    this.restaurants = r.data;
                })
                .catch(e => console.log("error", e));
        }
    }
};
</script>
