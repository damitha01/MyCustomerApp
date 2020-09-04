<template>
  <div class="container">
    <h2>Register Customer</h2>
    <div class="myFromBlock">
      <form>
        <div class="form-group row">
          <label for="name" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="name" v-model="name">
            <div v-if="nameError" class="alert alert-danger" role="alert">{{nameError}}</div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nic" class="col-sm-2 col-form-label">NIC</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="nic" v-model="nic">
            <div v-if="nicError" class="alert alert-danger" role="alert">{{nicError}}</div>
          </div>
        </div>        
        <div class="form-group row">
          <label for="address" class="col-sm-2 col-form-label">Address</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="address" v-model="address">
            <div v-if="addressError" class="alert alert-danger" role="alert">{{addressError}}</div>
          </div>
        </div>        
        <div class="form-group row">
          <label for="telephone" class="col-sm-2 col-form-label">Telephone</label>
          <div class="col-sm-6">
            <div class="row" v-for="(item, index) in contacts" v-bind:key="index">
              <div class="col-sm-10">
                <input type='text' class='form-control' v-model="telephone[index]" @input="validateTelephone(index)">
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-danger form-control" @click="removeTelephone(index)">-</button>
              </div>

            </div>
            <div v-if="teleError" class="alert alert-danger" role="alert">{{teleError}}</div>
            
          </div>
          <div class="col-sm-1">
            <button type="button" class="btn btn-info form-control" @click="addTelephone()">+</button>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6">
            <button type="reset" class="btn btn-warning">Cancel</button>
            <button type="submit" class="btn btn-primary" @click.prevent="submitCustomer">Save</button>
          </div>
        </div>
      </form>

    </div>

    
    
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data () {
    return {
     contacts: [""],
      name: '',
      nic: '',
      address: '',
      telephone: [],
      nameError:"",
      nicError:"",
      addressError:"",
      teleError:""
    }
  },
  methods: {
      addTelephone : function() {
         this.contacts.push("");
      },
      removeTelephone : function(index) {
        this.contacts.splice(index,1);
        console.log(this.contacts);
      },
      submitCustomer : function(){
        var validateForm = this.validateFormdata();
        
        if(validateForm){
          // Send backend post request to create a new customer
          axios.post('http://localhost:8000/customer',{
                      name: this.name,
                      nic: this.nic,
                      address: this.address,
                      telephone: this.telephone,
          }).then(function(response){
              console.log(response.data);
              if(response.data){
                Swal.fire(
                  'Good job!',
                  'You Created a new customer!',
                  'success'
                );

                this.resetFrom();
                
              }
              
          }.bind(this));
        }
      },
      resetFrom: function(){
        this.contacts = [""];
        this.name = "";
        this.nic = "";
        this.address = "";
        this.telephone = [];
      },
      validateFormdata: function(){
        var valid = true;

        if(this.name == ""){
          valid = false;
          this.nameError= 'Please fill the Name field.';
        }else{
          this.nameError = "";
        }

        if(this.nic == ""){
          valid = false;
          this.nicError= 'Please fill the NIC field.';
        }else{
          this.nicError = "";
        }

        if(this.address == ""){
          valid = false;
          this.addressError = 'Please fill the Address field.';
        }else{
           this.addressError = "";
        }

        var teleValid = true;
        for(var i=0; i < this.contacts.length; i++){
          if( this.telephone[i] == undefined){
            teleValid = false;
          }
        }

        if(!teleValid){
          valid = false;
          this.teleError= 'Please fill the Telephone field.';
        }else{
          this.teleError = "";
        }

        return valid;
      },
      validateTelephone(value) {
        var x = this.telephone[value].replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        this.telephone[value] = x[1] + x[2] + x[3];
       
      }

  }
}
</script>


<style scoped>

</style>
