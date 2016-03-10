-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Mars 2016 à 11:29
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

--
-- Structure de la table `osofflineim_message`
--

CREATE TABLE IF NOT EXISTS `osofflineim_message` (
  `uuid` varchar(36) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour la table `osofflineim_message`
--
ALTER TABLE `osofflineim_message`
 ADD KEY `uuid` (`uuid`);
