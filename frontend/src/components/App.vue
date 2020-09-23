<template>
  <div id="app">
    <div id="overlay" v-if="this.$store.state.auth.loader"> 
        <i class="fa fa-spinner fa-spin spin-big"></i>
    </div>
    <router-view></router-view>
  </div>
</template>



<script>


export default {
  name: 'App',
  data(){
    return{
      loading:this.$store.state.auth.loader
    }
  },
  components: {},
  created(){
    console.log('')
    this.$eventBus.$on('loadingStatus',payload =>{
        this.loading = payload;
    });
    
  }
  
  
}
</script>
