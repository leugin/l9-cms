<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';

import InputText from 'primevue/inputtext';
import FormInput from "@/Components/FormInput.vue";



const form = useForm({
    search: '',
    name: '',
    email: ''
});

const emit = defineEmits(['save']);



defineProps({
    show:{
        type:Boolean,
        default: false
    }
})

const submit = () => {
    const filter = {};
    for (const [key, value] of Object.entries(form.data())) {
        if(value.trim() !== '') {
            filter[key]= value;
        }
    }
    emit('save', filter);
};

</script>

<template>
    <Dialog v-model:visible="show" :style="{width: '50vw'}"  v-on:after-hide="emit('hide')">



        <form @submit.prevent="submit">
            <div class="">
                <div class=" max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 p-fluid py-3" >
                    <FormInput id="email" label="Email" >
                        <InputText type="email" v-model="form.email" id="email"  @keyup.enter="submit"  />
                    </FormInput>
                    <FormInput id="name" label="name" >
                        <InputText type="name" v-model="form.name" id="name"  @keyup.enter="submit"  />
                    </FormInput>

                </div>
            </div>
        </form>
        <template #footer>
            <Button label="Buscar" icon="pi pi-check" autofocus @click="submit" />
        </template>
    </Dialog>

</template>

<style lang="sass" scoped>
main
    height: calc(100vh - 134px)
    background-color: white
.p-paginator
    position: fixed
    bottom: 0
    width: 100%
</style>
