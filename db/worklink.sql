-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2025 at 12:08 PM
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
  `user_name` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `pic` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Inactive',
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin') NOT NULL DEFAULT 'admin',
  `phone` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `user_name`, `gender`, `pic`, `status`, `email`, `password`, `user_type`, `phone`, `created_at`) VALUES
(1, 'Shruti Chavda', 'schavda684', 'female', 'undraw_profile.jpg', 'Inactive', 'schavda684@rku.ac.in', '123', 'admin', 1234567890, '2025-03-26 17:36:51');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `after_admin_insert` AFTER INSERT ON `admin` FOR EACH ROW BEGIN  
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
(2, 2, 'RKU', 'tech');

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
(2, 4, 'Skill Development Department', 'Training Manager');

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
(2, 1, '67e9099576d5a_Practical time table for BTECH_VI_RG.pdf'),
(3, 5, NULL),
(4, 5, '67e917999ed19_Practical time table for BTECH_VI_RG.pdf');

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
-- Table structure for table `token1`
--

CREATE TABLE `token1` (
  `token_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `s_time` datetime DEFAULT NULL,
  `token` varchar(1000) DEFAULT NULL,
  `otp` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('jobSeeker','employer','trainingProvider','governmentOfficial','admin') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `birthday` date DEFAULT NULL,
  `pic` varchar(50) DEFAULT 'undraw_profile.jpg',
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'inactive',
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `full_name`, `user_name`, `email`, `gender`, `phone`, `birthday`, `pic`, `password`, `status`, `token`) VALUES
(1, 'jobSeeker', 'Shruti Chavda', 'chadvashruti516', 'chadvashruti516@gmail.com', 'Female', '1234567890', '2005-03-10', 'undraw_profile.jpg', '123', 'active', 'a11412c35b7cbc7c38c47477661ca3d4a893b3ac14a5933fc9a89f4ea153580c'),
(2, 'employer', 'Rutika Vaghasiya', 'rvaghasiya328', 'rvaghasiya328@rku.ac.in', 'Female', '2345678901', '2005-02-01', 'undraw_profile.jpg', '123', 'active', 'c975888b25342f7ffd912da2fb5da148f37098e5684a90738cba02b7b76ca87c'),
(3, 'trainingProvider', 'Urisha Baldha', 'ubaldha434', 'ubaldha434@rku.ac.in', 'Female', '0987654321', '2003-03-11', 'undraw_profile.jpg', '123', 'active', '0de6f7f6acd96b5acb13fcbd5dc47cd875c7e6e549af1ea161721d7ccc0d7cd6'),
(4, 'governmentOfficial', 'Pari Chavda', 'pchavda866', 'pchavda866@gmail.com', 'Female', '2435267534', '2007-06-22', 'undraw_profile.jpg', '123', 'active', '89851898a0464608839f2f64da147c5ed055bfa480a47430892116c312ed7849'),
(5, 'jobSeeker', 'test', 'test', 'test@gmail.com', 'Female', '4532767898', '2001-03-04', 'undraw_profile.jpg', '123', 'active', 'eda4894c401dfaa1079d34d782d03f679787cd013716b159f124717616192754');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.user_type = 'jobSeeker' THEN
        INSERT INTO job_seekers (user_id) VALUES (NEW.id);
    END IF;
    
    IF NEW.user_type = 'employer' THEN
        INSERT INTO employers (user_id) VALUES (NEW.id);
    END IF;
    
    IF NEW.user_type = 'trainingProvider' THEN
        INSERT INTO training_providers (user_id) VALUES (NEW.id);
    END IF;

    IF NEW.user_type = 'governmentOfficial' THEN
        INSERT INTO government_officials (user_id, department, designation) 
        VALUES (NEW.id, '', ''); -- Assuming default values, modify as needed
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    -- Extract the part before '@' from the email and set it as the username
    SET NEW.user_name = SUBSTRING_INDEX(NEW.email, '@', 1);
END
$$
DELIMITER ;

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
-- Indexes for table `token1`
--
ALTER TABLE `token1`
  ADD PRIMARY KEY (`token_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_seekers`
--
ALTER TABLE `job_seekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skill_policies`
--
ALTER TABLE `skill_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token1`
--
ALTER TABLE `token1`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `training_providers`
--
ALTER TABLE `training_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
