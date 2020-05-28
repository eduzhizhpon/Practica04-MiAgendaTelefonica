<?php
    include '../../../config/conexionBD.php';

    $user_id = $_GET['user_id'];
    $action = $_GET['action'];
    $sqlPhones = "SELECT * FROM telefonos where usu_codigo=$user_id and tel_eliminado = 'N'";

    $resultPh = $conn->query($sqlPhones);

    echo "<tr>
            <th>Número</th>
            <th>Tipo</th>
            <th>Operadora</th>
            <th></th>
        </tr>";

    if($resultPh){
        if ($resultPh -> num_rows > 0) {

            while($rowPh = $resultPh -> fetch_assoc()) {
                echo "<tr>";
                echo "<td><a class='a_link' href='tel:". $rowPh['tel_numero'] . "'>" . $rowPh['tel_numero'] . "</a></td>";
                switch($rowPh['tel_tipo']){
                    case "CO":
                        echo "<td> CONVENCIONAL</td>";
                    break;
                    case "CE":
                        echo "<td> CELULAR</td>";
                    break;

                    default:

                }
                echo "<td>" . $rowPh['tel_operadora'] . "</td>";
                
                switch ($action) {
                    case '0':
                        echo "<td> <a class='btn btn_passive' href='manage_phones.php?tel_codigo=" . $rowPh["tel_codigo"] . "&usu_codigo=" . $rowPh["usu_codigo"] . "'>Administrar</a></td>";
                        break;
                    case '1':
                        echo "<td> <a class='btn btn_passive' onclick='readPhone(\"f_phone\", ". $rowPh['tel_codigo'] .")'>Actualizar</a></td>";
                        echo "<td> <a class='btn btn_danger' onclick='deletePhone(". $rowPh['tel_codigo'] .")'>Eliminar</a></td>";
                    break;
                    default:
                        # code...
                        break;
                }
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo " <td colspan='3'> No existen teléfonos para este usuario.</td>";
        }
    }else{
        echo " <tr><td colspan='3'>Error: " . mysqli_error($conn) . "</td></tr>";
        echo "</tr>";
    }
    
    $conn->close();
?>