{include file="header.tpl"}
<form action="addUser" method="POST">
    <input type="text" name="nombre" placeholder="Usuario">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="pass" placeholder="Contraseña">
    <input type="submit" value="Registrarse">
</form>
{include file="footer.tpl"}