<template>
  <div v-if="loading">
    <ProgressSpinner/>
  </div>
  <div v-else>
    <div class="cards">
        <!-- Card -->
        <div class="flex p-4 rounded-lg shadow-xs">
          <div class="p-3  mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-700 dark:bg-orange-700">
            <i class="fas fa-users" style="font-size: 50px"></i>
          </div>
          <div class="cardText">
            <p>Total admins</p>
            <p>{{ admins?.length }}</p>
          </div>
        </div>
        <!-- Card -->
        <div class="flex p-4 rounded-lg shadow-xs">
          <div class="p-3  mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
            <i class="fas fa-graduation-cap" style="font-size: 50px"></i>
          </div>
          <div class="cardText">
            <p>Total masters</p>
            <p>{{ masters?.length }}</p>
          </div>
        </div>
        <!-- Card -->
        <div class="flex p-4 rounded-lg shadow-xs">
          <div class="p-3  mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
            <i class="fas fa-user-plus" style="font-size: 50px"></i>
          </div>
          <div class="cardText">
            <p>Total candidacies</p>
            <p>{{ candidacies }}</p>
          </div>
        </div>
        <!-- Card -->
        <div class="flex p-4 rounded-lg shadow-xs">
          <div class="p-3  mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
            <i class="fas fa-tasks" style="font-size: 50px"></i>
          </div>
          <div class="cardText">
            <p>Total tasks</p>
            <p>{{ tasks.filter(task => !task.completed)?.length }}</p>
          </div>
        </div>
    </div>
    <div class="firstChart">
      <div>
        <h4>Classification of admins</h4>
        <Chart type="pie" :data="chartData" :options="lightOptions" class="w-12"/>
      </div>
      <div>
        <h4>Masters Candidacies</h4>
        <Chart type="bar" :data="chartData2" class="w-30rem h-500"/>
      </div>
    </div>
    <div class="firstChart">
      <div>
        <h4>Calender</h4>
        <Calendar :inline="true" :showWeek="true" class="w-12"/>
      </div> 
      <div>
        <div class="TaskContainer">
          <div class="taskHeader">
            <h2 id="title">To-Do List</h2>
            <div class='addTask'>
              <input type='text' v-model="name">
              <i class="fas fa-plus-square" :class="[ name ? 'active' : 'inactive', 'plus' ]" @click="addTask()"></i>
            </div>
          </div>
          <div>
            <div v-for="(task, index) in tasks" :key="index">
              <div class="task">
                <input type="checkbox" @change="updateCheck(task.id)" v-model="task.completed"/>
                <span :class="[task.completed ? 'completed' : '', 'taskText' ]">{{ task.name }}</span>
                <i class="fas fa-trash trashcan" @click="removeTask(task.id)"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data(){
    return {
      loading: true,
      admins: null,
      masters: null,
      candidacy: null,
      tasks: null,
      nbOfSuperAdmin: 0,
      nbOfAdmin: 0,
      chartData: {
        labels: ['SUPER ADMIN','ADMIN'],
        datasets: [
          {
            data: [],
            backgroundColor: ["#FFA726", "#42A5F5","#66BB6A"],
            hoverBackgroundColor: ["#FFB74D", "#64B5F6","#81C784"],
          }
        ]
      },
      lightOptions: {
        plugins: {
          legend: {
            labels: {
              color: '#495057'
            }
          }
        }
      },
      chartData2: {
        labels: [""],
        datasets: [
          {
            data: [0],
            backgroundColor: ["#78909C", "#66BB6A", "#EC407A","#7E57C2", "#FFA726", "#42A5F5"],
            label: "First Year Master Candidacy"
          }
        ]
      },
      name: ''
    }
  },
  mounted() {
    if(localStorage.getItem("auth")){

          axios.get('/api/dashboard')
		        .then((res) => {
              this.loading = false
              this.admins = res.data.admins
              this.masters = res.data.masters
              this.candidacies = res.data.candidacies
              this.tasks = res.data.tasks
              this.admins.map(admin => admin.roles[0].name === 'SUPER ADMIN' ? this.nbOfSuperAdmin = this.nbOfSuperAdmin + 1 : this.nbOfAdmin = this.nbOfAdmin + 1)
              this.chartData.datasets[0].data.push(this.nbOfSuperAdmin)
              this.chartData.datasets[0].data.push(this.nbOfAdmin)
              this.masters.map(master => {
                this.chartData2.labels.push(master.title)
                this.chartData2.datasets[0].data.push(master.candidacies)
              })
            })
		        .catch((err) => console.log('Fetch Data Error: ',err))
        }else{
            this.loading = false
            this.$router.push('/login')
        }
  },
  methods: {
    addTask() {
      axios.post('api/task', {name: this.name}).then( res => {
        this.tasks.push(res.data.task)
        this.name = ''
      })
    },
    updateCheck(id) {
      axios.put('/api/task/' + id, {completed: true}).then( res => console.log("task updated succesfully"))
    },
    removeTask(id) {
      axios.delete('/api/task/' + id).then( res => this.tasks = this.tasks.filter(task =>  task.id !== id))
    }
  },
}
</script>

<style scoped>
.cards{
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}
.cardText{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.cardText p:nth-child(1){
  font-size: 16px;
}
.cardText p:nth-child(2){
  font-weight: bold;
}

.firstChart{
  margin-top: 10rem;
  display: flex;
  align-items: flex-start;
  justify-content: space-around;
}

.taskContainer{
    margin: auto;
}
.taskHeader{
  width: 450px;
  background: #e6e6e6;
  padding: 10px;
}
#title{
    text-align: center;
}

.addTask{
    display: flex;
    justify-content: center;
    align-items: center;
}
input{
    background: #f7f7f7;
    border: none;
    outline: 0px;
    padding: 5px;
    margin-right: 10px;
    width: 200px;
}
.plus{
    font-size: 20px;
}
.active{
    color: #00CE25;
    cursor: pointer;
}
.inactive{
    color: #999;
}
.completed{
    text-decoration: line-through;
    color: #999;
}
.taskText{
    width: 100%;
    margin-left: 20px;
}
.task{
    display: flex;
    justify-content: center;
    align-items: center;
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
.trashcan{
    color: #FF0000;
    cursor: pointer;
}
</style>