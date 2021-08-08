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
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer"
              >See All Notifications</a
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
    }
  }
};
</script>