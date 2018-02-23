Eaac
============================

This project is still on proress , Enjoy ! :)

### Tools 
- CodeIgniter PHP 3.x
- MySQL

### MySQL Configuration
```
Database Name : test
User          : root
Password      : 
```

### Tables MAKER
```
CREATE TABLE `eprofile` (
  `id_profile` integer NOT NULL auto_increment ,
  `fullname` varchar(255) NOT NULL,
  `alamatkantor` text NOT NULL,
  `infogedung` varchar(255) NOT NULL,
  `primarymsisdn` varchar(15) NOT NULL,
  `secondarymsisdn` varchar(15) NOT NULL,
  `packagetype` varchar(200) NOT NULL,
  `nokk` varchar(16) NOT NULL,
  `noktp` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `tanggallahir` date NOT NULL,
  `tempatlahir` varchar(255) NOT NULL,
  `namaibu` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `emailreferensi` varchar(255),
  `imagektp` varchar(255) NOT NULL,
  `imagepeg` varchar(255) NOT NULL,
  constraint PK_PROFILE primary key (id_profile)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `email_token` (
	  `email` varchar(200) NOT NULL,
	  `token` varchar(200) DEFAULT NULL,
	  `update_time` datetime DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	--
	-- Dumping data for table `email_token`
	--

	INSERT INTO `email_token` (`email`, `token`, `update_time`) VALUES
	('adsfodsajf@asd.sad', '476e31', '2018-02-21 22:20:36'),
	('anung@yaii.com', '30e0e8', '2018-02-23 17:43:47'),
	('asdads@asd.asd', '', '2018-02-17 12:01:10'),
	('asdasdasdsad@asdasd.asd', '129911', '2018-02-17 17:29:21'),
	('qweqwe@qwe.qwe', '750267', '2018-02-17 12:01:18'),
	('sempaj@asd.asd', '123qwe', '2018-02-17 13:44:47');
```


