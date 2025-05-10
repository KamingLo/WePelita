function OhayooUser() {
  const SapaanUser = document.getElementById("Sapaan");
  const jamIRL = new Date().getHours();

  let Sapaan = "Selamat";
  if (jamIRL >= 5 && jamIRL < 12) {
    greeting = "Selamat yoo";
  } else if (jamIRL >= 12 && jamIRL < 15) {
    Sapaan = "Selamat siang";
  } else if (jamIRL >= 15 && jamIRL < 18) {
    Sapaan = "Selamat sore";
  } else {
    Sapaan = "Selamat malam";
  }

  SapaanUser.textContent = Sapaan;
}

OhayooUser();

const body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  toggle = body.querySelector(".toggle"),
  searchBtn = body.querySelector(".search-box"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

searchBtn.addEventListener("click", () => {
  sidebar.classList.remove("close");
});
