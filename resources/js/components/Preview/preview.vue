<template>
  <div class="tab-pane fade" id="Preview" role="tabpanel" aria-labelledby="contact-tab">
<button @click="refresh()">Refresh</button>
<div id="doc2" class="yui-t7">
	<div id="inner">
	
		<div id="hd">
			<div class="yui-gc">
				<div class="yui-u first">
					<h1>{{ profile.name || 'xyz' }}</h1>
		
				</div>

				<div class="yui-u">
					<div class="contact-info">
						<!-- <h3><a id="pdf" href="#">Download PDF</a></h3> -->
            <h3>Father Name : {{ profile.father_name || 'abc' }}</h3>
						<h3><a>Email : {{ profile.email || 'name@yourdomain.com' }}</a></h3>
						<h3>Phone : {{ profile.phone || '0333232322' }}</h3>
					 	<h3>Cnic : {{ profile.cnic || '38232632632' }}</h3>
            <h3>DOB : {{ profile.dob || '3-3-2021' }}</h3>
             <h3>Address : {{ profile.address || 'Pakistan Lahore' }}</h3>
            
          </div><!--// .contact-info -->
				</div>
			</div><!--// .yui-gc -->
		</div><!--// hd -->

		<div id="bd">
			<div id="yui-main">
				<div class="yui-b">

					<div class="yui-gf">
						<div class="yui-u first">
							<h2>Projects</h2>
						</div>
						<div v-for="project in projects" :key="project.id" class="yui-u">
							<p class="enlarge">
             <span>{{ project.title || 'facebook' }}</span> <span>{{project.url || 'wwww.facebook.com' }}</span> 
							</p>
						</div>
            
					</div><!--// .yui-gf -->



					<div class="yui-gf">
	
						<div class="yui-u first">
							<h2>Experience</h2>
						</div><!--// .yui-u -->

						<div v-for="exp in experience" :key="exp.id" class="yui-u">

							<div class="job">
								<h2>{{ exp.organization_name || 'Abc' }}</h2>
								<h3>{{exp.title || 'Software Engineer' }}</h3>
								<h4>{{ exp.start_date }} : {{ exp.end_date || 'Present' }}</h4>
								<p> {{ exp.descrption }} </p>
							</div>

						</div><!--// .yui-u -->
					</div><!--// .yui-gf -->


					<div class="yui-gf last">
						<div class="yui-u first">
							<h2>Education</h2>
						</div>
						<div class="yui-u">
							<h2>Indiana University - Bloomington, Indiana</h2>
							<h3>Dual Major, Economics and English &mdash; <strong>4.0 GPA</strong> </h3>
						</div>
					</div><!--// .yui-gf -->


				</div><!--// .yui-b -->
			</div><!--// yui-main -->
		</div><!--// bd -->

		<div id="ft">
			<p>Jonathan Doe &mdash; <a href="mailto:name@yourdomain.com">name@yourdomain.com</a> &mdash; (313) - 867-5309</p>
		</div><!--// footer -->

	</div><!-- // inner -->


</div><!--// doc -->


  </div>
</template>

<script>
    export default {
     data()
     {
       return {
          profile:[],
          projects:[],
          educations:[],
          experience:[],
       }
     },
     created()
        {
            this.getCv();
             Reload.$on('LoadCv',()=>{
      this.getCv()
    });
        },
        methods:{
          getCv()
          {
  axios.get('/preview')
        .then(resp=>{
       this.profile = resp.data.personal;
       this.projects = resp.data.projects;
       this.experience = resp.data.experience;
       this.educations = resp.data.educations;
                    })
        .catch(error=>{
                       
                 })
          },
          refresh()
          {
              Reload.$emit('LoadCv');
          }
        }
    }
</script>
<style scoped>

.msg { padding: 10px; background: #222; position: relative; }
.msg h1 { color: #fff;  }
.msg a { margin-left: 20px; background: #408814; color: white; padding: 4px 8px; text-decoration: none; }
.msg a:hover { background: #266400; }

/* //-- yui-grids style overrides -- */
body { font-family: Georgia; color: #444; }
#inner { padding: 10px 80px; margin: 80px auto; background: #f5f5f5; border: solid #666; border-width: 8px 0 2px 0; }
.yui-gf { margin-bottom: 2em; padding-bottom: 2em; border-bottom: 1px solid #ccc; }

/* //-- header, body, footer -- */
#hd { margin: 2.5em 0 3em 0; padding-bottom: 1.5em; border-bottom: 1px solid #ccc }
#hd h2 { text-transform: uppercase; letter-spacing: 2px; }
#bd, #ft { margin-bottom: 2em; }

/* //-- footer -- */
#ft { padding: 1em 0 5em 0; font-size: 92%; border-top: 1px solid #ccc; text-align: center; }
#ft p { margin-bottom: 0; text-align: center;   }

/* //-- core typography and style -- */
#hd h1 { font-size: 48px; text-transform: uppercase; letter-spacing: 3px; }
h2 { font-size: 152% }
h3, h4 { font-size: 122%; }
h1, h2, h3, h4 { color: #333; }
p { font-size: 100%; line-height: 18px; padding-right: 3em; }
a { color: #990003 }
a:hover { text-decoration: none; }
strong { font-weight: bold; }
li { line-height: 24px; border-bottom: 1px solid #ccc; }
p.enlarge { font-size: 144%; padding-right: 6.5em; line-height: 24px; }
p.enlarge span { color: #000 }
.contact-info { margin-top: 7px; }
.first h2 { font-style: italic; }
.last { border-bottom: 0 }


/* //-- section styles -- */

a#pdf { display: block; float: left; background: #666; color: white; padding: 6px 50px 6px 12px; margin-bottom: 6px; text-decoration: none;  }
a#pdf:hover { background: #222; }

.job { position: relative; margin-bottom: 1em; padding-bottom: 1em; border-bottom: 1px solid #ccc; }
.job h4 { position: absolute; top: 0.35em; right: 0 }
.job p { margin: 0.75em 0 3em 0; }

.last { border: none; }

.skills-list ul { margin: 0; }
.skills-list li { margin: 3px 0; padding: 3px 0; }
.skills-list li span { font-size: 152%; display: block; margin-bottom: -2px; padding: 0 }
.talent { width: 32%; float: left }
.talent h2 { margin-bottom: 6px; }

#srt-ttab { margin-bottom: 100px; text-align: center;  }
#srt-ttab img.last { margin-top: 20px }

/* --// override to force 1/8th width grids -- */
.yui-gf .yui-u{width:80.2%;}
.yui-gf div.first{width:12.3%;}
</style>
