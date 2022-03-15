<template>
    <div class="container_category">
        <CategoryEdit v-if="showedit" @closeedit="closeedit"></CategoryEdit>
        <div v-if="showedit==false" @closeedit="closeedit">
            <button id="addcategory" ref="addcategory" class="btn btn-primary" v-on:click="popupform"
                    style="margin-bottom: 10px">Add Category
            </button>
            <form style="display: none" id="form" ref="form" @submit.prevent="addcategory">
                <div class="form-row">
                    <div class="col-2">
                        <input type="text" class="form-control" placeholder="Category" v-model="category.name">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Create Category</button>
                <button type="button" class="btn btn-warning" style="margin-top: 10px" v-on:click="cancelform">Cancel
                </button>
            </form>
        </div>

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
            <tr v-for="(category,index) in categories">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.created_at }}</td>
                <td>{{ category.updated_at }}</td>
                <td>
                    <button class="btn btn-warning" @click="editcategory(category.id)">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger" v-on:click="dlcategory(category.id,index)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import CategoryEdit from "./CategoryEdit";
import EventBus from "../../EventBus";

export default {
    components: {
        CategoryEdit,
    },
    data() {
        return {
            categories: [],
            category: [],
            showedit: false,
        }
    },
    mounted() {
        this.axios.get('http://127.0.0.1:8000/api/category').then(response => {
            this.categories = response.data;
            console.log(this.categories);
        })
    },
    methods: {
        dlcategory(id, index) {
            this.axios.delete(`http://127.0.0.1:8000/api/category/` + id)
                .then(response => {
                    if (index > -1) {
                        this.categories.splice(index, 1); // 2nd parameter means remove one item only
                    }
                });
        },
        popupform() {
            this.$refs.form.style.display = 'block';
        },
        cancelform() {
            this.$refs.form.style.display = 'none';
            this.category.name = ''
        },
        addcategory() {
            var data = {
                name: this.category.name
            }
            this.axios.post(`http://127.0.0.1:8000/api/category`, data).then(response => {
                this.categories.push(response.data)
                this.cancelform()
            });


        },
        editcategory(id) {
            this.showedit = true;
            EventBus.$emit('editcate',id)
        },
        closeedit() {

            this.showedit = false;
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
