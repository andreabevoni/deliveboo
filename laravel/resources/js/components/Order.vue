<template>
    <div class="">
        <!-- stampo ordini e link alle statistiche se il ristorante ne ha ricevuti -->
        <div v-if="orders.length">

            <div class="d-flex justify-content-around mb-3 flex-wrap">
                <!-- cambio pagina ordini -->
                <div class="mb-3">
                    <select
                        class="btn btn-primary"
                        v-model="currentPage"
                        @change="filter(currentPage)"
                    >
                        <option disabled value="">Visualizza altri ordini</option>
                        <option v-for="n in pages">
                          {{n}}
                        </option>
                    </select>
                </div>

                <!-- link alle statistiche -->
                <div class="mb-3">
                    <!-- <span>Vai alle statistiche dell'anno</span> -->
                    <select
                        class="btn btn-secondary"
                        v-model="currentYear"
                        @change="charts"
                    >
                        <option disabled value="">Visualizza statistiche per anno</option>
                        <option v-for="year in years">
                            {{ year }}
                        </option>
                    </select>
                </div>

            </div>

            <!-- ordini -->
            <div v-for="order in pageOrders" class="card order">

              <div class="card-body">
                <h5 class="card-title"> <i class="far fa-sticky-note"></i>  Ordine n° {{order.id}}</h5>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong><i class="far fa-calendar"></i> Data Ordine:</strong> {{order.date}}</li>
                  <li class="list-group-item"><strong><i class="fas fa-coins"></i>  Totale Incassato:</strong> {{order.total / 100}} &#8364;</li>
                  <li class="list-group-item"><strong><i class="fas fa-pizza-slice"></i>  Piatti ordinati:</strong>
                    <span v-for="(food, i) in order.food" :key="food.id">
                      <span>
                        {{food.pivot.quantity}}x
                      </span>

                      <span v-if="i == order.food.length - 1">
                        {{food.name}}
                      </span>

                      <span v-else>
                        {{food.name}} -
                      </span>

                    </span>
                  </li>
                </ul>
              </div>

            </div>

        </div>

        <!-- stampo una immagine se il ristorante é nuovo e non ha ancora ricevuto ordini -->
        <div v-else class="col-sm-12">
            <div class="col-sm-10 col-md-6 mx-auto">
                <img class="img-fluid" src="/img/no-orders.jpg" alt="no image">
            </div>
            <h2 class="text-center py-5">
                Non hai ricevuto alcun ordine
            </h2>
        </div>

    </div>
</template>

<script>
export default {
    props: {
        orders: Array,
        years: Array
    },
    data() {
        return {
          'pages' : Math.ceil(this.orders.length / 10),
          'currentPage' : '',
          'currentYear' : '',
          'pageOrders' : [],
        };
    },
    methods: {
        filter: function(n) {
            this.pageOrders = [];
            for (var i = n * 10 - 10; i < n * 10; i++) {
                if (i < this.orders.length) {
                    this.pageOrders.push(this.orders[i]);
                };
            };
        },
        charts: function() {
            window.location.href = "http://localhost:8000/chart/" + this.currentYear;
        }
    },
    mounted() {
        this.filter(1);
    }
};
</script>
