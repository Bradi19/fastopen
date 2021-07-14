<template>
    <div>
        <h3 class="text-center">Create Post</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addForm" >
                    <div class="form-group">
                        <div class="input-group mb-3">
  <div class="custom-file">
         <input type="file" name="filename" class="custom-file-input" id="inputFileUpload"
v-on:change="onFileChange">
    <label class="custom-file-label" for="inputFileUpload">Choose file</label>
  </div>
  <div class="input-group-append">
    <span class="input-group-text" id="">Upload</span>
  </div>
</div>
                        <label>File</label>
                     
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <select class="form-control" v-model="post.category">
                            <option value="news">News</option>
                            <option value="redaction">Redaction</option>
                            <option value="postsa">Post</option>
                        </select>
                    </div>
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="post.title">
                    </div>
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" v-model="post.description">
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                image: '',
                post: {}
            }
        },
        methods: {
            onFileChange(e) {
                this.image = e.target.files[0];
          
            },
            addForm() {
                this.post.file = this.image;
                   const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }

                // form data
                let formData = new FormData();
                formData.append('file', this.image);
                formData.append('category', this.post.category);
                formData.append('title', this.post.title);
                formData.append('description', this.post.description);

                axios
                    .post('/api/form', formData,config)
                    .then(response => (
                        this.$router.push({ name: 'home' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>