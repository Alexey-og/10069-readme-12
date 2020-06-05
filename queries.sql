USE readme;

/* Список типов контента для поста */

INSERT INTO content_types
  (name, icon_class)
VALUES
  ('Текст', 'text'),    /* content_type_id = 1 */
  ('Цитата', 'quote'),    /* content_type_id = 2 */
  ('Картинка', 'photo'),    /* content_type_id = 3 */
  ('Видео', 'video'),    /* content_type_id = 4 */
  ('Ссылка', 'link');    /* content_type_id = 5 */


/* Заполнение пользователей из data.php (дата придумана) */

INSERT INTO users
  (reg_date, email, login, password, avatar_url)
VALUES
  ('2020-02-11 13:34:54', 'lara20200211@mail.ru', 'Лариса', '1234567890', 'userpic-larisa-small.jpg'),    /* user_id = 1 */
  ('2019-10-23 15:22:13', 'vladgeniy@yandex.ru', 'Владик', 'VladVladVlad', 'userpic.jpg'),    /* user_id = 2 */
  ('2003-04-22 02:50:22', 'viktor_foto@gmail.com', 'Виктор', 'VvIiKkTtOoRrPSD', 'userpic-mark.jpg');    /* user_id = 3 */


/* Добавление выдуманных пользователей */

INSERT INTO users
  (reg_date, email, login, password, avatar_url)
VALUES
  ('1997-09-23 12:34:56', 'supervisor@yandex.ru', 'Аркаша', 'U3VwZXJBcmthc2hh', 'userpic-arkasha.jpg'),    /* user_id = 4 */
  ('2006-10-10 14:41:14', 'pasha@spb.ru', 'Павел', 'GfifDRjynfrnt', 'userpic-pasha_spb.jpg'),    /* user_id = 5 */
  ('1998-09-04 10:25:54', 'srgbrn@stfrd.org', 'Сергей', 'BaCKRuB1e100', 'userpic-srgbrn.jpg');    /* user_id = 6 */


/* Заполнение постов из data.php (дата и количество просмотров придуманы) */

INSERT INTO posts
  (add_date, title, content_type_id, content, views_count, user_id)
VALUES
  ('2020-06-05 10:34:44', 'Цитата', 2, 'Мы в жизни любим только раз, а после ищем лишь похожих', 18, 1),
  ('2020-06-05 11:35:21', 'Игра престолов', 1, 'Не могу дождаться начала финального сезона своего любимого сериала!', 9899, 2),
  ('2020-05-28 03:33:32', 'Наконец, обработал фотки!', 3, 'rock-medium.jpg', 230, 3),
  ('2020-04-11 10:37:23', 'Моя мечта', 3, 'coast-medium.jpg', 7120, 1),
  ('2020-02-22 15:11:34', 'Лучшие курсы', 5, 'www.htmlacademy.ru', 3030, 2);


/* Выдуманные комментарии к разным постам */

INSERT INTO comments
  (add_date, content, user_id, post_id)
VALUES
  ('2019-01-25 14:25:40', 'Есть только один способ избежать критики: ничего не делайте, ничего не говорите и будьте никем.', 3, 5),
  ('2020-05-09 09:09:09', 'В моем словаре нет слова «невозможно».', 1, 5),
  ('2020-03-08 10:12:45', 'Успех — это способность идти от поражения к поражению, не теряя оптимизма', 4, 2),
  ('2012-07-03 11:45:23', 'Влюбленная женщина слышит и то, чего ты еще не сказал.', 1, 1),
  ('2019-09-12 14:19:56', 'Умной женщине комплименты служат для оценки мужчин, глупой - для самооценки.', 1, 4),
  ('2018-11-21 17:44:31', 'Дайте женщине зеркало и несколько конфет, и она будет довольна.', 1, 3),
  ('2017-08-27 13:26:42', 'Знать, что нужно сделать, и не делать этого — худшая трусость.', 2, 2),
  ('2016-05-23 15:31:23', 'Глядя в прошлое - снимите шляпу, глядя в будущее - засучите рукава!', 6, 4),
  ('2018-02-22 16:12:34', 'Начать всё с нуля — это не безумие.', 5, 5),
  ('2017-06-12 19:06:34', 'Самые сильные оправдания придумывают люди со слабым характером!', 6, 4);


/* Список постов с сортировкой по популярности и вместе с именами авторов и типом контента */

SELECT u.login, p.title, p.content, c.name, p.views_count
FROM posts AS p, users AS u, content_types AS c
WHERE p.user_id=u.id AND p.content_type_id=c.id
ORDER BY p.views_count DESC;


/* Список постов для конкретного пользователя */

SELECT p.add_date, p.title, p.content, c.name, p.views_count
FROM posts AS p, content_types AS c
WHERE p.content_type_id=c.id AND user_id = 1;


/* Список комментариев для одного поста, в комментариях - логин пользователя */

/* SELECT p.title, p.content, c.add_date, c.content, u.login
FROM posts AS p, comments AS c, users AS u
WHERE c.user_id=u.id AND c.post_id=p.id AND c.post_id=5; */

SELECT p.title, p.content, c.add_date, c.content, u.login
FROM comments AS c
JOIN posts AS p ON c.post_id=p.id
JOIN users AS u ON c.user_id=u.id
WHERE c.post_id=5;


/* Добавление лайка к посту */

INSERT INTO likes (user_id, post_id)
VALUES (2, 1);


/* Подписка на пользователя */

INSERT INTO subscriptions (follower_id, author_id)
VALUES (3, 1);
