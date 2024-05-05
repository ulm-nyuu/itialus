<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">
                        <button class="task-button">Add Task</button>
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
        mounted() {
            console.log('Component mounted.')
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
