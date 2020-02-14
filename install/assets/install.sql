#
# TABLE STRUCTURE FOR: category
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `deleted_cat` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: descriptions
#

DROP TABLE IF EXISTS `descriptions`;

CREATE TABLE `descriptions` (
  `description_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `deleted_description` int(11) NOT NULL,
  PRIMARY KEY (`description_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: events
#

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `notice` text NOT NULL,
  `status` varchar(100) NOT NULL,
  `event_date` varchar(100) NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: history_logs
#

DROP TABLE IF EXISTS `history_logs`;

CREATE TABLE `history_logs` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `date_created` text NOT NULL,
  `deleted_history` int(11) NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext NOT NULL,
  `english` longtext NOT NULL,
  `kiswahili` longtext NOT NULL,
  PRIMARY KEY (`phrase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=254 DEFAULT CHARSET=latin1;

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('1', 'login', 'Login', 'Ingia');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('2', 'forgot_password', 'Forgot Password', 'Ulisahau kifunguo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('3', 'settings', 'Settings', 'Mipangilio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('4', 'logout', 'Logout', 'Ondoka');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('5', 'remember_me', 'Remember Me', 'Nikumbuke');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('6', 'confirm_delete', 'Are you sure to delete this information', 'Una Uhakika Unataka Kufuta');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('7', 'my_events', 'My events', 'Matukio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('8', 'view_more', 'View More', 'Tazama Zaidi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('9', 'language', 'Language', 'Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('10', 'phone_number', 'Phone Number', 'Nambari Ya Simu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('11', 'email', 'Email', 'Barua Pepe');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('12', 'general_settings', 'General Settings', 'Mipangilio Yote');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('13', 'image_specify', 'Image must be no larger than 500x500 pixels. Supported formats: JPG, GIF, PNG', 'Picha Isiwe Kubwa Zaidi Ya 500x500 pixels. Aina Za Picha Zinazokubalika: JPG, GIF, PNG');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('14', 'save', 'Save', 'Hifadhi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('15', 'choose_a_new_logo', 'Choose a New Logo', 'Jagua Nembo Lipya');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('16', 'current_logo', 'Current Logo', 'Nembo La Sahii');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('17', 'cancel', 'Cancel', 'Katisha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('18', 'upload', 'Upload', 'Pakia');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('19', 'address', 'Address', 'Anwani');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('20', 'system_name', 'System Name', 'Jina La Mfumo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('21', 'system_title', 'System Title', 'Cheo Cha Mfumo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('22', 'reset', 'Reset', 'Seti Upya');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('23', 'backup_data', 'Backup Data', 'Chelezo Data');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('24', 'restore_data', 'Restore Data', 'Rejesha Data');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('25', 'dashboard', 'Dashboard', 'Dashibodi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('26', 'copyright', 'Copyright', 'Hakimiliki');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('27', 'my_profile', 'My Profile', 'Wasifu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('28', 'logged_in_as', 'Logged in as', 'Umeingia Kama');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('29', 'inventory', 'Inventory', 'Orodha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('30', 'manage_category', 'Manage Category', 'Dhibiti Kategoria');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('31', 'manage_descriptions', 'Manage Descriptions', 'Dhibiti Maelezo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('32', 'manage_stock', 'Manage Stock', 'Dhibiti Akiba');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('33', 'sales', 'Sales', 'Vilivyouzwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('34', 'suppliers', 'Suppliers', 'Wauzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('35', 'outstandings', 'Outstandings', 'Masalio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('36', 'sales_outstandings', 'Sales Outstandings', 'Masalio Ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('37', 'purchases_outstandings', 'Purchase Outstandings', 'Masalio Ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('38', 'users', 'Users', 'Watumiaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('39', 'reports', 'Reports', 'Ripoti');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('40', 'fullnames', 'Full Names', 'Majina Kamili');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('41', 'username', 'Username', 'Jina La Mtumiaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('42', 'idno', 'IDNO', 'Namba Ya Kitambulisho');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('43', 'upload_logo', 'Upload Logo', 'Pakia Nembo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('44', 'to_restore_data', 'To Restore Data, You should select a valid Backup', 'Kurejesha Data, Lazima Uchague Chelezo Inayokubalika');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('45', 'restore_backup', 'Restore Backup', 'Rejesha Chelezo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('46', 'sidebar_toggle', 'Sidebar Toggle', 'Togo Mwambaa Upande');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('47', 'developed_by', 'Developed by', 'Iliundwa na');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('48', 'menu', 'Menu', 'Menyu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('49', 'ready_to_go', 'Ready to go', 'Uko tayari kuenda');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('50', 'end_session', 'Select \"Logout\" below if you are ready<br> to end your current session', 'Chagua \"Ondoka\" kama uko tayari<br> kumaliza kikao chako');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('51', 'Dashboard', 'dashboard', 'dashibodi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('52', 'admin dashboard', 'admin dashboard', 'Msimamizi dashibodi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('53', 'Suppliers', 'Suppliers', 'Wauzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('54', 'manage_suppliers', 'Manage Suppliers', 'Dhibiti Wauzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('55', '404', '404 Error', '404 Tatizo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('56', 'view_supplier', 'View Supplier', 'Angalia Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('57', 'category', 'Category', 'Kategoria');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('58', 'descriptions', 'Descriptions', 'Maelezo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('59', 'stock', 'Stock', 'Akiba');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('60', 'view_sales', 'View Sales', 'Angalia Mauzo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('61', 'view_purchases_outstandings', 'View Purchases Outstandings', 'Angalia Salio la Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('62', 'view_sales_outstandings', 'View Sales Outstandings', 'Angalia Salio la Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('63', 'events', 'Events', 'Matukio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('64', 'stock_reports', 'Stock Reports', 'Ripoti Za Akiba');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('65', 'category_reports', 'Category Reports', 'Ripoti Za Kategoria');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('66', 'sales_reports', 'Sales Reports', 'Ripoti Za Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('67', 'sales_outstanding_reports', 'Sales Outstandings Reports', 'Ripoti Za Masalio Ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('68', 'purchases_reports', 'Purchases Reports', 'Ripoti Za Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('69', 'purchases_outstanding_reports', 'Purchases Outstanding Reports', 'Ripoti Za Masalio Ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('70', 'events_reports', 'Event Reports', 'Ripoti Za Matukio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('71', 'manage_events', 'Manage Events', 'Dhibiti Matukio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('72', 'system_settings', 'System Settings', 'Mipangilio wa Mfumo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('73', 'profile', 'Profile', 'Wasifu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('74', 'view_stock', 'View Stock', 'Angalia Akiba');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('75', 'more_info', 'More Info', 'Angalia Zaidi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('76', 'available_stock', 'Available Stock', 'Akiba Iliyopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('77', 'low_stock', 'Low Stock', 'Akiba Kidogo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('78', 'total_events', 'Total Events', 'Matukio Yote');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('79', 'it_is_currently', 'It Is Currently', 'Leo Ni');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('80', 'recent_events', 'Recent Events', 'Matukio ya Hivi Punde');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('81', 'view_all_events', 'View All Events', 'Angalia Matukio Yote');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('82', 'purchases_details', 'Purchase Details', 'Kinaganaga Cha Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('83', 'total_stock_ordered', 'TOTAL STOCK ORDERED', 'AKIBA YOTE ILIYONUNULIWA');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('84', 'total_cost', 'TOTAL COST', 'MALIPO YOTE');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('85', 'amount', 'Amount', 'Pesa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('86', 'purchases', 'Purchases', 'Vilivyonunuliwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('87', 'overview', 'Overview', 'Mapitio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('88', 'Status', 'Status', 'Hali');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('89', 'driver', 'Driver', 'Kiendeshi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('90', 'print', 'Print', 'Chapisha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('91', 'version', 'Version', 'Toleo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('92', 'time', 'Time', 'Saa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('93', 'memory', 'Memory', 'Kumbukumbu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('94', 'system_version', 'System Version', 'Toleo La Fumo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('95', 'user_management', 'Suppliers Management', 'Dhibiti Wauzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('96', 'current_suppliers', 'Current Suppliers', 'Wauzaji Waliopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('97', 'add_supplier', 'Add Supplier', 'Ongeza Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('98', 'supplier_number', 'Supplier Number', 'Namba ya Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('99', 'supplier_name', 'Supplier Name', 'Jina la Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('100', 'phone', 'Phone Number', 'Nambari ya Simu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('101', 'datereg', 'Date Registered', 'Tarehe ya Kusajiliwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('102', 'action', 'Action', 'Hatua');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('103', 'edit_details', 'Edit Details', 'Hariri Kinaganaga');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('104', 'view_details', 'View Details', 'Angalia Kinaganaga');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('105', 'delete', 'Delete', 'Futa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('106', 'u_s_p', 'Upload Supplier Picture', 'Pakia Picha ya Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('107', 'chose_new_pic', 'Choose a New Picture', 'Chagua Picha Ingine Mpya');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('108', 'error', 'Error', 'Kosa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('109', 'input_fields_error', 'You have some errors in the input fields', 'Uko na makosa kwa baadhi ya uga ingizo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('110', 'success', 'Success', 'Fanikio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('111', 'supplier_added_message', 'Supplier was Added successfully', 'Muuzaji amefanikiwa kuongezwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('112', 'supplier_name_error', 'Supplier Name is required!', 'Jina la Muuzaji Latakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('113', 'phone_require_message', 'Phone number is required!', 'Nambari ya Simu yatakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('114', 'phone_digits_message', 'Phone Number Should contain numbers only!', 'Nambari ya Simu lazima iwe na <b>tarakimu pekee</b>!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('115', 'phone_digits_length', 'Phone Number must contain minimum of 10 digits', 'Nambari ya Simu lazima iwe na kiwango chini cha tarakimu 10.');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('116', 'supplier_email_error', 'Supplier email is required!', 'Barua Pepe ya muuzaji yatakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('117', 'supplier_invalid_email_error', 'This supplier email is invalid!', 'Hii Barua Pepe ya muuzaji si <b>halali</b>!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('118', 'address_error_message', 'Address is required!', 'Anwani Yatakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('119', 'edit_supplier_details', 'Edit Supplier Details', 'Hariri Kinaganaga cha Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('120', 'update_supplier', 'Update Supplier', 'Sasisha Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('121', 'supplier_updated_message', 'Supplier Was Updated successfully', 'Muuzaji Alifanikiwa Kusasishwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('122', 'picture', 'Picture', 'Picha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('123', 'supplied', 'Supplied', 'Alivyouza');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('124', 'supplier', 'Supplier', 'Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('125', 'since', 'since', 'tangu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('126', 'total_purchasing_price', 'Total Purchasing Price', 'Bei Yote ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('127', 'quantity', 'Quantity', 'Idadi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('128', 'date_supplied', 'Date Supplied', 'Tarehe Aliyouza');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('129', 'contact_details', 'Contact Details', 'Kinaganaga cha Mwasiliani');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('130', 'back_to_suppliers', 'Back to Suppliers', 'Rudi kwa Wauzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('131', 'quick_links', 'Quick Links', 'Viungo Chapu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('132', 'basic_information', 'Basic Information', 'Taarifa Msingi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('133', 'personal_information', 'Personal Information', 'Taarifa Binafsi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('134', 'current_picture', 'Current Picture', 'Picha ya Sahii');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('135', 'update_supplier_picture', 'Update Supplier Picture', 'Sasisha Picha Ya Muuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('136', 'profile_picture', 'Profile Picture', 'Picha ya Wasifu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('137', 'picture_update', 'Picture Was Updated Successfully', 'Picha ilifanikiwa Kusasishwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('138', 'welcome', 'Welcome', 'Karibu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('139', 'you_have_successfully_loggedin', 'You have successfully logged in and started your session.', 'Umefanikiwa kuingia na kuanza kikao chako.');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('140', 'admin_profile', 'Admin Profile', 'Msimamiaji Wasifu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('141', 'manage_profile', 'Manage Profile', 'Dhibiti Wasifu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('142', 'change_password', 'Change Password', 'Badilisha Nywila');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('143', 'name', 'Full Name', 'Majina Yote Kamili');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('144', 'password', 'Password', 'Nywila');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('145', 'role', 'Role', 'Jukumu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('146', 'current_password', 'Current Password', 'Nywila ya Sahii');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('147', 'new_password', 'New Password', 'Nywila Mpya');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('148', 'save', 'Save', 'Hifadhi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('149', 'confirm_password', 'Confirm Password', 'Dhibitisha Nywila');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('150', 'upload_profile_picture', 'Upload Profile Picture', 'Pakia Picha ya Wasifu');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('151', 'current_password_error', 'Input Your Current Password', 'Nywila ya sahii Yatakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('152', 'new_password_error', 'Input Your New Password', 'Ingiza Nywila yako mpya!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('153', 'confirm_password_error', 'Confirm Your New Password!', 'Dhibitisha Nywila yako mpya!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('154', 'password_mismatch_error', 'This Password Does Not Match The New Password!', 'Hii Nywila haifanani na Nywila Mpya Ulioingiza!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('155', 'fullnames_error', 'Fullnames are required!', 'Majina yako kamili yatakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('156', 'username_error', 'Username is required!', 'Jina la Mtumiaji latakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('157', 'password_change_message', 'Your Password was changed successfully.', 'Nywila yako ilifanikiwa kubadilishwa.');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('158', 'profile_update_message', 'Your Profile Was Successfully Updated', 'Wasifu wako Ulifanikiwa kusasishwa.');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('159', 'password_mismatch_message', 'Password Mismatch!', 'Nywila Hazifanani!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('160', 'settings_update_message', 'Settings were updated successfully.', 'Mipangilio Imefanikiwa Kusasishwa.');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('161', 'language_settings', 'Language Settings', 'Mipangilio ya Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('162', 'edit', 'Edit', 'Hariri');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('163', 'edit_language', 'Edit Language', 'Hariri Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('164', 'manage_language', 'Manage Language', 'Dhibiti Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('165', 'update_phrase', 'Update Phrase', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('166', 'update', 'Update', 'Sasisha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('167', 'language_success_message', 'Language was Successfully Updated!', 'Lugha ilifanikiwa Kusasishwa!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('168', 'phrase_added', 'Phrase was added successfully!', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('169', 'add_language', 'Add Language', 'Ongeza Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('170', 'add_phrase', 'Add Phrase', 'Ongeza Phrase');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('171', 'language_list', 'Language List', 'Orodha Ya Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('172', 'language_name', 'Language Name', 'Jina La Lugha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('173', 'phrase_name', 'Phrase Name', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('174', 'language_added_message', 'Language was Successfully Added!', 'Lugha Ilifanikiwa Kuongezwa!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('175', 'total_price', 'Total Price', 'Bei Yote');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('176', 'order_no', 'Order No', 'Nambari ya Oda');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('177', 'customer_name', 'Customer Name', 'Jina la Mnunuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('178', 'sales_date', 'Sales Date', 'Tarehe ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('179', 'sold_items', 'Sold Items', 'Vitu Vilivyouzwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('180', 'payment_status', 'Payment Status', 'Hali ya Malipo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('181', 'order', 'Order', 'oda');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('182', 'customer', 'Customer', 'Mnunuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('183', 'item', 'Items', 'Bidhaa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('184', 'price', 'Price', 'Bei');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('185', 'upload_user_picture', 'Upload User Picture', 'Pakia Picha ya Mtumiaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('186', 'back_to_sales', 'Back to Sales', 'Rudi kwa Vilivyouzwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('187', 'payment_type', 'Payment type', 'Jinsi Ya Malipo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('188', 'payment_details', 'Payment Details', 'Kinaganaga cha Malipo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('189', 'purchase_date', 'Purchase(s) date', 'Tarehe ya Ununuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('190', 'purchase_number', 'Purchase(s) Number', 'Nambari ya Ununuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('191', 'balance', 'Balance', 'Salio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('192', 'total_paid', 'Total Paid', 'Zilizolipwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('193', 'pay_now', 'Pay now', 'Lipa Sahii');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('194', 'p_outstandings_message', 'There are no outstanding purchases records found', 'Hakuna rekodi ya masalio ya ununuzi yaliyopatikana');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('195', 'due_amt', 'Due Amount', 'Salio Lililobaki');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('196', 'payment', 'Payment', 'Malipo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('197', 'make_payment', 'Make Payment', 'Fanya Malipo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('198', 'back_to_po', 'Back to Purchase Outstandings', 'Rudi kwa Masalio ya Ununuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('199', 'payment_success_message', 'Payment was updated successfully', 'Malipo Yalifanikiwa Kusasishwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('200', 'items_ordered', 'Items Ordered', 'Bidhaa Vilivyoagizwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('201', 'sales_no', 'sale(s) number', 'Nambari ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('202', 'items_sold', 'Items Sold', 'Bidhaa Vilivyouzwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('203', 'back_to_so', 'Back to Sales Outstandings', 'Rudi kwa Masalio ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('204', 'photo', 'Photo', 'Picha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('205', 'add_user', 'add User', 'Ongeza Mtumiaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('206', 'current_users', 'Current Users', 'Watumiaji Waliopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('207', 'user_added_message', 'User was Added Successfully', 'Mtumiaji Alifanikiwa Kuongezwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('208', 'user_updated_message', 'User was Updated Successfully!', 'Mtumiaji Alifanikiwa Kusasishwa!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('209', 'user_deleted_message', 'User was Deleted Successfully!', 'Mtumiaji Alifanikiwa Kutolewa!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('210', 'update_user_image', 'User Image was Updated Successfully!', 'Sasisha Picha Ya Mtumiaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('211', 'username_exist_error', 'The username above has already been taken. Please select another username.', 'Jina hili linatumiwa na Mtumiaji mwengine. Tafadhali chagua jina lingine!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('212', 'idno_error', 'IDNO is required!', 'IDNO Yatakikana!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('213', 'idno_digits_only', 'IDNO Should contain numbers only!', 'IDNO lazima iwe na <b>tarakimu pekee</b>!');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('214', 'generate_reports', 'Generate Reports', 'Dokeza Ripoti');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('215', 'stock_details', 'Stock Details', 'Kinaganaga cha Akiba');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('216', 'category_details', 'Category Details', 'Kinaganaga Cha kategoria');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('217', 'sales_details', 'Sales Details', 'Kinaganaga cha Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('218', 'sales_outstanding_details', 'Sales Outstanding Details', 'Kinaganaga cha Masalio Ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('219', 'purchases_details', 'Purchases Details', 'Kinaganaga cha Masalio Ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('220', 'p_outstandings_details', 'Purchases Outstanding Details', 'Kinaganaga cha Masalio Ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('221', 'events_details', 'Events Details', 'Kinaganaga Cha Matukio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('222', 'damaged_stock', 'Damaged Stock', 'Akiba Iliyoharibiwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('223', 'sold_stock', 'Sold Stock', 'Akiba Iliyouzwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('224', 'available', 'Available', 'Iliyopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('225', 'damaged', 'Damaged', 'Iliyoharibiwa');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('226', 'buying_price', 'Buying Price', 'Bei ya Ununuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('227', 'selling_price', 'Selling Price', 'Bei ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('228', 'image_must_be_no_larger_than_500x500_pixels', '', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('229', 'print_report', 'Print Report', 'Chapisha Ripoti');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('230', 'no_data_available', 'No Data Available in Table.', 'Hakuna Data Iliopo kwa hili jedwali.');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('231', 'available_category', 'Available Category', 'Kategoria Iliyopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('232', 'not_available_category', 'Not Available Category', 'Kategoria Isiyopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('233', 'report_select_sales', 'Select Date To View Sales Report', 'Chagua Tarehe Uangalie Ripoti ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('234', 'from', 'From', 'Kutoka');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('235', 'to', 'To', 'Hadi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('236', 'reload_list', 'Reload List', 'Tafuta kwa Orodha');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('237', 'report_select_so', 'Select Date To View Sales Outstandings Report', 'Chagua Tarehe Uangalie Ripoti za Masalio ya Uuzaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('238', 'report_select_purchases', 'Select Date To View Purchases Report', 'Chagua Tarehe Uangalie Ripoti ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('239', 'report_select_po', 'Select Date To View Purchases Outstanding Reports', 'Chagua Tarehe Uangalie Ripoti za Masalio ya Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('240', 'title', 'Title', 'Cheo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('241', 'notice', 'Notice', 'Notisi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('242', 'date', 'Date', 'Tarehe');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('243', 'report_select_events', 'Select Date To View Event Reports', 'Chagua Tarehe Uangalie Ripoti za Matukio');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('244', 'logs', 'Logs', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('245', 'orders', 'Orders', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('246', 'view_purchases', 'View Purchases', 'Angalia Ununuaji');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('247', 'back_to_purchases', 'Back to Purchases', 'Rudi kwa Ununuzi');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('248', 'status', 'Status', 'Hali');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('249', 'history', 'History', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('250', 'activate', 'Activate', 'Activate');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('251', 'description', 'description', '');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('252', 'history_message', 'There are no history logs available', 'Hakuna historia iliyopo');
INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `kiswahili`) VALUES ('253', 'security_question', 'Security Question', 'Swali La Siri');


#
# TABLE STRUCTURE FOR: login
#

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `names` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(100) NOT NULL,
  `login_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `login` (`id`, `username`, `password`, `role`, `names`, `user_id`, `question`, `answer`, `login_status`) VALUES ('1', 'administrator', '$2y$10$RN5YWFsXbiEi2iRtO3NdyO3ax8XzZfa9mF8EKz1DfcatIDYmxB1qK', 'admin', 'Administrator', '0', '', '', 'active');


#
# TABLE STRUCTURE FOR: order_item
#

DROP TABLE IF EXISTS `order_item`;

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_item_status` int(11) NOT NULL,
  `deleted_status` int(11) NOT NULL,
  PRIMARY KEY (`order_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: orders
#

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(100) NOT NULL,
  `order_date` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `order_status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `om_date` varchar(100) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: profiles
#

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullnames` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `idno` int(11) NOT NULL,
  `datereg` varchar(100) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: purchases
#

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_no` varchar(100) NOT NULL,
  `purchase_date` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `paid` varchar(100) NOT NULL,
  `due` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `deleted_purchase` int(11) NOT NULL,
  `pm_date` varchar(100) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: settings
#

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `systemname` varchar(100) NOT NULL,
  `systemtitle` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `language` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`id`, `systemname`, `systemtitle`, `phone`, `address`, `email`, `language`) VALUES ('1', 'Inventory Management System', 'System Inventory', '0700000000', '1234 Kenya', 'system_mail@gmail.com', 'english');


#
# TABLE STRUCTURE FOR: stock
#

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `b_price` int(11) NOT NULL,
  `s_price` varchar(100) NOT NULL,
  `available` int(11) NOT NULL,
  `purchases_ordered` int(11) NOT NULL,
  `purchase_total` int(11) NOT NULL,
  `damaged` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: supplier
#

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_number` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_phone` int(11) NOT NULL,
  `supplier_address` varchar(100) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL,
  `deleted_supplier` int(11) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

