<template>
  <div class="wrapper">
  <Header/>
  <Sidebar/>
    <router-view/>
  <Footer/>
</div>
</template>

<script>
import Header from '../include/Header';
import Sidebar from '../include/Sidebar';
import Footer from '../include/Footer';
export default {
  name: 'Admin',
  components:{
    Header,
    Sidebar,
    Footer
  }
}
</script>

