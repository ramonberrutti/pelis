<form action="/pelis/ajax/admin" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="addfilm">
    <div><label>Nombre: </label><input type=text name="name" /></div>
    <div><label>Año: </label><input type=text name="year"/></div>
    <div><label>Genero: </label><input type=text name="generoid"/></div>
    <div><label>Sinopsis: </label><input type=text name="sinopsis"/></div>
    <div><label>File: </label><input type="file" name="image"/></div>
    <div><input type="submit"/></div>
</form>