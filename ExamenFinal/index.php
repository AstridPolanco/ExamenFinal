-<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Examen Final</title> 
</head>
<body>
    <?php
    $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
    $conexion = new PDO('mysql:host=localhost;dbname=Final_0907-23-5304', 'root', '', $pdo_options);

    if (isset($_POST["accion"])){
        if ($_POST["accion"] == "Crear"){
            $insert = $conexion->prepare("INSERT INTO Alumno (Carnet,Nombre,Grado,Telefono) VALUES 
            (:Carnet,:Nombre,:Grado,:Telefono)");
            $insert->bindvalue('Carnet', $_POST['Carnet']);
            $insert->bindvalue('Nombre', $_POST['Nombre']);
            $insert->bindvalue('Grado', $_POST['Grado']);
            $insert->bindvalue('Telefono', $_POST['Telefono']);
            $insert->execute();
        }
    }
    $select = $conexion->query("SELECT Carnet, Nombre, Grado, Telefono FROM Alumno");

?><form method="POST" class="crear">
<input type="text" name="Carnet" placeholder="Ingresa el carnet"/>
<input type="text" name="Nombre" placeholder="Ingresa el nombre"/>
<input type="text" name="Grado" placeholder="Ingresa el grado"/>
<input type="text" name="Telefono" placeholder="Ingresa el telefono"/>
<input type="hidden" name="accion" value="Crear"/>
<button type="submit">Crear </button>

</form>
<table border="1">
        <thead>
            <tr>
                <th>Carnet</th>
                <th>Nombre</th>
                <th>Grado</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($select->fetchAll() as $alumno){ ?>
                <tr>
                    <td> <?php echo $alumno["Carnet"] ?></td>
                    <td> <?php echo $alumno["Nombre"] ?></td>
                    <td> <?php echo $alumno["Grado"] ?></td>
                    <td> <?php echo $alumno["Telefono"] ?></td>
                </tr>
    <?php } ?>
</body>
</html>