<template>
  <div id="app">
    <div v-if="this.$store.state.isNotPermitted" id="toast-container" class="toast-top-right">
      <div class="toast toast-error" aria-live="assertive" style="">
        <div class="toast-message">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr.
        </div>
      </div>
    </div>
    <Loader v-if="$store.getters['loading/getLoaderStatus']" />
    <router-view></router-view>
   
  </div>
</template>

<script>
  import { mapState } from "vuex";
  import Loader from "./components/Include/Loader.vue";
  
  export default{

    components: {
    Loader
  },
    mounted(){
     
    },
    computed: {
    ...mapState("module", ["status"]),
    
  },
    methods:{
      
    }
  }
 
</script>

