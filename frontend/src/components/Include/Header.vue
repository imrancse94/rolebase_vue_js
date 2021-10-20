<template>
  <div>
    <!-- Preloader -->
    <div
      class="preloader flex-column justify-content-center align-items-center"
    >
      <img
        class="animation__shake"
        src="/dist/img/AdminLTELogo.png"
        alt="AdminLTELogo"
        height="60"
        width="60"
      />
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        
        <li class="nav-item dropdown">
          <a
            @click.prevent="headerDropdown($event)"
            class="nav-link"
            data-toggle="dropdown"
            href="#"
            aria-expanded="true"
          >
            <i class="far fa-user"></i>
          </a>
          <div
            class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
            style="left: inherit; right: 0px"
          >
            <span class="dropdown-item dropdown-header">Profile</span>
            <div class="dropdown-divider"></div>
            <a href="#" @click.prevent="logout" class="dropdown-item dropdown-footer"
              >Log Out</a
            >
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
  </div>
</template>

<script>
export default {
  name: "Header",
  methods:{
    headerDropdown($event){
      var element = $event.target;
      var parentElement = $(element).parents('li').first();
      parentElement.toggleClass('show');
      parentElement.find('div.dropdown-menu-right').toggleClass('show');
    },
    logout(){
      this.$store.dispatch("auth/setLogout");
      this.$router.push("/login");
    }
  }
};
</script>