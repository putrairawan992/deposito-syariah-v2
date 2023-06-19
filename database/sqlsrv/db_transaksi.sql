CREATE TABLE tenor (
  id int PRIMARY KEY IDENTITY(1,1),
  nama varchar(255) NOT NULL,
  durasi varchar(255) NULL,
  created_at datetime DEFAULT GETDATE(),
  updated_at datetime DEFAULT NULL
);

-- CREATE TABLE pinalti (
--   id int PRIMARY KEY IDENTITY(1,1),
--   pinalti_value int NOT NULL,
--   deskripsi varchar(255) NULL,
--   created_at datetime DEFAULT GETDATE(),
--   updated_at datetime DEFAULT NULL
-- );

CREATE TABLE transaksi (
  id int PRIMARY KEY IDENTITY(1,1),
  id_coa INT NOT NULL,
  id_nasabah INT NOT NULL,
  id_mitra INT NOT NULL,
  id_produk INT NOT NULL,
  amount INT DEFAULT 0,
  bukti_transfer nvarchar(255) NULL,
  durasi INT NULL,
  auto_perpanjang INT NULL,
  pinalti int default NULL,
  tgl_approve datetime NULL,
  jenis int default 0, -- 0=bagihasil, 1=pengembalian, 2=penarikan, 3=pembelian
  status int default 0, -- 1=pengajuan, 2=disetujui, 3=transfer, 4=done
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  created_at datetime DEFAULT GETDATE()
);

-- Generate Rekap Perbulan Berdasarkan COA
CREATE TABLE rekap (
  id int PRIMARY KEY IDENTITY(1,1),
  tahun INT NOT NULL,
  bulan INT NOT NULL,
  id_coa INT NOT NULL,
  jenis int default 0, -- 0=bagihasil, 1=pengembalian, 2=penarikan, 3=pembelian
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  created_at datetime DEFAULT GETDATE()
);

CREATE TABLE log_transaksi (
  id INT PRIMARY KEY IDENTITY(1,1),
  id_user int not null,
  keterangan varchar(255) not null,
  notifikasi int default 0, --0=not send, 1=unread, 2=read
  kriptorone varchar(255) default NULL,
  kriptortwo varchar(255) default NULL,
  created_at datetime DEFAULT GETDATE()
);
