<template>
    <div class="food-item">
        <h4>{{ name }}</h4>
        <span>{{ description }}</span>
        <div class="price">
            <h6>{{ price / 100 }} euro</h6>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            name: this.props.name,
            description: this.props.description,
            price: this.props.price
        };
    },
    props: {
        name: String,
        price: Number,
        description: String
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
