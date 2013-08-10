-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 10 2013 г., 15:06
-- Версия сервера: 5.5.28
-- Версия PHP: 5.3.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `market`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_category`
--

CREATE TABLE IF NOT EXISTS `sbv_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `nom` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `root` (`root`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `sbv_category`
--

INSERT INTO `sbv_category` (`id`, `root`, `level`, `parent`, `nom`, `title`) VALUES
(1, 4, 0, 0, 0, 'Разное'),
(2, 5, 2, 27, 9, 'Yii'),
(4, 1, 0, 0, 14, 'HTML'),
(9, 2, 0, 0, 13, 'Программы'),
(10, 3, 0, 0, 12, 'CSS'),
(20, 4, 1, 1, 1, 'уров=1'),
(16, 5, 0, 0, 3, '000'),
(17, 6, 3, 22, 18, '000 ур1'),
(23, 5, 2, 29, 7, 'в3'),
(22, 6, 2, 24, 17, 'нз2'),
(24, 6, 1, 34, 16, 'а1'),
(25, 5, 1, 16, 10, 'а2'),
(26, 5, 2, 29, 5, 'п3'),
(27, 5, 1, 16, 8, 'h1'),
(28, 0, 0, 0, 11, 'h2'),
(29, 5, 1, 16, 4, 'a4'),
(33, 5, 0, 0, 2, '14'),
(31, 5, 2, 29, 6, 'n5'),
(34, 6, 0, 0, 15, 'yyy'),
(35, 6, 1, 34, 19, 'q0');

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_comment`
--

CREATE TABLE IF NOT EXISTS `sbv_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_lookup`
--

CREATE TABLE IF NOT EXISTS `sbv_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `sbv_lookup`
--

INSERT INTO `sbv_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Черновик', 1, 'PostStatus', 1),
(2, 'Опубликовано', 2, 'PostStatus', 2),
(3, 'Архив', 3, 'PostStatus', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_new_category`
--

CREATE TABLE IF NOT EXISTS `sbv_new_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `parent` int(10) unsigned NOT NULL DEFAULT '0',
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `sbv_new_category`
--

INSERT INTO `sbv_new_category` (`id`, `level`, `parent`, `number`, `title`) VALUES
(1, 1, 0, 0, 'rrr');

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_post`
--

CREATE TABLE IF NOT EXISTS `sbv_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_category` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `metaTitle` varchar(255) NOT NULL DEFAULT '',
  `metaDescription` varchar(255) NOT NULL DEFAULT '',
  `metaKeywords` varchar(255) NOT NULL DEFAULT '',
  `tags` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `sbv_post`
--

INSERT INTO `sbv_post` (`id`, `id_category`, `title`, `description`, `content`, `metaTitle`, `metaDescription`, `metaKeywords`, `tags`, `status`, `create_time`, `update_time`, `author_id`) VALUES
(3, 1, 'Что выбрать: фреймворк или CMS', '<p>\r\n	Свое знакомство с сайтостроением я начал с написания простейшего кода на HTML. Сайт получился, естественно, статическим. Следующий проект делал уже на PHP. Времени на написание ушло много, в результате у меня начала создаваться собственная CMS. К сожалению, данный факт осмыслил не сразу. А как только понял, что приду к CMS, решил не изобретать велосипед, освоил Joomla и WordPress.</p>\r\n', '<p>\r\n	Свое знакомство с сайтостроением я начал с написания простейшего кода на HTML. Сайт получился, естественно, статическим. Следующий проект делал уже на PHP. Времени на написание ушло много, в результате у меня начала создаваться собственная CMS. К сожалению, данный факт осмыслил не сразу. А как только понял, что приду к CMS, решил не изобретать велосипед, освоил Joomla и WordPress.</p>\r\n<hr id="readmore" />\r\n<p>\r\n	&nbsp;Разработка стандартных сайтов (блогов, форумов и т.д.) пошла на ура. Но вся проблема оказалась в том, что многим заказчикам нужна некая особая, нестандартная функциональность. Реализовать которую в рамках данной CMS оказывается совсем непросто. Приходиться писать новые расширения или модифицировать существующий код. Времени такая работа занимает много, к тому же из-за взаимодействия с ядром CMS код не оптимальный. В общем, встал вопрос &ndash; что же проще &ndash; писать свою CMS или мучиться с существующими.</p>\r\n<p>\r\n	И тут я вспомнил о фреймворках. &nbsp;Фреймворк &ndash; это каркас для веб-приложения, а CMS &ndash; готовая система управления контентом. Наверное, можно фреймворк можно сравнить с кирпичами, из которых можно построить самые причудливые строения, а CMS &ndash; это стандартный дом.</p>\r\n<p>\r\n	После обзора самых популярных фреймворков я остановил свой выбор на Yii. Понравился достаточно строгий подход, относительная простота изучения (конечно, CodeIgniter осваивается легче, но возможности Yii богаче).</p>\r\n<p>\r\n	Теперь написать собственную, уникальную CMS стало гораздо проще. Конечно, стандартные проекты быстрее реализовать на готовой CMS, но многие проекты имею тенденцию превращаться из стандартных в нестандартные.</p>\r\n<p>\r\n	Этот блог я написал на Yii. А вот другой мой блог &ndash; netopus.ru написан CMS WordPress. Использовалась одна из бесплатных тем для WordPress.</p>\r\n', '0', '0', '0', 'фреймворк, CMS', 2, '2011-11-23 13:15:19', '2011-11-28 12:34:05', 23),
(2, 2, 'Хлебные крошки в Yii', '<p>\r\n	Хлебные крошки (Breadcrumbs) &ndash; это строка навигации до текущей страницы, сделанная из ссылок на родительские элементы. В Yii есть удобное средство для работы с хлебными крошками &ndash; виджет zii&nbsp; CBreadcrumbs http://www.yiiframework.com/doc/api/1.1/CBreadcrumbs<br />\r\n	Хочу описать, как подключить CBreadcrumbs.</p>\r\n', '<p>\r\n	Хлебные крошки (Breadcrumbs) &ndash; это строка навигации до текущей страницы, сделанная из ссылок на родительские элементы. В Yii есть удобное средство для работы с хлебными крошками &ndash; виджет zii&nbsp; CBreadcrumbs http://www.yiiframework.com/doc/api/1.1/CBreadcrumbs<br />\r\n	Хочу описать, как подключить CBreadcrumbs.</p>\r\n<hr id="readmore" />\r\n<p>\r\n	В контроллере определяем общедоступную переменную-массив хлебных крошек. public $breadcrumbs=array();<br />\r\n	В layout view вставляем</p>\r\n<div class="highlight">\r\n	<pre class="brush:php">\r\n	&lt;?php if(isset($this-&gt;breadcrumbs)):?&gt;\r\n		&lt;?php $this-&gt;widget(&#39;zii.widgets.CBreadcrumbs&#39;, array(\r\n			&#39;links&#39;=&gt;$this-&gt;breadcrumbs,\r\n                        &#39;homeLink&#39;=&gt;CHtml::link(&#39;Главная&#39;,&#39;/&#39; ),\r\n		)); ?&gt;&lt;!-- breadcrumbs --&gt;\r\n	&lt;?php endif?&gt;</pre>\r\n</div>\r\n<p>\r\n	Здесь links &ndash; массив ссылок навигации, мы берём его из текущего контроллера.<br />\r\n	homeLink &ndash; ссылка на главную страницу.<br />\r\n	Теперь во view не забываем определить массив:</p>\r\n<div class="highlight">\r\n	<pre class="brush:php">\r\n$this-&gt;breadcrumbs=array(\r\n	&#39;Записи&#39;=&gt;array(&#39;index&#39;),\r\n	$model-&gt;title,\r\n);</pre>\r\n</div>\r\n<p>\r\n	Вот и всё.</p>\r\n', '0', '0', '0', 'Yii, Breadcrumbs', 2, '2011-11-26 10:06:15', '2013-01-15 22:18:41', 23),
(4, 2, 'Как подключить Ckeditor к фреймворку Yii', '<p>\r\n	Часто возникает необходимость использовать визуальный редактор на сайте. Есть несколько весьма популярных WYSIWYNG-редакторов. Один из них &ndash; Ckeditor. Сегодня я расскажу, как подключить Ckeditor к Yii.</p>\r\n', '<p>\r\n	Часто возникает необходимость использовать визуальный редактор на сайте. Есть несколько весьма популярных WYSIWYNG-редакторов. Один из них &ndash; Ckeditor. Сегодня я расскажу, как подключить Ckeditor к Yii.</p>\r\n<hr id="readmore" />\r\n<p>\r\n	Шаг первый: скачиваем сам редактор с официального сайта: <a href="http://ckeditor.com/download" target="_blank">http://ckeditor.com/download</a><br />\r\n	Распаковываем архив в корень сайта.<br />\r\n	Шаг второй: скачиваем расширение Yii ckeditor-integration <a href="http://www.yiiframework.com/extension/ckeditor-integration/">отсюда</a>.<br />\r\n	Распаковываем в папку protected/extensions.<br />\r\n	Шаг третий: подключаем к форме наш редактор:</p>\r\n<div class="highlight">\r\n	<pre class="brush: php">\r\n&lt;?php\r\n$this-&gt;widget(&#39;ext.ckeditor.CKEditorWidget&#39;,array(\r\n  &quot;model&quot;=&gt;$model,                 # Модель данных\r\n  &quot;attribute&quot;=&gt;&#39;content&#39;,          # Аттрибут в модели\r\n  &quot;defaultValue&quot;=&gt;$model-&gt;content, #Значение по умолчанию\r\n \r\n  &quot;config&quot; =&gt; array(\r\n      &quot;height&quot;=&gt;&quot;400px&quot;,\r\n      &quot;width&quot;=&gt;&quot;100%&quot;,\r\n      &quot;toolbar&quot;=&gt;&quot;Full&quot;, #панель инструментов\r\n      &quot;defaultLanguage&quot;=&gt;&quot;ru&quot;, # Язык по умолчанию\r\n      ), \r\n   &quot;ckEditor&quot;=&gt;Yii::app()-&gt;basePath.&quot;/../ckeditor/ckeditor.php&quot;,\r\n                                  # Путь к ckeditor.php\r\n  &quot;ckBasePath&quot;=&gt;Yii::app()-&gt;baseUrl.&quot;/ckeditor/&quot;,\r\n                                  # адрес к редактору\r\n  ) ); ?&gt;</pre>\r\n</div>\r\n<div class="code">\r\n	Все параметры конфига редактора смотрим <a href="http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html">здесь</a></div>\r\n', '0', '0', '0', 'Yii, Ckeditor', 2, '2011-11-23 13:20:50', '2013-01-16 23:13:55', 23),
(6, 5, 'Проверка архива', '<p>\r\n	Это проверка Проверка архива</p>\r\n', '<p>\r\n	Это проверка Проверка архива</p>\r\n<hr id="readmore" />\r\n<p>\r\n	Конец.</p>\r\n', '0', '0', '0', 'архива', 2, '2011-12-03 16:56:29', '2011-12-03 16:56:29', 23),
(7, 2, 'Форматирование даты и времени в Yii', '<p>\r\n	Передо мной встала такая задача: как в Yii вывести дату, отформатированную в родном, русском формате. Оказывается, очень просто. Во-первых, надо установить русский язык в конфигурационном файле приложения, и, во-вторых, воспользоваться методом компонента&nbsp; приложения CDateFormatter-&gt;format().</p>\r\n', '<p>\r\n	Передо мной встала такая задача: как в Yii вывести дату, отформатированную в родном, русском формате. Оказывается, очень просто. Во-первых, надо установить русский язык в конфигурационном файле приложения, и, во-вторых, воспользоваться методом компонента&nbsp; приложения CDateFormatter-&gt;format().</p>\r\n<hr id="readmore" />\r\n<p>\r\n	Итак, приступим. В конфигурационном файле пропишем две строчки, которые установят русификацию для сайта:</p>\r\n<div class="highlight">\r\n	<pre class="brush: php">\r\n   &#39;sourceLanguage&#39; =&gt; &#39;en&#39;,\r\n    &#39;language&#39; =&gt; &#39;ru&#39;,</pre>\r\n</div>\r\n<p>\r\n	Здесь sourceLanguage &ndash; язык, на котором написан сам сайт. У меня он, естественно, английский. Ну а текущий язык &ndash; language &ndash; русский.<br />\r\n	Теперь в том месте, где хотим вывести отформатированную дату, добавим такой код:\r\n<div class="highlight">\r\n	<pre class="brush: php">\r\n	echo Yii::app()-&gt;dateFormatter-&gt;format(&quot;dd MMMM y, HH:mm&quot;, $vardatetime);</pre>\r\n</div>\r\n	Выведет дату и время в таком формате:&nbsp; 29 ноября 2011, 16:41<br />\r\n	Метод format принимает два параметра: первый &ndash; шаблон времени в стандарте Юникода, второй &ndash; время в unix timestamp или Mysql DATETIME. Вот и всё.<br />\r\n	Более подробно о CDateFormatter смотрите <a href="http://www.yiiframework.com/doc/api/1.1/CDateFormatter" target="_blank">здесь</a><br />\r\n	&nbsp;</p>\r\n', '0', '0', '0', 'Yii, формат, дата', 2, '2012-02-25 15:28:38', '2013-01-15 22:41:48', 23),
(8, 9, 'NotePad++', '<p>\r\n	Часто возникает необходимость быстрой перекодировки файла (например, из ansi в utf8, или наоборот). Есть замечательный (и притом бесплатный) редактор - NotePad++. С помощью него можно легко перекодировать файл из одной кодировки в другую. В этом редакторе есть даже подсветка кода. Конечно, я предпочитаю работать где-нибудь в Adobe Dreamweaver, NuSphere PHPED или в NetBeans. Но эти монстры подолгу грузятся, а иногда хочется быстро подправить код и тут же закрыть файл. Для этого как раз подойдёт NotePad++</p>\r\n', '<p>\r\n	Часто возникает необходимость быстрой перекодировки файла (например, из ansi в utf8, или наоборот). Есть замечательный (и притом бесплатный) редактор - NotePad++. С помощью него можно легко перекодировать файл из одной кодировки в другую. В этом редакторе есть даже подсветка кода. Конечно, я предпочитаю работать где-нибудь в Adobe Dreamweaver, NuSphere PHPED или в NetBeans. Но эти монстры подолгу грузятся, а иногда хочется быстро подправить код и тут же закрыть файл. Для этого как раз подойдёт NotePad++</p>\r\n<hr id="readmore" />\r\n<p>\r\n	Есть одна особенность перекодирования в utf8. Для преобразования кодировки&nbsp; файла выбираем в меню &laquo;Кодировки&raquo;-&gt; &laquo;Преобразовать в utf8&nbsp; без BOM&raquo;. Если выбрать просто &laquo;Преобразовать в utf8&raquo;, тогда случиться трагедия &ndash; страница перестанет правильно отображаться в браузере. Преобразование в ANSI таких проблем не имеет &ndash; есть только одно действие.<br />\r\n	Программа качается <a href="http://notepad-plus-plus.org/download/" target="_blank">отсюда</a>.<br />\r\n	&nbsp;</p>\r\n', '0', '0', '0', 'редактор, кодировка', 2, '2012-02-25 15:34:43', '2012-02-25 15:34:43', 23),
(9, 10, 'CSS – линейный градиент фона', '<p>\r\n	Как сделать градиент фону, не прибегая к помощи фоновых рисунков? Современные браузеры поддерживают градиентную заливку с помощью CSS.</p>\r\n', '<p>\r\n	Как сделать градиент фону, не прибегая к помощи фоновых рисунков? Современные браузеры поддерживают градиентную заливку с помощью CSS.</p>\r\n<hr id="readmore" />\r\n<div class="highlight">\r\n	<pre class="brush: css">\r\nbackground:#EFEFEF; /*цвет фона кнопки для браузеров без поддержки CSS3*/\r\nbackground: -webkit-gradient(linear, left top, left bottom, from(#3437CD), to(#538BFF)); /* для Webkit браузеров */\r\nbackground: -moz-linear-gradient(top,  #3437CD, #538BFF); /* для Firefox */\r\nbackground-image: -o-linear-gradient(top,  #3437CD,  #538BFF); /* для Opera 11 */\r\nfilter:  progid:DXImageTransform.Microsoft.gradient(startColorstr=&#39;#3437CD&#39;, endColorstr=&#39;#538BFF&#39;); /* фильтр для IE */\r\n\r\n</pre>\r\n</div>\r\n<p>\r\n	Чтобы сохранить&nbsp; кроссбраузерность, приходиться писать под каждый интернет-браузер отдельное правило CSS. Особо обрабатывается IE.&nbsp; В каждом правиле участвует два цвета &ndash; начальный и конечный.</p>\r\n', '0', '0', '0', 'градиент, css', 2, '2012-02-25 17:03:11', '2013-01-15 22:42:46', 23),
(14, 1, 'rrr', '<p>\r\n	rrrr</p>\r\n', '<p>\r\n	rrrr</p>\r\n', '', '', '', 'a', 1, '2013-01-19 18:37:12', '2013-01-19 18:37:12', 23);

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_tag`
--

CREATE TABLE IF NOT EXISTS `sbv_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `frequency` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `sbv_tag`
--

INSERT INTO `sbv_tag` (`id`, `name`, `frequency`) VALUES
(9, 'CMS', 1),
(7, 'Breadcrumbs', 1),
(3, 'ckeditor', 1),
(8, 'фреймворк', 1),
(10, 'архива', 1),
(6, 'Yii', 3),
(11, 'формат', 1),
(12, 'дата', 1),
(13, 'редактор', 1),
(14, 'кодировка', 1),
(15, 'градиент', 1),
(16, 'css', 1),
(17, 'a', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `sbv_user`
--

CREATE TABLE IF NOT EXISTS `sbv_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `sbv_user`
--

INSERT INTO `sbv_user` (`id`, `username`, `password`, `email`, `profile`) VALUES
(1, 'test1', 'pass1', 'test1@example.com', ''),
(2, 'test2', 'pass2', 'test2@example.com', ''),
(23, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'XeDmitry@yandex.ru', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
