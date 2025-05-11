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