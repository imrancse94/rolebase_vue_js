<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img
        src="/dist/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"
      />
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img
            src="/dist/img/user2-160x160.jpg"
            class="img-circle elevation-2"
            alt="User Image"
          />
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
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
          <li v-for="(item,i1) in sidebarList" :key="i1" class="nav-item" :class="$route.matched[0].name == item.page_name ? 'menu-is-opening menu-open':''">
            <a href="#" :ref="i1" v-if="item.page_name" :key="i1" @click.prevent="accordiaon(this)" class="nav-link" :class="0 ? 'active':''">
              <i :class="'nav-icon '+item.icon"></i>
              <p>
                {{ item.page_name}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li v-for="(item1,index) in item.submenu" :key="index" class="nav-item">
                <router-link :ref="index" :key="index" :to="{name:item1.permission_name}" v-if="item1.is_index == 1"   class="nav-link" :class="$route.name === item1.page_name ? 'active':''">
                  <i :class="item1.icon+' nav-icon'"></i>
                  <p>{{ item1.page_name }}</p>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
</template>

<script>
  export default{
    name:'Sidebar',
    data(){
       return {
        sidebarList : [],
        children: [],
        current_route:this.$route.name
      }
    },
    computed:{
      currentRoute:()=>{
        return 'admin.dashboard';
      }
    },
    methods:{
      accordiaon(elem){
        var element = event.target;
        var targetElement = $(element).parents('li').first();
        targetElement.find('ul.nav-treeview').slideToggle();
        targetElement.toggleClass('menu-is-opening menu-open');
        
      }
    },
    mounted(){
      //&& $router.resolve({ name: item1.permission_name }).resolved.matched.length > 0
      const sidebarlist = this.$store.getters['auth/getSidebarList'];
      if(sidebarlist){
        for(var i in sidebarlist){
          var has_route = false
          if(sidebarlist[i].submenu){
            for(var j in sidebarlist[i].submenu){
              if(this.$router.resolve({ name: sidebarlist[i].submenu[j].permission_name }).resolved.matched.length > 0){
                  has_route = true;
                  break;
              }
            }
          }
          this.sidebarList.push(sidebarlist[i]);
        }
      }

      //this.sidebarList = this.$store.getters['auth/getSidebarList'];
    },
    
  }

  
</script>

