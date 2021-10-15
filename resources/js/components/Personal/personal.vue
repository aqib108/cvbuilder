<template>
   <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="home-tab">
  <form class="p-3" @submit.prevent="create" enctype="multipart/form-data">
  <div class="form-group">
      <div class="form-row">
          <div class="col-md-6">
          <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Name" v-model="form.name">
      <small class="text-danger" v-if="errors.name" >{{ errors.name[0] }}</small>
          </div>
          <div class="col-md-6">
          <label for="exampleInputEmail1">Father Name</label>
    <input type="text" class="form-control" id="father_name" aria-describedby="emailHelp" placeholder="Father Name" v-model="form.father_name">
 <small class="text-danger" v-if="errors.father_name" >{{ errors.father_name[0] }}</small>
          </div>
      </div>
   
  </div>
  <div class="form-group">
      <div class="form-row">
          <div class="col-md-6">
          <label for="exampleInputEmail1">Phone</label>
    <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Phone" v-model="form.phone">
 <small class="text-danger" v-if="errors.phone" >{{ errors.phone[0] }}</small>
          </div>
          <div class="col-md-6">
          <label for="exampleInputEmail1">Email</label>
    <input type="text" class="form-control" id="father_name" aria-describedby="emailHelp" placeholder="Father Name" v-model="form.email">

          </div>
      </div>
   
  </div>
  <div class="form-group">
      <div class="form-row">
          <div class="col-md-6">
          <label for="exampleInputEmail1">Cnic</label>
    <input type="text" class="form-control" id="cnic" aria-describedby="emailHelp" placeholder="cnic" v-model="form.cnic">
 <small class="text-danger" v-if="errors.cnic" >{{ errors.cnic[0] }}</small>
          </div>
          <div class="col-md-6">
          <label for="exampleInputEmail1">Date of birth</label>
    <input type="date" class="form-control" id="DOB" aria-describedby="emailHelp" placeholder="DOB" v-model="form.dob">
 <small class="text-danger" v-if="errors.dob" >{{ errors.dob[0] }}</small>
          </div>
      </div>
   
  </div>
   <div class="form-group">
      <div class="form-row">
          <div class="col-md-12">
          <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Address" v-model="form.address">
 <small class="text-danger" v-if="errors.address" >{{ errors.address[0] }}</small>
          </div>
          
      </div>
   
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </div>
</template>

<script>
    export default {
        created()
        {
            axios.get('/getprofile')
        .then(resp=>{
            this.form = resp.data;
                    })
        .catch(error=>{
                       
                 })
            
        },
        data()
        {
            return{
                form:{
                    name:null,
                    father_name:null,
                    cnic:null,
                    phone:null,
                    email:null,
                    address:null,
                    dob:null,
                    id:null,
                },
                errors:{}
            }
        },
        methods:{
              create()
      {
         
        axios.post('/profile',this.form)
        .then(resp=>{
            this.form = resp.data.userdata;
    //  console.log(resp);
 Toast.fire({
                 icon: resp.data.icon,
                 title: resp.data.message
                   });
         
                //   this.$router.push({name: 'Home'});
       /// this.$router.push({name: 'All-Product'})
         
        })
        .catch(error=>{
          this.errors = error.response.data.errors;
         Toast.fire({
                 icon: 'warning',
                 title: 'Something Went to Wrong'
                   });
                   
        })
      }
        }
    }
</script>
