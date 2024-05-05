<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        <button class="task-button">Add Task</button>

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
                                    <option value="Assigned">Assigned</option>
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
                form : {
                    title : '',
                    description : '',
                    status : 'Pending',
                    assignedTo : ''
                },
                users : [],
                columns: ['id','createdBy','title', 'description', 'status','assignedBy','assignedTo','action'],
                data: getData(),
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
            async getUsers(){
                const { data } = await axios.get("/api/user-list");
                this.users = data;
                if(data.length > 0) this.form.assignedTo = data[0].id;
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getUsers();
        }
    }


function getData(){
    return [{
        id: 1,
        createdBy : 'Joseph',
        title: 'Title',
        description: 'Description',
        status: 'Pending',
        assignedBy : 'Joseph',
        assignedTo : 'Joseph'
    }]
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
</style>
