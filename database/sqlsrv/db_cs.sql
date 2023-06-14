CREATE TABLE qna (
  id INT IDENTITY(1,1) PRIMARY KEY,
  pertanyaan varchar(255) not null,
  jawaban varchar(255) not null,
  id_predecessor int default 0,
  kategori varchar(255) default null, -- aplikasi / transaksi / biodata / norek
  created_at datetime DEFAULT current_timestamp(),
  updated_at datetime DEFAULT null
);

-- --------------------------------------------------------

CREATE TABLE komplain (
  id INT IDENTITY(1,1) PRIMARY KEY,
  id_nasabah INT NOT NULL,
  id_admin_cs INT NOT NULL,
  id_transaksi INT default NULL,
  id_qna INT default NULL,
  jenis_komplain INT NOT NULL, -- 0=Registrasi Login Identitas, 1=Terkait Produk, 3=Terkait Pembelian/Pembayaran
  nasabah_rating INT NULL, -- 1-5
  cs_rating INT NULL, -- 1-5
  keterangan INT NOT NULL,
  predecessor_komplain INT NOT NULL,
  record_voice VARCHAR(255) NULL,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME NULL,
  CONSTRAINT fk_komplain_qna FOREIGN KEY (id_qna) REFERENCES qna(id)
);

-- --------------------------------------------------------

CREATE TABLE messages (
  id INT IDENTITY(1,1) PRIMARY KEY,
  id_sender INT NOT NULL,
  id_receiver INT NOT NULL,
  id_komplain INT NOT NULL,
  message TEXT NOT NULL,
  id_kriptor INT NULL,
  created_at DATETIME DEFAULT GETDATE(),
  CONSTRAINT fk_msg_komplain FOREIGN KEY (id_komplain) REFERENCES komplain(id)
);

-- --------------------------------------------------------

CREATE TABLE log_cs (
  id INT IDENTITY(1,1) PRIMARY KEY,
  id_user INT NOT NULL,
  id_komplain INT NOT NULL,
  keterangan VARCHAR(255) NOT NULL,
  data_change VARCHAR(255) NOT NULL,
  notifikasi INT NULL DEFAULT 0,
  id_kriptor INT NULL,
  status INT NULL DEFAULT 0, -- 0=not send, 1=unread, 2=read
  created_at DATETIME DEFAULT GETDATE(),
  CONSTRAINT fk_logcs_komplain FOREIGN KEY (id_komplain) REFERENCES komplain(id)
);

-- --------------------------------------------------------

