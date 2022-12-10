<script setup>
import AuthenticatedLayout from '@/Pages/Management/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/inertia-vue3';
import DataTable from 'primevue/datatable';
import Button from 'primevue/button';
import { Link } from '@inertiajs/inertia-vue3';

import Column from 'primevue/column';
import CrudService from  '../../../../Services/Admin'
import {onMounted, ref} from "vue";
const products = ref([]);
const totalRecords = ref(0);
const perPage = ref(50);
const loading = ref(true);

const api = new CrudService(usePage().props.value.api);

const onPage = (ev) => {
    load({page: ev.page + 1})
}

const hasAllow = (permission) => {
    return usePage()
        .props
        .value
        .actions
        .findIndex(item => item.type === permission) !== -1;
}
const load = (options = {}) => {
    loading.value= true;
    api.find(
        {
            ...options,
            per_page:perPage.value
        }
    ).then((res)=> {
        products.value= res.data.data
        totalRecords.value= res.data.meta.total
        loading.value= false;
    }).catch(()=> {loading.value = false})
}
defineProps({
    api:null,
    debug:null,
    actions:{
        type:Array,
        default: []
    },
    title: {
        type: String,
        default: ''
    }
})

onMounted(() => {
    load();
    console.log(usePage().props.value)
})
</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout >
        <Panel style="padding: 0;" class="p-panel-content-w-full">
            <template #header>
                <div class="flex justify-between w-full	">
                    <h5 class="my-auto" style="margin-top: auto;margin-bottom: auto;">{{title}}</h5>
                    <div>
                        <Button label="Agregar" icon="pi pi-save"  class="p-button-info   p-button-sm  "/>

                    </div>
                </div>

            </template>
            <h3>Hola</h3>

        </Panel>
    </AuthenticatedLayout>
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
