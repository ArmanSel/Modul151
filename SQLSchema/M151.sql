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
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Bayern München', 'Bundesliga');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Juventus Turin', 'Serie A');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Benfica', 'Liga Portugal');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Liverpool', 'Premier League');
INSERT INTO `m151`.`tw_teams` (`TeamName`, `TeamLeague`) VALUES ('Al-Nasr', 'Saudi Professional League');

CREATE TABLE tw_Transfers (
	TransferId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	PlayerId INT NOT NULL,
	OldTeamId INT NOT NULL,
	NewTeamId INT NOT NULL,
	TransferSum FLOAT NOT NULL
);

INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('1', '1', '8', '0.0');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('2', '6', '7', '80000000');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('3', '1', '5', '0.0');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('4', '5', '4', '67000000');
INSERT INTO `m151`.`tw_transfers` (`PlayerId`, `OldTeamId`, `NewTeamId`, `TransferSum`) VALUES ('5', '2', '3', '11500000');

USE `m151`;
CREATE  OR REPLACE VIEW `tw_v_transfersOverview` AS
SELECT p.PlayerFirstName AS 'First Name', p.PlayerLastName AS 'Last Name', p.PlayerAge AS 'Age', PlayerNationality AS 'Nationality', p.PlayerPosition AS 'Position', (SELECT TeamName FROM tw_teams WHERE TeamId = OldTeamId) AS 'Old Team', (SELECT TeamName FROM tw_teams WHERE TeamId  = NewTeamId) AS 'New Team', (SELECT IF(tr.TransferSum = 0, 'Free', tr.TransferSum)) AS 'Transfer Fee'
FROM tw_transfers tr LEFT JOIN tw_players p ON tr.PlayerId = p.PlayerId;