<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Page Association</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <!--card-header-->
        <div class="card-header">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group">
                <label>Role name</label>
                <select @change.prevent="getPageInfoData(role_id)" class="form-control" v-model="role_id">
                  <option value="0">Please select</option>
                  <option  v-for="(role,id) in roleList" :key="id" :value="id">{{role}}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" v-if="Object.keys(rolePageData).length > 0">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10px">ID</th>
                <th class="text-center">Module</th>
                <th class="text-center">Submodule</th>
                <th class="text-center">Pages</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(m, index) in rolePageData" :key="index">
                <td class="text-center">{{ m.id }}</td>
                <td class="text-left">{{ m.name }}</td>
                <td class="text-left" colspan="3">
                  <table class="table">
                    <tr v-for="subm in m.submenu" :key="subm.id">
                      <td>{{subm.name}}</td>
                      <td>
                        <table class="table table-hover">
                          <tr v-for="ssubm in subm.submenu" :key="ssubm.id">
                            <td >{{ssubm.name}}</td>
                            <td class="text-center">
                              <div class="tools action-btns">
                                <router-link
                                  class="text-primary"
                                  :to="{ name: 'module-edit', params: { id: m.id } }"
                                >
                                  <i class="fas fa-edit"></i>
                                </router-link>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
      </div>
    </section>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Helper from "./../../../Helper/moment";

export default {
  mixins: [Helper],
  name: "RolePageAssoc",
  data() {
    return {
      rolePageData: [],
      roleList : [],
      role_id : 0
    };
  },
  computed: {
    ...mapState("RolePage", ["rolelist","rolepageinfo"]),
    
  },
  mounted() {
    this.getRolePage().then(({data})=>{
      this.roleList = data.roleList;
    });
    
  },
  methods: {
    ...mapActions("RolePage", ["getRolePage","getRolePageInfoByRoleId"]),

    getPageInfoData(role_id){
      this.rolePageData = [];
      if(role_id > 0){
        this.getRolePageInfoByRoleId(role_id).then(({data}) =>{
          this.rolePageData = data;
          console.log('getRolePageInfoByRoleId',this.rolePageData.length)
        }) 
      }
    }
  },
};
</script>


