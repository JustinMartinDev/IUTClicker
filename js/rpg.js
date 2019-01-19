var arrayProf;
var idInterval;
var map = new Map("premiere");

function loadCanvas() {
    arrayProf = [];

    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');

    canvas.width  = map.getLargeur() * 32;
    canvas.height = map.getHauteur() * 32;

    idInterval = setInterval(function() {
        randomMoveProf	();
        map.dessinerMap(ctx);
    }, 40);

    //joueur.deplacer(DIRECTION.HAUT, map);
}

window.onload = loadCanvas();

function randomMoveProf() {
	arrayProf.forEach(function (prof) {
        var result = Math.floor((Math.random() * 4) + 1);
        var direction;
        switch (result) {
            case 1:
                direction = DIRECTION.BAS;
                break;
            case 2:
                direction = DIRECTION.HAUT;
                break;
            case 3:
                direction = DIRECTION.DROITE;
                break;
            case 4:
                direction = DIRECTION.GAUCHE;
                break;
            default:
                direction = DIRECTION.DROITE;
        }
        prof.deplacer(direction, map);
	});
}

function addSpriteGenerator(url){
	var newPlayer = new Personnage(url+".png", 7, 14, DIRECTION.BAS);
    map.addPersonnage(newPlayer);

    arrayProf.push(newPlayer);
}