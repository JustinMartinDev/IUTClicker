function route(handle, pathname, response, request) {
    if (typeof handle[pathname] === 'function') {
        console.log(pathname);
        handle[pathname](response, request);
    } else {
        response.writeHead(404, {"Content-Type": "text/html"});
        response.write("404 Non trouvé");
        response.end();
    }
}

exports.route = route;