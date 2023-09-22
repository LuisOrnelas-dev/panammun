<?php
/**
 * Queremos crear un hash de nuestra contraseña uando el algoritmo DEFAULT actual.
 * Actualmente es BCRYPT, y producirá un resultado de 60 caracteres.
 *
 * Hay que tener en cuenta que DEFAULT puede cambiar con el tiempo, por lo que debería prepararse
 * para permitir que el almacenamento se amplíe a más de 60 caracteres (255 estaría bien)
 */
//$hash = password_hash("Lapuente04", PASSWORD_BCRYPT);
//echo $hash;
// See the password_hash() example to see where this came from.
 $hash = '$2y$10$0G3IMDURgTUaB2dEC4haP.UK7.3Nr7uoX8wGcgaBW51dsySRRmK.m';
//$hash = '$2y$10$PjILdJ18H/PROOUkh9BjD.aZzCqhKhtbXeiJbziFXk0HEP/oV2nsi';
if (password_verify('Lapuente04', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>