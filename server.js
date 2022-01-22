var http = require('http');
var static = require('node-static');

var path = new static.Server(`${__dirname}/front-end`);

http.createServer(function (req, res){
  req.addListener('end', function(){
    path.serve(req,res);
  }).resume()
}).listen(8080)