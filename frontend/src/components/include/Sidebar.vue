<template>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img
        src="/dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8"
      />
      <span class="brand-text font-weight-light">Role Base</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
        </div>
        <div class="info">
          <a href="#" class="d-block">{{user.name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >
          <li v-for="(sidebar,index) in permissions" :key="index" :class="currentIndex == index ? 'menu-open':''" class="nav-item has-treeview">
            <a href="#" @click.prevent="toggleContent(index)" class="nav-link">
              <i :class="'nav-icon '+sidebar.icon"></i>
              <p>
                {{sidebar.name}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li v-for="child in sidebar.children" :key="child.key" class="nav-item">
                <router-link class="nav-link" :to="{'path':'/'+child.url}">
                  <i :class="child.icon+' nav-icon'"></i>
                  <p>{{child.name}}</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
//import $ from 'jquery'
export default {
  name: "Sidebar",

  mounted() {
    this.$eventBus.$emit("loadingStatus", false);
    
  },
  data() {
    return {
      permissions: this.$store.state.auth.permissions,
      user: this.$store.state.auth.user,
      currentIndex: 0
    };
  },
  beforeMount(){
    this.$eventBus.$emit("loadingStatus", true);
  },
  methods: {
    toggleContent(index) {
        if(this.currentIndex == index){
          this.currentIndex = 0;
        }else{
          this.currentIndex = index;
        }
          
    }
  }
};
</script>

