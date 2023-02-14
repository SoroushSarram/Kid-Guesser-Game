
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: 'ACCOUNTS'
-- Table structure for table 'users'
--

CREATE TABLE IF NOT EXISTS 'users' (
  'id' int(5) NOT NULL AUTO_INCREMENT,
  'username' varchar(50) NOT NULL,
  'password' varchar(50) NOT NULL,
  'created_at' datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id'),
  UNIQUE KEY 'username' ('username')
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

