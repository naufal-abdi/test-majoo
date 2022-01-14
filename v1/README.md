<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

</p>

## 📒 Technical Docs
1. Entity Realtionship Diagram (ERD)
2. Data Manipulation Language (DML)
3. Activity Diagarams
4. Use Case Diagram

### 🔗 Entity Relationship Diagram (ERD)

### ⚙️ Data Manipulation Language (DML)

1. Produk
   + Menampilkan semua data (SELECT)
        ```sql
        SELECT * FROM product WHERE id >= 1 LIMIT 20; 
        ```
   + Menampilkan data berdasarkan Id (SELECT WHERE) (**Masih akan diupdate**)
        ```sql
        SELECT * FROM product WHERE id = 1; 
        ```
   + Menambahkan / menyimpan data baru
        - Single
        ```sql
        INSERT INTO product (name, description, thumbnail, price, added_by) 
        VALUES 
        ('printer', 'Ini deskripsi printer', 'img/product/printer.jpg', 1250000, 1);
        ```

        - Multiple
        ```sql
        INSERT INTO product (name, description, thumbnail, price, added_by) 
        VALUES 
        ('Printer 1', 'Ini deskripsi printer 1', 'img/product/printer1.jpg', 1250000, 1),
        ('Printer 2', 'Ini deskripsi printer 2', 'img/product/printer2.jpg', 1300000, 1);
        ```
   + Mengupdate /mengubah data
        ```sql
        UPDATE product SET 
        name = 'Printer 1 Update', description = 'Ini deskripsi update printer 1', 
        thumbnail = 'img/product/printer1.png', price = 1700000;
        ```
   + Menghapus data
        ```sql
        DELETE FROM product WHERE id = 1; 
        ```
2. Kategori
   + Menampilkan semua data (SELECT)
        ```sql
        SELECT * FROM product_category WHERE id >= 1 LIMIT 20; 
        ```
   + Menampilkan data berdasarkan Id (SELECT WHERE)
        ```sql
        SELECT * FROM product_category WHERE id = 1; 
        ```
   + Menambahkan / menyimpan data baru
        ```sql
        INSERT INTO product_category (name, description, added_by)
        VALUES ('kategori 1', 'deskripsi kategori 1', 1);
        ```
   + Mengupdate /mengubah data
        ```sql
        UPDATE product_category SET 
        name = 'Printer 1 Update', description = 'Ini deskripsi update printer 1';
        ```
   + Menghapus data
        ```sql
        DELETE FROM product_category WHERE id = 1; 
        ```