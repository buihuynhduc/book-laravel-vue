<template>
    <div class="container_book">
        <button class="btn btn-primary" id="create_book">Add Book</button>
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
            <tr v-for="book in books">
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
                    <button class="btn btn-danger" v-on:click="dlbook(book.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "book",
    data() {
        return {
            books: []
        }
    },
    created() {
        this.axios.get(`http://127.0.0.1:8000/api/book`).then(response => {
            this.books = response.data
            console.log(this.books)
        })
    },
    methods: {
        dlbook: function (id) {
            this.axios.delete(`http://127.0.0.1:8000/api/book/` + id).then(response => {
                console.log(response);
            });
        }
    }
}
</script>

<style scoped>
.container_book {
    margin: 20px 20px;
}

#create_book {
    margin-bottom: 10px;
}
</style>
