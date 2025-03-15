-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 01:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worklink`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin') NOT NULL DEFAULT 'admin',
  `phone` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `user_type`, `phone`, `created_at`) VALUES
(1, 'shruti chavda', 'schavda684@rku.ac.in', '123', 'admin', 1234567890, '2025-03-15 10:33:04');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER ` after_admin_insert` AFTER INSERT ON `admin` FOR EACH ROW BEGIN  
    INSERT INTO users (user_type, full_name, email, phone, password)  
    VALUES ('admin', NEW.full_name, NEW.email, NEW.phone, NEW.password);  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, 'Amit Kumar', 'amit@example.com', '9876543210', 'Looking for job opportunities', '2025-03-14 15:54:25'),
(2, 'Suman Sharma', 'suman@example.com', '9786543210', 'Need details on PMKVY scheme', '2025-03-14 15:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `user_id`, `company_name`, `industry`) VALUES
(1, 1, 'ASD', 'AWD'),
(2, 17, 'asd', 'asd'),
(3, 39, 'ASD', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `employment_reports`
--

CREATE TABLE `employment_reports` (
  `id` int(11) NOT NULL,
  `report_title` varchar(255) NOT NULL,
  `sector` varchar(100) DEFAULT NULL,
  `report_year` int(11) NOT NULL,
  `statistics` text NOT NULL,
  `download_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_reports`
--

INSERT INTO `employment_reports` (`id`, `report_title`, `sector`, `report_year`, `statistics`, `download_link`) VALUES
(1, 'IT Sector Growth Report', 'IT', 2024, '25% increase in IT job hiring', 'reports/it_growth_2024.pdf'),
(2, 'Manufacturing Employment Trends', 'Manufacturing', 2023, '10% rise in industrial jobs', 'reports/manufacturing_2023.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `entrepreneurship_support`
--

CREATE TABLE `entrepreneurship_support` (
  `id` int(11) NOT NULL,
  `scheme_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `funding_options` text NOT NULL,
  `application_process` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entrepreneurship_support`
--

INSERT INTO `entrepreneurship_support` (`id`, `scheme_name`, `description`, `funding_options`, `application_process`) VALUES
(1, 'Startup India', 'Govt program for startups', 'Tax Benefits, Easy Loans', 'Register via Startup India Portal'),
(2, 'Mudra Loan', 'Loan for micro-businesses', '₹50,000 to ₹10 Lakh', 'Apply via Bank or Online');

-- --------------------------------------------------------

--
-- Table structure for table `financial_aid`
--

CREATE TABLE `financial_aid` (
  `id` int(11) NOT NULL,
  `scheme_name` varchar(255) NOT NULL,
  `eligibility` text NOT NULL,
  `benefits` text NOT NULL,
  `application_process` text NOT NULL,
  `category` enum('Scholarship','Loan','Employer-Sponsored','Govt-Scheme') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `financial_aid`
--

INSERT INTO `financial_aid` (`id`, `scheme_name`, `eligibility`, `benefits`, `application_process`, `category`) VALUES
(1, 'NSDC Loan Program', 'Unemployed Youth', 'Low-interest skill loans', 'Apply via NSDC website', 'Loan'),
(2, 'Standup India', 'SC/ST & Women Entrepreneurs', '₹10 Lakh to ₹1 Crore Loan', 'Register via Bank', 'Govt-Scheme');

-- --------------------------------------------------------

--
-- Table structure for table `government_officials`
--

CREATE TABLE `government_officials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `government_officials`
--

INSERT INTO `government_officials` (`id`, `user_id`, `department`, `designation`) VALUES
(1, 42, 'Education Department', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `job_seekers`
--

CREATE TABLE `job_seekers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_seekers`
--

INSERT INTO `job_seekers` (`id`, `user_id`, `resume`) VALUES
(1, 2, ''),
(2, 8, '67d482f62414a_6CEA (1).pdf'),
(3, 9, '67d4831442454_6CEA (1).pdf'),
(4, 19, 'uploads/resumes/67d52e1bdc9c6_6CEA (1).pdf'),
(5, 20, '67d53177de3c7_6CEA (1).pdf'),
(6, 21, '67d5326670815_6CEA (1).pdf'),
(7, 22, '67d5328dc9867_6CEA (1).pdf'),
(8, 23, '67d532f3b6814_6CEA (1).pdf'),
(9, 24, '67d5334a382d9_6CEA (1).pdf'),
(10, 38, '67d53d84c257f_6CEA (1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `skill_policies`
--

CREATE TABLE `skill_policies` (
  `id` int(11) NOT NULL,
  `policy_name` varchar(255) NOT NULL,
  `eligibility` text NOT NULL,
  `benefits` text NOT NULL,
  `registration_process` text NOT NULL,
  `training_centers` text NOT NULL,
  `success_stories` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_policies`
--

INSERT INTO `skill_policies` (`id`, `policy_name`, `eligibility`, `benefits`, `registration_process`, `training_centers`, `success_stories`) VALUES
(1, 'Skill India', 'All Indian citizens above 18 years', 'Stipends, Job Placement Assistance', 'Online Registration via NSDC', 'NSDC Approved Institutes', 'Arun Kumar – Placed as Electrician'),
(2, 'PMKVY', 'Unemployed youth', 'Free training, Skill certification', 'Enroll via PMKVY portal', 'PMKVY Training Centers', 'Priya Singh – Beautician Course Success');

-- --------------------------------------------------------

--
-- Table structure for table `training_providers`
--

CREATE TABLE `training_providers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_providers`
--

INSERT INTO `training_providers` (`id`, `user_id`) VALUES
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('jobSeeker','employer','trainingProvider','governmentOfficial','admin') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `full_name`, `email`, `phone`, `password`) VALUES
(1, 'employer', 'SDF', 'SDF@F.SDF', 'ASD', '456'),
(2, 'jobSeeker', 'asdsdf', 'shruti@asd.sdf', '123', '456'),
(3, 'jobSeeker', 'sdasd', 'shruti@asd.asd', '+9112', '$2y$10$NyvXMQB9BJOZUlpGudXNrOC/kGWhROxAjCaWxNplksfsXaefa9836'),
(4, 'jobSeeker', 'sdasd', 'skdf@asd.asdf', '+911234567890', '$2y$10$qlLlk5vLkQJFrafp6qj9kerPuhr2wT5fKv3dpOZDXmJBRuChrZVJS'),
(5, 'jobSeeker', 'sdasd', 'sdasd@sfsdf.sdfsdf', '+911234567890', '$2y$10$7Ig5wveGC4uicB6YxOLcJedYh.gKqVF3aHqLeaZxxTlS6wVHCrbFe'),
(6, 'jobSeeker', 'sdasd', 'sdas@sdf.sdf', '+911234567890', '$2y$10$erutHxgOk5nLaTFBRnokxe7.y1i6XsIuDSYQklyN4ozcTH/vqOEw.'),
(7, 'jobSeeker', 'asd', 'shruti@sdf.sdffggh', '+911234567890', '$2y$10$6a4tLPOT2UsXOJ0dJesDsuxJPiEyMa7ZqajxjRSnGOkuzaLUdgsmG'),
(8, 'jobSeeker', 'asd', 'shruti@sdf.sdffgghasdsdf', '+911234567890', '$2y$10$5sCpupE3XZUUJhL7nBBImO3qtLw8hBpV0Rniw/nl1swto5TSkQ3qS'),
(9, 'jobSeeker', 'asd', 'shruti@sdf.sdffgghasdsdfsdsdf', '+911234567', '$2y$10$VlnYl/EqnjdiMzlrCYb8meq8p4EpvKjMZTxUcYOr8iiDhoLr/WZFW'),
(10, 'jobSeeker', 'asdasdf', 'shruti@as.qw', '+9112', '$2y$10$00Hs0CXfmtqLMfYbqogiFuJEyNShPAU64KASW7iGNzpTMJ5T0YDtW'),
(11, 'jobSeeker', 'asdasdf', 'shruti@as.qw.asdf', '+911234567890', '$2y$10$hy7q199tSQ3iA6i9hyH.QOcyNs99f3pjglf96PA8tUwv2gnN7zgNi'),
(12, 'jobSeeker', 'asdasdf', 'shruti@as.qw.asdfasdas', '+911234567890', '456'),
(13, 'jobSeeker', 'asdsdf', 'shruti@ssa.edf', '+9112345678', '456'),
(14, 'jobSeeker', 'zsdsdf', 'shruti@qqq.q', '+91123456', '456'),
(15, 'jobSeeker', 'zsdsdf', 'shruti@qqq.qs', '+911234567890', '456'),
(16, 'trainingProvider', 'aSDASD', 'ASD@ASD', '+911234567', '456'),
(17, 'employer', 'aSDASD', 'ASD@ASD.asd', '1234567890', '456'),
(18, 'jobSeeker', 'aSDASD', 'shruti@gmail.com', '+911234567890', '456'),
(19, 'jobSeeker', 'asdsad', 'shruti@gmail.comasdasd', '+911234567890', '456'),
(20, 'jobSeeker', 'asd', 'asdasd@asd.sd', '+911234567890', '$2y$10$MrAF6SLTooruEy5K/QZwWOyMRZoWq43shWQxI4X.QbxX5iNvt1Kde'),
(21, 'jobSeeker', 'shruti chavda', 'shrutic889@gmail.com', '1234567890', '123'),
(22, 'jobSeeker', 'asdas', 'shrutic889@gmail.commmm', '1234567890', '$2y$10$0pI36wa.HsWOR1O3G228CO7jFUyW1TL1KTvNW.W7RzPtOGVE7kAyW'),
(23, 'jobSeeker', 'asdsad', 'asd@sd.sdf', '1234567890', '123'),
(24, 'jobSeeker', 'asdsad', 'asdas@asd.sdfr', '1234567890', '12'),
(25, 'employer', 'adasd', 'asdas@sdf.sdfsdf', '1234567890', '123'),
(26, 'employer', 'adasd', 'asdas@sdf.sdfsdfasd', '1234567890', '123'),
(27, 'employer', 'adasd', 'asdas@sdf.sdfsdfasdsdf', '1234567890', '123'),
(28, 'employer', 'sdf', 'asd@sedf.sdf', '1234567890', '123'),
(29, 'employer', 'asd', 'asd@sdf.sdf', '1234567890', '123'),
(30, 'employer', 'asd', 'asd@sdf.sdfsdfsdf', '1234567890', '123'),
(31, 'employer', 'asd', 'asd@sdf.sdfsdfsdfsdsd', '1234567890', '123'),
(32, 'employer', 'asd', 'asd@sdf.sdfsdfsdfsdsdasdsdf', '1234567890', '123'),
(33, 'employer', 'asd', 'asd@sdf.sdfsdfsdfsdsdasdsdfasdasdd', '1234567890', '1234'),
(34, 'employer', 'asd', 'asd@sdf.sdfsdfsdfsdsdasdsdfasdasddasdsdf', '1234567890', '1234'),
(35, 'employer', 'asdasd', 'gw@asd.asd', '1234567890', '123'),
(36, 'trainingProvider', 'asd', 'asd@asd.asdf', '1234567890', '123'),
(37, 'governmentOfficial', 'asd', 'asd@s.dfsdf', '1234567890', '123'),
(38, 'jobSeeker', 'asdsad', 'as@ASD.ASDQWE', '1234567890', '123'),
(39, 'employer', 'ASD', 'ASD@ASD.SG', '1234567890', '123'),
(40, 'trainingProvider', 'ASD', 'ASD@AS.DFSDF', '1234567890', '1234'),
(41, 'governmentOfficial', 'asdsad', 'ASD@H.WE', '1234567890', '123'),
(42, 'governmentOfficial', 'asdsad', 'asd@sdf.sdfasdfsdfsdfsdf', '1234567890', '123'),
(45, 'admin', 'shruti chavda', 'schavda684@rku.ac.in', '1234567890', '123');

-- --------------------------------------------------------

--
-- Table structure for table `workplace_safety`
--

CREATE TABLE `workplace_safety` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `guidelines` text NOT NULL,
  `complaint_process` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workplace_safety`
--

INSERT INTO `workplace_safety` (`id`, `category`, `guidelines`, `complaint_process`) VALUES
(1, 'Factory Safety Laws', 'Mandatory PPE, Fire Exits', 'File complaint via Govt Labour Portal'),
(2, 'Ergonomic Safety', 'Proper chair adjustments, posture tips', 'HR Department Complaint Box');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`full_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employment_reports`
--
ALTER TABLE `employment_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entrepreneurship_support`
--
ALTER TABLE `entrepreneurship_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_aid`
--
ALTER TABLE `financial_aid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government_officials`
--
ALTER TABLE `government_officials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `skill_policies`
--
ALTER TABLE `skill_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_providers`
--
ALTER TABLE `training_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workplace_safety`
--
ALTER TABLE `workplace_safety`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employment_reports`
--
ALTER TABLE `employment_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entrepreneurship_support`
--
ALTER TABLE `entrepreneurship_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `financial_aid`
--
ALTER TABLE `financial_aid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `government_officials`
--
ALTER TABLE `government_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_seekers`
--
ALTER TABLE `job_seekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill_policies`
--
ALTER TABLE `skill_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_providers`
--
ALTER TABLE `training_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `workplace_safety`
--
ALTER TABLE `workplace_safety`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `government_officials`
--
ALTER TABLE `government_officials`
  ADD CONSTRAINT `government_officials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD CONSTRAINT `job_seekers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_providers`
--
ALTER TABLE `training_providers`
  ADD CONSTRAINT `training_providers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
