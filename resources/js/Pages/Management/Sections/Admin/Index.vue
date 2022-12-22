<script setup>
import AuthenticatedLayout from '@/Pages/Management/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';
import DataTable from 'primevue/datatable';
import Button from 'primevue/button';
import { Link } from '@inertiajs/inertia-vue3';
import Dialog from 'primevue/dialog';

import Column from 'primevue/column';
import CrudService from  '../../../../Services/Admin'
import {onMounted, ref} from "vue";
import InputText from 'primevue/inputtext';
import FormInput from "@/Components/FormInput.vue";
import Filter from "@/Pages/Management/Sections/Admin/AdminFilter.vue";

const products = ref([]);
const showDialog = ref(false);
const totalRecords = ref(0);
const perPage = ref(50);
const loading = ref(true);

const api = new CrudService(route(usePage().props.value.route));

const onPage = (ev) => {
    load({page: ev.page + 1})
}
const form = useForm({
    search: '',
    name: '',
    email: ''
});



const hasAllow = (permission) => {
    return usePage()
        .props
        .value
        .auth
        .permissions
        .findIndex(item => item === permission) !== -1;
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
    },
    errors : {
        type: Object,
        default: {}
    }
})

onMounted(() => {
    load();
})
const submit = (filter) => {
    console.log(filter);
    // evt.preventDefault();
    // const filter = {};
    // for (const [key, value] of Object.entries(form.data())) {
    //     if(value.trim() !== '') {
    //         filter[key]= value;
    //     }
    // }
    load(filter);

};

</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout >
        <Panel style="padding: 0;" class="p-panel-content-w-full">
            <template #header>
                <div class="flex justify-between w-full	">
                    <h5 class="my-auto" style="margin-top: auto;margin-bottom: auto;">{{title}}</h5>
                    <div class="flex gap-2">
                        <div class="flex gap-1">
                            <Link :href="route('management.admins.create')"  v-if="hasAllow('management-admins-create')">
                                <Button label="Agregar" icon="pi pi-save"  class="p-button-info  p-button-sm  p-button-success"/>
                            </Link>
                        </div>
                        <div class="flex gap-1">
                            <InputText type="text" v-model="form.search" id="search" class="p-inputtext-sm" @keyup.enter="submit"  />
                            <Link>
                                <Button label="Buscar" icon="pi pi-search" autofocus @click="submit" class="  p-button-sm" />
                            </Link>
                            <Link>
                                <Button label="" icon="pi pi-filter"  class="p-button-info  p-button-sm  " @click="showDialog = true; $event.preventDefault()"/>
                            </Link>

                        </div>

                    </div>



                </div>

            </template>
            <DataTable
                :value="products"
                dataKey="id"
                :paginator="true"
                :rows="perPage"
                :totalRecords="totalRecords"
                :lazy="true"
                :loading="loading"
                :scrollable="true"
                scroll-height="calc(100vh - 190px)"
                @page="onPage($event)"
                class="table-floating-paginator "


            >
                <Column field="id" header="#" style="max-width: 30px"></Column>
                <Column field="name" header="Nombre" style="width: auto"></Column>
                <Column field="email" header="Email" style="width: auto"></Column>
                <Column  header="-" style="max-width: 240px">
                    <template #body="slotProps">
                            <span class="p-buttonset m-2">
                                <Link :href="route('management.admins.edit', [slotProps.data.id])"
                                      v-if="hasAllow('management-admins-edit')" >
                                    <Button label="Editar" icon="pi pi-pencil" class="p-button-text p-button-warning p-button-sm "
                                    />
                                </Link>
                                <Button label="Delete" icon="pi pi-trash"  class="p-button-text p-button-danger   p-button-sm "
                                        v-if="hasAllow('management-admins-delete')"
                                />
                            </span>

                    </template>
                </Column>

            </DataTable>
        </Panel>
        <Filter :show="showDialog" @save="submit"></Filter>
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
