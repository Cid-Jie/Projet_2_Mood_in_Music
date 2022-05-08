//buttons = tableau à 2 dimensions, 1 dimension de genre et 1 dimension d'interface (2 boutons par genre)

let buttons = [
document.querySelectorAll("#pop"),
document.querySelectorAll("#cinematic"),
document.querySelectorAll("#electro"),
document.querySelectorAll("#world"),
document.querySelectorAll("#chillout"),
document.querySelectorAll("#ambient"),
document.querySelectorAll("#all")
]

let cards = [
document.querySelectorAll("#music-card-pop"),
document.querySelectorAll("#music-card-cinematic"),
document.querySelectorAll("#music-card-electro"),
document.querySelectorAll("#music-card-world"),
document.querySelectorAll("#music-card-chillout"),
document.querySelectorAll("#music-card-ambient")
]

const desktop = 0;
const mobile = 1;
const interfaces = [desktop,mobile];

interfaces.forEach(interface => {
    for (let btnIndex = 0; btnIndex < buttons.length; btnIndex++) {
        const button = buttons[btnIndex][interface];
        button.addEventListener('click', () => {
            if( button.id != 'all' && interface == desktop) {
                buttons[6][desktop].classList.remove('d-none');
            } else {
                buttons[6][desktop].classList.add('d-none');
            }
            for (let genreIndex = 0; genreIndex < cards.length; genreIndex++) {
                for (let musicIndex = 0; musicIndex < cards[genreIndex].length; musicIndex++) {
                    const card = cards[genreIndex][musicIndex];
                    console.log(card);
                    card.classList.remove('d-none');
                    if (btnIndex != 6 && card.id != cards[btnIndex][0].id) {
                        card.classList.add('d-none');
                    }
                }
            }
        })
    }
});
