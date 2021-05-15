<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
                integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
        <script src="js/scripts.js" ;></script>
        <meta charset="UTF-8">
        <title>NoDemi</title>

        <style>
            .catContainer{
                width: 45vw;
                height: 12rem;
                min-width: 400px;
                background-color: #e1cce5;
                border-radius: 10px;
                overflow-y: auto;
                padding: 0.5rem;
                user-select: none;
            }

            .catItem{
                background-color: #351a5e;
                color: azure;
                width: fit-content;
                display: inline-block;
                padding: 3px 10px 3px 10px;
                margin: 0 0 5px 0;
                cursor: pointer;
                border-radius: 15px;
                user-select: none;
            }

            .catText{
                width: 45vw;
                height: 2.5rem;
                min-width: 400px;
                background-color: #f2ecf5;
                border-radius: 10px;
                user-select: none;
                padding: 5px 10px 10px 10px;
            }
            .catBTN{
                width: 100%;
                height: 100%;
                background-color: #8c76bb;
                color: azure;
            }
            
            .emptyMessage{
                user-select: none;
                font-size: larger;
                margin: 20px;
            }
            .catID{
                visibility: hidden;
                height: 0;
            }
            
            .catContEx{
                width: 45vw;
                min-width: 400px;
                padding: 0.5rem;
                user-select: none;
            }
            .catItemEx{
                background-color: #f0eff2;
                font-size: small;
                width: fit-content;
                display: inline-block;
                padding: 1.5px 10px 3px 10px;
                margin-bottom: -15px;
                border-radius: 15px;
                user-select: none;
                
            }
            .textCat{
                display: inline-block;
                margin-left: 5px;
            }
            .catQuitar{
                display: inline-block;
                font-size: medium;
                color: #cbc9d1;
                cursor: pointer;
            }
            .catQuitar:hover{
                color: #817d89;
            }
            
        </style>
        <script>

            $(document).ready(function () {

                $('.catContainer').on("click", ".catItem", function () {
                    $('.catText').text($(this).text());
                });

            });

        </script>
    </head>
    <body>
        <?php
        // put your code here
        ?>

        <div class="container">
            <div class="row">
                <div>
                    <h3>Categorías del curso</h3>
                    
                    <div class="catContEx">
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                        <div class="catItemEx">
                            <div class="catQuitar">&times;</div>
                            <div class="textCat">Categoría #1</div>
                            <div class="catID">1</div>
                        </div>
                    </div>
                    
                    <div class="catText">
                        <span class="text-muted">Selecciona una categoría para agregar</span>
                    </div>
                    <div class="catContainer sb my-2">
                        <div class="emptyMessage text-muted">Parece que no existe ninguna categoría</div>
                        <div class="catItem">Categoría #1
                            <div class="catID">1</div>
                        </div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>

                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>

                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1</div>

                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>

                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>

                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1</div>
                        <div class="catItem">Categoría #1Categoría #1</div>
                        <div class="catItem">Categoría #1
                            <div class="catID">1</div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" id="">Añadir esta categoría</button>
                    <button class="btn btn-link" type="button" id=""  data-toggle="modal" data-target="#newCatModal">
                        La categoría que busco no se encuentra en la lista
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="newCatModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="newCatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newCatModalLabel">Agregar una categoría nueva</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="crearCurso.php" method="post" enctype='multipart/form-data'>
                        <div class="modal-body">
                            <label for="nombreCat">Nombre de la categoría</label>
                            <input type="text" class="form-control campoConfig" id="nombreCat" name="nombreCat" placeholder="Nombre conciso" maxlength="50">

                            <label for="descCat">Descripción</label>
                            <input type="text" class="form-control campoConfig" id="descCat" name="descCat" placeholder="En qué consiste esta categoría" maxlength="255">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="addCat" value="addCat">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
