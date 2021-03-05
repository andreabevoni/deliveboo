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
                        Prezzo: {{ price }} € <br />
                        Disponibile: {{ available }}
                    </div>
                    <div class="col-md-4">
                        Qui Immagine del food, dolor sit amet consectetur
                        adipisicing elit. Ex temporibus quasi veniam, commodi
                        inventore sequi rem molestias possimus, nisi nobis,
                        voluptates dolorum in omnis. Sunt voluptates libero ex
                        cum! Placeat.
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
            // prop foods
            /* namefood: this.props.namefood,
            price: this.props.price,
            description: this.props.description */
        };
    },
    mounted() {
        console.log("Component mounted.");
    },

    methods: {
        deleteFood: function() {
            console.log(this.id);
            //chiamata axios in delete
            axios.delete(`http://localhost:8000/food/${this.id}`).then(res => {
                console.log(res);
            });
        }
    },

    props: {
        // prop foods
        namefood: String,
        price: Number,
        description: String,
        id: Number,
        available: Number
    }
};
</script>
