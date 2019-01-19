var fs = require("fs"),
    url = require("url");


function save(response, request) {
    data = url.parse(request.url).query;

    fs.writeFile("/IUTClicker/server/file.json", data, "utf8", function(err){
        if(err) console.log(err);
    });

    response.setHeader("Access-Control-Allow-Origin","*");
    response.end(JSON.stringify({"1":1, "2":2}));
}

function sendJsonLoaded(response, data) {
    response.setHeader("Access-Control-Allow-Origin","*");
    response.setHeader('Content-Type', 'application/json');
    response.end(JSON.stringify(data));
}

function load(response, request) {

    var dataSaved;
    fs.readFile("/IUTClicker/server/file.json", "utf8", function(err, data){
        if(err) console.log(err);
        sendJsonLoaded(response, data);
    });

}

function map(response, request) {
    var dataSaved;
    fs.readFile("/IUTClicker/assets/maps/premiere.json", "utf8", function(err, data){
        if(err) console.log(err);
        sendJsonLoaded(response, data);
    });
}

exports.map = map;
exports.save = save;
exports.load = load;