
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

