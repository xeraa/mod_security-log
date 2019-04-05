CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `employees` (`id`, `name`, `city`, `salary`) VALUES
(1, 'Shay', 'San Francisco', 10000),
(2, 'Simon', 'Berlin', 8000),
(3, 'Philipp', 'Wien', 4000);
