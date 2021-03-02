<template>

    <div class="food-item">

          <h4>{{ name }}</h4>
          <!-- <span>{{ description }}</span>
          <h6>{{ price}}</h6> -->
          <img src="" alt="">

    </div>
</template>

<script>
    export default {

    data: function() {
        return {

            // name: this.name,
            // description: this.description,
            // price: this.price
        };
      },
        props: {
          name: String,
          // price: Number,
          // description: String
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
