
CREATE TABLE enkripsi (
  id int IDENTITY(1,1) PRIMARY KEY,
  kode int not null,
  created_at datetime DEFAULT current_timestamp
);
