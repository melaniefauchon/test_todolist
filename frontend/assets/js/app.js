const app = {
    apiRootUrl : 'http://localhost:8001',

    init: function(){
        console.log("Welcome !");
        usersList.init();
    }
}

document.addEventListener("DOMContentLoaded", app.init);