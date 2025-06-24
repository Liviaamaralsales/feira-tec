const textSizeSlider = document.getElementById('textSize');
const textSizeValue = document.getElementById('textSizeValue');
const colorBlindSelect = document.getElementById('colorBlind');
const librasToggle = document.getElementById('librasToggle');

function aplicarLibras(ativo) {
  if (ativo) {
    console.log('Libras ativado');
  } else {
    console.log('Libras desativado');
  }
}

function aplicarConfiguracoes() {
  const savedTextSize = localStorage.getItem('textSize') || '18';
  const savedColorBlind = localStorage.getItem('colorBlind') || 'nenhum';
  const savedLibras = localStorage.getItem('libras') === 'true';

  textSizeSlider.value = savedTextSize;
  textSizeValue.textContent = savedTextSize;
  document.documentElement.style.fontSize = `${value}px`;

  colorBlindSelect.value = savedColorBlind;
  applyColorBlindFilter(savedColorBlind);

  librasToggle.checked = savedLibras;
  aplicarLibras(savedLibras);
}

// Salva e aplica tamanho do texto
textSizeSlider.addEventListener('input', () => {
  const value = textSizeSlider.value;
  textSizeValue.textContent = value;
  document.getElementById('paginaConfiguracoes').style.fontSize = `${value}px`;
  document.body.style.fontSize = `${value}px`;
  localStorage.setItem('textSize', value);
});

// Salva e aplica filtro de cor
colorBlindSelect.addEventListener('change', () => {
  const value = colorBlindSelect.value;
  applyColorBlindFilter(value);
  localStorage.setItem('colorBlind', value);
});

// Salva e aplica Libras
librasToggle.addEventListener('change', () => {
  const ativo = librasToggle.checked;
  aplicarLibras(ativo);
  localStorage.setItem('libras', ativo);
});

function applyColorBlindFilter(type) {
  const elementoPrincipal = document.body;
  const listaCursos = document.querySelectorAll('#paginaCursos li');

  let bgColor = '#000000'; // default
  let fgColor = '#FFFFFF'; // default

  switch (type) {
    case 'protanopia':
      elementoPrincipal.style.filter = 'grayscale(100%) contrast(1.2)';
      bgColor = '#2E2E2E';
      break;
    case 'deuteranopia':
      elementoPrincipal.style.filter = 'sepia(100%) saturate(3)';
      bgColor = '#3A3A3A';
      break;
    case 'tritanopia':
      elementoPrincipal.style.filter = 'hue-rotate(90deg)';
      bgColor = '#333333';
      break;
    default:
      elementoPrincipal.style.filter = 'none';
      bgColor = '#000000';
  }

  listaCursos.forEach(li => {
    li.style.backgroundColor = bgColor;
    li.style.color = fgColor;
  });
}

window.onload = aplicarConfiguracoes;