<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <ContentPageHeader header='Page Management'/>

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
              <LinkButton route='page-add'  classname='btn btn-sm btn-primary' name='Add Page' />
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
                <th class="text-center">Page Name</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(m,index) in PageData.data" :key="index">
                <td class="text-center">{{m.id}}</td>
                <td class="text-center">{{moduleData[m.parent_id]}}</td>
                <td class="text-center">{{m.name}}</td>
                <td class="text-center">{{setDateFormat(m.created_at)}}</td>
                <td class="text-center">{{setDateFormat(m.updated_at)}}</td>
                <td class="text-center">
                  <ActionButton route="page-edit" :id="m.id" @action="deletePage"/>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <pagination :data="PageData" @paginateTo="PageMethod"/>
        
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
      moduleData:[],
      submoduleData:[],
      PageData: [],
    };
  },
  computed: {
    ...mapState("Page", ["Page"]),
  },
  mounted() {
    this.getPages(this.$router.currentRoute.query)
        .then((data) =>{
          this.PageData = data.pages;
          this.submoduleData = data.submodules;
          this.moduleData = data.modules;
          console.log('PageData',this.PageData)
        });
  },
  methods: {
    ...mapActions("Page", ["getPages","PageDelete"]),

    PageMethod(){
      this.getPages(this.$router.currentRoute.query)
          .then((data) =>{
            this.PageData = data.pages;
            this.submoduleData = data.submodules;
            this.moduleData = data.modules;
            console.log('PageMethod',this.PageData)
          });
    },
    deletePage(id){
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
                this.PageDelete(id).then(()=>{
                    this.$swal(
                      'Deleted!',
                      'Page has been deleted.',
                      'success'
                    )
                  this.PageMethod();  
                })
                
              }
            });
    }
  },
};
</script>

