# Školní knihovna

Webová aplikace s katalogem knih. Knihy jsou evidovány v XLSX, které se jen přeukládají na CSV. Server-side PHP poté generuje JSON pro front-end JavaScript, který již veškerý chod aplikace obstará přímo v okně prohlížeče na straně klienta.

## URL aplikace

Běžící apka: [https://www.skolavdf.cz/knihovna/](https://www.skolavdf.cz/knihovna/)

URL pro generovaný JSON: [https://www.skolavdf.cz/knihovna/books-json](https://www.skolavdf.cz/knihovna/books-json)

## Použité technologie

JavaScript, PHP, HTML, CSS, SASS, CSV, JSON

## Tasklist

- [x] MVP(C) OOP jádro aplikace
- [ ] Testování, uf
- [x] PHP CSV->JSON presenter
- [x] Frontend katalog
- [x] Základní template (view) system
- [x] LIVE filtrování dle jazyků, žánrů a obtížnosti
- [x] LIVE filtrování dle zadaného výrazu dle názvu a autorů knih
- [x] Základní UX, design
- [ ] Přihlašování knihovníků
- [ ] Půjčování žákům
- [ ] Sledování výpůjček u knih (statistiky)
- [ ] Notifikace k vrácení knihy
- [ ] Dokumentace
- [ ] Optimalizace a restrukturalizace JS
- [ ] Optimalizace a restrukturalizace SASS
- [ ] Použití Vue.js (možnost)

## Getting Started

Simply download the project here in GitHub or you can make a clone of the entire repository, which you can then simply keep updated.

```
git clone https://github.com/bubilem/school-library <destination-local-directory>
```

### What is needed

- To run: **Apache** + **PHP** on server, **Browser** on client
- To edit: **MS VS Code** or another IDE, GIT, SASS

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
