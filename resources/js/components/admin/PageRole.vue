<template>
    <div>
        <el-table
            stripe
            :data="tableData"
            height="500"
            style="width: 100%">
            <el-table-column
                prop="id"
                label="ID"
                width="180">
            </el-table-column>
            <el-table-column
                prop="role"
                label="Role"
                width="180">
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
        <el-button type="success" class="el-icon-plus" @click="addModal = true"> Add Role</el-button>
        <leaf-modal v-if="addModal" @close="addModal = false">
            <div slot="header">
                Add Role
            </div>
            <div slot="body">
                <el-input v-model="roleName" placeholder="Role Name"></el-input>
            </div>
            <div class="text-right" slot="footer">
                <el-button type="danger" icon="el-icon-close" @click="addModal = false">Cancel</el-button>
                <el-button type="success" icon="el-icon-check" @click="saveRole">Save</el-button>
            </div>
        </leaf-modal>
    </div>
</template>

<script>
    import LeafModal from '../shared-components/LeafModal'

    export default {
        props: {
            roles: Array
        },
        components: {
            LeafModal
        },
        data() {
            return {
                addModal: false,
                roleName: '',
                tableData: this.roles
            }
        },
        methods: {
            saveRole() {
                axios.post('/admin/roles', { role: this.roleName }).then(({data}) => {
                    this.$message({
                        type: 'success',
                        message: 'Role Added Successfully'
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
        }
    }
</script>

<style>

</style>
