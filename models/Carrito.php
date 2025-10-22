<form action="../controllers/OrderController.php" method="POST">
  <select name="metodo_pago_id" required>
    <option value="1">Tarjeta</option>
    <option value="2">Efectivo</option>
  </select>
  <input type="hidden" name="empleado_id" value="1"> <!-- Puedes obtenerlo dinámicamente -->
  <textarea name="observaciones" placeholder="Observaciones del pedido"></textarea>
  <button type="submit">Confirmar pedido</button>
</form>
