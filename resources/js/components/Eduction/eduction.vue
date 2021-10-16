<template>
   <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="contact-tab">
   <form class="p-3" @submit.prevent="create" enctype="multipart/form-data">
  <div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">Degree Title</label>
        <select class="form-control" v-model="form.degree">
        <option value="Matric">Matric</option>
         <option value="intermediate">intermediate</option>
         <option value="bachelor's">bachelor's</option>
         <option value="Master's">Master's</option>
         <option value="ms">MS</option>
         <option value="phd">PHD</option>
        </select>
        <small class="text-danger" v-if="errors.degree" >{{ errors.degree[0] }}</small>
          </div>
      
          <div class="col-md-6">
          <label for="exampleInputEmail1">Degree Title</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Degree Title" v-model="form.title">
 <small class="text-danger" v-if="errors.title" >{{ errors.title[0] }}</small>
          </div>
         
      </div>
    
  </div>
 <!--new feild-->
<div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">Start Date</label>
         <input type="date" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Project Url" v-model="form.start_date">
        <small class="text-danger" v-if="errors.start_date" >{{ errors.start_date[0] }}</small>
          </div>
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">End Date</label>
         <input type="date" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Project Url" v-model="form.end_date">
    
          </div>
         
      </div>
    
  </div>

 <!--end of feild-->
  <!--new feild-->
<div  class="form-group">
      <div  class="form-row">
      
          <div class="col-md-6">
          
          <label for="exampleInputEmail1">Marks/cgpa/grade/devision</label>
         <input type="text" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Grade" v-model="form.grade">
    
          </div>
          <div class="col-md-6">
          
          
          <br>
         <input type="checkbox"  id="checkbox" aria-describedby="emailHelp"  v-model="form.present">
      <span for="exampleInputEmail1">Present if Degree Not Compelete</span>
          </div>
         
      </div>
    
  </div>

 <!--end of feild-->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   
   </div>
</template>


<script>
    export default {
        created()
        {
         axios.get('/getprojects')
        .then(resp=>{
            this.aprojects = resp.data;
                    })
        .catch(error=>{
                       
                 })
        },
          data()
          {
              return {
                  form:{
                      degree:null,
                      title:null,
                      start_date:null,
                      end_date:null,
                      grade:null,
                      present:null,
                  },
                 errors:{},
                    
                         educations:[],
                         
              }
          },
          methods:{
              
            
                create()
      {
         
        axios.post('/ceate_education',this.form)
        .then(resp=>{
          this.education = resp.data.userdata;
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
      deleteproject(id)
      {
          
         
           axios.get('/deleteproject/'+id)
        .then(resp=>{
            this.aprojects = resp.data.userdata;
              Toast.fire({
                 icon: resp.data.icon,
                 title: resp.data.message
                   });
                    })
        .catch(error=>{
                       
                 })

      },
      editproject(project)
      {
           this.Editdata = project;
           
    VModal.show("EditModal");
      }
          }     
    }
</script>

