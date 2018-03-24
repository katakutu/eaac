Eaac
============================

This project is still on proress , Enjoy ! :)

### Tools 
- CodeIgniter 3.x
- PHP
- MySQL

### Folder in Use Till Now (Inside Application)
- config        --> [constant,config,database,dll]
- controllers
- core          --> [MY_Loader.php]
- views     
- model         --> [select provinsi&kota Only]
- library       --> [curl]

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
  `email` varchar(200) NOT NULL primary key,
  `token` varchar(200) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `acuan_alamat_kantor` ( 
  `id_kantor` integer NOT NULL auto_increment , 
  `alamat_kantor` text NOT NULL, 
  constraint PK_KANTOR primary key (id_kantor) 
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

CREATE TABLE `acuan_provinsi` (
  `id_provinsi` int(11) NOT NULL auto_increment ,
  `provinsi` varchar(255) NOT NULL,
  `ibukota` varchar(255) NOT NULL,
  constraint PK_PROFILE primary key (id_provinsi)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `acuan_kota` (
  `id_kota` int(11) NOT NULL auto_increment,
  `id_provinsi` int(11) NOT NULL,
  `kota` varchar(255)  NOT NULL,
  constraint PK_KOTA primary key (id_kota),
  CONSTRAINT FK_KOTA_PROV FOREIGN KEY (`id_provinsi`) REFERENCES `acuan_provinsi` (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;

CREATE TABLE `acuan_tipe_package` ( 
  `id_package` integer NOT NULL auto_increment , 
  `nama_package` varchar(255) NOT NULL, 
  constraint PK_PACKAGE primary key (id_package) 
) ENGINE=InnoDB AUTO_INCREMENT=3000 DEFAULT CHARSET=latin1;

CREATE TABLE `acuan_nomor_cantik` ( 
  `id_no_cantik` integer NOT NULL auto_increment , 
   msisdn varchar(25) not null,
  `status` enum('available','unavailable') NOT NULL  DEFAULT 'unavailable', 
  constraint PK_NOCANTIK primary key (id_no_cantik) 
) ENGINE=InnoDB AUTO_INCREMENT=8000 DEFAULT CHARSET=latin1;
```


