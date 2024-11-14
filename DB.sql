--CREATE DATABASE Admin_Users;
USE Admin_Users;
GO
CREATE TABLE departamentos (
    id INT IDENTITY(1,1) PRIMARY KEY,
    codigo NVARCHAR(50) NOT NULL,       
    nombre NVARCHAR(100) NOT NULL,      
    activo BIT NOT NULL DEFAULT 1,     
    idUsuarioCreacion INT NOT NULL,     
    created_at DATETIME DEFAULT GETDATE(),  
    updated_at DATETIME DEFAULT GETDATE()   
);

INSERT INTO departamentos (codigo, nombre, activo, idUsuarioCreacion)
VALUES 
    ('D01', 'Ventas', 1, 1),
    ('D02', 'Marketing', 1, 2),
    ('D03', 'Recursos Humanos', 1, 3),
    ('D04', 'TI', 1, 4),
    ('D05', 'Finanzas', 1, 5);

Select * from departamentos;

CREATE TABLE cargos (
    id INT IDENTITY(1,1) PRIMARY KEY,   -- ID autoincremental
    codigo NVARCHAR(50) NOT NULL,        -- Código de texto
    nombre NVARCHAR(100) NOT NULL,       -- Nombre de texto
    activo BIT NOT NULL DEFAULT 1,       -- Activo (booleano)
    idUsuarioCreacion INT NOT NULL,      -- idUsuarioCreacion numérico
    created_at DATETIME DEFAULT GETDATE(),  -- Fecha de creación
    updated_at DATETIME DEFAULT GETDATE()   -- Fecha de actualización
);

INSERT INTO cargos (codigo, nombre, activo, idUsuarioCreacion)
VALUES 
    ('C01', 'Gerente', 1, 1),   
    ('C02', 'Desarrollador Backend', 1, 2),  
    ('C03', 'Desarrollador Frontend', 1, 3), 
    ('C04', 'Lider de proyecto', 1, 4),   
    ('C05', 'RRHH', 1, 5);

CREATE TABLE users (
    id INT IDENTITY(1,1) PRIMARY KEY,           -- id numérico, autoincremental
    usuario NVARCHAR(100) NOT NULL,              -- usuario de texto
    primerNombre NVARCHAR(100) NOT NULL,         -- primer nombre de texto
    segundoNombre NVARCHAR(100),                 -- segundo nombre de texto (opcional)
    primerApellido NVARCHAR(100) NOT NULL,       -- primer apellido de texto
    segundoApellido NVARCHAR(100),               -- segundo apellido de texto (opcional)
    idDepartamento INT NOT NULL,                 -- id del departamento (numérico)
    idCargo INT NOT NULL,                        -- id del cargo (numérico)
    created_at DATETIME DEFAULT GETDATE(),       -- fecha de creación
    updated_at DATETIME DEFAULT GETDATE(),       -- fecha de actualización
    FOREIGN KEY (idDepartamento) REFERENCES departamentos(id),  -- clave foránea a la tabla departamentos
    FOREIGN KEY (idCargo) REFERENCES cargos(id)  -- clave foránea a la tabla cargos
);

INSERT INTO users (usuario, primerNombre, segundoNombre, primerApellido, segundoApellido, idDepartamento, idCargo)
VALUES
('juanperez', 'Juan', 'Carlos', 'Pérez', 'López', 1, 1),
('mariaflores', 'María', NULL, 'Flores', 'González', 2, 2);

SELECT 
    fk.name AS 'FK_constraint_name',
    tp.name AS 'parent_table',
    ref.name AS 'referenced_table'
FROM 
    sys.foreign_keys AS fk
INNER JOIN 
    sys.tables AS tp ON fk.parent_object_id = tp.object_id
INNER JOIN 
    sys.tables AS ref ON fk.referenced_object_id = ref.object_id;

--De prueba
SELECT u.id, u.usuario, u.primerNombre, u.idDepartamento, d.nombre AS departamento, u.idCargo, c.nombre AS cargo
FROM users u
JOIN departamentos d ON u.idDepartamento = d.id
JOIN cargos c ON u.idCargo = c.id;

CREATE TABLE emails (
    id INT IDENTITY(1,1) PRIMARY KEY,      -- ID autoincremental
    email NVARCHAR(255) NOT NULL,           -- Dirección de correo electrónico
    idUsuario INT NULL,                    -- Relacionado con id de usuarios (puede ser NULL si no es para un usuario)
    idDepartamento INT NULL,                -- Relacionado con id de departamentos (puede ser NULL si no es para un departamento)
    tipo NVARCHAR(50) NULL,                 -- Tipo de email (por ejemplo: 'personal', 'corporativo', etc.)
    activo BIT NOT NULL DEFAULT 1,          -- Activo (booleano)
    created_at DATETIME DEFAULT GETDATE(), -- Fecha de creación
    updated_at DATETIME DEFAULT GETDATE(), -- Fecha de actualización
    FOREIGN KEY (idUsuario) REFERENCES users(id),          -- Relación con la tabla users
    FOREIGN KEY (idDepartamento) REFERENCES departamentos(id) -- Relación con la tabla departamentos
);
INSERT INTO emails (email, idDepartamento, tipo, activo)
VALUES 
    ('ventas@example.com', 1, 'corporativo', 1),  
    ('marketing@example.com', 2, 'corporativo', 1);

SELECT 
    e.email, 
    u.usuario, 
    d.nombre AS departamento, 
    e.tipo, 
    e.activo
FROM emails e
LEFT JOIN users u ON e.idUsuario = u.id
LEFT JOIN departamentos d ON e.idDepartamento = d.id;

INSERT INTO users (usuario, primerNombre, segundoNombre, primerApellido, segundoApellido, idDepartamento, idCargo)
VALUES 
    ('jdoe', 'John', 'Michael', 'Doe', 'Smith', 1, 3),  
    ('bsmith', 'Barbara', 'Ann', 'Smith', 'Johnson', 2, 4); 

INSERT INTO emails (email, idUsuario, tipo, activo)
VALUES 
    ('jdoe@example.com', 3, 'corporativo', 1),  
    ('bsmith@example.com', 4, 'personal', 1);

INSERT INTO emails (email, idDepartamento, tipo, activo)
VALUES 
    ('ventas@example.com', 3, 'corporativo', 1), 
    ('marketing@example.com', 4, 'corporativo', 1);

SELECT 
    u.usuario, 
    COALESCE(u.primerNombre, '') + ' ' + COALESCE(u.segundoNombre, '') AS nombres, 
    COALESCE(u.primerApellido, '') + ' ' + COALESCE(u.segundoApellido, '') AS apellidos, 
    d.nombre AS departamento, 
    c.nombre AS cargo, 
    e.email
FROM users u
JOIN departamentos d ON u.idDepartamento = d.id
JOIN cargos c ON u.idCargo = c.id
LEFT JOIN emails e ON e.idUsuario = u.id;

SELECT e.email, e.idUsuario, u.usuario 
FROM emails e
JOIN users u ON e.idUsuario = u.id;

UPDATE emails 
SET email = 'juanperez@example.com' 
WHERE idUsuario = 1;  -- Asignar email a usuario con id = 1

UPDATE emails 
SET email = 'mariaflores@example.com' 
WHERE idUsuario = 2;  -- Asignar email a usuario con id = 2

SELECT 
    u.usuario, 
    COALESCE(u.primerNombre, '') + ' ' + COALESCE(u.segundoNombre, '') AS nombres, 
    COALESCE(u.primerApellido, '') + ' ' + COALESCE(u.segundoApellido, '') AS apellidos, 
    d.nombre AS departamento, 
    c.nombre AS cargo, 
    e.email
FROM users u
JOIN departamentos d ON u.idDepartamento = d.id
JOIN cargos c ON u.idCargo = c.id
LEFT JOIN emails e ON e.idUsuario = u.id;


DROP TABLE users;


