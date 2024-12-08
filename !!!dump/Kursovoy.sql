-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 03 2024 г., 19:06
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Kursovoy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int NOT NULL,
  `name_film` text NOT NULL,
  `username` text NOT NULL,
  `rating` float NOT NULL,
  `feedback` text NOT NULL,
  `admined` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name_film`, `username`, `rating`, `feedback`, `admined`) VALUES
(50, 'Твое имя', 'Admin', 5, 'yjtdjdtyjdtygfh', 1),
(51, 'Твое имя', 'Admin', 4, 'bdgfbdshdf', 1),
(52, 'Твое имя', 'Admin', 4, 'fassfda', 1),
(53, 'Твое имя', 'Admin', 3, 'fdghshdgfdfgdszf', 1),
(54, 'Твое имя', 'Admin', 5, 'hkjvvkjgyv,ivbhi', 1),
(55, 'Твое имя', 'Admin', 1, 'igfygfukfgyiugfiu', 1),
(56, 'Твое имя', 'Admin', 1, 'gfyiogujkglkj', 1),
(57, 'Твое имя', 'Admin', 2, 'jytjdrthyjdr', 1),
(58, 'Твое имя', 'Admin', 3, 'hyg7yhy87', 1),
(59, 'Твое имя', 'Admin', 5, 'hfcjfmhgfkctyktvtkj', 1),
(60, 'Твое имя', 'Admin', 4, 'ugfytrfuikgfyiuol', 1),
(61, 'Твое имя', 'Admin', 5, 'hfkrtiytiukrt98rf5yiukrtf98tfuyi', 1),
(62, 'онегкерке', 'Admin', 5, 'hrthjdrtdr', 1),
(63, 'Твое имя', 'Admin', 5, 'yjtdeikjytiujduyy', 1),
(64, 'онегкерке', 'Admin', 1, 'n mhgfmndxfg', 1),
(65, 'nyjrsmkjdt', 'sss', 5, 'dsgfsgvsf', 1),
(66, 'jy5tiokudt', 'Admin', 5, 'грнгр', 1),
(67, 'jy5tiokudt', 'Admin', 1, 'а', 1),
(68, 'Любовь и кофе', 'Admin', 5, 'Очень хороший фильм', 1),
(69, 'Любовь и кофе', 'Admin', 4, 'Фильм интересный но, есть несколько \"Но\"', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `rating` float NOT NULL,
  `genre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `name`, `rating`, `genre`) VALUES
(53, 'Любовь и кофе', 4.5, 'Комедия'),
(54, 'Дорога домой', 0, 'Драма'),
(55, 'Заколдованный лес', 0, 'Фэнтези'),
(56, 'Галактический путь', 0, 'Фантастика'),
(57, 'Шпионские игры', 0, 'Комедия'),
(58, 'Отражение в зеркале', 0, 'Драма'),
(59, 'Магия времени', 0, 'Фэнтези'),
(60, 'Космическая одиссея', 0, 'Фантастика'),
(61, 'Семейные тайны', 0, 'Комедия'),
(62, 'Погребенные в прошлом', 0, 'Драма'),
(63, 'Зачарованный мир', 0, 'Фэнтези'),
(64, 'Роботы-мародеры', 0, 'Фантастика'),
(65, 'Смешанные чувства', 0, 'Комедия'),
(66, 'Исцеление души', 0, 'Драма'),
(67, 'Потерянные артефакты', 0, 'Фэнтези'),
(69, 'Наследие искусственного интеллекта', 0, 'Фантастика');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `genre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'Комедия'),
(2, 'Драма'),
(3, 'Фэнтези'),
(4, 'Фантастика');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `permissions` text NOT NULL,
  `username` text NOT NULL,
  `pay_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ban` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `permissions`, `username`, `pay_date`, `ban`) VALUES
(1, 'Admin', 'admin', 'admin', 'Admin', 'Нет', 0),
(2, 'User', '123123', 'user', 'User', '03.07.2024', 0),
(12, 'sss', 'sss', 'user', 'sss', '13.06.2024', 0),
(14, 'nnn', 'nnn', 'user', 'nnn', '13.06.2024', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
