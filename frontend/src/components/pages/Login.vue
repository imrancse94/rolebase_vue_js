<template>
  <div class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#">
          <b>IT</b>Care
        </a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Start Login Here</p>
          <p
            v-if="errors.data == 'Unauthorized'"
            class="alert alert-danger text-center login-error"
          >{{errors.message}}</p>
          <form @submit.prevent="login">
            <div class="input-group mb-3">
              <input
                v-model="email"
                :class="has_error && errors.data.email ? 'is-invalid':''"
                type="email"
                class="form-control"
                placeholder="Email"
              />

              <div class="input-group-append">
                <div class="input-group-text">
                  
                </div>
              </div>
              <div
                class="invalid-feedback"
                v-if="has_error && errors.data.email"
              >{{errors.data.email}}</div>
            </div>
            <div class="input-group mb-3">
              <input
                v-model="password"
                value="123456"
                :class="has_error && errors.data.password ? 'is-invalid':''"
                type="password"
                class="form-control"
                placeholder="Password"
              />

              <div class="input-group-append">
                <div class="input-group-text">
                  
                </div>
              </div>
              <div
                class="invalid-feedback"
                v-if="has_error && errors.data.password"
              >{{errors.data.password}}</div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember">Remember Me</label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3"></div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</template>



<script>
export default {
  name: "Login",
  components: {},
  data() {
    return {
      email: "ssadmin@admin.com",
      password: "123456",
      /*email: "",
      password: "",*/
      remember: false,
      has_error: false,
      errors: {
        data: null,
        message: null,
      },
    };
  },

  methods: {
    login() {
      
      let email = this.email;
      let password = this.password;

      this.$store
        .dispatch("auth/login", { email, password })
        .then((response) => {
          
          if (response.success) {
            this.$router.push("/admin");
          } else {
            this.has_error = true;
            this.errors.data = response.data;
            this.errors.message = response.message;
          }

        })
        .catch(() =>{});
    },
  },
};
</script>
