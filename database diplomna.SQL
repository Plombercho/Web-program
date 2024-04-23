CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
(1, 'Jason', 'Json@gmail.com', '$2y$10$Y9.pVGAYZE1DzgSSfXEJUONMNRsSikdw.KbM5LqNZpWzzpYLInH7u', 'about.jpg');

CREATE TABLE `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'SlimeBlaster', 'vikgal@gmail.com', '$2y$10$Y9.pVGAYZE1DzgSSfXEJUONMNRsSikdw.KbM5LqNZpWzzpYLInH7u');

CREATE TABLE `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `price` decimal(10) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `items` (`id`, `name`, `type`, `description`, `image_path`, `price`) VALUES
(1, 'Крик', 'car_tool', 'some descr', 'images/Крик за кола.jpg', 4031.00),
(2, 'Компресор', 'car_tool', 'some descr', 'images/Компресор.jpg', 96485.00),
(3, 'Помпа за гуми', 'car_tool', 'some descr', 'images/Помпа.jpg', 178550.00),
(4, 'Цифров мултиметър', 'car_tool', 'some descr', 'images/Цифров мултиметър.webp', 16520.00),
(5, 'Гаечни ключове', 'car_tool', 'some descr', 'images/Комплект гаечни ключове.jpg', 200000.00),
(6, 'Всесезонни гуми', 'car_part', 'some descr', 'images/Всесезонни гуми.jpg', 5130.00),
(7, 'Спортен въздушен филтър', 'car_part', 'some descr', 'images/Спортен филтър.jpg', 91995.00),
(8, 'Акумулаторна батерия', 'car_part', 'some descr', 'images/Акумулаторна батерия.jpg', 200000.00),
(9, 'Пооставка за чаша', 'car_accessory', 'some descr', 'images/Поставка за чаша.jpg', 5130.00),
(10, 'Поставка за телефон', 'car_accessory', 'some descr', 'images/Поставка за телефон.jpg', 91995.00),
(11, 'Камера за задно виждане', 'car_accessory', 'some descr', 'images/Камера за задно виждане.jpg', 75295.00),
(12, 'Аларма', 'car_accessory', 'some descr', 'images/Аларма за кола.jpg', 75295.00),
(13, 'Радио', 'car_accessory', 'some descr', 'images/Радио.jpg', 75295.00);


CREATE TABLE `users_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed') NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `status`, `quantity`) VALUES
(1, 1, 3, 'Added to cart', 1),
(2, 1, 4, 'Added to cart', 1),
(3, 1, 18, 'Added to cart', 1),
(4, 1, 14, 'Added to cart', 1);

ALTER TABLE users ADD COLUMN total_payments DECIMAL(10,2) NOT NULL DEFAULT 0.00;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;





