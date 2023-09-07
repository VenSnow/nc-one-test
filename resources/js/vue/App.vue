<template>
    <div id="app">
        <div class="common-layout">
            <el-container>
                <el-aside>
                    <div style="margin: 2em" />
                    <el-form
                        label-width="100px"
                        :model="formLabel"
                        :label-position=labelPosition
                        style="max-width: 460px"
                        @change="searchApartment()"
                    >
                        <h3 id="search-title">Search</h3>
                        <el-form-item label="Name">
                            <el-input v-model="formLabel.name" />
                        </el-form-item>
                        <el-form-item label="Bedrooms">
                            <el-input-number class="el-input-number" v-model="formLabel.bedrooms" />
                        </el-form-item>
                        <el-form-item label="Bathrooms">
                            <el-input-number v-model="formLabel.bathrooms" />
                        </el-form-item>
                        <el-form-item label="Storeys">
                            <el-input-number v-model="formLabel.storeys" />
                        </el-form-item>
                        <el-form-item label="Garages">
                            <el-input-number v-model="formLabel.garages" />
                        </el-form-item>
                        <el-form-item label="Price From">
                            <el-input-number v-model="formLabel.price_from" />
                        </el-form-item>
                        <el-form-item label="Price To">
                            <el-input-number v-model="formLabel.price_to" />
                        </el-form-item>
                    </el-form>
                </el-aside>

                <el-main class="el-main">
                    <div v-if="state.loading">
                        <div v-loading="state.loading" id="loading-block"></div>
                    </div>
                    <div v-else-if="state.error">
                        {{ state.error }}
                    </div>
                    <div v-else>
                        <p>Total apartments: {{ apartmentsData.meta.total }}</p>
                        <div v-if="apartmentsData.meta.total === 0">
                            <p>
                                There is no apartment with these parameters
                            </p>
                        </div>
                        <div class="grid">
                            <ApartmentCard v-for="apartment in apartmentsData.data" :apartment=apartment />
                        </div>
                    </div>
                </el-main>
            </el-container>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import axios from "axios";
import ApartmentCard from "./components/ApartmentCard.vue";

const labelPosition = ref('top')

const formLabel = reactive({
    name: null,
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
    price_from: null,
    price_to: null,
})

const apartmentsData = ref(null)
const state = reactive({
    loading: false,
    error: null
})

async function searchApartment() {
    const formData = {
        name: formLabel.name,
        bedrooms: formLabel.bedrooms,
        bathrooms: formLabel.bathrooms,
        storeys: formLabel.storeys,
        garages: formLabel.garages,
        price_from: formLabel.price_from,
        price_to: formLabel.price_to,
    }

    try {
        await fetchData(formData)
    } catch (error) {
        console.log(error)
    }
}

async function fetchData(filters = null) {
    state.loading = true
    state.error = null
    try {
        const response = await axios.get(`${import.meta.env.VITE_BASE_URL}api/apartments`, { params: filters });
        apartmentsData.value = response.data
    } catch (error) {
        state.error = error.message || 'Something went wrong'
    } finally {
        state.loading = false;
    }
}

fetchData()
</script>

<style scoped>
    * {
        font-family: sans-serif;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
        grid-row-gap: 10px;
    }
    #app {
        padding-left: 5%;
        padding-right: 2%;
    }
    .el-input-number {
        width: 22em;
    }
    #loading-block {
        margin-top: 40%;
        text-align: center;
    }
</style>
