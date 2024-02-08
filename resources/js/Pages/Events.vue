<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Pages/Pagination.vue';
import { router } from '@inertiajs/vue3';
import { watch, ref } from 'vue';


defineProps({
    events: Object,
    categories: Array,
    cities: Array,
    articlePerPage: Number
});

const city = ref("");
const category = ref("");

watch([category, city], () => {
    router.post('/events', {
        category: category.value,
        city: city.value
    });
});

</script>

<template>
    <AppLayout title="Evenements" >
        <div class="mx-56">
        <div>
            <label for="categories" class="block mb-2 text-sm font-medium text-gray-900">Select une categorie</label>
            <select v-model="category" id="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" selected>Choose a category</option>
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        </div>
        <div>
            <label for="cities" class="block mb-2 text-sm font-medium text-gray-900">Select une ville</label>
            <select v-model="city" @change="changeCategoryCity" id="cities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="" selected>Choose a ville</option>
                <option v-for="city in cities" :value="city.location">{{ city.location }}</option>
            </select>
        </div>
        <div class="grid grid-cols-4 gap-8 auto-cols-max mt-4">
        <template v-for="event in events.data">
            <a :href="'/events/' + event.id">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg h-full">
                    <div class="h-56 overflow-hidden"><img alt="Office"
                        class="h-56 w-full object-cover transition-all duration-[1s] hover:h-96 hover:mt-[-70px]"
                        :src="'storage/' + event.photo"
                        /></div>

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
        </div>
            <Pagination v-if="events.data.length > articlePerPage - 1" :links="events.links" class="flex justify-around"></Pagination>
        </div>
    </AppLayout>
</template>

