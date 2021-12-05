const task = {
    init: function (taskElement) {
        /**********************************
         * Managing the delete task button
         **********************************/
        const buttonDeleteTask = taskElement.querySelector('.task__delete');
        buttonDeleteTask.addEventListener('click', task.handleDeleteTask);
    },
    handleDeleteTask: function (event) {
        const buttonDelete = event.currentTarget;

        const parentElement = buttonDelete.closest('.tasks .task');
        let idTask = parentElement.dataset.id;

        const httpHeaders = new Headers();
        httpHeaders.append("Content-Type", "application/json");

        const config = {
            method: 'DELETE',
            mode: 'cors',
            cache: 'no-cache',
            headers: httpHeaders,
        };

        fetch(app.apiRootUrl + '/tasks/' + idTask, config)
            .then(function (response) {
                if (response.status == 204) {
                    console.log('Tâche supprimée');
                } else {
                    console.log('La suppression a échoué');
                }
            })
    }
}