####### create databases

CREATE DATABASE IF NOT EXISTS `dbtest`;
CREATE DATABASE IF NOT EXISTS `dbtime`;

-- CREATE DATABASE IF NOT EXISTS `dbtest2`;

####### create root user and grant rights
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';
