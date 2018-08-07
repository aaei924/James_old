-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 18-05-20 14:51
-- 서버 버전: 10.2.15-MariaDB-10.2.15+maria~xenial-log
-- PHP 버전: 7.2.5-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `ci_wikidev`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `back_link`
--

CREATE TABLE `back_link` (
  `no` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `config`
--

CREATE TABLE `config` (
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `discuss_content`
--

CREATE TABLE `discuss_content` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discuss_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `discuss_list`
--

CREATE TABLE `discuss_list` (
  `id` int(11) NOT NULL,
  `doc_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `acl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_modify` datetime NOT NULL DEFAULT current_timestamp(),
  `ACL` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `recentchange`
--

CREATE TABLE `recentchange` (
  `id` int(50) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_num` int(100) NOT NULL,
  `change_int` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `revision`
--

CREATE TABLE `revision` (
  `id` int(50) NOT NULL,
  `doc_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_num` int(100) NOT NULL,
  `r_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `change_int` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `back_link`
--
ALTER TABLE `back_link`
  ADD PRIMARY KEY (`no`);

--
-- 테이블의 인덱스 `discuss_content`
--
ALTER TABLE `discuss_content`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `discuss_list`
--
ALTER TABLE `discuss_list`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `recentchange`
--
ALTER TABLE `recentchange`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `revision`
--
ALTER TABLE `revision`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `back_link`
--
ALTER TABLE `back_link`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1332;

--
-- 테이블의 AUTO_INCREMENT `discuss_content`
--
ALTER TABLE `discuss_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 테이블의 AUTO_INCREMENT `discuss_list`
--
ALTER TABLE `discuss_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `recentchange`
--
ALTER TABLE `recentchange`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- 테이블의 AUTO_INCREMENT `revision`
--
ALTER TABLE `revision`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
