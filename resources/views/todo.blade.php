<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prova Técnica V360</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            #main-section{
                max-width: 300px;
            }

            #todo-header{
                margin-left: auto;
                margin-right: 50;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand m-2" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class= "m-5">
            <section id="main-section" class="d-flex flex-column">
                Todo
                <div id="todo-header" class= "mb-3">
                    <button class="btn btn-primary mr-5">+</button>
                </div>
                <div>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quod tenetur quidem minima cumque officiis dolores veritatis culpa, totam aliquam voluptates, fuga impedit earum officia. Quas odit assumenda iste consequatur laboriosam!
                </div>
            </section>
            
        </main>
        
    </body>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        
    </script>
</html>
