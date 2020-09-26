<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Module Management</h1>
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
              <h3 class="card-title">Module List</h3>
            </div>
            <div class="col text-right">
              <router-link :to="{'path':'/masterdata/module/add'}" class="btn btn-sm btn-primary">Add Module</router-link>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10px">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(m,index) in module.data" :key="index">
                <td class="text-center">{{m.id}}</td>
                <td class="text-center">{{m.name}}</td>
                <td class="text-center">{{setDateFormat(m.created_at)}}</td>
                <td class="text-center">{{setDateFormat(m.updated_at)}}</td>
                <td class="text-center">
                  <div class="tools action-btns">
                    <router-link class="text-primary" :to="{'path':'/masterdata/module/edit/'+m.id}">
                      <i class="fas fa-edit"></i>
                    </router-link>
                      
                    <a href="#" class="text-danger" @click.prevent="deleteModule(m.id)" >
                      <i class="fas fa-trash"></i>
                    </a>
                      
                    </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <pagination :data="module" @paginateTo="moduleMethod"/>
        
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
    ...mapState("module", ["module"]),
  },
  mounted() {
    this.getModules(this.$router.currentRoute.query);
  },
  methods: {
    ...mapActions("module", ["getModules","moduleDelete"]),

    moduleMethod(){
      var params = this.$router.currentRoute.query
      this.getModules(params);
    },
    deleteModule(id){
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
                this.moduleDelete(id).then(()=>{
                    this.$swal(
                      'Deleted!',
                      'Module has been deleted.',
                      'success'
                    )
                  this.moduleMethod();  
                })
                
              }
            });
    }
  },
};
</script>

