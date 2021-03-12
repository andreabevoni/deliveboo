<template>
    <div class="cartella my-3 py-4">
        <div class="d-flex justify-content-around px-3">
            <h4 class="nome-card-food">{{ namefood }}</h4>

            <div class="text-nowrap">
                <a
                    :href="'/food/' + id + '/edit'"
                    class="btn bottone-edit-elimina"
                >
                    <i class="fas fa-pen-square"></i>
                </a>
                <a
                    :href="'/food/softdelete/' + id"
                    class="btn bottone-edit-elimina"
                >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <hr />

        <div class="d-flex justify-content-between">
            <div class="col-md-8">
                <div class="card-food-user">

                    <strong>Descrizione: </strong>{{ description }}
                </div>
                <strong>Prezzo: </strong>{{ price / 100 }} € <br />
                <strong>Disponibile: </strong>
                <span v-if="available">Sí</span>
                <span v-else>No</span>
            </div>

            <div class="col-md-4 food-img">
                <img v-if="image" :src="baseURL + image" alt="food image" />

                <img v-else :src="defaultImg" alt="food image" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            baseURL: "storage/food_images/",
            defaultImg: "img/piatto-vuoto.jpg"
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
