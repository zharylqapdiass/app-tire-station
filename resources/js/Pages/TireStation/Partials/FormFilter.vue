<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Checkbox from  '@/Components/Checkbox.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { useForm} from '@inertiajs/inertia-vue3'
import { watch } from 'vue'

const searchParams = new URLSearchParams(window.location.search)

const form = useForm({
    name: searchParams.get('name') || '',
    hasImage: searchParams.get('hasImage') === 'true',
    room_1: searchParams.get('room_1') === 'true',
    room_2: searchParams.get('room_2') === 'true',
    room_3: searchParams.get('room_3') === 'true',
    fromArea: Number(searchParams.get('fromArea')) || 0,
    toArea: Number(searchParams.get('toArea')) || 0,
});


const submit = () => {
    form.get(route('tire-service.index'))
}

watch([() => form.fromArea, () => form.toArea], ([from, to]) => {
    if (from !== null && to !== null && to <= from) {
        form.errors.toArea = 'Значение "До" должно быть больше "От"'
    } else {
        form.errors.toArea = null
    }
})
</script>

<template>
    <div class="flex flex-wrap gap-4">
        <div class="">
            <InputLabel value="Название"/>
            <TextInput v-model="form.name"/>
        </div>

        <div class="ml-2">
            <InputLabel value="Наличие фотографии"/>
            <Checkbox v-model="form.hasImage" :checked="form.hasImage"/>
        </div>

        <div class="ml-2">
            <InputLabel value="Количество комнат"/>
            <span>
                1 <Checkbox v-model="form.room_1" :checked="form.room_1"/>
            </span>
            <span>
                2 <Checkbox v-model="form.room_2" :checked="form.room_2"/>
            </span>
            <span>
                3 <Checkbox v-model="form.room_3" :checked="form.room_3"/>
            </span>
        </div>

        <div class="ml-2">
            <InputLabel value="Площадь в кв"/>
            <div class="flex">
                <div class="flex mr-3">
                    <InputLabel   class="self-center mr-2"  value="От"/>
                    <TextInput class="w-20" v-model="form.fromArea"/>
                </div>
                <div class="flex">
                    <InputLabel  class="self-center mr-2" value="До"/>
                    <TextInput class="w-20" v-model="form.toArea"/>
                </div>
            </div>
            <div v-if="form.errors.toArea" class="text-red-500 text-sm mt-1">
                {{ form.errors.toArea }}
            </div>
        </div>

        <div class="ml-2 mt-2 self-center">
            <PrimaryButton @click="submit">Поиск</PrimaryButton>
        </div>
    </div>


</template>

<style scoped>

</style>
