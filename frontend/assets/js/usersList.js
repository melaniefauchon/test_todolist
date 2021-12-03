const usersList = {
    init: function () {
        usersList.loadUsersFromAPI();
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
    }
}