document.addEventListener('DOMContentLoaded', () => {
    loadTasks();
  });
  
  function addTask() {
    const taskInput = document.getElementById('taskInput');
    const taskText = taskInput.value.trim();
  
    if (taskText !== '') {
      const task = {
        id: new Date().getTime(),
        text: taskText,
        completed: false,
      };
  
      saveTask(task);
      taskInput.value = '';
      loadTasks();
    }
  }
  
  function saveTask(task) {
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.push(task);
    localStorage.setItem('tasks', JSON.stringify(tasks));
  }
  
  function loadTasks() {
    const taskList = document.getElementById('taskList');
    taskList.innerHTML = '';
  
    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
  
    tasks.forEach((task) => {
      const listItem = document.createElement('li');
      listItem.innerHTML = `
        <span class="task-text ${task.completed ? 'completed' : ''}">${task.text}</span>
        <button onclick="toggleTask(${task.id})">&#10004;</button>
        <button onclick="deleteTask(${task.id})" class="delete-button">&#10008;</button>
      `;
  
      listItem.classList.add('task');
      if (task.completed) {
        listItem.classList.add('completed');
      }
  
      taskList.appendChild(listItem);
    });
  }
  
  function toggleTask(id) {
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    const index = tasks.findIndex((task) => task.id === id);
  
    if (index !== -1) {
      tasks[index].completed = !tasks[index].completed;
      localStorage.setItem('tasks', JSON.stringify(tasks));
      loadTasks();
    }
  }
  
  function deleteTask(id) {
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    const updatedTasks = tasks.filter((task) => task.id !== id);
    localStorage.setItem('tasks', JSON.stringify(updatedTasks));
    loadTasks();
  }
  