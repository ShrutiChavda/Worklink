-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 06:51 PM
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
(1, 'Shruti Chavda', 'schavda684', 'Female', '67e938d4ca81f_Avatar.png', 'Inactive', 'schavda684@rku.ac.in', '123', 'admin', 1234567890, '2025-03-26 17:36:51'),
(3, 'test admin', 'test', 'Female', '67e93b4ad9b8c_profile.jpg', 'Inactive', 'testadmin@gmail.com', 'ADmin@12', 'admin', 2147483647, '2025-03-30 12:38:34');

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
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `old_data` text DEFAULT NULL,
  `new_data` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`log_id`, `action`, `table_name`, `record_id`, `old_data`, `new_data`, `created_at`, `created_by`, `action_time`) VALUES
(1, 'update', 'policies', 1, '{\"policy_id\":\"1\",\"policy_title\":\"Skill India Mission\",\"policy_description\":\"A policy to enhance skill development and employment opportunities.\",\"department\":\"Ministry of Skill Development\",\"status\":\"1\",\"created_at\":\"2025-04-12 17:56:21\",\"updated_at\":\"2025-04-12 17:56:21\"}', '{\"policy_title\":\"Skill India Mission\",\"department\":\"Ministry of Skill Development\",\"status\":\"0\"}', '2025-04-12 12:35:45', 4, '2025-04-12 12:35:45'),
(2, 'update', 'policies', 2, '{\"policy_id\":\"2\",\"policy_title\":\"Labour Welfare Scheme\",\"policy_description\":\"A policy aimed at improving the welfare of workers in India.\",\"department\":\"Ministry of Labour & Employment\",\"status\":\"1\",\"created_at\":\"2025-04-12 17:56:21\",\"updated_at\":\"2025-04-12 17:56:21\"}', '{\"policy_title\":\"Labour Welfare Scheme\",\"department\":\"Ministry of Labour & Employment\",\"status\":\"0\"}', '2025-04-12 12:36:46', 4, '2025-04-12 12:36:46'),
(3, 'update', 'policies', 2, '{\"policy_id\":\"2\",\"policy_title\":\"Labour Welfare Scheme\",\"policy_description\":\"A policy aimed at improving the welfare of workers in India.\",\"department\":\"Ministry of Labour & Employment\",\"status\":\"0\",\"created_at\":\"2025-04-12 17:56:21\",\"updated_at\":\"2025-04-12 18:06:46\"}', '{\"policy_title\":\"Labour Welfare Scheme\",\"department\":\"Ministry of Employment\",\"status\":\"0\"}', '2025-04-12 12:36:55', 4, '2025-04-12 12:36:55'),
(4, 'update', 'policies', 2, '{\"policy_id\":\"2\",\"policy_title\":\"Labour Welfare Scheme\",\"policy_description\":\"A policy aimed at improving the welfare of workers in India.\",\"department\":\"Ministry of Employment\",\"status\":\"0\",\"created_at\":\"2025-04-12 17:56:21\",\"updated_at\":\"2025-04-12 18:06:55\"}', '{\"policy_title\":\"Labour Welfare Scheme\",\"department\":\"Ministry of Labour\",\"status\":\"0\"}', '2025-04-12 12:37:08', 4, '2025-04-12 12:37:08'),
(5, 'insert', 'policies', 5, NULL, '{\"policy_title\":\"National Skill Enhancement Scheme\",\"department\":\"Ministry of Skill Development & Entrepreneurship\",\"status\":\"1\"}', '2025-04-12 12:38:19', 4, '2025-04-12 12:38:19'),
(6, 'update', 'policies', 5, '{\"policy_id\":\"4\",\"policy_title\":\"National Skill Enhancement Scheme\",\"policy_description\":null,\"department\":\"Ministry of Skill Development & Entrepreneurship\",\"status\":\"1\",\"created_at\":\"2025-04-12 18:08:19\",\"updated_at\":\"2025-04-12 18:08:19\"}', '{\"policy_title\":\"National Skill Enhancement Scheme\",\"department\":\"Ministry of Skill Development & Entrepreneurship\",\"status\":\"0\"}', '2025-04-12 12:38:35', 4, '2025-04-12 12:38:35'),
(7, 'delete', 'policies', 3, '{\"policy_id\":\"4\",\"policy_title\":\"National Skill Enhancement Scheme\",\"description\":null,\"department\":\"Ministry of Skill Development & Entrepreneurship\",\"status\":\"0\",\"created_at\":\"2025-04-12 18:08:19\",\"updated_at\":\"2025-04-12 18:08:35\"}', NULL, '2025-04-12 12:44:31', 4, '2025-04-12 12:44:31'),
(8, 'insert', 'policies', 5, NULL, '{\"policy_title\":\"National Skill Enhancement Scheme\",\"department\":\"Ministry of Employment\",\"description\":\"ABC\",\"status\":\"1\"}', '2025-04-12 12:44:55', 4, '2025-04-12 12:44:55'),
(9, 'update', 'policies', 5, '{\"policy_id\":\"5\",\"policy_title\":\"National Skill Enhancement Scheme\",\"description\":\"ABC\",\"department\":\"Ministry of Employment\",\"status\":\"1\",\"created_at\":\"2025-04-12 18:14:55\",\"updated_at\":\"2025-04-12 18:14:55\"}', '{\"policy_title\":\"National Skill Enhancement Scheme\",\"department\":\"Ministry of Employment\",\"description\":\"ABC\",\"status\":\"0\"}', '2025-04-12 12:45:05', 4, '2025-04-12 12:45:05'),
(10, 'insert', 'policies', 2, NULL, '{\"policy_title\":\"new\",\"department\":\"new\",\"description\":\"new\",\"status\":\"1\"}', '2025-04-12 13:09:04', 4, '2025-04-12 13:09:04'),
(11, 'update', 'policies', 5, '{\"policy_id\":\"6\",\"policy_title\":\"new\",\"description\":\"new\",\"department\":\"new\",\"status\":\"1\",\"created_at\":\"2025-04-12 18:39:04\",\"updated_at\":\"2025-04-12 18:39:04\"}', '{\"policy_title\":\"new\",\"department\":\"new\",\"description\":\"new\",\"status\":\"0\"}', '2025-04-12 13:09:11', 4, '2025-04-12 13:09:11'),
(13, 'update', 'policies', 5, '{\"policy_id\":\"5\",\"policy_title\":\"National Skill Enhancement Scheme\",\"description\":\"ABC\",\"department\":\"Ministry of Employment\",\"status\":\"0\",\"created_at\":\"2025-04-12 18:14:55\",\"updated_at\":\"2025-04-12 18:15:05\"}', '{\"policy_title\":\"National Skill Enhancement Scheme\",\"department\":\"Ministry of Employment\",\"description\":\"ABC\",\"status\":\"1\"}', '2025-04-12 13:21:29', 4, '2025-04-12 13:21:29'),
(14, 'insert', 'policies', 7, NULL, '{\"policy_title\":\"DEF\",\"department\":\"TEST\",\"description\":\"DEF\",\"status\":\"1\"}', '2025-04-12 13:21:41', 4, '2025-04-12 13:21:41');

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
(2, 2, 'RKU', 'tech'),
(5, 2, 'Tech Corp', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `employment_analytics`
--

CREATE TABLE `employment_analytics` (
  `id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `employment_rate` decimal(5,2) DEFAULT NULL,
  `job_seekers` varchar(20) DEFAULT NULL,
  `skill_centers` int(11) DEFAULT NULL,
  `nsqf_programs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_analytics`
--

INSERT INTO `employment_analytics` (`id`, `year`, `employment_rate`, `job_seekers`, `skill_centers`, `nsqf_programs`) VALUES
(1, 2020, '47.50', '1.9M', 8000, 400),
(2, 2021, '49.20', '2.0M', 8500, 450),
(3, 2022, '52.10', '2.1M', 10000, 500),
(4, 2023, '54.30', '2.2M', 11000, 550),
(5, 2024, '56.40', '2.3M+', 12000, 600);

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
(2, 4, 'Skill Development Department', 'Training Manager'),
(3, 15, 'Labour Department', 'Labour Commissioner');

-- --------------------------------------------------------

--
-- Table structure for table `government_schemes`
--

CREATE TABLE `government_schemes` (
  `id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `scheme_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `eligibility` text NOT NULL,
  `benefits` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `government_schemes`
--

INSERT INTO `government_schemes` (`id`, `person_id`, `scheme_name`, `description`, `eligibility`, `benefits`, `created_at`) VALUES
(1, 2, 'Skill Development Program', 'A program aimed at enhancing technical and vocational skills.', 'All job seekers', 'Free training and certification', '2025-03-30 14:46:07'),
(2, 2, 'Women Empowerment Initiative', 'Financial assistance and training for women entrepreneurs.', 'Female job seekers and employers', 'Subsidized loans and business training', '2025-03-30 14:46:07'),
(3, 3, 'Youth Employment Program', 'Internship opportunities for young graduates.', 'Job seekers under 30', 'Paid internships and skill development', '2025-03-30 14:46:07'),
(4, 2, 'Rural Job Assistance', 'Employment support for rural job seekers.', 'Job seekers from rural areas', 'Guaranteed job placement assistance', '2025-03-30 14:46:07'),
(5, 3, 'Senior Citizen Employment Scheme', 'Part-time job opportunities for senior citizens.', 'Job seekers aged 60+', 'Flexible work hours and pension benefits', '2025-03-30 14:46:07'),
(6, 2, 'Startup India Support', 'Financial and infrastructural support for new businesses.', 'Employers and entrepreneurs', 'Funding and mentorship programs', '2025-03-30 14:46:07'),
(7, 3, 'Digital Skills Training', 'Online courses for software and IT skills.', 'All job seekers and training providers', 'Free courses and certifications', '2025-03-30 14:46:07'),
(8, 2, 'Government Internship Scheme', 'Internships within government departments.', 'Job seekers and students', 'Work experience and stipend', '2025-03-30 14:46:07'),
(9, 2, 'Employment for Disabled Persons', 'Job placement for individuals with disabilities.', 'Job seekers with disabilities', 'Special hiring preferences and training', '2025-03-30 14:46:07'),
(10, 2, 'Apprenticeship Training Program', 'Workplace training for fresh graduates.', 'Job seekers and training providers', 'Practical experience and job placement', '2025-03-30 14:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `grants`
--

CREATE TABLE `grants` (
  `grant_id` int(11) NOT NULL,
  `official_id` int(11) DEFAULT NULL,
  `grant_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grants`
--

INSERT INTO `grants` (`grant_id`, `official_id`, `grant_name`, `description`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Skill Development Grant', 'A grant for skill development programs', '100000.00', 'Rejected', '2025-04-12 13:28:03', '2025-04-12 14:16:58'),
(2, 2, 'Employment Support Grant', 'A grant for job creation programs', '50000.00', 'Approved', '2025-04-12 13:28:03', '2025-04-12 13:28:03'),
(3, 2, 'Infrastructure Grant', 'A grant for building infrastructure in rural areas', '250000.00', 'Rejected', '2025-04-12 13:28:03', '2025-04-12 13:29:10'),
(12, 2, 'TEST', 'TEST', '12000.00', 'Pending', '2025-04-12 15:47:38', '2025-04-12 15:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','approved','rejected','open','closed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `employer_id`, `title`, `description`, `location`, `salary`, `status`, `created_at`) VALUES
(12, 2, 'Software Developer', 'Develop and maintain web applications.', 'Ahmedabad', '600000.00', 'approved', '2025-03-30 14:52:01'),
(13, 5, 'Data Analyst', 'Analyze large datasets and generate reports.', 'Mumbai', '500000.00', 'open', '2025-03-30 14:52:01'),
(14, 2, 'Graphic Designer', 'Create visual concepts and branding materials.', 'Delhi', '400000.00', 'open', '2025-03-30 14:52:01'),
(15, 5, 'HR Executive', 'Manage recruitment and employee relations.', 'Bangalore', '450000.00', 'open', '2025-03-30 14:52:01'),
(16, 2, 'Digital Marketing Specialist', 'Plan and execute digital marketing campaigns.', 'Pune', '550000.00', 'rejected', '2025-03-30 14:52:01'),
(17, 5, 'Mechanical Engineer', 'Design and develop mechanical systems.', 'Chennai', '650000.00', 'open', '2025-03-30 14:52:01'),
(18, 5, 'Cyber Security Analyst', 'Ensure security of IT infrastructure.', 'Hyderabad', '700000.00', 'open', '2025-03-30 14:52:01'),
(19, 5, 'AI/ML Engineer', 'Develop AI-based solutions and models.', 'Noida', '800000.00', 'rejected', '2025-03-30 14:52:01'),
(20, 2, 'Project Manager', 'Manage and oversee IT projects.', 'Kolkata', '900000.00', 'open', '2025-03-30 14:52:01'),
(21, 2, 'Content Writer', 'Write blogs, articles, and marketing copies.', 'Surat', '350000.00', 'open', '2025-03-30 14:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(11) NOT NULL,
  `job_seeker_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `status` enum('applied','interview','hired','rejected') DEFAULT 'applied',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_seeker_id`, `job_id`, `status`, `applied_at`) VALUES
(1, 2, 12, 'applied', '2025-03-30 14:58:16'),
(2, 7, 13, 'hired', '2025-03-30 14:58:16'),
(3, 8, 14, 'rejected', '2025-03-30 14:58:16');

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
(7, 8, '67e929199fd8d_Practical time table for BTECH_VI_RG.pdf'),
(8, 1, 'alice_resume.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(1, 1, 2, 'Hello, I am interested in your job posting.', '2025-03-30 15:08:02'),
(2, 2, 1, 'Thank you for reaching out! Please share your resume.', '2025-03-30 15:08:02'),
(3, 8, 12, 'I want to know more about your company.', '2025-03-30 15:08:02'),
(4, 12, 8, 'Sure! Our company specializes in IT services and hiring.', '2025-03-30 15:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `policy_id` int(11) NOT NULL,
  `policy_title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`policy_id`, `policy_title`, `description`, `department`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Skill India Mission', 'A policy to enhance skill development and employment opportunities.', 'Ministry of Skill Development', 0, '2025-04-12 12:26:21', '2025-04-12 12:35:45'),
(2, 'Labour Welfare Scheme', 'A policy aimed at improving the welfare of workers in India.', 'Ministry of Labour', 0, '2025-04-12 12:26:21', '2025-04-12 12:37:08'),
(3, 'National Career Service', 'A platform to assist job seekers with career counseling and job matching.', 'Ministry of Labour & Employment', 1, '2025-04-12 12:26:21', '2025-04-12 12:26:21'),
(5, 'National Skill Enhancement Scheme', 'ABC', 'Ministry of Employment', 1, '2025-04-12 12:44:55', '2025-04-12 13:21:29'),
(7, 'DEF', 'DEF', 'TEST', 1, '2025-04-12 13:21:41', '2025-04-12 13:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `subsidies`
--

CREATE TABLE `subsidies` (
  `subsidy_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `scheme_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `training_programs`
--

CREATE TABLE `training_programs` (
  `id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `course_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `status` enum('Approved','Rejected','Pending') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`id`, `provider_id`, `course_name`, `description`, `duration`, `status`, `created_at`) VALUES
(1, 1, 'Full Stack Web Development', 'Learn frontend and backend web development.', 6, 'Approved', '2025-04-11 03:25:11'),
(2, 2, 'Data Science Bootcamp', 'Comprehensive training in data analysis and machine learning.', 4, 'Rejected', '2025-04-11 03:25:11'),
(3, 1, 'Digital Marketing Mastery', 'Advanced strategies for SEO, PPC, and content marketing.', 3, 'Pending', '2025-04-11 03:25:11'),
(4, 2, 'Cyber Security Essentials', 'Fundamentals of network security and ethical hacking.', 5, 'Approved', '2025-04-11 03:25:11'),
(5, 1, 'Graphic Design Fundamentals', 'Learn Adobe Photoshop, Illustrator, and UI/UX design.', 3, 'Pending', '2025-04-11 03:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `training_providers`
--

CREATE TABLE `training_providers` (
  `id` int(11) NOT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `registration_number` varchar(100) DEFAULT NULL,
  `head_office_location` varchar(255) DEFAULT NULL,
  `training_sectors` text DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_providers`
--

INSERT INTO `training_providers` (`id`, `organization_name`, `registration_number`, `head_office_location`, `training_sectors`, `user_id`) VALUES
(1, 'ABC', 'A11', 'ABC 123', 'IT', 3),
(2, 'DEF', 'A22', 'DEF 123', 'ENGINEERING', 3);

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
(1, 'jobSeeker', 'Shruti Chavda', 'chavdashruti516', 'chavdashruti516@gmail.com', 'Female', '1234567890', '2005-03-10', 'undraw_profile.jpg', '123', 'Inactive', 'a11412c35b7cbc7c38c47477661ca3d4a893b3ac14a5933fc9a89f4ea153580c'),
(2, 'employer', 'Rutika Vaghasiya', 'rvaghasiya328', 'rvaghasiya328@rku.ac.in', 'Female', '2345678901', '2005-02-01', 'undraw_profile.jpg', '123', 'active', 'c975888b25342f7ffd912da2fb5da148f37098e5684a90738cba02b7b76ca87c'),
(3, 'trainingProvider', 'Urvisha Baldha', 'ubaldha434', 'ubaldha434@rku.ac.in', 'Female', '0987654321', '2003-03-11', 'undraw_profile.jpg', '123', 'Inactive', '0de6f7f6acd96b5acb13fcbd5dc47cd875c7e6e549af1ea161721d7ccc0d7cd6'),
(4, 'governmentOfficial', 'Pari Chavda', 'pchavda866', 'pchavda866@gmail.com', 'Female', '2435267534', '2007-06-22', 'undraw_profile.jpg', '123', 'active', '89851898a0464608839f2f64da147c5ed055bfa480a47430892116c312ed7849'),
(8, 'jobSeeker', 'testttt', 'test', 'test@gmail.com', 'Female', '0987654512', '2004-12-12', 'undraw_profile.jpg', '123', 'Inactive', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(9, 'jobSeeker', 'abc', 'abc123', 'abc@gmail.com', 'Male', '1234567890', '2003-10-10', 'undraw_profile.jpg', 'ADmin12@', 'Inactive', '174317426d19744d3c996sdfs7f902029a67da47db47cd9843987201d40f4fed0b63'),
(10, 'jobSeeker', 'test abc', 'testanc', 'testabc@gmail.com', 'Male', '2147483647', '2005-12-12', 'undraw_profile.jpg', 'ADmin@12', 'Inactive', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(11, 'jobSeeker', 'Alice Johnson', 'alice', 'alice@gmail.com', 'Female', '1234567890', '2001-01-01', 'undraw_profile.jpg', 'pass123', 'Inactive', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(12, 'employer', 'Tech Corp', 'techcorp', 'techcorp@gmail.com', 'Male', '9876543210', '2001-08-09', 'undraw_profile.jpg', 'pass456', 'Inactive', '174317426d19744d3c9967f90202sdfs9a67da47db47cd9843987201d40f4fed0b63'),
(13, 'trainingProvider', 'Skill Academy', 'skillacademy', 'skillacademy@gmail.com', 'Male', '5555555555', '2002-10-10', 'undraw_profile.jpg', 'pass789', 'active', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(15, 'governmentOfficial', 'Kashish Koshiya', 'temp1', 'temp1@gmail.com', 'Female', '7654567896', '2005-01-01', 'undraw_profile.jpg', '123', 'Inactive', '809afba46cad8464a247d0dd3f1c9db4dce45f5e40852950aa2428a794f147e5');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.user_type = 'jobSeeker' THEN
        UPDATE job_seekers SET user_id = NEW.id WHERE user_id = NEW.id;
    END IF;

    IF NEW.user_type = 'employer' THEN
        UPDATE employers SET user_id = NEW.id WHERE user_id = NEW.id;
    END IF;

    IF NEW.user_type = 'trainingProvider' THEN
        UPDATE training_providers SET user_id = NEW.id WHERE user_id = NEW.id;
    END IF;

    IF NEW.user_type = 'governmentOfficial' THEN
        UPDATE government_officials 
        SET department = '', designation = '' 
        WHERE user_id = NEW.id;
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
-- Table structure for table `wage_laws`
--

CREATE TABLE `wage_laws` (
  `id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `min_wage_rate` decimal(10,2) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `date_of_implementation` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wage_laws`
--

INSERT INTO `wage_laws` (`id`, `state`, `min_wage_rate`, `sector`, `date_of_implementation`, `created_at`, `updated_at`) VALUES
(1, 'Gujarat', '200.00', 'Manufacturing', '2025-01-01', '2025-04-12 16:11:09', '2025-04-12 16:11:09'),
(2, 'Maharashtra', '250.00', 'Construction', '2025-03-01', '2025-04-12 16:11:09', '2025-04-12 16:11:09'),
(3, 'Delhi', '180.00', 'Agriculture', '2025-02-15', '2025-04-12 16:11:09', '2025-04-12 16:11:09'),
(4, 'Karnataka', '220.00', 'Retail', '2025-04-01', '2025-04-12 16:11:09', '2025-04-12 16:11:09'),
(5, 'Tamil Nadu', '245.00', 'IT Services', '2025-05-08', '2025-04-12 16:11:09', '2025-04-12 16:11:59'),
(6, 'Madhya Pradesh', '123.91', 'IT Services', '2025-12-12', '2025-04-12 16:12:45', '2025-04-12 16:12:45'),
(7, 'Madhya Pradesh', '123.91', 'IT Services', '2025-12-12', '2025-04-12 16:16:36', '2025-04-12 16:16:36'),
(8, 'Madhya Pradesh', '123.91', 'IT Services', '2025-12-12', '2025-04-12 16:18:31', '2025-04-12 16:18:31'),
(12, 'Assam', '111.00', 'Agriculture', '2025-04-12', '2025-04-12 16:35:55', '2025-04-12 16:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `worker_complaints`
--

CREATE TABLE `worker_complaints` (
  `id` int(11) NOT NULL,
  `complainant_type` enum('trainingProvider','employer','jobSeeker') NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_type` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `resolution_note` text DEFAULT 'Pending',
  `status` enum('Pending','In Progress','Resolved') DEFAULT 'Pending',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `worker_complaints`
--

INSERT INTO `worker_complaints` (`id`, `complainant_type`, `user_id`, `complaint_type`, `description`, `resolution_note`, `status`, `submitted_at`) VALUES
(1, 'employer', 2, 'Labour Regulation Update Request', 'Please provide updated guidelines on contract labor hiring limits.', 'Done', 'Resolved', '2025-04-11 05:48:36'),
(2, 'employer', 2, 'Minimum Wage Clarification', 'We need clarity on the revised minimum wage structure in our region', 'Pending', 'Pending', '2025-04-11 05:48:36'),
(3, 'jobSeeker', 1, 'Wage Dispute After Placement', 'The employer is paying less than what was promised during placement.', 'The HR department or concerned authority can take action, and if the employer is found to be at fault, they can be instructed to pay the difference or face legal action.', 'In Progress', '2025-04-11 05:50:57'),
(4, 'jobSeeker', 9, 'Unsafe Working Conditions', 'My workplace lacks basic safety equipment and protocols.', 'Done', 'Pending', '2025-04-11 05:50:57');

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
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_audit_policy` (`record_id`),
  ADD KEY `fk_audit_users` (`created_by`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employment_analytics`
--
ALTER TABLE `employment_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government_officials`
--
ALTER TABLE `government_officials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `government_schemes`
--
ALTER TABLE `government_schemes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_govt_scheme_official` (`person_id`);

--
-- Indexes for table `grants`
--
ALTER TABLE `grants`
  ADD PRIMARY KEY (`grant_id`),
  ADD KEY `fk_grants_official` (`official_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_seeker_id` (`job_seeker_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `subsidies`
--
ALTER TABLE `subsidies`
  ADD PRIMARY KEY (`subsidy_id`);

--
-- Indexes for table `token1`
--
ALTER TABLE `token1`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`);

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
-- Indexes for table `wage_laws`
--
ALTER TABLE `wage_laws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `worker_complaints`
--
ALTER TABLE `worker_complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employment_analytics`
--
ALTER TABLE `employment_analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `government_officials`
--
ALTER TABLE `government_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `government_schemes`
--
ALTER TABLE `government_schemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grants`
--
ALTER TABLE `grants`
  MODIFY `grant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_seekers`
--
ALTER TABLE `job_seekers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `policy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subsidies`
--
ALTER TABLE `subsidies`
  MODIFY `subsidy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token1`
--
ALTER TABLE `token1`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `training_providers`
--
ALTER TABLE `training_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wage_laws`
--
ALTER TABLE `wage_laws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `worker_complaints`
--
ALTER TABLE `worker_complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `fk_audit_policy` FOREIGN KEY (`record_id`) REFERENCES `policies` (`policy_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_audit_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Constraints for table `government_schemes`
--
ALTER TABLE `government_schemes`
  ADD CONSTRAINT `fk_govt_scheme_official` FOREIGN KEY (`person_id`) REFERENCES `government_officials` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `grants`
--
ALTER TABLE `grants`
  ADD CONSTRAINT `fk_grants_official` FOREIGN KEY (`official_id`) REFERENCES `government_officials` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_ibfk_1` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seekers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_seekers`
--
ALTER TABLE `job_seekers`
  ADD CONSTRAINT `job_seekers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_programs`
--
ALTER TABLE `training_programs`
  ADD CONSTRAINT `training_programs_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `training_providers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_providers`
--
ALTER TABLE `training_providers`
  ADD CONSTRAINT `training_providers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `worker_complaints`
--
ALTER TABLE `worker_complaints`
  ADD CONSTRAINT `worker_complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
