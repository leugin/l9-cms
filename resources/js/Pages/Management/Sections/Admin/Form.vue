<script setup>
import AuthenticatedLayout from '@/Pages/Management/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, usePage} from '@inertiajs/inertia-vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import FormInput from "@/Components/FormInput.vue";
import {computed, onMounted, ref} from "vue";
const perPage = ref(50);
const loading = ref(true);
defineProps({
    title:{
        type:String,
        default:''
    },
    model: {
        type:Object,
        default: null
    },
    errors : {
        type: Object,
        default: {}
    }
});

const canSave = computed(() => usePage().props.value.auth.permissions.findIndex(val => val === 'management-admins-store'));
const canEdit = computed(() => usePage().props.value.auth.permissions.findIndex(val => val === 'management-admins-update'));
const isEdit = computed(() => !!usePage().props.value.model?.id);
const form = useForm({
    name: '',
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    if (usePage().props.value.model) {
        form.put(route('management.admins.update',[usePage().props.value.model.id]), {
            onSuccess: (res) => {
                console.log(res)
            }
        });
    } else  {
        form.post(route('management.admins.store'), {
            onFinish: () => form.reset('password'),
            onSuccess: (res) => {
                console.log(res)
            }
        });
    }

};

onMounted(() => {
    if (usePage().props.value.model) {
        const model = usePage().props.value.model;
        form.name = model.name;
        form.email = model.email;
    }
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
                        <Button label="Guardar" icon="pi pi-save"  class="p-button-info p-button-sm" @click="submit" v-if="canSave && !isEdit"/>
                        <Button label="Actualizar" icon="pi pi-pencil"  class="p-button-info p-button-sm" @click="submit" v-if="canEdit && isEdit"/>

                    </div>
                </div>

            </template>

            <form @submit.prevent="submit">
                <div class="">
                    <div class=" max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 p-fluid py-3" style="height: calc(100vh - 130px); overflow:auto;">
                        <FormInput id="name" label="Nombre" :error="errors.name">
                            <InputText type="text" v-model="form.name" id="name" />
                        </FormInput>
                        <FormInput id="email" label="Email" :error="errors.email">
                            <InputText type="email" v-model="form.email" id="email" />
                        </FormInput>
                        <FormInput id="password" label="Password" :error="errors.password" v-if="!isEdit">
                            <InputText type="password" v-model="form.password" id="email" />
                        </FormInput>
                    </div>
                </div>
            </form>

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
