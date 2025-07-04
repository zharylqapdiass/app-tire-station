<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TableData from './Partials/TableData.vue';
import FormFilter from './Partials/FormFilter.vue';

const props = defineProps({
   data: Object
});

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Шиномонтаж</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg p-4">
                    <FormFilter/>
                    <br>
                    <hr>
                    <br>
                    <TableData :data="data.data" class="mt-4"/>
                    <br>

                    <nav aria-label="Page navigation example mt-3">
                        <ul class="inline-flex -space-x-px text-sm">
                            <li v-if="props.data.prev_page_url">
                                <a  :href="props.data.prev_page_url" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Предыдущий</a>
                            </li>
                            <template  v-for="(item, index) in props.data.links" :key="index">
                                <li
                                    v-if="/^\d+$/.test(item.label)"
                                >
                                    <a
                                        :href="item.url"
                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                    >
                                        {{ item.label }}
                                    </a>
                                </li>
                            </template>

                            <li v-if="props.data.next_page_url">
                                <a :href="props.data.next_page_url" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Следующий</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </AppLayout>
</template>

<style scoped></style>
