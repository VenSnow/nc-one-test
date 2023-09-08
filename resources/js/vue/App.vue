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
                        <el-form-item label="Order by price">
                          <el-radio-group v-model="formLabel.price_order" class="ml-4">
                            <el-radio label="asc" size="small">Price Low</el-radio>
                            <el-radio label="desc" size="small">Price High</el-radio>
                          </el-radio-group>
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
                        <div class="grid" style="margin-top: 0.5em;">
                            <el-table :data="apartmentsData.data" style="width:100%">
                              <el-table-column prop="name" label="Name" width="150" />
                              <el-table-column prop="bedrooms" label="Bedrooms" width="100" />
                              <el-table-column prop="bathrooms" label="Bathrooms" width="100" />
                              <el-table-column prop="storeys" label="Storeys" width="100" />
                              <el-table-column prop="garages" label="Garages" width="100" />
                              <el-table-column prop="price" label="Price" />
                            </el-table>
                        </div>
                    </div>
                </el-main>
            </el-container>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import axios from "axios";

const labelPosition = ref('top')

const formLabel = reactive({
    name: null,
    bedrooms: null,
    bathrooms: null,
    storeys: null,
    garages: null,
    price_from: null,
    price_to: null,
    price_order: null,
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
        price_order: formLabel.price_order,
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
