var steam = require("steam"),
    util = require("util"),
    fs = require("fs"),
    crypto = require("crypto"),
    dota2 = require("../../"),
    steamClient = new steam.SteamClient(),
    steamUser = new steam.SteamUser(steamClient),
    steamFriends = new steam.SteamFriends(steamClient),
    Dota2 = new dota2.Dota2Client(steamClient, true);

global.config = require("./config");

var players = require('./players');

var onSteamLogOn = function onSteamLogOn(logonResp) {
    if (logonResp.eresult == steam.EResult.OK) {
        steamFriends.setPersonaState(steam.EPersonaState.Busy);
        steamFriends.setPersonaName(global.config.steam_name);
        util.log("Logged on.");
                    
        var store = new Map(); // объект для коллекции
            for (var i = 0; i < players.id.length-1; i++) {
                var key = players.id[i][0]; // для каждого элемента создаём свойство
                var value = players.id[i][1]; // для каждого элемента создаём свойство
                store.set(key,value); // значение здесь не важно
            }
        //var iterator1 = store[Symbol.iterator]();
for (var [key, value] of store.entries()) {
  util.log(" Team: " + value + " User ID: " + key);
}
             
        Dota2.launch();
        Dota2.on("ready", function() {
            util.log("Node-dota2 ready.");
            
            var chatChannel = "dota2bot";
            var joiningChannel = 0;
            var leavingChannel = 0;
/*            // CHAT

            if(joiningChannel == 1){
                Dota2.joinChat(chatChannel);
                setTimeout(function(){
                    Dota2.sendMessage("Hello, guys! I'm Dota 2 Bot.", chatChannel);
                }, 1000);
            }

            if(leavingChannel == 1){
                setTimeout(function(){
                    Dota2.leaveChat(chatChannel);
                }, 10000);
            }*/

            // ----------------------------------

            // COMMUNITY

            //var accId = Dota2.ToAccountID('76561198105183102');
            // var playerInfo = 0;
           // var playerInfo2 = 0;
            // var playerInfo3 = 0;

            // if(playerInfo == 1){ // not working - maybe disabled by Valve
            //     Dota2.requestProfile(accId, true);
            //     Dota2.on("profileData", function (accId, data) {
            //         util.log(JSON.stringify(data));
            //     });
            // }

            // if(playerInfo2 == 1){
            //     Dota2.requestProfileCard(accId, function (accId, data) {
            //         util.log(JSON.stringify(data));
            //     });
            // }
            //Dota2.requestProfileCard(accId);
            // if(playerInfo3 == 1){
            //     Dota2.requestPassportData(accId, function (accId, data) {
            //         util.log(JSON.stringify(data));
            //     });
            // }

            // ----------------------------------

            // MATCH

            // Request the details of a certain match
            // var CheckMatchID = 1944132605;
            // var checkingMatch = 0;

            // if(checkingMatch == 1){
            //     Dota2.requestMatchDetails(CheckMatchID, function(err, data){
            //         util.log(JSON.stringify(data));
            //     });
            // }
            
            // // Request the 50 most recent matches
            // var checkingMatches = 0;
            // if(checkingMatches == 1){
            //     Dota2.requestMatches({
            //         "matches_requested": 25,
            //         "tournament_games_only": false,
            //         "skill": 1
            //     }, (result,response) => {
            //         response.matches.map(match => console.log(""+match.match_id));
            //         var lastID = response.matches[24].match_id - 1;
            //         Dota2.requestMatches({
            //             "matches_requested": 25,
            //             "start_at_match_id": lastID,
            //             "tournament_games_only": false,
            //             "skill": 1
            //         }, (result, response)=>{
            //             response.matches.map(match => console.log(""+match.match_id));
            //         });
            //     });
            // }
            // ----------------------------------

            // LOBBY
            /*enum DOTA_GameMode {
            DOTA_GAMEMODE_NONE = 0;
            DOTA_GAMEMODE_AP = 1;
            DOTA_GAMEMODE_CM = 2;
            DOTA_GAMEMODE_RD = 3;
            DOTA_GAMEMODE_SD = 4;
            DOTA_GAMEMODE_AR = 5;
            DOTA_GAMEMODE_INTRO = 6;
            DOTA_GAMEMODE_HW = 7;
            DOTA_GAMEMODE_REVERSE_CM = 8;
            DOTA_GAMEMODE_XMAS = 9;
            DOTA_GAMEMODE_TUTORIAL = 10;
            DOTA_GAMEMODE_MO = 11;
            DOTA_GAMEMODE_LP = 12;
            DOTA_GAMEMODE_POOL1 = 13;
            DOTA_GAMEMODE_FH = 14;
            DOTA_GAMEMODE_CUSTOM = 15;
            DOTA_GAMEMODE_CD = 16;
            DOTA_GAMEMODE_BD = 17;
            DOTA_GAMEMODE_ABILITY_DRAFT = 18;
            DOTA_GAMEMODE_EVENT = 19;
            DOTA_GAMEMODE_ARDM = 20;
            DOTA_GAMEMODE_1V1MID = 21;
            DOTA_GAMEMODE_ALL_DRAFT = 22;
            }*/
            var creatingLobby = 1;
            var leavingLobby = 0;
            var destroyLobby = 1;
            var lobbyChannel = "";
                var lobby = null;
        
          if(creatingLobby == 1)
            { // sets only password, nothing more
                var properties = {
                    "game_name": "tghbcvf335g",
                    "server_region": dota2.ServerRegion.UNSPECIFIED,
                    "game_mode": dota2.schema.lookupEnum('DOTA_GameMode').values.DOTA_GAMEMODE_AP,
                    "series_type": dota2.SeriesType.BEST_OF_THREE,
                    "game_version": 1,
                    "allow_cheats": true,
                    "fill_with_bots": true,
                    "allow_spectating": true,
                    "pass_key": "ap",
                    "radiant_series_wins": 0,
                    "dire_series_wins": 0,
                    "allchat": true
                }

        // LEAVE BEFORE CREATE
        Dota2.leavePracticeLobby(function(err, body){
            Dota2.destroyLobby();
        // CREATE LOBBY
        Dota2.createPracticeLobby(properties, function(err, body){
            Dota2.practiceLobbyKickFromTeam(Dota2.AccountID);
            util.log(JSON.stringify(body));

    setTimeout(function(){
        for (var [key, value] of store.entries()) {
        Dota2.inviteToLobby(key); // Me
        util.log("Inviting user ID: "+ key + " Team: " + value);
        }
            }, 1000);

            // util.log();
           

    });

});
/*enum DOTA_GC_TEAM {
    DOTA_GC_TEAM_GOOD_GUYS = 0;
    DOTA_GC_TEAM_BAD_GUYS = 1;
    DOTA_GC_TEAM_BROADCASTER = 2;
    DOTA_GC_TEAM_SPECTATOR = 3;
    DOTA_GC_TEAM_PLAYER_POOL = 4;
    DOTA_GC_TEAM_NOTEAM = 5;
}*/
Dota2.on("practiceLobbyResponse", function(data) {
    Dota2.joinPracticeLobbyTeam(2,4);
});

Dota2.on("practiceLobbyUpdate", function(lobby_data) {
    if(lobby == null){
        Dota2.joinChat('Lobby_' + lobby_data.lobby_id, 3);
    }
    Dota2.on("chatJoin", function(channel, joiner_name, joiner_steam_id, otherJoined_object) {
        channel = lobbyChannel;
        var steam_id = Dota2.ToSteamID(joiner_steam_id.low + "") + "";
        if(store.has(steam_id)){
            if(store.get(steam_id) == 'R'){
                setTimeout(function(){
                Dota2.sendMessage(joiner_name+", please enter Radiance Team ", lobbyChannel);
                }, 1000);
            }
            if(store.get(steam_id) == 'D'){
                setTimeout(function(){
                Dota2.sendMessage(joiner_name+", please enter Dire Team ", lobbyChannel);
                }, 1000);
            }
        }
    });
    lobby = lobby_data;
    lobbyChannel = "Lobby_"+lobby.lobby_id;
    
    lobby.match_outcome = 3;
    //lobby.lobby_id = 1;

    if(lobby.match_outcome == 3)
    {
        var result;
                for (var i in lobby) {
                    if (lobby.hasOwnProperty(i) ) {
                        result += i + " " + JSON.stringify(lobby[i]) + "\n";
                    }
                util.log(lobby_data);
                fs.writeFileSync("games/"+players.id[10]+"/"+players.id[10]+ ".end", result);
                
    }
    util.log("lobby game state = "+lobby.game_state);
    //lobby.game_state = 6;
        // util.log(lobby);
    // if(lobby.game_state == 6){
                //fs.writeFileSync("match.end", dota2._getMessageName(kMsg));
                 var result;
                 for (var i in lobby) {
                    if (lobby.hasOwnProperty(i) ) {
                        result += i + " " + JSON.stringify(lobby[i]) + "\n";
                    }
                    // if (i == 'match_outcome') {
                    //     result += i + " " + lobby[i] + " ";
                    //     // fs.writeFileSync("games/"+players.id[10]+"/"+players.id[10]+ ".end", result);
                    // }
                    fs.writeFileSync("games/"+players.id[10]+"/"+players.id[10]+ ".end", result);
                }
             }

    });
              //chatMessage" (channel, sender_name, message, chatData)
        Dota2.on("chatLeave", function(channel, leaver_steam_id, otherLeft_object) {
                 channel = lobbyChannel;
                 setTimeout(function(){
                     Dota2.sendMessage(leaver_steam_id+" leave lobby", lobbyChannel);
                  Dota2.inviteToLobby(leaver_steam_id); // Me
                  util.log(leaver_steam_id+" leave lobby", lobbyChannel);
                 }, 1000);
             });

            var i = 0;
            Dota2.on("chatMessage", function(channel, sender_name, message, chatData) {
                channel = lobbyChannel;
                if (message == 'ok'){
                    i++;   
                }
                if (i == 1){
                    Dota2.launchPracticeLobby(function(err, body){
                        util.log(JSON.stringify(body));
                    });
                }
            });
           }

            // if(leavingLobby == 1){
            //     setTimeout(function(){
            //         Dota2.leavePracticeLobby(function(err, data){
            //             if (!err) {
            //                 Dota2.abandonCurrentGame();
            //                 if(lobbyChannel) Dota2.leaveChat(lobbyChannel);
            //             } else {
            //                 util.log(err + ' - ' + JSON.stringify(data));
            //             }
            //         });
            //     }, 10000);
            // }

            // if(destroyLobby == 1){
            //     setTimeout(function(){
            //         Dota2.destroyLobby(function(err, data){
            //             if (err) {
            //                 util.log(err + ' - ' + JSON.stringify(data));
            //             } else {
            //                 if(lobbyChannel) Dota2.leaveChat(lobbyChannel);
            //             }
            //         });
            //     }, 10000);
            // }
            
            // ----------------------------------
            
            // TEAM
            
            // var myTeamInfo = 0;
            
            // if (myTeamInfo == 1) {
            //     Dota2.requestMyTeams(function(err, data){
            //         util.log(JSON.stringify(data));
            //     });
            // }
            
            // // ----------------------------------
            
            // // SOURCETV
            
            // var sourceGames = 0;
            
            // if (sourceGames == 1) {
            //     Dota2.requestSourceTVGames();
            //     Dota2.on('sourceTVGamesData', (gamesData) => {
            //         util.log(gamesData);
            //     });
            // }
            
            // ----------------------------------
            
            // FANTASY
            
            // var fantasyCards = 0;
            
            // if (fantasyCards == 1) {
            //     Dota2.on("inventoryUpdate", inventory => {
            //         // Time-out so inventory property is updated
            //         setTimeout(()=>{
            //             Promise.all(Dota2.requestPlayerCardsByPlayer()).then(cards => {
            //                 fs.writeFileSync('cards.js',JSON.stringify(cards));
            //             });
            //         }, 10000);
            //     });
            // }
        });

        Dota2.on("unready", function onUnready() {
            util.log("Node-dota2 unready.");
        });

        Dota2.on("chatMessage", function(channel, personaName, message) {
            util.log("[" + channel + "] " + personaName + ": " + message);
        });

        Dota2.on("unhandled", function(kMsg) {
            util.log("UNHANDLED MESSAGE " + dota2._getMessageName(kMsg));
        });
    }
},
onSteamServers = function onSteamServers(servers) {
    util.log("Received servers.");
    fs.writeFile('servers', JSON.stringify(servers), (err) => {
        if (err) {if (this.debug) util.log("Error writing ");}
        else {if (this.debug) util.log("");}
    });
},
onSteamLogOff = function onSteamLogOff(eresult) {
    util.log("Logged off from Steam.");
},
onSteamError = function onSteamError(error) {
    util.log("Connection closed by server.");

};

steamUser.on('updateMachineAuth', function(sentry, callback) {
    var hashedSentry = crypto.createHash('sha1').update(sentry.bytes).digest();
    fs.writeFileSync('sentry', hashedSentry)
    util.log("sentryfile saved");

    callback({ sha_file: hashedSentry});
});

var logOnDetails = {
    "account_name": global.config.steam_user,
    "password": global.config.steam_pass,
};
if (global.config.steam_guard_code) logOnDetails.auth_code = global.config.steam_guard_code;
if (global.config.two_factor_code) logOnDetails.two_factor_code = global.config.two_factor_code;

try {
    var sentry = fs.readFileSync('sentry');
    if (sentry.length) logOnDetails.sha_sentryfile = sentry;
}
catch (beef){
    util.log("Cannot load the sentry. " + beef);
}

steamClient.connect();

steamClient.on('connected', function() {
    steamUser.logOn(logOnDetails);
});

steamClient.on('logOnResponse', onSteamLogOn);
steamClient.on('loggedOff', onSteamLogOff);
steamClient.on('error', onSteamError);
steamClient.on('servers', onSteamServers);
