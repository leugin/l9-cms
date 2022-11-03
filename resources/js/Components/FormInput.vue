<script setup>
import {computed} from "vue";

const props =  defineProps({
    label: String,
    error: String,
    id: String
});

const errorId = computed(() => 'error-' + props.id );
const labelId = computed(() => 'label-' + props.id );
 </script>


<template>
    <div class="field">
        <label :for="labelId">{{label}}</label>
        <slot ></slot>
        <small :id="errorId" class="p-error" >&nbsp;{{error}}</small>
    </div>
</template>



<style scoped>

</style>
