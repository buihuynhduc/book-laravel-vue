import Vue from "vue";
import VueRouter from 'vue-router';
import Book from "../components/Book/Book";
import BookEdit from "../components/Book/BookEdit";
import Category from "../components/Category/Category";
import CategoryEdit from "../components/Category/CategoryEdit";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'book',
            component: Book,
        },
        {
          path: '/category',
            name: 'category',
            component: Category
        }
    ]
})

export default router;
