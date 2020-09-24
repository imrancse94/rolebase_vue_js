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
              <h3 class="card-title">Module Add</h3>
            </div>
            <div class="col text-right">
              <router-link :to="{'path':'/module/index'}" class="btn btn-sm btn-primary">Module List</router-link>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
           <form role="form" @submit.prevent="addModule">
            <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Module ID</label>
                    <input type="text" v-model="module.id" class="form-control" placeholder="Module ID" />
                    <ErrorValidation msg="sssssss" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Module Name</label>
                    <input type="text" v-model="module.name" class="form-control" placeholder="Module Name" />
                    <ErrorValidation msg="sssssss" />
                  </div>
                  <div class="form-group">
                    <router-link
                      :to="{'path':'/module/index'}"
                      class="btn btn-sm btn-primary mr-2"
                    >Back</router-link>
                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Module Icon</label>
                    <input type="text" v-model="module.icon" class="form-control" placeholder="Module Icon" />
                    <ErrorValidation msg="sssssss" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Sequence</label>
                    <input type="text" v-model="module.sequence" class="form-control" placeholder="Sequence" />
                    <ErrorValidation msg="sssssss" />
                  </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Helper from "./../../../helper/moment";
import GLOBAL_CONSTANT from "./../../../constant";

export default {
  mixins: [Helper],
  name: "ModuleAdd",
  data() {
    return {
      module: {
        id:'',
        name:'',
        icon:'',
        sequence:'',
      },
      errors:{}
    };
  },
  computed: {
    
  },
  methods: {

    ...mapActions("module", ["moduleAdd"]),
    
    addModule(){
      this.moduleAdd(this.module).then(response =>{
        
        if(response.success){
          console.log('module Add',response);
        }else{
          console.log('module validation1',this.$data);
          if(response.statuscode == GLOBAL_CONSTANT['MODULE_INSERT_SUCCESS']){
              console.log('module validation2',response);
          }
        }
      }).catch(() =>{});
    }
  },
};
</script>

