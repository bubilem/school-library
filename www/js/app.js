console.log("Hello");

let books;

const filter = {
  search: null,
  dep: [],
  gnr: [],
  lng: [],
  dfc: [],
};

const xhttp = new XMLHttpRequest();

window.onload = () => {
  xhttp.open("GET", "books-json");
  xhttp.send();
};

xhttp.onload = function () {
  books = JSON.parse(this.responseText);
  document.getElementById("books").innerHTML = generateBooksHtml();
};

document.getElementById("menu-button").onclick = (e) => {
  e.currentTarget.classList.toggle("active");
  e.currentTarget.classList.remove("tip");
  document.getElementById("menu").classList.toggle("active");
  window.scrollTo(0, 0);
};

document.getElementById("filter-text").oninput = (event) => {
  let oldSearch = filter.search;
  if (event.target.value.length > 0) {
    filter.search = event.target.value.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  } else {
    filter.search = null;
  }
  if (oldSearch !== filter.search) {
    document.getElementById("books").innerHTML = generateBooksHtml();
  }
};

let buttons = document.getElementsByTagName("button");
for (let i = 0; i < buttons.length; i++) {
  if (buttons[i].dataset.attributeKey && buttons[i].dataset.valueKey) {
    buttons[i].onclick = (e) => {
      const button = buttons[i];
      const aKey = button.dataset.attributeKey; //e.target.dataset.attributeKey;
      const vKey = button.dataset.valueKey; //e.target.dataset.valueKey;
      let index;
      if (filter[aKey] !== undefined && (index = filter[aKey].indexOf(vKey)) > -1) {
        filter[aKey].splice(index, 1);
        button.classList.remove("active");
      } else {
        filter[aKey].push(vKey);
        button.classList.add("active");
      }
      document.getElementById("books").innerHTML = generateBooksHtml();
    };
  }
}

function fitBookFilter(book) {
  if (
    filter.search === null &&
    filter.dep.length === 0 &&
    filter.gnr.length === 0 &&
    filter.lng.length === 0 &&
    filter.dfc.length === 0
  ) {
    return true;
  }
  for (let fKey in filter) {
    let fitBookFilter = true;
    switch (fKey) {
      case "search":
        if (
          filter.search !== null &&
          book.name
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .toLowerCase()
            .search(filter.search.toLowerCase()) === -1 &&
          book.author
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .toLowerCase()
            .search(filter.search.toLowerCase()) === -1
        ) {
          return false;
        }
        break;
      default:
        if (filter[fKey].length !== 0) {
          let fit = false;
          let activeCount = 0;
          for (let item of filter[fKey]) {
            activeCount++;
            if (book.filter[fKey].search(item) !== -1) {
              fit = true;
              break;
            }
          }
          fitBookFilter = activeCount == 0 || fit;
        }
    }
    if (!fitBookFilter) {
      return false;
    }
  }
  return true;
}

function generateBooksHtml() {
  let bookCount = 0;
  let pcsCount = 0;
  let content = "";
  for (let book of books) {
    if (!fitBookFilter(book)) {
      continue;
    }
    bookCount++;
    pcsCount += book.id.length;
    content += `
      <div class="book">
      <p class="author">${book.author}</p>
      <h2>${
        book.name + (book.id.length > 1 ? ` <small>${book.id.length}&times;</small>` : "")
      }</h2>      
      <p class="genre">${[book.genre1, book.genre2].filter(Boolean).join(", ")}</p>
      <p class="info">${[
        book.isbn,
        book.publishing,
        book.year,
        book.language,
        book.difficulty && book.difficulty != "-" ? `L${book.difficulty}` : null,
        book.pageCount ? `${book.pageCount} stran` : null,
      ]
        .filter(Boolean)
        .join(", ")}</p>
        <p class="id">${[book.id.join(", ")].filter(Boolean).join(", ")}</p>
      </div>`;
  }
  document.getElementById("book-count").innerHTML = `${bookCount} <small>knih${
    bookCount == 1 ? "a" : bookCount > 1 && bookCount < 5 ? "y" : ""
  }</small> ${pcsCount} <small>kus${
    pcsCount == 1 ? "" : pcsCount > 1 && pcsCount < 5 ? "y" : "ů"
  }</small>`;
  return content;
}
