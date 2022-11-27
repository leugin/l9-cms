<script setup>
import Button from 'primevue/button';

</script>
<template>
    <div class="m-2 ">
        <Button  class=" p-button-primary p-button-raised  hamburger "  title="Abrir menu">
            <div></div>
            <div></div>
            <div></div>
        </Button>
    </div>
</template>

<style lang="sass" scoped>
.hamburger
    position: relative
    width: 40px
    height: 40px
    padding: 6px
    div
        width: 25px
        height: 3px
        background-color: white
        position: absolute
    :nth-child(1)
        top: 10px
    :nth-child(2)
        top: 17px
    :nth-child(3)
        top: 23px
</style>
