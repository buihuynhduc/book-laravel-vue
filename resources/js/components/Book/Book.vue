<template>
    <div class="container_book">
        <button class="btn btn-primary" id="create_book" style="margin-bottom: 10px" v-on:click="openaddform">Add Book
        </button>
        <form id="form" ref="form" style="margin-bottom: 10px;display: none" @submit.prevent="addbook">
            <input type="text" class="form-control" placeholder="bookname" style="margin-bottom: 10px"
                   v-model="book.bookname">
            <div class="form-col" style="margin-bottom: 10px">
                <label>Select Category</label>
                <select class="form-control" v-model="book.category_name">
                    <option v-for="category in categories">{{ category.name }}</option>
                </select>
            </div>
            <input type="text" class="form-control" placeholder="description" style="margin-bottom: 10px"
                   v-model="book.description">
            <button type="submit" class="btn btn-primary">Create Book</button>
            <button type="button" class="btn btn-warning" v-on:click="closeform">Cancel</button>
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name Book</th>
                <th scope="col">Category</th>
                <th scope="col">Description</th>
                <th scope="col">Create</th>
                <th scope="col">Update</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(book,index) in books">
                <td>{{ book.id }}</td>
                <td>{{ book.bookname }}</td>
                <td>{{ book.category_id }}</td>
                <td>{{ book.description }}</td>
                <td>{{ book.created_at }}</td>
                <td>{{ book.updated_at }}</td>
                <td>
                    <button class="btn btn-warning">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="dlbook(book.id,index)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import BookEdit from "./BookEdit";

export default {
    name: "book",
    components: {
        BookEdit,
    },
    data() {
        return {
            books: [],
            categories: [],
            book: []
        }
    },
    created() {
        this.axios.get(`http://127.0.0.1:8000/api/book`).then(response => {
            this.books = response.data
            console.log(this.books)
        });
        this.axios.get('http://127.0.0.1:8000/api/category').then(response => {
            this.categories = response.data;
            console.log(this.categories);
        });
    },
    methods: {
        dlbook: function (id, index) {
            this.axios.delete(`http://127.0.0.1:8000/api/book/` + id).then(response => {
                if (index > -1) {
                    this.books.splice(index, 1); // 2nd parameter means remove one item only
                }
            });
        },
        openaddform() {

            this.$refs.form.style.display = 'block';
        },
        closeform() {
            this.$refs.form.style.display = 'none';
        },
        addbook() {
            for (const category of this.categories) {
                if (category.name == this.book.category_name) {
                    this.book.category_id = category.id;
                }
            }
            var data = {
                bookname: this.book.bookname,
                description: this.book.description,
                category_id: this.book.category_id,
            }
            this.axios.post(`http://127.0.0.1:8000/api/book`, data).then(response => {
                this.books.push(response.data)
                this.book = {}
                this.closeform()
            })


        }
    }
}
</script>

<style scoped>
.container_book {
    margin: 20px 20px;
}

#create_book {

}
</style>
