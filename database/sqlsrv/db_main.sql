CREATE TABLE users (
  id int IDENTITY(1,1) PRIMARY KEY,
  iduser varchar(255) DEFAULT NULL,
  username varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  phone varchar(255) DEFAULT NULL,
  [otp] varchar(255) DEFAULT Null,
  pin varchar(255) DEFAULT Null,
  [password] varchar(255) DEFAULT Null,
  store_token text DEFAULT NULL,
  reset_token text DEFAULT NULL,
  [role] int NOT NULL DEFAULT 0, -- 99=SuperAdmin
  [status] int NOT NULL DEFAULT 0,
  idmitra varchar(255) default NULL,
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  created_otp datetime DEFAULT NULL,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL
);

CREATE UNIQUE INDEX ux_iduser
ON users (iduser);

-- --------------------------------------------------------

CREATE TABLE bank (
  id INT IDENTITY(1,1) PRIMARY KEY,
  nama VARCHAR(255),
  kode VARCHAR(10),
  alamat VARCHAR(255),
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL
);

-- --------------------------------------------------------

CREATE TABLE kota (
  id INT IDENTITY(1,1) PRIMARY KEY,
  kota varchar(255) not null,
  provinsi varchar(255) not null,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT kota_na UNIQUE (kota)
);

-- --------------------------------------------------------

CREATE TABLE coa (
  id int IDENTITY(1,1) PRIMARY KEY,
  kode varchar(10) NOT NULL,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT kode_na UNIQUE (kode)
);

-- --------------------------------------------------------

CREATE TABLE nasabah (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_user varchar(255) NOT NULL,
  id_validator varchar(255) default NULL,
  nama varchar(255) default NULL,
  ktp varchar(255) DEFAULT NULL,
  image_ktp varchar(255) DEFAULT NULL,
  image_selfie varchar(255) DEFAULT NULL,
  tmpt_lahir varchar(255) DEFAULT NULL,
  tgl_lahir varchar(255) DEFAULT NULL,
  ibu_kandung varchar(255) DEFAULT NULL,
  id_privy varchar(255) NULL,
  status_pernikahan int NULL,
  jenis_pekerjaan varchar(255) NULL,
  alamat varchar(255) DEFAULT NULL,
  nama_perusahaan varchar(255) DEFAULT NULL,
  alamat_kerja varchar(255) DEFAULT NULL,
  penghasilan int NULL,
  nama_ahli_waris varchar(255) DEFAULT NULL,
  ktp_ahli_waris varchar(255) DEFAULT NULL,
  image_ktp_ahli_waris varchar(255) DEFAULT NULL,
  hub_ahli_waris varchar(255) DEFAULT NULL,
  phone_ahli_waris varchar(255) DEFAULT NULL,
  validasi int DEFAULT 0, -- 1=Blm Valid, 2=Sdh Valid
  ket_validasi varchar(255) DEFAULT NULL,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT fk_nasabah FOREIGN KEY (id_user) REFERENCES users(iduser)
);

-- --------------------------------------------------------

CREATE TABLE norek_nasabah (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_user varchar(255) NOT NULL,
  bank varchar(255) NOT NULL,
  norek varchar(255) NOT NULL,
  atas_nama varchar(255) DEFAULT NULL,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT fk_norek_nasabah FOREIGN KEY (id_user) REFERENCES users(iduser)
);

-- --------------------------------------------------------

CREATE TABLE mitra (
  id int IDENTITY(1,1) PRIMARY KEY,
  idmitra varchar(255) NOT NULL,

  nama varchar(255)  NOT NULL,
  email varchar(255)  NOT NULL,
  phone varchar(255)  NOT NULL,
  mulai_beroperasi date default NULL,
  website varchar(255) default NULL,
  alamat varchar(255) default NULL,
  kota int NULL,

  no_npwp varchar(255) default NULL,
  npwp_kota int default NULL,
  npwp_alamat varchar(255) default NULL,
  no_akta_pendirian varchar(255) default NULL,
  nama_pengurus varchar(255) default NULL,
  jabatan_pengurus varchar(255) default NULL,
  phone_pengurus varchar(255) default NULL,

  no_pengesahan_akta varchar(255) default NULL,
  tgl_pengesahan_akta date default NULL,
  nama_notaris varchar(255) default NULL,
  lokasi_notaris varchar(255) default NULL,
  no_ijin varchar(255) default NULL,
  tgl_ijin date default NULL,

  id_privy varchar(255) default NULL,
  logo varchar(255) default NULL,

  validasi int DEFAULT 0, -- 1=Blm Valid, 2=Sdh Valid, 3=Tidak Aktif
  id_validator varchar(255) NOT NULL,
  keterangan varchar(255) default null,

  db_name varchar(255)  default NULL,
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT fk_kota FOREIGN KEY (kota) REFERENCES kota(id),
  CONSTRAINT fk_kota_npwk FOREIGN KEY (npwp_kota) REFERENCES kota(id)
);

CREATE UNIQUE INDEX ux_idmitra
ON mitra (idmitra);

-- --------------------------------------------------------

CREATE TABLE norek_mitra (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_mitra varchar(255) not null,
  nama varchar(255) not null,
  atas_nama varchar(255) not null,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT fk_norek_mitra FOREIGN KEY (id_mitra) REFERENCES mitra(idmitra)
);

-- --------------------------------------------------------

CREATE TABLE neraca (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_mitra varchar(255) not null,
  asset INT DEFAULT 0,
  kewajiban INT DEFAULT 0,
  ekuitas INT DEFAULT 0,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  CONSTRAINT fk_neraca FOREIGN KEY (id_mitra) REFERENCES mitra(idmitra)
);

-- --------------------------------------------------------

CREATE TABLE promo (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_mitra varchar(255) not null,
  image varchar(255) DEFAULT null,
  deskripsi varchar(255) not null,
  status INT DEFAULT 1,
  end_date date not null,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  CONSTRAINT fk_promo FOREIGN KEY (id_mitra) REFERENCES mitra(idmitra)
);

-- --------------------------------------------------------

CREATE TABLE splash_screen (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_admin INT NOT NULL,
  image varchar(255) DEFAULT 0,
  deskripsi varchar(255) DEFAULT 0,
  urutan INT DEFAULT 1,
  status INT DEFAULT 1,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  CONSTRAINT fk_splash FOREIGN KEY (id_admin) REFERENCES users(id)
);

-- --------------------------------------------------------

CREATE TABLE produk (
  id int IDENTITY(1,1) PRIMARY KEY,
  id_mitra INT NOT NULL,
  no_produk varchar(255) NOT NULL,
  minimal varchar(255) NULL,
  target varchar(255) NULL,
  bagi_hasil varchar(255) NULL,
  tenor varchar(255) NULL,
  start_date date NULL,
  end_date date NULL,
  status INT DEFAULT 1,
  created_at datetime DEFAULT current_timestamp,
  updated_at datetime DEFAULT NULL,
  deleted_at datetime DEFAULT NULL,
  user_created varchar(255) DEFAULT NULL,
  user_updated varchar(255) DEFAULT NULL,
  user_deleted varchar(255) DEFAULT NULL,
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  CONSTRAINT fk_produk_mitra FOREIGN KEY (id_mitra) REFERENCES mitra(id)
);

-- --------------------------------------------------------

CREATE TABLE log_app (
  id INT IDENTITY(1,1) PRIMARY KEY,
  id_user varchar(255) not null,
  keterangan text not null,
  notifikasi int DEFAULT 0,
  created_at datetime DEFAULT GETDATE()
);

-- --------------------------------------------------------

INSERT INTO kota (provinsi, kota) VALUES
  ('Aceh', 'Banda Aceh'),
  ('Aceh', 'Sabang'),
  ('Aceh', 'Lhokseumawe'),
  ('Aceh', 'Langsa'),
  ('Aceh', 'Meulaboh'),
  ('Bali', 'Denpasar'),
  ('Bali', 'Singaraja'),
  ('Bali', 'Tabanan'),
  ('Bali', 'Gianyar'),
  ('Bali', 'Badung'),
  ('Banten', 'Serang'),
  ('Banten', 'Tangerang'),
  ('Banten', 'Cilegon'),
  ('Banten', 'Tangerang Selatan'),
  ('Bengkulu', 'Bengkulu'),
  ('Bengkulu', 'Curup'),
  ('Bengkulu', 'Muko-Muko'),
  ('Bengkulu', 'Manna'),
  ('Bengkulu', 'Kaur'),
  ('Gorontalo', 'Gorontalo'),
  ('Gorontalo', 'Limboto'),
  ('Gorontalo', 'Tilamuta'),
  ('Gorontalo', 'Kwandang'),
  ('Gorontalo', 'Suwawa'),
  ('Jakarta', 'Jakarta Pusat'),
  ('Jakarta', 'Jakarta Barat'),
  ('Jakarta', 'Jakarta Timur'),
  ('Jakarta', 'Jakarta Utara'),
  ('Jakarta', 'Jakarta Selatan'),
  ('Jambi', 'Jambi'),
  ('Jambi', 'Sungai Penuh'),
  ('Jambi', 'Sarolangun'),
  ('Jambi', 'Muara Bulian'),
  ('Jambi', 'Tebo'),
  ('Jawa Barat', 'Bandung'),
  ('Jawa Barat', 'Bekasi'),
  ('Jawa Barat', 'Bogor'),
  ('Jawa Barat', 'Depok'),
  ('Jawa Barat', 'Cimahi'),
  ('Jawa Tengah', 'Semarang'),
  ('Jawa Tengah', 'Surakarta'),
  ('Jawa Tengah', 'Salatiga'),
  ('Jawa Tengah', 'Magelang'),
  ('Jawa Tengah', 'Pekalongan'),
  ('Jawa Timur', 'Surabaya'),
  ('Jawa Timur', 'Malang'),
  ('Jawa Timur', 'Sidoarjo'),
  ('Jawa Timur', 'Jember'),
  ('Jawa Timur', 'Mojokerto'),
  ('Kalimantan Barat', 'Pontianak'),
  ('Kalimantan Barat', 'Singkawang'),
  ('Kalimantan Barat', 'Kubu Raya'),
  ('Kalimantan Barat', 'Sambas'),
  ('Kalimantan Selatan', 'Banjarmasin'),
  ('Kalimantan Selatan', 'Banjarbaru'),
  ('Kalimantan Selatan', 'Martapura'),
  ('Kalimantan Selatan', 'Tanjung'),
  ('Kalimantan Tengah', 'Palangkaraya'),
  ('Kalimantan Tengah', 'Sampit'),
  ('Kalimantan Tengah', 'Kuala Pembuang'),
  ('Kalimantan Tengah', 'Buntok'),
  ('Kalimantan Timur', 'Samarinda'),
  ('Kalimantan Timur', 'Balikpapan'),
  ('Kalimantan Timur', 'Bontang'),
  ('Kalimantan Timur', 'Tarakan'),
  ('Kalimantan Timur', 'Sangatta'),
  ('Kalimantan Utara', 'Tanjung Selor'),
  ('Kalimantan Utara', 'Bulungan'),
  ('Kalimantan Utara', 'Malinau'),
  ('Kepulauan Bangka', 'Belitung	Pangkal Pinang'),
  ('Kepulauan Bangka', 'Sungailiat'),
  ('Kepulauan Bangka', 'Muntok'),
  ('Kepulauan Bangka', 'Toboali'),
  ('Kepulauan Bangka', 'Manggar'),
  ('Kepulauan Riau', 'Tanjung Pinang'),
  ('Kepulauan Riau', 'Batam'),
  ('Kepulauan Riau', 'Bintan'),
  ('Kepulauan Riau', 'Karimun'),
  ('Lampung	Bandar', 'Lampung'),
  ('Lampung	Bandar', 'Metro'),
  ('Lampung	Bandar', 'Krui'),
  ('Lampung	Bandar', 'Liwa'),
  ('Lampung	Bandar', 'Kotabumi'),
  ('Maluku Utara', 'Ternate'),
  ('Maluku Utara', 'Tidore'),
  ('Maluku Utara', 'Kepulauan'),
  ('Maluku Utara', 'Sofifi'),
  ('Maluku Utara', 'Jailolo'),
  ('Papua Barat', 'Manokwari'),
  ('Papua Barat', 'Sorong'),
  ('Papua Barat', 'Fakfak'),
  ('Papua Barat', 'Kaimana'),
  ('Papua Barat', 'Teminabuan'),
  ('Maluku',	'Ambon'),
  ('Maluku', 'Tual'),
  ('Maluku', 'Masohi'),
  ('Maluku', 'Namlea'),
  ('Maluku', 'Saumlaki'),
  ('Yogyakarta',	'Yogyakarta'),
  ('Yogyakarta', 'Bantul'),
  ('Yogyakarta', 'Sleman'),
  ('Yogyakarta', 'Gunungkidul'),
  ('Yogyakarta', 'Kulon'),
  ('Yogyakarta', 'Progo'),
  ('Riau', 'Pekanbaru'),
  ('Riau', 'Dumai'),
  ('Riau', 'Bengkalis'),
  ('Riau', 'Siak'),
  ('Riau', 'Tembilahan'),
  ('Papua', 'Jayapura'),
  ('Papua', 'Timika'),
  ('Papua', 'Merauke'),
  ('Papua', 'Biak'),
  ('Papua', 'Nabire'),
  ('Nusa Tenggara Barat', 'Mataram'),
  ('Nusa Tenggara Barat', 'Bima'),
  ('Nusa Tenggara Barat', 'Praya'),
  ('Nusa Tenggara Barat', 'Selong'),
  ('Nusa Tenggara Barat', 'Gerung'),
  ('Nusa Tenggara Timur', 'Kupang'),
  ('Nusa Tenggara Timur', 'Ende'),
  ('Nusa Tenggara Timur', 'Maumere'),
  ('Nusa Tenggara Timur', 'Ruteng'),
  ('Nusa Tenggara Timur', 'Soe'),
  ('Sulawesi Barat', 'Mamuju'),
  ('Sulawesi Barat', 'Polewali Mandar'),
  ('Sulawesi Barat', 'Majene'),
  ('Sulawesi Barat', 'Mamasa'),
  ('Sulawesi Selatan', 'Makassar'),
  ('Sulawesi Selatan', 'Parepare'),
  ('Sulawesi Selatan', 'Kendari'),
  ('Sulawesi Selatan', 'Palopo'),
  ('Sulawesi Tengah', 'Palu'),
  ('Sulawesi Tengah', 'Poso'),
  ('Sulawesi Tengah', 'Donggala'),
  ('Sulawesi Tengah', 'Parigi Moutong'),
  ('Sulawesi Tenggara', 'Bau-Bau'),
  ('Sulawesi Tenggara', 'Raha'),
  ('Sulawesi Tenggara', 'Lasusua'),
  ('Sulawesi Utara', 'Manado'),
  ('Sulawesi Utara', 'Bitung'),
  ('Sulawesi Utara', 'Tomohon'),
  ('Sulawesi Utara', 'Kotamobagu'),
  ('Sulawesi Utara', 'Airmadidi'),
  ('Sumatera Barat', 'Padang'),
  ('Sumatera Barat', 'Bukittinggi'),
  ('Sumatera Barat', 'Payakumbuh'),
  ('Sumatera Barat', 'Pariaman'),
  ('Sumatera Barat', 'Solok'),
  ('Sumatera Selatan', 'Palembang'),
  ('Sumatera Selatan', 'Prabumulih'),
  ('Sumatera Selatan', 'Lubuklinggau'),
  ('Sumatera Selatan', 'Lahat'),
  ('Sumatera Selatan', 'Pagar Alam'),
  ('Sumatera Utara', 'Medan'),
  ('Sumatera Utara', 'Binjai'),
  ('Sumatera Utara', 'Pematangsiantar'),
  ('Sumatera Utara', 'Tebing Tinggi'),
  ('Sumatera Utara', 'Tanjung Balai')
;
