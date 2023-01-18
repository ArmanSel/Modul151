DROP DATABASE IF EXISTS M151;

CREATE DATABASE M151;

USE M151;

CREATE TABLE tw_Players (
	PlayerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	PlayerFirstName VARCHAR(255) NOT NULL,
	PlayerLastName VARCHAR(255) NOT NULL,
	PlayerAge INT NOT NULL,
	PlayerNationality VARCHAR(50) NOT NULL,
	PlayerPosition VARCHAR(50) NOT NULL
);

INSERT INTO `m151`.`tw_players` (`PlayerFirstName`, `PlayerLastName`, `PlayerAge`, `PlayerNationality`, `PlayerPosition`) VALUES ('Cristiano', 'Ronaldo', '37', 'Portugal', 'ST');
INSERT INTO `m151`.`tw_players` (`PlayerFirstName`, `PlayerLastName`, `PlayerAge`, `PlayerNationality`, `PlayerPosition`) VALUES ('Darwin', 'Nunez', '23', 'Uruguay', 'ST');
INSERT INTO `m151`.`tw_players` (`PlayerFirstName`, `PlayerLastName`, `PlayerAge`, `PlayerNationality`, `PlayerPosition`) VALUES ('Paul', 'Pogba', '29', 'France', 'CM');
INSERT INTO `m151`.`tw_players` (`PlayerFirstName`, `PlayerLastName`, `PlayerAge`, `PlayerNationality`, `PlayerPosition`) VALUES ('Matthijs', 'de Ligt', '22', 'Netherland', 'CB');
INSERT INTO `m151`.`tw_players` (`PlayerFirstName`, `PlayerLastName`, `PlayerAge`, `PlayerNationality`, `PlayerPosition`) VALUES ('Nick', 'Pope', '30', 'England', 'GK');

CREATE TABLE tw_Teams (
	TeamId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	TeamName VARCHAR(255) NOT NULL,
	TeamLeague VARCHAR(255) NOT NULL
);

INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Manchester United', 'Premier League');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Burnley', 'Premier League');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Newcastle United', 'Premier League');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Bayern Muenchen', 'Bundesliga');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Juventus Turin', 'Serie A');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Benfica', 'Liga Portugal');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Liverpool', 'Premier League');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Al-Nasr', 'Saudi Professional League');

CREATE TABLE tw_Transfers (
	TransferId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	PlayerId INT NOT NULL,
	OldTeamId INT NOT NULL,
	NewTeamId INT NOT NULL,
	TransferSum FLOAT NOT NULL,
    FOREIGN KEY (PlayerId) REFERENCES tw_players(PlayerId),
    FOREIGN KEY (OldTeamId) REFERENCES tw_teams(TeamId),
    FOREIGN KEY (NewTeamId) REFERENCES tw_teams(TeamId)
);

INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('1', '1', '8', '0.0');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('2', '6', '7', '80000000');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('3', '1', '5', '0.0');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('4', '5', '4', '67000000');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('5', '2', '3', '11500000');

USE `m151`;
CREATE  OR REPLACE VIEW `tw_v_transferOverview` AS
SELECT tr.TransferId, p.PlayerFirstName AS 'First Name', p.PlayerLastName AS 'Last Name', p.PlayerAge AS 'Age', PlayerNationality AS 'Nationality', p.PlayerPosition AS 'Position', (SELECT TeamName FROM tw_teams WHERE TeamId = OldTeamId) AS 'Old Team', (SELECT TeamName FROM tw_teams WHERE TeamId  = NewTeamId) AS 'New Team', (SELECT IF(tr.TransferSum = 0, 'Free', tr.TransferSum)) AS 'Transfer Fee'
FROM tw_transfers tr LEFT JOIN tw_players p ON tr.PlayerId = p.PlayerId;

USE `m151`;
DROP procedure IF EXISTS `tw_getTransfers`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_getTransfers` (IN input VARCHAR(255))
BEGIN
	CASE WHEN input = 'all'
    THEN
		SELECT * FROM tw_v_transferOverview;
    ELSE
		SELECT * FROM tw_v_transferOverview WHERE TransferId = input;
	END CASE;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_deleteTransfer`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_deleteTransfer` (IN input INT)
BEGIN
	DELETE FROM tw_transfers WHERE TransferId = input;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_updateTransfer`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_updateTransfer` (IN input INT, IN playerId INT, IN oldTeamId INT, IN newTeamId INT, IN transferSum INT)
BEGIN
	UPDATE tw_transfers SET PlayerId = playerId, OldTeamId = oldTeamId, NewTeamId = newTeamId, TransferSum = transferSum WHERE TransferId = input;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_insertTransfer`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_insertTransfer` (IN playerId INT, IN oldTeamId INT, IN newTeamId INT, IN transferSum INT)
BEGIN
	INSERT INTO tw_transfers (PlayerId, OldTeamId, NewTeamId, TransferSum) VALUES (playerId, oldTeamId, newTeamId, transferSum);
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_getTransfersData`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_getTransfersData` (IN input INT)
BEGIN
	SELECT * FROM tw_transfers WHERE TransferId = input;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_getPlayers`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_getPlayers` (IN input VARCHAR(255))
BEGIN
	CASE WHEN input = 'all'
    THEN
		SELECT * FROM tw_players;
    ELSE
		SELECT * FROM tw_players WHERE PlayerId = input;
	END CASE;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_updatePlayer`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_updatePlayer` (IN input INT, IN firstName VARCHAR(255), IN lastName VARCHAR(255), IN age INT, IN nationality VARCHAR(255), IN playerPosition VARCHAR(50))
BEGIN
	UPDATE tw_players SET PlayerFirstName = firstName, PlayerLastName = lastName, PlayerAge = age, PlayerNationality = nationality, PlayerPosition = playerPosition WHERE PlayerId = input;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_insertPlayer`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_insertPlayer` (IN firstName VARCHAR(255), IN lastName VARCHAR(255), IN age INT, IN nationality VARCHAR(255), IN playerPosition VARCHAR(50))
BEGIN
	INSERT INTO tw_players (PlayerFirstName, PlayerLastName, PlayerAge, PlayerNationality, PlayerPosition) VALUES (firstName, lastName, age, nationality, playerPosition);
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_deletePlayer`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_deletePlayer` (IN input INT)
BEGIN
	DELETE FROM tw_players WHERE PlayerId = input;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_getTeams`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_getTeams` (IN input VARCHAR(255))
BEGIN
	CASE WHEN input = 'all'
    THEN
		SELECT * FROM tw_teams;
    ELSE
		SELECT * FROM tw_teams WHERE TeamId = input;
	END CASE;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_updateTeam`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_updateTeam` (IN input INT, IN teamName VARCHAR(255), IN teamLeague VARCHAR(255))
BEGIN
	UPDATE tw_teams SET TeamName = teamName, TeamLeague = teamLeague WHERE TeamId = input;
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_insertTeam`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_insertTeam` (IN teamName VARCHAR(255), IN teamLeague VARCHAR(255))
BEGIN
	INSERT INTO tw_teams (TeamName, TeamLeague) VALUES (teamName, teamLeague);
END$$

DELIMITER ;

USE `m151`;
DROP procedure IF EXISTS `tw_deleteTeam`;

DELIMITER $$
USE `m151`$$
CREATE PROCEDURE `tw_deleteTeam` (IN input INT)
BEGIN
	DELETE FROM tw_teams WHERE TeamId = input;
END$$

DELIMITER ;