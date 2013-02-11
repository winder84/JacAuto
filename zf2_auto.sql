-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Фев 11 2013 г., 23:13
-- Версия сервера: 5.5.29
-- Версия PHP: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `zf2_auto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `is_on_main` tinyint(1) NOT NULL,
  `on_main_image` varchar(250) NOT NULL,
  `ref_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `image`, `is_on_main`, `on_main_image`, `ref_id`) VALUES
(1, 'HUNTER PA100 DSP504', 'Стенд развала-схождения  Hunter PA100 с инфракрасной измерительной системой DSP504 является отличным инструментом для автосервисов среднего уровня. Комбинация полнофункциональных датчиков DSP 504 и экономичной компьютерной стойки Hunter PA100 позволяет добиться превосходных результатов при минимуме затрат.\r\n\r\nВ базовом комплекте со стендом поставляются самоцентрирующиеся захваты на колеса, позволяющие обслуживать колеса до 24½".\r\n\r\nИнфракрасные датчики DSP 508 позволяют измерять схождение с точностью до 1''. Цифровая обработка датчиков схождения гарантирует большую надежность и стабильность показаний, что при аккуратном обращении гарантирует минимум обращений за калибровкой системы.', 'launch_5.jpeg', 0, '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
