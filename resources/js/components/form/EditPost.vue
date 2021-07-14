<template>
    <div>
        <h3 class="text-center">Edit Car</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateForm" enctype="multipart/form-data">
                   <div class="form-group">
                       <div class="input-group mb-3">
  <div class="custom-file">
    <label class="custom-file-label" for="inputFileUpload">Choose file</label>
    <input type="file" name="file" ref="file" class="custom-file-input" id="inputFileUpload"
v-on:change="onFileChanges">
  </div>
  <div class="input-group-append">
    <span class="input-group-text" id="">Upload</span>
  </div>
</div>
                        
<img width="100" :src="upload + poster.file_path">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <select class="form-control" v-model="poster.category">
                            <option value="news">News</option>
                            <option value="redaction">Redaction</option>
                            <option value="postsa">Post</option>
                        </select>
                    </div>
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="poster.title">
                    </div>
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="poster.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                imaged: null,
                upload:"/upload/",
                poster: {}
            }
        },
        created() {
            this.axios
                .get(`/api/form/${this.$route.params.id}`)
                .then((res) => {
                    this.poster = res.data;
                });
        },
        methods: {
            onFileChanges(e) {
                   const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }
                this.imaged = e.target.files[0];
                // form data
                let formData = new FormData();
                formData.append('file', this.imaged);
                formData.append('id', `${this.$route.params.id}`);
                console.log(this.imaged);
                this.axios
                    .post(`/api/updateImage`, formData,config)
                    .then((res) => {
                        this.imaged = res.data;
                        //this.$router.push({ name: 'home' });
                    });
            },
            
            updateForm() {
               if(this.imaged == null){
               }else{
                this.poster.file_path = this.imaged;
               }
                axios
                    .patch(`/api/form/${this.$route.params.id}`, this.poster)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    });
            }
        }
    }
</script>