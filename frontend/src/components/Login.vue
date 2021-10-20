<template>
<div>
  
    <div class="login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h1"><b>Login Page</b></a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form @submit.prevent="login" action="" method="post">
            <div class="input-group mb-3">
              <input
                v-model="email"
                type="email"
                class="form-control"
                placeholder="Email"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                v-model="password"
                type="password"
                class="form-control"
                placeholder="Password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">
                  Log In
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
  
</template>

<script>
export default {
  data() {
    return {
      email: "ssadmin@admin.com",
      password: "123456",
      errors:{}
    };
  },
  methods: {
    login() {

      let email = this.email;
      let password = this.password;
      let self = this;
      this.$store
        .dispatch("loading/startLoading");
      this.$store
        .dispatch("auth/login", { email, password })
        .then((response) => {
          if (response.success) {
            self.$store.dispatch("loading/stopLoading");
            this.$router.push("/admin");
            this.$toastr.s("Successfully loggedin", "Success");
          } else {
            this.has_error = true;
            this.errors = response;
          }
        });
    },
  },
  mounted(){
    
  }
};
</script>
