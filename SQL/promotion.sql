INSERT INTO `promotion` (`id`,`name`,`type`,`adjustment`,`criteria`) VALUES
(1,'Black Friday half price sale','date_range_multiplier',0.5,'{\"to\": \"2022-11-28\", \"from\": \"2022-11-25\"}'),
(2,'Voucer OU182','fixed_price_voucher',100,'{\"code\": \"OU812\"}'),
(3,'Buy one get one free','even_items_multiplier',0.5,'{\"minimum_quantity\": 2}');
