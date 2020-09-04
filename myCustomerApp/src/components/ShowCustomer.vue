<template>
  <div class="container">
    <h2>View Customers</h2>
    <div class="myFromBlock">
      <form>
        <div class="form-group row">
          <label for="search" class="col-sm-2 col-form-label">Search</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="search" v-model="search">
          </div>
          <div class="col-sm-2">
            <button type="submit" class="btn btn-primary" @click.prevent="searchCustomer">Search</button>
          </div>
        </div>
      </form>

      <div class="customerViewBlock">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">NIC</th>
              <th scope="col">Address</th>
              <th scope="col">Telephone</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="customer in customers" >
              <td scope="row">{{customer.id}}</td>
              <td>{{customer.name}}</td>
              <td>{{customer.nic}}</td>
              <td>{{customer.address}}</td>
              <td>
                <div v-for="(telephone,index) in customer.telephone">
                  <span>{{telephone.telephone}}</span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data () {
    return {
      search: '',
      customers:[]
    }
  },
  mounted:function(){
        this.getAllCustomers() 
  },
  methods: {
      
      getAllCustomers : function(){
        // Get All customer details
        axios.get('http://localhost:8000/customers').then(function(response){
              console.log(response.data);
              if(response.data){
                this.customers = response.data;
              }
              
          }.bind(this));

      },
      
      searchCustomer : function(){
        // Get All customer details
        axios.get('http://localhost:8000/customer/search?term='+this.search).then(function(response){
              console.log(response.data);
              if(response.data){
                this.customers = response.data;
              }
              
          }.bind(this));

      }

  }
}
</script>


<style scoped>

</style>
