
# Api Komik scraping

Laravel Comic Scraping API is an API designed to retrieve data from various manga and comic websites using web scraping techniques. This API allows users to access information related to comics, such as title, author, illustrator, genre, theme, chapters and synopsis. This data is collected automatically from leading comic sites and can be used to build frontend applications or comic related platforms.

This API was built using the **Laravel** framework, providing a RESTful interface that is easy to use and can be integrated with other applications.

## Fitur

- **Manga Data Scraping**: Retrieves basic information about manga such as title, author, illustrator, synopsis and other related information.
- **Manga Chapter List**: Get a list of chapters for each manga, complete with links to each chapter.
- **Manga Search**: Gets a list of related manga from the given parameter query.
- **Theme & Genre**: Retrieves information about the genre and theme of each manga.
- **Chapter Navigation**: Provides information about the previous and next chapters of the manga you are reading.
- **Web Scraping**: The scraping process is carried out to retrieve relevant data from manga and comic sites without requiring an external API.


## API Reference

#### Terbaru

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/terbaru
```
#### Popular

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/popular
```
#### berwarna

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/berwarna/{pages}
```

#### Daftar genre

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/genre
```
#### By genre

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/genre/{genre}/{pages}
```
#### Daftar tema

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/theme
```

#### By tema

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/theme/{theme}/{pages}
```
#### Daftar jenis

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/jenis
```
#### By jenis

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/jenis/{jenis}/{pages}
```
#### Detail manga

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/detai/{url}
```

#### Baca manga

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/baca/{url}
```

#### Search

```http
  GET https://manga-api-mu-eight.vercel.app/api/api/search/{param}
```






## Authors

- [@JuniorDeveloper17](https://www.github.com/yandev2)


## License

[MIT](https://choosealicense.com/licenses/mit/)

