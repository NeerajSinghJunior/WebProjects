-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2019 at 09:24 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.11-3+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ether` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `private_key` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bitcoin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fav_ico` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `captcha_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_coin_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_value` int(11) DEFAULT NULL,
  `recaptcha_public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recaptcha_private_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `chat_script` text COLLATE utf8mb4_unicode_ci,
  `analytics_script` text COLLATE utf8mb4_unicode_ci,
  `contract_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_supply` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `date_to_be_launched` date DEFAULT NULL,
  `white_paper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google2fa_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google2fa_on` tinyint(1) NOT NULL DEFAULT '0',
  `transaction_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_abi` text COLLATE utf8mb4_unicode_ci,
  `contract_network` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payments_types` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2',
  `default_token_price` int(11) NOT NULL DEFAULT '1',
  `survey_login_id` text COLLATE utf8mb4_unicode_ci,
  `survey_api_key` text COLLATE utf8mb4_unicode_ci,
  `survey_action` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `ether`, `private_key`, `bitcoin`, `site_title`, `site_logo`, `fav_ico`, `captcha_key`, `account_name`, `account_number`, `account_ifsc`, `selling_coin_name`, `coin_value`, `recaptcha_public_key`, `recaptcha_private_key`, `remember_token`, `created_at`, `updated_at`, `chat_script`, `analytics_script`, `contract_address`, `total_supply`, `date_to_be_launched`, `white_paper`, `google2fa_secret`, `google2fa_on`, `transaction_hash`, `contract_abi`, `contract_network`, `payments_types`, `default_token_price`, `survey_login_id`, `survey_api_key`, `survey_action`) VALUES
(1, 'Admin', 'admin@icodash.com', '$2y$10$zCH9rFXvPEbf5urzbwXQx.tpwf9H3vy3aaIM25VR.YKRV/OJErTSm', '0xD7798a498F7A20B1bb4116b623C1069C2B7c666c', '0x438cb6215a77629a3587b07663aadd673102b6ce258324e23d4527f12e6d0ea4', '2N8hwP1WmJrFF5QWABn38y63uYLhnJYJYTF', 'TOKENDash', 'http://stodash.levelten.org/admin_images/TUZHXHN6A3.png', 'http://stodash.levelten.org/admin_images/EQVVQE9W6M.png', NULL, 'HDFC', '123456789', '123456', 'Token', 20, NULL, NULL, 'NHVYFYIL032lAqpDCLV9loiJWYSznKu7K3F3oISfrZ8U5nJE2FmADHJ4UPQQ', '2018-11-02 09:25:10', '2019-01-03 07:55:36', NULL, NULL, '0xa40630348bb492afcd49312aa30adff1a34f5aea', '10000', '2019-01-04', 'http://stodash.levelten.org/admin_images/ZMM7VFD0JS.pdf', 'ILG2Y4HTU26PTA4T', 0, NULL, NULL, '3', '1,2', 10, 'bitexchangesto@gmail.com', 'X61KJJWVORV1YP78VR8648OIM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_bank_details`
--

CREATE TABLE `admin_bank_details` (
  `id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `bank_code` int(11) DEFAULT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_ifsc` varchar(255) NOT NULL,
  `default_flag` int(11) NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_bank_details`
--

INSERT INTO `admin_bank_details` (`id`, `account_name`, `bank_code`, `account_number`, `account_ifsc`, `default_flag`, `created_at`, `updated_at`) VALUES
(1, 'ICO Dash LLC', 8, '0000366193455', 'CHD391351', 1, '2018-12-14 12:51:39', NULL),
(2, 'HDFC', 2, '123456789', '12345', 1, '2018-12-14 12:51:39', NULL),
(3, 'Test Account', 3, '321654987', '987654321', 1, '2018-12-14 12:51:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_code_master`
--

CREATE TABLE `bank_code_master` (
  `id` int(11) NOT NULL,
  `bank_code` varchar(250) NOT NULL,
  `status` int(11) DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_code_master`
--

INSERT INTO `bank_code_master` (`id`, `bank_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MICR', 1, '2018-12-10 07:21:16', '2018-12-10 07:21:16'),
(2, 'IBAN', 1, '2018-12-10 08:47:41', '2018-12-10 08:47:41'),
(3, 'SWIFT', 1, '2018-12-10 08:47:49', '2018-12-10 12:18:37'),
(8, 'IFSC', 1, '2018-12-11 10:06:21', '2018-12-11 10:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `link_type` enum('link','html') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `title`, `link`, `body`, `link_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Token Marketing Services', 'https://bitexchange.systems/ico-marketing', NULL, 'link', 1, '2018-12-06 12:20:50', '2018-12-15 07:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` int(11) NOT NULL,
  `message` text,
  `action` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `message`, `action`, `created_at`, `updated_at`) VALUES
(1, 'Enter the GDPR legal compliance text that is required by the EU regulation', 1, '2018-11-17 08:22:07', '2018-11-22 12:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `current_dividend`
--

CREATE TABLE `current_dividend` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dividend_type` varchar(150) DEFAULT NULL,
  `payment_schedule` varchar(200) DEFAULT NULL,
  `dividend_coins` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `ex_dividend_date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dividend_payment`
--

CREATE TABLE `dividend_payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transid` varchar(150) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `dividend_type` varchar(150) DEFAULT NULL,
  `payment_schedule` varchar(200) DEFAULT NULL,
  `dividend_amt` float DEFAULT '0',
  `term_amt` float NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `ex_dividend_date` date DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `next_payment_date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `term_status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dividend_settings`
--

CREATE TABLE `dividend_settings` (
  `id` int(11) NOT NULL,
  `note` text,
  `status` int(11) NOT NULL,
  `dividend_type` varchar(150) DEFAULT NULL,
  `payment_schedule` varchar(200) DEFAULT NULL,
  `dividend_amt` float DEFAULT '0',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `ex_dividend_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dividend_settings`
--

INSERT INTO `dividend_settings` (`id`, `note`, `status`, `dividend_type`, `payment_schedule`, `dividend_amt`, `from_date`, `to_date`, `ex_dividend_date`, `created_at`, `updated_at`) VALUES
(1, '<p>One of the simplest ways for companies to communicate financial well-being and shareholder value is to say &quot;the dividend check is in the mail.&quot; Dividends, those cash distributions that many companies pay out regularly from earnings to stockholders, send a clear, powerful message about future prospects and performance. A company&#39;s willingness and ability to pay steady dividends over time &ndash; and its power to increase them &ndash; provide good clues about its fundamentals.</p>\r\n\r\n<p><br />\r\n<strong>Dividends Signal Fundamentals</strong><br />\r\nBefore corporations were required by law to disclose financial information in the 1930s, a company&#39;s ability to pay dividends was one of the few signs of its financial health. Despite the Securities and Exchange Act of 1934 and the increased transparency it brought to the industry, dividends still remain a worthwhile yardstick of a company&#39;s prospects.</p>\r\n\r\n<p>Typically, mature, profitable companies pay dividends. However, companies that do not pay dividends are not necessarily without profits. If a company thinks that its own growth opportunities are better than investment opportunities available to shareholders elsewhere, it often keeps the profits and reinvests them into the business. For these reasons, few &quot;growth&quot; companies pay dividends. But even mature companies, while much of their profits may be distributed as dividends, still need to retain enough cash to fund business activity and handle contingencies.</p>\r\n\r\n<p>The progression of Microsoft (MSFT) through its life cycle demonstrates the relationship between dividends and growth. When Bill Gates&#39; brainchild was a high-flying growing concern, it paid no dividends but reinvested all earnings to fuel further growth. Eventually, this 800-pound software &quot;gorilla&quot; reached a point where it could no longer grow at the unprecedented rate it had maintained for so long.</p>\r\n\r\n<p>So, instead of rewarding shareholders through capital appreciation, the company began to use dividends and share buybacks as a way of keeping investors interested. The plan was announced in <em>July 2004</em>, nearly 18 years after the company&#39;s IPO. The cash distribution plan put nearly $75 billion worth of value into the pockets of investors through a new 8-cent quarterly dividend, a special $3 one-time dividend, and a $30 billion share buyback program spanning four years. In 2018, the company is still paying dividends with a yield of 1.8%.</p>\r\n\r\n<p><strong>The Dividend Yield</strong><br />\r\nMany investors like to watch the dividend yield, which is calculated as the annual dividend income per share divided by the current share price. The dividend yield measures the amount of income received in proportion to the share price. If a company has a low dividend yield compared to other companies in its sector, it can mean two things: (1) the share price is high because the market reckons the company has impressive prospects and isn&#39;t overly worried about the company&#39;s dividend payments, or (2) the company is in trouble and cannot afford to pay reasonable dividends. At the same time, however, a high dividend yield can signal a sick company with a depressed share price.</p>\r\n\r\n<p>A dividend yield is of little importance for growth companies because, as we discussed above, retained earnings will be reinvested in expansion opportunities, giving shareholders profits in the form of capital gains (think Microsoft).</p>\r\n\r\n<p><strong>Dividend Coverage Ratio</strong><br />\r\nWhen you evaluate a company&#39;s dividend-paying practices, ask yourself if the company can afford to pay the dividend. The ratio between a company&#39;s earnings and net dividend paid to shareholders &ndash; known as dividend coverage &ndash; remains a well-used tool for measuring whether earnings are sufficient to cover dividend obligations. The ratio is calculated as earnings per share divided by the dividend per share. When coverage is getting thin, odds are good that there will be a dividend cut, which can have a dire impact on valuation. Investors can feel safe with a coverage ratio of 2 or 3. In practice, however, the coverage ratio becomes a pressing indicator <span class="marker">when coverage slips below about 1.5, at which point prospects start to look risky</span>. If the ratio is under 1, the company is using its retained earnings from last year to pay this year&#39;s dividend.</p>\r\n\r\n<p>At the same time, if the payout gets very high, say above 5, investors should ask whether management is withholding excess earnings, not paying enough cash to shareholders. Managers who raise their dividends are telling investors that the course of business over the coming 12 months or more will be stable.</p>\r\n\r\n<p><strong>The Dreaded Dividend Cut</strong><br />\r\nIf a company with a history of consistently rising dividend payments suddenly cuts its payments, investors should treat this as a signal that trouble is looming.</p>\r\n\r\n<p>While a history of steady or increasing dividends is certainly reassuring, investors need to be wary of companies that rely on borrowings to finance those payments. Take the utilities industry, which once attracted investors with reliable earnings and fat dividends. As some of those companies were diverting cash into expansion opportunities while trying to maintain dividend levels, they had to take on greater debt levels. Watch out for companies with debt-to-equity ratios greater than 60%. Higher debt levels often lead to pressure from Wall Street as well as from debt-rating agencies. That, in turn, can hamper a company&#39;s ability to pay its dividend.</p>', 1, 'Cash', 'Quarterly', 1, '2018-11-01', '2019-01-31', '2019-02-13', '2019-01-24 21:15:45', '2019-01-25 19:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `dividend_setting_history`
--

CREATE TABLE `dividend_setting_history` (
  `id` int(11) NOT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text,
  `status` int(11) NOT NULL,
  `dividend_type` varchar(150) DEFAULT NULL,
  `payment_schedule` varchar(200) DEFAULT NULL,
  `dividend_amt` float DEFAULT '0',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `ex_dividend_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draft_mails`
--

CREATE TABLE `draft_mails` (
  `id` int(10) NOT NULL,
  `subject` text NOT NULL,
  `mail_content` text NOT NULL,
  `request_type` int(10) NOT NULL COMMENT '1-all users,2-who purchased token,3-who have not purchased token,4-with purchased dates',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '1-mail not sent,2-Mail sent',
  `req_from_date` date DEFAULT NULL,
  `req_to_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `customer_name` varchar(150) DEFAULT NULL,
  `purpose` text,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `country` varchar(150) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `tax` varchar(100) DEFAULT NULL,
  `tax_type` varchar(100) DEFAULT NULL,
  `tax_amount` varchar(100) DEFAULT NULL,
  `total_amount` int(11) NOT NULL DEFAULT '0',
  `pay_type` varchar(100) DEFAULT NULL,
  `ref_no` text,
  `voucher` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_campaign`
--

CREATE TABLE `mail_campaign` (
  `id` int(10) NOT NULL,
  `request_type` int(10) NOT NULL COMMENT '1-all users,2-who purchased token,3-who have not purchased token,4-with purchased dates',
  `emails` text,
  `subject` varchar(255) NOT NULL,
  `mail_content` text NOT NULL,
  `user_count` int(10) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `is_updated` int(10) NOT NULL DEFAULT '0',
  `req_from_date` date DEFAULT NULL,
  `req_to_date` date DEFAULT NULL,
  `delivered_count` int(11) DEFAULT NULL,
  `failed_count` int(10) DEFAULT NULL,
  `rejected_count` int(10) DEFAULT NULL,
  `sent_count` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message_campaign`
--

CREATE TABLE `message_campaign` (
  `id` int(10) NOT NULL,
  `request_type` int(10) NOT NULL COMMENT '1-all users,2-who purchased token,3-who have not purchased token,4-with purchased dates',
  `numbers` text,
  `message_content` text NOT NULL,
  `user_count` int(10) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '1',
  `req_from_date` date DEFAULT NULL,
  `req_to_date` date DEFAULT NULL,
  `delivered_count` int(11) DEFAULT NULL,
  `sent_count` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2016_09_13_070520_add_verification_to_user_table', 1),
(9, '2018_04_17_082938_create_admins_table', 1),
(10, '2018_04_17_082939_create_admin_password_resets_table', 1),
(11, '2018_04_17_162708_create_transactions_table', 1),
(12, '2018_04_19_071439_create_notifications_table', 1),
(13, '2018_05_05_091201_add_in_transaction_table', 1),
(14, '2018_05_17_112625_create_cms_table', 1),
(15, '2018_05_17_142351_create_progress_bar_table', 1),
(16, '2018_05_18_074256_add_status_in_progress_bar', 1),
(17, '2018_05_18_101752_add_kyc_details_in_user', 1),
(18, '2018_05_18_123939_add_social_ids_details_in_user', 1),
(19, '2018_05_19_134025_add_wallet_detail_in_transaction', 1),
(20, '2018_05_19_141325_add_script_fields_added', 1),
(21, '2018_05_21_111600_add_profile_picture_in_users', 1),
(22, '2018_05_21_124434_add_progress_bar_date_in_progress_bar', 1),
(23, '2018_05_22_082154_add_contract_address_in_admon_table', 1),
(24, '2018_05_23_131100_update_transaction_description', 1),
(25, '2018_05_28_113033_add_admin_fields', 1),
(26, '2018_05_29_113936_add_otp_fields_in_admin_table', 1),
(27, '2018_06_13_071712_add_transaction_hash_field', 1),
(28, '2018_07_17_081359_referral', 1),
(29, '2018_07_17_103954_add_fields_of_referrals_in_users', 1),
(30, '2018_07_17_104155_referral_settings', 1),
(31, '2018_07_18_114034_add_referral_fields_in_user', 1),
(32, '2018_07_19_121851_add_txn_id_ether_in_referrals', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_read` text COLLATE utf8mb4_unicode_ci,
  `is_read` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('praveen@sparkouttech.com', '$2y$10$n6h0691b6h4hL3gwVhhZ8OKnPppybCeLg0JQpnMVXDXb4sWagcwTi', '2018-12-02 15:42:42'),
('pubx91@mailinator.com', '$2y$10$lCHsdHwRLJTBl/BfyT.rp.MTNEs/tpXgRgJU7HkOe5RDrPOQZFi4C', '2018-12-05 13:22:17');

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 'NEFT', '2018-11-30 05:59:51', NULL),
(2, 'Cheque', '2018-11-30 06:03:23', '2018-11-30 06:12:10'),
(3, 'Credit Card', '2018-11-30 06:03:39', '2018-11-30 06:12:10'),
(4, 'Cash', '2018-11-30 06:03:39', NULL),
(7, 'Stripe', '2018-12-01 09:22:08', NULL),
(8, 'Paypal', '2018-12-01 09:22:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `progress_bar`
--

CREATE TABLE `progress_bar` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hint` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `progress_bar_date` date DEFAULT NULL,
  `coin_price` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify_before` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress_bar`
--

INSERT INTO `progress_bar` (`id`, `title`, `hint`, `is_completed`, `created_at`, `updated_at`, `status`, `progress_bar_date`, `coin_price`, `notify_before`) VALUES
(1, 'Token Offering', 'Milestone', 1, '2018-11-09 06:41:31', '2018-12-15 08:16:18', 1, '2018-11-21', NULL, 2),
(2, 'Title', 'Hints', 1, '2018-11-17 08:13:29', '2018-11-17 13:20:05', 1, '2018-11-08', NULL, 2),
(3, 'test1', 'test1', 1, '2018-11-17 08:14:13', '2018-11-20 17:22:39', 1, '2018-11-19', NULL, 2),
(4, 'Token price increase', 'Token price increases to $20', 0, '2018-11-19 01:56:31', '2018-12-15 10:21:33', 1, '2018-12-30', '20', 2),
(5, 'Final Testing', 'Final Testing', 0, '2018-12-05 06:23:12', '2018-12-12 05:49:08', 1, '2019-02-08', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(10) UNSIGNED NOT NULL,
  `referrer` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `user_bought_amount` int(11) NOT NULL,
  `referer_earning_amount` int(11) NOT NULL,
  `referel_txn_id` int(11) NOT NULL,
  `status` enum('COMPLETED','PENDING','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `txn_id_ether` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_settings`
--

CREATE TABLE `referral_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `referral_offer_type` enum('FLAT','PERCENT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PERCENT',
  `referral_offer_amount` int(11) NOT NULL,
  `referral_offer_upto` int(11) NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_settings`
--

INSERT INTO `referral_settings` (`id`, `referral_offer_type`, `referral_offer_amount`, `referral_offer_upto`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FLAT', 10, 100, '1', '2018-11-02 09:25:10', '2018-12-02 11:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_mails`
--

CREATE TABLE `schedule_mails` (
  `id` int(10) NOT NULL,
  `subject` text NOT NULL,
  `mail_content` text NOT NULL,
  `date` datetime NOT NULL,
  `request_type` int(10) NOT NULL COMMENT '1-all users,2-who purchased token,3-who have not purchased token,4-with purchased dates',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '1-mail not sent,2-Mail sent',
  `req_from_date` date DEFAULT NULL,
  `req_to_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_mails`
--

INSERT INTO `schedule_mails` (`id`, `subject`, `mail_content`, `date`, `request_type`, `status`, `req_from_date`, `req_to_date`, `created_at`, `updated_at`) VALUES
(1, 'File manager is not opening', '<p>ghgh</p>\r\n\r\n<p>hbtgh</p>\r\n\r\n<p><strong>htghtgh</strong></p>', '2018-11-17 00:00:00', 1, 2, NULL, NULL, '2018-11-17 10:32:33', '2018-11-20 08:41:02'),
(2, 'schedule Test', '<p>schedule Test</p>', '2018-11-20 00:00:00', 2, 2, NULL, NULL, '2018-11-19 13:10:27', '2018-11-20 08:41:02'),
(3, 'I\'m a scheduled email to those who have purchased', '<p>Scheduled email&nbsp;</p>', '2018-11-23 00:00:00', 2, 1, NULL, NULL, '2018-11-23 11:19:05', '2018-11-23 11:19:05'),
(5, 'test', '<blockquote>\r\n<p>TEST mail</p>\r\n</blockquote>', '2018-11-24 13:15:00', 1, 2, NULL, NULL, '2018-11-24 07:20:09', '2018-11-24 13:15:02'),
(6, 'test2', '<p><s>test mail for schedule date with time </s></p>', '2018-11-24 08:02:00', 2, 2, NULL, NULL, '2018-11-24 07:26:52', '2018-11-24 08:02:02'),
(8, 'test mail', '<p>test</p>', '0000-00-00 00:00:00', 2, 1, NULL, NULL, '2018-11-28 12:47:24', '2018-11-28 12:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `param` varchar(50) DEFAULT NULL,
  `value` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `param`, `value`, `created_at`, `updated_at`) VALUES
(1, 'stripe_pk_key', 'pk_test_ljUlljjxQC5fWtk4RB32FfYK', '2018-11-13 10:13:10', '2018-11-13 10:13:10'),
(2, 'stripe_sk_key', 'sk_test_ljUlljjxQC5fWtk4RB32FfYK', '2018-11-13 10:13:10', '2018-11-13 10:13:10'),
(3, 'client_id', 'Aa89qYycvh_kjyqPu631D95AtEEd_tGk2l-WV3mFwZdrQS7EWZHrszkB9KeNvJn9v35bRq_O8fusE_Ef', '2018-11-20 07:06:46', '2018-11-20 07:06:46'),
(4, 'secret', 'EBS0Z4_cj9UQaFgDtbVVaYuVP3gMfFN-Xek7ZUr9NtsMNeMvP2BMrwsw3SEvjVRAGC8BRIVEbenWhsyz', '2018-11-20 07:06:46', '2018-11-20 07:06:46'),
(5, 'mode', 'sandbox', '2018-11-20 07:06:46', '2018-11-20 07:06:46'),
(6, 'expense_report_show_to_investor', '1', '2018-12-18 10:28:45', '2018-12-18 10:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `survey_list`
--

CREATE TABLE `survey_list` (
  `id` int(11) NOT NULL,
  `code` text NOT NULL,
  `survey_title` text NOT NULL,
  `url` text NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL COMMENT 'survey status',
  `action` tinyint(4) NOT NULL COMMENT 'for users dashbooard, 0-not show, 1- Show',
  `response_count` varchar(10) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_notify`
--

CREATE TABLE `survey_notify` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `value` varchar(10) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'IGST', '18', '2018-11-29 09:46:07', '2018-11-29 09:46:07'),
(2, 'VAT', '25', '2018-11-29 09:50:05', '2018-11-29 09:50:05'),
(3, 'CGST', '9', '2018-11-29 09:53:45', '2018-11-29 09:53:45'),
(4, 'SGST', '9', '2018-11-29 09:59:45', '2018-11-29 09:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coins` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txn_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_token` text COLLATE utf8mb4_unicode_ci,
  `payer_id` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screenshot` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ether` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PENDING','COMPLETED','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `date` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cash_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_mode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_type` enum('ether','others') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ether',
  `txhash` text COLLATE utf8mb4_unicode_ci,
  `pay_type` tinyint(4) NOT NULL DEFAULT '1',
  `pay_status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_accept_cookie` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-No,1-yes,2-Denied',
  `ether` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_token` int(10) NOT NULL DEFAULT '0',
  `bankname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` int(11) NOT NULL,
  `bankcodevalue` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_bank_details`
--
ALTER TABLE `admin_bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD KEY `admin_password_resets_email_index` (`email`),
  ADD KEY `admin_password_resets_token_index` (`token`);

--
-- Indexes for table `bank_code_master`
--
ALTER TABLE `bank_code_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_dividend`
--
ALTER TABLE `current_dividend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dividend_payment`
--
ALTER TABLE `dividend_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dividend_settings`
--
ALTER TABLE `dividend_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dividend_setting_history`
--
ALTER TABLE `dividend_setting_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_mails`
--
ALTER TABLE `draft_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_campaign`
--
ALTER TABLE `mail_campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_campaign`
--
ALTER TABLE `message_campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress_bar`
--
ALTER TABLE `progress_bar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_settings`
--
ALTER TABLE `referral_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_mails`
--
ALTER TABLE `schedule_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_list`
--
ALTER TABLE `survey_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_notify`
--
ALTER TABLE `survey_notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_bank_details`
--
ALTER TABLE `admin_bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bank_code_master`
--
ALTER TABLE `bank_code_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `current_dividend`
--
ALTER TABLE `current_dividend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dividend_payment`
--
ALTER TABLE `dividend_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dividend_settings`
--
ALTER TABLE `dividend_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dividend_setting_history`
--
ALTER TABLE `dividend_setting_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `draft_mails`
--
ALTER TABLE `draft_mails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mail_campaign`
--
ALTER TABLE `mail_campaign`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_campaign`
--
ALTER TABLE `message_campaign`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `progress_bar`
--
ALTER TABLE `progress_bar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referral_settings`
--
ALTER TABLE `referral_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schedule_mails`
--
ALTER TABLE `schedule_mails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `survey_list`
--
ALTER TABLE `survey_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey_notify`
--
ALTER TABLE `survey_notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
