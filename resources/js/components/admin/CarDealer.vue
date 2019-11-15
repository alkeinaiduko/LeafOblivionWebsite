<template>
    <div>
        <el-table
            stripe
            :data="tableData"
            height="500"
            style="width: 100%">
            <el-table-column
                prop="name"
                label="Name">
            </el-table-column>
            <el-table-column label="Price">
                <template slot-scope="props">
                    <vue-numeric v-bind="currencyProps" :minus="true" read-only class="form-control" type="text" v-model="props.row.price"></vue-numeric>
                </template>
            </el-table-column>
            <el-table-column label="Tax">
                <template slot-scope="props">
                    <vue-numeric v-bind="currencyProps" :minus="true" read-only class="form-control" type="text" v-model="props.row.tax"></vue-numeric>
                </template>
            </el-table-column>
            <el-table-column label="Full Price">
                <template slot-scope="props">
                    <vue-numeric v-bind="currencyProps" :minus="true" read-only class="form-control" type="text" v-model="props.row.full_price"></vue-numeric>
                </template>
            </el-table-column>
            <el-table-column label="Model">
                <template slot-scope="props">
                    {{ props.row.car_model.name }}
                </template>
            </el-table-column>
            <el-table-column label="Front-side View">
                <template slot-scope="props">
                    <img :src="`/images/uploaded_cars_front/${props.row.front_view}`" width="100">
                </template>
            </el-table-column>
            <el-table-column label="Back View">
                <template slot-scope="props">
                    <img :src="`/images/uploaded_cars_back/${props.row.back_view}`" width="100">
                </template>
            </el-table-column>
            <el-table-column
                label="Action">
                <template slot-scope="props">
                    <el-button circle plain icon="el-icon-edit" title="Edit" size="small" @click="showEditCar(props.$index)"></el-button>
                    <el-button circle plain type="danger" icon="el-icon-delete" title="Delete" size="small" @click="deleteCar(props.$index)"></el-button>
                </template>
            </el-table-column>
        </el-table>
        <br>
        <el-button type="success" class="el-icon-plus" @click="addCar"> Add Car</el-button>
        <br>
        <br>
        <el-button type="success" class="el-icon-plus" @click="addCarModelModal = true"> Add Car Model</el-button>

        <!-- ADD CAR -->
        <leaf-modal v-if="addModal" @close="addModal = false">
            <div slot="header">
                {{ editMode ? 'Edit Car' : 'Add Car' }}
            </div>
            <div slot="body">
                <el-form ref="form" :model="newCar" label-width="120px">
                    <el-form-item label="Name">
                        <el-input v-model="newCar.name"></el-input>
                    </el-form-item>
                    <el-form-item label="Price">
                        <vue-numeric v-bind="currencyProps" :minus="true" class="form-control" type="text" v-model="newCar.price"></vue-numeric>
                    </el-form-item>
                    <el-form-item label="Tax">
                        <vue-numeric v-bind="currencyProps" :minus="true" class="form-control" type="text" v-model="newCar.tax"></vue-numeric>
                    </el-form-item>
                    <el-form-item label="Full Price">
                        <vue-numeric v-bind="currencyProps" :minus="true" class="form-control" type="text" v-model="newCar.full_price"></vue-numeric>
                    </el-form-item>
                    <el-form-item label="Front-side View" v-if="!editMode">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" @change="onFileChangeFront" class="custom-file-input" id="front-view" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="front-view">{{ front_view }}</label>
                            </div>
                        </div>
                    </el-form-item>
                    <el-form-item label="Back View"  v-if="!editMode">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" @change="onFileChangeBack" class="custom-file-input" id="back-view" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="back-view">{{ back_view }}</label>
                            </div>
                        </div>
                    </el-form-item>
                    <el-form-item label="Car Model">
                        <el-select v-model="newCar.car_model_id" placeholder="Select a model">
                            <el-option v-for="(model, index) in carModelsData" :key="index" :label="model.name" :value="model.id"></el-option>
                        </el-select>
                    </el-form-item>
                </el-form>
            </div>
            <div class="text-right" slot="footer">
                <el-button type="danger" icon="el-icon-close" @click="addModal = false">Cancel</el-button>
                <el-button v-if="!editMode" type="success" icon="el-icon-check" @click="saveCar">Save</el-button>
                <el-button v-else type="success" icon="el-icon-check" @click="editCar">Update</el-button>
            </div>
        </leaf-modal>

        <!-- ADD CAR MODEL -->
        <leaf-modal v-if="addCarModelModal" @close="addCarModelModal = false">
            <div slot="header">
                Add Car Model
            </div>
            <div slot="body">
                <el-input v-model="modelName" placeholder="Model Name"></el-input>
            </div>
            <div class="text-right" slot="footer">
                <el-button type="danger" icon="el-icon-close" @click="addCarModelModal = false">Cancel</el-button>
                <el-button type="success" icon="el-icon-check" @click="saveCarModel">Save</el-button>
            </div>
        </leaf-modal>
    </div>
</template>

<script>
    import LeafModal from '../shared-components/LeafModal'

    export default {
        props: {
            roles: Array,
            cars: Array
        },
        components: {
            LeafModal
        },
        data() {
            return {
                addModal: false,
                addCarModelModal: false,
                editMode: false,
                modelName: '',
                tableData: this.cars,
                carModelsData: [],
                newCar: {},
                front_view: 'Choose File...',
                back_view: 'Choose File...',
                currencyProps: { currency: "$", precision: 2 }
            }
        },
        methods: {
            saveCar() {
                axios.post('/admin/save-car', this.newCar).then(({data}) => {
                    this.$message({
                        type: 'success',
                        message: 'Car Added Successfully'
                    })
                    console.log(data)
                    this.tableData.push(data);
                    this.addModal = false
                }).catch(() => {
                    this.$message({
                        type: 'error',
                        message: 'Something went wrong!'
                    })
                })
            },
            addCar() {
                this.addModal = true
                this.editMode = false
            },
            saveCarModel() {
                axios.post('/admin/car-models', {model_name: this.modelName}).then(({data}) => {
                    this.$message({
                        type: 'success',
                        message: 'New Car Model Added Successfully'
                    })
                    this.addCarModelModal = false
                    this.carModelsData.push(data)
                }).catch(() => {
                    this.$message({
                        type: 'error',
                        message: 'Something went wrong!'
                    })
                })
            },
            getCarModels() {
                axios.get('/admin/car-models').then(({data}) => {
                    this.carModelsData = data
                })
            },
            onFileChangeFront(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                setTimeout(() => {
                    this.createImageFront(files[0]);
                    this.front_view = files[0].name
                }, 1000)
            },
            onFileChangeBack(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                setTimeout(() => {
                    this.createImageBack(files[0]);
                    this.back_view = files[0].name
                }, 1000)
            },
            createImageFront(file) {
                let frontReader = new FileReader();
                let vm = this;
                frontReader.onload = (e) => {
                    console.log('front', e.target)
                    vm.newCar.front_view = e.target.result;
                };
                frontReader.readAsDataURL(file);
            },
            createImageBack(file) {
                let backReader = new FileReader();
                let vm = this;
                backReader.onload = (e) => {
                    console.log('back', e.target)
                    vm.newCar.back_view = e.target.result;
                };
                backReader.readAsDataURL(file);
            },
            deleteCar(index) {
                this.$confirm('Are you sure you want to delete this car?', 'Warning', {
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    axios.delete(`/car-dealership/${this.tableData[index].id}`).then(() => {
                        this.$message({
                            type: 'success',
                            message: 'Car Deleted Successfully!'
                        })
                    })
                    this.tableData.splice(index, 1)
                })
            },
            showEditCar(index) {
                this.newCar = this.tableData[index]
                this.addModal = true
                this.editMode = true
            },
            editCar() {
                let new_car = {
                    name: this.newCar.name,
                    price: this.newCar.price,
                    tax: this.newCar.tax,
                    full_price: this.newCar.full_price,
                    model_id: this.newCar.model_id
                }
                axios.patch(`/car-dealership/${this.newCar.id}`, new_car).then(() => {
                    this.$message({
                        type: 'success',
                        message: 'Car Updated Successfully!'
                    })
                    this.editMode = false
                    this.addModal = false
                })
            }

        },
        created() {
            this.getCarModels()
            console.log(this.cars)
        }
    }
</script>
