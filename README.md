# Revision
- [x] tambah insert image di page pendaftaran siswa
- [x] tampilkan gambar di data pendaftaran
- [x] ranking tambah filter persen
  - trigger drop tb_hasil where kode_periode = yg sedang dihitung
  - insert semua data ke tb_hasil
  - update rank user
- [ ] menu baru laporan grafik antar tahun periode

# changelog
- tambah field baru untuk menampung
- 
```sql
ALTER TABLE `tb_rel_siswa` ADD `file` VARCHAR(255) NOT NULL AFTER `rank`;
```


