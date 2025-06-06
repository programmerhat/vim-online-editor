const THEMES = ['fedora', 'macos', 'ubuntu'];
let themeIndex = 0;

function applyTheme(name) {
  document.body.classList.remove('theme-fedora', 'theme-macos', 'theme-ubuntu');
  document.body.classList.add('theme-' + name);
}

export function setTheme(name) {
  const idx = THEMES.indexOf(name);
  if (idx !== -1) {
    themeIndex = idx;
  }
  applyTheme(THEMES[themeIndex]);
}

export function nextTheme() {
  themeIndex = (themeIndex + 1) % THEMES.length;
  applyTheme(THEMES[themeIndex]);
}

window.setTheme = setTheme;
window.nextTheme = nextTheme;

// keyboard shortcut: Ctrl+Shift+T to cycle theme
window.addEventListener('keydown', (e) => {
  if (e.ctrlKey && e.shiftKey && e.key.toLowerCase() === 't') {
    nextTheme();
    e.preventDefault();
  }
});
