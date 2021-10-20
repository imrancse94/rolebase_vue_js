<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <ContentPageHeader header='Module Management'/>

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
              <LinkButton route='module-add'  classname='btn btn-sm btn-primary' name='Add Module' />
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
              <tr v-for="(m,index) in moduleData.data" :key="index">
                <td class="text-center">{{m.id}}</td>
                <td class="text-center">{{m.name}}</td>
                <td class="text-center">{{setDateFormat(m.created_at)}}</td>
                <td class="text-center">{{setDateFormat(m.updated_at)}}</td>
                <td class="text-center">
                  <ActionButton route="module-edit" :id="m.id" @action="deleteModule"/>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <pagination :data="moduleData" @paginateTo="moduleMethod"/>
        
      </div>
    </section>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Helper from "./../../../Helper/moment";

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
    this.moduleData = [];
    this.getModules(this.$router.currentRoute.query).then((data)=>{
      this.moduleData = data;
    })
  },
  methods: {
    ...mapActions("module", ["getModules","moduleDelete"]),

    moduleMethod(){
      this.moduleData = [];
      this.getModules(this.$router.currentRoute.query)
          .then((data)=>{
            this.moduleData = data;
          })
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

