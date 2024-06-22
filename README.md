# PHP Tabanlı Duyuru ve Kullanıcı Yönetim Sistemi

## Proje Açıklaması

Bu proje, PHP kullanarak geliştirilmiş bir duyuru ve kullanıcı yönetim sistemi içerir. Kullanıcılar sisteme giriş yapabilir, duyuruları görüntüleyebilir ve çoklu oturum yönetimi özelliklerini kullanabilirler. Admin paneli sayesinde duyuru ekleme, kullanıcı yönetimi gibi işlemler yapılabilir.

## Özellikler

- Kullanıcı Girişi ve Kayıt
- Çoklu Oturum Yönetimi
- Duyuruların Görüntülenmesi
- Admin Paneli ile Duyuru ve Kullanıcı Yönetimi
- İlişkisel Veritabanı Kullanımı
- "Bize Ulaşın" Sayfası

## Kurulum

### Gereksinimler

- PHP 7.0 veya üzeri
- MySQL Veritabanı
- Web Sunucusu (Apache, Nginx, vb.)

### Adımlar

1. **Veritabanı Kurulumu:**
   - MySQL veritabanında `project_db` adında bir veritabanı oluşturun.
   - Veritabanı tablolarını oluşturmak için `db.sql` dosyasını çalıştırın.

2. **Proje Dosyalarını İndirin:**
   - Proje dosyalarını web sunucunuzun `www` veya `htdocs` dizinine yükleyin.

3. **Veritabanı Bağlantısı:**
   - `db.php` dosyasını açın ve veritabanı bağlantı ayarlarını kendi veritabanı bilgilerinize göre güncelleyin.

## Dosya Yapısı

- `index.php`: Ana sayfa.
- `giris.php`: Kullanıcı giriş sayfası.
- `kayit.php`: Kullanıcı kayıt sayfası.
- `adminpanel.php`: Admin paneli.
- `duyuru.php`: Duyuru ekleme sayfası.
- `profile.php`: Kullanıcı profili sayfası.
- `bize.php`: Bize ulaşın sayfası.
- `navbar.php`: Navigasyon barı.
- `db.php`: Veritabanı bağlantı dosyası.
- `duyurular.txt`: Duyuruların saklandığı dosya.

## Kullanım

### Kullanıcı Girişi ve Kayıt
- Kullanıcılar `giris.php` sayfasından giriş yapabilir veya `kayit.php` sayfasından kayıt olabilirler.

### Duyurular
- Ana sayfada (`index.php`) duyurular listelenir. Duyurular `duyurular.txt` dosyasından okunur.

### Admin Paneli
- Admin kullanıcılar `adminpanel.php` sayfasından duyuru ekleyebilir ve kullanıcıları yönetebilirler.

### Çoklu Oturum Yönetimi
- Kullanıcılar birden fazla oturum açabilir ve `switch_user.php` dosyası ile oturumlar arasında geçiş yapabilirler.

### İletişim
- Kullanıcılar `bize.php` sayfasından iletişim formunu doldurarak mesaj gönderebilirler.

## Lisans

Bu proje MIT Lisansı ile lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına bakabilirsiniz.

---

