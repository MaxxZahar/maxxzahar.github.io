const field = document.querySelector('.field');
const moveOptions = ["left", "right", "forward", "backward", "not move"];
const passOptions = ["pass", "shot"];

for (let i = 0; i < 20; i++){
    field.insertAdjacentHTML('beforeend', 
    '<div class="position"><div class="left-position"></div><div class="right-position"></div><div class="ball"></div></div>');
}
for (let i = 0; i < 2; i++){
    field.insertAdjacentHTML('beforeend', 
    '<div class="goalie-position"></div>');
}
for (let i = 0; i < 2; i++){
    field.insertAdjacentHTML('beforeend', 
    '<div class="goal"></div>');
}

const goalies = field.querySelectorAll('.goalie-position');
goalies[0].style.gridColumnStart = 2;
goalies[0].style.gridColumnEnd = 3;
goalies[0].style.gridRowStart = 3;
goalies[0].style.gridRowEnd = 4;
goalies[1].style.gridColumnStart = 7;
goalies[1].style.gridColumnEnd = 8;
goalies[1].style.gridRowStart = 3;
goalies[1].style.gridRowEnd = 4;
const goals = field.querySelectorAll('.goal');
goals[0].style.gridColumnStart = 1;
goals[0].style.gridColumnEnd = 2;
goals[0].style.gridRowStart = 2;
goals[0].style.gridRowEnd = 5;
goals[1].style.gridColumnStart = 8;
goals[1].style.gridColumnEnd = 9;
goals[1].style.gridRowStart = 2;
goals[1].style.gridRowEnd = 5;

const fieldPositions = field.querySelectorAll('.position');
for (let i = 0; i < 4; i++){
    for (let j = 0; j < 5; j++){
        fieldPositions[i * 5 + j].style.gridColumnStart = i + 3;
        fieldPositions[i * 5 + j].style.gridColumnEnd = i + 4;
        fieldPositions[i * 5 + j].style.gridRowStart = j + 1;
        fieldPositions[i * 5 + j].style.gridRowEnd = j + 2;
        fieldPositions[i * 5 + j].dataset.position = i * 5 + j;
    }
}

const moveOptionsBlock = document.querySelector('.move-options');
for (let i = 0; i < moveOptions.length; i++){
    moveOptionsBlock.insertAdjacentHTML('beforeend', 
    '<div class="move-option"></div>');
}
const moveOptionsBlockItems = moveOptionsBlock.querySelectorAll('.move-option');
for (let i = 0; i < moveOptionsBlockItems.length; i++){
    moveOptionsBlockItems[i].textContent = moveOptions[i];
}

const passOptionsBlock = document.querySelector('.pass-options');
for (let i = 0; i < passOptions.length; i++){
    passOptionsBlock.insertAdjacentHTML('beforeend', 
    '<div class="pass-option"></div>');
}
const passOptionsBlockItems = passOptionsBlock.querySelectorAll('.pass-option');
for (let i = 0; i < passOptionsBlockItems.length; i++){
    passOptionsBlockItems[i].textContent = passOptions[i];
}

const playerCard = document.querySelector('.player-card');
const playerCardItems = playerCard.querySelectorAll('.player-card-item');
const playerStats = ["NMB", "PAC", "SAC", "CTR", "SPD", "REA"];