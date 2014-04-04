
/*
 * GET home page.
 */

exports.index = function(req, res){
  res.render('index', { title: 'Express' });
};

exports.scoreboard = function(req, res){
  res.render('scoreboard', { title: 'Scoreboard' });
};