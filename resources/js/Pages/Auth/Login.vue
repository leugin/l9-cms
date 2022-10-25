<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';

defineProps({
    canResetPassword: Boolean,
    status: String,
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
                <h2 class="text-center">Login</h2>

                <div class="field ">
                    <span class="p-float-label">
                        <InputText id="email" type="text" v-model="form.email" />
                        <label for="email">Email</label>
                    </span>
                    <small id="username-help" class="p-error">Enter your username to reset your password.</small>

                </div>
                <div class="field">
                    <label for="password">Contraseña</label>
                    <InputText id="password" type="password" v-model="form.password" />

                </div>

                <Button label="Login" class="w-full p-3 text-xl" type="submit"></button>

            </div>
        </form>
    </GuestLayout>
</template>
