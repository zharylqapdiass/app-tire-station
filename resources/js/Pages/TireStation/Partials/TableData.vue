<script setup>

const props = defineProps({
    data: Object
});

</script>

<template>
    <table class="w-full border-collapse border border-gray-400">
        <thead class="text-left">
        <tr>
            <th class="border border-gray-300 pl-3">Название</th>
            <th class="border border-gray-300 pl-3">Комнаты</th>
            <th class="border border-gray-300 pl-3">Наличие фото</th>
            <th class="border border-gray-300 pl-3">Площадь</th>
            <th class="border border-gray-300 pl-3">Действие</th>
        </tr>
        </thead>
        <tbody>

            <tr v-for="(item, index) in data" :key="index">
                <td class="border border-gray-300 pl-3">{{item.name}}</td>
                <td class="border border-gray-300 pl-3"> {{item.room_count}}</td>
                <td class="border border-gray-300 pl-3"> {{item.image_path ? "есть" :  "нет"}}</td>
                <td class="border border-gray-300 pl-3"> {{item.area}}</td>
                <td class="border border-gray-300 pl-3"><a :href="route('tire-service.show', item.id)"> Редактировать</a>  </td>
            </tr>

        </tbody>
    </table>
</template>

<style scoped>

</style>
