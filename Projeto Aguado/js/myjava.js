const searchWrapper = document.querySelector('.search');
const inputBox = searchWrapper.querySelector('input');
const suggestionsBox = searchWrapper.querySelector('.list');
let linkTag = searchWrapper.querySelector('a');
let weblink;

const suggestions = sugestoes;

inputBox.onkeyup = (e) => {
    let userData = e.target.value;
    let emptyArray = [];
  
    if (e.key === 'Enter') {
      if (userData) {
        switch (userData.toLowerCase()) {
          case 'viagens nacionais':
            window.location.href = 'viagnacionais.html';
            break;
          case 'viagens internacionais':
            window.location.href = 'viagensinter.html';
            break;
          case 'hoteis estrangeiros':
            window.location.href = 'hoteis.html';
            break;
          case 'hoteis nacionais':
            window.location.href = 'hoteis.html';
            break;
          case 'roteiros nacionais':
            window.location.href = 'roteiros.html';
            break;
          case 'africa':
            window.location.href = 'africa.html';
            break;
          case 'asia':
            window.location.href = 'asia.html';
            break;
          case 'europa':
            window.location.href = 'europa.html';
            break;
          case 'america':
            window.location.href = 'america.html';
            break;
          default:
            window.location.href = 'default.html';
            break;
        }
      }
    }
  
   
  };