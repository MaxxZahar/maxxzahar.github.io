const team1 = [goalkeepers[0], players[1], players[3], players[4], players[7], "AOKK Fedd"];
const startPositions1 = [1, 2, 3, 7];
const team2 = [goalkeepers[1], players[0], players[2], players[5], players[6], "Dequeller"];
const startPositions2 = [12, 13, 16, 17];
const totalTeamPlayers = 8;
const team1Players = team1.slice(1, -1);
const team2Players = team2.slice(1, -1);
const bothTeamsPlayers = team1Players.concat(team2Players);
const gameLength = 100;

goalies[0].textContent = team1[0].number;
goalies[0].classList.add('aokk-fedd','player');
goalies[1].textContent = team2[0].number;
goalies[1].classList.add('dequeller', 'player');

for (let i = 0; i < startPositions1.length; i++){
    const player = fieldPositions[startPositions1[i]].querySelector('.left-position');
    player.textContent = team1[i + 1].number;
    player.classList.add('aokk-fedd', 'player');
}

for (let i = 0; i < startPositions2.length; i++){
    const player = fieldPositions[startPositions2[i]].querySelector('.right-position');
    player.textContent = team2[i + 1].number;
    player.classList.add('dequeller', 'player');
}

const startBallPosition = Math.floor(Math.random() * 20);
fieldPositions[startBallPosition].querySelector('.ball').style.display = "block";

let team1Score = 0;
let team2Score = 0;

document.querySelectorAll('.team')[0].classList.add('aokk-fedd');
document.querySelectorAll('.team')[0].textContent = team1[team1.length - 1];
document.querySelectorAll('.score')[0].classList.add('aokk-fedd');
const score1 = document.querySelectorAll('.score')[0];
score1.textContent = team1Score;
document.querySelectorAll('.team')[1].classList.add('dequeller');
document.querySelectorAll('.team')[1].textContent = team2[team2.length - 1];
document.querySelectorAll('.score')[1].classList.add('dequeller');
const score2 = document.querySelectorAll('.score')[1];
score2.textContent = team2Score;

const playersSortedByReaction = bothTeamsPlayers.sort((a, b) => (a.reaction > b.reaction) ? 1 : -1);
const playersList = document.querySelector('.players-order-list');

for (let i = 0; i < totalTeamPlayers; i++){
    playersList.insertAdjacentHTML('beforeend', '<div class="players-order-list-item-container"><div class="order-counter"></div><div class="players-order-list-item"></div></div>');
}

// playersList.insertAdjacentHTML('beforeend', '<div class="order-counter"></div>');
const orderCounters = document.querySelectorAll('.order-counter');

const playersListItems = document.querySelectorAll('.players-order-list-item');

for (let i = 0; i < playersListItems.length; i++){
    playersListItems[i].textContent = playersSortedByReaction[i].number;
    for (let j = 0; j < team1Players.length; j++){
        if (playersListItems[i].textContent === team1Players[j].number){
            playersListItems[i].classList.add('aokk-fedd');
        }
    }
    if (!playersListItems[i].classList.contains('aokk-fedd')){
        playersListItems[i].classList.add('dequeller');
    }
    playersListItems[i].addEventListener('click', function(){
        playerCard.style.display = "block";
        const number = this.textContent;
        const player = bothTeamsPlayers.filter(item => item.number === number);
        for (let i = 0; i < playerCardItems.length; i++){
            playerCardItems[i].textContent = playerStats[i] + ": " + player[0][Object.keys(player[0])[i]];
        }
    });
}

playerCard.addEventListener('click', function(){
    this.style.display = "none";
});
