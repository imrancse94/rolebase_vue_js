<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SubModule Management</h1>
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
            <div class="col">
              <h3 class="card-title">Page List</h3>
            </div>
            <div class="col text-right">
              <router-link :to="{'path':'/masterdata/submodule/add'}" class="btn btn-sm btn-primary">Add Page</router-link>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10px">ID</th>
                <th class="text-center">Module Name</th>
                <th class="text-center">SubModule Name</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(m,index) in submodule.data" :key="index">
                <td class="text-center">{{m.id}}</td>
                <td class="text-center">{{m.module_name}}</td>
                <td class="text-center">{{m.name}}</td>
                <td class="text-center">{{setDateFormat(m.created_at)}}</td>
                <td class="text-center">{{setDateFormat(m.updated_at)}}</td>
                <td class="text-center">
                  <div class="tools action-btns">
                    <router-link class="text-primary" :to="{'path':'/masterdata/submodule/edit/'+m.id}">
                      <i class="fas fa-edit"></i>
                    </router-link>
                      
                    <a href="#" class="text-danger" @click.prevent="deleteSubModule(m.id)" >
                      <i class="fas fa-trash"></i>
                    </a>
                      
                    </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <pagination :data="submodule" @paginateTo="subModuleMethod"/>
        
      </div>
    </section>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Helper from "./../../../helper/moment";

export default {
  mixins: [Helper],
  name: "ModuleList",
  data() {
    return {
      moduleData: [],
    };
  },
  computed: {
    ...mapState("submodule", ["submodule"]),
  },
  mounted() {
    this.getSubModules(this.$router.currentRoute.query);
  },
  methods: {
    ...mapActions("submodule", ["getSubModules","subModuleDelete"]),

    subModuleMethod(){
      var params = this.$router.currentRoute.query
      this.getSubModules(params);
    },
    deleteSubModule(id){
      console.log(id);
      this.$swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                this.subModuleDelete(id).then(()=>{
                    this.$swal(
                      'Deleted!',
                      'Module has been deleted.',
                      'success'
                    )
                  this.subModuleMethod();  
                })
                
              }
            });
    }
  },
};
</script>

