<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm} from '@inertiajs/inertia-vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';


const props = defineProps({
    data: Object
});

const form = useForm({
    name: props.data.name,
    room_count: props.data.room_count,
    floor:props.data.floor,
    area:props.data.area,
    description:props.data.description,
    image: null
});

const handleFileChange = (e) => {
    form.image = e.target.files[0];
};


const submit = () => {
    form.post(route('tire-service.update', props.data.id ), {
        forceFormData: true,
        onSuccess: () => {
            notificationStore.showNotification({
                type: 'success',
                message: 'Форма успешно отправлена'
            });
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
}


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Tire station</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg p-4">
                <div class="flex flex-wrap">
                    <div>
                        <div>
                            <InputLabel>Название</InputLabel>
                            <TextInput v-model="form.name"/>
                        </div>

                        <div>
                            <InputLabel>Комнаты</InputLabel>
                            <TextInput v-model="form.room_count"/>
                        </div>

                        <div>
                            <InputLabel>Площадь</InputLabel>
                            <TextInput v-model="form.area"/>
                        </div>

                        <div>
                            <InputLabel>Описание</InputLabel>
                            <TextInput v-model="form.description"/>
                        </div>
                    </div>

                    <div class="ml-4">
                        <div>
                            <InputLabel>Файл</InputLabel>
                            <div class="image">
                                <img :src="'/'+props.data.image_path" alt="aa">
                            </div>
                            <input  class="mt-3" type="file" @change="handleFileChange">
                        </div>
                        <div class="mt-4">
                            <PrimaryButton @click="submit" > Сохранить </PrimaryButton>
                        </div>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </AppLayout>



<TextInput/>
</template>

<style scoped>
.image {
    max-width: 300px;
}
.image img {
    width: 100%;
}
</style>
