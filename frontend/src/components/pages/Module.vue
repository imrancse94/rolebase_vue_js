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
        <div class="card-header">
          <h3 class="card-title">Module List</h3>
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
        <!-- <advanced-laravel-vue-paginate :data="module" @paginateTo="getModules"/> -->
        <!-- <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item">
              <a class="page-link" href="#">«</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">»</a>
            </li>
          </ul>
        </div>-->
      </div>
    </section>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import Helper from "./../../helper/moment";

export default {
  mixins: [Helper],
  name: "Module",
  data() {
    return {
      moduleData: [],
    };
  },
  computed: {
    ...mapState("module", ["module"]),
  },
  mounted() {
    console.log('ssss',this.$router.currentRoute.query);
    this.getModules(this.$router.currentRoute.query.page);
  },
  methods: {
    ...mapActions("module", ["getModules"]),
  },
};
</script>

