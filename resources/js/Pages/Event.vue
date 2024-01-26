<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3'

defineProps({
    event: Array,
});

function subscribe(id)
{
    router.post('/subscribe', {
        event_id: id
    });
}

</script>

<template>
    <AppLayout title="Evenement">
        <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
            <img alt="Office" class="h-56 w-full object-cover" :src="'storage/' + event.photo" />

            <div class="bg-white p-4 sm:p-6">
                <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{ event.start_date }} </time>

                <a href="#">
                    <h3 class="mt-0.5 text-lg text-gray-900">{{ event.title }}</h3>
                </a>

                <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                    {{ event.description }}
                </p>

                <div v-for="cateogry in event.categories">
                    {{ cateogry.name }}
                </div>
            </div>
            <button @click="subscribe(event.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">S'inscrire</button>
        </article>
    </AppLayout>
</template>
