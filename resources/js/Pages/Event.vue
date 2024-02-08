<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3'
import DialogModal from "@/Components/DialogModal.vue";

defineProps({
    event: Array,
    isSubscribed: Boolean,
    categories: Array,
    cities: Array
});

function subscribe(id)
{
    router.post('/subscribe', {
        event_id: id
    });
}

function unsubscribe(id)
{
    router.post('/unsubscribe', {
        event_id: id
    });
}

</script>

<template>

    <AppLayout title="Evenement">
        <div class="fixed w-screen h-screen top-0 overflow-hidden">
            <div class="absolute top-0 w-screen h-screen backdrop-blur-3xl"></div>
            <img alt="Office" class="object-cover w-full h-full " :src="'../storage/' + event.photo" />
        </div>
        <div class="absolute top-24 pb-24">
        <div class="mx-56 mt-12 relative z-2">
        <article class="overflow-hidden rounded-lg shadow transition drop-shadow-xl hover:shadow-2xl">
            <img alt="Office" class="h-96 w-full object-cover" :src="'../storage/' + event.photo" />

                <div class="bg-white p-4 sm:p-6">
                    <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{ event.start_date }} </time>

                    <a href="#">
                        <h3 class="mt-0.5 text-5xl font-bold text-gray-900">{{ event.title }}</h3>
                    </a>

                    <p class="mt-2 line-clamp-3 text-lg/relaxed text-gray-500">
                        {{ event.description }}
                    </p>

                <div v-for="cateogry in event.categories">
                    {{ cateogry.name }}
                </div>
            </div>
            <div class="flex justify-around bg-white">
            <button v-if="!isSubscribed" @click="subscribe(event.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">S'inscrire</button>
            <button v-if="isSubscribed" @click="unsubscribe(event.id)" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Se desinscrire</button>
            </div>
        </article>
        </div>

        <div class="mx-56 mt-12 relative z-2">
            <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg bg-white  p-4 sm:p-6">
                <h3 class="mt-0.5 text-5xl font-bold text-gray-900">Dans la même categorie</h3>
                <div class="grid grid-cols-4 gap-8 auto-cols-max mt-4">
                    <template v-for="category in categories">
                        <a :href="'/events/' + category.id">
                            <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg h-full">
                                <img alt="Office"
                                    class="h-56 w-full object-cover"
                                    :src="'../storage/' + category.photo"
                                    />

                                <div class="bg-white p-4 sm:p-6">
                                    <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{ category.start_date }} </time>

                                    <a href="#">
                                        <h3 class="mt-0.5 text-lg text-gray-900">{{ category.title }}</h3>
                                    </a>

                                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                                        {{ category.description }}
                                    </p>
                                </div>
                            </article>
                        </a>
                    </template>
                    <p v-if="categories.length == 0" class="text-center text-gray-500">Aucun evenement dans cette categorie</p>
                </div>
            </article>
        </div>

        <div class="mx-56 mt-12 relative z-2">
            <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg bg-white  p-4 sm:p-6">
                <h3 class="mt-0.5 text-5xl font-bold text-gray-900">Dans la même ville</h3>
                <template v-for="city in cities">
                    <a :href="'/events/' + city.id">
                        <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg h-full">
                            <img alt="Office"
                                class="h-56 w-full object-cover"
                                :src="'../storage/' + city.photo"
                                />

                            <div class="bg-white p-4 sm:p-6">
                                <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{ city.start_date }} </time>

                                <a href="#">
                                    <h3 class="mt-0.5 text-lg text-gray-900">{{ city.title }}</h3>
                                </a>

                                <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                                    {{ city.description }}
                                </p>
                            </div>
                        </article>
                    </a>
                </template>
                <p v-if="cities.length == 0" class="text-center text-gray-500">Aucun evenement dans cette ville</p>
            </article>
        </div>
        </div>
    </AppLayout>

</template>
