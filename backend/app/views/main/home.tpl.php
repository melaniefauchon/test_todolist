    <main class="container mt-4">
        <h2>Bienvenue sur la documentation de l'API</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A sapiente animi vero reprehenderit deleniti dolore laboriosam ducimus nihil velit nisi, reiciendis sed libero suscipit odit numquam corporis explicabo. Facere incidunt laudantium ut temporibus blanditiis vel dolores quibusdam facilis officia magnam! Culpa a in aspernatur doloribus quas placeat, corporis sapiente neque dolores exercitationem vitae possimus esse laboriosam error quaerat voluptate. Cumque esse labore asperiores praesentium nulla excepturi ipsum.</p>

        <div class="accordion" id="documentation">
            <div class="accordion-item">
                <h2 class="accordion-header" id="user">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        User
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="user" data-bs-parent="#documentation">
                    <div class="accordion-body">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Methode</th>
                                    <th scope="col">Route</th>
                                    <th scope="col">Descriptiong</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-info">GET</th>
                                    <td>/api/users</td>
                                    <td>Retourne la liste de tous les Users</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-info">GET</th>
                                    <td>/api/users/{userId}</td>
                                    <td>Retourne la liste d'un User selon son id</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-warning">POST</th>
                                    <td>/api/users</td>
                                    <td>Permet la création d'un User</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-warning">POST</th>
                                    <td>/api/users/{userId}</td>
                                    <td>Permet la création d'une Task selon le User séléctionné</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-center text-white bg-danger">DELETE</th>
                                    <td>/api/users/{userId}</td>
                                    <td>Permet la suppression d'un User selon son id</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="task">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Task
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="task" data-bs-parent="#documentation">
                    <div class="accordion-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Methode</th>
                                    <th scope="col">Route</th>
                                    <th scope="col">Descriptiong</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-info">GET</th>
                                    <td>/api/tasks</td>
                                    <td>Retourne la liste de toutes les Tasks</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-info">GET</th>
                                    <td>/api/tasks/{taskId}</td>
                                    <td>Retourne la liste d'une Task selon son id</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-warning">POST</th>
                                    <td>/api/tasks</td>
                                    <td>Permet la création d'une Task</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-center text-white bg-danger">DELETE</th>
                                    <td>/api/tasks/{taskId}</td>
                                    <td>Permet la suppression d'une Task selon son id</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
