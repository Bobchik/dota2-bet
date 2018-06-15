var steam = require("steam"),
    util = require("util"),
    fs = require("fs"),
    crypto = require("crypto"),
    dota2 = require("../"),
    steamClient = new steam.SteamClient(),
    steamUser = new steam.SteamUser(steamClient),
    steamFriends = new steam.SteamFriends(steamClient),
    Dota2 = new dota2.Dota2Client(steamClient, true);

global.config = require("./config");

var onSteamLogOn = function onSteamLogOn(logonResp) {

    if (logonResp.eresult == steam.EResult.OK) {
        steamFriends.setPersonaState(steam.EPersonaState.Busy);
        steamFriends.setPersonaName(global.config.steam_name);
        util.log("Logged on.");

        Dota2.launch();
        Dota2.on("ready", function() {
            util.log("Node-dota2 ready.");

            var creatingLobby = 1;
            var leavingLobby = 0;
            var destroyLobby = 0;
            var lobbyChannel = "";

            if(creatingLobby == 1){ // sets only password, nothing more
                var properties = {
                    "game_name": "dich_lobby",
                    "server_region": dota2.ServerRegion.EUROPE,
                    "game_mode": dota2.schema.lookupEnum('DOTA_GameMode').values.DOTA_GAMEMODE_CM,
                    "series_type": dota2.SeriesType.BEST_OF_THREE,
                    "game_version": 1,
                    "allow_cheats": false,
                    "fill_with_bots": false,
                    "allow_spectating": true,
                    "pass_key": "12345",
                    "radiant_series_wins": 0,
                    "dire_series_wins": 0,
                    "allchat": true
                }

                Dota2.createPracticeLobby(properties, function(err, data){
                    if (err) {
                        util.log(err + ' - ' + JSON.stringify(data));
                    }

                    // INVITE TO LOBBY
                    setTimeout(function(){
                        let iterable = ['76561198128250421', 'vadoishere'];
                        for (let value of iterable) {
                            Dota2.inviteToLobby(value); // Illusion
                            // Dota2.inviteToLobby('76561198094710754'); // HOLA
                        }
                    }, 1000);
                });
                Dota2.on("practiceLobbyUpdate", function(lobby) {
                    Dota2.practiceLobbyKickFromTeam(Dota2.AccountID);
                    lobbyChannel = "Lobby_"+lobby.lobby_id;
                    Dota2.joinChat(lobbyChannel, dota2.schema.lookupEnum('DOTAChatChannelType_t').values.DOTAChannelType_Lobby);
                });

                if(leavingLobby == 1){
                    setTimeout(function(){
                        Dota2.leavePracticeLobby(function(err, data){
                            if (!err) {
                                Dota2.abandonCurrentGame();
                                if(lobbyChannel) Dota2.leaveChat(lobbyChannel);
                            } else {
                                util.log(err + ' - ' + JSON.stringify(data));
                            }
                        });
                    }, 10000);
                }

                if(destroyLobby == 1){
                    setTimeout(function(){
                        Dota2.destroyLobby(function(err, data){
                            if (err) {
                                util.log(err + ' - ' + JSON.stringify(data));
                            } else {
                                if(lobbyChannel) Dota2.leaveChat(lobbyChannel);
                            }
                        });
                    }, 10000);
                }

                if(leavingLobby == 1){
                    setTimeout(function(){
                        Dota2.leavePracticeLobby(function(err, data){
                            if (!err) {
                                Dota2.abandonCurrentGame();
                                if(lobbyChannel) Dota2.leaveChat(lobbyChannel);
                            } else {
                                util.log(err + ' - ' + JSON.stringify(data));
                            }
                        });
                    }, 10000);
                }

                if(destroyLobby == 1){
                    setTimeout(function(){
                        Dota2.destroyLobby(function(err, data){
                            if (err) {
                                util.log(err + ' - ' + JSON.stringify(data));
                            } else {
                                if(lobbyChannel) Dota2.leaveChat(lobbyChannel);
                            }
                        });
                    }, 10000);
                }
            }
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


