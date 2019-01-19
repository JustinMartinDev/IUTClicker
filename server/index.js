var server = require("./server");
var router = require("./router");
var requestHandlers = require("./requestHandler");

var handle = {}
handle["/assets/maps/"] = requestHandlers.map;
handle["/save"] = requestHandlers.save;
handle["/load"] = requestHandlers.load;

server.start(router.route, handle);