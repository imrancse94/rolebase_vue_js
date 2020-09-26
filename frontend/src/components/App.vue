<template>
  <div id="app" class="page">
    <div id="overlay" v-if="this.$store.state.auth.loader"> 
        <i class="fa fa-spinner fa-spin spin-big"></i>
    </div>

      <router-view></router-view>

  </div>
</template>

<style>

  .fade-enter-active,
  .fade-leave-active {
    transition-duration: 0.3s;
    transition-property: opacity;
    transition-timing-function: ease;
  }

  .fade-enter,
  .fade-leave-active {
    opacity: 0
  }

</style>


<script>


export default {
  name: 'App',
  data(){
    return{
      loading:false
      //loading:this.$store.state.auth.loader
    }
  },
  components: {},
  created(){
    console.log('')
    this.$eventBus.$on('loadingStatus',payload =>{
        this.loading = payload;
    });
    
  },
  methods:{
    
  }
  
  
}
</script>
