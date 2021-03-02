<template>
    <div>

      <div v-for="n in 10" @click="change(n)" class="click">
        {{ n }}
      </div>


      <div class="selected">{{number}}</div>

      <div class="click" @click="empty">
        SVUOTA CARRELLO
      </div>

    </div>
</template>

<script>
    export default {
      data() {
        return {
          'number' : 0,
        };
      },
      mounted() {
        if (localStorage.number) {
          this.number = localStorage.number;
        }
      },
      methods: {
        change: function(x) {
          this.number = localStorage.number = x;
        },
        empty: function() {
          this.number = localStorage.number = 0;
        },
      }
    }
</script>
