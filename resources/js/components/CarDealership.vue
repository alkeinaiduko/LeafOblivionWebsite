<template>
    <section class="cars-gallery">
        <div class="gallery-title text-center">
            <h2><strong>Cars Gallery</strong></h2>
            <span>You can browse here to find your best car.</span>
        </div>

        <div class="photo-gallery">
            <div class="row">
                <div class="col-md-3" v-for="(car, index) in cars" :key="index">
                    <div class="leaf-car-card">
                        <img width="100%" :src="`/images/uploaded_cars_front/${car.front_view}`">
                        <div class="car-details">
                            <ul>
                                <li>Name: {{ car.name }}</li>
                                <li>Price: <vue-numeric v-bind="currencyProps" :minus="true" read-only class="form-control" type="text" v-model="car.price"></vue-numeric></li>
                                <li>Tax: <vue-numeric v-bind="currencyProps" :minus="true" read-only class="form-control" type="text" v-model="car.tax"></vue-numeric></li>
                                <li>Total Price: <vue-numeric v-bind="currencyProps" :minus="true" read-only class="form-control" type="text" v-model="car.full_price"></vue-numeric></li>
                                <li>&nbsp;</li>
                                <li><a href="#" @click="getFullView(index)">Check Full View</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- car fullview -->
        <div v-if="fullViewMode" class="car-fullview">
            <div class="text-right" style="margin-right: 1em; height: 5%; padding: 1em;"><i style="cursor: pointer; font-size: 2em;" @click="fullViewMode = false" class="el-icon-circle-close"></i></div>
            <div style="display: flex; align-items: center; height: 95%">
                <div class="row" style="width: 95%; margin: 0 auto;">
                    <div class="col-md-6">
                        <img width="100%" :src="`/images/uploaded_cars_front/${this.selectedCar.front_view}`" alt="">
                        <div class="text-center">Front-side View</div>
                    </div>
                    <div class="col-md-6">
                        <img width="100%" :src="`/images/uploaded_cars_back/${this.selectedCar.front_view}`" alt="">
                        <div class="text-center">Back View</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            cars: Array
        },
        data() {
            return {
                fullViewMode: false,
                currencyProps: { currency: "$", precision: 2 },
                selectedCar: null
            }
        },
        methods: {
            getFullView(index) {
                this.fullViewMode = true
                this.selectedCar = this.cars[index]
            }
        },
        created() {
            console.log(this.cars)
        }
    }
</script>

<style lang="scss">
    .car-fullview {
        height: 100%;
        background: #37393F;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100%;

        color: #fff;
    }
</style>

