-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 11:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ctfdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_materials`
--

CREATE TABLE `additional_materials` (
  `material_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `file_name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `additional_materials`
--

INSERT INTO `additional_materials` (`material_id`, `challenge_id`, `file_name`) VALUES
(1, 22, 'web/rdev_sponsorship.php'),
(5, 29, 'code_2_1.txt'),
(7, 31, 'raylen_sim_1.png'),
(8, 39, 'CTFforensicschallenge.jpg'),
(9, 40, 'HAI 1.2.txt'),
(10, 41, 'rvhs_lsb1.jpg'),
(13, 44, 'secret.wav'),
(16, 47, 'To_Space_2.aac'),
(17, 48, 'challenge_1.jpg'),
(20, 51, 'BusinessDocuments.xlsx'),
(21, 52, 'Stego100-2.txt'),
(22, 53, 'Signature.zip'),
(24, 55, 'mrt.jpg'),
(25, 56, 'MORE KABOOOMMMMMMMMMMMMMM_2.zip'),
(26, 57, 'good-cryptography-decoders.7z'),
(27, 58, 'We need to do math_1.zip'),
(28, 59, 'X Marker.zip'),
(29, 60, 'encryption.txt'),
(31, 64, 'Another easy rsa.zip'),
(33, 66, 'school.zip'),
(35, 68, 'training1_1.zip'),
(38, 71, 'STRANGE RSA_2.zip'),
(39, 72, 'pwn100 (1).zip'),
(40, 73, 'SarahsQualityLearning.zip'),
(41, 74, 'weird.png'),
(43, 76, 'POST-PCAP-CLARITY.zip'),
(44, 81, 'nooby rsa - Challenge.zip'),
(45, 82, 'quantum_propulsion_via_dank_memes_1.pptx');

-- --------------------------------------------------------

--
-- Table structure for table `admin_points`
--

CREATE TABLE `admin_points` (
  `point_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `issuetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_points`
--

INSERT INTO `admin_points` (`point_id`, `admin_id`, `user_id`, `points`, `issuetime`) VALUES
(0, 5, 5, 123, '2024-07-15 03:38:07'),
(0, 7, 7, 3, '2024-07-24 05:59:51'),
(0, 7, 7, 1, '2024-08-17 22:13:27'),
(0, 7, 7, 1, '2024-08-17 22:14:08'),
(0, 8, 7, -100, '2024-08-18 23:03:36'),
(0, 7, 7, -15, '2024-10-19 00:32:24'),
(0, 8, 8, -69420, '2025-02-05 00:12:39'),
(0, 8, 8, -69420, '2025-02-05 00:12:47'),
(0, 8, 8, 415920, '2025-02-05 01:11:22'),
(0, 8, 8, -4159190, '2025-02-05 01:11:40'),
(0, 8, 8, -4159190, '2025-02-05 01:11:49'),
(0, 19, 19, 1000000000, '2025-04-26 05:50:34'),
(0, 19, 39, 1000000000, '2025-04-26 05:50:46'),
(0, 19, 19, 123, '2025-04-26 07:11:27'),
(0, 19, 19, 123, '2025-04-26 07:27:27'),
(0, 19, 5, 1, '2025-04-26 07:27:56'),
(0, 19, 19, 2147483647, '2025-04-27 04:10:08');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `difficulty` tinyint(4) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `solution` varchar(255) NOT NULL,
  `first_blooded` tinyint(1) NOT NULL DEFAULT 0,
  `firstblood_user_id` int(11) NOT NULL,
  `first_blood_bonus` int(11) NOT NULL,
  `double_points` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `title`, `author`, `points`, `difficulty`, `category`, `description`, `solution`, `first_blooded`, `firstblood_user_id`, `first_blood_bonus`, `double_points`) VALUES
(22, 'RdeV Sponsorship', 'Zhongbob', 100, 0, 'Web', 'RdeV created this website, so they&#039;ve graciously sponsored an easy web challenge! Supposedly easy, at least. \n\n<a href = \"https://rvctf.com/challenges/\">rvctf.com/web/rdev_sponsorship.php</a>', '0eb2895ca7a4f7188a1bbc16b46d521b6c906ae6', 0, 0, 0, 0),
(29, 'Mod_arithmetic_1', 'johnbrong', 100, 0, 'Crypto', 'We found this weird message being passed around on the servers, we think we have a working decryption scheme. Take each number mod 37 and map it to the following character set: 0-25 is the alphabet (uppercase), 26-35 are the decimal digits, and 36 is an underscore. Wrap your decrypted message in the rvctf flag format (i.e. RVCTF{decrypted_message}) 128 322 353 235 336 73 198 332 202 285 57 87 262 221 218 405 335 101 256 227 112 140\r\n', 'df615ee150b659d5b09e2d02394438a6c98fdbcc', 0, 0, 0, 0),
(31, 'omg blackpink (SEP HOLS)', 'Aarogant', 100, 0, 'OSINT', 'Rayner would like to buy a gift for his 92 year old best friend, Raylen. He vaguely remembers Raylen posting about it… but he has forgotten where he saw the post…He only remembers that Raylen likes Red and found a screenshot in his phone. Help Rayner find the brand of the present or Raylen’s life is at stake. Your flag would be in the form of RVCTF{brand_name}\r\n(Hint: Brand is 3 letters.)\r\n', 'bb10070f620d844b30795a1b390478580a82ea16', 0, 0, 0, 0),
(39, 'Hidden in Plain Sight', 'Vvvvv', 100, 0, 'Forensics', 'Is it just an ordinary image, or is there something unexpected hidden within? Explore the data thoroughly and discover what&#039;s concealed. Sometimes, the answer is right in front of you.', '54b23faafdf49a561b7962ff145a8e7e2b5839f5', 0, 0, 0, 0),
(40, 'lol i love cats', 'Aarogant', 125, 0, 'Reverse Engineering', 'aww                                                                           \r\n                                                           ', '8a7288251acfd052f93580617e3a85285a7a8b4a', 0, 0, 0, 0),
(41, 'LSB1 [EASY]', 'Aarogant', 100, 0, 'Forensics', 'There are many ways to solve a least significant bit challenge. \r\nThe first is to use python and grab the least significant bits of this image, then convert it to text. \r\nThe second is use libraries like steghide and cloaked-pixel. \r\nThe third is to find online steganography websites that will help you solve it. \r\nTry to solve using all three! Good luck â¤ï¸', '3b216cb27e6c8016634761a7ec2898f56c98158b', 0, 0, 0, 0),
(44, 'Binary 1011', 'FS', 200, 1, 'Forensics', 'beepity bopity boopity beepity boop\r\n\r\nFlag format is blahaj{...}', '36c7890889e2db6aae6c6c8b5ee67cf852845ef8', 0, 0, 0, 0),
(47, 'Tones', 'P3RPL3X', 200, 1, 'Forensics', 'To Space and Beyond! or maybe crash and scatter into pieces\r\n\r\n', 'e1a783049896af71de67d84d5b96ba64864b5679', 0, 0, 0, 0),
(48, 'Just Please God', 'quackers', 200, 1, 'Forensics', 'Pray to the skies.', '4df3ae212699e57b831be1f8a70bdc5dcfd63af6', 0, 0, 0, 0),
(51, 'crackers', 'P3RPL3X', 200, 1, 'Forensics', 'I managed to hack into this business and I swear there was some important information in here! All i know is that its the end but i dont know what this means????\r\n\r\n', 'afa98ab0677e6d28ae5ca70c8480d61d72d3f6d2', 0, 0, 0, 0),
(52, 'My Memoirs', 'Prof. Johnson', 150, 0, 'Forensics', 'Good news, everyone! I&#039;ve decided it&#039;s time to write my memoirs. After a lifetime of interesting experiences, I think it&#039;s time the astounding story of my life be recorded for the benefit and advancement of humanity. I can tell everyone about the time that I... Hmm... Ok, maybe my life isn&#039;t so interesting after all...\r\n\r\n...But it can be! I&#039;m going to throw in a couple interesting details! Give it a little something extra! No one will notice if I embellish a little as long as I don&#039;t change it too much. I can always just put a disclaimer on it that its only based on true events - a little transparency is a good thing.\r\n\r\nFlag format is poctf{...}', '119e7b98e7bf245582d44959699c4e0523070790', 0, 0, 0, 0),
(53, 'Signature', 'zian', 200, 1, 'Crypto', 'I think this is how signing works\r\n\r\n', '5bdff6703df0388b970098e5df8b8afe4cbcef04', 0, 0, 0, 0),
(55, 'MRT', 'hartmannsyg', 100, 0, 'OSINT', 'Help I am stuck in the MRT? Which station am I in? Flag format is `rvctf{mrt_name_in_lowercase}`. Replace spaces with underscores. Leave dashes as is.', 'b3177ee2b734736a45733fa1382ae205e97db009', 0, 0, 0, 0),
(56, 'MORE KABOOOOOOM', 'Zhong bob', 350, 1, 'Web', 'The North Korean&#039;s are still after Baba for the several war crimes he committed in their country. In order to better optimise the locations of the nukes they drop such that Baba is guaranteed to be hit, they decided to make a helpful UI to determine exactly where the nukes should be dropped!\r\n\r\nBaba has managed to successfully infiltrate into their website. He needs to find a way to mess up their website so that the bombs don&#039;t land on him. Can you help Baba escape his imminent doom?\r\n\r\nP.S. This challenge requires a dockerfile to run, when you do get the solution please screenshot and send charles for the actual flag. This is just a temporary measure we will get we challs working soon', '9d8f495db8b30664132762082839caf9d17b365e', 0, 0, 0, 0),
(57, 'good-cryptography-decoders', 'zian', 150, 0, 'Crypto', 'Quantum computers can crack this easily, can you?', '264e01cf11937a51d7491af9e0b93f1f1227194d', 0, 0, 0, 0),
(58, 'Are we going to do math?', 'zian', 200, 1, 'Crypto', 'Why do we need to do math as cybersecurity people?\r\n', '6e7091736c3b3d06a62d9cbdeb5ca7d5e6d6e093', 0, 0, 0, 0),
(59, 'X marker', 'zian', 125, 0, 'Crypto', 'X marks the spot. ', '029949406604f07a9e238474fb8327fbd2067dd0', 0, 0, 0, 0),
(60, 'Simple RSA', 'zian', 100, 0, 'Crypto', 'really really easy rsa. ', '6606c2c07e3146b4ba722e4417a0e1397a9f5784', 0, 0, 0, 0),
(63, 'I GOT SCAMMEDDDDDD!!!!!!!!!!!!!!!!', 'poppet', 50, 0, 'Forensics', 'All my bitcoins got stolennnn :(((((((\r\ni found the hackers wallet address to be\r\n1JLYY4yXGunJ5LHKUJiXH2ekfNC5su6xkA, help me find out\r\n(try googling some tools for Bitcoin wallet!)\r\na. How many transactions are there?\r\nb. What is the latest transaction ID?\r\nWrap your flag in this format: RVCTF{a, b}', '89345246563f58532bb8b159f17a07ce13d9f41a', 0, 0, 0, 0),
(64, 'Please do this it is really easy or else im sad :(', 'zian', 100, 0, 'Crypto', 'please do this please do this please do this plwease sdo this [pwlease do this [lease do this', 'cf1319f967cc1cc5efbacc26afa87ae18c530a5b', 0, 0, 0, 0),
(66, 'Tetris Addiction', 'Aarogant', 200, 1, 'Reverse Engineering', 'Bro my friend is seriously addicted to Tetris. He keeps on telling me that he&#039;ll stop, he&#039;ll quit but its even affecting his grades he&#039;s not even doing homework anymore. The other day he told me that he &#039;can turn anything to tetris&#039; and that he has become &#039;one with the tetris gods&#039;. ??? do I need to call IMH ??? (P.S use a Chromium-based browser for the game)', '96c8cdcb1d8174fc514ffe9dc130c872303d7a0c', 0, 0, 0, 0),
(68, 'AYCEP_chal1', 'Kaligula', 200, 1, 'PWN', 'PWN challenge from aycep\r\n\r\npassword: maverickinsecurityincgroundfloor\r\n\r\n', 'bdacefd85282b2cb34747d2499a5ce55256d3d52', 0, 0, 0, 0),
(71, 'Strange RSA', 'zian', 300, 2, 'Crypto', 'Strange RSA...', '86870a9db378637e1ba1d0f0694f03ade15e067e', 0, 0, 0, 0),
(72, 'Pwn100', 'fern', 100, 0, 'PWN', 'Welcome to the first pwn challenge! Can you exploit this program to get the flag? flag format is blahaj{...} P.S. This question requires docker to solve', '717552d46aabc22bc470dfe9c4dfe10963914c9d', 0, 0, 0, 0),
(73, 'SarahsQualityLearning', 'HCIRS', 600, 2, 'Web', 'Sarah the studious has created a website to help her study. Let&#039;s crack into this website and steal her SECRET notes!\r\n\r\nPS: take screenshots of the flag for me to send u the real flag, the ones that you should find are in the form IRS{...}\r\n\r\nthank HCIRS (*I stole their questions :3)', '98be15d3641646af275cbc8697d03885cca14f21', 0, 0, 0, 0),
(74, 'Extraction', 'Zian', 300, 1, 'Forensics', 'This image is not as it seems. ', '3c9f18ed21730170e3946e9cb8106b86187743c9', 0, 0, 0, 0),
(76, 'POST-PCAP-CLARITY', 'zian', 150, 0, 'Forensics', 'yeah uh... what am i doing again?', '0d8c2f6b31e1a288d3b13c00c3ceddbc991c1386', 0, 0, 0, 0),
(78, 'INTRO to RVCTF:1', 'poppet', 25, 0, 'Crypto', 'EIPGS{W0VA_HF}\r\n\r\ni found this scribbled to the back of a hard drive, whats it trying to say???', '6cf8e39beb8b6de407c0f7519300e8955bca54e5', 0, 0, 0, 0),
(81, 'is this really nooby rsa?', 'zian', 400, 1, 'Crypto', 'is this easy? or deceptively easy?', '3d57f8d03c854e26eeb1cde258f4a7d18a144a3e', 0, 0, 0, 0),
(82, 'How is this a presentation?', 'zian', 150, 0, 'Forensics', 'i thot that there would be smth else more than a presentation...\r\n', 'da8fbd4eefb19cfcc7391778a8ce5d602b6df09e', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `completedchallenges`
--

CREATE TABLE `completedchallenges` (
  `completion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ctf_config`
--

CREATE TABLE `ctf_config` (
  `id` int(11) NOT NULL,
  `start_time` bigint(20) NOT NULL,
  `end_time` bigint(20) NOT NULL,
  `freeze_override` tinyint(1) NOT NULL DEFAULT 0,
  `freeze_done` tinyint(1) NOT NULL DEFAULT 0,
  `casual_mode` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ctf_config`
--

INSERT INTO `ctf_config` (`id`, `start_time`, `end_time`, `freeze_override`, `freeze_done`, `casual_mode`) VALUES
(1, 1747228800, 1747236000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ctf_users`
--

CREATE TABLE `ctf_users` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `username` text NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `frozen_points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ctf_users`
--

INSERT INTO `ctf_users` (`id`, `email`, `username`, `admin`, `frozen_points`) VALUES
(5, 'chua_zhong_ding@students.edu.sg', 'Zhong DIng', 1, 0),
(6, 'xing_zian@students.edu.sg', 'Zian', 1, 0),
(7, 'liang_jun_cheng_aaron@students.edu.sg', 'Aaron', 1, 0),
(8, 'duanmu_chuanjie@students.edu.sg', 'Chuanjie', 1, 0),
(9, 'chan_si_yu_david@students.edu.sg', 'David', 1, 0),
(10, 'liou_larissa@students.edu.sg', 'Larissa', 1, 0),
(11, 'chew_jin_hao@students.edu.sg', 'Jinha', 0, 0),
(12, 'lin_yuen@students.edu.sg', 'Lin Yuen (Rvhs)', 1, 0),
(13, 'anna_sophia_acquavella@students.edu.sg', 'Anna Sophia Acquavella (Rvhs)', 1, 0),
(14, 'valerie_chia_boon_hwan@students.edu.sg', 'Valerie Chia Boon Hwan (Rvhs)', 1, 0),
(15, 'tan_zhu_mo@students.edu.sg', 'Tan Zhu Mo (Rvhs)', 1, 0),
(16, 'low_voon_zhong_daniel@students.edu.sg', 'Low Voon Zhong Daniel (Rvhs)', 0, 0),
(17, 'shi_yu_xiang@students.edu.sg', 'Shi Yu Xiang (Rvhs)', 0, 0),
(18, 'caden_chung_ming_jie@students.edu.sg', 'Caden Chung Ming Jie (Rvhs)', 0, 0),
(19, 'lee_kai_ming_nicolas@students.edu.sg', 'Vexdru', 1, 0),
(20, 'siew_jing_fei@students.edu.sg', 'Siew Jing Fei (Rvhs)', 0, 0),
(21, 'foo_ting_yee_chloe@students.edu.sg', 'Foo Ting Yee Chloe (Rvhs)', 0, 0),
(22, 'wong_chi_to_aidan@students.edu.sg', 'Wong Chi To Aidan (Rvhs)', 0, 0),
(23, 'tan_zi_rui_1@students.edu.sg', 'Tan Zi Rui (Rvhs)', 0, 0),
(24, 'zhao_bocheng@students.edu.sg', 'Zhao Bocheng (Rvhs)', 0, 0),
(25, 'ding_kaiyu@students.edu.sg', 'Ding Kaiyu (Rvhs)', 0, 0),
(26, 'lim_zheng_rui_alexander@students.edu.sg', 'Lim Zheng Rui Alexander (Rvhs)', 0, 0),
(27, 'zhang_renwen_1@students.edu.sg', 'Zhang Renwen (Rvhs)', 0, 0),
(28, 'trevor_tan@students.edu.sg', 'Trevor Tan (Rvhs)', 0, 0),
(29, 'charles_ng_jun_siang@students.edu.sg', 'Charles Ng Jun Siang (Rvhs)', 0, 0),
(30, 'yong_zhen_kang@students.edu.sg', 'Yong Zhen Kang (Rvhs)', 0, 0),
(31, 'lee_zhi_xun@students.edu.sg', 'Lee Zhi Xun (Rvhs)', 0, 0),
(32, 'keith_lee_wei_ming@students.edu.sg', 'Keith Lee Wei Ming (Rvhs)', 0, 0),
(33, 'kong_teck_nyin@students.edu.sg', 'Kong Teck Nyin (Rvhs)', 0, 0),
(34, 'kenrick_tan_zheng_kai@students.edu.sg', 'Kenrick Tan Zheng Kai (Rvhs)', 0, 0),
(35, 'wang_xilin@students.edu.sg', 'Wang Xilin (Rvhs)', 0, 0),
(36, 'srinivasan_nitin@students.edu.sg', 'Srinivasan Nitin (Rvhs)', 0, 0),
(37, 'goh_yan_bin_1@students.edu.sg', 'Goh Yan Bin (Rvhs)', 0, 0),
(38, 'tan_yi_wei@students.edu.sg', 'Tan Yi Wei (Rvhs)', 0, 0),
(39, 'yu_chengxin_sindya@students.edu.sg', 'Yu Chengxin Sindya (Rvhs)', 1, 0),
(40, 'chen_jiaquan@students.edu.sg', 'Chen Jiaquan (Rvhs)', 0, 0),
(41, 'sun_leran@students.edu.sg', 'Sun Leran (Rvhs)', 0, 0),
(42, 'bhambri_kavin_namit@students.edu.sg', 'Bhambri Kavin Namit (Rvhs)', 0, 0),
(43, 'jake_ling_kae_eun@students.edu.sg', 'Jake Ling Kae Eun (Rvhs)', 0, 0),
(44, 'wang_xinyi_12@students.edu.sg', 'Wang Xinyi (Rvhs)', 0, 0),
(45, 'candice_ho_xin_ying@students.edu.sg', 'Candice Ho Xin Ying (Rvhs)', 0, 0),
(46, 'gu_jiale_1@students.edu.sg', 'Gu Jiale (Rvhs)', 0, 0),
(47, 'liu_yida@students.edu.sg', 'Liu Yida (Rvhs)', 0, 0),
(48, 'guo_zonglin@students.edu.sg', 'playitprobro', 0, 0),
(49, 'sim_hong_jun@students.edu.sg', 'Sim Hong Jun (Rvhs)', 0, 0),
(50, 'branson_lee@students.edu.sg', 'Branson Lee (Rvhs)', 1, 0),
(51, 'gabriel_lim_zhexi@students.edu.sg', 'Gabriel Lim Zhexi (Rvhs)', 0, 0),
(52, 'palakkal_arjun_sarath@students.edu.sg', 'Palakkal Arjun Sarath (Rvhs)', 0, 0),
(53, 'zhu_jingxuan@students.edu.sg', 'Zhu Jingxuan (Rvhs)', 0, 0),
(54, 'kuan_yue_han@students.edu.sg', 'Kuan Yue Han (Rvhs)', 0, 0),
(55, 'tan_zhi_hao_4@students.edu.sg', 'Tan Zhi Hao (Rvhs)', 0, 0),
(56, 'lim_enoch@students.edu.sg', 'Lim Enoch (Rvhs)', 0, 0),
(57, 'lim_xuan_wei_wayne@students.edu.sg', 'Lim Xuan Wei Wayne (Rvhs)', 0, 0),
(58, 'andreas_surya_tanjung@students.edu.sg', 'Andreas Surya Tanjung (Rvhs)', 0, 0),
(59, 'aadila_basheer_ahamed@students.edu.sg', 'Aadila Basheer Ahamed (Rvhs)', 0, 0),
(126, 'lai_yi_zhe_lucas@students.edu.sg', 'oiu890', 0, 0),
(127, 'zhang_hengwei@students.edu.sg', 'Zhang Hengwei (Rvhs)', 0, 0),
(128, 'tan_chuan_sheng@students.edu.sg', 'C.C', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pending_invite`
--

CREATE TABLE `pending_invite` (
  `id` int(11) NOT NULL,
  `user_email` varchar(512) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pending_invite`
--

INSERT INTO `pending_invite` (`id`, `user_email`, `team_id`) VALUES
(6, 'ding_kaiyu@students.edu.sg', 29),
(8, 'ding_kaiyu@students.edu.sg', 44),
(9, 'ding_kaiyu@students.edu.sg', 46);

-- --------------------------------------------------------

--
-- Table structure for table `teamates`
--

CREATE TABLE `teamates` (
  `teamate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teamates`
--

INSERT INTO `teamates` (`teamate_id`, `user_id`, `team_id`) VALUES
(11, 6, 21),
(12, 5, 22),
(14, 10, 22),
(15, 11, 24),
(17, 7, 26),
(19, 24, 28),
(42, 25, 28),
(45, 26, 53),
(46, 18, 28),
(47, 28, 28),
(48, 32, 54),
(49, 19, 55),
(52, 38, 57),
(53, 39, 58),
(54, 54, 58),
(55, 126, 55),
(56, 48, 55),
(57, 56, 58),
(58, 128, 55);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `teamleader_id` int(11) DEFAULT NULL,
  `frozen_points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `teamleader_id`, `frozen_points`) VALUES
(20, 'test', NULL, 0),
(21, 'openlyracist', 6, 0),
(22, 'RdeV', 5, 0),
(24, 'VedR', 11, 0),
(26, 'Aarogant?', 7, 0),
(28, 'DDOS', 24, 0),
(29, 'skibidi corporation', 26, 0),
(44, '      .Ì·Ì¨Ì¡Ì¡Ì¢Ì¢Ì¡Ì¡Ì¢Ì¡ÌœÌ¦Ì¤Ì—ÌŸÌ«Í–Í™ÍšÌ—Ì¤Í‡Ì¹ÌŸÌ¦Í•Í“Ì±Ì¤Ì»Ì Ì¯Í‡Ì¯Í“Ì©ÍˆÍ•Ì£Ì™Ì™Í•Ì»Ì£ÌŸÌ²Ì˜Í•Í‡Ì™Í‡Ì˜Í”ÌœÍ“Ì³Ì³Ì™Ì Ì–Ì­Ì¦ÍšÌ˜Ì™Í–Í•Ì˜Ì®Ì¼ÌÌºÍ”ÍšÌ–ÌÌ«ÍˆÌÍÌ¥Í•ÍšÌªÍ”Ì˜Ì Í–Ì˜Ì Ì£ÍšÌ¹Í™Ì™Í”Ì‡Ì†Ì¿ÌÌ“ÍŠÌÌŽÌÍ—Ì¾ÌÌ€Ì”Ì‹ÌˆÌÌŽÌÌ¿ÌÌÌ†ÌÍ‚Ì‰ÌÍ‹', 26, 0),
(46, '.Ì·Ì¨Ì¡Ì¡Ì¢Ì¢Ì¡Ì¡Ì¢Ì¡ÌœÌ¦Ì¤Ì—ÌŸÌ«Í–Í™ÍšÌ—Ì¤Í‡Ì¹ÌŸÌ¦Í•Í“Ì±Ì¤Ì»Ì Ì¯Í‡Ì¯Í“Ì©ÍˆÍ•Ì£Ì™Ì™Í•Ì»Ì£ÌŸÌ²Ì˜Í•Í‡Ì™Í‡Ì˜Í”ÌœÍ“Ì³Ì³Ì™Ì Ì–Ì­Ì¦ÍšÌ˜Ì™Í–Í•Ì˜Ì®Ì¼ÌÌºÍ”ÍšÌ–ÌÌ«ÍˆÌÍÌ¥Í•ÍšÌªÍ”Ì˜Ì Í–Ì˜Ì Ì£ÍšÌ¹Í™Ì™Í”Ì‡Ì†Ì¿ÌÌ“ÍŠÌÌŽÌÍ—Ì¾ÌÌ€Ì”Ì‹ÌˆÌÌŽÌÌ¿ÌÌÌ†ÌÍ‚Ì‰ÌÍ‹Ì†ÌƒÍ’', 26, 0),
(53, 'sus', 26, 0),
(54, 'RVCTF{pineapple}', 32, 0),
(55, 'Sentinels of Vigil', 19, 0),
(57, 'segfault', 38, 0),
(58, 'f1nger', 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_solves`
--

CREATE TABLE `team_solves` (
  `team_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `solve_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `token_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`token_id`, `user_id`, `token`) VALUES
(19, 5, '87dff39d022fbb589cd5e5bdf6b63a612c084f4cd5875b932cceb6d99d196f30'),
(20, 5, '2805fa1bde50d600d17674d4270eb94ac62c8d995885ce40ff6917f3367df0a9'),
(21, 5, '268c15a7187d9e2cbdfcb1b45de27c64ead42d3104de42f0fdba23dab5b11255'),
(22, 5, '447c02695cb471473d6ca96865f052c3841e7f656d7c84233378c48ff7a1c538'),
(23, 5, 'ac3ede5aa62d7c090f32441a1c4c2e5509e7d0c8dd8161dea20b2a2afe8da68c'),
(24, 5, '4995fb1a0090012a755f26aaf8d5907518449da3a21309b351dfc35549b1cfcb'),
(25, 5, '178497f590e6635d8c6f34fa20e4038ded02151686a1e50f22d7680199e17766'),
(26, 5, '380a5a6d96d1435ddd0aa92a8e3d3ec31e7059222ebf7b9376d0834a84c30c6f'),
(27, 5, 'b107be3a156b7368a65f2ddddc430d1839ef7f79b93bca254ffbbd4dd158bcba'),
(28, 5, '2f9b588989f9ecd7e9c493246604f715af39b1f7ca911424c841bac1029e3258'),
(29, 6, '6131d65990c2e8b7fe16dd7d3829a738e1d2d19dbf02d58242b94e00d6daf7cd'),
(30, 7, '1894443e2b5505ab296d081a6e250809bab658013900fa2de41d8a7c259848bd'),
(31, 8, 'f773a98212759da0e8d4df9e66e53e99e7096dca687ec9e982315ccfea5a7c81'),
(32, 9, '3de02aac31ddecac08927462e50225138cde6d70e5a4b8ac0b2ecbbee961aa04'),
(33, 6, 'bd2beb440c1914d2ee9d3dc59978bb6a0172c6a55cce64693f3e99e6d54d67bf'),
(34, 8, '78247b7a1b6cdff2e3590e6ec9dcb5340be656601c4188e07f124a9ea856509f'),
(35, 6, 'd5ba2d23db5e7f3116501e088206efb64a871e78a4a26ac42ea132db441641e8'),
(36, 10, '95ad348e63f0a8f671fb0b660bd4ee4a1a4cd92da78fd01fcc550976b06a09dd'),
(37, 11, 'f0af419a900031bf920a6d6abfa0b34140989ab26b3622d55d15a7133ddd97ed'),
(38, 7, 'f2308a19cfd621c49463896ecc7d5953240f0f273d956900b5137c7b370af15c'),
(39, 7, '75b533836a5bb9f162815bf6ee136eff3bab5a0b981a4c0a98fe5a2d286232c0'),
(40, 5, 'e2495779ffe0c3ac7cd47d1d8c60d686f08f02a71c7900fe912f989819b8d203'),
(41, 8, '7c51ac25dd8f1b4e6faa729de67702ee921d9179bb2b87a0676e8cc8ab5699ed'),
(42, 8, '9fa6227067290082906d898c70a8b82a70e8a3ef40e7f8f7ef243e7b896082a3'),
(43, 6, '3bd13284d9b22bfb57f76b57354f002a8b450535a3d94bcaa4a2f6083bd00019'),
(44, 5, '83cd7757a01ce5da520554d4ba8f66cac2c08faf4bba4ddd6f17d2ed42157a11'),
(45, 12, 'ff3190ee223f22bc933a11d5a14645827971547f740b295d473712c583cd0765'),
(46, 13, '971e3578a5b488a6409cb4eb0623e9d39a24cf6eb8b2a0e0fbb87c0cef80d1f5'),
(47, 14, 'fcb64bdf7181332bb6de7375b86d21bf5171db95ae70a0367917251fdbc16a67'),
(48, 13, '7a5f5d6dc4220561413c0d84f136116872a7f08865868c058faefcfbcb611996'),
(49, 14, 'f48cf7e659f095939ec79b5a44bfbe86b2596ef8100eadf393ea50dc7327f0a2'),
(50, 14, '55d997d7c70886b957bcc77407396f95ce75e92c76742fd4550fac962e18673d'),
(51, 8, '62c178e28b07984e7c24c14da8eab4ce8903989c8b484faa194d83e44aab452f'),
(52, 14, '9ec526ffd6c08c905bf42c725e2b4c4e21009c17da918b7abbe0429befd6ce49'),
(53, 14, '707b6f65b467af56218952c77208db99494c8ce9e0f5c0d530858c3ea43a4e76'),
(54, 5, 'a4a83f27ce6259d53902b1817fd49d97b4a01ed29070f09890a4ce53a3c7ff3a'),
(55, 15, 'aec3a5b63fb981b6508deb52f57a5a5e51329ed1c0ff2805b8c1c2670f866622'),
(56, 15, '58ccebf248b3c224b51f21e3423881075da9874db92326a8c40f46cd907b0b14'),
(57, 7, '7a94b5103dd26c3042ed13a409ffc0da8a3ced83be16a3cd6702b88878c62611'),
(58, 10, '422750114631df4f24f25fce4af94e942d917de6aaf2901109321a22edf568ee'),
(59, 16, '44b595e911090644282a4e97ae883b14b3cced7a022b2c5dbc6c5f34a6e81733'),
(60, 6, '23148bf15be3aa07da6dc08b3616d49472f2994ab73cc090c238fe5824026988'),
(61, 8, '9f877914f9650d81c5e685f2e8e306fbae3f1d77603a707dad13deb0de16f168'),
(62, 10, 'f0b2befb80daf2f9fb3c9fd8e0f040d35dca6a0e4c70dd705bf6497a00cea7f2'),
(63, 17, 'd3037d67ed8c4de5e59fd791972aef33f69990a40f26a6e4beb79d3760cf6d8d'),
(64, 18, '823e9a70637797ee47271aaa4e651d8b8fa2d37e03653f2dba943ff311e0947e'),
(65, 18, '7051dc3895c0af086af48b46944ee5237d5c2811b7b083616efefdc1014a9f17'),
(66, 19, 'cdea9ef9f5743749cf540a9c293aa47f13f45728a99d55cb8279025a68ecc4f7'),
(67, 20, '829b9517945e2e769e1b21de52d76bcfaf1e8d9882cb08ab6debbbd4a5f92dfa'),
(68, 21, '3523f9e5e35d1531f06ca700ab6457ac9cc23ef20807e76e69f3fce3fd8c9dd8'),
(69, 8, '19dbb9f190149dc9b7389e345210c9074c9f65e5c05b2654d63628bd78b3dda3'),
(70, 8, '4d02635ab9f6ae9fe354b18952f6da253e685011ea216f37f04ed089c77c278b'),
(71, 10, 'd1c75cc5d0d156bb3c157e6497229fcff9c20000126d9216746f672e187e8d94'),
(72, 6, '2e141f2992358c17b05de4c99776caadca44edb2739723de97b85c987f6b30b9'),
(73, 22, 'cc90524240bb80d9ab5e1e4721c28d0c8e2233171cc94b9e2df1453aa2684d13'),
(74, 22, '6a8d0acb6d60fcd211131b8933f10123eb80dc0ce2f11f48236a6fa3673d4881'),
(75, 23, '3294db0023be08e0a573bba46c8c7dcdd0548a1e4f44d9f5543cb451a4a9d275'),
(76, 24, '58b02578349f021b362a99c0d9608e9e8744207e6bc377f0e64142526d0f5af1'),
(77, 23, 'c378ab3ab592c502410cfb162c89e2ebab5f129caf0aefbfe691b544e4be67a1'),
(78, 24, '89e205302da92ac2d20b4fe68b1399e0ac90194e683e0e14ab6f94d52bb93386'),
(79, 25, '9254121d44f7799b503e950deaded4c6f085ac244d319ee4a0960dbd23c39771'),
(80, 26, '4d9bee124ec82f54df553ef8368b1cae55f4e8f309a7ff3e9490f40701214e0a'),
(81, 26, 'd91e936425493015932f45e8ba31b23c03745d4e552da662db6ee6b8776ca95d'),
(82, 26, 'f8d1be879861b49db5a97067334c12f75b21b35548e0fb57721a34cfac2e4bcd'),
(83, 26, 'bd64f072015ca37f695afb63c7e392c9e3c227a24fca2ea72f140ca56c5a4f5f'),
(84, 25, '6684b86d79cae16b60297985ea7ef49797f5df786d82d4dbc2594125ff5dee93'),
(85, 25, '0d5254f252a40c0bd9c1cd9acf9bfac5d1a6725fa3f93c00cb682d3bce310b94'),
(86, 24, '363264424bffe5e83b0c38d78c4a7169815cc8f27bcc630085768fc88f97d754'),
(87, 26, '853c6c43c57c630b611a93a7365a9231b5cd4d3410201910967f073dd70364bf'),
(88, 26, '71853b36869c618c9a078b61ea548ef4689b2bf9ca306755cd3ff90f8d85ceea'),
(89, 26, 'e14e71aa24b000097aab6edf8806242af1aa66897b5d1370c786a0fd797a328c'),
(90, 26, '98fdf7a5e7b6b4f4fbfa3b41d500a0bb70233507ac5b678499120c126eb62921'),
(91, 26, 'c9ffcb62f3d5bf7fbbf4121fe3913dd70b474b905440d0125a54801744abba28'),
(92, 26, '7130b709f5e9f868e1097f3662964acd12aae0294901b268ef005e03aa1b5f83'),
(93, 27, 'ef12ffa24a601562358f16d5df266d5fd03fea84e88976d8e333b7eb7490a3e6'),
(94, 28, '121fe3dfce5e62255dfdd9071d7d48d720fda7aef92d8fe3c27519ea18582ec5'),
(95, 29, '89ff408d01efbdc89d2e42991a5b6ee3d5a0bee9196409aa4b4ef7c707d7f0ce'),
(96, 22, '98ea7377ca65294c6d0e92e1b9c2e59004c7dd7c99e88a1e600af2739e1c9f36'),
(97, 22, '25158b33722c0a3faf17ef54f1b1e19d25c094a9ba5dcfaf582c3e9e911ea6ff'),
(98, 22, '27d69c82e97f7e2e245971fe183c292d0581b56cb5e0a484e5bda77584db0423'),
(99, 25, '2985c072b78c874a302284e4cd64b55e0c2f33891dbaeee1994adcbe9597e71d'),
(100, 25, 'a19bcaa5e60f16a665dd200ba9a9139595c52c80cacb7407ec976fcbde315e79'),
(101, 30, 'bd04e5a2783dce325a420301a789be7adb44209d4aa4b25b89214c81aaa14af2'),
(102, 30, 'a5d6495f31719a89874bc9664db02c527d4a3d24992ed945a2fd410d945ffcfc'),
(103, 30, 'ba0741c47f39ab2bf45d29de5933803c693834ae5b09c4fb1644db7c6d9294b7'),
(104, 31, '1edaed39801afab36fe24d2f9b159b74f28b7358551c5e504ee772faf56d11e9'),
(105, 32, '793632c0beec88e15dda20bca159b314d49fe90eed99dfa3db5006d45109f0f7'),
(106, 33, '0309caca327b13b390c48f5a6c2b062c1fd8ffd66dbe120c4336ff5bf474df52'),
(107, 32, '173f478ff441140de9d83bcc0837b6cd4f4f9a121b84d3450325d5c870033881'),
(108, 34, 'df0d0047387b2a2ffbc31321f031fecd4637d8442bb2141f1141c13e8dcb0c88'),
(109, 35, 'a8c884a1952f49f2a01212b7804a7ca6febe6125aec73790197148c9e651495b'),
(110, 36, '4cb24047bf9da2fb633da6827249f37d981bc30314747a418ca3ac3956f464b6'),
(111, 37, '701713e7afc394f3a5e72274d55aba126902daad09e1fac294975df2c7ff132f'),
(112, 14, 'b76e25b1ae07dd5abf0bf42aa6db1f425e223be97d4895bc6a0a33b586675eae'),
(113, 27, 'f4b22ce200d7db2cb6f9ad8a94bae41ea7c919ff5b233831a588468a9d8975c2'),
(114, 18, 'e2e21db6a542f306d7c3aeabb09adead7af1ad14e845da6a7387104fbe948f2a'),
(115, 10, 'a136e863a99dc55f7abd6b7115850ddbc37dc0073798fca1d36f0da651f49a5f'),
(116, 38, 'a960714e383178f5ca962268c2a50c03fa8cf7d2aa3d58aebb98b446d96059f3'),
(117, 28, '372e902a6a48416c8d9923d226c93099ddbf0e8959a4727e068f5656dcc68347'),
(118, 6, 'b7455914480fa27a85cf861babc0f9c6b15555f8e271504c040fe5b77e7b5c9e'),
(119, 39, 'cc6b986931d3f3367e401b88314c4e68b165e104fa50833c6431333ab5259842'),
(120, 39, '44cd80f4a4d5a3576b6e9c422a33faa9383e8dfb4da8be1b270ba83f7a936b83'),
(121, 30, '5e96bf3aa1b3a94dd631a737deea21d7af3f4a82566096e9045eaf48b988509e'),
(122, 40, '32178a0277fd1255e68e97a3cd02fedf97fc4f8304cad8c600884758c24442cf'),
(123, 15, 'e519316077f162b79610c7d8b075a585ea1efec31ef46a496c119b6ea8773696'),
(124, 37, '704bea5e2c76efbf3036850a4275f701de348eb1a5ee058a9772b60ad786d46e'),
(125, 37, '1d77ac49ad476f5b6346f2422014b32e67e4350b822e58c3c02fdb56b411c502'),
(126, 32, 'df824220e73fef81074cb909e67285449e2316671fe4ad9419e72c03c1b57eac'),
(127, 18, '66780d31a6bed34b97913a8a3a92015be167e5a1d506f8b218a3db89f6d2541b'),
(128, 41, 'db93f36ef9afd535eed66204546c294e567a2d65e8a0bc275fcdd055f6f2484b'),
(129, 28, '32904d88fcbd8cf09691078c857bc65f86029707077c7fd8ff4285a409600e93'),
(130, 42, '2961be13509405aea3f260c1d4a603fddf5ba6d961562ef1a8e90e1d0a1a1e75'),
(131, 18, '3a1105c97eafb994c00cf2cb81def5cf2eb40aaf601689a8a3290ebc9a5834ad'),
(132, 19, 'c33b6f7e0a47fd563a2eac161febfb3764445cbc7399f71cb9b22123a91d5f11'),
(133, 43, '185b11bf341178545ce315e4aac98bb2e3a124d470d81b9bf78c476b7123171f'),
(134, 44, '53c80d1bbdd88508035d1d2a1092a7e6696465380006f11ab4cc559959a9353b'),
(135, 45, '5a519d2c0d27ea307410a6c1fff8727bd92688f3db14c298853b4cf47c9c34b6'),
(136, 46, '344430b27eb8b33980f2e54ca6c947f63b0fce9fcfeef2e62a15228c5db93069'),
(137, 47, '6a99a9c42c110ac3f5146fa4a0dc4ff1d986a8809a4bb3af9f11966c4b823b16'),
(138, 8, '41d355d24464cad637c59f59974e919ce194622e3f911bf4a3cca0f5ae1d1a9b'),
(139, 8, '61a70952d3a4a34ccbdc2385d4699f5c26cf447070b211ff6ac414d16effe357'),
(140, 8, '75629c28e9be8fc6c880103bc99b61f0182a50c342271f8c7d67fb34dffb6fd1'),
(141, 8, '2a45e592499dc176b0ed5476f358d0608dad93632ff818f3f4b8ad0531d96a92'),
(142, 48, '769ac9c2d37ca0eac937d5fe96fd66cd46902880da09a74c57b1ba63a3cbd11d'),
(143, 49, '3280aa974fbc4a6ad3940dd3d9e60e2a9ee7cfa02545c7f430dee2df0489f990'),
(144, 50, '525ab2d008ed18afbcf556779af919b81458ae49ab5d2052785b606243313e7b'),
(145, 35, '296a817b5b3c2113f2db5491f69886eacc39cf0b62b389fac1b7e67f02563483'),
(146, 51, '4b7f3019f924bcedd8ae300a06b5520d501bf569bdac569b3a3109f1f398bb5b'),
(147, 52, '42f291c84facd95317452fbc129305984feb4c7611f6bad1fc0b14fc38c0b825'),
(148, 43, '9c3d7bee09d0d12b603e4814d3bb763e66037255501a9e371823e7d21f5018c7'),
(149, 53, 'dca376d2776458443820f1c54813b1245541017c325165e1b1c97adacc3f1706'),
(150, 49, '3f894ec9c2ab51990d1f22928ac6652646b94b40e77b252414a20f9d665b1b8c'),
(151, 24, '48c967800d90ad66b2173bac01190de28b004f0f5388b74594be4a66e1585fb4'),
(152, 18, 'b929efc4791ce2ab6da98c35ad6964f99c6d233f7861fae74e2c5df2c43a2223'),
(153, 24, '9649df80c0664964807370f754d0759113867b07b18a24396eb664a9de8e52cc'),
(154, 39, 'e0529d882deff46cd1013a60efc7300f9dc33219819dc99f2cc057311a351119'),
(155, 29, '971f964d89e865f1f7034d0902cca3152cf5effefe4753869d1e9ffbd86cd157'),
(156, 8, 'b1013f73d0e12aac97ad45b58bfd8cebc0382fc210d0016b51b6200b5134b7c7'),
(157, 25, 'c030df7479c3462205d8f822409201348f39e6abbcd12573ef61b6ae36e8ab6c'),
(158, 39, '7df310da6a4c795dfb1eeff94dce7a3f9b056642f6a09eacb2ec1b9008277f83'),
(159, 49, '0504822065c5fe139c6e70b2b60fd58e4bed9f367b63876d887fcd88851c29dd'),
(160, 49, '67de77626ec47ff24307407e101a37cdb51ba82d357b0cd23ad3f3c12e345834'),
(161, 42, 'c1e0c3317fab6308bda8946b22969d2fc204378ae4bfb5817c7bc7cbe2fe81d4'),
(162, 28, 'd8479a30e236805f9b5e1a78f55b5930db8cc18e811cd1c64117a7b5ad282d97'),
(163, 53, '813e96c4d4b54243936c0219749e22c991247b4aa99925ee58c732d39551278e'),
(164, 53, '1353bb031bd8ad11a4841545f47177968e903fb3714d9b5911bb83454a151990'),
(165, 54, 'c707b70eb099985824f4cd2e4d656e2c96d6f5772dc97d8a34bd7b6ba602cef0'),
(166, 46, 'cb71beef40e1c6743a12a96430bf066cccbba79c078608e1f57d8ceb22c78351'),
(167, 55, 'b6e7ad601745a25e4d1d286c2d389ae3266656c53b4f6ab997867650715de608'),
(168, 46, 'e1a171d8cd770cb114c81604dc25bca7ce75b632e76b92f05695094d715e057e'),
(169, 56, '9d38d70dd8801e29c7efaef3da4cdbc3e0a2e66be73ac3ffcd51212c5e04a72f'),
(170, 28, 'd0bb7d0623fba7220ff470878e969be0fa4c26fb2316bdd05201a0d9134cd3b4'),
(171, 57, 'a9b576731a276f2b12b0f9677bbb70beef93e4a78ba5d761ff441710df276c30'),
(172, 25, '4d4c7028e9303aec42e41f06000e73afa51dee36163d30a468ba39b6aa11f1ef'),
(173, 57, '967e96568d41f1d19b1ab0884b784c5f457cbcc2adbcb77f6d9b91283b5d39ac'),
(174, 28, '3d42c226bd14946cee06344e84d35c978db645c30a5c48eb72c0bccccdc11add'),
(175, 31, 'c471a3b73a711f9ea3f51044fe02f93924ab4559c6eae6e11390cb091d40099c'),
(176, 10, '08a7a5b1794b04e6f6ae2a24a7a44fdace671e4067492eeccbf47ce90e7ab9a4'),
(177, 32, '3350664268f4a13df4ef3f122da4fcbb2c3dd65dbd32071c16496652dff6c4db'),
(178, 58, '5fa0ce3a335956a4e0f1a1e9013b7fcce7b10558faa025de9838979ffb6206d8'),
(179, 6, 'e50c74c683fceed2152269ce989f7792ad11c68989c72286731f681ce339c98e'),
(180, 25, 'b62a315aab41eb0ad688a7174a000e3476d086b6453a178e28cf8efa3784e568'),
(181, 43, 'c139cac335714520c56434025f4f156d3e581287de98cd8bdcdb48b0db31cdf1'),
(182, 59, '67da35964268bb451dc89affeadf8d2e6b44d5314795dff01ba5edaf82eba360'),
(183, 6, 'fe67a30ee75b81447eb2913c925920db8dc2b5e50201f85ff8f669377d40c641'),
(184, 28, 'ac2669b050ec09b9b0abc197bea06cd2e5803261f61d822a0abcb79f68795747'),
(185, 19, '78281b39f68660fb55c02fd743b6bfff201c0aa4cc7e347d5c094302c2157922'),
(186, 19, 'e9129163449f1d88996131b325bfb7483ed75b83ebbd3c08981df820aac9a40f'),
(187, 19, '9952834f8355f6ed32daea627dffb5b9a266877ae4e4b97f16225990fd85bd26'),
(188, 19, '541b5d6ecdb2b1110a9cb427cce37648fd901f3eb8f5c3e39e2664ea4da63466'),
(189, 19, '46cd6cb78ea3b41fd798f5b1134b08a7b3c9dc69eeaa97a396c734a798d2903b'),
(190, 39, '15317ed1d37489d717f483467aa97a783a5116bdc1050c6082139fe37a73625e'),
(191, 38, 'ae0841680a20adbbb52e1c0adda13d8ac334032798e3bcaf477ebb66c816f789'),
(192, 39, '4570054f877a45baf7e979338da4e66ed1a2f9cb42e10112a0faeca012b52473'),
(193, 8, '66df5084d98d5346a1d7209841985bf0cde41059483ce7cdf491cdc3184914a7'),
(194, 39, '70d50f661d5ee5185aa45c6fec942002cd0d3060d564886f2de6c0fd2b8b1cc9'),
(195, 39, '4e28ed993ffbf97f032695650f55df45b716dec131a39f95f47b9866f9050f30'),
(196, 39, '103566b218e9a03135e1b6b9da218e685a15cc215ad37e5d32fbccc1f786d805'),
(197, 39, 'fe46b4761a06b5cf86f04da031a63dfd5df5c8fcd8256996cdf00fbb6bdf6ec0'),
(198, 54, '12e2dd69e1528a5be2f00538530fd0658eb3cff3635f364fb3bea2fd179ab40c'),
(199, 39, '6d6e35116e1d876833077753d86397e9e78269cefa7fec8057ba304aea0e9743'),
(200, 39, '66b18f5e6a7173fdb5c9a4f487ac1dda1abb574e314c706160a3ff5a1aa44f14'),
(201, 39, '19f188d4d2cc0422625cfce61ee5293398f3d141c1c6162551d9838f5c8d8f4d'),
(202, 39, 'b760aa34282993be886033e1c4ddac53de6d7ec364ba23b87b488e3332bc43ce'),
(203, 39, 'dbda14a1e0e11cbc565ee2301dedddd119a3589d0cb40a92c9083b389ee2eb0c'),
(204, 39, 'ebf505b002da1bb6509e51439529799981bb231a92f78c269c618e18bd607160'),
(205, 39, 'd4c7714502e432b143e857e246a9183a05aa7e34dafa8be2df66bb5d8c1b863f'),
(206, 126, '8e19a769a4f295b0fd00251ece257e28d7793824da8b203e792ce2e4a0239b60'),
(207, 48, '87dd3e20a5dace40b8433f1b038a057f37cd5c6f866ff7566020a7b6c6247089'),
(208, 56, '67dc464fc724e3e78000c7e34476d41cc44cc66b5089deb0f98478fa4a657bc8'),
(209, 44, '9148fcdcedeea0a4c78c698d0b46db095ddb7db74f9af14b812c456888d424d7'),
(210, 127, '5a369c090d3d013d959500d969e9f3b3578284ff2204fa838261a6ee9e606256'),
(211, 127, 'a0c16b1f6487bcdefda777d40eb4d069866fb6a66831e06290f191513cb1be13'),
(212, 128, 'ff2f8c8b7c09e2a0e836c8dc1ef8b1cc7caf63789fa915228b7ebacf41105bad'),
(213, 42, '9794cfbd2b91995660959d40cbda4ec5f8c9e319bb23bb2aef588fcf4f11e8df'),
(214, 42, 'c180709f4abc8563dca2458f6837191d068a1a9ed3edfb0e0e8f8520d5672d73'),
(215, 19, 'abeca261735ee91edc3593954e392f7735f99594fb1e8cff272aab926cfc1baa'),
(216, 19, '41ca652baf9c8bfb19ad8bcbcfaaa3b830c8e71ca6ce98f323c0974b0101343b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_materials`
--
ALTER TABLE `additional_materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `challenge_id` (`challenge_id`);

--
-- Indexes for table `admin_points`
--
ALTER TABLE `admin_points`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completedchallenges`
--
ALTER TABLE `completedchallenges`
  ADD PRIMARY KEY (`completion_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`challenge_id`),
  ADD KEY `completedchallenges_ibfk_1` (`challenge_id`);

--
-- Indexes for table `ctf_config`
--
ALTER TABLE `ctf_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctf_users`
--
ALTER TABLE `ctf_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `pending_invite`
--
ALTER TABLE `pending_invite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`,`team_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `teamates`
--
ALTER TABLE `teamates`
  ADD PRIMARY KEY (`teamate_id`),
  ADD KEY `teamates_ibfk_1` (`team_id`),
  ADD KEY `teamates_ibfk_2` (`user_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `teamleader_id` (`teamleader_id`);

--
-- Indexes for table `team_solves`
--
ALTER TABLE `team_solves`
  ADD PRIMARY KEY (`team_id`,`challenge_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `tokens_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_materials`
--
ALTER TABLE `additional_materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `completedchallenges`
--
ALTER TABLE `completedchallenges`
  MODIFY `completion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ctf_config`
--
ALTER TABLE `ctf_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ctf_users`
--
ALTER TABLE `ctf_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `pending_invite`
--
ALTER TABLE `pending_invite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teamates`
--
ALTER TABLE `teamates`
  MODIFY `teamate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_materials`
--
ALTER TABLE `additional_materials`
  ADD CONSTRAINT `additional_materials_ibfk_1` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin_points`
--
ALTER TABLE `admin_points`
  ADD CONSTRAINT `admin_points_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ctf_users` (`id`);

--
-- Constraints for table `completedchallenges`
--
ALTER TABLE `completedchallenges`
  ADD CONSTRAINT `completedchallenges_ibfk_1` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `completedchallenges_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `ctf_users` (`id`);

--
-- Constraints for table `pending_invite`
--
ALTER TABLE `pending_invite`
  ADD CONSTRAINT `pending_invite_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `teamates`
--
ALTER TABLE `teamates`
  ADD CONSTRAINT `teamates_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teamates_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `ctf_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`teamleader_id`) REFERENCES `ctf_users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ctf_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
