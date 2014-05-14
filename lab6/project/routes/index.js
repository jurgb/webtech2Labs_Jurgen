
/*
 * GET home page.
 */

exports.index = function(req, res){
  res.render('index', { title: 'Express' });
};

exports.scoreboard = function(req, res){
  res.render('scoreboard', { title: 'Scoreboard' });
};

exports.newuser = function(req, res){
  res.render('newuser', { title: 'Niewe gebruiker toevoegen'});
};

exports.adduser = function(db) {
    return function(req, res) {
        //Check op leegstaande velden
        //req.checkBody('username', 'username veld is leeg.').notEmpty();
        //req.checkBody('useremail', 'Email veld is leeg.').notEmpty();
      
        //var errors = req.validationErrors();  
        //if( !errors){   //No errors were found.  Passed Validation!
            // Form values eruit halen en in een variabele steken
            var username = req.body.username;
            var email = req.body.useremail;

            // Collection aanmaken
            var collection = db.get('usercollection');

            // Submit to the DB
            collection.insert({
                "username" : username,
                "email" : email
            }, function (err, doc) {
                if (err) {
                    // Failed -> error boodschap geven
                    res.send("There was a problem adding the information to the database.");
                }
                else {
                    res.render('newuser', { 
                        title: 'Nieuwe gebruiker toevoegen',
                        message: 'Nieuwe gebruiker toegevoegd'
                    });
                }
            });
        //}
        /*
        else {   //Display errors to user
            res.render('newuser', { 
                title: 'Nieuwe gebruiker toevoegen',
                message: '',
                errors: errors
            });
        }*/
    }
}