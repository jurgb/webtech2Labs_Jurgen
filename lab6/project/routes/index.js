
/*
 * GET home page.
 */

exports.index = function(req, res){
  res.render('index', { title: 'IMD wall'});
};

exports.scoreboard = function(req, res){
  res.render('scoreboard', { title: 'Overzicht vragen' });
};

exports.newuser = function(req, res){
  res.render('newuser', { title: 'Niewe gebruiker toevoegen'});
};

exports.loginnow = function(db) {
    return function(req, res) {
        //Check op leegstaande velden
        req.checkBody('username', 'username veld is leeg.').notEmpty();
        req.checkBody('password', 'Email veld is leeg.').notEmpty();
      
        var errors = req.validationErrors();  
        if( !errors){   //No errors were found.  Passed Validation!
            // Form values eruit halen en in een variabele steken
            var username = req.body.username;
            var password = req.body.password;

            // Collection aanmaken
            var collection = db.get('usercollection');

            //collection.find({"username": username},{"password": password},function(e, docs){
            //vgl of paswoord matcht met username
                res.render('index', {
                    'title': "Stel nu je vraag",
                    //"userlist" : docs, 
                    "username" : username
                });
            //});
        }
        else {   //Display errors to user
            res.render('index', { 
                title: 'login to ask a question',
                errors: errors
            });
        }
    }
}
exports.loginasadmin = function(db) {
    return function(req, res) {
        //Check op leegstaande velden
        req.checkBody('username', 'username veld is leeg.').notEmpty();
        req.checkBody('password', 'Email veld is leeg.').notEmpty();
      
        var errors = req.validationErrors();  
        if( !errors){   //No errors were found.  Passed Validation!
            // Form values eruit halen en in een variabele steken
            var username = req.body.username;
            var password = req.body.password;

            // Collection aanmaken
            var collection = db.get('usercollection');

            //check of het de admin account is
            if (username == "jurgb" && password == "admin"){
            //collection.find({"username": username},{"password": password},function(e, docs){
            //vgl of paswoord matcht met username
                res.render('scoreboard', {
                    'title': "Stel nu je vraag",
                    //"userlist" : docs, 
                    "username" : "adminustrator, klik on a question to delete it"
                });
            //});
            }
            else
            {
                res.render('scoreboard', {
                    title: "Overzicht vragen",
                    //"userlist" : docs, 
                    username : "",
                    errors: "De account die u invoerde heeft geen adminustrator-rechten!"

                });
            }
        }
        else {   //Display errors to user
            res.render('scoreboard', { 
                title: 'login as admin',
                errors: errors
            });
        }
    }
}

exports.adduser = function(db) {
    return function(req, res) {
        //Check op leegstaande velden
        req.checkBody('username', 'username veld is leeg.').notEmpty();
        req.checkBody('userpassword', 'Email veld is leeg.').notEmpty();
      
        var errors = req.validationErrors();  
        if( !errors){   //No errors were found.  Passed Validation!
            // Form values eruit halen en in een variabele steken
            var username = req.body.username;
            var password = req.body.userpassword;
            var checkpassword = req.body.userconfirmpassword;

            if (password === checkpassword) {

                // Collection aanmaken
                var collection = db.get('usercollection');

                // Submit to the DB
                collection.insert({
                    "username" : username,
                    "userpassword" : password
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
            }
            else {   //Display errors to user
            res.render('newuser', { 
                title: 'Nieuwe gebruiker toevoegen',
                message: '',
                errors: "Passwords don't match"
            });
            }
        }
        else {   //Display errors to user
            res.render('newuser', { 
                title: 'IMD wall',
                message: '',
                errors: errors
            });
        }
    }
}

//ajax call wou niet werken dus heb ik terug verwijderd.
exports.addquestion = function(db) {
    return function(req, res) {
        //Check op leegstaande velden
        var question = req.body.question
        // Collection aanmaken
        var collection = db.get('questions');

        // Submit to the DB
        collection.insert({
            "question" : question
        }, function (err, doc) {
            if (err) {
         // Failed -> error boodschap geven
            res.send("There was a problem adding the information to the database.");
            }
            else {
                res.render('index', { 
                title: 'IMD-wall'
                });
            }
        });
    }
}