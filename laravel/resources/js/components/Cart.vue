<template>
    <div>

      <div class="selected">{{number}}</div>

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
    }
</script>
