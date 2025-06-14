<?php
session_start();

// Verificar si hay datos de compra exitosa
if (!isset($_SESSION['compra_exitosa'])) {
  header("Location: ../../Vista/Home/tienda.php");
  exit();
}

$datosCompra = $_SESSION['compra_exitosa'];
// Limpiar después de obtener los datos
unset($_SESSION['compra_exitosa']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compra Exitosa - TruckMAC</title>
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
          background-color: #28a745;
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
          color: #ffffff;
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

      .order-number {
          background-color: #1a1a1a;
          border: 1px solid #404040;
          border-radius: 8px;
          padding: 20px;
          text-align: center;
          margin-bottom: 30px;
      }

      .order-number-label {
          font-size: 14px;
          color: #a0a0a0;
          margin-bottom: 8px;
          text-transform: uppercase;
          letter-spacing: 1px;
      }

      .order-number-value {
          font-size: 24px;
          font-weight: 700;
          color: #ff4444;
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
          color: #ff4444;
          font-size: 18px;
          font-weight: 700;
      }

      .total-section {
          background-color: #1a1a1a;
          border: 2px solid #ff4444;
          border-radius: 8px;
          padding: 25px;
          text-align: center;
          margin: 30px 0;
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
          color: #ff4444;
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

      /* Canvas oculto para generar imagen */
      #comprobanteCanvas {
          display: none;
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
  <!-- Canvas oculto para generar la imagen del comprobante -->
  <canvas id="comprobanteCanvas" width="800" height="1000"></canvas>

  <div class="container">
      <!-- Header con estado -->
      <div class="header">
          <div class="status-icon">
              <i class="fas fa-check"></i>
          </div>
          <h1 class="status-title">¡Compra Exitosa!</h1>
          <p class="status-subtitle">
              Tu pedido ha sido procesado correctamente.<br>
              Recibirás un correo de confirmación en breve.
          </p>
      </div>

      <!-- Número de orden -->
      <div class="order-number">
          <div class="order-number-label">Número de Orden</div>
          <div class="order-number-value"><?= htmlspecialchars($datosCompra['numero_orden']) ?></div>
      </div>

      <!-- Información del cliente -->
      <div class="section">
          <div class="section-title">
              <i class="fas fa-user"></i>
              Datos del Cliente
          </div>
          
          <div class="info-grid">
              <div class="info-item">
                  <div class="info-label">Correo Electrónico</div>
                  <div class="info-value"><?= htmlspecialchars($datosCompra['correo']) ?></div>
              </div>
              <div class="info-item">
                  <div class="info-label">Fecha del Pedido</div>
                  <div class="info-value"><?= date('d/m/Y H:i', strtotime($datosCompra['fecha'])) ?></div>
              </div>
          </div>

          <div class="info-item">
              <div class="info-label">Dirección de Envío</div>
              <div class="info-value"><?= htmlspecialchars($datosCompra['direccion']) ?></div>
          </div>
      </div>

      <!-- Resumen del pedido -->
      <div class="section">
          <div class="section-title">
              <i class="fas fa-shopping-bag"></i>
              Resumen del Pedido
          </div>
          
          <?php foreach ($datosCompra['productos'] as $producto): ?>
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
          <div class="total-label">Total Pagado</div>
          <div class="total-amount">S/ <?= number_format($datosCompra['total'], 2) ?></div>
      </div>

      <!-- Botones de acción -->
      <div class="actions">
          <a href="../../Vista/Home/tienda.php" class="btn btn-primary">
              <i class="fas fa-shopping-cart"></i>
              Seguir Comprando
          </a>
          <button onclick="descargarComprobanteImagen()" class="btn btn-secondary">
              <i class="fas fa-download"></i>
              Descargar Comprobante
          </button>
      </div>
  </div>

  <script>
      // Datos de la compra
      const datosCompra = <?= json_encode($datosCompra) ?>;

      // Función para generar y descargar comprobante como imagen
      function descargarComprobanteImagen() {
          const canvas = document.getElementById('comprobanteCanvas');
          const ctx = canvas.getContext('2d');
          
          // Configurar canvas
          canvas.width = 800;
          canvas.height = Math.max(1000, 700 + (datosCompra.productos.length * 60));
          
          // Fondo
          ctx.fillStyle = '#2d2d2d';
          ctx.fillRect(0, 0, canvas.width, canvas.height);
          
          // Borde
          ctx.strokeStyle = '#404040';
          ctx.lineWidth = 2;
          ctx.strokeRect(20, 20, canvas.width - 40, canvas.height - 40);
          
          let y = 80;
          
          // Logo/Título
          ctx.fillStyle = '#ffffff';
          ctx.font = 'bold 40px Arial';
          ctx.textAlign = 'center';
          ctx.fillText('TRUCKMAC', canvas.width / 2, y);
          
          y += 50;
          ctx.font = '24px Arial';
          ctx.fillStyle = '#ff4444';
          ctx.fillText('COMPROBANTE DE COMPRA', canvas.width / 2, y);
          
          y += 80;
          
          // Número de orden
          ctx.fillStyle = '#28a745';
          ctx.font = 'bold 28px Arial';
          ctx.fillText(`Orden: ${datosCompra.numero_orden}`, canvas.width / 2, y);
          
          y += 80;
          
          // Información del cliente
          ctx.fillStyle = '#ffffff';
          ctx.font = 'bold 20px Arial';
          ctx.textAlign = 'left';
          ctx.fillText('INFORMACIÓN DEL PEDIDO', 60, y);
          
          y += 40;
          ctx.font = '16px Arial';
          ctx.fillStyle = '#cccccc';
          
          const info = [
              `Fecha: ${new Date(datosCompra.fecha).toLocaleString('es-PE')}`,
              `Correo: ${datosCompra.correo}`,
              `Dirección: ${datosCompra.direccion}`,
              `Método de Pago: ${datosCompra.metodo_pago.toUpperCase()}`
          ];
          
          info.forEach(item => {
              ctx.fillText(item, 60, y);
              y += 30;
          });
          
          y += 40;
          
          // Productos
          ctx.fillStyle = '#ffffff';
          ctx.font = 'bold 20px Arial';
          ctx.fillText('PRODUCTOS', 60, y);
          
          y += 40;
          
          // Encabezados
          ctx.fillStyle = '#ff4444';
          ctx.font = 'bold 16px Arial';
          ctx.fillText('PRODUCTO', 60, y);
          ctx.fillText('CANT.', 450, y);
          ctx.fillText('P. UNIT.', 550, y);
          ctx.fillText('SUBTOTAL', 650, y);
          
          y += 30;
          
          // Línea separadora
          ctx.strokeStyle = '#404040';
          ctx.lineWidth = 1;
          ctx.beginPath();
          ctx.moveTo(60, y);
          ctx.lineTo(740, y);
          ctx.stroke();
          
          y += 25;
          
          // Lista de productos
          ctx.fillStyle = '#ffffff';
          ctx.font = '14px Arial';
          
          datosCompra.productos.forEach(producto => {
              const subtotal = producto.precio * producto.cantidad;
              
              let nombre = producto.nombre;
              if (nombre.length > 40) {
                  nombre = nombre.substring(0, 37) + '...';
              }
              
              ctx.fillText(nombre, 60, y);
              ctx.fillText(producto.cantidad.toString(), 450, y);
              ctx.fillText(`S/ ${producto.precio.toFixed(2)}`, 550, y);
              ctx.fillText(`S/ ${subtotal.toFixed(2)}`, 650, y);
              
              y += 25;
          });
          
          y += 30;
          
          // Total
          ctx.strokeStyle = '#ff4444';
          ctx.lineWidth = 2;
          ctx.beginPath();
          ctx.moveTo(500, y);
          ctx.lineTo(740, y);
          ctx.stroke();
          
          y += 40;
          
          ctx.fillStyle = '#ff4444';
          ctx.font = 'bold 28px Arial';
          ctx.textAlign = 'right';
          ctx.fillText(`TOTAL: S/ ${datosCompra.total.toFixed(2)}`, 740, y);
          
          y += 60;
          
          // Pie de página
          ctx.fillStyle = '#ffffff';
          ctx.font = 'bold 18px Arial';
          ctx.textAlign = 'center';
          ctx.fillText('¡Gracias por su compra!', canvas.width / 2, y);
          
          y += 30;
          ctx.font = '14px Arial';
          ctx.fillStyle = '#cccccc';
          ctx.fillText('Estado: PENDIENTE', canvas.width / 2, y);
          
          // Descargar imagen
          const link = document.createElement('a');
          link.download = `Comprobante_${datosCompra.numero_orden}.png`;
          link.href = canvas.toDataURL();
          link.click();
      }
  </script>
</body>
</html>