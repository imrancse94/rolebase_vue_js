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
              <h3 class="card-title">SubModule Add</h3>
            </div>
            <div class="col text-right">
              <router-link :to="{'path':'/masterdata/submodule'}" class="btn btn-sm btn-primary">SubModule List</router-link>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
           <form role="form" @submit.prevent="addSubModule">
            <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">SubModule ID</label>
                    <input type="text" :class="errors.id ? 'is-invalid':''" v-model="module.id" class="form-control" placeholder="SubModule ID" />
                    <ErrorValidation :msg="errors.id" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">SubModule Name</label>
                    <input type="text" :class="errors.name ? 'is-invalid':''" v-model="module.name" class="form-control" placeholder="SubModule Name" />
                    <ErrorValidation :msg="errors.name" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">SubModule Icon</label>
                    <input type="text" :class="errors.icon ? 'is-invalid':''" v-model="module.icon" class="form-control" placeholder="SubModule Icon" />
                    <ErrorValidation :msg="errors.icon" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Default Method</label>
                    <input type="text" :class="errors.default_method ? 'is-invalid':''" v-model="module.default_method" class="form-control" placeholder="Default Method" />
                    <ErrorValidation :msg="errors.default_method" />
                  </div>

                  <div class="form-group">
                    <router-link
                      :to="{'path':'/masterdata/submodule'}"
                      class="btn btn-sm btn-primary mr-2"
                    >Back</router-link>
                    <button type="submit" class="btn btn-sm btn-success">Save</button>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Module Name</label>
                    <select type="text" :class="errors.module_id ? 'is-invalid':''" v-model="module.module_id" class="custom-select" placeholder="Module Name" >
                      <option value="">Please select</option>
                      <option v-for="(value,index) in modulelist.modulelist" :key="index" :value="index">{{value}}</option>
                    </select>
                    <ErrorValidation :msg="errors.module_id" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Sequence</label>
                    <input type="text" :class="errors.sequence ? 'is-invalid':''" v-model="module.sequence" class="form-control" placeholder="Sequence" />
                    <ErrorValidation :msg="errors.sequence" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Controller Name</label>
                    <input type="text" :class="errors.controller_name ? 'is-invalid':''" v-model="module.controller_name" class="form-control" placeholder="SubModule Icon" />
                    <ErrorValidation :msg="errors.controller_name" />
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
        module_id:'',
        name:'',
        icon:'',
        sequence:'',
        controller_name:'',
        default_method:''
      },
      modulelist:this.$store.getters['module/getModule'],
      errors:{}
    };
  },
  computed: {

    //...mapState("module", ["modulelist"]),
  },
  mounted(){
    this.moduleList();

    console.log('sss',this.$store.getters['module/getModule'])
  },
  methods: {

    ...mapActions("submodule", ["subModuleAdd"]),

    ...mapActions("module",["moduleList"]),

    addSubModule(){
      this.subModuleAdd(this.module).then(response =>{
        
        if(response.success && response.statuscode == GLOBAL_CONSTANT['SUBMODULE_INSERT_SUCCESS']){
             this.errors = {}; 
             this.$toast.success({
                        title:'Saved',
                        message:'SubModule Saved successfully.'
                      });
             this.$router.push('/masterdata/submodule');
          }else{
            
            this.errors = response.data;

          }
      }).catch(() =>{});
    }
  },
};
</script>

