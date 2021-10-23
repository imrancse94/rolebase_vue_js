<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <ContentPageHeader header="Usergroup Management" />
    <!-- Main content -->
    <section class="content">
      <div class="card">
        <!--card-header-->
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h3 class="card-title">Usergroup Add</h3>
            </div>
            <div class="col text-right">
              <LinkButton
                route="usergroup-index"
                classname="btn btn-sm btn-primary"
                name="Usergroup List"
              />
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" @submit.prevent="addPage">
            <div class="row">
              <div class="col-6">
                <InputText
                  title="Name"
                  wrapperclass='form-group'
                  classname='form-control'
                  :errors="errors.name"
                  v-model="usergroupData.name"
                />

                <div class="form-group">
                  <LinkButton
                    route="usergroup-index"
                    classname="btn btn-sm btn-primary mr-2"
                    name="Back"
                  />
                  <button type="submit" class="btn btn-sm btn-success">
                    Save
                  </button>
                </div>
              </div>
              <div class="col-6">

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
import Helper from "./../../../Helper/moment";
import GLOBAL_CONSTANT from "./../../../constant";

export default {
  mixins: [Helper],
  name: "UserggroupAdd",
  data() {
    return {
      usergroupData:{},
      errors: {},
    };
  },
  mounted() {

  },
  methods: {
    ...mapActions("Usergroup", ["userGroupAdd"]),

    addPage() {
      this.userGroupAdd(this.usergroupData)
        .then((response) => {
          if (
            response.success &&
            response.statuscode == GLOBAL_CONSTANT["USERGROUP_INSERT_SUCCESS"]
          ) {
            this.errors = {};
            this.$toastr.s(response.message,"Success");
            this.$router.push({name:'usergroup-index'});
          } else {
            this.errors = response;
          }
        })
        .catch(() => {});
    },
  },
};
</script>
