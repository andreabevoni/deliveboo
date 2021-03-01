<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
              <div class="">
                Clicca su una categoria per trovare ristoranti nella tua zona.

                <div class="typologies">
                  <span v-for="typology in typologies" :key="typology.id" @click="searchRestaurants(typology.id)">
                    {{typology.name}}
                  </span>
                </div>

                <div class="search">
                  <div v-for="restaurant in restaurants" :key="restaurant.id" class="user" @click="goRestaurants(restaurant.id)">
                    {{restaurant.restaurant_name}}
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
            typologies: Array,
        },
        data() {
          return {
            'restaurants' : [],
          };
        },
        methods: {
          // funzione per cercare i ristoranti in base alla tipologia selezionata dall'utente
          searchRestaurants: function(id) {
            axios.post('/search/' + id)
                  .then(r => {
                    console.log(r.data);
                    this.restaurants = r.data;
                  })
                  .catch(e => console.log('error', e));
          },
          // funzione per andare alla pagina show del ristorante cliccato
          goRestaurants: function(id) {
            axios.post('/restaurant/show/' + id)
                  .then(r => console.log('ok', r))
                  .catch(e => console.log('error', e));
          },
        }
    }
</script>
