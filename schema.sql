DROP DATABASE IF EXISTS readme;

CREATE DATABASE readme
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE readme;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  reg_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  email VARCHAR(128) NOT NULL UNIQUE,
  login VARCHAR(128) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  avatar_url VARCHAR(255)
) ENGINE=InnoDB COMMENT = 'Пользователь -- Представляет зарегистрированного пользователя.';

CREATE TABLE content_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128) NOT NULL UNIQUE,
  icon_class VARCHAR(128) NOT NULL UNIQUE
) ENGINE=InnoDB COMMENT = 'Тип контента -- Один из пяти предопределенных типов контента.';

CREATE TABLE posts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  add_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255),
  content TEXT NOT NULL,
  quote_author VARCHAR(128),
  photo_url VARCHAR(255),
  video_url VARCHAR(255),
  link VARCHAR(255),
  views_count INT UNSIGNED DEFAULT 0,
  user_id INT UNSIGNED NOT NULL,
  content_type_id INT UNSIGNED NOT NULL,
  hashtag_id INT UNSIGNED NOT NULL,

  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (content_type_id) REFERENCES content_types(id)
) ENGINE=InnoDB COMMENT = 'Пост -- Состоит из заголовка и содержимого. Набор полей, которые будут заполнены, зависит от выбранного типа.';

CREATE TABLE hashtags (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  tag_name VARCHAR(128) UNIQUE
) ENGINE=InnoDB COMMENT = 'Хештег -- Один из используемых хештегов на сайте. Сущность состоит только из названия хештега.';

CREATE TABLE posts_hashtags (
  post_id INT UNSIGNED NOT NULL PRIMARY KEY,
  hashtag_id INT UNSIGNED NOT NULL PRIMARY KEY,

  FOREIGN KEY (post_id) REFERENCES posts(id),
  FOREIGN KEY (hashtag_id) REFERENCES hashtags(id)
) ENGINE=InnoDB COMMENT = 'Связь вида «многие-ко-многим» между сущностями «Пост» и «Хештег»';

CREATE TABLE comments (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  add_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content TEXT NOT NULL,
  user_id INT UNSIGNED NOT NULL,
  post_id INT UNSIGNED NOT NULL,

  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (post_id) REFERENCES posts(id)
) ENGINE=InnoDB COMMENT = 'Комментарий -- Текстовый комментарий, оставленный к одному из постов.';

CREATE TABLE likes (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT UNSIGNED NOT NULL,
  post_id INT UNSIGNED NOT NULL,

  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (post_id) REFERENCES posts(id)
) ENGINE=InnoDB COMMENT = 'Лайк -- Эта сущность состоит только из связей и не имеет собственных полей.';

CREATE TABLE subscriptions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  follower_id INT UNSIGNED NOT NULL,
  author_id INT UNSIGNED NOT NULL,

  FOREIGN KEY (follower_id) REFERENCES users(id),
  FOREIGN KEY (author_id) REFERENCES users(id)
) ENGINE=InnoDB COMMENT = 'Подписка -- Эта сущность состоит только из связей и не имеет собственных полей. Сущность создается, когда пользователь подписывается на другого пользователя.';

CREATE TABLE messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  add_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content TEXT NOT NULL,
  sender_id INT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,

  FOREIGN KEY (sender_id) REFERENCES users(id),
  FOREIGN KEY (recipient_id) REFERENCES users(id)
) ENGINE=InnoDB COMMENT = 'Сообщение -- Одно сообщение из внутренней переписки пользователей на сайте.';
