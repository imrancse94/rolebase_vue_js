<template>
  <div id="app">
    <div id="loader" v-if="loading">
      <div class="inner-loader center"></div>
    </div> 
    <router-view></router-view>
  </div>
</template>



<script>


export default {
  name: 'App',
  data(){
    return{
      loading:false
    }
  },
  components: {},
  created(){
    this.$eventBus.$on('loadingStatus',payload =>{
        this.loading = payload;
    });
    
  }
  
  
}
</script>
