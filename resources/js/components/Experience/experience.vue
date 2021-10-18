<template>
   <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="contact-tab">
   <form class="p-3" @submit.prevent="create" enctype="multipart/form-data">
   <!--new feild-->
<div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-12">
          
          <label for="exampleInputEmail1">Organization Name</label>
         <input type="text" class="form-control" id="url" aria-describedby="emailHelp" placeholder="company Name" v-model="form.organization_name	">
    
          </div>
          
  </div>
   </div>

 <!--end of feild-->
  <div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-12">
          
          <label for="exampleInputEmail1">Job Title</label>
 <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Job Title" v-model="form.title">        
        <small class="text-danger" v-if="errors.degree" >{{ errors.degree[0] }}</small>
          </div>
      
        
      </div>
    
  </div>
 <!--new feild-->
<div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">Start Date</label>
         <input type="date" class="form-control" id="url" aria-describedby="emailHelp"  v-model="form.start_date">
        <small class="text-danger" v-if="errors.start_date" >{{ errors.start_date[0] }}</small>
          </div>
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">End Date</label>
         <input type="date" class="form-control" id="url" aria-describedby="emailHelp"  v-model="form.end_date">
    
          </div>
         
      </div>
    
  </div>

 <!--end of feild-->
  <!--new feild-->
<div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">Job Description</label>
         <textarea class="form-control" v-model="form.description"></textarea>
          </div>
          <div class="col-md-6">
          
          
          <br>
         <input type="checkbox"  id="checkbox" aria-describedby="emailHelp"  v-model="form.present">
      <span for="exampleInputEmail1">Present if Position Not Resign</span>
          </div>
         
      </div>
    
  </div>

 <!--end of feild-->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      <table v-if="experiences.length>0" class="table">
  <thead>
    <tr>
      	
      <th scope="col">Title</th>
      <th scope="col">organization name</th>
      <th scope="col">start date</th>
      <th scope="col">end date</th>
      <th scope="col">Present</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
    <tr v-for="experience in experiences" :key="experience.id">
      <td>{{experience.title}}</td>
  <td>{{experience.organization_name}}</td>
      	
        <td>{{experience.start_date}}</td>
         <td>{{experience.end_date}}</td>
          <td>{{experience.present || 'compeleted'}}</td>
      <td>
      <button @click="deleteexperience(experience.id)" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
      <button @click="editexperience(experience)" class="btn btn-sm btn-outline-success"><i class="fa fa-edit"></i></button>
      </td>
    </tr>
   
    
  </tbody>
</table>
   </div>
</template>


<script>
    export default {
        created()
        {
         axios.get('/getexperience')
        .then(resp=>{
            this.experiences = resp.data;
                    })
        .catch(error=>{
                       
                 })
        },
          data()
          {
              return {
                  form:{
                      organization_name:null,
                      description:null,
                      title:null,
                      start_date:null,
                      end_date:null,
                      grade:null,
                      present:null,
                      id:null
                  },
                 errors:{},
                    
                         experiences:[],
                         
              }
          },
          methods:{
              
            
                create()
      {
         
        axios.post('/ceate_experience',this.form)
        .then(resp=>{
          this.experiences = resp.data.userdata;
                 Toast.fire({
                 icon: resp.data.icon,
                 title: resp.data.message
                   });
         
               }).catch(error=>{
                 this.errors = error.response.data.errors;
                 Toast.fire({
                 icon: 'warning',
                 title: 'Something Went to Wrong'
                   });
                   
        })
      },
      deleteexperience(id)
      {
          
         
           axios.get('/deleteexperience/'+id)
        .then(resp=>{
            this.experiences = resp.data.userdata;
              Toast.fire({
                 icon: resp.data.icon,
                 title: resp.data.message
                   });
                    })
        .catch(error=>{
                       
                 })

      },
      editexperience(experience)
      {
           this.form = experience;
           
      }
          }     
    }
</script>

