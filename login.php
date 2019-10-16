<?php

$host=$_POST['host'];
$dbname=$_POST['database'];
$user=$_POST['username'];
$pass=$_POST['password'];

// detalles de la conexion
$conn_string = "host={$host} port=5432 dbname={$dbname} user={$user} password={$pass} options='--client_encoding=UTF8'";

// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string);

conexion($dbconn);

// Close connection
pg_close($dbconn);
?>
<?php

        function conexion( $conexion )
        {
            $table=$_POST['table'];
	    $sql = "SELECT * FROM $table";
            $ok = true;
            // Ejecutar la consulta:
             $rs = pg_query( $conexion, $sql );
            if( $rs )
            {
                // Obtener el número de filas:
                 if( pg_num_rows($rs) > 0 )
                {
                    echo "<p/>Listado de $table<br/>";
                    echo "===================<p />";
                    // Recorrer el resource y mostrar los datos:
                     while( $obj = pg_fetch_object($rs) )
                         echo $obj->nombre."<br />";
                }
                else
                    echo "<p>No se encontraron $table</p>";
            }
            else
                $ok = false;
            return $ok;
        }
    ?>
