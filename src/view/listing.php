<?php
require_once('./src/app/assets/html/create-modal.html');
require_once('./src/app/assets/html/edit-modal.html');
?>
<!DOCTYPE html>
    <head>
    <title>Bug tracker</title>
        <meta name="viewport" content="width=device-width initial-scale=1 shrink-to-fit =no">
        <link rel="stylesheet" href="./src/app/assets/css/style.css">
        <link rel="stylesheet" href="./src/app/assets/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bug Tracker</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link" href="#" id="create-bug"  data-toggle="modal" data-target="#createBugModal">Create a new bug</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <section>
            <table class="table"  id="bugs-list">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Project</th>
                    <th scope="col">Status</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Created By</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot id="bug-list-footer"></tfoot>
            </table>    
        </section>
        <footer>
            <script type="text/javascript" src="src/app/assets/js/jquery-3.5.1.min.js"></script>
            <script type="text/javascript" src="src/app/assets/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="src/app/assets/js/custom.js"></script>
            <script type="text/javascript" src="src/app/assets/js/cookies.js"></script>
        </footer>
    </body>
</html>