<template>
    <div class="container_category">
        <button class="btn btn-primary" v-on:click="popupform" style="margin-bottom: 10px">Add Category</button>
        <form style="display: none" id="form" ref="form">
            <div class="form-row">
                <div class="col-2">
                    <input type="text" class="form-control" placeholder="Category">
                </div>
                <div class="col-1">
                    <button class="btn btn-primary" >Create Category</button>
                </div>
                <div class="col-1">
                    <button class="btn btn-warning" v-on:click="cancelform" >Cancel</button>
                </div>

            </div>
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
    created() {
        this.axios.get('http://127.0.0.1:8000/api/category').then(response => {
            this.categories = response.data;
            console.log(this.categories);
        })
    },
    methods: {
        dlcategory(id) {
            axios.delete(`http://127.0.0.1:8000/api/category/` + id)
                .then(response => {
                    console.log(response)
                });
            this.$forceUpdate();
        },
        popupform() {
            this.$refs.form.style.display = 'block';
        },
        cancelform()
        {
            this.$refs.form.style.display = 'none';
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
