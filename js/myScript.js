var playerStats = { "unit":50,
                    "generator":{
                        "laborie": 0,
                        "ernet" : 0,
                        "laforcade" : 0,
                        "couland" : 0
                    },
                    "generatorception":{
                        "walko" : 0,
                        "momo" : 0,
                        "mamie" : 0
                    }
                  };
var baseCost = {
    "generator":{
        "laborie": 2,
        "ernet" : 5,
        "laforcade" : 15,
        "couland" : 25
    },
    "generatorception":{
        "walko" : 250,
        "momo" : 500,
        "mamie" : 1000
    }
};
var currentCost = {
                    "generator":{
                        "laborie": 2,
                        "ernet" : 5,
                        "laforcade" : 15,
                        "couland" : 25
                    },
                    "generatorception":{
                        "walko" : 250,
                        "momo" : 500,
                        "mamie" : 1000
                    }
                   };

var valueGenerator = {
    "valueAdd" : {
        "laborie": 1,
        "ernet": 3,
        "laforcade": 4,
        "couland": 6,
        "walko": 1, //1 couland Per s
        "momo": 3, //3 couland Per s
        "mamie": 5 //5 couland Per s
    },
    "srcImage" : {
        "laborie": "images/laborieFace.png",
        "ernet" : "images/ernetFace.png",
        "laforcade" : "images/laforcadeFace.png",
        "couland" : "images/coulandFace.png",
        "walko" : "images/walkoFace.png", //1 couland Per s
        "momo" : "images/momoFace.png", //3 couland Per s
        "mamie" : "images/mamieFace.png" //5 couland Per s
    }
};
var profGenerator  = [{
    "generator" : [{
        0: "laborie",
        1: "ernet",
        2: "laforcade",
        3: "couland"
    }],
    "generatorception" : [{
        0: "walko",
        1: "momo",
        2: "mamie"
    }]
}];

toastr.options = {
    "closeButton": true, // true/false
    "debug": false, // true/false
    "newestOnTop": false, // true/false
    "progressBar": false, // true/false
    "positionClass": "toast-top-right", // toast-top-right / toast-top-left / toast-bottom-right / toast-bottom-left
    "preventDuplicates": false, //true/false
    "onclick": null,
    "showDuration": "300", // in milliseconds
    "hideDuration": "1000", // in milliseconds
    "timeOut": "5000", // in milliseconds
    "extendedTimeOut": "1000", // in milliseconds
    "showEasing": "swing",
    "hideEasing": "swing",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}



/*========== GAME DATA FUNCTION =========*/
function getObjectLenght(ob){
    return Object.keys(ob).length;
}


/*========== GAME CREAT VIEW ============*/
var rowTemplate = " <tr>\n" +
    "                        <td class=\"pt-3-half\"><img src=\"%img%\"/></td>\n" +
    "                        <td class=\"pt-3-half\">%name%</td>\n" +
    "                        <td class=\"pt-3-half price\">%price%</td>\n" +
    "                        <td>\n" +
    "                            <span><button type=\"button\" class=\"btn btn-danger btn-rounded btn-sm my-0\" profValue=\"%prof%\" typeElement=\"%type%\" onclick=\"buySomething(this)\">Buy</button></span>\n" +
    "                        </td>\n" +
    "                    </tr>";
var data = "";
function generateTable()    {

    for(var i=0; i< getObjectLenght(baseCost.generator); i++){
        var dataTemp = rowTemplate;
        var prof = profGenerator[0]["generator"][0][i];
        dataTemp = dataTemp.replace("%img%", valueGenerator.srcImage[prof]);
        dataTemp = dataTemp.replace("%name%",  prof);
        dataTemp = dataTemp.replace("%price%", currentCost.generator[prof]);
        dataTemp = dataTemp.replace("%prof%",  prof);
        dataTemp = dataTemp.replace("%type%", "generator");
        data += dataTemp;
    }

    for(var i=0; i< getObjectLenght(baseCost.generatorception); i++){
        var dataTemp = rowTemplate;
        var prof = profGenerator[0]["generatorception"][0][i];
        dataTemp = dataTemp.replace("%img%", valueGenerator.srcImage[prof]);
        dataTemp = dataTemp.replace("%name%",  prof);
        dataTemp = dataTemp.replace("%price%", currentCost.generatorception[prof]);
        dataTemp = dataTemp.replace("%prof%", prof);
        dataTemp = dataTemp.replace("%type%", "generatorception");
        data += dataTemp;
    }

    $('.profTable').html(data);
}

/*=========== GAME CLIENT FUNCTION ============*/
function buySomething(elem)     {
    var type = $(elem).attr('typeElement');
    var prof = $(elem).attr('profValue');
    if (playerStats.unit >= currentCost[type][prof]) {
        playerStats.unit -= currentCost[type][prof];
        addSomething(type, prof, elem);
    }

}

function addSomething(type, prof, elem) {
    playerStats[type][prof]++;
    currentCost[type][prof] = baseCost[type][prof] * Math.ceil(Math.pow(1.15, playerStats[type][prof]));
    $(elem).parent().parent().parent().find(".price").text(currentCost[type][prof]);
    addSpriteGenerator(prof);
}

function addUnit() {
    playerStats.unit++;
}
function affUnit() {
    odometer.innerHTML = playerStats.unit;
}

function resetEnclos() {
    map = new Map("premiere");
    arrayProf  = [];
}
/*============ GAME COMM FUNCTON client-->server =========*/
function save() {
    var toSave = JSON.stringify([playerStats, currentCost]);

    console.log(toSave);

    var request =
    $.ajax({
         url: "http://phenixos-lab.ddns.net:8000/save",
         type: "get",
         dataType: 'json',
         data: toSave,
     });

    request.done(function( result ) {
       toastr["success"]("Saved!")
    });

    request.fail(function(result, statut, erreur){
        toastr["error"]("Error!")
    });
}

function load() {

    var request =
        $.ajax({
            url: "http://phenixos-lab.ddns.net:8000/load",
            type: "get",
        });

    request.done(function( result ) {

        var dataJson = JSON.parse(decodeURI(result)); //decode to change %22 --> "
        console.log(dataJson);
        checkDataIntegrity(dataJson);
    });

    request.fail(function(result, statut, erreur){
        console.log(result+ " --- " + erreur);
    });
}

function checkDataIntegrity(dataJson) {

        playerStats = dataJson[0];
        currentCost = dataJson[1];

}

/*=============== ADD GAME ======================*/

function mamieAdd() {
    for(var i=0; i<playerStats.generatorception.mamie; i++)
        for(var k=0; k<valueGenerator.valueAdd.mamie; k++)
            addSomething("generator", "couland");
}
function walkoAdd() {
    for(var i=0; i<playerStats.generatorception.walko; i++)
        for(var k=0; k<valueGenerator.valueAdd.walko; k++)
            addSomething("generator", "couland");
}
function momoAdd() {
    for(var i=0; i<playerStats.generatorception.momo; i++)
        for(var k=0; k<valueGenerator.valueAdd.momo; k++)
            addSomething("generator", "couland");
}

function laborieAdd() {
    for(var i=0; i<playerStats.generator.laborie; i++)
       playerStats.unit+=valueGenerator.valueAdd.laborie;
}
function lafocadeAdd() {
    for(var i=0; i<playerStats.generator.laforcade; i++)
        playerStats.unit+=valueGenerator.valueAdd.laforcade;
}
function coulandAdd() {
    for(var i=0; i<playerStats.generator.couland; i++)
        playerStats.unit+=valueGenerator.valueAdd.couland;
}
function ernetAdd() {
    for(var i=0; i<playerStats.generator.ernet; i++)
        playerStats.unit+=valueGenerator.valueAdd.ernet;
}


/*============ GAME LOOP ============*/
function gameTimerTask() {

    mamieAdd();
    walkoAdd();
    momoAdd();
    laborieAdd();
    lafocadeAdd();
    coulandAdd();
    ernetAdd();

}

function popoverContentUpdate() {

    $("#popover-content").html("");

    for (var item in playerStats.generator) {
        if(playerStats.generator[item] != 0)
            generateRow(item, "generator");
    }

    $('#popover-content').append("</hr>");

    for (var item in playerStats.generatorception) {
        if(playerStats.generatorception[item] != 0)
            generateRow(item, "generator");
    }
}

function generateRow(item, type) {
    var profName = item

    var content =
        "<div class=\"row\">"+
            "<div class=\"col-4\">"+
                "<img src='images/"+profName+"Face.png'>"+
            "</div>"+
            "<div class=\"col-4\">"+
                "<span>"+profName+"</span>"+
            "</div>"+
            "<div class=\"col-4\">"+
                "<span> x "+ playerStats[type][profName]+"</span>"+
            "</div>";

    $('#popover-content').append(content);
}

function gameAffTask() {
    affUnit();
    popoverContentUpdate()
}
/*========== Load window function ==========*/

generateTable();

affUnit();

setInterval(gameTimerTask, 1000);
setInterval(gameAffTask, 500);

$("[data-toggle=popover]").popover({
    html: true,
    content: function() {
        return $('#popover-content').html();
    }
});
