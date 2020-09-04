<template>
  <div id="app">
    <div class="container">
      <div class="menuButtons">
        <div class="menuButtonsBlock">
          <button @click="setPage(1)" class="btn btn-primary">Create Customer</button>
          <button @click="setPage(2)" class="btn btn-primary">View Customers</button>
        </div>
      </div>
      <h1 class="homepageTitle">{{ mytitle }}</h1>
      <CustomerHome v-if="createPage"/>
      <ShowCustomer v-if="showPage"/>
    </div>
  </div>
</template>

<script>
import CustomerHome from './components/CustomerHome'
import ShowCustomer from './components/ShowCustomer'

export default {
  name: 'App',
  components: {
    CustomerHome,
    ShowCustomer
  },
  data(){
    return {
       mytitle: 'Customer Address Book',
      createPage: true,
      showPage: false
    }
  },
  methods: {
    setPage : function(index){
      if(index==1){
        this.createPage = true;
        this.showPage = false;
      }else{
         this.createPage = false;
        this.showPage = true;
      }
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.menuButtons {
    display: flex;
}
</style>
