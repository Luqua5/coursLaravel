<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

defineProps({
    event: Array,
});

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
        </article>
    </AppLayout>
</template>
