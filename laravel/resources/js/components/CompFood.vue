<template>
    <!-- <div class="container"> -->
    <!-- <div class="justify-content-center"> -->
        <div class="cartella my-3 py-4">
            <!-- <div class="card"> -->
                <!-- <div class="card-body col-md-12 d-flex"> -->

                <!-- <div class="card-header d-flex justify-content-between"> -->

                <div class="d-flex justify-content-around">

                    <h4 class="">{{ namefood }}</h4>

                    <div>
                        <a
                            :href="'/food/' + id + '/edit'"
                            class="btn bottone-edit-elimina"
                        >
                            M
                            
                        </a>
                        <a
                            :href="'/food/softdelete/' + id"
                            class="btn bottone-edit-elimina"
                        >
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <hr>
                    
                <!-- </div> -->

                <!-- /food/softdelete/{id} -->

                <!-- <div class="card-body col-md-12 d-flex"> -->
                <div class="d-flex justify-content-between">

                    <div class="col-md-8">
                        <!-- Cibo: {{ namefood }} <br> -->
                        <strong>Descrizione: </strong>{{ description }} <br/>
                        <strong>Prezzo: </strong>{{ price }} € <br/>
                        <strong>Disponibile: </strong>{{ available }}
                    </div>

                    <div class="col-md-4 food-img">
                        <img
                            v-if="image"
                            :src="baseURL + image"
                            alt="food image"
                        />

                        <img
                            v-else
                            :src="defaultImg"
                            alt="food image"
                        />
                    </div>

                </div>
                <!-- </div> -->

            <!-- </div> -->
        </div>
    <!-- </div> -->
    <!-- </div> -->
</template>

<script>
export default {
    data: function() {
        return {
            baseURL: "storage/food_images/",
            defaultImg: "storage/img/noimg.png"
        };
    },
    mounted() {
        console.log("Component food mounted.");
    },

    methods: {},

    props: {
        // prop foods
        namefood: String,
        price: Number,
        description: String,
        id: Number,
        available: Number,
        image: String
    }
};
</script>
