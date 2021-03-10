<template>
    <!-- <div class="container"> -->
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>{{ namefood }}</h4>
                    <div>
                        <a
                            :href="'/food/' + id + '/edit'"
                            class="btn btn-success"
                            >Modifica</a
                        >
                        <a
                            :href="'/food/softdelete/' + id"
                            class="btn btn-danger"
                        >
                            Elimina
                        </a>
                    </div>
                </div>

                <!-- /food/softdelete/{id} -->

                <div class="card-body col-md-12 d-flex">
                    <div class="col-md-8">
                        <!-- Cibo: {{ namefood }} <br> -->
                        Descrizione: {{ description }} <br />
                        Prezzo: {{ price / 100 }} € <br />
                        Disponibile: {{ available ? "Si" : "No" }}
                    </div>
                    <div class="col-md-4">
                        <img
                            v-if="image"
                            :src="baseURL + image"
                            width="200px"
                            height="200px"
                            alt="food image"
                        />

                        <img
                            v-else
                            :src="defaultImg"
                            width="200px"
                            height="200px"
                            alt="food image"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
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
