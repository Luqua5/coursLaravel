<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3'

defineProps({
    event: Array,
    isSubscribed: Boolean,
    categories: Array,
    cities: Array,
    reviews: Array
});

let content = "";
let rating = 0;

function addReview(id)
{
    console.log(id, content, rating);
    router.post('/review', {
        event_id: id,
        content: content,
        rating: rating
    });
}

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
        <div class="absolute top-24 pb-24 w-screen">
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
                        <button v-if="!isSubscribed" @click="subscribe(event.id)" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            S'inscrire</button>
                        <button v-if="isSubscribed" @click="unsubscribe(event.id)" type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                            Se desinscrire</button>
                    </div>
                </article>
            </div>

            <div class="mx-56 mt-12 relative z-2">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg bg-white  p-4 sm:p-6">
                    <h3 class="mb-4 mt-0.5 text-5xl font-bold text-gray-900">Avis ({{ reviews.length }})</h3>
                    <div class="mb-6">
                        <select name="rating" id="rating" v-model="rating">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200">
                            <textarea v-model="content" id="comment" rows="6"
                                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                                placeholder="Write a comment..." required></textarea>
                        </div>
                        <button @click="addReview(event.id)"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200">
                            Poster
                        </button>
                    </div>
                    <template v-for="review in reviews">
                        <article class=" border-t border-gray-200 p-6 text-base bg-white rounded-lg">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900"><img
                                            class="mr-2 w-6 h-6 rounded-full"
                                            src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                            alt="Michael Gough">{{ review.user.name }}</p>
                                    <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                            title="February 8th, 2022">Feb. 8, 2022</time></p>
                                </div>
                                <p class="text-sm text-gray-600">{{ review.rating }}/5</p>

                            </footer>
                            <p class="text-gray-500">{{ review.content }}</p>
                        </article>
                    </template>
                    <p v-if="reviews.length == 0" class="text-center text-gray-500">Aucun avis pour cet evenement</p>
                </article>
            </div>

            <div class="mx-56 mt-12 relative z-2">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg bg-white  p-4 sm:p-6">
                    <h3 class="mt-0.5 text-5xl font-bold text-gray-900">Dans la même categorie</h3>
                    <div class="grid grid-cols-4 gap-8 auto-cols-max mt-4">
                        <template v-for="category in categories">
                            <a :href="'/events/' + category.id">
                                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg h-full">
                                    <img alt="Office" class="h-56 w-full object-cover"
                                        :src="'../storage/' + category.photo" />

                                    <div class="bg-white p-4 sm:p-6">
                                        <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{
                                            category.start_date }} </time>

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
                        <p v-if="categories.length == 0" class="text-center text-gray-500">Aucun evenement dans cette
                            categorie</p>
                    </div>
                </article>
            </div>

            <div class="mx-56 mt-12 relative z-2">
                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg bg-white  p-4 sm:p-6">
                    <h3 class="mt-0.5 text-5xl font-bold text-gray-900">Dans la même ville</h3>
                    <template v-for="city in cities">
                        <a :href="'/events/' + city.id">
                            <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg h-full">
                                <img alt="Office" class="h-56 w-full object-cover" :src="'../storage/' + city.photo" />

                                <div class="bg-white p-4 sm:p-6">
                                    <time datetime="2022-10-10" class="block text-xs text-gray-500"> {{ city.start_date }}
                                    </time>

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
