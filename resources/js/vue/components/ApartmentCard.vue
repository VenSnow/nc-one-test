<template>
    <el-card class="box-card">
        <template #header>
            <div class="card-header">
                <span>{{ apartment.name }}</span>
            </div>
        </template>
        <div class="text item">
            Bedrooms: {{ apartment.bedrooms }} <br>
            Bathrooms: {{ apartment.bathrooms }} <br>
            Storeys: {{ apartment.storeys}} <br>
            Garages: {{ apartment.garages }} <br>
            Price: {{ new Intl.NumberFormat().format(apartment.price) }}
        </div>
    </el-card>
</template>

<script setup>
    import { ref, computed } from 'vue';

    const props = defineProps({
        apartment: {
            default: () => [],
        }
    })

    const apartment = ref(props.apartment)
</script>

<style>
.box-card {
    max-width: 1fr;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.text {
    font-size: 14px;
}

.item {
    margin-bottom: 18px;
}

.box-card {
    width: 480px;
    margin-bottom: 1em;
}
</style>
