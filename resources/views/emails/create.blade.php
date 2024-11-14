<form action="{{ route('emails.store') }}" method="POST">
    @csrf
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="tipo">Tipo</label>
    <input type="text" id="tipo" name="tipo" required>

    <button type="submit">Crear email</button>
</form>
