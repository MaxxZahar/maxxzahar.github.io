function moveLeftTeamPlayer(location, direction){
    location = Number(location);
    const field = document.querySelector('.field');
    const fieldPositions = field.querySelectorAll('.position');
    const currentPosition = fieldPositions[location].querySelector('.left-position');
    const number = currentPosition.textContent;
    const player = players.filter(item => item.number === number);
    let futurePosition;
    switch(direction){
        case "left":
           futurePosition = fieldPositions[location - 1].querySelector('.left-position');
           currentPosition.classList.remove('aokk-fedd', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('aokk-fedd', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
               fieldPositions[location - 1].querySelector('.ball').style.display = "block";
               fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
        case "right":
           futurePosition = fieldPositions[location + 1].querySelector('.left-position');
           currentPosition.classList.remove('aokk-fedd', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('aokk-fedd', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
            fieldPositions[location + 1].querySelector('.ball').style.display = "block";
            fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
        case "forward":
           futurePosition = fieldPositions[location + 5].querySelector('.left-position');
           currentPosition.classList.remove('aokk-fedd', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('aokk-fedd', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block"  && Math.floor(Math.random() * 100) <= player[0].control){
            fieldPositions[location + 5].querySelector('.ball').style.display = "block";
            fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
        case "backward":
           futurePosition = fieldPositions[location - 5].querySelector('.left-position');
           currentPosition.classList.remove('aokk-fedd', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('aokk-fedd', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
            fieldPositions[location - 5].querySelector('.ball').style.display = "block";
            fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
    }
}

function moveRightTeamPlayer(location, direction){
    location = Number(location);
    const field = document.querySelector('.field');
    const fieldPositions = field.querySelectorAll('.position');
    const currentPosition = fieldPositions[location].querySelector('.right-position');
    const number = currentPosition.textContent;
    const player = players.filter(item => item.number === number);
    let futurePosition;
    switch(direction){
        case "left":
           futurePosition = fieldPositions[location + 1].querySelector('.right-position');
           currentPosition.classList.remove('dequeller', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('dequeller', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
               fieldPositions[location + 1].querySelector('.ball').style.display = "block";
               fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
        case "right":
           futurePosition = fieldPositions[location - 1].querySelector('.right-position');
           currentPosition.classList.remove('dequeller', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('dequeller', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
            fieldPositions[location - 1].querySelector('.ball').style.display = "block";
            fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
        case "forward":
           futurePosition = fieldPositions[location - 5].querySelector('.right-position');
           currentPosition.classList.remove('dequeller', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('dequeller', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
            fieldPositions[location - 5].querySelector('.ball').style.display = "block";
            fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
        case "backward":
           futurePosition = fieldPositions[location + 5].querySelector('.right-position');
           currentPosition.classList.remove('dequeller', 'player');
           futurePosition.textContent = currentPosition.textContent;
           currentPosition.textContent = "";    
           futurePosition.classList.add('dequeller', 'player');
           if (fieldPositions[location].querySelector('.ball').style.display === "block" && Math.floor(Math.random() * 100) <= player[0].control){
            fieldPositions[location + 5].querySelector('.ball').style.display = "block";
            fieldPositions[location].querySelector('.ball').style.display = "none";
           }
        break;
    }
}

function pass(location, direction, number){
    location = Number(location);
    direction = Number(direction);
    const field = document.querySelector('.field');
    const fieldPositions = field.querySelectorAll('.position');
    const currentPosition = fieldPositions[location];
    const player = players.filter(item => item.number === number);
    if (Math.floor(Math.random() * 100) > Number(player[0].passAccuracy)){
        direction = Math.floor(Math.random() * 20);
    }
    const futurePosition = fieldPositions[direction];
    currentPosition.querySelector('.ball').style.display = 'none';
    futurePosition.querySelector('.ball').style.display = 'block';
}

function shot(location, number, team){
    location = Number(location);
    team = Number(team);
    let shotCoeffs;
    if (team === 0){
        shotCoeffs = leftTeamShotCoeffs;
    } else {
        shotCoeffs = rightTeamShotCoeffs;
    }
    const player = players.filter(item => item.number === number);
    const goalkeeper = goalkeepers[team]
    if (Math.floor(Math.random() * 100) > Number(player[0].shotAccuracy)){
        console.log("Missed!");
    } else{
        if (Math.random() > shotCoeffs[location]){
            console.log("Bad position!")
        } else {
            console.log("On target!");
            if (Math.floor(Math.random() * 100) > Number(goalkeeper.saves)){
                console.log("Goal!");
                if (team === 0){
                    team1Score++;
                    score1.textContent = team1Score;
                } else {
                    team2Score++;
                    score2.textContent = team2Score;
                }
            } else {
                console.log("Saved!");
            }
        }
    }
    const newBallPosition = Math.floor(Math.random() * 20);
    fieldPositions[location].querySelector('.ball').style.display = 'none';
    fieldPositions[newBallPosition].querySelector('.ball').style.display = 'block';
}

function blockOthers(number){
    for (let i = 0; i < bothTeamsPlayersPositions.length; i++){
        if (bothTeamsPlayersPositions[i].textContent !== number){
            bothTeamsPlayersPositions[i].style.pointerEvents = "none";
        }
    }
}

function unblockOthers(number){
    for (let i = 0; i < bothTeamsPlayersPositions.length; i++){
        if (bothTeamsPlayersPositions[i].textContent !== number){
            bothTeamsPlayersPositions[i].style.pointerEvents = "auto";
        }
    }
}

function toNextPlayer(state){
    const currentPlayerPosition = field.querySelector('.active');
    const bothTeamsPlayersPositions = field.querySelectorAll('.player');
    currentPlayerPosition.classList.remove('active');
    if (state < playersSortedByReaction.length){
        const nextPlayerNumber = playersSortedByReaction[state].number;
        for (let i = 0; i < bothTeamsPlayersPositions.length; i++){
            if (bothTeamsPlayersPositions[i].textContent === nextPlayerNumber){
                bothTeamsPlayersPositions[i].classList.add('active');
            }
        }
        const nextPlayerPosition = field.querySelector('.active');
        if (nextPlayerPosition.classList.contains('aokk-fedd')){
            nextPlayerPosition.addEventListener('click', forLeftEventListener);
        } else {
            nextPlayerPosition.addEventListener('click', forRightEventListener);
        }
        orderCounters[state - 1].style.display = "none";
        orderCounters[state].style.display = "block";
    } else {
        orderCounters[state - 1].style.display = "none";
        state = 0;
        next.style.cursor = "pointer";
        next.style.pointerEvents = "auto";
    }
    return state;
}

let minute = Number(document.querySelector('.time-counter').dataset.time);
const next = document.querySelector('.next-button');
const start = document.querySelector('.start-button');
let state = 0;
// const operationDone = new Promise((resolve, reject) => {
//     if (state === 1){
//         console.log("resolve");
//         resolve(0);
//     }
// });
// operationDone.then(function(value){
//     console.log("then");
//     state = value;
// })

// next.addEventListener('click', function(){
//     console.log("N");
//     minute++;
//     const leftTeamPlayersPositions = field.querySelectorAll('.aokk-fedd');
//     const rightTeamPlayersPositions = field.querySelectorAll('.dequeller');
//     for (let i = 0; i < leftTeamPlayersPositions.length; i++){
//         leftTeamPlayersPositions[i].addEventListener('click', forLeftEventListener);
//     }

//     for (let i = 0; i < rightTeamPlayersPositions.length; i++){
//         rightTeamPlayersPositions[i].addEventListener('click', forRightEventListener);
//     }
//     document.querySelector('.time-counter').textContent = minute + "\'";
//     for (let i = 0; i < playersSortedByReaction.length; i++){
//         const currentPlayerNumber = playersSortedByReaction[i].number;
//         for (let j = 0; j < bothTeamsPlayersPositions.length; j++){
//             if (bothTeamsPlayersPositions[j].textContent === currentPlayerNumber){
//                 bothTeamsPlayersPositions[j].classList.add('current');
//             }
//         }
//         const currentPlayerPosition = field.querySelector('.current');
//         currentPlayerPosition.classList.add('active');
//         currentPlayerPosition.classList.remove('current');
//         // blockOthers(currentPlayerNumber);
//         const toMakeAMove = async() => {
//             console.log("waiting");
//             await operationDone;
//             unblockOthers(currentPlayerNumber);
//             currentPlayerPosition.classList.remove('active');
//         }
//         toMakeAMove();
//     }
// });

// next.addEventListener('click', function(){
//     next.style.cursor = "none";
//     next.style.pointerEvents = "none";
//     for (let i = 0; i < playersSortedByReaction.length; i++){
//         const number = playersSortedByReaction[i].number;
//         const leftTeamPlayers = field.querySelectorAll('.aokk-fedd');
//         const rightTeamPlayers = field.querySelectorAll('.dequeller');
//         for (let j = 0; j < leftTeamPlayers.length; j++){
//             if (leftTeamPlayers[j].textContent === number){
//                 const currentPlayer = leftTeamPlayers[j];
//                 currentPlayer.addEventListener('click', forLeftEventListener);
//             }
//         }
//     }
// });

next.addEventListener('click', function(){
    console.log("N");
    minute++;
    next.style.cursor = "auto";
    next.style.pointerEvents = "none";
    const bothTeamsPlayersPositions = field.querySelectorAll('.player');
    const firstPlayerNumber = playersSortedByReaction[0].number;
    for (let i = 0; i < bothTeamsPlayersPositions.length; i++){
        if (bothTeamsPlayersPositions[i].textContent === firstPlayerNumber){
            bothTeamsPlayersPositions[i].classList.add('active');
        }
    }
    const firstPlayerPosition = field.querySelector('.active');
    document.querySelector('.time-counter').textContent = minute + "\'";
    if (firstPlayerPosition.classList.contains('aokk-fedd')){
        firstPlayerPosition.addEventListener('click', forLeftEventListener);
    } else {
        firstPlayerPosition.addEventListener('click', forRightEventListener);
    }
    orderCounters[0].style.display = "block";
});

function forLeftEventListener(){
    console.log("ML2");
    moveOptionsBlock.style.display = "block";
    passOptionsBlock.style.display = "block";
    const location = this.parentNode.dataset.position;
    // const number = this.textContent;
    // const player = players.filter(item => item.number === number);
    for (let i = 0; i < moveOptionsBlockItems.length; i++){
        moveOptionsBlockItems[i].dataset.location = location;
        moveOptionsBlockItems[i].addEventListener('click', moveOptionsLeftListener);
    }
    for (let i = 0; i < passOptionsBlockItems.length; i++){
        passOptionsBlockItems[i].dataset.number = this.textContent;
        passOptionsBlockItems[i].dataset.location = location;
        passOptionsBlockItems[i].dataset.team = 0;
        // if (this.classList.contains('aokk-fedd')){
        //     passOptionsBlockItems[i].dataset.team = 1;
        // } else if (this.classList.contains('dequeller')){
        //     passOptionsBlockItems[i].dataset.team = 2;
        // }
    }
    passOptionsBlockItems[0].addEventListener('click', passOptionsListener);
    passOptionsBlockItems[1].addEventListener('click', shotListener);
    this.removeEventListener('click', forLeftEventListener);
    // state = 1;
    // console.log(state);
}

function moveOptionsLeftListener(){
    console.log("ML1");
    const option = this.textContent;
    const location = this.dataset.location;
    moveLeftTeamPlayer(location, option);
    const options = this.parentNode.querySelectorAll('.move-option');
    for (let i = 0; i < options.length; i++){
        options[i].removeEventListener('click', moveOptionsLeftListener);
    }
    moveOptionsBlock.style.display = "none";
    passOptionsBlock.style.display = "none";
    state++;
    state = toNextPlayer(state);
    // playerCard.style.display = "none";
}

function forRightEventListener(){
    console.log("MR2");
    moveOptionsBlock.style.display = "block";
    passOptionsBlock.style.display = "block";
    const location = this.parentNode.dataset.position;
    for (let i = 0; i < moveOptionsBlockItems.length; i++){
        moveOptionsBlockItems[i].dataset.location = location;
        moveOptionsBlockItems[i].addEventListener('click', moveOptionsRightListener);
    }
    for (let i = 0; i < passOptionsBlockItems.length; i++){
        passOptionsBlockItems[i].dataset.number = this.textContent;
        passOptionsBlockItems[i].dataset.location = location;
        passOptionsBlockItems[i].dataset.team = 1;
    }
    passOptionsBlockItems[0].addEventListener('click', passOptionsListener);
    passOptionsBlockItems[1].addEventListener('click', shotListener);
    this.removeEventListener('click', forRightEventListener);
}

function moveOptionsRightListener(){
    console.log("MR1");
    const option = this.textContent;
    const location = this.dataset.location;
    moveRightTeamPlayer(location, option);
    const options = this.parentNode.querySelectorAll('.move-option');
    for (let i = 0; i < options.length; i++){
        options[i].removeEventListener('click', moveOptionsRightListener);
    }
    moveOptionsBlock.style.display = "none";
    passOptionsBlock.style.display = "none";
    state++;
    state = toNextPlayer(state);
}

function passOptionsListener(){
    console.log("P1");
    const location = Number(this.dataset.location);
    for (let i = 0; i < fieldPositions.length; i++){
        if (i !== location){
            fieldPositions[i].querySelector('.left-position').addEventListener('mouseover', passHover);
            fieldPositions[i].querySelector('.right-position').addEventListener('mouseover', passHover);
            fieldPositions[i].querySelector('.left-position').addEventListener('mousedown', passProtection);
            fieldPositions[i].querySelector('.right-position').addEventListener('mousedown', passProtection);
            fieldPositions[i].querySelector('.left-position').addEventListener('click', passListener);
            fieldPositions[i].querySelector('.right-position').addEventListener('click', passListener);
        }
    }
    const options = document.querySelectorAll('.move-option');
    for (let i = 0; i < options.length; i++){
        options[i].removeEventListener('click', moveOptionsRightListener);
        options[i].removeEventListener('click', moveOptionsLeftListener);
    }
    this.removeEventListener('click', passOptionsListener);
    moveOptionsBlock.style.display = "none";
    passOptionsBlock.style.display = "none";
    // playerCard.style.display = "none";
}

function passHover(){
    console.log("PH");
    this.classList.add('pass-hover');
}

function passProtection(){
    console.log("PP");
    this.removeEventListener('click', forLeftEventListener);
    this.removeEventListener('click', forRightEventListener);
}

function passListener(){
    console.log("P2");
    const location = passOptionsBlockItems[0].dataset.location;
    const number = passOptionsBlockItems[0].dataset.number;
    const direction = this.parentNode.dataset.position;
    pass(location, direction, number);
    for (let i = 0; i < fieldPositions.length; i++){
        if (i !== location){
            fieldPositions[i].querySelector('.left-position').removeEventListener('mouseover', passHover);
            fieldPositions[i].querySelector('.right-position').removeEventListener('mouseover', passHover);
            fieldPositions[i].querySelector('.left-position').removeEventListener('mousedown', passProtection);
            fieldPositions[i].querySelector('.right-position').removeEventListener('mousedown', passProtection);
            fieldPositions[i].querySelector('.left-position').removeEventListener('click', passListener);
            fieldPositions[i].querySelector('.right-position').removeEventListener('click', passListener);
            fieldPositions[i].querySelector('.left-position').classList.remove('pass-hover');
            fieldPositions[i].querySelector('.right-position').classList.remove('pass-hover');
        }
    }
    state++;
    state = toNextPlayer(state);
}

function shotListener(){
    console.log("S");
    const location = passOptionsBlockItems[1].dataset.location;
    const number = passOptionsBlockItems[1].dataset.number;
    const team = passOptionsBlockItems[1].dataset.team;
    shot(location, number, team);
    const options = document.querySelectorAll('.move-option');
    // const pass = document.querySelector('.pass-option:first-child');
    for (let i = 0; i < options.length; i++){
        options[i].removeEventListener('click', moveOptionsRightListener);
        options[i].removeEventListener('click', moveOptionsLeftListener);
    }
    this.removeEventListener('click', shotListener);
    // pass.removeEventListener('click', passOptionsListener);
    moveOptionsBlock.style.display = "none";
    passOptionsBlock.style.display = "none";
    // playerCard.style.display = "none";
    state++;
    state = toNextPlayer(state);
}
