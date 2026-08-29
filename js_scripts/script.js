// Toggle side navigation

var navLinks = document.getElementById("side-nav-links");

function showMenu() {
  navLinks.style.left = "0"; // Slide-in the menu
}

function hideMenu() {
  navLinks.style.left = "-250px"; // Slide-out the menu
}

// Set active class on the current link
window.onload = function() {
  var navLinks = document.querySelectorAll('.links ul li a'); // Get all links
  var currentUrl = window.location.pathname; // Get only the path of the current URL
  
  navLinks.forEach(function(link) {
    var linkPath = new URL(link.href).pathname; // Get only the path of the link's href

    // Skip adding 'active' class to the Logout link
    if (link.href.includes("logout")) {
      return; // Skip this iteration
    }

    if (currentUrl === linkPath) {
      link.classList.add('active');
    }
  });
};


// getting all required elements
const searchWrapper = document.querySelector(".material-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const dropdown = searchWrapper.querySelector(".dropdown");
let linkTag = searchWrapper.querySelector("a");
let webLink;

// if user press any key and release
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if(userData){
        dropdown.onclick = ()=>{
            webLink = `https://www.google.com/search?q=${userData}`;
            linkTag.setAttribute("href", webLink);
            linkTag.click();
        }
        emptyArray = materials.filter((data)=>{
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data)=>{
            // passing return data inside li tag
            return data = `<li>${data}</li>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }
    }else{
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}

function select(element){
    let selectData = element.textContent;
    inputBox.value = selectData;
    dropdown.onclick = ()=>{
        webLink = `https://www.google.com/search?q=${selectData}`;
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }
    searchWrapper.classList.remove("active");
}

function showSuggestions(list){
    let listData;
    if(!list.length){
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    }else{
      listData = list.join('');
    }
    suggBox.innerHTML = listData;
}
