<script setup>
import AuthenticatedLayout from '@/Pages/Management/Layouts/AuthenticatedLayout.vue';

defineProps({
    title: {
        type: String,
        default: ''
    }
})

</script>

<template>
    <AuthenticatedLayout >
        <Panel style="padding: 0;" class="p-panel-content-w-full">
            <template #header>
                <div class="flex flex-col w-full">
                    <div class="flex justify-between flex-lg-grow-1 pb-5">
                        <h5 class="my-auto" style="margin-top: auto;margin-bottom: auto;">{{title}}</h5>
                    </div>
                    <div class="flex justify-between flex-lg-grow-1	">

                        <div class="flex gap-1">

                            <slot name="panel-left">

                            </slot>

                        </div>
                        <div class="flex gap-1">
                            <slot name="panel-right">

                            </slot>

                        </div>

                    </div>

                </div>


            </template>
            <main class="p-2">
               <slot></slot>
            </main>

        </Panel>
        <slot name="extra"></slot>
    </AuthenticatedLayout>
</template>

