import AllPosts from './components/form/AllPost.vue';
import CreatePost from './components/form/CreatePost.vue';
import EditPost from './components/form/EditPost.vue';
export const routes = [{
        name: 'home',
        path: '/',
        component: AllPosts
    },
    {
        name: 'create',
        path: '/create',
        component: CreatePost
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPost
    }
];