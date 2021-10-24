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
        <li class="nav-item" ref="collapse_bar">
          <a @click.prevent="collapseSidebar" class="nav-link" data-widget="pushmenu" href="#" role="button"
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
        
        <li class="nav-item dropdown" ref="profile_section">
          <a
            @click.prevent="headerDropdown()"
            class="nav-link"
            data-toggle="dropdown"
            href="#"
            aria-expanded="true"
          >
            <i class="far fa-user"></i>
          </a>
          <div
            class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
            :class="{show:isShowProfileDropdown}"
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
  data(){
    return {
      isShowProfileDropdown:false,
    }
  },
  methods:{
    headerDropdown(){
      this.isShowProfileDropdown = !this.isShowProfileDropdown
    },
    logout(){
      this.$store.dispatch("auth/setLogout");
      this.$router.push("/login");
    },
    collapseSidebar(){
      $('body').toggleClass('sidebar-collapse');
    },

    close (e) {
      if (!this.$refs.profile_section.contains(e.target)) {
        this.isShowProfileDropdown = false
      }
      
    }
    
  },
  mounted () {
    document.addEventListener('click', this.close)
  },
  beforeDestroy () {
    document.removeEventListener('click',this.close)
  }
};
</script>