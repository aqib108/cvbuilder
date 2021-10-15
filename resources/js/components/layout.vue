<template>
 <div class="tab-content" id="myTabContent">
  <Personal/>
  <Education/>
  <Experience/>
  <Projects/>

  <Preview/>

</div>
</template>

<script>
import Personal from './Personal/personal.vue'
import Education from './Eduction/eduction.vue'
import Experience from './Experience/experience.vue'
import Projects from './Project/projects.vue'
import Preview from './Preview/preview.vue'

    export default {
  components: { 
        Personal,
        Education,
        Experience,
        Projects,
        Preview
     
    }
    }
</script>
