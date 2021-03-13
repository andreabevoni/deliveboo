<template>
  <div>

    <div class="d-flex justify-content-between">
        <!-- cambio pagina ordini -->
        <div class="">
            <select v-model="currentPage" @change="filter(currentPage)">
              <option v-for="n in pages">
                {{n}}
              </option>
            </select>
            <span>Cambia Pagina</span>
        </div>

        <!-- link alle statistiche -->
        <div class="">
            <span>
                <a :href="'/chart/' + currentYear" class="text-decoration-none">
                    Vai alle statistiche per l'anno:
                </a>
            </span>
            <select v-model="currentYear" @change="">
              <option v-for="year in years">
                {{year}}
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
</template>

<script>
export default {
    props: {
        orders: Array,
        years: Array,
    },
    data() {
        return {
          'pages' : Math.ceil(this.orders.length / 10),
          'currentPage' : 1,
          'currentYear' : this.years[0],
          'pageOrders' : [],
        };
    },
    methods: {
        filter: function (n) {
            this.pageOrders = [];
            for (var i = (n * 10 - 10); i < (n * 10); i++) {
                if (i < this.orders.length) {
                    this.pageOrders.push(this.orders[i]);
                };
            };
        }
    },
    mounted() {
        this.filter(1);
    }
};
</script>
