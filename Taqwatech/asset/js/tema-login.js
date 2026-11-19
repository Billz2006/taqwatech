// tema-login.js - tombol ganti warna latar di halaman Login & Register

const themes = [
  { background: "#2C5EAD", color: "#FFFFFF", primaryColor: "#1591DC" },
  { background: "#1591DC", color: "#FFFFFF", primaryColor: "#2C5EAD" },
  { background: "#4BB8FA", color: "#0f2a4d", primaryColor: "#2C5EAD" },
  { background: "#C4E2F5", color: "#0f2a4d", primaryColor: "#1591DC" },
  { background: "#0f2a4d", color: "#FFFFFF", primaryColor: "#4BB8FA" }
];

const setTheme = (theme) => {
  const root = document.querySelector(":root");
  root.style.setProperty("--background", theme.background);
  root.style.setProperty("--color", theme.color);
  root.style.setProperty("--primary-color", theme.primaryColor);
  root.style.setProperty("--glass-color", theme.glassColor);
};

const displayThemeButtons = () => {
  const btnContainer = document.querySelector(".theme-btn-container");
  themes.forEach((theme) => {
    const div = document.createElement("div");
    div.className = "theme-btn";
    div.style.cssText = `background: ${theme.background}; width: 25px; height: 25px`;
    btnContainer.appendChild(div);
    div.addEventListener("click", () => setTheme(theme));
  });
};

displayThemeButtons();