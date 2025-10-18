-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS prime_supplements;
USE prime_supplements;

-- Tabla rol_empleado
CREATE TABLE IF NOT EXISTS rol_empleado (
    rol_id INT AUTO_INCREMENT PRIMARY KEY,
    rol VARCHAR(50) NOT NULL,
    descripcion VARCHAR(255)
);

-- Tabla empleado
CREATE TABLE IF NOT EXISTS empleado (
    dpi_empleado VARCHAR(20) PRIMARY KEY,
    contrasena VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    rol_id INT NOT NULL,
    FOREIGN KEY (rol_id) REFERENCES rol_empleado(rol_id)
);

-- Tabla usuario_clientes
CREATE TABLE IF NOT EXISTS usuario_clientes (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nac DATE
);

-- Tabla tarjetas_pago
CREATE TABLE IF NOT EXISTS tarjetas_pago (
    numero BIGINT PRIMARY KEY,
    cliente_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES usuario_clientes(cliente_id)
);

-- Tabla cat_productos (Categorías de productos)
CREATE TABLE IF NOT EXISTS cat_productos (
    categoria_id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(100) NOT NULL
);

-- Tabla productos
CREATE TABLE IF NOT EXISTS productos (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    cantidad_peso VARCHAR(50),
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES cat_productos(categoria_id)
);

-- Tabla estado
CREATE TABLE IF NOT EXISTS estado (
    estado_id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL
);

-- Tabla metodo_pago
CREATE TABLE IF NOT EXISTS metodo_pago (
    metodo_pago_id INT AUTO_INCREMENT PRIMARY KEY,
    metodo VARCHAR(50) NOT NULL
);

-- Tabla pedido
CREATE TABLE IF NOT EXISTS pedido (
    numero_pedido INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    dpi_empleado VARCHAR(20),
    producto INT NOT NULL,
    NIT VARCHAR(20),
    direccion_entrega VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    estado_id INT NOT NULL,
    metodo_pago_id INT NOT NULL,
    Total_pedido DECIMAL(10,2) NOT NULL,
    observaciones TEXT,
    FOREIGN KEY (cliente_id) REFERENCES usuario_clientes(cliente_id),
    FOREIGN KEY (dpi_empleado) REFERENCES empleado(dpi_empleado),
    FOREIGN KEY (producto) REFERENCES productos(codigo),
    FOREIGN KEY (estado_id) REFERENCES estado(estado_id),
    FOREIGN KEY (metodo_pago_id) REFERENCES metodo_pago(metodo_pago_id)
);

-- Inserción de datos ficticios

-- rol_empleado
INSERT INTO rol_empleado (rol, descripcion) VALUES
('Administrador', 'Gestiona usuarios, productos y empleados.'),
('Vendedor', 'Procesa pedidos y atiende clientes.'),
('Almacenista', 'Gestiona inventario y empaqueta pedidos.'),
('Repartidor', 'Entrega pedidos a los clientes.');

-- empleado
INSERT INTO empleado (dpi_empleado, contrasena, email, nombre, apellido, rol_id) VALUES
('1234567890123', 'passAdmin123', 'admin@prime.com', 'Ana', 'García', 1),
('2345678901234', 'passVendedor', 'juan.perez@prime.com', 'Juan', 'Pérez', 2),
('3456789012345', 'passAlmacen', 'maria.lopez@prime.com', 'María', 'López', 3),
('4567890123456', 'passReparto', 'carlos.rojas@prime.com', 'Carlos', 'Rojas', 4);

-- usuario_clientes
INSERT INTO usuario_clientes (email, contrasena, nombre, apellido, fecha_nac) VALUES
('cliente1@example.com', 'clientePass1', 'Laura', 'Martínez', '1990-05-15'),
('cliente2@example.com', 'clientePass2', 'Pedro', 'Sánchez', '1988-11-20'),
('cliente3@example.com', 'clientePass3', 'Sofía', 'Hernández', '1995-03-10');

-- tarjetas_pago
INSERT INTO tarjetas_pago (numero, cliente_id) VALUES
(1234567890123456, 1),
(9876543210987654, 2),
(1122334455667788, 1);

-- cat_productos
INSERT INTO cat_productos (categoria) VALUES
('Proteínas'),
('Creatinas'),
('Pre-entrenos'),
('Vitaminas y Minerales'),
('Barras y Snacks');

-- productos (datos reales de marcas y productos de suplementos)
INSERT INTO productos (nombre, marca, descripcion, precio, cantidad_peso, categoria_id) VALUES
('Gold Standard 100% Whey', 'Optimum Nutrition', 'Proteína de suero de leche de alta calidad.', 75.99, '2.27 kg', 1),
('Impact Whey Protein', 'Myprotein', 'Proteína de suero concentrada.', 54.99, '2.5 kg', 1),
('Creatina Monohidratada', 'Universal Nutrition', 'Creatina para mejorar fuerza y rendimiento.', 29.99, '500 g', 2),
('C4 Original Pre-Workout', 'Cellucor', 'Energía explosiva y concentración.', 39.99, '30 servicios', 3),
('Daily Formula Multivitamin', 'Universal Nutrition', 'Multivitaminas y minerales esenciales.', 15.99, '100 tabletas', 4),
('Iso Whey Zero', 'BioTechUSA', 'Proteína de suero aislada sin lactosa.', 68.50, '2.27 kg', 1),
('The Creatine Creapure', 'OstroVit', 'Creatina monohidrato micronizada.', 24.90, '300 g', 2),
('BCAA 2:1:1', 'Scitec Nutrition', 'Aminoácidos ramificados.', 32.00, '500 g', 1),
('Magnum Big C', 'Magnum Nutraceuticals', 'Creatina concentrada y de alta absorción.', 49.99, '100 capsulas', 2),
('Animal Pak', 'Universal Nutrition', 'Paquete de vitaminas, minerales y aminoácidos.', 45.00, '44 packs', 4),
('Protein Crunch Bar', 'Applied Nutrition', 'Barra de proteína crujiente.', 2.50, '60 g', 5);


-- estado
INSERT INTO estado (estado) VALUES
('Pendiente'),
('En Proceso'),
('Enviado'),
('Entregado'),
('Cancelado');

-- metodo_pago
INSERT INTO metodo_pago (metodo) VALUES
('Tarjeta de Crédito'),
('Tarjeta de Débito'),
('Transferencia Bancaria'),
('Contra Reembolso');

-- pedido
INSERT INTO pedido (cliente_id, dpi_empleado, producto, NIT, direccion_entrega, telefono, estado_id, metodo_pago_id, Total_pedido, observaciones) VALUES
(1, '2345678901234', 1, '1234567-8', 'Calle Falsa 123, Ciudad', '555-1111', 2, 1, 75.99, 'Entregar por la tarde.'),
(2, '2345678901234', 3, '2345678-9', 'Avenida Siempre Viva 456, Pueblo', '555-2222', 1, 3, 29.99, NULL),
(1, '3456789012345', 4, '1234567-8', 'Calle Falsa 123, Ciudad', '555-1111', 3, 2, 39.99, 'Dejar en conserjería.'),
(3, NULL, 5, '3456789-0', 'Bulevar de los Sueños Rotos 789, Aldea', '555-3333', 1, 4, 15.99, 'Llamar antes de entregar.'),
(2, '2345678901234', 2, '2345678-9', 'Avenida Siempre Viva 456, Pueblo', '555-2222', 4, 1, 54.99, NULL),
(1, '4567890123456', 6, '1234567-8', 'Calle Falsa 123, Ciudad', '555-1111', 3, 2, 68.50, 'Recoger en sucursal.');