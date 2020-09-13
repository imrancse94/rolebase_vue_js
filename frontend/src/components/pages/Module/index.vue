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
              <router-link :to="{'path':'/module/add'}" class="btn btn-sm btn-primary">Add Module</router-link>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Name</th>
                <th>Created At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(m,index) in module.data" :key="index">
                <td>{{m.id}}</td>
                <td>{{m.name}}</td>
                <td>{{setDateFormat(m.created_at)}}</td>
                <td>{{setDateFormat(m.updated_at)}}</td>
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
    ...mapActions("module", ["getModules"]),

    moduleMethod(){
      var params = this.$router.currentRoute.query
      this.getModules(params);
    },
  },
};
</script>

