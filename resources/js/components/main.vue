
<template>
  <div>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="home" aria-selected="true">Personal Info</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="profile" aria-selected="false">Projects</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#education" role="tab" aria-controls="contact" aria-selected="false">Education</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#experience" role="tab" aria-controls="contact" aria-selected="false">Experience</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#Preview" role="tab" aria-controls="contact" aria-selected="false">Preview</a>
  </li>
</ul>
<layout/>
  </div>
</template>

<script>
import layout from './layout.vue'
export default {
       components:{
           layout
       }
    }
</script>
