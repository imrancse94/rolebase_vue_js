<template>
  <section class="login-block">
    <div class="container">
      <div class="row">
        <div class="col login-sec">
          <h2 class="text-center">Login Now</h2>
          <div
            v-if="errors.data == 'Unauthorized'"
            class="alert alert-danger text-center"
            role="alert"
          >
          {{errors.message}}
          </div>
          <form class="login-form">
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-uppercase">Username</label>
              <input
                v-model="email"
                type="text"
                class="form-control"
                :class="has_error && errors.data.email ? 'is-invalid':''"
                placeholder
              />
              <div
                class="invalid-feedback"
                v-if="has_error && errors.data.email"
              >{{errors.data.email}}</div>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="text-uppercase">Password</label>
              <input
                v-model="password"
                :class="has_error && errors.data.password ? 'is-invalid':''"
                type="password"
                class="form-control"
                placeholder
              />
              <div
                class="invalid-feedback"
                v-if="has_error && errors.data.password"
              >{{errors.data.password}}</div>
            </div>

            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" />
                <small>Remember Me</small>
              </label>
              <button type="button" @click="login()" class="btn btn-login pull-right">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>
<style>
      @import '/assets/css/login.css';
</style>


<script>
export default {
  name: "Login",
  components: {},
  data() {
    return {
      email: "",
      password: "",
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
      this.$eventBus.$emit("loadingStatus", true);
      let email = this.email;
      let password = this.password;
      this.$store
        .dispatch("login", { email, password })
        .then((response) => {
          console.log(response);
          this.$eventBus.$emit("loadingStatus", false);
          if (response.success) {
            this.$router.push("/dashboard");
          } else {
            this.has_error = true;
            this.errors.data = response.data;
            this.errors.message = response.message;
          }
        })
        .catch(() => this.$eventBus.$emit("loadingStatus", false));
    },
  },
};
</script>
