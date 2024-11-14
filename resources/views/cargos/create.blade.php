<form action="{{ route('cargos.store') }}" method="POST">
    @csrf
    <label for="codigo">Código</label>
    <input type="text" id="codigo" name="codigo" required>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>

    <button type="submit">Crear cargo</button>
</form>
