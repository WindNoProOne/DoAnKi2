/* 
	1. Copy content in dbpheidip.sql file and paste into SQL window in MySQL
	2. Click GO to create database
*/

DROP DATABASE IF EXISTS `dbpheidip`;
CREATE DATABASE `dbpheidip`;
USE `dbpheidip`;

DROP TABLE IF EXISTS `tbAdmin`;
CREATE TABLE `tbAdmin`(
    `AdminID` int NOT NULL AUTO_INCREMENT,
    `AdminName` varchar(50) NOT NULL,
    `Password` varchar(50) NOT NULL,
    PRIMARY KEY (AdminID)
);

DROP TABLE IF EXISTS `tbUser_Account`;
CREATE TABLE `tbUser_Account` (
    `UserID` int NOT NULL AUTO_INCREMENT,
    `UserName` varchar(50) NOT NULL,
    `Password` varchar(50) NOT NULL,
    `FullName` varchar(100) NOT NULL,
    `Email` varchar(50) NOT NULL,
    `PhoneNumber` varchar(14) NOT NULL,
    `Status` boolean DEFAULT 1,
    PRIMARY KEY (UserID)
);

DROP TABLE IF EXISTS `tbDelivery_Address`;
CREATE TABLE `tbDelivery_Address`(
    `AddressID` int NOT NULL AUTO_INCREMENT,
    `UserID` int NOT NULL,	
    `Address` text NOT NULL,
    `Is_default` boolean NOT NULL,
    PRIMARY KEY (AddressID)
);


DROP TABLE IF EXISTS `tbPayment`;
CREATE TABLE `tbPayment`(
    `PaymentID` int NOT NULL AUTO_INCREMENT,
    `Method`varchar(40) NOT NULL,
    `Desc` text NOT NULL,
    PRIMARY KEY (PaymentID)
);



DROP TABLE IF EXISTS `tbBrand`;
CREATE TABLE `tbBrand`(
    `BrandID` varchar(50) NOT NULL,
    `BrandName` varchar(40) NOT NULL,
    `Logo` varchar(100) NOT NULL,
    `Desc` text,
    PRIMARY KEY (BrandID)
);

DROP TABLE IF EXISTS `tbType`;
CREATE TABLE `tbType`(
    `TypeID` varchar(10) NOT NULL,
    `TypeName`varchar(40) NOT NULL,
    `Desc` text NOT NULL,
    PRIMARY KEY (TypeID)
);

DROP TABLE IF EXISTS `tbProduct`;
CREATE TABLE `tbProduct`(
    `ProductID` varchar(50) NOT NULL,
    `ProductName` varchar(50) NOT NULL,
    `Price` decimal(10,2) NOT NULL,
    `Thumbnail` varchar(100) NOT NULL,
    `Image` varchar(100) NOT NULL,
    `BrandID` varchar(50) NOT NULL,
    `TypeID` varchar(10) NOT NULL,
    `Desc` text,
    PRIMARY KEY (ProductID)
);

DROP TABLE IF EXISTS `tbTag`;
CREATE TABLE `tbTag`(
    `TagID` varchar(50) NOT NULL,
    `TagName` varchar(40) NOT NULL,
    `ProductID` varchar(50) NOT NULL,
    `Desc` text,
    PRIMARY KEY (TagID)
);

DROP TABLE IF EXISTS `tbInventory`;
CREATE TABLE `tbInventory`(
    `InventoryID` varchar(53) NOT NULL,
    `ProductID` varchar(50) NOT NULL,
    `Size` varchar(3) NOT NULL,
    `Quantity` int NOT NULL,
    PRIMARY KEY (InventoryID)
);

DROP TABLE IF EXISTS `tbOrder_Details`;
CREATE TABLE `tbOrder_Details`(
    `DetailsID` varchar(10) NOT NULL,
    `InventoryID` varchar(10) NOT NULL,
    `Quantity` int NOt NULL,
    PRIMARY KEY (DetailsID)
);

DROP TABLE IF EXISTS `tbOrder_Master`;
CREATE TABLE `tbOrder_Master`(
    `MasterID` varchar(10) NOT NULL,
    `DetailsID` varchar(10) NOT NULL,
    `UserID` int NOT NULL,
    `PaymentID` int NOT NULL,
    `OrderDate` datetime NOT NULL,
    `Note` text,
    PRIMARY KEY(MasterID)
);


DROP TABLE IF EXISTS `tbNews`;
CREATE TABLE `tbNews`(
    `NewsID` int NOT NULL AUTO_INCREMENT,
    `Title` varchar(100) NOT NULL,
    `Content` text NOT NULL,
    `Image` varchar(100) NOT NULL,
    `NewsDate` datetime NOT NULL,
    PRIMARY KEY (NewsID)
);

DROP TABLE IF EXISTS `tbFeedback`;
CREATE TABLE `tbFeedback`(
    `FeedbackID` int NOT NULL AUTO_INCREMENT,
    `UserID` int,
    `GuestID` int,
    `Content` text NOT NULL,
    `Date` datetime NOT NULL,
    PRIMARY KEY(FeedbackID)
);


DROP TABLE IF EXISTS `tbGuest`;
CREATE TABLE `tbGuest`(
    `GuestID` int NOT NULL AUTO_INCREMENT,
    `GuestName` varchar(100) NOT NULL,
    `email` varchar(50) NOT NULL,
    `Phone` varchar(14) NOT NULL,
     PRIMARY KEY(GuestId)
);

ALTER TABLE `tbDelivery_Address`
ADD FOREIGN KEY (UserID) REFERENCES tbUser_Account(UserID);

ALTER TABLE `tbProduct`
ADD FOREIGN KEY (BrandID) REFERENCES tbBrand(BrandID),
ADD FOREIGN KEY (TypeID) REFERENCES tbType(TypeID);

ALTER TABLE `tbTag`
ADD FOREIGN KEY (ProductID) REFERENCES tbProduct(ProductID);

ALTER TABLE `tbInventory`
ADD FOREIGN KEY (ProductID) REFERENCES tbProduct(ProductID);

ALTER TABLE `tbOrder_Details`
ADD FOREIGN KEY (InventoryID) REFERENCES tbInventory(InventoryID);

ALTER TABLE `tbOrder_Master`
ADD FOREIGN KEY (DetailsID) REFERENCES tbOrder_Details(DetailsID),
ADD FOREIGN KEY (UserID) REFERENCES tbUser_Account(UserID),
ADD FOREIGN KEY (PaymentID) REFERENCES tbPayment(PaymentID);

ALTER TABLE `tbFeedback`
ADD FOREIGN KEY (UserID) REFERENCES tbUser_Account(UserID),
ADD FOREIGN KEY (GuestID) REFERENCES tbGuest(GuestID);

INSERT INTO `tbAdmin`(`AdminName`, `Password`) VALUES ('admin', '123');

INSERT INTO `tbUser_Account`(`UserName`, `Password`, `FullName`, `Email`, `PhoneNumber`) VALUES 
('user01', 'User01', 'Tester San', 'tester01@user.com', '0989796961'),
('user02', 'User02', 'Cristiano Ronaldo', 'ronaldo@gmail.com', '0912131415'),
('user03', 'User03', 'Lionel Messi', 'messi@yahoo.com', '0923242526'),
('user04', 'User04', 'Wayne Rooney', 'rooney@gmail.com', '0934353637'),
('user05', 'User05', 'Neymar Jr', 'neymar@user.com', '0945464748');

INSERT INTO `tbDelivery_Address`(`UserID`, `Address`, `Is_default`) VALUES 
(1, '001 Tester, Tired, Nowhere', '1'),
(2, '69 Truong Chinh Street,Tan Binh District, HCM City', '1'),
(3, '123 Thien Quang Street, Hai Ba Trung District, Hanoi City', '1'),
(4, '420 Pham Ngu Lao Street, District 1, HCM City', '1'),
(5, '26 Hung Vuong Street, Ba Dinh District, Hanoi City', '1');

INSERT INTO `tbGuest` VALUES
(1, 'The Guest', 'Themailwhichisntexist@mail.com', '0978767670');

INSERT INTO `tbFeedBack` VALUES 
(1, null, 1, 'Feedback is the bridge to effectively connect lesson-learned from the past to the future performance and potential', '2022-11-12 13:19:20'),
(2, 1, null, 'I saw that you learned how to use pivot tables for your Excel project and it really helped display the data', '2022-11-13 13:19:20');

INSERT INTO `tbBrand` VALUES
('NIK001', 'Nike', 'img/brand_nike.png', ''),
('ADI002', 'Adidas', 'img/brand_adidas.png', ''),
('TIM003', 'Timberland', 'img/brand_Timberland.png', ''),
('DRM004','DrMartens','img/brand_DrMartens.png',''),
('CON005','Converse','img/brand_converse.png','');

INSERT INTO `tbType`VALUES 
('001SNE', 'Sneaker', 'Sneaker shoes'),
('002BOO', 'Boots', 'Boots shoes'),
('003SAN', 'Sandals', 'Sandals'),
('004SLI', 'Slippers', 'Slippers');

INSERT INTO `tbProduct` VALUES 	
('NIK01', 'Nike K50 G-Series Ultra',        '555.99',  'img/thumbnail_1.jpg',   'img/image_1.jpg',  'NIK001',   '001SNE', ''),
('NIK02', 'Nike ROG 6 Pro',                 '199.99',  'img/18.jpg',   'img/18.jpg',  'NIK001',   '002BOO', ''),
('NIK03', 'Nike Red Magic 7S Pro Premium',  '199.99',  'img/carousel-7.jpg',   'img/carousel-7.jpg',  'NIK001',   '003SAN', ''),
('NIK04', 'Nike F4 GT Pro',                 '199.99',  'img/10.jpg',   'img/10.jpg',  'NIK001',   '004SLI', ''),

('ADI01', 'Adidas ROG Stix Scar G15',       '239.99',   'img/thumbnail_product-4.jpg', 'img/image_product-4.jpg', 'ADI002', '001SNE', ''),
('ADI02', 'Adidas BS 5 Pro',                '79.99',    'img/type-2.jpg',    'img/type-2.jpg', 'ADI002', '002BOO', ''),
('ADI03', 'Adidas 10T Pro GI Hutao',        '69.99',    'img/12.jpg', 'img/12.jpg', 'ADI002', '003SAN', ''),
('ADI04', 'Adidas 9RT GI Sucrose',          '99.99',    'img/15.jpg', 'img/15.jpg', 'ADI002', '004SLI', ''),

('TIM01', 'Timberland Omen 15',      '529.99',   'img/8.png', 'img/8.png', 'TIM003', '002BOO', ''),
('TIM02', 'Timberland Legion 5 Pro',        '64.99',    'img/thumbnail_timberland-1.jpg', 'img/image_timberland-1.jpg', 'TIM003', '002BOO', ''),
('TIM03', 'Timberland X15 R2',              '299.99',   'img/19.jpg', 'img/19.jpg', 'TIM003', '003SAN', ''),
('TIM04', 'Timberland Predator Helios 300', '96.99',    'img/9.jpg', 'img/9.jpg', 'TIM003', '004SLI', ''),

('DRM01', 'DrMartens Zephyrus M16',    '499.99',   'img/3.jpg', 'img/3.jpg', 'DRM004', '001SNE', ''),
('DRM02', 'DrMartens Zephyrus Dou 16 ',    '149.99',   'img/17.jpg', 'img/17.jpg', 'DRM004', '002BOO', ''),
('DRM03', 'DrMartens Katana GF66',    '169.99',   'img/14.jpg', 'img/14.jpg', 'DRM004', '003SAN', ''),
('DRM04', 'DrMartens Crosshail 15',    '79.99',    'img/16.jpg', 'img/16.jpg', 'DRM004', '004SLI', '');

INSERT INTO `tbInventory` VALUES
('NIK0138', 'NIK01', '38', 10),
('NIK0139', 'NIK01', '39', 12),
('NIK0140', 'NIK01', '40', 13),
('NIK0141', 'NIK01', '41', 14),
('NIK0142', 'NIK01', '42', 10),
('NIK0238', 'NIK02', '38', 10),
('NIK0239', 'NIK02', '39', 5),
('NIK0240', 'NIK02', '40', 10),
('NIK0241', 'NIK02', '41', 10),
('NIK0242', 'NIK02', '42', 0),
('NIK0338', 'NIK03', '38', 7),
('NIK0339', 'NIK03', '39', 10),
('NIK0340', 'NIK03', '40', 10),
('NIK0341', 'NIK03', '41', 10),
('NIK0342', 'NIK03', '42', 10),
('NIK0438', 'NIK04', '38', 10),
('NIK0439', 'NIK04', '39', 10),
('NIK0440', 'NIK04', '40', 10),
('NIK0441', 'NIK04', '41', 10),
('NIK0442', 'NIK04', '42', 10),
('ADI0138', 'ADI01', '38', 6),
('ADI0139', 'ADI01', '39', 0),
('ADI0140', 'ADI01', '40', 10),
('ADI0141', 'ADI01', '41', 10),
('ADI0142', 'ADI01', '42', 0),
('ADI0238', 'ADI02', '38', 10),
('ADI0239', 'ADI02', '39', 10),
('ADI0240', 'ADI02', '40', 0),
('ADI0241', 'ADI02', '41', 0),
('ADI0242', 'ADI02', '42', 11),
('ADI0338', 'ADI03', '38', 11),
('ADI0339', 'ADI03', '39', 12),
('ADI0340', 'ADI03', '40', 10),
('ADI0341', 'ADI03', '41', 10),
('ADI0342', 'ADI03', '42', 10),
('ADI0438', 'ADI04', '38', 10),
('ADI0439', 'ADI04', '39', 10),
('ADI0440', 'ADI04', '40', 10),
('ADI0441', 'ADI04', '41', 10),
('ADI0442', 'ADI04', '42', 10),
('TIM0138', 'TIM01', '38', 10),
('TIM0139', 'TIM01', '39', 10),
('TIM0140', 'TIM01', '40', 10),
('TIM0141', 'TIM01', '41', 10),
('TIM0142', 'TIM01', '42', 10),
('TIM0238', 'TIM02', '38', 10),
('TIM0239', 'TIM02', '39', 10),
('TIM0240', 'TIM02', '40', 10),
('TIM0241', 'TIM02', '41', 10),
('TIM0242', 'TIM02', '42', 10),
('TIM0338', 'TIM03', '38', 10),
('TIM0339', 'TIM03', '39', 10),
('TIM0340', 'TIM03', '40', 10),
('TIM0341', 'TIM03', '41', 10),
('TIM0342', 'TIM03', '42', 10),
('TIM0438', 'TIM04', '38', 10),
('TIM0439', 'TIM04', '39', 10),
('TIM0440', 'TIM04', '40', 10),
('TIM0441', 'TIM04', '41', 10),
('TIM0442', 'TIM04', '42', 10),
('DRM0138', 'DRM01', '38', 6),
('DRM0139', 'DRM01', '39', 6),
('DRM0140', 'DRM01', '40', 10),
('DRM0141', 'DRM01', '41', 7),
('DRM0142', 'DRM01', '42', 6),
('DRM0238', 'DRM02', '38', 6),
('DRM0239', 'DRM02', '39', 6),
('DRM0240', 'DRM02', '40', 10),
('DRM0241', 'DRM02', '41', 7),
('DRM0242', 'DRM02', '42', 6),
('DRM0338', 'DRM03', '38', 6),
('DRM0339', 'DRM03', '39', 6),
('DRM0340', 'DRM03', '40', 10),
('DRM0341', 'DRM03', '41', 7),
('DRM0342', 'DRM03', '42', 6),
('DRM0438', 'DRM04', '38', 6),
('DRM0439', 'DRM04', '39', 6),
('DRM0440', 'DRM04', '40', 10),
('DRM0441', 'DRM04', '41', 7),
('DRM0442', 'DRM04', '42', 6)
;

INSERT INTO `tbPayment`(`Method`, `Desc`) VALUES 
('Cash', 'Cash payment method'),
('VISA', 'VISA payment method'),
('MOMO', 'MOMO wallet');

INSERT INTO `tbTag` VALUES
('MenADI01', 'Men', 'ADI01', 'Men'),
('MenADI03', 'Men', 'ADI03', 'Men'),
('MenNIK01', 'Men', 'NIK01', 'Men'),
('MenTIM01', 'Men', 'TIM01', 'Men'),
('MenTIM02', 'Men', 'TIM02', 'Men'),
('MenTIM03', 'Men', 'TIM03', 'Men'),
('MenTIM04', 'Men', 'TIM04', 'Men'),
('NewADI02', 'New', 'ADI02', 'New'),
('NewADI03', 'New', 'ADI03', 'New'),
('NewNIK01', 'New', 'NIK01', 'New'),
('NewNIK02', 'New', 'NIK02', 'New'),
('NewTIM01', 'New', 'TIM01', 'New'),
('NewTIM04', 'New', 'TIM04', 'New'),
('WomADI02', 'Women', 'ADI02', 'Women'),
('WomADI04', 'Women', 'ADI04', 'Women'),
('WomNIK02', 'Women', 'NIK02', 'Women'),
('WomNIK03', 'Women', 'NIK03', 'Women'),
('WomenNIK04', 'Women', 'NIK04', 'Women'),
('WomTIM01', 'Women', 'TIM01', 'Women'),
('WomTIM02', 'Women', 'TIM02', 'Women'),
('WomTIM03', 'Women', 'TIM03', 'Women'),
('WomTIM04', 'Women', 'TIM04', 'Women');

INSERT INTO `tbOrder_Details` VALUES
('014132', 'TIM0141', '1'),
('014206', 'NIK0142', '2'),
('023232', 'NIK0239', '2'),
('024106', 'DRM0241', '1'),
('034222', 'TIM0341', '2'),
('044154', 'ADI0442', '1');

INSERT INTO `tbOrder_Master` VALUES
('M014064', '014132', '1', '1', '2022-11-15 15:17:32
', ''),
('M023321', '023232', '1', '1', '2022-11-15 15:17:32
', ''),
('M024064', '024106', '4', '1', '2022-11-15 15:19:06
', ''),
('M034222', '034222', '2', '1', '2022-11-15 15:18:22
', ''),
('M044541', '044154', '1', '3', '2022-11-15 15:17:54
', '');
