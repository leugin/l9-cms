<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Fieldset from 'primevue/fieldset';
import Toolbar from 'primevue/toolbar';
import SplitButton from 'primevue/splitbutton';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    items: {
        default: () => []
    }
})
</script>

<template>
    <div class="layout-topbar">
        hola
    </div>

</template>
