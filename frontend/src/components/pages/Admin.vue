<template>
  <div class="wrapper" @click="toggle">
    <Header />
    <Sidebar />
    <transition name="fade">
      <router-view />
    </transition>
    <Footer />
  </div>
</template>

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
    },
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
};
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