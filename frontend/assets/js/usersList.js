const usersList = {
    init: function () {
        /***************************
         * User display management
         ***************************/
        usersList.loadUsersFromAPI();

        /*******************************
         * Managing the add user button
         *******************************/
        const buttonAddUser = document.querySelector('#add__user');
        buttonAddUser.addEventListener('submit', usersList.handleNewUserCreate);

        /*******************************
         * Managing the select user 
         *******************************/
        const selectUser = document.querySelector('#select__user');
        selectUser.addEventListener('change', usersList.handleDisplayUserInfos);

        /***********************************
         * Managing the delete user button
         ***********************************/
        const buttonDeleteUser = document.querySelector('#delete__user');
        buttonDeleteUser.addEventListener('click', usersList.handleDeleteUser);
    },
    loadUsersFromAPI: function () {
        const httpHeaders = new Headers();
        httpHeaders.append("Content-Type", "application/json");

        const config = {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
        };
        fetch(app.apiRootUrl + '/users', config)
            .then(function (response) {
                return response.json();
            })
            .then(function (usersFromAPI) {
                const selectElement = document.querySelector('#select__user');
                for (const user of usersFromAPI) {
                    const newOptionElement = document.createElement('option');
                    newOptionElement.textContent = user.id + ' - ' + user.name + ' - ' + user.email;
                    newOptionElement.value = user.id;
                    selectElement.appendChild(newOptionElement);
                }

                const defaultOption = document.createElement('option');
                defaultOption.textContent = "Selectionnez un utilisateur";
                defaultOption.value = 0;
                defaultOption.setAttribute('selected', '');
                selectElement.appendChild(defaultOption);
            })
    },
    handleNewUserCreate: function (event) {

        const inputUsername = document.querySelector('#username');
        const inputEmail = document.querySelector('#email');

        const newUsername = inputUsername.value;
        const newEmail = inputEmail.value;

        const data = {
            name: newUsername,
            email: newEmail
        };

        const config = {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: JSON.stringify(data)
        };

        fetch(app.apiRootUrl + '/users', config)
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
    },
    handleDisplayUserInfos: function (event) {
        const displayUsername = document.querySelector('.user__connected');
        const usernameId = event.target.value;

        const config = {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
        };
        fetch(app.apiRootUrl + '/users/' + usernameId, config)
            .then(function (response) {
                return response.json();
            })
            .then(function (userInfosFromAPI) {
                displayUsername.textContent = userInfosFromAPI[0].name;

                for (const user of userInfosFromAPI) {
                    if (user.title !== null) {
                        const taskTemplate = document.querySelector('#task-template');
                        const documentFragment = taskTemplate.content.cloneNode(true);

                        const title = documentFragment.querySelector('.task__title');
                        title.textContent = user.title;

                        const description = documentFragment.querySelector('.task__description');
                        description.textContent = user.description;

                        const creationDate = documentFragment.querySelector('.task__creation-date');
                        creationDate.textContent = user.creation_date;

                        const status = documentFragment.querySelector('.task__status-status');
                        status.textContent = user.status;

                        const divTask = documentFragment.querySelector('.task');
                        divTask.dataset.id = user.task_id;
                        const tasks = document.querySelector('.tasks')
                        tasks.appendChild(divTask);
                        task.init(divTask);
                    }
                }
            })
    },
    handleDeleteUser: function (event) {
        const userSelectedId = document.querySelector('#select__user').value;
        console.log(userSelectedId);

        const httpHeaders = new Headers();
        httpHeaders.append("Content-Type", "application/json");

        const config = {
            method: 'DELETE',
            mode: 'no-cors',
            // cache: 'no-cache',
            headers: httpHeaders,
        };

        fetch(app.apiRootUrl + '/users/' + userSelectedId, config)
            .then(function (response) {
                console.log(response)
                return response.json();
            })
            .then(function (responseJson){
                console.log(responseJson);
            })


    }
}