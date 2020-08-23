<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-static-top">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav profile-section">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />
            <span class="hidden-xs">{{user.name}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
              <p>
                {{user.name}}
                <small></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="#" @click.prevent="logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Footer",
  data(){
    return {
      user:this.$store.state.auth.user
    }
  },
  methods: {
    logout(){
      this.$eventBus.$emit("loadingStatus", true);
      this.$store.dispatch('auth/logout').then(()=>{
        this.$eventBus.$emit("loadingStatus", false);
        this.$router.push("/login");
      })
    }
  },
};
</script>

