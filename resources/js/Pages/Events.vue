<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Pages/Pagination.vue'

defineProps({
    events: Object,
});

</script>

<template>
    <AppLayout title="Evenements">
        <template v-for="event in events.data">
            <a :href="'/events/' + event.id">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg">
                    <img alt="Office"
                        class="h-56 w-full object-cover" 
                        :src="'storage/' + event.photo"
                        />

                    <div class="bg-white p-4 sm:p-6">
                        <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{ event.start_date }} </time>

                        <a href="#">
                            <h3 class="mt-0.5 text-lg text-gray-900">{{ event.title }}</h3>
                        </a>

                        <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                            {{ event.description }}
                        </p>
                    </div>
                </article>
            </a>
        </template>
        <Pagination :links="events.links"></Pagination>
    </AppLayout>
</template>
