<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2022 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sun, 25 Sep 2022 20:47:04 GMT
 */

if (!defined('NV_IS_FILE_MODULES')) {
    die('Stop!!!');
}

$sql_drop_module = [];
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_backupcodes";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_config";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_edit";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_field";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups_detail";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_groups_users";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_info";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_openid";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_question";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $module_data . "_reg";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "(
  userid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  group_id smallint(5) unsigned NOT NULL DEFAULT 0,
  username varchar(100) NOT NULL DEFAULT '',
  md5username char(32) NOT NULL DEFAULT '',
  password varchar(150) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL DEFAULT '',
  first_name varchar(100) NOT NULL DEFAULT '',
  last_name varchar(100) NOT NULL DEFAULT '',
  gender char(1) DEFAULT '',
  photo varchar(255) DEFAULT '',
  birthday int(11) NOT NULL,
  sig text DEFAULT NULL,
  regdate int(11) NOT NULL DEFAULT 0,
  question varchar(255) NOT NULL,
  answer varchar(255) NOT NULL DEFAULT '',
  passlostkey varchar(50) DEFAULT '',
  view_mail tinyint(1) unsigned NOT NULL DEFAULT 0,
  remember tinyint(1) unsigned NOT NULL DEFAULT 0,
  in_groups varchar(255) DEFAULT '',
  active tinyint(1) unsigned NOT NULL DEFAULT 0,
  active2step tinyint(1) unsigned NOT NULL DEFAULT 0,
  secretkey varchar(20) DEFAULT '',
  checknum varchar(40) DEFAULT '',
  last_login int(11) unsigned NOT NULL DEFAULT 0,
  last_ip varchar(45) DEFAULT '',
  last_agent varchar(255) DEFAULT '',
  last_openid varchar(255) DEFAULT '',
  last_update int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Th???i ??i???m c???p nh???t th??ng tin l???n cu???i',
  idsite int(11) NOT NULL DEFAULT 0,
  safemode tinyint(1) unsigned NOT NULL DEFAULT 0,
  safekey varchar(40) DEFAULT '',
  email_verification_time int(11) NOT NULL DEFAULT -1 COMMENT '-3: T??i kho???n sys, -2: Admin k??ch ho???t, -1 kh??ng c???n k??ch ho???t, 0: Ch??a x??c minh, > 0 th???i gian x??c minh',
  active_obj varchar(50) NOT NULL DEFAULT 'SYSTEM' COMMENT 'SYSTEM, EMAIL, OAUTH:xxxx, qu???n tr??? k??ch ho???t th?? l??u userid',
  PRIMARY KEY (userid),
  UNIQUE KEY username (username),
  UNIQUE KEY md5username (md5username),
  UNIQUE KEY email (email),
  KEY idsite (idsite)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_backupcodes(
  userid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  code varchar(20) NOT NULL,
  is_used tinyint(1) unsigned NOT NULL DEFAULT 0,
  time_used int(11) unsigned NOT NULL DEFAULT 0,
  time_creat int(11) unsigned NOT NULL DEFAULT 0,
  UNIQUE KEY userid (userid,code)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_config(
  config varchar(100) NOT NULL,
  content text DEFAULT NULL,
  edit_time int(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (config)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_edit(
  userid mediumint(8) unsigned NOT NULL,
  lastedit int(11) unsigned NOT NULL DEFAULT 0,
  info_basic text NOT NULL,
  info_custom text NOT NULL,
  PRIMARY KEY (userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_field(
  fid mediumint(8) NOT NULL AUTO_INCREMENT,
  field varchar(25) NOT NULL,
  weight int(10) unsigned NOT NULL DEFAULT 1,
  field_type enum('number','date','textbox','textarea','editor','select','radio','checkbox','multiselect') NOT NULL DEFAULT 'textbox',
  field_choices text NOT NULL,
  sql_choices text NOT NULL,
  match_type enum('none','alphanumeric','unicodename','email','url','regex','callback') NOT NULL DEFAULT 'none',
  match_regex varchar(250) NOT NULL DEFAULT '',
  func_callback varchar(75) NOT NULL DEFAULT '',
  min_length int(11) NOT NULL DEFAULT 0,
  max_length bigint(20) unsigned NOT NULL DEFAULT 0,
  required tinyint(3) unsigned NOT NULL DEFAULT 0,
  show_register tinyint(3) unsigned NOT NULL DEFAULT 0,
  user_editable tinyint(3) unsigned NOT NULL DEFAULT 0,
  show_profile tinyint(4) NOT NULL DEFAULT 1,
  class varchar(50) NOT NULL,
  language text NOT NULL,
  default_value varchar(255) NOT NULL DEFAULT '',
  is_system tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (fid),
  UNIQUE KEY field (field)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_groups(
  group_id smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  alias varchar(240) NOT NULL,
  email varchar(100) DEFAULT '',
  group_type tinyint(4) unsigned NOT NULL DEFAULT 0 COMMENT '0:Sys, 1:approval, 2:public',
  group_color varchar(10) NOT NULL,
  group_avatar varchar(255) NOT NULL,
  require_2step_admin tinyint(1) unsigned NOT NULL DEFAULT 0,
  require_2step_site tinyint(1) unsigned NOT NULL DEFAULT 0,
  is_default tinyint(1) unsigned NOT NULL DEFAULT 0,
  add_time int(11) NOT NULL,
  exp_time int(11) NOT NULL,
  weight int(11) unsigned NOT NULL DEFAULT 0,
  act tinyint(1) unsigned NOT NULL,
  idsite int(11) unsigned NOT NULL DEFAULT 0,
  numbers mediumint(9) unsigned NOT NULL DEFAULT 0,
  siteus tinyint(4) unsigned NOT NULL DEFAULT 0,
  config varchar(250) DEFAULT '',
  is_system tinyint(1) NOT NULL DEFAULT 0 COMMENT 'L?? nh??m h??? th???ng',
  PRIMARY KEY (group_id),
  UNIQUE KEY kalias (alias,idsite),
  KEY exp_time (exp_time)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_groups_detail(
  group_id smallint(5) unsigned NOT NULL DEFAULT 0,
  lang char(2) NOT NULL DEFAULT '',
  title varchar(240) NOT NULL,
  description varchar(240) NOT NULL DEFAULT '',
  content text DEFAULT NULL,
  UNIQUE KEY group_id_lang (lang,group_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_groups_users(
  group_id smallint(5) unsigned NOT NULL DEFAULT 0,
  userid mediumint(8) unsigned NOT NULL DEFAULT 0,
  is_leader tinyint(1) unsigned NOT NULL DEFAULT 0,
  approved tinyint(1) unsigned NOT NULL DEFAULT 0,
  data text NOT NULL,
  time_requested int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Th???i gian y??u c???u tham gia',
  time_approved int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Th???i gian duy???t y??u c???u tham gia',
  PRIMARY KEY (group_id,userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_info(
  userid mediumint(8) unsigned NOT NULL,
  phone varchar(255) NOT NULL DEFAULT '' COMMENT '??i???n tho???i',
  code varchar(255) NOT NULL DEFAULT '' COMMENT 'M?? nh??n vi??n',
  bank_card varchar(255) NOT NULL DEFAULT '' COMMENT 'T??i kho???n ng??n h??ng',
  start_working double NOT NULL DEFAULT 0 COMMENT 'Ng??y ch??nh th???c l??m vi???c',
  date_cmnd varchar(255) NOT NULL DEFAULT '' COMMENT 'Ng??y c???p CMND/CCCD',
  cmnd varchar(255) NOT NULL DEFAULT '' COMMENT 'S??? CMND/CCCD',
  PRIMARY KEY (userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_openid(
  userid mediumint(8) unsigned NOT NULL DEFAULT 0,
  openid char(50) NOT NULL DEFAULT '',
  opid char(50) NOT NULL DEFAULT '',
  id char(50) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL DEFAULT '',
  UNIQUE KEY opid (openid,opid),
  KEY userid (userid),
  KEY email (email)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_question(
  qid smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(240) NOT NULL DEFAULT '',
  lang char(2) NOT NULL DEFAULT '',
  weight mediumint(8) unsigned NOT NULL DEFAULT 0,
  add_time int(11) unsigned NOT NULL DEFAULT 0,
  edit_time int(11) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (qid),
  UNIQUE KEY title (title,lang)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $module_data . "_reg(
  userid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(100) NOT NULL DEFAULT '',
  md5username char(32) NOT NULL DEFAULT '',
  password varchar(150) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL DEFAULT '',
  first_name varchar(255) NOT NULL DEFAULT '',
  last_name varchar(255) NOT NULL DEFAULT '',
  gender char(1) NOT NULL DEFAULT '',
  birthday int(11) NOT NULL,
  sig text DEFAULT NULL,
  regdate int(11) unsigned NOT NULL DEFAULT 0,
  question varchar(255) NOT NULL,
  answer varchar(255) NOT NULL DEFAULT '',
  checknum varchar(50) NOT NULL DEFAULT '',
  users_info text DEFAULT NULL,
  openid_info text DEFAULT NULL,
  idsite mediumint(8) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (userid),
  UNIQUE KEY login (username),
  UNIQUE KEY md5username (md5username),
  UNIQUE KEY email (email)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('access_admin', 'a:8:{s:15:\"access_viewlist\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:12:\"access_addus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:14:\"access_waiting\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:17:\"access_editcensor\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:13:\"access_editus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:12:\"access_delus\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}s:13:\"access_passus\";a:2:{i:1;b:1;i:2;b:1;}s:13:\"access_groups\";a:3:{i:1;b:1;i:2;b:1;i:3;b:1;}}', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('password_simple', '000000|1234|2000|12345|111111|123123|123456|654321|696969|1234567|1234569|11223344|12345678|12345679|23456789|66666666|66668888|68686868|87654321|88888888|99999999|123456789|999999999|1234567890|aaaaaa|abc123|abc123@|abc@123|admin123|admin123@|admin@123|adobe1|adobe123|azerty|baseball|dragon|football|harley|hoilamgi|iloveyou|jennifer|jordan|khongbiet|khongco|khongcopass|letmein|macromedia|master|michael|monkey|mustang|nuke123|nuke123@|nuke@123|password|photoshop|pussy|qwerty|shadow|superman', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('deny_email', 'yoursite.com|mysite.com|localhost|xxx', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('deny_name', 'anonimo|anonymous|god|linux|nobody|operator|root', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('avatar_width', '80', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('avatar_height', '80', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('active_group_newusers', '1', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('active_editinfo_censor', '1', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('active_user_logs', '1', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('min_old_user', '16', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('register_active_time', '86400', '1662650678')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('auto_assign_oauthuser', '0', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('admin_email', '0', '1663731752')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_config (config, content, edit_time) VALUES('siteterms_vi', '<p> ????? tr??? th??nh th??nh vi??n, b???n ph???i cam k???t ?????ng ?? v???i c??c ??i???u kho???n d?????i ????y. Ch??ng t??i c?? th??? thay ?????i l???i nh???ng ??i???u kho???n n??y v??o b???t c??? l??c n??o v?? ch??ng t??i s??? c??? g???ng th??ng b??o ?????n b???n k???p th???i.<br /> <br /> B???n cam k???t kh??ng g???i b???t c??? b??i vi???t c?? n???i dung l???a ?????o, th?? t???c, thi???u v??n ho??; vu kh???ng, khi??u kh??ch, ??e do??? ng?????i kh??c; li??n quan ?????n c??c v???n ????? t??nh d???c hay b???t c??? n???i dung n??o vi ph???m lu???t ph??p c???a qu???c gia m?? b???n ??ang s???ng, lu???t ph??p c???a qu???c gia n??i ?????t m??y ch??? c???a website n??y hay lu???t ph??p qu???c t???. N???u v???n c??? t??nh vi ph???m, ngay l???p t???c b???n s??? b??? c???m tham gia v??o website. ?????a ch??? IP c???a t???t c??? c??c b??i vi???t ?????u ???????c ghi nh???n l???i ????? b???o v??? c??c ??i???u kho???n cam k???t n??y trong tr?????ng h???p b???n kh??ng tu??n th???.<br /> <br /> B???n ?????ng ?? r???ng website c?? quy???n g??? b???, s???a, di chuy???n ho???c kho?? b???t k??? b??i vi???t n??o trong website v??o b???t c??? l??c n??o tu??? theo nhu c???u c??ng vi???c.<br /> <br /> ????ng k?? l??m th??nh vi??n c???a ch??ng t??i, b???n c??ng ph???i ?????ng ?? r???ng, b???t k??? th??ng tin c?? nh??n n??o m?? b???n cung c???p ?????u ???????c l??u tr??? trong c?? s??? d??? li???u c???a h??? th???ng. M???c d?? nh???ng th??ng tin n??y s??? kh??ng ???????c cung c???p cho b???t k??? ng?????i th??? ba n??o kh??c m?? kh??ng ???????c s??? ?????ng ?? c???a b???n, ch??ng t??i kh??ng ch???u tr??ch nhi???m v??? vi???c nh???ng th??ng tin c?? nh??n n??y c???a b???n b??? l??? ra b??n ngo??i t??? nh???ng k??? ph?? ho???i c?? ?? ????? x???u t???n c??ng v??o c?? s??? d??? li???u c???a h??? th???ng.</p>', '1274757129')";
