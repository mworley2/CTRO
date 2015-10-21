CREATE DATABASE IF NOT EXISTS login;
/* User(username, password, email) 
  PRIMARY KEY (`user_id`, `user_name`, `user_email`) would mean no two tuples can have same values for all 3 of these attributes
  but we want to make sure no two users have same username
*/
CREATE TABLE IF NOT EXISTS `login`.`users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

/* Case(caseID, name, style, numSlides, timesTaken, averageTime) */
CREATE TABLE IF NOT EXISTS `login`.`cases` (
  `case_id` int(11) AUTO_INCREMENT COMMENT 'auto incrementing case_id of each case, unique index',
  `case_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'case''s name',
  `style` varchar(255) COLLATE utf8_unicode_ci  COMMENT 'style of case interview',
  `num_slides` int(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'num slides in case',
  `times_taken` int(64) COLLATE utf8_unicode_ci COMMENT 'num times case has been taken',
  `avg_time` decimal(64) COLLATE utf8_unicode_ci  COMMENT 'num slides in case',
  PRIMARY KEY (`case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='case data';


/* Interviews(interviewID, permissions, giverUsername, takerUsername, notes, timeTaken) 
same giver and taker pair can do multiple interviews(interviewIDs)
*/
CREATE TABLE IF NOT EXISTS `login`.`interviews`  (
  `interview_id` int(11)  AUTO_INCREMENT COMMENT 'auto incrementing interview_id of each interview, unique index',
  `permissions` int(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'permissions of the case',
  `giver_username` varchar(64) COLLATE utf8_unicode_ci  COMMENT 'giver of the case interview, unique',
  `taker_username` varchar(64) COLLATE utf8_unicode_ci COMMENT 'taker of the case interview, unique',
  `notes` varchar(255) COLLATE utf8_unicode_ci COMMENT 'num times case has been taken',
  `timeTaken` decimal(64) COLLATE utf8_unicode_ci  COMMENT 'num slides in case',
  PRIMARY KEY (`interview_id`, `giver_username`, `taker_username` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='interview data';


/* EngagesIn(username, interviewID) 
user may be in table >1 time and interviewID in table 2 times (giver and taker) <- way to implement this constraint?
*/ 
CREATE TABLE IF NOT EXISTS `login`.`engagesin` (
  `user_name` varchar(64)  COMMENT 'user_name of the user engaging in the case, unique',
  `interview_id` int(11) COLLATE utf8_unicode_ci COMMENT 'id of interview, unique',
  PRIMARY KEY (`user_name`, `interview_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='users engaging in interviews data';


/* Owns(username, caseID) 
a user can own multiple cases, but each case can only have one owner <- how to enforce??
*/
CREATE TABLE IF NOT EXISTS `login`.`owns` (
  `user_name` varchar(64)  COMMENT 'user_name of the user engaging in the case, unique',
  `case_id` int(11) COLLATE utf8_unicode_ci  COMMENT 'id of the case, unique',
  PRIMARY KEY (`case_id`, `user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='which users own which cases';

/* Slides(caseID, slideNum, slidePDF) 
  blob = varbinary(MAX) ??
*/
CREATE TABLE IF NOT EXISTS `login`.`slides` (
  `case_id` int(11) COLLATE utf8_unicode_ci  COMMENT 'id of the case, unique',
  `slide_num` int(64) COLLATE utf8_unicode_ci COMMENT 'slide number in the case (order in case)',
  `slide_pdf` blob NOT NULL COMMENT 'actual slide pdf contents ',
  PRIMARY KEY (`case_id`, `slide_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='individual slides for all cases';

/* Uses(interviewID, caseID) */
CREATE TABLE IF NOT EXISTS `login`.`uses` (
  `interview_id` int(11) COLLATE utf8_unicode_ci COMMENT 'id of the interview, unique',
  `case_id` int(11) COLLATE utf8_unicode_ci  COMMENT 'id of the case, unique',
  PRIMARY KEY (`interview_id`, `case_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='which case each interview uses';