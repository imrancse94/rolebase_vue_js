<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <ContentPageHeader header="User Management" />

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <!--card-header-->
        <div class="card-header">
          <div class="row">
            <div class="col">
              <h3 class="card-title">User Edit</h3>
            </div>
            <div class="col text-right">
              <LinkButton
                route="user-index"
                classname="btn btn-sm btn-primary"
                name="User List"
              />
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" @submit.prevent="editUser">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input
                    type="text"
                    :class="errors.name ? 'is-invalid' : ''"
                    v-model="userData.name"
                    class="form-control"
                    placeholder="Page Name"
                  />
                  <ErrorValidation :msg="errors.name" />
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">
                  <a href="#" @click.prevent="toggleModal">Change Password</a></label>
                </div>

                <div class="form-group">
                  <LinkButton
                    route="page-index"
                    classname="btn btn-sm btn-primary mr-2"
                    name="Back"
                  />
                  <button type="submit" class="btn btn-sm btn-success">
                    Save
                  </button>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input
                    type="text"
                    :class="errors.email ? 'is-invalid' : ''"
                    v-model="userData.email"
                    class="form-control"
                    placeholder="Sequence"
                  />
                  <ErrorValidation :msg="errors.email" />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <base-modal v-if="isShowModal" @close="toggleModal" title="Change Password">
     <template v-slot:body>
        <div class="form-group">
            <label for="exampleInputEmail1">Old Password</label>
            <input
              type="text"
              :class="passwordErrors.oldpassword ? 'is-invalid' : ''"
              v-model="passwordData.oldpassword"
              class="form-control"
              placeholder="Old Password"
            />
            <ErrorValidation :msg="passwordErrors.oldpassword" />
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">New Password</label>
              <input
                type="text"
                :class="passwordErrors.password ? 'is-invalid' : ''"
                v-model="passwordData.password"
                class="form-control"
                placeholder="Password"
              />
              <ErrorValidation :msg="passwordErrors.password" />
          </div>
     </template>
     <template v-slot:footer>
        <button type="button" @click.prevent="changePassword" class="btn btn-primary">Save changes</button>
     </template>
    </base-modal>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Helper from "./../../../Helper/moment";
import GLOBAL_CONSTANT from "./../../../constant";
import BaseModal from "../../Include/Modal.vue";

export default {
  components: {BaseModal},
  mixins: [Helper],
  name: "userEdit",
  data() {
    return {
      errors: {},
      userData: {},
      isModalOpen:false,
      isShowModal: false,
      passwordData:{},
      passwordErrors:{}
    };
  },

  mounted() {
    var user_id = this.$router.currentRoute.params.id;
    this.getUserById(user_id).then((data) => {
      this.userData = data;
    });
  },
  methods: {
    ...mapActions("User", ["getUserById","userEdit","updatePassword"]),
    modalOpen(){
      this.isModalOpen = true;
    },
    editUser() {
      this.userEdit(this.userData)
        .then((response) => {
          console.log('response',response,GLOBAL_CONSTANT)
          if (
            response.success &&
            response.statuscode == GLOBAL_CONSTANT["USER_UPDATED_SUCCESS"]
          ) {
            this.errors = {};
            this.$toast.success({
              title: "Saved",
              message: "Sub Module Changes Saved successfully.",
            });
          } else {
            this.errors = response;
          }
          //console.log('this.errors',this.errors,response)
        })
        .catch(() => {});
    },
    toggleModal() {
      this.passwordData = {};
      this.passwordErrors = {};
      this.isShowModal = !this.isShowModal;
    },
    changePassword(){
     this.passwordData['id'] = this.$router.currentRoute.params.id;
      this.updatePassword(this.passwordData).then((data) => {
        if (data.success){

        }else{
          this.passwordErrors = data;
          console.log('pass',this.passwordErrors);
        }
        
      });
      
    }
    
  },
};
</script>
