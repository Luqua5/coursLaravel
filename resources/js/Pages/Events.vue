<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Pages/Pagination.vue'

defineProps({
    events: Object,
    categories: Array,
});

</script>

<template>
    <AppLayout title="Evenements">
        <div>
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Select an option</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choose a cateogry</option>
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        </div>
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
