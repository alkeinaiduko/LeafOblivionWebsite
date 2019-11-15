<template>
  <div>
      <el-table
        stripe
        :data="tableData"
        height="500"
        style="width: 100%">
        <el-table-column
            prop="name"
            label="Name"
            width="180">
        </el-table-column>
        <el-table-column
            prop="email"
            label="Email"
            width="180">
        </el-table-column>
        <el-table-column
            prop="role.role"
            label="Page Role">
        </el-table-column>
        <el-table-column
            label="Action">
            <template slot-scope="props">
                <el-button circle plain icon="el-icon-edit" title="Edit" size="small"></el-button>
                <el-button circle plain type="danger" icon="el-icon-delete" title="Delete" size="small"></el-button>
            </template>
        </el-table-column>
    </el-table>
    <br>
    <el-button type="success" class="el-icon-plus" @click="addModal = true"> Add Admin</el-button>
    <leaf-modal v-if="addModal" @close="addModal = false">
        <div slot="header">Add Admin</div>
        <div slot="body">
            <el-form ref="form" :model="newAdmin" label-width="120px">
                <el-form-item label="Name">
                    <el-input v-model="newAdmin.name"></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="newAdmin.email"></el-input>
                </el-form-item>
                <el-form-item label="Password">
                    <el-input type="password" v-model="newAdmin.password"></el-input>
                </el-form-item>
                <el-form-item label="Role">
                    <el-select v-model="newAdmin.role_id" placeholder="Select a role">
                        <el-option v-for="(role, index) in roles" :key="index" :label="role.role" :value="role.id"></el-option>
                    </el-select>
                </el-form-item>
            </el-form>
        </div>
        <div slot="footer" class="text-right">
            <el-button type="danger" icon="el-icon-close" @click="addModal = false">Cancel</el-button>
            <el-button type="success" icon="el-icon-check" @click="saveAdmin">Save</el-button>
        </div>
    </leaf-modal>
  </div>
</template>
<script>
    import LeafModal from '../shared-components/LeafModal'

    export default {
        props: {
            roles: Array,
            admins: Array
        },
        components: {
            LeafModal
        },
        data() {
            return {
                addModal: false,
                tableData: this.admins,
                newAdmin: {
                    name: '',
                    email: '',
                    password: '',
                    role_id: null
                }
            }
        },
        methods: {
            saveAdmin() {
                axios.post('/admin/admins', this.newAdmin).then(({data}) => {
                    this.$message({
                        type: 'success',
                        message: 'New Admin Added Successfully'
                    })
                    this.addModal = false
                    this.tableData.push(data)
                }).catch(() => {
                    this.$message({
                        type: 'error',
                        message: 'Something went wrong!'
                    })
                })
            }
        },
        created() {
            console.log(this.admins)
        }
    }
</script>

<style>

</style>
