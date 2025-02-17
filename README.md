
# Api Komik scraping

Laravel Comic Scraping API adalah API yang dirancang untuk mengambil data dari berbagai website manga dan komik menggunakan teknik web scraping. API ini memungkinkan pengguna mengakses informasi terkait komik, seperti judul, pengarang, ilustrator, genre, tema, bab, dan sinopsis. Data ini dikumpulkan secara otomatis dari situs komik terkemuka dan dapat digunakan untuk membangun aplikasi frontend atau platform terkait komik.

API ini dibangun menggunakan framework **Laravel**, menyediakan antarmuka RESTful yang mudah digunakan dan dapat diintegrasikan dengan aplikasi lain.

## Fitur

- **Scraping Data Manga**: Mengambil informasi dasar tentang manga seperti judul, pengarang, ilustrator, sinopsis, dan informasi terkait lainnya.
- **Daftar Chapter Manga**: Mendapatkan daftar chapter dari setiap manga, lengkap dengan link ke setiap chapter.
- **Pencarian Manga**: Mendapatkan daftar manga terkait dari query parameter yang diberikan.
- **Tema & Genre**: Mengambil informasi tentang genre dan tema dari setiap manga.
- **Navigasi Chapter**: Menyediakan informasi tentang chapter sebelumnya dan chapter selanjutnya dari manga yang sedang dibaca.
- **Web Scraping**: Proses scraping dilakukan untuk mengambil data yang relevan dari situs manga dan komik tanpa memerlukan API eksternal.


## API Reference

#### Terbaru

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/terbaru
```
#### Popular

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/popular
```
#### berwarna

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/berwarna/{pages}
```

#### Daftar genre

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/genre
```
#### By genre

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/genre/{genre}/{pages}
```
#### Daftar tema

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/theme
```

#### By tema

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/theme/{theme}/{pages}
```
#### Daftar jenis

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/jenis
```
#### By jenis

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/jenis/{jenis}/{pages}
```
#### Detail manga

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/detai/{url}
```

#### Baca manga

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/baca/{url}
```

#### Search

```http
  GET https://laravel-api-manga-scraper.vercel.app/api/api/search/{param}
```






## Authors

- [@JuniorDeveloper17](https://www.github.com/yandev2)


## License

[MIT](https://choosealicense.com/licenses/mit/)

