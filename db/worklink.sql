-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 09:58 AM
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
-- Table structure for table `government_schemes`
--

CREATE TABLE `government_schemes` (
  `id` int(11) NOT NULL,
  `scheme_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `eligibility` text NOT NULL,
  `benefits` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `government_schemes`
--

INSERT INTO `government_schemes` (`id`, `scheme_name`, `description`, `eligibility`, `benefits`, `created_at`) VALUES
(1, 'Skill Development Program', 'A program aimed at enhancing technical and vocational skills.', 'All job seekers', 'Free training and certification', '2025-03-30 14:46:07'),
(2, 'Women Empowerment Initiative', 'Financial assistance and training for women entrepreneurs.', 'Female job seekers and employers', 'Subsidized loans and business training', '2025-03-30 14:46:07'),
(3, 'Youth Employment Program', 'Internship opportunities for young graduates.', 'Job seekers under 30', 'Paid internships and skill development', '2025-03-30 14:46:07'),
(4, 'Rural Job Assistance', 'Employment support for rural job seekers.', 'Job seekers from rural areas', 'Guaranteed job placement assistance', '2025-03-30 14:46:07'),
(5, 'Senior Citizen Employment Scheme', 'Part-time job opportunities for senior citizens.', 'Job seekers aged 60+', 'Flexible work hours and pension benefits', '2025-03-30 14:46:07'),
(6, 'Startup India Support', 'Financial and infrastructural support for new businesses.', 'Employers and entrepreneurs', 'Funding and mentorship programs', '2025-03-30 14:46:07'),
(7, 'Digital Skills Training', 'Online courses for software and IT skills.', 'All job seekers and training providers', 'Free courses and certifications', '2025-03-30 14:46:07'),
(8, 'Government Internship Scheme', 'Internships within government departments.', 'Job seekers and students', 'Work experience and stipend', '2025-03-30 14:46:07'),
(9, 'Employment for Disabled Persons', 'Job placement for individuals with disabilities.', 'Job seekers with disabilities', 'Special hiring preferences and training', '2025-03-30 14:46:07'),
(10, 'Apprenticeship Training Program', 'Workplace training for fresh graduates.', 'Job seekers and training providers', 'Practical experience and job placement', '2025-03-30 14:46:07');

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
  `status` enum('open','closed') DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `employer_id`, `title`, `description`, `location`, `salary`, `status`, `created_at`) VALUES
(12, 2, 'Software Developer', 'Develop and maintain web applications.', 'Ahmedabad', '600000.00', 'open', '2025-03-30 14:52:01'),
(13, 5, 'Data Analyst', 'Analyze large datasets and generate reports.', 'Mumbai', '500000.00', 'open', '2025-03-30 14:52:01'),
(14, 2, 'Graphic Designer', 'Create visual concepts and branding materials.', 'Delhi', '400000.00', 'open', '2025-03-30 14:52:01'),
(15, 5, 'HR Executive', 'Manage recruitment and employee relations.', 'Bangalore', '450000.00', 'open', '2025-03-30 14:52:01'),
(16, 2, 'Digital Marketing Specialist', 'Plan and execute digital marketing campaigns.', 'Pune', '550000.00', 'open', '2025-03-30 14:52:01'),
(17, 5, 'Mechanical Engineer', 'Design and develop mechanical systems.', 'Chennai', '650000.00', 'open', '2025-03-30 14:52:01'),
(18, 5, 'Cyber Security Analyst', 'Ensure security of IT infrastructure.', 'Hyderabad', '700000.00', 'open', '2025-03-30 14:52:01'),
(19, 5, 'AI/ML Engineer', 'Develop AI-based solutions and models.', 'Noida', '800000.00', 'open', '2025-03-30 14:52:01'),
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
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`id`, `provider_id`, `course_name`, `description`, `duration`) VALUES
(1, 1, 'Full Stack Web Development', 'Learn frontend and backend web development.', 6),
(2, 2, 'Data Science Bootcamp', 'Comprehensive training in data analysis and machine learning.', 4),
(3, 1, 'Digital Marketing Mastery', 'Advanced strategies for SEO, PPC, and content marketing.', 3),
(4, 2, 'Cyber Security Essentials', 'Fundamentals of network security and ethical hacking.', 5),
(5, 1, 'Graphic Design Fundamentals', 'Learn Adobe Photoshop, Illustrator, and UI/UX design.', 3);

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
(1, 3),
(2, 3);

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
(2, 'employer', 'Rutika Vaghasiya', 'rvaghasiya328', 'rvaghasiya328@rku.ac.in', 'Female', '2345678901', '2005-02-01', '67e921af1b548_Avatar.png', '123', 'Inactive', 'c975888b25342f7ffd912da2fb5da148f37098e5684a90738cba02b7b76ca87c'),
(3, 'trainingProvider', 'Urvisha Baldha', 'ubaldha434', 'ubaldha434@rku.ac.in', 'Female', '0987654321', '2003-03-11', 'undraw_profile.jpg', '123', 'Inactive', '0de6f7f6acd96b5acb13fcbd5dc47cd875c7e6e549af1ea161721d7ccc0d7cd6'),
(4, 'governmentOfficial', 'Pari Chavda', 'pchavda866', 'pchavda866@gmail.com', 'Female', '2435267534', '2007-06-22', 'undraw_profile.jpg', '123', 'Inactive', '89851898a0464608839f2f64da147c5ed055bfa480a47430892116c312ed7849'),
(8, 'jobSeeker', 'testttt', 'test', 'test@gmail.com', 'Female', '0987654512', '2004-12-12', '67e92b629b1c0_Avatar.png', '123', 'active', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(9, 'jobSeeker', 'abc', 'abc123', 'abc@gmail.com', 'Male', '1234567890', '2003-10-10', 'undraw_profile.jpg', 'ADmin12@', 'inactive', '174317426d19744d3c996sdfs7f902029a67da47db47cd9843987201d40f4fed0b63'),
(10, 'jobSeeker', 'test abc', 'testanc', 'testabc@gmail.com', 'Male', '2147483647', '2005-12-12', 'undraw_profile.jpg', 'ADmin@12', 'inactive', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(11, 'jobSeeker', 'Alice Johnson', 'alice', 'alice@gmail.com', 'Female', '1234567890', '2001-01-01', 'undraw_profile.jpg', 'pass123', 'active', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63'),
(12, 'employer', 'Tech Corp', 'techcorp', 'techcorp@gmail.com', 'Male', '9876543210', '2001-08-09', 'undraw_profile.jpg', 'pass456', 'active', '174317426d19744d3c9967f90202sdfs9a67da47db47cd9843987201d40f4fed0b63'),
(13, 'trainingProvider', 'Skill Academy', 'skillacademy', 'skillacademy@gmail.com', 'Male', '5555555555', '2002-10-10', 'undraw_profile.jpg', 'pass789', 'active', '174317426d19744d3c9967f902029a67da47db47cd9843987201d40f4fed0b63');

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
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `government_officials`
--
ALTER TABLE `government_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `government_schemes`
--
ALTER TABLE `government_schemes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
