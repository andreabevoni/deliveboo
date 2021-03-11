<template>
    <div class="cartella my-3 py-4">
        <div class="d-flex justify-content-around">
            <h4 class="">{{ namefood }}</h4>

            <div>
                <a
                    :href="'/food/' + id + '/edit'"
                    class="btn bottone-edit-elimina"
                >
                    <img :src="'/img/edit.png'" alt="" />
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
                <strong>Descrizione: </strong>{{ description }} <br />
                <strong>Prezzo: </strong>{{ price / 100 }} € <br />
                <strong>Disponibile: </strong>{{ available }}
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
