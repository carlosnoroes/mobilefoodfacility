-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Tempo de geração: 20/06/2024 às 18:39
-- Versão do servidor: 8.0.27
-- Versão do PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `challenge`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `permit`
--

CREATE TABLE `permit` (
  `locationid` int NOT NULL,
  `Applicant` text NOT NULL,
  `FacilityType` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `cnn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `LocationDescription` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Address` text NOT NULL,
  `blocklot` text,
  `block` text,
  `lot` text,
  `permit` text NOT NULL,
  `Status` tinytext NOT NULL,
  `FoodItems` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `X` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Y` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Latitude` decimal(10,8) DEFAULT NULL,
  `Longitude` decimal(10,6) DEFAULT NULL,
  `Schedule` text NOT NULL,
  `dayshours` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `NOISent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Approved` timestamp NULL DEFAULT NULL,
  `Received` date DEFAULT NULL,
  `PriorPermit` int DEFAULT NULL,
  `ExpirationDate` timestamp NULL DEFAULT NULL,
  `Location` text,
  `Fire Prevention Districts` int DEFAULT NULL,
  `Police Districts` int DEFAULT NULL,
  `Supervisor Districts` int DEFAULT NULL,
  `Zip Codes` int DEFAULT NULL,
  `Neighborhoods (old)` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
