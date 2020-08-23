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
          >{{errors.message}}</div>
          <form class="login-form" @submit.prevent="login">
            <div class="form-group">
              <label for="exampleInputEmail1" class="text-uppercase">Username</label>
              <input
                v-model="email"
                type="text"
                class="form-control"
                value="ssadmin@admin.com"
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
                value="123456"
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
              <button type="submit" class="btn btn-login pull-right">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String
  }
}
</script>

