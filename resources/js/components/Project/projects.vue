<template>
   <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="profile-tab">
   <form class="p-3" @submit.prevent="create" enctype="multipart/form-data">
  <div v-for="(project,index) in projects" :key="index" class="form-group">
      <div  class="form-row">
      
          <div class="col-md-5">
          
          <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Project Title" v-model="form.title">
    
          </div>
          <div class="col-md-5">
          <label for="exampleInputEmail1">url</label>
    <input type="text" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Project Url" v-model="form.url">
 
          </div>
          <div class="col-md-2">
           
         
          <button v-if="projects.length>1"  @click="removerow(index)" class="btn btn-xs btn-success">Remove</button>
          </div>
      </div>
    
  </div>
 <button style="float: right;"  @click="Addrow()" class="btn btn-xs btn-success">Add</button><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   
   </div>
</template>

<script>
    export default {
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
                         ]
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
              }
          }     
    }
</script>
