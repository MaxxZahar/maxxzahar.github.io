const players = [
    {number: "2",
     passAccuracy: "73",
     shotAccuracy: "42",
     control: "80",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "3",
     passAccuracy: "78",
     shotAccuracy: "50",
     control: "75",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "4",
     passAccuracy: "67",
     shotAccuracy: "59",
     control: "70",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "5",
     passAccuracy: "38",
     shotAccuracy: "90",
     control: "83",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "6",
     passAccuracy: "75",
     shotAccuracy: "45",
     control: "71",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "7",
     passAccuracy: "75",
     shotAccuracy: "56",
     control: "88",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "8",
     passAccuracy: "82",
     shotAccuracy: "80",
     control: "57",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)},
    {number: "9",
     passAccuracy: "74",
     shotAccuracy: "49",
     control: "72",
     speed: "1",
     reaction: Math.floor(Math.random() * 100)}
];

const goalkeepers = [
    {number: "1",
     saves: "73"
     },
    {number: "12",
     saves: "77"
     }
];

const leftTeamShotCoeffs = [0.4, 0.5, 0.5, 0.5, 0.4, 0.5, 0.6, 0.6, 0.6, 0.5, 0.6, 0.8, 0.8, 0.8, 0.6, 0.7, 0.9, 1, 0.9, 0.7];
const rightTeamShotCoeffs = [0.7, 0.9, 1, 0.9, 0.7, 0.6, 0.8, 0.8, 0.8, 0.6, 0.5, 0.6, 0.6, 0.6, 0.5, 0.4, 0.5, 0.5, 0.5, 0.4];