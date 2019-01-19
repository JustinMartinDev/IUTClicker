var http = require("http");
var url = require("url");

function start(route, handle) {
    console.log("fze")
    function onRequest(request, response) {
        var pathname = url.parse(request.url).pathname;
        console.log(pathname);
        route(handle, pathname, response, request);
    }

    http.createServer(onRequest).listen(8000);
}

exports.start = start;