CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `city` varchar(255) NULL DEFAULT 'Earth',
  `salary` int(10) NOT NULL DEFAULT 0,
  `password` varchar(40) NOT NULL DEFAULT 'secret',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `employees` (`id`, `name`, `city`, `salary`, `password`) VALUES
(1, 'Shay', 'San Francisco', 10000, SHA1('TheDudeAbides')),
(2, 'Simon', 'Berlin', 8000, SHA1('Elasticsearch')),
(3, 'Philipp', 'Wien', 4000, SHA1('secret'));
