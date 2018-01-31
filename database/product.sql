CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `product_image` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_image`) VALUES
(1, 1, 'Cooler 15 lb', '1.00', 'asus-laptop.jpg'),
(2, 1, 'Cooler 18 lb', '1.05', 'surface-pro.jpg'),
(3, 1, 'Cooler 30 lb', '2.00', 'samsung-sd-card.jpg'),
(4, 1, 'Cooler 40 lb', '2.50', 'computer-hard-disk.jpg'),
(5, 1, 'Cooler 50 lb', '2.75', 'external-hard-disk.jpg'),
(6, 2, 'Re-ice Services', '3.00', 'crok-pot-cooker.jpg'),
(7, 2, 'EH Cooler', '3.14', 'blender.jpg'),
(8, 2, 'D Container', '3.16', 'vaccum-cleaner.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
