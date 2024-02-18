<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';


defineProps({
    upcomingEvents: Object,
    bestCategories: Object
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Accueil
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-5">
                    <h3 class="mb-4 mt-0.5 text-5xl font-bold text-gray-900 pt-7 px-5">Les 5 prochains evenements</h3>
                    <div class="grid grid-cols-5 gap-8 auto-cols-max pb-7 px-12">
                        <template v-for="event in upcomingEvents">
                            <a :href="'/events/' + event.id">
                                <article class="overflow-hidden rounded-lg shadow transition hover:shadow-lg h-full">
                                    <div class="h-56 overflow-hidden"><img alt="Office"
                                        class="h-56 w-full object-cover transition-all duration-[1s] hover:h-96 hover:mt-[-70px]"
                                        :src="'storage/' + event.photo"
                                        /></div>

                                    <div class="bg-white p-4 sm:p-6">
                                        <time datetime="2022-10-10" class="block text-xs text-gray-500 "> {{ event.start_date }} </time>

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
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-5">
                    <h3 class="mb-4 mt-0.5 text-5xl font-bold text-gray-900 pt-7 px-5">Les 5 catégories les plus populaires</h3>
                    <div class="flex justify-between w-full  pb-7 px-12">
                        <template v-for="category in bestCategories">
                            <span class="font-bold text-lg">{{ category.name }}</span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
