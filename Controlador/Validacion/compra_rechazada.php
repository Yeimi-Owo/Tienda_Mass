<?php
session_start();

// Verificar si hay datos de compra rechazada
if (!isset($_SESSION['compra_rechazada'])) {
  header("Location: ../../Vista/Home/tienda.php");
  exit();
}

$datosRechazo = $_SESSION['compra_rechazada'];
// Limpiar después de obtener los datos
unset($_SESSION['compra_rechazada']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compra Rechazada - TruckMAC</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
      }

      body {
          background-color: #1a1a1a;
          color: #ffffff;
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 20px;
      }

      .container {
          background-color: #2d2d2d;
          border-radius: 12px;
          max-width: 600px;
          width: 100%;
          padding: 40px;
          box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      }

      .header {
          text-align: center;
          margin-bottom: 40px;
      }

      .status-icon {
          width: 80px;
          height: 80px;
          background-color: #dc3545;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 auto 20px;
      }

      .status-icon i {
          font-size: 40px;
          color: white;
      }

      .status-title {
          font-size: 28px;
          font-weight: 600;
          margin-bottom: 8px;
          color: #dc3545;
      }

      .status-subtitle {
          font-size: 16px;
          color: #a0a0a0;
          line-height: 1.5;
      }

      .section {
          margin-bottom: 30px;
      }

      .section-title {
          display: flex;
          align-items: center;
          font-size: 18px;
          font-weight: 600;
          color: #ff4444;
          margin-bottom: 20px;
          padding-bottom: 10px;
          border-bottom: 1px solid #404040;
      }

      .section-title i {
          margin-right: 12px;
          font-size: 20px;
      }

      .error-details {
          background-color: #1a1a1a;
          border: 1px solid #dc3545;
          border-radius: 8px;
          padding: 25px;
          margin-bottom: 30px;
      }

      .error-code {
          font-size: 14px;
          color: #a0a0a0;
          margin-bottom: 8px;
          text-transform: uppercase;
          letter-spacing: 1px;
      }

      .error-message {
          font-size: 18px;
          color: #dc3545;
          font-weight: 600;
          margin-bottom: 15px;
      }

      .error-description {
          font-size: 14px;
          color: #a0a0a0;
          line-height: 1.6;
      }

      .info-grid {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 20px;
          margin-bottom: 30px;
      }

      .info-item {
          background-color: #1a1a1a;
          border: 1px solid #404040;
          border-radius: 8px;
          padding: 20px;
      }

      .info-label {
          font-size: 12px;
          color: #a0a0a0;
          text-transform: uppercase;
          letter-spacing: 1px;
          margin-bottom: 8px;
      }

      .info-value {
          font-size: 16px;
          color: #ffffff;
          font-weight: 500;
      }

      .product-item {
          background-color: #1a1a1a;
          border: 1px solid #404040;
          border-radius: 8px;
          padding: 20px;
          margin-bottom: 15px;
          display: flex;
          justify-content: space-between;
          align-items: center;
          opacity: 0.7;
      }

      .product-info h4 {
          color: #ffffff;
          font-size: 16px;
          font-weight: 600;
          margin-bottom: 5px;
      }

      .product-details {
          color: #a0a0a0;
          font-size: 14px;
      }

      .product-price {
          color: #a0a0a0;
          font-size: 18px;
          font-weight: 700;
          text-decoration: line-through;
      }

      .total-section {
          background-color: #1a1a1a;
          border: 2px solid #dc3545;
          border-radius: 8px;
          padding: 25px;
          text-align: center;
          margin: 30px 0;
          opacity: 0.7;
      }

      .total-label {
          font-size: 16px;
          color: #a0a0a0;
          margin-bottom: 10px;
          text-transform: uppercase;
          letter-spacing: 1px;
      }

      .total-amount {
          font-size: 36px;
          font-weight: 700;
          color: #a0a0a0;
          text-decoration: line-through;
      }

      .help-section {
          background-color: #1a1a1a;
          border: 1px solid #404040;
          border-radius: 8px;
          padding: 25px;
          margin: 30px 0;
      }

      .help-title {
          color: #ffffff;
          font-size: 18px;
          font-weight: 600;
          margin-bottom: 15px;
          display: flex;
          align-items: center;
      }

      .help-title i {
          margin-right: 10px;
          color: #ffc107;
      }

      .help-list {
          list-style: none;
          padding: 0;
      }

      .help-list li {
          color: #a0a0a0;
          margin-bottom: 8px;
          padding-left: 20px;
          position: relative;
      }

      .help-list li::before {
          content: '•';
          color: #ff4444;
          position: absolute;
          left: 0;
      }

      .actions {
          display: flex;
          gap: 15px;
          margin-top: 40px;
      }

      .btn {
          flex: 1;
          padding: 16px 24px;
          border: none;
          border-radius: 8px;
          font-size: 16px;
          font-weight: 600;
          cursor: pointer;
          text-decoration: none;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: all 0.3s ease;
      }

      .btn i {
          margin-right: 8px;
      }

      .btn-primary {
          background-color: #ff4444;
          color: white;
      }

      .btn-primary:hover {
          background-color: #e63939;
          transform: translateY(-2px);
      }

      .btn-secondary {
          background-color: transparent;
          color: #a0a0a0;
          border: 1px solid #404040;
      }

      .btn-secondary:hover {
          background-color: #404040;
          color: #ffffff;
          transform: translateY(-2px);
      }

      .btn-warning {
          background-color: #ffc107;
          color: #000;
      }

      .btn-warning:hover {
          background-color: #e0a800;
          transform: translateY(-2px);
      }

      @media (max-width: 768px) {
          .container {
              padding: 30px 20px;
          }

          .info-grid {
              grid-template-columns: 1fr;
          }

          .actions {
              flex-direction: column;
          }

          .total-amount {
              font-size: 28px;
          }
      }
  </style>
</head>
<body>
  <div class="container">
      <!-- Header con estado -->
      <div class="header">
          <div class="status-icon">
              <i class="fas fa-times"></i>
          </div>
          <h1 class="status-title">Compra Rechazada</h1>
          <p class="status-subtitle">
              Lo sentimos, no pudimos procesar tu pedido.<br>
              Revisa los detalles a continuación.
          </p>
      </div>

      <!-- Detalles del error -->
      <div class="error-details">
          <div class="error-code">Error <?= htmlspecialchars($datosRechazo['codigo_error'] ?? 'PAYMENT_FAILED') ?></div>
          <div class="error-message"><?= htmlspecialchars($datosRechazo['mensaje'] ?? 'Pago rechazado') ?></div>
          <div class="error-description">
              <?= htmlspecialchars($datosRechazo['descripcion'] ?? 'El método de pago seleccionado fue rechazado. Esto puede deberse a fondos insuficientes, datos incorrectos o restricciones de tu banco.') ?>
          </div>
      </div>

      <!-- Información del intento -->
      <div class="section">
          <div class="section-title">
              <i class="fas fa-info-circle"></i>
              Detalles del Intento
          </div>
          
          <div class="info-grid">
              <div class="info-item">
                  <div class="info-label">Fecha del Intento</div>
                  <div class="info-value"><?= date('d/m/Y H:i') ?></div>
              </div>
              <div class="info-item">
                  <div class="info-label">Método de Pago</div>
                  <div class="info-value"><?= ucfirst(htmlspecialchars($datosRechazo['metodo_pago'] ?? 'No especificado')) ?></div>
              </div>
          </div>

          <?php if (isset($datosRechazo['correo'])): ?>
          <div class="info-item">
              <div class="info-label">Correo Electrónico</div>
              <div class="info-value"><?= htmlspecialchars($datosRechazo['correo']) ?></div>
          </div>
          <?php endif; ?>
      </div>

      <!-- Productos (si están disponibles) -->
      <?php if (isset($datosRechazo['productos']) && !empty($datosRechazo['productos'])): ?>
      <div class="section">
          <div class="section-title">
              <i class="fas fa-shopping-bag"></i>
              Productos del Pedido
          </div>
          
          <?php foreach ($datosRechazo['productos'] as $producto): ?>
          <div class="product-item">
              <div class="product-info">
                  <h4><?= htmlspecialchars($producto['nombre']) ?></h4>
                  <div class="product-details">
                      Cantidad: <?= $producto['cantidad'] ?> | 
                      Precio unitario: S/ <?= number_format($producto['precio'], 2) ?>
                  </div>
              </div>
              <div class="product-price">
                  S/ <?= number_format($producto['precio'] * $producto['cantidad'], 2) ?>
              </div>
          </div>
          <?php endforeach; ?>
      </div>

      <!-- Total -->
      <div class="total-section">
          <div class="total-label">Total No Procesado</div>
          <div class="total-amount">S/ <?= number_format($datosRechazo['total'], 2) ?></div>
      </div>
      <?php endif; ?>

      <!-- Sección de ayuda -->
      <div class="help-section">
          <div class="help-title">
              <i class="fas fa-lightbulb"></i>
              ¿Qué puedes hacer?
          </div>
          <ul class="help-list">
              <li>Verifica tus datos de pago.</li>
              <li>Revisa tu saldo en tu cuenta bancaria.</li>
              <li>Intenta nuevamente en otro momento.</li>
          </ul>
      </div>

      <!-- Botones de acción -->
      <div class="actions"> 
          <a href="checkout.php" class="btn btn-primary">
              <i class="fas fa-arrow-left"></i>
              Volver a Intentar
          </a>
          <a href="index.php" class="btn btn-secondary">
              <i class="fas fa-home"></i>
              Volver a la Página Principal
          </a>
      </div>
  </div>
</body>
</html>