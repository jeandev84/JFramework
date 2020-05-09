-- Добавляем колонку active в users --
alter table `users` 
    add column `active` tinyint(1) not null default 1 after `password`;