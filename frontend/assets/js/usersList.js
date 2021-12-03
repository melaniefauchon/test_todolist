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

        const inputUsername=document.querySelector('#username');
        const inputEmail = document.querySelector('#email');

        const newUsername = inputUsername.value;
        const newEmail = inputEmail.value;

        const data = {
            name: newUsername,
            email: newEmail
        };

        const config = {
            method:'POST',
            mode:'cors',
            cache:'no-cache',
            body: JSON.stringify(data)
        };

        fetch(app.apiRootUrl + '/users', config)
            .then(function(response) {
                if(response.status ===201){
                    return response.json();
                } else {
                    throw "L'ajout a échoué, veuillez retenter plus tard";
                }
            })
            .then(function(responseJson){
                if(responseJson.message !== undefined){
                    alert(responseJson.message);
                    return;
                }
                event.preventDefault();
            })

    }
}