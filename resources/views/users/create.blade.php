<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" required>

    <label for="password_confirmation">Confirmar contraseña</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <button type="submit">Crear usuario</button>
</form>
