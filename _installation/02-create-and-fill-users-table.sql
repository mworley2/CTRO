CREATE DATABASE IF NOT EXISTS login;
CREATE TABLE IF NOT EXISTS `login`.`users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

/* Case(caseID, name, style, numSlides, timesTaken, averageTime) */
CREATE TABLE IF NOT EXISTS `login`.`cases` (
  `case_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing case_id of each case, unique index',
  `case_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'case''s name',
  `style` varchar(255) COLLATE utf8_unicode_ci  COMMENT 'style of case interview',
  `num_slides` int(64) COLLATE utf8_unicode_ci COMMENT 'num slides in case',
  `times_taken` int(64) COLLATE utf8_unicode_ci COMMENT 'num times case has been taken',
  `avg_time` decimal(64) COLLATE utf8_unicode_ci  COMMENT 'num slides in case',
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='case data';

/* EngagesIn(username, interviewID) 
	primary key vs unique confusion
*/ 
CREATE TABLE IF NOT EXISTS `login`.`engagesIn` (
  `user_name` varchar(64) NOT NULL  COMMENT 'user_name of the user engaging in the case, unique',
  `interview_id` int(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of interview, unique',
  PRIMARY KEY (`interview_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='users engaging in interviews data';

/* Interviews(interviewID, permissions, giverUsername, takerUsername, notes, timeTaken) 
type of permissions and should permissions allowed to be null?
giver and taker be not null- giver/take username or userid??
*/
CREATE TABLE IF NOT EXISTS `login`.`interviews` (
  `interview_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing interview_id of each interview, unique index',
  `permissions` int(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'permissions of the case',
  `giver_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'giver of the case interview, unique',
  `taker_username` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'taker of the case interview, unique',
  `notes` varchar(255) COLLATE utf8_unicode_ci COMMENT 'num times case has been taken',
  `timeTaken` decimal(64) COLLATE utf8_unicode_ci  COMMENT 'num slides in case',
  PRIMARY KEY (`interview_id`),
  UNIQUE KEY `giver_username` (`giver_username`),
  UNIQUE KEY `taker_username` (`taker_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='interview data';

/* Owns(username, caseID) */
CREATE TABLE IF NOT EXISTS `login`.`owns` (
  `user_name` varchar(64) NOT NULL  COMMENT 'user_name of the user engaging in the case, unique',
  `case_id` int(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of the case, unique',
  PRIMARY KEY (`case_id`, `user_name`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='which users own which cases';

/* Slides(caseID, slideNum, slidePDF) 
	blob = varbinary(MAX) ??
*/
CREATE TABLE IF NOT EXISTS `login`.`slides` (
  `case_id` int(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of the case, unique',
  `slide_num` int(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'slide number in the case (order in case)',
  `slide_pdf` blob NOT NULL COMMENT 'actual slide pdf contents ',
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='individual slides for all cases';

/* Uses(interviewID, caseID) */
CREATE TABLE IF NOT EXISTS `login`.`uses` (
  `interview_id` int(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of the interview, unique',
  `case_id` int(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'id of the case, unique',
  PRIMARY KEY (`interview_id`, `case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='which case each interview uses';










