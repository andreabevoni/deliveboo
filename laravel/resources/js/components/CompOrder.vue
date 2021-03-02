<template>
    <!-- <div class="container"> -->
        <div class="row justify-content-center">
            <div class="col-md-10 mb-3">
                <div class="card">
                    <div class="card-header">
                        Email: {{ email }} <br>
                        Nome: {{ nameguest }} <br>
                        Totale: {{ total }}
                    </div>

                    <div class="card-body">
                        Cibo: {{ namefood }} <br>
                        Descrizione: {{ description }} <br>
                        Prezzo: {{ price / 100 }} €
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
                // prop di orders
                email: this.props.email,
                nameguest: this.props.nameguest,
                total: this.props.nameguest
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
            // prop di orders
            email: String,
            nameguest: String,
            total: Number
        }
    }
</script>