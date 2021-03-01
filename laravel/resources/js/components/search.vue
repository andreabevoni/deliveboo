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
                  {{number}}
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
            'number' : 1000,
          };
        },
        methods: {
          // funzione per cercare i ristoranti in base alla tipologia selezionata dall'utente
          searchRestaurants: function(id) {
            this.number = id;
          },
        }
    }
</script>
