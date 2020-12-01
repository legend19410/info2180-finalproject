DROP DATABASE IF EXISTS bugstracker;
CREATE DATABASE bugstracker;
USE bugstracker;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(35) NOT NULL default '',
  `lastname` varchar(32) NOT NULL default '',
  `password` varchar(20) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  `date_joined`datetime,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(32) NOT NULL default '',
  `description` text(1000) NOT NULL default '',
  `type` varchar(32) NOT NULL default '',
  `priority` varchar(26) NOT NULL default '',
  `status` varchar(32) NOT NULL default '',
  `assigned_to` int(11) default NULL,
  `created_by` int(11),
  `created` datetime,
  `updates` datetime,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

INSERT INTO `users`(firstname, lastname, `password`,email,date_joined) VALUES ('Malik','Edwards','password123', 'admin@project2.com', NOW());
INSERT INTO `users`(firstname, lastname, `password`,email,date_joined) VALUES ('Milton','Francis','12345', 'francismilton19410@gmail.com', NOW());
INSERT INTO `users`(firstname, lastname, `password`,email,date_joined) VALUES ('Javier','Bryan','44444', 'javier@gmail.com', NOW());
INSERT INTO `users`(firstname, lastname, `password`,email,date_joined) VALUES ('Lisa','Darkins','00000', 'lisa@gmail.com', NOW());

INSERT INTO `issues`(title, `description`, `type`,`priority`, `status`, 
                      `assigned_to`, `created_by`, `created`, `updates`) 
              VALUES ('Broken Laptop','Laptops tend to have a rather short lifetime. They are outdated
                       within weeks of being released, they are notoriously hard to upgrade or repair, 
                       and by nature they are subject to gradual decay or fatal accidents. Some laptop
                        issues, however, are often easier to repair than you would expect.',
                        'Bug', 'Major', 'IN PROGRESS', 1, 2, NOW(), NOW());

INSERT INTO `issues`(title, `description`, `type`,`priority`, `status`, 
                      `assigned_to`, `created_by`, `created`, `updates`) 
              VALUES ('No Semicolon','','Bug', 'Minor', 'OPEN', 3, 4, NOW(), NOW());

INSERT INTO `issues`(title, `description`, `type`,`priority`, `status`, 
                      `assigned_to`, `created_by`, `created`, `updates`) 
              VALUES ('Broken Laptop','Before doing anything, give your laptop a full look-over and inspection to ensure the screen really needs replacement. If the graphics card on the motherboard is dead, for instance, you may be wasting your time and effort on replacing a perfectly good screen. Additionally, if the laptop has been recently dropped or otherwise possibly physically harmed, you’ll want to double-check for other damage as well.','Bug', 'Major', 'IN PROGRESS', 2, 1, NOW(), NOW());

INSERT INTO `issues`(title, `description`, `type`,`priority`, `status`, 
                      `assigned_to`, `created_by`, `created`, `updates`) 
              VALUES ('Forever While Loop','In computer programming, an infinite loop (or endless loop)[1][2] is a sequence of instructions that, as written, will continue endlessly, unless an external intervention occurs ("pull the plug"). It may be intentional.','Proposal', 'Major', 'IN PROGRESS', 4, 2, NOW(), NOW());

INSERT INTO `issues`(title, `description`, `type`,`priority`, `status`, 
                      `assigned_to`, `created_by`, `created`, `updates`) 
              VALUES ('No Closing Brackets','23

I start out like this {}, then usually fill them with something. Whenever you type {, type a corresponding } and stick it on a new line. The worst thing you have to do in that case is fix indentation prior to committing.','Bug', 'Major', 'IN PROGRESS', 1, 2, NOW(), NOW());