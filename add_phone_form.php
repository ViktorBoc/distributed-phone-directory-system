<form action="add_phone_action.php" method="POST" class="mt-4">
    <div class="form-group">
        <label for="brand">Značka:</label>
        <input type="text" class="form-control" id="brand" name="brand" required>
    </div>
    <div class="form-group">
        <label for="model">Model:</label>
        <input type="text" class="form-control" id="model" name="model" required>
    </div>
    <div class="form-group">
        <label for="price">Cena:</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>
    <button type="submit" class="btn btn-primary">Pridať</button>
</form>
