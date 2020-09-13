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
          <div class="row">
            <div class="col-6">
              <form role="form">

                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    placeholder="Enter email"
                  />
                  <ErrorValidation msg="sssssss"/>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="exampleInputPassword1"
                    placeholder="Password"
                  />
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" />
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id>Upload</span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <router-link
                    :to="{'path':'/module/index'}"
                    class="btn btn-sm btn-primary mr-2"
                  >Back</router-link>
                  <button type="submit" class="btn btn-sm btn-success">Save</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Helper from "./../../../helper/moment";

export default {
  mixins: [Helper],
  name: "ModuleAdd",
  data() {
    return {
      moduleData: [],
    };
  },
  methods: {},
};
</script>

