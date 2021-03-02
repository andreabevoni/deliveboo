<template>
    <!-- <div class="container"> -->
        <div class="row justify-content-center">
            <div class="col-md-10 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>

                            Cibo: {{ namefood }}
                        </h4>
                        <div>

                            <button class="btn btn-success">Modifica</button>
                            <button class="btn btn-danger">Elimina</button>
                        </div>
                    </div>

                    <div class="card-body col-md-12 d-flex">

                        <div class="col-md-8">
                            <!-- Cibo: {{ namefood }} <br> -->
                            Descrizione: {{ description }} <br>
                            Prezzo: {{ price / 100 }} €
                        </div>
                        <div class="col-md-4">
                            Qui Immagine del food, dolor sit amet consectetur adipisicing elit. Ex temporibus quasi veniam, commodi inventore sequi rem molestias possimus, nisi nobis, voluptates dolorum in omnis. Sunt voluptates libero ex cum! Placeat.
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
                namefood: this.props.namefood,
                price: this.props.price,
                description: this.props.description,

            }
        },
        mounted() {
            console.log('Component mounted.')
        },

        props: {
            // prop foods
            namefood: String,
            price: Number,
            description: String,
        }
    }
</script>