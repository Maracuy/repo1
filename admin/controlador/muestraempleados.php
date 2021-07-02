<h3>Empleados:</h3>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Usuario</th>
      <th scope="col">Nombre</th>
      <th scope="col">Email</th>
      <th scope="col">Nivel</th>
      <th scope="col">Detalles</th>
      <th scope="col">Editar</th>
      <th scope="col">Eliminar</th>


    </tr>
  </thead>

  <tbody>
    <?php
        $i=1;
        foreach($resultado as $dato){
        echo "<tr>";
        echo "<th scope='row'>". $i ."</th>";
        echo "<td>" . $dato['usuario'] . "</td>";
        echo "<td>" . $dato['nombres'] . "</td>";
        echo "<td>" . $dato['email'] . "</td>";
        echo "<td>" . $dato['nivel'] . "</td>";
        echo "<td>"."<i class='fas fa-info-circle ml-4'></i>"."</td>";
        echo "<td>"."<i class='fas fa-user-edit ml-3'></i>"."</td>";
        echo "<td>".'<i class="fas fa-user-minus ml-4"></i>'."</td>";
        $i=$i+1;

        echo "</tr>";
    }    
    ?>
  </tbody>
</table>

<div class="dropdown-divider"></div>
<br>
<h3>Registrar un empleado nuevo</h3>