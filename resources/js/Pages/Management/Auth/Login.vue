<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm , usePage} from '@inertiajs/inertia-vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import FormInput from "@/Components/FormInput.vue";
defineProps({
    canResetPassword: Boolean,
    status: String,
    errors : {
        type: Object,
        default: {}
    }
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <form @submit.prevent="submit">
            <div class="card p-fluid">
                <h2 class="text-center">Admin Login</h2>
                <FormInput id="email" label="Email" :error="errors.email">
                    <InputText type="text" v-model="form.email" id="email" />
                </FormInput>
                <FormInput id="password" label="Password" :error="errors.password">
                    <InputText type="password" v-model="form.password" id="email" />
                </FormInput>
                <Button label="Login" class="w-full p-3 text-xl" type="submit"></button>



            </div>
        </form>
    </GuestLayout>
</template>

<style scoped lang="scss">
.field {
    width: 400px;
}
</style>
