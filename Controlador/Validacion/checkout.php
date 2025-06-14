<?php
session_start();
require_once "../../Vista/config/database.php";

// Si se ha enviado el formulario completo (con nombre, correo, dirección y método de pago) lo procesamos
if (
  $_SERVER["REQUEST_METHOD"] == "POST"
  && isset($_POST["productos"])
  && isset($_POST["nombre"])
  && isset($_POST["correo"])
  && isset($_POST["direccion"])
  && isset($_POST["metodo_pago"])
) {

  $productos = json_decode($_POST["productos"], true);

  // Guardar datos del comprador en sesión para pasarlos a procesar_compra.php
  $_SESSION["productos_compra"] = $productos;
  $_SESSION["nombre"] = htmlspecialchars($_POST["nombre"]);
  $_SESSION["correo"] = htmlspecialchars($_POST["correo"]);
  $_SESSION["direccion"] = htmlspecialchars($_POST["direccion"]);
  $_SESSION["metodo_pago"] = htmlspecialchars($_POST["metodo_pago"]);

  header("Location: procesar_compra.php");
  exit();
}

// Si se recibe POST con los productos pero aún no se han ingresado los datos adicionales, mostramos el formulario.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productos"])) {
  $productos = json_decode($_POST["productos"], true);
} else {
  header("Location: ../../Vista/Home/tienda.php");
  exit();
}

// Calcular total
$total = 0;
foreach ($productos as $producto) {
  $total += $producto['precio'] * ($producto['cantidad'] ?? 1);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar Compra - TruckMAC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }

      body {
          background: #1a1a1a;
          color: #ffffff;
          font-family: 'Arial', sans-serif;
          min-height: 100vh;
      }

      .checkout-container {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
          min-height: 100vh;
      }

      .checkout-header {
          background: #2d2d2d;
          border: 1px solid #444;
          border-radius: 8px;
          padding: 30px;
          text-align: center;
          margin-bottom: 0;
          border-bottom: none;
          border-bottom-left-radius: 0;
          border-bottom-right-radius: 0;
      }

      .checkout-header h1 {
          color: #ffffff;
          font-size: 1.5rem;
          font-weight: 600;
          margin-bottom: 8px;
      }

      .checkout-header h1 i {
          margin-right: 10px;
          color: #ffffff;
      }

      .checkout-header p {
          color: #cccccc;
          font-size: 0.9rem;
          margin: 0;
      }

      .main-content {
          background: #2d2d2d;
          border: 1px solid #444;
          border-top: none;
          border-radius: 0 0 8px 8px;
          padding: 30px;
      }

      .section-title {
          color: #ff4444;
          font-size: 1rem;
          font-weight: 600;
          margin-bottom: 20px;
          display: flex;
          align-items: center;
          border-bottom: 1px solid #444;
          padding-bottom: 10px;
      }

      .section-title i {
          margin-right: 8px;
          color: #ff4444;
      }

      .product-item {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 15px 0;
          color: #ffffff;
      }

      .product-name {
          font-weight: 500;
          color: #ffffff;
      }

      .product-price {
          font-weight: 600;
          color: #ff4444;
      }

      .form-group {
          margin-bottom: 25px;
      }

      .form-label {
          color: #ffffff;
          font-weight: 500;
          margin-bottom: 8px;
          display: block;
          font-size: 0.9rem;
      }

      .form-control {
          background: #1a1a1a;
          border: 1px solid #444;
          color: #ffffff;
          padding: 12px 15px;
          border-radius: 4px;
          font-size: 0.9rem;
          width: 100%;
          transition: all 0.3s ease;
      }

      .form-control:focus {
          background: #1a1a1a;
          border-color: #ff4444;
          color: #ffffff;
          box-shadow: 0 0 0 0.2rem rgba(255, 68, 68, 0.25);
          outline: none;
      }

      .form-control::placeholder {
          color: #888;
      }

      .payment-methods {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
          gap: 15px;
          margin-bottom: 25px;
      }

      .payment-method {
          position: relative;
      }

      .payment-method input[type="radio"] {
          position: absolute;
          opacity: 0;
          width: 0;
          height: 0;
      }

      .payment-method label {
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 20px 15px;
          border: 1px solid #444;
          border-radius: 8px;
          cursor: pointer;
          transition: all 0.3s ease;
          background: #1a1a1a;
          text-align: center;
          min-height: 120px;
          justify-content: center;
      }

      .payment-method label:hover {
          border-color: #ff4444;
          background: #222;
          transform: translateY(-2px);
      }

      .payment-method input[type="radio"]:checked + label {
          border-color: #ff4444;
          background: #2a1a1a;
          box-shadow: 0 0 15px rgba(255, 68, 68, 0.3);
      }

      .payment-icon {
          font-size: 1.8rem;
          color: #ff4444;
          margin-bottom: 8px;
          transition: all 0.3s ease;
      }

      .payment-method label:hover .payment-icon {
          transform: scale(1.1);
      }

      .payment-title {
          font-weight: 600;
          color: #ffffff;
          font-size: 0.9rem;
          margin-bottom: 4px;
      }

      .payment-description {
          color: #cccccc;
          font-size: 0.75rem;
          line-height: 1.2;
      }

      .payment-details {
          background: #1a1a1a;
          border: 1px solid #444;
          border-radius: 8px;
          padding: 20px;
          margin-top: 20px;
          opacity: 0;
          max-height: 0;
          overflow: hidden;
          transition: all 0.4s ease;
      }

      .payment-details.show {
          opacity: 1;
          max-height: 500px;
          margin-bottom: 20px;
      }

      .payment-info-box h6 {
          color: #ff4444;
          margin-bottom: 15px;
          display: flex;
          align-items: center;
      }

      .payment-info-box h6 i {
          margin-right: 8px;
      }

      .payment-info-box p {
          color: #cccccc;
          margin-bottom: 8px;
          font-size: 0.9rem;
      }

      .payment-info-box strong {
          color: #ffffff;
      }

      .alert {
          background: rgba(255, 68, 68, 0.1);
          border: 1px solid rgba(255, 68, 68, 0.3);
          color: #ffffff;
          padding: 15px;
          border-radius: 4px;
          margin-top: 15px;
      }

      .alert i {
          margin-right: 8px;
          color: #ff4444;
      }

      .total-section {
          background: #1a1a1a;
          border: 1px solid #444;
          padding: 20px;
          border-radius: 8px;
          margin: 30px 0;
          text-align: center;
      }

      .total-label {
          color: #cccccc;
          font-size: 1rem;
          margin-bottom: 5px;
      }

      .total-amount {
          color: #ff4444;
          font-size: 1.8rem;
          font-weight: 700;
      }

      .button-group {
          display: flex;
          gap: 15px;
          justify-content: space-between;
          margin-top: 30px;
      }

      .btn {
          padding: 12px 25px;
          border-radius: 4px;
          font-weight: 600;
          font-size: 0.9rem;
          text-decoration: none;
          border: none;
          cursor: pointer;
          transition: all 0.3s ease;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          flex: 1;
      }

      .btn i {
          margin-right: 8px;
      }

      .btn-back {
          background: transparent;
          color: #cccccc;
          border: 1px solid #444;
      }

      .btn-back:hover {
          background: #444;
          color: #ffffff;
          transform: translateY(-1px);
      }

      .btn-primary {
          background: #ff4444;
          color: #ffffff;
      }

      .btn-primary:hover {
          background: #cc3333;
          color: #ffffff;
          transform: translateY(-1px);
      }

      .mb-section {
          margin-bottom: 30px;
      }

      @media (max-width: 768px) {
          .checkout-container {
              padding: 15px;
          }
          
          .checkout-header, .main-content {
              padding: 20px;
          }
          
          .payment-methods {
              grid-template-columns: 1fr;
          }
          
          .button-group {
              flex-direction: column;
          }
      }
  </style>
</head>
<body>
  <div class="checkout-container">
      <!-- Header -->
      <div class="checkout-header">
          <h1>
              <i class="fas fa-shopping-cart"></i>
              Finalizar Compra
          </h1>
          <p>Complete los datos para procesar su pedido</p>
      </div>

      <!-- Main Content -->
      <div class="main-content">
          <!-- Resumen del Pedido -->
          <div class="mb-section">
              <div class="section-title">
                  <i class="fas fa-clipboard-list"></i>
                  Resumen del Pedido
              </div>
              <?php foreach ($productos as $producto): ?>
                  <div class="product-item">
                      <div class="product-name">
                          <?= htmlspecialchars($producto['nombre']) ?>
                          <?php if (isset($producto['cantidad']) && $producto['cantidad'] > 1): ?>
                              <span style="color: #888;"> x<?= $producto['cantidad'] ?></span>
                          <?php endif; ?>
                      </div>
                      <div class="product-price">
                          S/ <?= number_format($producto['precio'] * ($producto['cantidad'] ?? 1), 2) ?>
                      </div>
                  </div>
              <?php endforeach; ?>
          </div>

          <!-- Formulario -->
          <form action="checkout.php" method="POST">
              <input type="hidden" name="productos" value='<?= htmlspecialchars(json_encode($productos)) ?>'>

              <!-- Datos del Cliente -->
              <div class="mb-section">
                  <div class="section-title">
                      <i class="fas fa-user"></i>
                      Datos del Cliente
                  </div>
                  
                  <div class="form-group">
                      <label for="nombre" class="form-label">Nombre Completo *</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Juan Pérez García">
                  </div>

                  <div class="form-group">
                      <label for="correo" class="form-label">Correo Electrónico *</label>
                      <input type="email" class="form-control" id="correo" name="correo" required placeholder="yeimicr16@gmail.com">
                  </div>
              </div>

              <!-- Dirección de Envío -->
              <div class="mb-section">
                  <div class="section-title">
                      <i class="fas fa-map-marker-alt"></i>
                      Dirección de Envío
                  </div>
                  
                  <div class="form-group">
                      <label for="direccion" class="form-label">Dirección *</label>
                      <input type="text" class="form-control" id="direccion" name="direccion" required placeholder="Av. Paseo de la República 170, Lima 15001">
                  </div>
              </div>

              <!-- Método de Pago -->
              <div class="mb-section">
                  <div class="section-title">
                      <i class="fas fa-credit-card"></i>
                      Método de Pago
                  </div>

                  <div class="payment-methods">
                      <!-- Efectivo -->
                      <div class="payment-method">
                          <input type="radio" id="efectivo" name="metodo_pago" value="efectivo">
                          <label for="efectivo">
                              <div class="payment-icon">
                                  <i class="fas fa-money-bill-wave"></i>
                              </div>
                              <div class="payment-title">Efectivo</div>
                              <div class="payment-description">Pague al recibir el producto</div>
                          </label>
                      </div>

                      <!-- Yape/Plin -->
                      <div class="payment-method">
                          <input type="radio" id="yape" name="metodo_pago" value="yape">
                          <label for="yape">
                              <div class="payment-icon">
                                  <i class="fas fa-mobile-alt"></i>
                              </div>
                              <div class="payment-title">Yape/Plin</div>
                              <div class="payment-description">Pago con billetera móvil</div>
                          </label>
                      </div>

                      <!-- Depósito Bancario -->
                      <div class="payment-method">
                          <input type="radio" id="deposito" name="metodo_pago" value="deposito">
                          <label for="deposito">
                              <div class="payment-icon">
                                  <i class="fas fa-university"></i>
                              </div>
                              <div class="payment-title">Depósito Bancario</div>
                              <div class="payment-description">Transferencia a cuenta bancaria</div>
                          </label>
                      </div>

                      <!-- PayPal -->
                      <div class="payment-method">
                          <input type="radio" id="paypal" name="metodo_pago" value="paypal">
                          <label for="paypal">
                              <div class="payment-icon">
                                  <i class="fab fa-paypal"></i>
                              </div>
                              <div class="payment-title">PayPal</div>
                              <div class="payment-description">Pago internacional seguro</div>
                          </label>
                      </div>

                      <!-- Tarjeta de Crédito -->
                      <div class="payment-method">
                          <input type="radio" id="credito" name="metodo_pago" value="credito">
                          <label for="credito">
                              <div class="payment-icon">
                                  <i class="fas fa-credit-card"></i>
                              </div>
                              <div class="payment-title">Tarjeta de Crédito</div>
                              <div class="payment-description">Visa, Mastercard, etc.</div>
                          </label>
                      </div>
                  </div>

                  <!-- Detalles de Pago -->
                  
                  <!-- Efectivo Details -->
                  <div id="efectivoDetails" class="payment-details">
                      <div class="payment-info-box">
                          <h6><i class="fas fa-money-bill-wave"></i> Pago en Efectivo</h6>
                          <p>El pago se realizará contra entrega del producto.</p>
                          <p><strong>Monto a pagar:</strong> <span style="color: #ff4444; font-weight: bold;">S/ <?= number_format($total, 2) ?></span></p>
                          <div class="alert">
                              <i class="fas fa-exclamation-triangle"></i>
                              Nuestro equipo se pondrá en contacto contigo para coordinar la entrega y el pago.
                          </div>
                      </div>
                  </div>

                  <!-- Yape/Plin Details -->
                  <div id="yapeDetails" class="payment-details">
                      <div class="payment-info-box">
                          <h6><i class="fas fa-mobile-alt"></i> Datos para Yape/Plin</h6>
                          <p><strong>Número Yape:</strong> 999 888 777</p>
                          <p><strong>Número Plin:</strong> 999 888 777</p>
                          <p><strong>Nombre:</strong> TruckMAC SAC</p>
                          <p><strong>Monto a pagar:</strong> <span style="color: #ff4444; font-weight: bold;">S/ <?= number_format($total, 2) ?></span></p>
                          <div class="alert">
                              <i class="fas fa-info-circle"></i>
                              Realiza el pago y luego procede con la compra. Te contactaremos para confirmar el pago.
                          </div>
                      </div>
                  </div>

                  <!-- Depósito Details -->
                  <div id="depositoDetails" class="payment-details">
                      <div class="payment-info-box">
                          <h6><i class="fas fa-university"></i> Datos Bancarios</h6>
                          <p><strong>Banco:</strong> BCP</p>
                          <p><strong>Cuenta Corriente:</strong> 123-456789-0-12</p>
                          <p><strong>CCI:</strong> 002-123-456789012345-67</p>
                          <p><strong>Titular:</strong> TruckMAC SAC</p>
                          <p><strong>RUC:</strong> 20123456789</p>
                          <p><strong>Monto:</strong> <span style="color: #ff4444; font-weight: bold;">S/ <?= number_format($total, 2) ?></span></p>
                          <div class="alert">
                              <i class="fas fa-info-circle"></i>
                              Realiza la transferencia y guarda el comprobante. Te contactaremos para confirmar el pago.
                          </div>
                      </div>
                  </div>

                  <!-- PayPal Details -->
                  <div id="paypalDetails" class="payment-details">
                      <div class="payment-info-box">
                          <h6><i class="fab fa-paypal"></i> Pago con PayPal</h6>
                          <p>Será redirigido a PayPal para completar el pago de forma segura.</p>
                          <p><strong>Monto:</strong> <span style="color: #ff4444; font-weight: bold;">S/ <?= number_format($total, 2) ?></span></p>
                          <div class="alert">
                              <i class="fas fa-info-circle"></i>
                              Al hacer clic en "Procesar Pago", será redirigido a PayPal para completar la transacción.
                          </div>
                      </div>
                  </div>

                  <!-- Tarjeta de Crédito Details -->
                  <div id="creditoDetails" class="payment-details">
                      <div class="payment-info-box">
                          <h6><i class="fas fa-credit-card"></i> Pago con Tarjeta</h6>
                          <p>Procesaremos su pago de forma segura.</p>
                          <p><strong>Monto:</strong> <span style="color: #ff4444; font-weight: bold;">S/ <?= number_format($total, 2) ?></span></p>
                          <div class="alert">
                              <i class="fas fa-shield-alt"></i>
                              Su información de pago está protegida con encriptación SSL de 256 bits.
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Total -->
              <div class="total-section">
                  <div class="total-label">Total</div>
                  <div class="total-amount">S/ <?= number_format($total, 2) ?></div>
              </div>

              <!-- Botones -->
              <div class="button-group">
                  <a href="../../Vista/Home/tienda.php" class="btn btn-back">
                      <i class="fas fa-arrow-left"></i>
                      Volver
                  </a>
                  <button type="submit" class="btn btn-primary">
                      Procesar Pago
                  </button>
              </div>
          </form>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../JS/checkout.js"></script>
</body>
</html>