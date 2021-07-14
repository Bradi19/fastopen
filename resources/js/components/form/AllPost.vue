<template>
    <div>
        <h2 class="text-center">Posts List</h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>File Path</th>
                <th>Category</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td><img width="100" class="img-thumbnail rounded" :src="upload + post.file_path"  alt=""></td>
                <td>{{ post.category }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.description }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                upload:"upload/",
                posts: []
            }
        },
        created() {
            this.axios
                .get('/api/form/')
                .then(response => {
                    this.posts = response.data;
                });
        },
        methods: {
            deletePost(id) { 
                this.axios
                    .delete(`/api/form/${id}`)
                    .then(response => {
                        let i = this.posts.map(data => data.id).indexOf(id);
                        this.posts.splice(i, 1)
                    });
            }
        }
    }
</script>