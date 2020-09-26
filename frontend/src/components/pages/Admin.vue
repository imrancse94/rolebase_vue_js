<template>
  <div class="wrapper" @click="toggle">
    <Header />
    <Sidebar />
    <transition name="fade" mode="out-in">
      <router-view></router-view>
    </transition>
    <Footer />
  </div>
</template>

<style scoped>
  .router-link-active {
  color: red;
}

.fade-enter {
  opacity: 0;
}

.fade-enter-active {
  transition: opacity 2s ease;
}

.fade-leave {}

.fade-leave-active {
  transition: opacity 2s ease;
  opacity: 0;
}

</style>

<script>
import ClickOutside from "vue-click-outside";
import Header from "../include/Header";
import Sidebar from "../include/Sidebar";
import Footer from "../include/Footer";

export default {
  name: "Admin",
  components: {
    Header,
    Sidebar,
    Footer,
  },
  data() {
    return {
      opened: false,
      
    };
  },

  methods: {
    toggle() {
      const topbar = event.target.classList;
      const body = document.body;
      if (!topbar.contains("top-bars")) {
        if (body.classList.contains("sidebar-collapse")) {
          body.classList.remove("sidebar-collapse");
        }

        if (body.classList.contains("sidebar-open")) {
          body.classList.remove("sidebar-open");
          body.classList.remove("sidebar-collapse");
        }
      }
    }
  },
  mounted() {
    this.popupItem = this.$el;
    this.$eventBus.$emit("loadingStatus", false);
  },
  beforeMount() {
    this.$eventBus.$emit("loadingStatus", true);
  },

  directives: {
    ClickOutside,
  },
  watch: {
  '$route'(to, from){
    const to_depth = to.path.split('/').length
    const from_depth = from.path.split('/').length
    this.animationName = to_depth < from_depth ? 'slide-right' : 'slide-left'
    }
  }
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>