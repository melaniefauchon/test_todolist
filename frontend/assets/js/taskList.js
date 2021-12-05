const taskList = {
    init:function(){
        /*********************************
         * Managing the add task button 
         *********************************/
        const buttonAddTask = document.querySelector('#add__task');
        buttonAddTask.addEventListener('submit', taskList.handleNewTaskCreate);

        const allTaskElement = document.querySelectorAll('.tasks .task');
        for (const taskElement of allTaskElement){
            taskElement.init(taskElement);
        }
    },
    handleNewTaskCreate:function(event){
        const inputTitle = document.querySelector('#title');
        const inputDescription = document.querySelector('#description');
        const userSelectedId = document.querySelector('#select__user').value;
        
        const newTitle = inputTitle.value;
        const newDescriprion = inputDescription.value;

        const data = {
            title: newTitle,
            description: newDescriprion,
            creation_date: new Date(), 
            user_id: userSelectedId
        }

        const config = {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: JSON.stringify(data)
        };

        fetch(app.apiRootUrl + '/tasks', config)
        .then(function (response) {
            if (response.status === 201) {
                return response.json();
            } else {
                throw "L'ajout a échoué, veuillez retenter plus tard";
            }
        })
        .then(function (responseJson) {
            if (responseJson.message !== undefined) {
                alert(responseJson.message);
                return;
            }
            event.preventDefault();
        })

    }
}