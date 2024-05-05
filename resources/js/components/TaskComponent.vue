<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        <button v-if="!submitting" class="task-button" @click="createTask">Add Task</button>
                        <button v-if="submitting" class="task-button">Creating Task...</button>

                        <button v-if="updating" class="task-button" @click="updateTask">Update Task</button>

                        <p v-if="errors.length">
                            <ul class="errors">
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </p>

                        <form>
                            <div class="form-group">
                                <label for="titleinput">Title</label>
                                <input v-model="form.title" type="text" class="form-control" id="titleinput" placeholder="Task Title">
                            </div>
                            <div class="form-group">
                                <label for="descriptioninput">Description</label>
                                <textarea v-model="form.description" type="text" class="form-control" id="descriptioninput" placeholder="Task Description"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="statusinput">Status</label>
                                <select v-model="form.status" class="form-control" id="statusinput">
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assigninput">Assign To</label>
                                <select v-model="form.assignedTo" class="form-control" id="assigninput">
                                    <option v-for="user in users" :value="user.id">{{user.name}}</option>
                                </select>
                            </div>
                        </form>
                        <v-client-table 
                            :columns="columns" 
                            v-model="data" 
                            :options="options">
                            <div slot="action" slot-scope="props">
                                <button  class="btn btn-primary btn-sm">Edit</button>
                                <button  class="btn btn-danger btn-sm">Delete</button>
                            </div>
                            
                        </v-client-table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                submitting : 0,
                updating : 0,
                form : {
                    createdBy : '',
                    title : '',
                    description : '',
                    status : 'Pending',
                    assignedTo : '',
                    assignedBy : ''
                },
                errors : [],
                users : [],
                columns: ['id','createdBy','title', 'description', 'status','assignedBy','assignedTo','action'],
                data: [],
                options: {
                    headings: {
                            id : 'Task ID',
                            createdby: 'Created By',
                            title: 'Title',
                            description: 'Description',
                            status: 'Status',
                            assignedBy : 'Assigned By',
                            assignedTo : 'Assigned To',
                            action : 'Action'
                    },
                    editableColumns:['title','description'],
                    sortable: ['id','createdBy','title', 'description', 'status','assignedBy','assignedTo'],
                    filterable:['id','createdBy','title', 'description', 'status','assignedBy','assignedTo'],
                    perPage : 5,
                    perPageValues : []
                }
                    
            }
        },
        methods : {
            checkForm(e){
                this.errors = [];

                if (!this.form.title) {
                    this.errors.push("Title required.");
                }

                if (!this.errors.length) {
                    return true;
                }

                e.preventDefault();
            },

            async createTask(){
                
                if(this.checkForm()){
                    this.submitting = 1;
                    const { data } = await axios.post("/api/tasks/create",this.form);
                    this.data = data;
                    this.errors = [];
                    this.submitting = 0;
                }
            },

            async getTasks(){
                const { data } = await axios.get("/api/tasks/show");
                this.data = data;
            },
            
            async getUsers(){
                const { data } = await axios.get("/api/user-list");
                this.users = data;
                if(data.length > 0) this.form.assignedTo = data[0].id;
            },
            async getCurrentUser(){
                const { data } = await axios.get("/api/get-current-user");
                if(data){
                    this.form.assignedBy = data.id;
                    this.form.createdBy = data.id;
                } 
            },
        },
        mounted() {
            this.getUsers();
            this.getCurrentUser();
            this.getTasks();
        }
    }

</script>


<style>

#app {
  width: 95%;
  margin: 0 auto;
}

.VuePagination {
  text-align: center;
}

.vue-title {
  text-align: center;
  margin-bottom: 10px;
}

.vue-pagination-ad {
  text-align: center;
}

.glyphicon.glyphicon-eye-open {
  width: 16px;
  display: block;
  margin: 0 auto;
}

th:nth-child(3) {
  text-align: center;
}

.VueTables__child-row-toggler {
  width: 16px;
  height: 16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
  content: "+";
}

.VueTables__child-row-toggler--open::before {
  content: "-";
}

[v-cloak] {
  display:none;
}

.task-button {
    display: block;
    width: 10%;
    margin: 5px;
}

.errors {
    list-style-type: none;
}

.errors li {
    color : red;
}
</style>
