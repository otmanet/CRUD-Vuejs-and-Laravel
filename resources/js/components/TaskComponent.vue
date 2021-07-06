<template>
<div class="container">
<div class="container" v-if="open.createTask">
<form @submit.prevent="addTask"   method="Post">
  <div class="form-group">
    <label >Name </label>
    <input name="name" v-model="task.name" type="text" class="form-control"  placeholder="Enter name" >
  </div>
  <button v-if="open.buttonUpdate" @click.prevent="UpdateTask" class="btn btn-info">Update</button>
  <button v-else type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<button class="btn btn-info" style="margin-top:12px;margin-bottom:12px ;" @click.prevent="openCreateTask()"> Add Task</button>
<table class="table" >
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody v-for="task in tasks" v-bind:key="task">
    <tr>
      <td>{{task.id}}</td>
      <td>{{task.name}}</td>
      <td><button class="btn btn-danger" @click.prevent="deleteTask(task)">Delete</button></td>
      <td><button @click.prevent="EditTask(task)" class="btn btn-info">Edit</button></td>
    </tr>
  </tbody>
</table>
</div>

</template>

<script>
import axios from "axios"

    export default {

         data:function(){
             return {
              tasks:[],
              task:{
                id:"",
                name:"",
              },
              open: {
                 createTask:false,
                 buttonUpdate:false,
              },
             }

         },
        methods: {
        openCreateTask:function(){
            this.open.createTask=!this.open.createTask;
        },
         getTask: function(){
              axios.get("http://127.0.0.1:8000/getTask")
              .then((response)=>{
                  console.log(response.data);
                  this.tasks=response.data.tasks;
              }).catch(function(error){
                console.log(error);
              })
          },
          deleteTask:function(task){
            axios.delete("http://127.0.0.1:8000/delete/"+task.id)
          .then((response)=>{
             this.getTask();
             this.hasDeleted = false;
          }).catch(function(error){
            console.log(error);
          })
          },
          addTask:function(){
              axios.post("http://127.0.0.1:8000/postTask/",this.task)
              .then((response)=>{
                  if(response.data.etat){
                      this.open.createTask=!this.open.createTask;
                      alert('Task Adding');
                       this.getTask();
                       this.task.name='';
                  }
              }).catch(function(error){
                  console.log(error);
              })
          },
          EditTask:function(task){
            this.open.createTask=!this.open.createTask;
            this.open.buttonUpdate=true;
            this.task=task;
          },
          UpdateTask:function(){
            axios.put("http://127.0.0.1:8000/UpdateTask/",this.task)
            .then((response)=>{
                if(response.data.etat)
                {
                 this.open.createTask=!this.open.createTask;
                  alert('Task Updated');
                  this.getTask();
                  this.task.name='';
                }

            }).catch(function(error){
                console.log(error);
            });
          },
        },

        mounted() {
          this.getTask();
        }
    }
</script>
