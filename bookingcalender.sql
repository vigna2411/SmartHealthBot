-- phpMyAdmin SQL Dump
-- version 4.8.5

CREATE TABLE `bookings` (
  `name` varchar(100) NOT NULL,
  `timeslot` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hospital_doctor` varchar(100) NOT NULL,
  `date` varchar(25) NOT NULL
);

COMMIT;

