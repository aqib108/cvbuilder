<template>
   <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="profile-tab">
   <form class="p-3" @submit.prevent="create" enctype="multipart/form-data">
  <div v-for="(project,index) in projects" :key="index" class="form-group">
      <div  class="form-row">
      
          <div class="col-md-5">
          
          <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Project Title" v-model="form.title[index]">
    
          </div>
          <div class="col-md-5">
          <label for="exampleInputEmail1">url</label>
    <input type="text" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Project Url" v-model="form.url[index]">
 
          </div>
          <div class="col-md-2">
           
         
          <button type="button" v-if="projects.length>1"  @click="removerow(index)" class="btn btn-xs btn-success">Remove</button>
          </div>
      </div>
    
  </div>
 <button style="float: right;" type="button"  @click="Addrow()" class="btn btn-xs btn-success">Add</button><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   <table v-if="aprojects.length>0" class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Url</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="aproject in aprojects" :key="aproject.id">
      <td>{{aproject.title}}</td>
      <td>{{aproject.url}}</td>
      <td>
      <button @click="deleteproject(aproject.id)" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></button>
      <button @click="editproject(aproject)" class="btn btn-sm btn-outline-success"><i class="fa fa-edit"></i></button>
      </td>
    </tr>
   
    
  </tbody>
</table>
<!--Edit Model -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="update">
        <input type="text" v-model="Editdata.title" class="form-control" />
        <input type="text" v-model="Editdata.url" class="form-control" />
        <input type="hidden" v-model="Editdata.id" class="form-control" />
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
        </form>
      </div>
    
   
    </div>
  </div>
</div>

<!--end of Edit Model-->
   </div>
</template>

<script>
var $ = require('jquery')
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
                      title:[],
                      url:[]
                  },
                  projects:[
                  {
                title: '',
                url:''
                 }
                         ],
                         aprojects:[],
                         Editdata:{
                             id:null,
                             title:null,
                             url:null
                         }
              }
          },
          methods:{
              
              Addrow()
              {
                  this.projects.push({
                          title: '',
                          url:''
                          })
              },
              removerow(counter)
              {
                this.projects.splice(counter,1);
                this.form.title.splice(counter,1);
                this.form.url.splice(counter,1);
              },
                create()
      {
         
        axios.post('/ceate_projects',this.form)
        .then(resp=>{
          this.aprojects = resp.data.userdata;
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
      update()
      {
         
        axios.post('/update_projects',this.Editdata)
        .then(resp=>{
          if(resp.data.status==200)
          {
            $('#EditModal').modal('hide');
          }
          this.aprojects = resp.data.userdata;
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
           
    $("#EditModal").modal('show');
      }
          }     
    }
</script>
