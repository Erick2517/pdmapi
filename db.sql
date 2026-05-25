
CREATE TABLE Roles (
    id_rol INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre_rol TEXT NOT NULL UNIQUE
);

CREATE TABLE Ubicaciones (
    id_ubicacion INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre_ubicacion TEXT NOT NULL UNIQUE,
    descripcion TEXT
);

CREATE TABLE Usuarios (
    id_usuario INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    carnet TEXT NOT NULL UNIQUE,
    id_rol INTEGER NOT NULL,
    id_ubicacion INTEGER,
    activo INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol),
    FOREIGN KEY (id_ubicacion) REFERENCES Ubicaciones(id_ubicacion)
);

CREATE TABLE Locales (
    id_local INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre_local TEXT NOT NULL,
    ubicacion TEXT NOT NULL,
    descripcion TEXT,
    estado TEXT NOT NULL
);

CREATE TABLE Productos (
    id_producto INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre_producto TEXT NOT NULL,
    precio REAL NOT NULL,
    disponibilidad TEXT NOT NULL,
    tipo TEXT NOT NULL,
    stock INTEGER NOT NULL DEFAULT 0,
    id_local INTEGER NOT NULL,
    FOREIGN KEY (id_local) REFERENCES Locales(id_local)
);

CREATE TABLE Pedidos (
    id_pedido INTEGER PRIMARY KEY AUTO_INCREMENT,
    fecha_pedido TEXT NOT NULL,
    tipo_pedido TEXT NOT NULL,
    estado_pedido TEXT NOT NULL,
    total REAL NOT NULL,
    id_usuario INTEGER NOT NULL,
    id_ubicacion INTEGER,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_ubicacion) REFERENCES Ubicaciones(id_ubicacion)
);

CREATE TABLE Detalle_Pedido (
    id_detalle_pedido INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_pedido INTEGER NOT NULL,
    id_producto INTEGER NOT NULL,
    cantidad INTEGER NOT NULL,
    precio_unitario REAL NOT NULL,
    subtotal REAL NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

CREATE TABLE Pagos (
    id_pago INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_pedido INTEGER NOT NULL,
    metodo_pago TEXT NOT NULL,
    monto REAL NOT NULL,
    fecha_pago TEXT NOT NULL,
    referencia TEXT,
    estado_pago TEXT NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido)
);

CREATE TABLE Pedidos_Especiales (
    id_pedido_especial INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_pedido INTEGER NOT NULL,
    descripcion_evento TEXT NOT NULL,
    fecha_evento TEXT NOT NULL,
    hora_evento TEXT,
    numero_personas INTEGER,
    monto_minimo REAL NOT NULL,
    monto_maximo REAL NOT NULL,
    anticipo REAL NOT NULL,
    referencia_pago TEXT,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido)
);


INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES (NULL, 'Usuario');
INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES (NULL, 'Administrador');
INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES (NULL, 'Encargado');

INSERT INTO `ubicaciones`(`nombre_ubicacion`, `descripcion`) values ('Campus Central', 'Ubicación general dentro del campus universitario.');
INSERT INTO `ubicaciones`(`nombre_ubicacion`, `descripcion`) values ('Facultad de Ingeniería', 'Zona de Ingeniería dentro del campus universitario.');

INSERT INTO `usuarios`(`nombre`, `email`, `password`, `carnet`, `id_rol`, `id_ubicacion`) VALUES ("Administrador Sistema", "admin@ues.edu.sv", sha2('Admin123', 256),"AD00001",2,1);
INSERT INTO `usuarios`(`nombre`, `email`, `password`, `carnet`, `id_rol`, `id_ubicacion`) VALUES ("Encargado Cafetín","encargado@ues.edu.sv", sha2("Encargado123",256),"EN00001",3,1);

INSERT INTO `locales`(`nombre_local`, `ubicacion`, `descripcion`, `estado`) VALUES ("Cafetín Central", "Plaza central", "Local principal con desayunos, almuerzos y bebidas.", "Activo");
INSERT INTO `locales`(`nombre_local`, `ubicacion`, `descripcion`, `estado`) VALUES ("Cafetín Ingeniería", "Facultad de Ingeniería", "Local cercano a edificios de aulas y laboratorios.", "Activo");
INSERT INTO `locales`(`nombre_local`, `ubicacion`, `descripcion`, `estado`) VALUES ("Cafetín Biblioteca", "Biblioteca central", "Punto de venta de refrigerios y bebidas.", "Activo");

INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Desayuno típico", 2.50, "Disponible", "Desayuno", 20, 1);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Café americano", 0.75, "Disponible", "Bebida", 35, 1);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Empanadas de leche", 1.00, "Disponible", "Antojito", 12, 1);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Sándwich de pollo", 2.25, "Disponible", "Almuerzo", 18, 2);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Jugo natural", 1.00, "Disponible", "Bebida", 25, 2);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Nuegados", 1.25, "Disponible", "Antojito", 10, 2);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Pan dulce", 0.60, "Disponible", "Refrigerio", 30, 3);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Chocolate caliente", 0.90, "Disponible", "Bebida", 20, 3);
INSERT INTO `productos` (`nombre_producto`,`precio`,`disponibilidad`, `tipo`, `stock`, `id_local`) values ("Tamal de elote", 1.50, "No disponible", "Antojito", 0, 3);
