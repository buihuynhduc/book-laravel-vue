<template>
    <div class="container_category">
        <button class="btn btn-primary" v-on:click="popupform" style="margin-bottom: 10px">Add Category</button>
        <form style="display: none" id="form" ref="form" @submit.prevent="addcategory">
            <div class="form-row">
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Category" v-model="categories.name">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 10px">Create Category</button>
            <button style="margin-top: 10px" class="btn btn-warning" v-on:click="cancelform">Cancel</button>
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Create</th>
                <th scope="col">Update</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in categories">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.created_at }}</td>
                <td>{{ category.updated_at }}</td>
                <td>
                    <button class="btn btn-warning">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="dlcategory(category.id)">Delete</button>
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
            categories: []
        }
    },
    mounted() {
        this.axios.get('http://127.0.0.1:8000/api/category').then(response => {
            this.categories = response.data;
            console.log(this.categories);
        })
    },
    methods: {
        dlcategory(id) {
            this.axios.delete(`http://127.0.0.1:8000/api/category/` + id)
                .then(response => {
                    console.log(response)
                });
        },
        popupform() {
            this.$refs.form.style.display = 'block';
        },
        cancelform() {
            this.$refs.form.style.display = 'none';
        },
        addcategory() {
            var data = {
                name: this.categories.name
            }
            this.axios.post(`http://127.0.0.1:8000/api/category`, data).then(response => {
                console.log(response);
            })
        }
    }

}
</script>
<style scoped>
.container_category {
    margin: 20px 20px;
}

#create_category {
    margin-bottom: 10px;
}

#form {
    margin-bottom: 10px;
}
</style>
