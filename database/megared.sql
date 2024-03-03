SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `producto` (
  `id` int(11) NOT NULL,  
  `nombre` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,    
  `cliente_id` int NOT NULL,      
  `valor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `venta_producto` (
  `id` int(11) NOT NULL,    
  `venta_id` int NOT NULL,      
  `producto_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `venta_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `venta`
  ADD CONSTRAINT fk_cliente_id
  FOREIGN KEY (cliente_id) REFERENCES cliente(id);

ALTER TABLE `venta_producto`
  ADD CONSTRAINT fk_venta_id
  FOREIGN KEY (venta_id) REFERENCES venta(id);

ALTER TABLE `venta_producto`
  ADD CONSTRAINT fk_producto_id
  FOREIGN KEY (producto_id) REFERENCES producto(id);

COMMIT;

