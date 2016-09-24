<?php
/*
 * Plugin: Records Eyepiece
 * ~~~~~~~~~~~~~~~~~~~~~~~~
 * For a detailed description and documentation, please refer to:
 * http://www.undef.name/UASECO/Records-Eyepiece.php
 *
 * ----------------------------------------------------------------------------------
 * Author:		undef.de
 * Contributors:	.anDy, Bueddl
 * Version:		1.1.0
 * Date:		2015-12-27
 * Copyright:		2009 - 2015 by undef.de
 * System:		UASECO/0.9.5+
 * Game:		ManiaPlanet Trackmania2 (TM2)
 * ----------------------------------------------------------------------------------
 *
 * LICENSE: This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ----------------------------------------------------------------------------------
 *
 * Dependencies:
 *  - plugins/plugin.modescript_handler.php	Required
 *  - plugins/plugin.checkpoints.php		Required
 *  - plugins/plugin.local_records.php		Required, for LocalRecordsWidget
 *  - plugins/plugin.welcome_center.php		Required, for TopVisitors
 *  - plugins/plugin.mania_exchange.php		Required, for MapWidget, MXMapInfoWindow and <placement>-Placeholder
 *  - plugins/plugin.rasp_jukebox.php		Required, for MaplistWindow
 *  - plugins/plugin.rasp.php			Required, only if you enable the TopRankingsWidget (enabled by default)
 *  - plugins/plugin.dedimania.php		Required, only if you enable the DedimaniaWidget (enabled by default)
 *  - plugins/plugin.donate.php			Optional, only if you want the TopDonators or the DonationWidget at Score
 *  - plugins/plugin.music_server.php		Optional, only if you want the MusicWidget
 *  - plugins/plugin.nouse_betting.php		Optional, only if you want the Betwins-Widget at Score.
 *  - plugins/plugin.round_points.php		Recommended, useful if you want to setup own point limits in the RoundScoreWidget
 *  - plugins/plugin.mania_karma.php		Recommended, useful if you want to have the Karma-Widget.
 */

/* The following manialink id's are used in this plugin (the 918 part of id can be changed on trouble):
 *
 * ManialinkID's
 * ~~~~~~~~~~~~~
 * MainWindow
 * SubWindow
 * PlacementWidgetRace
 * PlacementWidgetScore
 * PlacementWidgetAlways
 * PlacementWidgetGamemode
 * DedimaniaRecordsWidget			(at all Gamemodes)
 * LocalRecordsWidget				(at all Gamemodes)
 * LiveRankingsWidget				(at all Gamemodes, but not at Score)
 * RoundScoreWidget
 * MultiLapInfoWidget
 * WarmUpInfoWidget
 * MapWidget
 * MusicWidget
 * ToplistWidget
 * ClockWidget
 * AddToFavoriteWidget
 * VisitorsWidget
 * MapCountWidget
 * ManiaExchangeWidget
 * TopRankingsWidgetAtScore
 * TopWinnersWidgetAtScore
 * MostRecordsWidgetAtScore
 * MostFinishedWidgetAtScore
 * TopPlaytimeWidgetAtScore
 * TopDonatorsWidgetAtScore
 * TopNationsWidgetAtScore
 * TopMapsWidgetAtScore
 * TopVotersWidgetAtScore
 * TopBetwinsWidgetAtScore
 * TopAverageTimesWidgetAtScore
 * TopRoundscoreWidgetAtScore
 * NextGamemodeWidgetAtScore
 * NextEnvironmentWidgetAtScore
 * WinningPayoutWidgetAtScore
 * DonationWidgetAtScore
 * TopWinningPayoutsWidgetAtScore
 * TopVisitorsWidgetAtScore
 * TopActivePlayersWidgetAtScore
 * ImagePreloadBox1 to ImagePreloadBox4		id for manialink ImagePreload
 *
 * ActionID's
 * ~~~~~~~~~~
 * addMapToPlaylist
 * removeMapFromPlaylist
 * askDropMapFromPlaylist
 * dropMapFromPlaylist
 * addSongToJukebox
 * dropCurrentSongFromJukebox			(and refresh MusiclistWindow)
 * handlePlayerDonation
 * releaseChatCommand				action of chat-commands in the <placement_widget>
 * showDedimaniaRecordsWindow
 * showHelpWindow
 * showLastCurrentNextMapWindow
 * showLiveRankingsWindow
 * showLocalRecordsWindow
 * showManiaExchangeMapInfoWindow
 * showMapAuthorlistWindow
 * showMaplistFilterWindow
 * showMaplistSortingWindow
 * showMaplistWindow
 * showMaplistWindowFilterAuthor
 * showMaplistWindowFilterOnlyCanyonMaps
 * showMaplistWindowFilterOnlyStadiumMaps
 * showMaplistWindowFilterOnlyValleyMaps
 * showMaplistWindowFilterJukeboxedMaps
 * showMaplistWindowFilterNoRecentMaps
 * showMaplistWindowFilterOnlyRecentMaps
 * showMaplistWindowFilterOnlyMapsWithoutRank
 * showMaplistWindowFilterOnlyMapsWithRank
 * showMaplistWindowFilterOnlyMapsNoGoldTime
 * showMaplistWindowFilterOnlyMapsNoAuthorTime
 * showMaplistWindowFilterMapsWithMoodSunrise
 * showMaplistWindowFilterMapsWithMoodDay
 * showMaplistWindowFilterMapsWithMoodSunset
 * showMaplistWindowFilterMapsWithMoodNight
 * showMaplistWindowFilterOnlyMultilapMaps
 * showMaplistWindowFilterNoMultilapMaps
 * showMaplistWindowFilterOnlyMapsNoSilverTime
 * showMaplistWindowFilterOnlyMapsNoBronzeTime
 * showMaplistWindowFilterOnlyMapsNotFinished
 * showMaplistWindowSortingBestPlayerRank
 * showMaplistWindowSortingWorstPlayerRank
 * showMaplistWindowSortingShortestAuthorTime
 * showMaplistWindowSortingLongestAuthorTime
 * showMaplistWindowSortingNewestMapsFirst
 * showMaplistWindowSortingOldestMapsFirst
 * showMaplistWindowSortingByMapname
 * showMaplistWindowSortingByAuthorname
 * showMaplistWindowSortingByKarmaBestMapsFirst
 * showMaplistWindowSortingByKarmaWorstMapsFirst
 * showMaplistWindowSortingByAuthorNation
 * showMostFinishedWindow
 * showMostRecordsWindow
 * showMusiclistWindow
 * showTopActivePlayersWindow
 * showTopBetwinsWindow
 * showTopContinentsWindow
 * showTopDonatorsWindow
 * showToplistWindow
 * showTopNationsWindow
 * showTopMapsWindow
 * showTopPlaytimeWindow
 * showTopRankingsWindow
 * showTopRoundscoreWindow
 * showTopVisitorsWindow
 * showTopVotersWindow
 * showTopWinnersWindow
 * showTopWinningPayoutWindow
 *
 */

	// Start the plugin
	$_PLUGIN = new PluginRecordsEyepiece();

/*
#///////////////////////////////////////////////////////////////////////#
#									#
#///////////////////////////////////////////////////////////////////////#
*/

class PluginRecordsEyepiece extends Plugin {
	public $config		= array();
	public $scores		= array();
	public $cache		= array();
	public $templates	= array();


	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function __construct () {

		$this->setVersion('1.1.0');
		$this->setAuthor('undef.de');
		$this->setDescription('A fully configurable HUD for all type of records and gamemodes.');

		$this->addDependence('PluginModescriptHandler',		Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginCheckpoints',		Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginLocalRecords',		Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginWelcomeCenter',		Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginManiaExchange',		Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginRasp',			Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginRaspJukebox',		Dependence::REQUIRED,	'1.0.0', null);
		$this->addDependence('PluginDedimania',			Dependence::WANTED,	'1.0.0', null);
		$this->addDependence('PluginDonate',			Dependence::WANTED,	'1.0.0', null);
		$this->addDependence('PluginMusicServer',		Dependence::WANTED,	'1.0.0', null);
		$this->addDependence('PluginNouseBetting',		Dependence::WANTED,	'1.0.0', null);
		$this->addDependence('PluginRoundPoints',		Dependence::WANTED,	'1.0.0', null);
		$this->addDependence('PluginManiaKarma',		Dependence::WANTED,	'1.0.0', null);

		$this->registerEvent('onSync',				'onSync');
		$this->registerEvent('onPlayerConnect',			'onPlayerConnect');
		$this->registerEvent('onPlayerDisconnectPrepare',	'onPlayerDisconnectPrepare');
		$this->registerEvent('onPlayerDisconnect',		'onPlayerDisconnect');
		$this->registerEvent('onPlayerInfoChanged',		'onPlayerInfoChanged');
		$this->registerEvent('onPlayerRankingUpdated',		'onPlayerRankingUpdated');
		$this->registerEvent('onPlayerFinishLine',		'onPlayerFinishLine');
		$this->registerEvent('onPlayerFinish1',			'onPlayerFinish1');
		$this->registerEvent('onPlayerWins',			'onPlayerWins');
		$this->registerEvent('onPlayerManialinkPageAnswer',	'onPlayerManialinkPageAnswer');
		$this->registerEvent('onDedimaniaRecordsLoaded',	'onDedimaniaRecordsLoaded');
		$this->registerEvent('onDedimaniaRecord',		'onDedimaniaRecord');
		$this->registerEvent('onLocalRecordsLoaded',		'onLocalRecordsLoaded');
		$this->registerEvent('onLocalRecord',			'onLocalRecord');
		$this->registerEvent('onWarmUpStatusChanged',		'onWarmUpStatusChanged');
		$this->registerEvent('onLoadingMap',			'onLoadingMap');
		$this->registerEvent('onUnloadingMap',			'onUnloadingMap');
		$this->registerEvent('onBeginRound',			'onBeginRound');
		$this->registerEvent('onEndRound',			'onEndRound');
		$this->registerEvent('onRestartMap',			'onRestartMap');
		$this->registerEvent('onEndMapRanking',			'onEndMapRanking');
		$this->registerEvent('onEverySecond',			'onEverySecond');
		$this->registerEvent('onKarmaChange',			'onKarmaChange');
		$this->registerEvent('onDonation',			'onDonation');
		$this->registerEvent('onMapListChanged',		'onMapListChanged');
		$this->registerEvent('onMapListModified',		'onMapListModified');
		$this->registerEvent('onJukeboxChanged',		'onJukeboxChanged');
		$this->registerEvent('onMusicboxReloaded',		'onMusicboxReloaded');
		$this->registerEvent('onShutdown',			'onShutdown');
		$this->registerEvent('onVotingRestartMap',		'onVotingRestartMap');		// from plugin.vote_manager.php

		$this->registerChatCommand('eyepiece',			'chat_eyepiece',	'Displays the help for the Records-Eyepiece widgets (see: /eyepiece)',		Player::PLAYERS);
		$this->registerChatCommand('elist',			'chat_elist',		'Lists maps currently on the server (see: /eyepiece)',				Player::PLAYERS);
		$this->registerChatCommand('estat',			'chat_estat',		'Display one of the MoreRankingLists (see: /eyepiece)',				Player::PLAYERS);

		$this->registerChatCommand('eyeset',			'chat_eyeset',		'Adjust some settings for the Records-Eyepiece plugin (see: /eyepiece)',	Player::MASTERADMINS);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onSync ($aseco, $reload = null) {


		// Check for the right UASECO-Version
		$uaseco_min_version = '0.9.5';
		if ( defined('UASECO_VERSION') ) {
			if ( version_compare(UASECO_VERSION, $uaseco_min_version, '<') ) {
				trigger_error('[RecordsEyepiece] Not supported USAECO version ('. UASECO_VERSION .')! Please update to min. version '. $uaseco_min_version .'!', E_USER_ERROR);
			}
		}
		else {
			trigger_error('[RecordsEyepiece] Can not identify the System, "UASECO_VERSION" is unset! This plugin runs only with UASECO/'. $uaseco_min_version .'+', E_USER_ERROR);
		}


		// Read Configuration
		if (!$this->config = $aseco->parser->xmlToArray('config/records_eyepiece.xml', true, true)) {
			trigger_error('[RecordsEyepiece] Could not read/parse config file "config/records_eyepiece.xml"!', E_USER_ERROR);
		}
		$this->config = $this->config['SETTINGS'];
		unset($this->config['SETTINGS']);

		// Static settings
		$this->config['LineHeight'] = 1.8;

		$aseco->console('[RecordsEyepiece] ********************************************************');
		$aseco->console('[RecordsEyepiece] Starting version '. $this->getVersion() .' - Maniaplanet');
		$aseco->console('[RecordsEyepiece] Parsed "config/records_eyepiece.xml" successfully, starting checks...');

		if ( !isset($this->config['MUSIC_WIDGET'][0]['ADVERTISE'][0]) ) {
			$this->config['MUSIC_WIDGET'][0]['ADVERTISE'][0] = 'true';
		}

		// Transform 'TRUE' or 'FALSE' from string to boolean
		$this->config['MAP_WIDGET'][0]['ENABLED'][0]					= ((strtoupper($this->config['MAP_WIDGET'][0]['ENABLED'][0]) == 'TRUE')					? true : false);
		$this->config['CLOCK_WIDGET'][0]['RACE'][0]['ENABLED'][0]			= ((strtoupper($this->config['CLOCK_WIDGET'][0]['RACE'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['CLOCK_WIDGET'][0]['SCORE'][0]['ENABLED'][0]			= ((strtoupper($this->config['CLOCK_WIDGET'][0]['SCORE'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['NEXT_ENVIRONMENT_WIDGET'][0]['ENABLED'][0]			= ((strtoupper($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['NEXT_GAMEMODE_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['NEXT_GAMEMODE_WIDGET'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['WINNING_PAYOUT'][0]['ENABLED'][0]				= ((strtoupper($this->config['WINNING_PAYOUT'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['OPERATOR'][0]			= ((strtoupper($this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['OPERATOR'][0]) == 'TRUE')		? true : false);
		$this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['ADMIN'][0]			= ((strtoupper($this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['ADMIN'][0]) == 'TRUE')			? true : false);
		$this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['MASTERADMIN'][0]		= ((strtoupper($this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['MASTERADMIN'][0]) == 'TRUE')		? true : false);
		$this->config['DONATION_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['DONATION_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['MULTILAP_INFO_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['MULTILAP_INFO_WIDGET'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['SPECTATOR_INFO_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['SPECTATOR_INFO_WIDGET'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['VISITORS_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['VISITORS_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['FAVORITE_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['FAVORITE_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['TOPLIST_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['TOPLIST_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['MANIAEXCHANGE_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['MANIAEXCHANGE_WIDGET'][0]['ENABLED'][0]) == 'TRUE')			? true : false);
		$this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['MUSIC_WIDGET'][0]['ENABLED'][0]					= ((strtoupper($this->config['MUSIC_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['MUSIC_WIDGET'][0]['ADVERTISE'][0]				= ((strtoupper($this->config['MUSIC_WIDGET'][0]['ADVERTISE'][0]) == 'TRUE')				? true : false);
		$this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0]				= ((strtoupper($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0]) == 'TRUE')				? true : false);
		$this->config['NICEMODE'][0]['ENABLED'][0]					= ((strtoupper($this->config['NICEMODE'][0]['ENABLED'][0]) == 'TRUE')					? true : false);
		$this->config['NICEMODE'][0]['FORCE'][0]					= ((strtoupper($this->config['NICEMODE'][0]['FORCE'][0]) == 'TRUE')					? true : false);
		$this->config['STYLE'][0]['WINDOW'][0]['LIGHTBOX'][0]['ENABLED'][0]		= ((strtoupper($this->config['STYLE'][0]['WINDOW'][0]['LIGHTBOX'][0]['ENABLED'][0]) == 'TRUE')		? true : false);
		$this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['DISPLAY'][0]		= ((strtoupper($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['DISPLAY'][0]) == 'AVERAGE')	? true : false);
		$this->config['UI_PROPERTIES'][0]['MAP_INFO'][0]				= ((strtoupper($this->config['UI_PROPERTIES'][0]['MAP_INFO'][0]) == 'TRUE')				? true : false);
		$this->config['UI_PROPERTIES'][0]['ROUND_SCORES'][0]				= ((strtoupper($this->config['UI_PROPERTIES'][0]['ROUND_SCORES'][0]) == 'TRUE')				? true : false);
		$this->config['UI_PROPERTIES'][0]['WARMUP'][0]					= ((strtoupper($this->config['UI_PROPERTIES'][0]['WARMUP'][0]) == 'TRUE')				? true : false);
		$this->config['UI_PROPERTIES'][0]['ENDMAP_LADDER_RECAP'][0]			= ((strtoupper($this->config['UI_PROPERTIES'][0]['ENDMAP_LADDER_RECAP'][0]) == 'TRUE')			? true : false);
		$this->config['UI_PROPERTIES'][0]['MULTILAP_INFO'][0]				= ((strtoupper($this->config['UI_PROPERTIES'][0]['MULTILAP_INFO'][0]) == 'TRUE')			? true : false);
		$this->config['FEATURES'][0]['MARK_ONLINE_PLAYER_RECORDS'][0]			= ((strtoupper($this->config['FEATURES'][0]['MARK_ONLINE_PLAYER_RECORDS'][0]) == 'TRUE')		? true : false);
		$this->config['FEATURES'][0]['ILLUMINATE_NAMES'][0]				= ((strtoupper($this->config['FEATURES'][0]['ILLUMINATE_NAMES'][0]) == 'TRUE')				? true : false);
		$this->config['FEATURES'][0]['NUMBER_FORMAT'][0]				= strtolower($this->config['FEATURES'][0]['NUMBER_FORMAT'][0]);
		$this->config['FEATURES'][0]['SHORTEN_NUMBERS'][0]				= ((strtoupper($this->config['FEATURES'][0]['SHORTEN_NUMBERS'][0]) == 'TRUE')				? true : false);
		$this->config['FEATURES'][0]['SONGLIST'][0]['SORTING'][0]			= ((strtoupper($this->config['FEATURES'][0]['SONGLIST'][0]['SORTING'][0]) == 'TRUE')			? true : false);
		$this->config['FEATURES'][0]['SONGLIST'][0]['FORCE_SONGLIST'][0]		= ((strtoupper($this->config['FEATURES'][0]['SONGLIST'][0]['FORCE_SONGLIST'][0]) == 'TRUE')		? true : false);
		$this->config['FEATURES'][0]['MAPLIST'][0]['SORTING'][0]			= strtoupper($this->config['FEATURES'][0]['MAPLIST'][0]['SORTING'][0]);
		$this->config['FEATURES'][0]['MAPLIST'][0]['FORCE_MAPLIST'][0]			= ((strtoupper($this->config['FEATURES'][0]['MAPLIST'][0]['FORCE_MAPLIST'][0]) == 'TRUE')		? true : false);
		$this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ENABLED'][0]	= ((strtoupper($this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ENABLED'][0]) == 'TRUE')	? true : false);
		$this->config['FEATURES'][0]['KARMA'][0]['CALCULATION_METHOD'][0]		= strtolower($this->config['FEATURES'][0]['KARMA'][0]['CALCULATION_METHOD'][0]);


		// Autodisable unsupported Widgets in some Gamemodes
		$this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0]['CHASE'][0]['ENABLED'][0]		= 'false';
		$this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0]['CHASE'][0]['ENABLED'][0]		= 'false';
		$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['CHASE'][0]['ENABLED'][0]		= 'false';
		$this->config['ROUND_SCORE'][0]['GAMEMODE'][0]['TIME_ATTACK'][0]['ENABLED'][0]		= 'false';
		$this->config['ROUND_SCORE'][0]['GAMEMODE'][0]['KNOCKOUT'][0]['ENABLED'][0]		= 'false';
		$this->config['ROUND_SCORE'][0]['GAMEMODE'][0]['DOPPLER'][0]['ENABLED'][0]		= 'false';

		$widgets = array('DEDIMANIA_RECORDS', 'LOCAL_RECORDS', 'LIVE_RANKINGS', 'ROUND_SCORE');
		$gamemodes = array(
			'ROUNDS'	=> Gameinfo::ROUNDS,
			'TIME_ATTACK'	=> Gameinfo::TIME_ATTACK,
			'TEAM'		=> Gameinfo::TEAM,
			'LAPS'		=> Gameinfo::LAPS,
			'CUP'		=> Gameinfo::CUP,
			'TEAM_ATTACK'	=> Gameinfo::TEAM_ATTACK,
			'CHASE'		=> Gameinfo::CHASE,
			'KNOCKOUT'	=> Gameinfo::KNOCKOUT,
			'DOPPLER'	=> Gameinfo::DOPPLER,
		);

		// RecordWidgets like Dedimania...
		foreach ($gamemodes as $gamemode => $id) {
			foreach ($widgets as $widget) {
				if ( isset($this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0]) ) {
					$this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] = ((strtoupper($this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0]) == 'TRUE') ? true : false);

					// Topcount are required to be lower then entries.
					// But not in 'Team', both need to be '2'
					if ( (isset($this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0])) && (isset($this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0])) ) {
						if ( ($widget == 'LIVE_RANKINGS') && ($gamemode == 'TEAM') ) {
							$this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] = 2;
							$this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0] = 2;
						}
						else {
							if ($this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0] >= $this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0]) {
								$this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0] = $this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] - 1;
							}
						}
					}

					// Setup scale factor
					if ( (!isset($this->config[$widget][0]['SCALE'][0])) || ($this->config[$widget][0]['SCALE'][0] > 1.0) ) {
						$this->config[$widget][0]['SCALE'][0] = 1.0;
					}
					$this->config[$widget][0]['SCALE'][0] = (float)$this->config[$widget][0]['SCALE'][0];
				}
				else {
					// Auto disable this
					$this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] = false;
					$this->config[$widget][0]['WIDTH'][0] = 0;
					$aseco->console('[RecordsEyepiece] » Auto disable <'. strtolower($widget) .'> in gamemode "'. strtolower($gamemode) .'", missing entry.');
				}
			}
		}
		unset($id, $widget);

		// Special checks for <rounds>
		if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['ROUNDS'][0]['ENABLED'][0] == true) {
			$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['ROUNDS'][0]['DISPLAY_TYPE'][0] = ((strtoupper($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['ROUNDS'][0]['DISPLAY_TYPE'][0]) == 'TIME') ? true : false);
			$format = ((isset($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['ROUNDS'][0]['FORMAT'][0])) ? $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['ROUNDS'][0]['FORMAT'][0] : false);
			if ( (preg_match('/\{score\}/', $format) === 0) && ((preg_match('/\{remaining\}/', $format) === 0) || (preg_match('/\{pointlimit\}/', $format) === 0)) ) {
				// Setup default
				$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['ROUNDS'][0]['FORMAT'][0] = '{score} ({remaining})';
				$aseco->console('[RecordsEyepiece] » LiveRankingsWidget placeholder not (complete) found, setup default format: "{score} ({remaining})"');
			}
		}

		// Special checks for <laps>
		if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['LAPS'][0]['ENABLED'][0] == true) {
			$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['LAPS'][0]['DISPLAY_TYPE'][0] = ((strtoupper($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0]['LAPS'][0]['DISPLAY_TYPE'][0]) == 'TIME') ? true : false);
		}

		// Check all Widgets in NiceMode
		foreach ($widgets as $widget) {
			if ( isset($this->config['NICEMODE'][0]['ALLOW'][0][$widget][0]) ) {
				$this->config['NICEMODE'][0]['ALLOW'][0][$widget][0] = ((strtoupper($this->config['NICEMODE'][0]['ALLOW'][0][$widget][0]) == 'TRUE') ? true : false);
			}
		}
		unset($widget);

		// All Scoretable-Lists
		$scorelists = array('TOP_AVERAGE_TIMES', 'DEDIMANIA_RECORDS', 'LOCAL_RECORDS', 'TOP_RANKINGS', 'TOP_WINNERS', 'MOST_RECORDS', 'MOST_FINISHED', 'TOP_PLAYTIME', 'TOP_DONATORS', 'TOP_NATIONS', 'TOP_CONTINENTS', 'TOP_MAPS', 'TOP_VOTERS', 'TOP_VISITORS', 'TOP_ACTIVE_PLAYERS', 'TOP_WINNING_PAYOUTS', 'TOP_BETWINS', 'TOP_ROUNDSCORE');
		foreach ($scorelists as $widget) {
			if ( isset($this->config['SCORETABLE_LISTS'][0][$widget][0]['ENABLED'][0]) ) {
				$this->config['SCORETABLE_LISTS'][0][$widget][0]['ENABLED'][0] = ((strtoupper($this->config['SCORETABLE_LISTS'][0][$widget][0]['ENABLED'][0]) == 'TRUE') ? true : false);
			}
			else {
				// Auto disable this
				$this->config['SCORETABLE_LISTS'][0][$widget][0]['ENABLED'][0] = false;
				$aseco->console('[RecordsEyepiece] » Auto disable <'. strtolower($widget) .'> from <scoretable_lists>, missing entry.');
			}

			// Setup scale factor
			if ( (!isset($this->config['SCORETABLE_LISTS'][0][$widget][0]['SCALE'][0])) || ($this->config['SCORETABLE_LISTS'][0][$widget][0]['SCALE'][0] > 1.0) ) {
				$this->config['SCORETABLE_LISTS'][0][$widget][0]['SCALE'][0] = 1.0;
			}
			$this->config['SCORETABLE_LISTS'][0][$widget][0]['SCALE'][0] = sprintf("%.1f", $this->config['SCORETABLE_LISTS'][0][$widget][0]['SCALE'][0]);
		}
		unset($widget);
		unset($scorelists);


		// Translate e.g. 'rounds' to id '1', 'time_attack' to id '2'...
		foreach ($widgets as $widget) {
			foreach ($gamemodes as $gamemode => $id) {
				if ( isset($this->config[$widget][0]['GAMEMODE'][0][$gamemode]) ) {
					$this->config[$widget][0]['GAMEMODE'][0][$id] = $this->config[$widget][0]['GAMEMODE'][0][$gamemode];
					unset($this->config[$widget][0]['GAMEMODE'][0][$gamemode]);
				}
			}
		}
		unset($widgets, $widget, $id);


		// Autodisable unsupported Widgets in some Gamemodes
		$this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][Gameinfo::CHASE][0]['ENABLED'][0]	= false;
		$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][Gameinfo::CHASE][0]['ENABLED'][0]	= false;
		$this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::TIME_ATTACK][0]['ENABLED'][0]	= false;
		$this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::KNOCKOUT][0]['ENABLED'][0]	= false;
		$this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::DOPPLER][0]['ENABLED'][0]	= false;


		// Register /emusic chat command if the MusicWidget is enabled
		if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
			if (!isset($aseco->plugins['PluginMusicServer'])) {
				if ($reload !== true) {
					$aseco->console('[RecordsEyepiece] » Plugin MusicServer is not available, hide <music_widget>.');
				}
				$this->config['MUSIC_WIDGET'][0]['ENABLED'][0] = false;
			}
			else {
				if ($reload !== true) {
					$aseco->console('[RecordsEyepiece] » Registering chat command "/emusic", because <music_widget> is enabled too.');
					$aseco->registerChatCommand('emusic', array($this, 'chat_emusic'), 'Lists musics currently on the server (see: /eyepiece)', Player::PLAYERS);
				}
			}
		}


		// Check the Widget width's
		if ( ($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] < 15.5) || (!$this->config['MUSIC_WIDGET'][0]['WIDTH'][0]) ) {
			$this->config['MUSIC_WIDGET'][0]['WIDTH'][0] = 15.5;
		}
		if ( ($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] < 15.5) || (!$this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0]) ) {
			$this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] = 15.5;
		}
		if ( ($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] < 15.5) || (!$this->config['LOCAL_RECORDS'][0]['WIDTH'][0]) ) {
			$this->config['LOCAL_RECORDS'][0]['WIDTH'][0] = 15.5;
		}
		if ( ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] < 15.5) || (!$this->config['LIVE_RANKINGS'][0]['WIDTH'][0]) ) {
			$this->config['LIVE_RANKINGS'][0]['WIDTH'][0] = 15.5;
		}
		if ( ($this->config['ROUND_SCORE'][0]['WIDTH'][0] < 15.5) || (!$this->config['ROUND_SCORE'][0]['WIDTH'][0]) ) {
			$this->config['ROUND_SCORE'][0]['WIDTH'][0] = 15.5;
		}

		if ( (!isset($this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0])) || ($this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0] == '') ) {
			$this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0] = 0;
		}
		if ( (!isset($this->config['FEATURES'][0]['KARMA'][0]['MIN_VOTES'][0])) || ($this->config['FEATURES'][0]['KARMA'][0]['MIN_VOTES'][0] == '') ) {
			$this->config['FEATURES'][0]['KARMA'][0]['MIN_VOTES'][0] = 0;
		}
		if ( (!isset($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0])) || ($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0] == '') ) {
			$this->config['FEATURES'][0]['TOPLIST_LIMIT'][0] = 5000;
		}

		// Check for additional Features
		if ( ($this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0] < 0) || (!$this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0]) ) {
			$this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0] = 0;
		}
		else {
			$this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0] = (int)$this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0];
		}

		// Check for Background-Colors
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_DEFAULT'][0] == '') {
			$this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_DEFAULT'][0] = '0000';
		}
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_FOCUS'][0] == '') {
			$this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_FOCUS'][0] = '0000';
		}

		// Check for additional settings
		if ($this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ENABLED'][0] == true) {
			if (($this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ACCESS_URL'][0] == '') || (preg_match('/^http.*/', $this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ACCESS_URL'][0]) === 0) ) {
				// Autodisable
				$this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ENABLED'][0] = false;
				$aseco->console('[RecordsEyepiece] » Setup for <features><maplist><mapimages><access_url> is not correct in "records_eyepiece.xml"');
			}
		}
		if (!isset($this->config['FEATURES'][0]['MAPLIST'][0]['AUTHOR_DISPLAY'][0]) || empty($this->config['FEATURES'][0]['MAPLIST'][0]['AUTHOR_DISPLAY'][0])) {
			$this->config['FEATURES'][0]['MAPLIST'][0]['AUTHOR_DISPLAY'][0] = 'nickname';
		}
		if ($this->config['MAP_WIDGET'][0]['ENABLED'][0] == true) {
			if ( (isset($this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0])) && (strtoupper($this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0]) == 'NEXT') ) {
				$this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0] = 'next';
			}
			else if ( (isset($this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0])) && (strtoupper($this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0]) == 'CURRENT') ) {
				$this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0] = 'current';
			}
			else {
				$this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0] = 'next';
			}

			if ( (!isset($this->config['MAP_WIDGET'][0]['RACE'][0]['SCALE'][0])) || ($this->config['MAP_WIDGET'][0]['RACE'][0]['SCALE'][0] > 1.0) ) {
				$this->config['MAP_WIDGET'][0]['RACE'][0]['SCALE'][0] = 1.0;
			}
			if ( (!isset($this->config['MAP_WIDGET'][0]['SCORE'][0]['SCALE'][0])) || ($this->config['MAP_WIDGET'][0]['SCORE'][0]['SCALE'][0] > 1.0) ) {
				$this->config['MAP_WIDGET'][0]['SCORE'][0]['SCALE'][0] = 1.0;
			}
			$this->config['MAP_WIDGET'][0]['RACE'][0]['SCALE'][0] = sprintf("%.1f", $this->config['MAP_WIDGET'][0]['RACE'][0]['SCALE'][0]);
			$this->config['MAP_WIDGET'][0]['SCORE'][0]['SCALE'][0] = sprintf("%.1f", $this->config['MAP_WIDGET'][0]['SCORE'][0]['SCALE'][0]);
		}

		if ( (!isset($this->config['MUSIC_WIDGET'][0]['SCALE'][0])) || ($this->config['MUSIC_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['MUSIC_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['MUSIC_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['MUSIC_WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['SCALE'][0])) || ($this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['DONATION_WIDGET'][0]['WIDGET'][0]['SCALE'][0])) || ($this->config['DONATION_WIDGET'][0]['WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['DONATION_WIDGET'][0]['WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['DONATION_WIDGET'][0]['WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['MANIAEXCHANGE_WIDGET'][0]['SCALE'][0])) || ($this->config['MANIAEXCHANGE_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['MANIAEXCHANGE_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['MANIAEXCHANGE_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['MANIAEXCHANGE_WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['TOPLIST_WIDGET'][0]['SCALE'][0])) || ($this->config['TOPLIST_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['TOPLIST_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['TOPLIST_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['TOPLIST_WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['MAPCOUNT_WIDGET'][0]['SCALE'][0])) || ($this->config['MAPCOUNT_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['MAPCOUNT_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['MAPCOUNT_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['MAPCOUNT_WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['VISITORS_WIDGET'][0]['SCALE'][0])) || ($this->config['VISITORS_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['VISITORS_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['VISITORS_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['VISITORS_WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['CLOCK_WIDGET'][0]['RACE'][0]['SCALE'][0])) || ($this->config['CLOCK_WIDGET'][0]['RACE'][0]['SCALE'][0] > 1.0) ) {
			$this->config['CLOCK_WIDGET'][0]['RACE'][0]['SCALE'][0] = 1.0;
		}
		$this->config['CLOCK_WIDGET'][0]['RACE'][0]['SCALE'][0] = sprintf("%.1f", $this->config['CLOCK_WIDGET'][0]['RACE'][0]['SCALE'][0]);
		if ( (!isset($this->config['CLOCK_WIDGET'][0]['SCORE'][0]['SCALE'][0])) || ($this->config['CLOCK_WIDGET'][0]['SCORE'][0]['SCALE'][0] > 1.0) ) {
			$this->config['CLOCK_WIDGET'][0]['SCORE'][0]['SCALE'][0] = 1.0;
		}
		$this->config['CLOCK_WIDGET'][0]['SCORE'][0]['SCALE'][0] = sprintf("%.1f", $this->config['CLOCK_WIDGET'][0]['SCORE'][0]['SCALE'][0]);
		if ( (!isset($this->config['FAVORITE_WIDGET'][0]['RACE'][0]['SCALE'][0])) || ($this->config['FAVORITE_WIDGET'][0]['RACE'][0]['SCALE'][0] > 1.0) ) {
			$this->config['FAVORITE_WIDGET'][0]['RACE'][0]['SCALE'][0] = 1.0;
		}
		$this->config['FAVORITE_WIDGET'][0]['RACE'][0]['SCALE'][0] = sprintf("%.1f", $this->config['FAVORITE_WIDGET'][0]['RACE'][0]['SCALE'][0]);
		if ( (!isset($this->config['FAVORITE_WIDGET'][0]['SCORE'][0]['SCALE'][0])) || ($this->config['FAVORITE_WIDGET'][0]['SCORE'][0]['SCALE'][0] > 1.0) ) {
			$this->config['FAVORITE_WIDGET'][0]['SCORE'][0]['SCALE'][0] = 1.0;
		}
		$this->config['FAVORITE_WIDGET'][0]['SCORE'][0]['SCALE'][0] = sprintf("%.1f", $this->config['FAVORITE_WIDGET'][0]['SCORE'][0]['SCALE'][0]);
		if ( (!isset($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['SCALE'][0])) || ($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['NEXT_ENVIRONMENT_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['NEXT_ENVIRONMENT_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['NEXT_ENVIRONMENT_WIDGET'][0]['SCALE'][0]);
		if ( (!isset($this->config['NEXT_GAMEMODE_WIDGET'][0]['SCALE'][0])) || ($this->config['NEXT_GAMEMODE_WIDGET'][0]['SCALE'][0] > 1.0) ) {
			$this->config['NEXT_GAMEMODE_WIDGET'][0]['SCALE'][0] = 1.0;
		}
		$this->config['NEXT_GAMEMODE_WIDGET'][0]['SCALE'][0] = sprintf("%.1f", $this->config['NEXT_GAMEMODE_WIDGET'][0]['SCALE'][0]);

		if ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
			// Check setup Limits
			if ( (!$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MINIMUM_AMOUNT'][0]) || ($this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MINIMUM_AMOUNT'][0] < 3) ) {
				$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MINIMUM_AMOUNT'][0] = 3;
			}
			if ( !$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RANK_LIMIT'][0] ) {
				$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RANK_LIMIT'][0] = 0;
			}
			if ( !$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MAXIMUM_PLANETS'][0] ) {
				$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MAXIMUM_PLANETS'][0] = 1000000;	// Set to unlimited
			}
			if ( !$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RESET_LIMIT'][0] ) {
				$this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RESET_LIMIT'][0] = 0;		// Disable
			}

			// Check setup Planets
			if ( (!$this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['FIRST'][0]) || ($this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['FIRST'][0] < 20) ) {
				$this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['FIRST'][0] = 20;
			}
			if ( (!$this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['SECOND'][0]) || ($this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['SECOND'][0] < 15) ) {
				$this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['SECOND'][0] = 15;
			}
			if ( (!$this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['THIRD'][0]) || ($this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['THIRD'][0] < 10) ) {
				$this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['THIRD'][0] = 10;
			}
			if ( (!$this->config['WINNING_PAYOUT'][0]['MINIMUM_SERVER_PLANETS'][0]) || ($this->config['WINNING_PAYOUT'][0]['MINIMUM_SERVER_PLANETS'][0] < 50) ) {
				$this->config['WINNING_PAYOUT'][0]['MINIMUM_SERVER_PLANETS'][0] = 50;
			}

			// Check for the max. length (256 signs) of <messages><winning_mail_body>
			$message = $aseco->formatText($this->config['MESSAGES'][0]['WINNING_MAIL_BODY'][0],
				9999,
				$aseco->server->login,
				$aseco->server->name
			);
			$message = str_replace('{br}', "%0A", $message);  // split long message
			$message = $aseco->formatColors($message);
			if (strlen($message) >= 256) {
				trigger_error('[RecordsEyepiece] » The <messages><winning_mail_body> is '. strlen($message) .' signs long (incl. the replaced placeholder), please remove '. (strlen($message) - 256) .' signs to fit into 256 signs limit!', E_USER_ERROR);
			}
		}


		// Initialise States
		$this->config['States']['DedimaniaRecords']['NeedUpdate']		= true;			// Interact with onDedimaniaRecord and onDediRecsLoaded
		$this->config['States']['DedimaniaRecords']['UpdateDisplay']		= true;
		$this->config['States']['LocalRecords']['NeedUpdate']			= true;			// Interact with onLocalRecord
		$this->config['States']['LocalRecords']['UpdateDisplay']		= true;
		$this->config['States']['LocalRecords']['NoRecordsFound']		= false;
		$this->config['States']['LocalRecords']['ChkSum']			= false;
		$this->config['States']['LiveRankings']['NeedUpdate']			= true;			// Interact with onPlayerFinish
		$this->config['States']['LiveRankings']['UpdateDisplay']		= true;
		$this->config['States']['LiveRankings']['NoRecordsFound']		= false;
		$this->config['States']['WarmUpPhase']					= false;
		$this->config['States']['TopMaps']['NeedUpdate']			= true;			// Interact with onKarmaChange
		$this->config['States']['TopVoters']['NeedUpdate']			= true;			// Interact with onKarmaChange
		$this->config['States']['MusicServerPlaylist']['NeedUpdate']		= false;
		$this->config['States']['NiceMode']					= false;
		$this->config['States']['RefreshTimestampRecordWidgets']		= -1000;		// Update now :D
		$this->config['States']['RefreshTimestampPreload']			= time();
		$this->config['States']['MaplistRefreshProgressed']			= false;

		// Preset the Placeholder which can be used in <placement>, filled later when info loaded by XAseco
		$this->config['PlacementPlaceholders']['MAP_MX_PREFIX']			= false;
		$this->config['PlacementPlaceholders']['MAP_MX_ID']			= false;
		$this->config['PlacementPlaceholders']['MAP_MX_PAGEURL']		= false;
		$this->config['PlacementPlaceholders']['MAP_NAME']			= false;
		$this->config['PlacementPlaceholders']['MAP_UID']			= false;

		// Definitions of Icon- and Title-Positions for the RecordWidgets
		$this->config['Positions'] = array(
			'left'	=> array(
				'icon'		=> array(
					'x'		=> 2.8,
					'y'		=> -2.53125
				),
				'title'		=> array(
					'x'		=> 5.6,
					'y'		=> -1.3125,
					'halign'	=> 'left'
				),
				'image_open'	=> array(
					'x'		=> -0.5,
					'image'		=> $this->config['IMAGES'][0]['WIDGET_OPEN_LEFT'][0]
				)
			),
			'right'	=> array(
				'icon'		=> array(
					'x'		=> -2.8,
					'y'		=> -2.53125
				),
				'title'		=> array(
					'x'		=> -5.6,
					'y'		=> -1.3125,
					'halign'	=> 'right'
				),
				'image_open'	=> array(
					'x'		=> -8.25,
					'image'		=> $this->config['IMAGES'][0]['WIDGET_OPEN_RIGHT'][0]
				)
			)
		);


		// Define the formats for number_format()
		$this->config['NumberFormat'] = array(
			'english'	=> array(
				'decimal_sep'	=> '.',
				'thousands_sep'	=> ',',
			),
			'german'	=> array(
				'decimal_sep'	=> ',',
				'thousands_sep'	=> '.',
			),
			'french'	=> array(
				'decimal_sep'	=> ',',
				'thousands_sep'	=> ' ',
			),
		);


		// Load the templates
		$this->loadTemplates();


		// Initialise DataArrays
		$this->scores['DedimaniaRecords']		= array();
		$this->scores['LocalRecords']			= array();
		$this->scores['LiveRankings']			= array();
		$this->scores['RoundScore']			= array();
		$this->scores['RoundScorePB']			= array();
		$this->scores['TopAverageTimes']		= array();
		$this->scores['TopRankings']			= array();
		$this->scores['TopWinners']			= array();
		$this->scores['MostRecords']			= array();
		$this->scores['MostFinished']			= array();
		$this->scores['TopPlaytime']			= array();
		$this->scores['TopDonators']			= array();
		$this->scores['TopNations']			= array();
		$this->scores['TopMaps']			= array();
		$this->scores['TopVoters']			= array();
		$this->scores['TopBetwins']			= array();
		$this->scores['TopRoundscore']			= array();
		$this->scores['TopVisitors']			= array();
		$this->scores['TopContinents']			= array();
		$this->scores['TopActivePlayers']		= array();
		$this->scores['TopWinningPayouts']		= array();

		// Init Cache
		$this->cache['SpectatorOverview']		= array();
		$this->cache['WarmUpInfoWidget']		= false;
		$this->cache['MultiLapInfoWidget']		= false;
		$this->cache['MusicWidget']			= false;
		$this->cache['ToplistWidget']			= false;
		$this->cache['VisitorsWidget']			= false;
		$this->cache['ManiaExchangeWidget']		= false;
		$this->cache['MapcountWidget']			= false;
		$this->cache['TopRankings']			= false;
		$this->cache['TopWinners']			= false;
		$this->cache['TopPlaytime']			= false;
		$this->cache['TopNations']			= false;
		$this->cache['TopMaps']				= false;
		$this->cache['TopVoters']			= false;
		$this->cache['TopWinningPayouts']		= false;
		$this->cache['TopVisitors']			= false;
		$this->cache['TopContinents']			= false;
		$this->cache['TopActivePlayers']		= false;
		$this->cache['TopBetwins']			= false;
		$this->cache['TopRoundscore']			= false;
		$this->cache['MapWidget']['Race']		= false;
		$this->cache['MapWidget']['Window']		= false;
		$this->cache['MapWidget']['Score']		= false;
		$this->cache['AddToFavoriteWidget']['Race']	= false;
		$this->cache['AddToFavoriteWidget']['Score']	= false;
		$this->cache['DonationWidget']			= false;
		$this->cache['PlayerStates']			= array();
		$this->cache['MusicServerPlaylist']		= array();
		$this->cache['MapAuthors']			= array();
		$this->cache['CurrentRankings']			= array();
		$this->cache['MapAuthorNation']			= $this->loadPlayerNations();
		if ( !isset($this->cache['PlayerWinnings']) ) {
			// Only setup if unset, otherwise it is overridden by "/eyeset reload"!
			$this->cache['PlayerWinnings']		= array();
		}

		// Setup the RecordWidgets and prebuild all enabled Gamemodes
		$aseco->console('[RecordsEyepiece] » Build and cache all Widget bodies...');
		$this->cache['DedimaniaRecords']['NiceMode']	= false;
		$this->cache['LocalRecords']['NiceMode']	= false;
		$this->cache['LiveRankings']['NiceMode']	= false;
		$widgets = array('DEDIMANIA_RECORDS', 'LOCAL_RECORDS', 'LIVE_RANKINGS', 'ROUND_SCORE');
		foreach ($widgets as $widget) {
			foreach ($gamemodes as $gamemode => $id) {
				if ( ($widget == 'DEDIMANIA_RECORDS') && (($this->config[$widget][0]['GAMEMODE'][0][$id][0]['ENABLED'][0] == true) || (($this->config['NICEMODE'][0]['ALLOW'][0]['DEDIMANIA_RECORDS'][0] == true) && ($this->config['States']['NiceMode'] == true))) ) {
					$build = $this->buildDedimaniaRecordsWidgetBody($id);
					$this->cache['DedimaniaRecords'][$id]['WidgetHeader'] = $build['header'];
					$this->cache['DedimaniaRecords'][$id]['WidgetFooter'] = $build['footer'];
				}
				if ( ($widget == 'LOCAL_RECORDS') && (($this->config[$widget][0]['GAMEMODE'][0][$id][0]['ENABLED'][0] == true) || (($this->config['NICEMODE'][0]['ALLOW'][0]['LOCAL_RECORDS'][0] == true) && ($this->config['States']['NiceMode'] == true))) ) {
					$build = $this->buildLocalRecordsWidgetBody($id);
					$this->cache['LocalRecords'][$id]['WidgetHeader'] = $build['header'];
					$this->cache['LocalRecords'][$id]['WidgetFooter'] = $build['footer'];
				}
				if ( ($widget == 'LIVE_RANKINGS') && (($this->config[$widget][0]['GAMEMODE'][0][$id][0]['ENABLED'][0] == true) || (($this->config['NICEMODE'][0]['ALLOW'][0]['LIVE_RANKINGS'][0] == true) && ($this->config['States']['NiceMode'] == true))) ) {
					$build = $this->buildLiveRankingsWidgetBody($id);
					$this->cache['LiveRankings'][$id]['WidgetHeader'] = $build['header'];
					$this->cache['LiveRankings'][$id]['WidgetFooter'] = $build['footer'];
				}
				if ( ($widget == 'ROUND_SCORE') && ($this->config[$widget][0]['GAMEMODE'][0][$id][0]['ENABLED'][0] == true) ) {
					$build = $this->buildRoundScoreWidgetBody($id, 'RACE');
					$this->cache['RoundScore'][$id]['Race']['WidgetHeader'] = $build['header'];
					$this->cache['RoundScore'][$id]['Race']['WidgetFooter'] = $build['footer'];

					$build = $this->buildRoundScoreWidgetBody($id, 'WARMUP');
					$this->cache['RoundScore'][$id]['WarmUp']['WidgetHeader'] = $build['header'];
					$this->cache['RoundScore'][$id]['WarmUp']['WidgetFooter'] = $build['footer'];
				}
			}
		}
		unset($widgets, $widget, $gamemode, $id);


		// Make sure refresh's are set, otherwise set default
		$this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] = ((isset($this->config['FEATURES'][0]['REFRESH_INTERVAL'][0])) ? (int)$this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] : 10);
		$this->config['NICEMODE'][0]['REFRESH_INTERVAL'][0] = ((isset($this->config['NICEMODE'][0]['REFRESH_INTERVAL'][0])) ? (int)$this->config['NICEMODE'][0]['REFRESH_INTERVAL'][0] : 10);

		// Store the default refresh interval, in NiceMode the $this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] are replaced
		$this->config['REFRESH_INTERVAL_DEFAULT'][0] = $this->config['FEATURES'][0]['REFRESH_INTERVAL'][0];

		// Stores $this->getCurrentSong() the ListMethod GetForcedMusic()
		$this->config['CurrentMusicInfos'] = array(
			'Artist'	=> 'unknown',
			'Title'		=> 'unknown',
		);

		$this->cache['Map']['Jukebox']		= false;
		$this->cache['Map']['NbCheckpoints']	= 0;
		$this->cache['Map']['NbLaps']		= 0;
		$this->cache['Map']['ForcedLaps']	= 0;

		$this->config['Gamemodes'] = array(
			Gameinfo::ROUNDS	=> array('name' => 'ROUNDS',		'icon' => 'RT_Rounds'),
			Gameinfo::TIME_ATTACK	=> array('name' => 'TIME ATTACK',	'icon' => 'RT_TimeAttack'),
			Gameinfo::TEAM		=> array('name' => 'TEAM',		'icon' => 'RT_Team'),
			Gameinfo::LAPS		=> array('name' => 'LAPS',		'icon' => 'RT_Laps'),
			Gameinfo::CUP		=> array('name' => 'CUP',		'icon' => 'RT_Cup'),
			Gameinfo::TEAM_ATTACK	=> array('name' => 'TEAM ATTACK',	'icon' => 'RT_Team'),
			Gameinfo::CHASE		=> array('name' => 'CHASE',		'icon' => 'RT_Team'),
			Gameinfo::KNOCKOUT	=> array('name' => 'KNOCKOUT',		'icon' => 'RT_Rounds'),
			Gameinfo::DOPPLER	=> array('name' => 'DOPPLER',		'icon' => 'RT_TimeAttack'),
		);

		if ($reload === null) {
			$aseco->console('[RecordsEyepiece] » Checking Database for required extensions...');

			// Check the Database-Table for required extensions
			$fields = array();
			$result = $aseco->db->query('SHOW COLUMNS FROM `%prefix%players`;');
			if ($result) {
				while ($row = $result->fetch_row()) {
					$fields[] = $row[0];
				}
				$result->free_result();
			}

			// Add `MostFinished` column if not yet done
			if ( !in_array('MostFinished', $fields) ) {
				$aseco->console('[RecordsEyepiece] » Adding column `MostFinished`.');
				$aseco->db->query('ALTER TABLE `%prefix%players` ADD `MostFinished` MEDIUMINT(3) UNSIGNED NOT NULL DEFAULT "0" COMMENT "Added by plugin.records_eyepiece.php", ADD INDEX (`MostFinished`);');
			}
			else {
				$aseco->console('[RecordsEyepiece] » Found column `MostFinished`');
			}

			// Add `MostRecords` column if not yet done
			if ( !in_array('MostRecords', $fields) ) {
				$aseco->console('[RecordsEyepiece] » Adding column `MostRecords`.');
				$aseco->db->query('ALTER TABLE `%prefix%players` ADD `MostRecords` MEDIUMINT(3) UNSIGNED NOT NULL DEFAULT "0" COMMENT "Added by plugin.records_eyepiece.php", ADD INDEX (`MostRecords`);');
			}
			else {
				$aseco->console('[RecordsEyepiece] » Found column `MostRecords`.');
			}

			// Add `RoundPoints` column if not yet done
			if ( !in_array('RoundPoints', $fields) ) {
				$aseco->console('[RecordsEyepiece] » Adding column `RoundPoints`.');
				$aseco->db->query('ALTER TABLE `%prefix%players` ADD `RoundPoints` MEDIUMINT(3) UNSIGNED NOT NULL DEFAULT "0" COMMENT "Added by plugin.records_eyepiece.php", ADD INDEX (`RoundPoints`);');
			}
			else {
				$aseco->console('[RecordsEyepiece] » Found column `RoundPoints`.');
			}

			// Add `TeamPoints` column if not yet done
			if ( !in_array('TeamPoints', $fields) ) {
				$aseco->console('[RecordsEyepiece] » Adding column `TeamPoints`.');
				$aseco->db->query('ALTER TABLE `%prefix%players` ADD `TeamPoints` MEDIUMINT(3) UNSIGNED NOT NULL DEFAULT "0" COMMENT "Added by plugin.records_eyepiece.php", ADD INDEX (`TeamPoints`);');
			}
			else {
				$aseco->console('[RecordsEyepiece] » Found column `TeamPoints`.');
			}

			// Add `WinningPayout` column if not yet done
			if ( !in_array('WinningPayout', $fields) ) {
				$aseco->console('[RecordsEyepiece] » Adding column `WinningPayout`.');
				$aseco->db->query('ALTER TABLE `%prefix%players` ADD `WinningPayout` MEDIUMINT(3) UNSIGNED NOT NULL DEFAULT "0" COMMENT "Added by plugin.records_eyepiece.php", ADD INDEX (`WinningPayout`);');
			}
			else {
				$aseco->console('[RecordsEyepiece] » Found column `WinningPayout`.');
			}

			if ($this->config['SCORETABLE_LISTS'][0]['MOST_FINISHED'][0]['ENABLED'][0] == true) {
				// Update own `MostFinished`
				$aseco->console('[RecordsEyepiece] Updating `MostFinished` counts for all Players...');
				$mostfinished = array();
				$query = "
				SELECT
					`PlayerId`,
					COUNT(`Score`) AS `Count`
				FROM `%prefix%times`
				WHERE `GamemodeId` = ". $aseco->server->gameinfo->mode ."
				GROUP BY `PlayerId`;
				";
				$res = $aseco->db->query($query);
				if ($res) {
					if ($res->num_rows > 0) {
						while ($row = $res->fetch_object()) {
							$mostfinished[$row->PlayerId] = $row->Count;
						}
						$aseco->db->begin_transaction();	// Require PHP >= 5.5.0
						foreach ($mostfinished as $id => $count) {
							$res1 = $aseco->db->query("
								UPDATE `%prefix%players`
								SET `MostFinished` = ". $count ."
								WHERE `PlayerId` = ". $id ."
								LIMIT 1;
							");
						}
						$aseco->db->commit();
						unset($mostfinished);
					}
					$res->free_result();
				}
			}
			else {
				$aseco->console('[RecordsEyepiece] Skip updating `MostFinished` counts for all Players, because Widget is disabled.');
			}

			if ($this->config['SCORETABLE_LISTS'][0]['MOST_RECORDS'][0]['ENABLED'][0] == true) {
				// Update own `MostRecords`
				$aseco->console('[RecordsEyepiece] Updating `MostRecords` counts for all Players...');
				$mostrecords = array();
				$query = "
				SELECT
					`PlayerId`,
					COUNT(`Score`) AS `Count`
				FROM `%prefix%records`
				WHERE `GamemodeId` = ". $aseco->server->gameinfo->mode ."
				GROUP BY `PlayerId`;
				";
				$res = $aseco->db->query($query);
				if ($res) {
					if ($res->num_rows > 0) {
						while ($row = $res->fetch_object()) {
							$mostrecords[$row->PlayerId] = $row->Count;
						}
						$aseco->db->begin_transaction();	// Require PHP >= 5.5.0
						foreach ($mostrecords as $id => $count) {
							$res1 = $aseco->db->query("
								UPDATE `%prefix%players`
								SET `MostRecords` = ". $count ."
								WHERE `PlayerId` = ". $id ."
								LIMIT 1;
							");
						}
						$aseco->db->commit();
						unset($mostrecords);
					}
					$res->free_result();
				}
			}
			else {
				$aseco->console('[RecordsEyepiece] Skip updating `MostRecords` counts for all Players, because Widget is disabled.');
			}
		}


		// Check if is NiceMode been forced
		if ( ($this->config['NICEMODE'][0]['ENABLED'][0] == true) && ($this->config['NICEMODE'][0]['FORCE'][0] == true) ) {
			// Turn nicemode on
			$this->config['States']['NiceMode'] = true;

			// Set new refresh interval
			$this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] = $this->config['NICEMODE'][0]['REFRESH_INTERVAL'][0];

			$aseco->console('[RecordsEyepiece] Setup and forcing <nicemode>...');
		}


		if ( ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) && ( isset($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT']) ) ) {

			$aseco->console('[RecordsEyepiece] Checking entries for the <placement_widget>...');

			// Remove disabled <placement> (freed mem.) and setup for each <chat_command> entry an own id
			$new_placements = array();
			$chat_id = 1;	// Start ID for <chat_command>'s
			foreach ($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] as $placement) {
				if ( (isset($placement['ENABLED'][0])) && (strtoupper($placement['ENABLED'][0]) == 'TRUE') ) {

					if ( isset($placement['INCLUDE'][0]) ) {
						// WITH <include>: Check for min. required entries <display>, <include>,
						// skip if one was not found.
						if ( !isset($placement['DISPLAY'][0]) ) {
							$aseco->console('[RecordsEyepiece] » One of your <placement> did not have all min. required entries, missing <display>!');
							continue;
						}

						if ( !is_readable($placement['INCLUDE'][0]) ) {
							$aseco->console('[RecordsEyepiece] » One of your <placement> are unable to display, because the file "'. $placement['INCLUDE'][0] .'" at <include> could not be accessed!');
							continue;
						}
					}
					else {
						// WITHOUT <include>: Check for min. required entries <pos_x>, <pos_y>, <width> and <height>,
						// skip if one was not found.
						if ( ( !isset($placement['DISPLAY'][0]) ) || ( !isset($placement['POS_X'][0]) ) || ( !isset($placement['POS_Y'][0]) ) || ( !isset($placement['WIDTH'][0]) ) || ( !isset($placement['HEIGHT'][0]) ) ) {
							$aseco->console('[RecordsEyepiece] » One of your <placement> did not have all min. required entries, missing one of <pos_x>, <pos_y>, <width> or <height>!');
							continue;
						}
					}

					$placement['DISPLAY'][0] = strtoupper($placement['DISPLAY'][0]);

					// Transform all Gamemode-Names from e.g. 'TIME_ATTACK' to '2'
					foreach ($gamemodes as $gamemode => $id) {
						if ($placement['DISPLAY'][0] == $gamemode) {
							$placement['DISPLAY'][0] = $id;
						}
					}
					unset($id);

					// Remove empty and unused tags to free mem. too.
					foreach ($placement as $tag => $value) {
						if ($value[0] == '') {
							unset($placement[$tag]);
						}
					}
					unset($placement['ENABLED'], $placement['DESCRIPTION'], $value);

					// Skip this part from <placement> with <include> inside
					if ( !isset($placement['INCLUDE'][0]) ) {

						// Check for <layer> and adjust the min./max.
						if ( isset($placement['LAYER'][0]) ) {
							if ($placement['LAYER'][0] < -3) {
								$placement['LAYER'][0] = -3;	// Set min.
							}
							else if ($placement['LAYER'][0] > 20) {
								$placement['LAYER'][0] = 20;	// Set max.
							}
						}
						else {
							$placement['LAYER'][0] = 3;		// Set default
						}

						// If this <placement> has a <chat_command>, then setup an ID for this (max. 1 till 25)
						if ( (isset($placement['CHAT_COMMAND'][0])) && ($placement['CHAT_COMMAND'][0] != '') && ($chat_id <= 25) ) {
							$placement['CHAT_MLID'][0] = $chat_id;
							$chat_id ++;
						}
					}

					// Add Placentment
					$new_placements[] = $placement;
				}
			}
			$this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] = $new_placements;
			unset($new_placements, $placement);

			$aseco->console('[RecordsEyepiece] » Working on all <placement> with <display> "Always"...');
			$this->cache['PlacementWidget']['Always'] = $this->buildPlacementWidget('always');

			$aseco->console('[RecordsEyepiece] » Working on all <placement> with <display> "Race"...');
			$this->cache['PlacementWidget']['Race'] = $this->buildPlacementWidget('race');

			// Build all Placements for the Gamemodes
			foreach ($this->config['Gamemodes'] as $gamemode => $array) {
				$aseco->console('[RecordsEyepiece] » Working on all <placement> with <display> "'. str_replace(' ', '', ucwords(strtolower($array['name']))) .'"...');
				$this->cache['PlacementWidget'][$gamemode] = $this->buildPlacementWidget($gamemode);
			}
			// 'Score' is build at onEndMapRanking, because of the dependence of the placeholder
		}
		else {
			// Autodisable when there is no setup for <placement>
			$this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] = false;
		}


		// Setup the "no-score" Placeholder depending at the current Gamemode
		$this->config['PlaceholderNoScore'] = '-:--.---';


		// Setup 'map_info'
		if ( ($this->config['UI_PROPERTIES'][0]['MAP_INFO'][0] == false) || ($this->config['MAP_WIDGET'][0]['ENABLED'][0] == true) ) {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('map_info', false);
		}
		else {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('map_info', true);
		}

		// Setup 'round_scores' and use own RoundScoreWidget (if enabled)
		if ($this->config['UI_PROPERTIES'][0]['ROUND_SCORES'][0] == false || $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::ROUNDS][0]['ENABLED'][0] == true || $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::TEAM][0]['ENABLED'][0] == true || $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::CUP][0]['ENABLED'][0] == true || $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::CHASE][0]['ENABLED'][0] == true) {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('round_scores', false);
		}
		else {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('round_scores', true);
		}

		// Setup 'warmup'
		if ($this->config['UI_PROPERTIES'][0]['WARMUP'][0] == false || $this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0] == true) {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('warmup', false);
		}
		else {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('warmup', true);
		}

		// Setup 'endmap_ladder_recap'
		if ($this->config['UI_PROPERTIES'][0]['ENDMAP_LADDER_RECAP'][0] == false) {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('endmap_ladder_recap', false);
		}
		else {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('endmap_ladder_recap', true);
		}

		// Setup 'multilap_info'
		if ($this->config['UI_PROPERTIES'][0]['MULTILAP_INFO'][0] == false) {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('multilap_info', false);
		}
		else {
			$aseco->plugins['PluginModescriptHandler']->setUserInterfaceVisibility('multilap_info', true);
		}

		// Send the UI settings
		$aseco->plugins['PluginModescriptHandler']->setupUserInterface();



		// Get the current Maplist
		$this->getMaplist(false);

		// Get TopRoundscore
		$this->getTopRoundscore($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);

		// Refresh Scoretable lists
		$this->refreshScorelists();

		// Build the Playlist-Cache
		if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
			$this->getMusicServerPlaylist(false, true);
		}

		// Build the Toplist Widget
		if ($this->config['TOPLIST_WIDGET'][0]['ENABLED'][0] == true) {
			$this->cache['ToplistWidget'] = $this->buildToplistWidget();
		}

		// Build the AddToFavorite Widget
		if ($this->config['FAVORITE_WIDGET'][0]['ENABLED'][0] == true) {
			$this->cache['AddToFavoriteWidget']['Race'] = $this->buildAddToFavoriteWidget('RACE');
			$this->cache['AddToFavoriteWidget']['Score'] = $this->buildAddToFavoriteWidget('SCORE');
		}

		// Build the DonationWidget
		if ($this->config['DONATION_WIDGET'][0]['ENABLED'][0] == true) {
			$val = explode(',', $this->config['DONATION_WIDGET'][0]['AMOUNTS'][0]);
			if (count($val) < 7) {
				trigger_error('[RecordsEyepiece] » The amount of <donation_widget><amounts> is lower then the required min. of 7 in records_eyepiece.xml!', E_USER_ERROR);
			}
			$this->cache['DonationWidget'] = $this->buildDonationWidget();
		}


		$aseco->console('[RecordsEyepiece] Finished.');
		$aseco->console('[RecordsEyepiece] ********************************************************');
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onShutdown ($aseco) {

		if (isset($this->config['WINNING_PAYOUT'][0]) && $this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
			foreach ($aseco->server->players->player_list as $player) {
				if ($this->cache['PlayerWinnings'][$player->login]['FinishPayment'] > 0) {
					$this->winningPayout($player);
				}
			}
			unset($player);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function chat_eyepiece ($aseco, $login, $chat_command, $chat_parameter) {

		// Get Player object
		if (!$player = $aseco->server->players->getPlayerByLogin($login)) {
			return;
		}

		if (strtoupper($chat_parameter) == 'PAYOUTS') {

			if ($aseco->isAnyAdminL($login)) {

				if ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
					$message = '{#server}» There are outstanding disbursements in the amount of ';
					$outstanding = 0;
					foreach ($this->cache['PlayerWinnings'] as $login => $struct) {
						$outstanding += $this->cache['PlayerWinnings'][$login]['FinishPayment'];
					}
					unset($login, $struct);
					$message .= $this->formatNumber($outstanding, 0) .' Planets.';
				}
				else {
					$message = '{#server}» WinningPayoutWidget is not enabled, no payouts to do!';
				}

				// Show message
				$aseco->sendChatMessage($message, $login);
			}

		}
		else {
			if ($aseco->server->gamestate == Server::RACE) {

				// Call the HelpWindow
				$params = array(
					'Action' => 'showHelpWindow',
				);
				$this->onPlayerManialinkPageAnswer($aseco, $player->login, $params);

			}
			else {
				// Show message that the display at score is impossible
				$aseco->sendChatMessage($this->config['MESSAGES'][0]['DISALLOW_WINDOWS_AT_SCORE'][0], $login);
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function chat_estat ($aseco, $login, $chat_command, $chat_parameter) {

		if ($aseco->server->gamestate == Server::RACE) {

			// Get Player object
			if (!$player = $aseco->server->players->getPlayerByLogin($login)) {
				return;
			}

			// Get current Gamemode
			$gamemode = $aseco->server->gameinfo->mode;

			$id = false;
			if ( (strtoupper($chat_parameter) == 'DEDIRECS') && ($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) ) {
				$id = 'showDedimaniaRecordsWindow';
			}
			else if (strtoupper($chat_parameter) == 'LOCALRECS') {
				$id = 'showLocalRecordsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPNATIONS') {
				$id = 'showTopNationsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPRANKS') {
				$id = 'showTopRankingsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPWINNERS') {
				$id = 'showTopWinnersWindow';
			}
			else if (strtoupper($chat_parameter) == 'MOSTRECORDS') {
				$id = 'showMostRecordsWindow';
			}
			else if (strtoupper($chat_parameter) == 'MOSTFINISHED') {
				$id = 'showMostFinishedWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPPLAYTIME') {
				$id = 'showTopPlaytimeWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPDONATORS') {
				$id = 'showTopDonatorsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPMAPS') {
				$id = 'showTopMapsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPVOTERS') {
				$id = 'showTopVotersWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPACTIVE') {
				$id = 'showTopActivePlayersWindow';
			}
			else if ( (strtoupper($chat_parameter) == 'TOPPAYOUTS') && ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) ) {
				$id = 'showTopWinningPayoutWindow';
			}
			else if ( (strtoupper($chat_parameter) == 'TOPBETWINS') && ($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['ENABLED'][0] == true) ) {
				$id = 'showTopBetwinsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPROUNDSCORE') {
				$id = 'showTopRoundscoreWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPVISITORS') {
				$id = 'showTopVisitorsWindow';
			}
			else if (strtoupper($chat_parameter) == 'TOPCONTINENTS') {
				$id = 'showTopContinentsWindow';
			}
			else {
				$id = 'showHelpWindow';
			}

			if ($id !== false) {
				// Simulate a PlayerManialinkPageAnswer and
				// wrap "/elist [PARAMETER]" to an onPlayerManialinkPageAnswer
				$params = array(
					'Action'	=> $id,
				);
				$this->onPlayerManialinkPageAnswer($aseco, $player->login, $params);

			}
		}
		else {
			// Show message that the display at score is impossible
			$aseco->sendChatMessage($this->config['MESSAGES'][0]['DISALLOW_WINDOWS_AT_SCORE'][0], $login);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function chat_eyeset ($aseco, $login, $chat_command, $chat_parameter) {

		// Init
		$message = false;

		// Check optional parameter
		if (strtoupper($chat_parameter) == 'RELOAD') {
			if ($aseco->server->gamestate == Server::RACE) {
				$aseco->console('[RecordsEyepiece] MasterAdmin '. $login .' reloads the configuration.');

				// Close all Widgets at all Players
				$xml  = $this->closeRaceWidgets(false, true);
				$xml .= $this->closeScoretableLists();
				$xml .= '<manialink id="PlacementWidgetRace"></manialink>';
				$xml .= '<manialink id="PlacementWidgetScore"></manialink>';
				$xml .= '<manialink id="PlacementWidgetAlways"></manialink>';
				$this->sendManialink($xml, false, 0);

				// Reload the config
				$this->onSync($aseco, true);

				// Simulate the event 'onLoadingMap'
				$this->onLoadingMap($aseco, $aseco->server->maps->current);

				// Simulate the event 'onWarmUpStatusChanged'
				$this->onWarmUpStatusChanged($aseco, $aseco->warmup_phase);

				// Display the PlacementWidgets at state 'always'
				if ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) {
					$xml = $this->cache['PlacementWidget']['Always'];
					$this->sendManialink($xml, false, 0);
				}

				$message = '{#admin}» Reload of the configuration "config/records_eyepiece.xml" done.';
			}
			else {
				$message = '{#admin}» Can not reload the configuration at Score!';
			}
		}
		else if ( preg_match("/^lfresh \d+$/i", $chat_parameter) ) {

			$param = preg_split("/^lfresh (\d+)$/", $chat_parameter, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			$message = '{#admin}» Set <refresh_interval> (normal mode) to "'. $param[0] .'" sec.';
			$this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] = $param[0];

		}
		else if ( preg_match("/^hfresh \d+$/i", $chat_parameter) ) {

			$param = preg_split("/^hfresh (\d+)$/", $chat_parameter, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			$message = '{#admin}» Set <refresh_interval> (nice mode) to "'. $param[0] .'" sec.';
			$this->config['NICEMODE'][0]['REFRESH_INTERVAL'][0] = $param[0];

		}
		else if ( preg_match("/^llimit \d+$/i", $chat_parameter) ) {

			$param = preg_split("/^llimit (\d+)$/", $chat_parameter, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			$message = '{#admin}» Set <lower_limit> (nice mode) to "'. $param[0] .'" Players.';
			$this->config['NICEMODE'][0]['LIMITS'][0]['LOWER_LIMIT'][0] = $param[0];

		}
		else if ( preg_match("/^ulimit \d+$/i", $chat_parameter) ) {

			$param = preg_split("/^ulimit (\d+)$/", $chat_parameter, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			$message = '{#admin}» Set <upper_limit> (nice mode) to "'. $param[0] .'" Players.';
			$this->config['NICEMODE'][0]['LIMITS'][0]['UPPER_LIMIT'][0] = $param[0];

		}
		else if ( preg_match("/^forcenice (true|false)$/i", $chat_parameter) ) {

			$param = preg_split("/^forcenice (true|false)$/", $chat_parameter, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			$message = '{#admin}» Set <nicemode><force> to "'. $param[0] .'".';
			$this->config['NICEMODE'][0]['FORCE'][0]	= ((strtoupper($param[0]) == 'TRUE') ? true : false);
			$this->config['States']['NiceMode']	= ((strtoupper($param[0]) == 'TRUE') ? true : false);

			// Lets refresh the Widgets
			$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= true;
			$this->config['States']['LocalRecords']['UpdateDisplay']		= true;
			$this->config['States']['LiveRankings']['UpdateDisplay']		= true;
		}
		else if ( preg_match("/^playermarker (true|false)$/i", $chat_parameter) ) {

			$param = preg_split("/^playermarker (true|false)$/", $chat_parameter, 0, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			$message = '{#admin}» Set <features><mark_online_player_records> to "'. $param[0] .'".';
			$this->config['FEATURES'][0]['MARK_ONLINE_PLAYER_RECORDS'][0]	= ((strtoupper($param[0]) == 'TRUE') ? true : false);

			// Lets refresh the Widgets
			$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= true;
			$this->config['States']['LocalRecords']['UpdateDisplay']		= true;
		}
		else {
			$message = '{#admin}» Did not found any possible parameter to set!';
		}


		// Show message
		if ($message != false) {
			$aseco->sendChatMessage($message, $login);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Wrapper/Chat command for opening the MaplistWindow
	public function chat_elist ($aseco, $login, $chat_command, $chat_parameter) {

		// Do not display at score
		if ($aseco->server->gamestate == Server::RACE) {

			// Get Player object
			if (!$player = $aseco->server->players->getPlayerByLogin($login)) {
				return;
			}

			if (count($player->data['PluginRecordsEyepiece']['Maplist']['Records']) == 0) {
				if ( ($aseco->server->maps->count() > $this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0]) && ($this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0] != 0) ) {
					$this->sendProgressIndicator($player->login);
				}

				// Load all local Records from calling Player
				$player->data['PluginRecordsEyepiece']['Maplist']['Records'] = $this->getPlayerLocalRecords($player->id);

				// Load all Maps that the calling Player did not finished yet
				$player->data['PluginRecordsEyepiece']['Maplist']['Unfinished'] = $this->getPlayerUnfinishedMaps($player->id);
			}

			$id = false;
			if (strtoupper($chat_parameter) == 'JUKEBOX') {

				// Show the MaplistWindow (but only jukeboxed Maps)
				$id = 'showMaplistWindowFilterJukeboxedMaps';
			}
			else if (strtoupper($chat_parameter) == 'AUTHOR') {

				// Show the MapAuthorlistWindow
				$id = 'showMapAuthorlistWindow';
			}
			else if (strtoupper($chat_parameter) == 'NORECENT') {

				// Show the MaplistWindow (but no recent Maps)
				$id = 'showMaplistWindowFilterNoRecentMaps';
			}
			else if (strtoupper($chat_parameter) == 'ONLYRECENT') {

				// Show the MaplistWindow (but only recent Maps)
				$id = 'showMaplistWindowFilterOnlyRecentMaps';
			}
			else if (strtoupper($chat_parameter) == 'NORANK') {

				// Show the MaplistWindow (but only Maps without a rank)
				$id = 'showMaplistWindowFilterOnlyMapsWithoutRank';
			}
			else if (strtoupper($chat_parameter) == 'ONLYRANK') {

				// Show the MaplistWindow (but only Maps with a rank)
				$id = 'showMaplistWindowFilterOnlyMapsWithRank';
			}
			else if (strtoupper($chat_parameter) == 'NOMULTI') {

				// Show the MaplistWindow (but no Multilap Maps)
				$id = 'showMaplistWindowFilterNoMultilapMaps';
			}
			else if (strtoupper($chat_parameter) == 'ONLYMULTI') {

				// Show the MaplistWindow (but only Multilap Maps)
				$id = 'showMaplistWindowFilterOnlyMultilapMaps';
			}
			else if (strtoupper($chat_parameter) == 'NOAUTHOR') {

				// Show the MaplistWindow (but only Maps no author time)
				$id = 'showMaplistWindowFilterOnlyMapsNoAuthorTime';
			}
			else if (strtoupper($chat_parameter) == 'NOGOLD') {

				// Show the MaplistWindow (but only Maps no gold time)
				$id = 'showMaplistWindowFilterOnlyMapsNoGoldTime';
			}
			else if (strtoupper($chat_parameter) == 'NOSILVER') {

				// Show the MaplistWindow (but only Maps no silver time)
				$id = 'showMaplistWindowFilterOnlyMapsNoSilverTime';
			}
			else if (strtoupper($chat_parameter) == 'NOBRONZE') {

				// Show the MaplistWindow (but only Maps no bronze time)
				$id = 'showMaplistWindowFilterOnlyMapsNoBronzeTime';
			}
			else if (strtoupper($chat_parameter) == 'NOFINISH') {

				// Show the MaplistWindow (but only Maps not finished)
				$id = 'showMaplistWindowFilterOnlyMapsNotFinished';
			}
			else if (strtoupper($chat_parameter) == 'BEST') {

				// Show the MaplistWindow (sort Maps 'Best Player Rank')
				$id = 'showMaplistWindowSortingBestPlayerRank';
			}
			else if (strtoupper($chat_parameter) == 'WORST') {

				// Show the MaplistWindow (sort Maps 'Worst Player Rank')
				$id = 'showMaplistWindowSortingWorstPlayerRank';
			}
			else if (strtoupper($chat_parameter) == 'SHORTEST') {

				// Show the MaplistWindow (sort Maps 'Shortest Author Time')
				$id = 'showMaplistWindowSortingShortestAuthorTime';
			}
			else if (strtoupper($chat_parameter) == 'LONGEST') {

				// Show the MaplistWindow (sort Maps 'Longest Author Time')
				$id = 'showMaplistWindowSortingLongestAuthorTime';
			}
			else if (strtoupper($chat_parameter) == 'NEWEST') {

				// Show the MaplistWindow (sort Maps 'Newest Maps First')
				$id = 'showMaplistWindowSortingNewestMapsFirst';
			}
			else if (strtoupper($chat_parameter) == 'OLDEST') {

				// Show the MaplistWindow (sort Maps 'Oldest Maps First')
				$id = 'showMaplistWindowSortingOldestMapsFirst';
			}
			else if (strtoupper($chat_parameter) == 'MAP') {

				// Show the MaplistWindow (sort Maps 'By Mapname')
				$id = 'showMaplistWindowSortingByMapname';
			}
			else if (strtoupper($chat_parameter) == 'AUTHOR') {

				// Show the MaplistWindow (sort Maps 'By Authorname')
				$id = 'showMaplistWindowSortingByAuthorname';
			}
			else if (strtoupper($chat_parameter) == 'BESTKARMA') {

				// Show the MaplistWindow (sort Maps 'By Karma: Best Maps First')
				$id = 'showMaplistWindowSortingByKarmaBestMapsFirst';
			}
			else if (strtoupper($chat_parameter) == 'WORSTKARMA') {

				// Show the MaplistWindow (sort Maps 'By Karma: Worst Maps First')
				$id = 'showMaplistWindowSortingByKarmaWorstMapsFirst';
			}
			else {
				if (strlen($chat_parameter) > 0) {
					// Show the MaplistWindow (Search for Keyword at Mapname/Author/Filename)
					$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('key' => $chat_parameter);
					$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;

					// Show the MaplistWindow (filtered by given keyword)
					$id = 'showMaplistWindowFilterByKeyword';
				}
				else {
					// Show the MaplistWindow (display all Maps)
					$id = 'showMaplistWindow';
				}
			}

			if ($id !== false) {
				// Simulate a PlayerManialinkPageAnswer and
				// wrap "/elist [PARAMETER]" to an onPlayerManialinkPageAnswer
				$params = array(
					'Action'	=> $id,
				);
				$this->onPlayerManialinkPageAnswer($aseco, $player->login, $params);
			}
		}
		else {
			// Show message that the display at score is impossible
			$aseco->sendChatMessage($this->config['MESSAGES'][0]['DISALLOW_WINDOWS_AT_SCORE'][0], $login);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Wrapper/Chat command for opening the MusiclistWindow
	public function chat_emusic ($aseco, $login, $chat_command, $chat_parameter) {

		if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
			// Do not display at score
			if ($aseco->server->gamestate == Server::RACE) {
				// Get Player object
				if ($player = $aseco->server->players->getPlayerByLogin($login)) {
					$params = array(
						'Action' => 'showMusiclistWindow',
					);
					$this->onPlayerManialinkPageAnswer($aseco, $player->login, $params);
				}
			}
			else {
				// Show message that the display at score is impossible
				$aseco->sendChatMessage($this->config['MESSAGES'][0]['DISALLOW_WINDOWS_AT_SCORE'][0], $login);
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onEverySecond ($aseco) {

		// Is it time for refresh the RecordWidgets?
		if (time() >= $this->config['States']['RefreshTimestampRecordWidgets']) {

			// Get current Gamemode
			$gamemode = $aseco->server->gameinfo->mode;

			// Set next refresh timestamp
			$this->config['States']['RefreshTimestampRecordWidgets'] = (time() + $this->config['FEATURES'][0]['REFRESH_INTERVAL'][0]);

			// Check for changed LocalRecords, e.g. on "/admin delrec 1"...
			if (isset($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
				if (count($aseco->plugins['PluginLocalRecords']->records->record_list) >= 1) {
					$localDigest = $this->buildRecordDigest('locals', $aseco->plugins['PluginLocalRecords']->records->record_list);
					if ($this->config['States']['LocalRecords']['ChkSum'] != $localDigest && $this->config['States']['LocalRecords']['NoRecordsFound'] === false) {
						$this->config['States']['LocalRecords']['NeedUpdate'] = true;
					}
				}
			}

			// Load the current Rankings
			if (isset($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
				$this->cache['CurrentRankings'] = array();
				if ($gamemode == Gameinfo::TEAM) {
					$this->cache['CurrentRankings'] = $this->getCurrentRanking(2,0);
				}
				else {
					// All other Gamemodes
					$this->cache['CurrentRankings'] = $this->getCurrentRanking(300,0);
				}
			}

			// Build the RecordWidgets and ONLY in normal mode send it to each Player (if refresh is required)
			$this->buildRecordWidgets(false, false);


			$widgets = '';
			if ($this->config['States']['NiceMode'] == true) {
				// Display the RecordWidgets to all Players (if refresh is required)
				$widgets .= $this->showRecordWidgets(false);
			}

			// Send all widgets to ALL Players
			if ($widgets != '') {
				// Send Manialink
				$this->sendManialink($widgets, false, 0);
			}


			// Just refreshed, mark as fresh
			$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= false;
			$this->config['States']['LocalRecords']['UpdateDisplay']		= false;
			$this->config['States']['LiveRankings']['UpdateDisplay']		= false;
		}

		// Required to load the Preloader for external Images
		if (time() >= $this->config['States']['RefreshTimestampPreload']) {
			$this->config['States']['RefreshTimestampPreload'] = (time() + 5);

			foreach ($aseco->server->players->player_list as $player) {
				if ( (time() >= $player->data['PluginRecordsEyepiece']['Preload']['Timestamp']) && ($player->data['PluginRecordsEyepiece']['Preload']['LoadedPart'] != 5) ) {
					$player->data['PluginRecordsEyepiece']['Preload']['LoadedPart'] += 1;
					$widgets = $this->buildImagePreload($player->data['PluginRecordsEyepiece']['Preload']['LoadedPart']);

					if ($widgets != '') {
						// Send Manialink
						$this->sendManialink($widgets, $player->login, 0);
					}
				}
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function refreshScorelists () {

		// Refresh MostRecords Array
		$this->getMostRecords($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);

		// Refresh the MostFinished Array
		$this->getMostFinished($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);

		// Refresh the TopDonators Array
		$this->getTopDonators($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);

		// Refresh the TopContinents Array
		$this->getTopContinents($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);

		// Refresh the TopRankings Array
		$this->getTopRankings($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_RANKINGS'][0]['ENABLED'][0] == true) {
			$this->cache['TopRankings'] = $this->buildScorelistWidgetEntry('TopRankingsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_RANKINGS'][0], $this->scores['TopRankings'], array('score', 'nickname'));
		}

		// Refresh the TopWinners Array
		$this->getTopWinners($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0]['ENABLED'][0] == true) {
			$this->cache['TopWinners'] = $this->buildScorelistWidgetEntry('TopWinnersWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0], $this->scores['TopWinners'], array('score', 'nickname'));
		}

		// Refresh TopMaps Array (if required)
		if ($this->config['States']['TopMaps']['NeedUpdate'] == true) {
			$this->calculateMapKarma();
			$this->getTopMaps($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_MAPS'][0]['ENABLED'][0] == true) {
			$this->cache['TopMaps'] = $this->buildScorelistWidgetEntry('TopMapsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_MAPS'][0], $this->scores['TopMaps'], array('karma', 'map'));
		}

		// Refresh TopVoters Array (if required)
		if ($this->config['States']['TopVoters']['NeedUpdate'] == true) {
			$this->getTopVoters($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_VOTERS'][0]['ENABLED'][0] == true) {
			$this->cache['TopVoters'] = $this->buildScorelistWidgetEntry('TopVotersWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_VOTERS'][0], $this->scores['TopVoters'], array('score', 'nickname'));
		}

		// Refresh the TopBetwins Array
		$this->getTopBetwins($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['ENABLED'][0] == true) {
			$this->cache['TopBetwins'] = $this->buildScorelistWidgetEntry('TopBetwinsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0], $this->scores['TopBetwins'], array('won', 'nickname'));
		}

		// Refresh the TopWinningPayout Array
		$this->getTopWinningPayout($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_WINNING_PAYOUTS'][0]['ENABLED'][0] == true) {
			$this->cache['TopWinningPayouts'] = $this->buildScorelistWidgetEntry('TopWinningPayoutsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_WINNING_PAYOUTS'][0], $this->scores['TopWinningPayouts'], array('won', 'nickname'));
		}

		// Refresh the TopVisitors Array
		$this->getTopVisitors($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_VISITORS'][0]['ENABLED'][0] == true) {
			$this->cache['TopVisitors'] = $this->buildScorelistWidgetEntry('TopVisitorsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_VISITORS'][0], $this->scores['TopVisitors'], array('score', 'nickname'));
		}

		// Refresh the TopActivePlayers Array
		$this->getTopActivePlayers($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_ACTIVE_PLAYERS'][0]['ENABLED'][0] == true) {
			$this->cache['TopActivePlayers'] = $this->buildScorelistWidgetEntry('TopActivePlayersWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_ACTIVE_PLAYERS'][0], $this->scores['TopActivePlayers'], array('score', 'nickname'));
		}

		// Refresh the TopPlaytime Array
		$this->getTopPlaytime($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_PLAYTIME'][0]['ENABLED'][0] == true) {
			$this->cache['TopPlaytime'] = $this->buildScorelistWidgetEntry('TopPlaytimeWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_PLAYTIME'][0], $this->scores['TopPlaytime'], array('score', 'nickname'));
		}

		// Refresh the TopNations Array
		$this->getTopNationList($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ENABLED'][0] == true) {
			$this->cache['TopNations'] = $this->buildTopNationsForScore($this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ENTRIES'][0]);
		}

		// Refresh the Visitors Array
		$this->getVisitors($this->config['FEATURES'][0]['TOPLIST_LIMIT'][0]);
		if ($this->config['VISITORS_WIDGET'][0]['ENABLED'][0] == true) {
			$this->cache['VisitorsWidget'] = $this->buildVisitorsWidget();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerConnect ($aseco, $player) {

		// Check if it is time to switch from "normal" to NiceMode or back
		$this->checkServerLoad();

		// Get the detailed Players TeamId (refreshed onPlayerInfoChanged)
		$player->data['PluginRecordsEyepiece']['Prefs']['TeamId'] = $player->teamid;

		// Init Player-Storages
		$player->data['PluginRecordsEyepiece']['Window']['Action']	= false;
		$player->data['PluginRecordsEyepiece']['Window']['Page']	= 0;
		$player->data['PluginRecordsEyepiece']['Window']['MaxPage']	= 0;
		$player->data['PluginRecordsEyepiece']['Maplist']['Filter']	= false;
		$player->data['PluginRecordsEyepiece']['Maplist']['Records']	= array();

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// Init
		$widgets = '';

		// Preset an empty RecordEntry for the RecordWidgets, required
		// for an empty entry for this Player if he/she did not has a Record yet
		$item = array();
		$item['login'] = $player->login;
		$item['nickname'] = $this->handleSpecialChars($player->nickname);
		$item['self'] = 0;
		$item['rank'] = '--';
		$player->data['PluginRecordsEyepiece']['Prefs']['WidgetEmptyEntry'] = $item;


		// Add this Player to the Hash-Compare-Process
		$this->cache['PlayerStates'][$player->login]['DedimaniaRecords']	= false;
		$this->cache['PlayerStates'][$player->login]['LocalRecords']		= false;
		$this->cache['PlayerStates'][$player->login]['LiveRankings']		= false;
		$this->cache['PlayerStates'][$player->login]['FinishScore']		= -1;


		if ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
			// Check for WinningPayment: If this exists, do not override!
			if ( !isset($this->cache['PlayerWinnings'][$player->login]['TimeStamp']) ) {
				$this->cache['PlayerWinnings'][$player->login]['FinishPayment']	= 0;
				$this->cache['PlayerWinnings'][$player->login]['FinishPaid']	= 0;
				$this->cache['PlayerWinnings'][$player->login]['TimeStamp']	= 0;
			}

			// Add this Player to the Cache
			$this->cache['WinningPayoutPlayers'][$player->login] = array(
				'id'		=> $player->id,
				'login'		=> $player->login,
				'nickname'	=> $player->nickname,
				'ladderrank'	=> $player->ladderrank
			);
		}

		// Look if Player is in $this->scores['TopActivePlayers'] and if, then update and resort
		$found = false;
		foreach ($this->scores['TopActivePlayers'] as &$item) {
			if ($item['login'] == $player->login) {
				$item['score']		= 'Today';
				$item['score_plain']	= 0;
				$found = true;
				break;
			}
		}
		unset($item);
		if ($found == true) {
			// Resort by 'score'
			$data = array();
			foreach ($this->scores['TopActivePlayers'] as $key => $row) {
				$data[$key] = $row['score_plain'];
			}
			array_multisort($data, SORT_NUMERIC, SORT_ASC, $this->scores['TopActivePlayers']);
			unset($data, $key, $row);
		}


		$widgets .= $this->buildClockWidget();

		if ($this->config['TOPLIST_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the TopList Widget to connecting Player
			$widgets .= $this->cache['ToplistWidget'];
		}

		if ($this->config['FAVORITE_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the AddToFavorite Widget
			$widgets .= $this->cache['AddToFavoriteWidget']['Race'];
		}

		if ($this->config['VISITORS_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the Visitors-Widget to connecting Player
			$widgets .= (($this->cache['VisitorsWidget'] != false) ? $this->cache['VisitorsWidget'] : '');
		}

		if ($this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0] == true && $this->config['States']['WarmUpPhase'] == true) {
			// Display the WarmUpInfoWidget to connecting Player
			$widgets .= (($this->cache['WarmUpInfoWidget'] != false) ? $this->cache['WarmUpInfoWidget'] : '');
		}

		if ($this->config['MULTILAP_INFO_WIDGET'][0]['ENABLED'][0] == true && ($aseco->server->maps->current->multilap == true && ($gamemode != Gameinfo::TIME_ATTACK && $gamemode != Gameinfo::DOPPLER))) {
			// Display the MultiLapInfoWidget to connecting Player
			$widgets .= (($this->cache['MultiLapInfoWidget'] != false) ? $this->cache['MultiLapInfoWidget'] : '');
		}

		if ($this->config['SPECTATOR_INFO_WIDGET'][0]['ENABLED'][0] == true) {
			// Send the SpectatorInfoGetter to connecting Player
			$this->cache['SpectatorOverview'][$player->login] = '';
			$widgets .= $this->buildSpectatorInfoGetter();
		}

		if ($this->config['MANIAEXCHANGE_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the ManiaExchangeWidget to connecting Player
			$widgets .= (($this->cache['ManiaExchangeWidget'] != false) ? $this->cache['ManiaExchangeWidget'] : '');
		}

		if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the MapcountWidget to connecting Player
			$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
		}

		if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the Music Widget to connecting Player
			$widgets .= (($this->cache['MusicWidget'] != false) ? $this->cache['MusicWidget'] : '');
		}

		if ($this->config['States']['NiceMode'] == true) {
			// Display the RecordWidgets to connecting Player
			$widgets .= $this->showRecordWidgets(true);
		}
		else {
			// Find any Records for this Player and if found, refresh the concerned Widgets
			$result = $this->findPlayerRecords($player->login);
			if ( ($result['DedimaniaRecords'] == true) || ($result['LocalRecords'] == true) ) {
				// New Player has one Record, need to refresh concerned Widgets (without LiveRankings) at ALL Players, but not current Player
				$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= true;
				$this->config['States']['LocalRecords']['UpdateDisplay']		= true;
			}

			// Now the connected Player need all Widgets to be displayed, not only that where he/she has a record
			$this->buildRecordWidgets($player, array('DedimaniaRecords' => true, 'LocalRecords' => true, 'LiveRankings' => true));
		}

		// Display the PlacementWidgets at state 'always'
		if ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) {
			$widgets .= $this->cache['PlacementWidget']['Always'];
		}

		// Display the PlacementWidgets at state 'race'
		if ( ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) && ($aseco->server->gamestate == Server::RACE) ) {
			$widgets .= $this->cache['PlacementWidget']['Race'];
			if (isset($this->cache['PlacementWidget'][$gamemode])) {
				$widgets .= $this->cache['PlacementWidget'][$gamemode];
			}
		}

		// Display the MapWidget
		$widgets .= (($this->cache['MapWidget']['Race'] != false) ? $this->cache['MapWidget']['Race'] : '');

		// Mark this Player for need to preload Images
		$player->data['PluginRecordsEyepiece']['Preload']['Timestamp'] = (time() + 15);
		$player->data['PluginRecordsEyepiece']['Preload']['LoadedPart'] = 0;


		// Display the RoundScoreWidget
		if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildRoundScoreWidget($gamemode, false);
		}

//		if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
//			$widgets .= $this->buildLiveRankingsWidgetMS($gamemode, $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0]);
//		}

		// Send all widgets
		if (!empty($widgets)) {
			// Send Manialink
			$this->sendManialink($widgets, $player->login, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerDisconnectPrepare ($aseco, $player) {

		// Remove temporary Player data, do not need to be stored into the database.
		$this->removePlayerData($player, 'Maplist');
		$this->removePlayerData($player, 'Prefs');
		$this->removePlayerData($player, 'Preload');
		$this->removePlayerData($player, 'Window');
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerDisconnect ($aseco, $player) {

		// Check if it is time to switch from "normal" to NiceMode or back
		$this->checkServerLoad();

		if ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
			$this->winningPayout($player);
		}

		// Find any Records for this Player and if found, refresh the concerned Widgets
		$result = $this->findPlayerRecords($player->login);
		if ($result['DedimaniaRecords'] == true) {
			$this->config['States']['DedimaniaRecords']['UpdateDisplay'] = true;
		}
		if ($result['LocalRecords'] == true) {
			$this->config['States']['LocalRecords']['UpdateDisplay'] = true;
		}


		// Remove this Player from the Hash-Compare-Process
		unset($this->cache['PlayerStates'][$player->login]);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerRankingUpdated ($aseco) {

		// Update LiveRankings only
		$this->config['States']['LiveRankings']['NeedUpdate']		= true;
		$this->config['States']['LiveRankings']['UpdateDisplay']	= true;
		$this->buildRecordWidgets(false, array('DedimaniaRecords' => false, 'LocalRecords' => false, 'LiveRankings' => true));
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerFinish1 ($aseco, $finish_item) {

		if ($finish_item->score == 0) {
			// No actual finish, bail out immediately
			return;
		}

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// Get the Player object (possible required below)
		$player = $aseco->server->players->player_list[$finish_item->player->login];


		// Check if the Player has a better score as before
		$refresh = false;
		if ($this->cache['PlayerStates'][$player->login]['FinishScore'] == -1) {
			// New Score, store them
			$this->cache['PlayerStates'][$player->login]['FinishScore'] = $finish_item->score;

			// Let the Widget refresh
			$refresh = true;
		}
		else if ($finish_item->score < $this->cache['PlayerStates'][$player->login]['FinishScore']) {
			// All Gamemodes: Lower = Better

			// Better Score, store them
			$this->cache['PlayerStates'][$player->login]['FinishScore'] = $finish_item->score;

			// Let the Widget refresh
			$refresh = true;
		}
		// Refresh the LiveRankingsWidget only if there is a better or new Score/Time
		if ($refresh == true) {
			// Player finished the Map, need to Update the 'LiveRanking',
			// but not at Gamemode 'Rounds' - that are only updated at the event 'onEndRound'!
			if ($gamemode != Gameinfo::ROUNDS) {
				$this->config['States']['LiveRankings']['NeedUpdate'] = true;
				$this->config['States']['LiveRankings']['NoRecordsFound'] = false;
			}
		}


		// Increase finish count for this Player, required for MostFinished List at Score and in the TopLists
		$query = "UPDATE `%prefix%players` SET `MostFinished` = `MostFinished` + 1 WHERE `PlayerId` = '". $player->id ."';";
		$result = $aseco->db->query($query);
		if (!$result) {
			$aseco->console('[RecordsEyepiece] UPDATE `MostFinished` failed. [for statement "'. $query .'"]!');
		}

		// Store the $finish_item->score to build the average
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['ENABLED'][0] == true) {
			$this->scores['TopAverageTimes'][$player->login][] = $finish_item->score;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerWins ($aseco, $player) {

		// Look if Player is in Array
		foreach ($this->scores['TopWinners'] as $item) {
			if ($item['login'] == $player->login) {
				// Lets refresh them now
				$this->getTopWinners();
				if ($this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0]['ENABLED'][0] == true) {
					$this->cache['TopWinners'] = $this->buildScorelistWidgetEntry('TopWinnersWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0], $this->scores['TopWinners'], array('score', 'nickname'));
				}
				break;
			}
		}
		unset($item);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerInfoChanged ($aseco, $login) {

		// Skip work at Score
		if ($aseco->server->gamestate == Server::RACE) {

			// Get current Gamemode
			$gamemode = $aseco->server->gameinfo->mode;

			// Refresh Player and Team membership
			if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {

				// Get Player
				if ($player = $aseco->server->players->getPlayerByLogin($login)) {
					// Store the (possible changed) TeamId
					$player->data['PluginRecordsEyepiece']['Prefs']['TeamId'] = $player->teamid;
				}
			}

		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onPlayerManialinkPageAnswer ($aseco, $login, $params) {

		// Get Player
		if (!$player = $aseco->server->players->getPlayerByLogin($login)) {
			return;
		}

		// Init
		$widgets = '';
		$require_action = false;

		// Setup the answer index
		$answer_index = array(
			'showDedimaniaRecordsWindow',
			'showLocalRecordsWindow',
			'showLiveRankingsWindow',
			'showMusiclistWindow',
			'dropCurrentSongFromJukebox',
			'showMaplistWindow',
			'showMaplistFilterWindow',
			'showMaplistSortingWindow',
			'showMapAuthorlistWindow',
			'showHelpWindow',
			'showToplistWindow',
			'showTopRankingsWindow',
			'showTopNationsWindow',
			'showTopWinnersWindow',
			'showMostRecordsWindow',
			'showMostFinishedWindow',
			'showTopPlaytimeWindow',
			'showTopDonatorsWindow',
			'showTopMapsWindow',
			'showTopVotersWindow',
			'showTopActivePlayersWindow',
			'showTopWinningPayoutWindow',
			'showTopBetwinsWindow',
			'showTopRoundscoreWindow',
			'showTopVisitorsWindow',
			'showTopContinentsWindow',
		);

		if ($params['Action'] == 'spectatorUpdate' && $this->config['SPECTATOR_INFO_WIDGET'][0]['ENABLED'][0] == true) {
			$this->updateSpectatorList($params['Spectator'], $params['Target']);
			return;
		}

		if ($params['Action'] == 'showLastCurrentNextMapWindow') {

			$widgets .= (($this->cache['MapWidget']['Window'] != false) ? $this->cache['MapWidget']['Window'] : '');

		}
		else if ($params['Action'] == 'showManiaExchangeMapInfoWindow') {

			$widgets .= $this->buildManiaExchangeMapInfoWindow();

		}
		else if ($params['Action'] == 'addMapToPlaylist') {

			// Get the selected Map
			$map = $aseco->server->maps->getMapByUid($params['uid']);

			// Store wished Map in Player object for jukeboxing with plugin.rasp_jukebox.php
			$item = array();
			$item['name']		= $map->name;
			$item['author']		= $map->author;
			$item['environment']	= $map->environment;
			$item['filename']	= $map->filename;
			$item['uid']		= $map->uid;
			$player->maplist = array();
			$player->maplist[] = $item;

			// Juke the selected Map
			$aseco->releaseChatCommand('/jukebox 1', $player->login);
//			$aseco->server->maps->playlist->addMapToPlaylist($params['uid'], $player->login, 'select');

			// Refresh on juke'd map
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$require_action = true;

		}
		else if ($params['Action'] == 'removeMapFromPlaylist') {

			if ($aseco->allowAbility($player, 'dropjukebox')) {
				$juked = 0;
				$tid = 1;
				foreach ($aseco->plugins['PluginRaspJukebox']->jukebox as $item) {
					if ($item['uid'] == $params['uid']) {
						$juked = $tid;
						break;
					}
					$tid++;
				}

				// Drop selected map from jukebox by admin
				$aseco->releaseChatCommand('/admin dropjukebox '. $juked, $login);
			}
			else {
				// Drop user's jukeboxed map
				$aseco->releaseChatCommand('/jukebox drop', $login);
			}

			if ($this->config['FEATURES'][0]['MAPLIST'][0]['FORCE_MAPLIST'][0] == true) {
				// Refresh on drop map from jukebox
				$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
				$require_action = true;
			}

		}
		else if ($params['Action'] == 'askDropMapFromPlaylist') {

			$widgets .= $this->buildAskDropMapFromPlaylist();

		}
		else if ($params['Action'] == 'dropMapFromPlaylist') {

			// Drop all Maps from the Jukebox
			$aseco->releaseChatCommand('/admin clearjukebox', $player->login);

			// Close SubWindow
			$widgets .= $this->closeAllSubWindows();

			// Rebuild the Maplist
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$require_action = true;

		}
		else if ($params['Action'] == 'dropCurrentSongFromJukebox') {

			$aseco->releaseChatCommand('/music drop', $player->login);

		}
		else if ($params['Action'] == 'showMaplistWindow') {

			if (count($player->data['PluginRecordsEyepiece']['Maplist']['Records']) == 0) {
				if ($aseco->server->maps->count() > $this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0] && $this->config['SHOW_PROGRESS_INDICATOR'][0]['MAPLIST'][0] != 0) {
					$this->sendProgressIndicator($player->login);
				}

				// Load all local records from calling Player
				$player->data['PluginRecordsEyepiece']['Maplist']['Records'] = $this->getPlayerLocalRecords($player->id);

				// Load all Maps that the calling Player did not finished yet
				$player->data['PluginRecordsEyepiece']['Maplist']['Unfinished'] = $this->getPlayerUnfinishedMaps($player->id);
			}
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = false;
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyCanyonMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('environment' => 'CANYON');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyStadiumMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('environment' => 'STADIUM');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyValleyMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('environment' => 'VALLEY');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterJukeboxedMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'JUKEBOX');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterNoRecentMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NORECENT');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyRecentMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'ONLYRECENT');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsWithoutRank') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NORANK');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsWithRank') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'ONLYRANK');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsNoGoldTime') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NOGOLD');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsNoAuthorTime') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NOAUTHOR');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterMapsWithMoodSunrise') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('mood' => 'SUNRISE');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterMapsWithMoodDay') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('mood' => 'DAY');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterMapsWithMoodSunset') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('mood' => 'SUNSET');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterMapsWithMoodNight') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('mood' => 'NIGHT');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMultilapMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'ONLYMULTILAP');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterNoMultilapMaps') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NOMULTILAP');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsNoSilverTime') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NOSILVER');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsNoBronzeTime') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NOBRONZE');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterOnlyMapsNotFinished') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('cmd' => 'NOFINISH');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingBestPlayerRank') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'BEST');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingWorstPlayerRank') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'WORST');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingShortestAuthorTime') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'SHORTEST');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingLongestAuthorTime') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'LONGEST');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingNewestMapsFirst') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'NEWEST');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingOldestMapsFirst') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'OLDEST');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingByMapname') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'MAPNAME');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingByAuthorname') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'AUTHORNAME');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingByKarmaBestMapsFirst') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'BESTMAPS');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingByKarmaWorstMapsFirst') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'WORSTMAPS');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowSortingByAuthorNation') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('sort' => 'AUTHORNATION');
			$require_action = true;

		}
		else if ($params['Action'] == 'showMaplistWindowFilterByKeyword') {

			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
//			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;						// already setup in chat_elist()!
//			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('key' => $command['params']);	// already setup in chat_elist()!
			$require_action = true;

		}
		else if ($params['Action'] == 'handlePlayerDonation') {

			// Donate the Donation
			$aseco->releaseChatCommand('/donate '. $params['Amount'], $player->login);

		}
		else if ($params['Action'] == 'releaseChatCommand') {

			foreach ($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] as $placement) {
				if ( (isset($placement['CHAT_MLID'][0])) && ($placement['CHAT_MLID'][0] == $params['id']) ) {
					$aseco->releaseChatCommand($placement['CHAT_COMMAND'][0], $player->login);
					break;
				}
			}
			unset($placement);

		}
		else if ($params['Action'] == 'showMaplistWindowFilterAuthor') {

			// Show the MaplistWindow (but only Maps from the selected MapAuthor)
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = array('author' => $params['Author']);
			$require_action = true;

		}
		else if ($params['Action'] == 'addSongToJukebox') {

			$aseco->releaseChatCommand('/music '. $params['id'], $login);

			// It is required to refresh the SongIds from $aseco->plugins['PluginMusicServer']->songs
			$this->config['States']['MusicServerPlaylist']['NeedUpdate'] = true;

			if ($this->config['FEATURES'][0]['SONGLIST'][0]['FORCE_SONGLIST'][0] == true) {
				// Refresh on juke'd song
				$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMusiclistWindow';
				$require_action = true;
			}

		}
		else if ( ($params['Action'] == 20) && ($this->config['FEATURES'][0]['MAPLIST'][0]['FORCE_MAPLIST'][0] == true) ) {

			// Refresh on drop complete jukebox (action from plugin.rasp_jukebox.php)
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = 'showMaplistWindow';
			$require_action = true;

		}
		else if ( in_array($params['Action'], $answer_index) ) {

			// Set the Window action
			if ($player->data['PluginRecordsEyepiece']['Window']['Action'] != $params['Action']) {
				$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			}
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = $params['Action'];
			$require_action = true;

		}
		else if ($params['Action'] == 'WindowPagePrev') {

			$player->data['PluginRecordsEyepiece']['Window']['Page'] -= 1;
			if ($player->data['PluginRecordsEyepiece']['Window']['Page'] < 0) {
				$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			}
			$require_action = true;

		}
		else if ($params['Action'] == 'WindowPagePrevTwo') {

			$player->data['PluginRecordsEyepiece']['Window']['Page'] -= 2;
			if ($player->data['PluginRecordsEyepiece']['Window']['Page'] < 0) {
				$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			}
			$require_action = true;

		}
		else if ($params['Action'] == 'WindowPageFirst') {

			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$require_action = true;

		}
		else if ($params['Action'] == 'WindowPageNext') {

			$player->data['PluginRecordsEyepiece']['Window']['Page'] += 1;
			if ($player->data['PluginRecordsEyepiece']['Window']['Page'] > $player->data['PluginRecordsEyepiece']['Window']['MaxPage']) {
				$player->data['PluginRecordsEyepiece']['Window']['Page'] = $player->data['PluginRecordsEyepiece']['Window']['MaxPage'];
			}
			$require_action = true;

		}
		else if ($params['Action'] == 'WindowPageNextTwo') {

			$player->data['PluginRecordsEyepiece']['Window']['Page'] += 2;
			if ($player->data['PluginRecordsEyepiece']['Window']['Page'] > $player->data['PluginRecordsEyepiece']['Window']['MaxPage']) {
				$player->data['PluginRecordsEyepiece']['Window']['Page'] = $player->data['PluginRecordsEyepiece']['Window']['MaxPage'];
			}
			$require_action = true;

		}
		else if ($params['Action'] == 'WindowPageLast') {

			$player->data['PluginRecordsEyepiece']['Window']['Page'] = $player->data['PluginRecordsEyepiece']['Window']['MaxPage'];
			$require_action = true;

		}


		// Nothing above matched, so the Player want to see the prev/next page in the current open Window
		if ($require_action == true) {
			if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showDedimaniaRecordsWindow') {

				$widgets .= $this->buildDedimaniaRecordsWindow($player->login);

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showLocalRecordsWindow') {

				$result = $this->buildLocalRecordsWindow($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showLiveRankingsWindow') {

				$result = $this->buildLiveRankingsWindow($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ( ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMusiclistWindow') || ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'dropCurrentSongFromJukebox') ) {

				$result = $this->buildMusiclistWindow($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMaplistWindow') {

				$result = $this->buildMaplistWindow($player->data['PluginRecordsEyepiece']['Window']['Page'], $player);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMapAuthorlistWindow') {

				$result = $this->buildMapAuthorlistWindow($player->data['PluginRecordsEyepiece']['Window']['Page'], $player);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showHelpWindow') {

				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = 2;
				$widgets .= $this->buildHelpWindow($player->data['PluginRecordsEyepiece']['Window']['Page']);

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showToplistWindow') {

				$result = $this->buildToplistWindow($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopRankingsWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_RANKINGS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopWinnersWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_WINNERS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMostRecordsWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'MOST_RECORDS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMostFinishedWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'MOST_FINISHED', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopPlaytimeWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_PLAYTIME', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopDonatorsWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_DONATORS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopMapsWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_MAPS', array('karma', 'map'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopVotersWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_VOTERS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopActivePlayersWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_ACTIVE_PLAYERS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopWinningPayoutWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_WINNING_PAYOUTS', array('won', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopBetwinsWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_BETWINS', array('won', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopRoundscoreWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_ROUNDSCORE', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopVisitorsWindow') {

				$result = $this->buildScorelistWindowEntry($player->data['PluginRecordsEyepiece']['Window']['Page'], $player->login, 'TOP_VISITORS', array('score', 'nickname'));
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopNationsWindow') {

				$result = $this->buildTopNationsWindow($player->data['PluginRecordsEyepiece']['Window']['Page']);
				$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = $result['maxpage'];
				$widgets .= $result['xml'];

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showTopContinentsWindow') {

				$widgets .= $this->buildTopContinentsWindow();

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMaplistFilterWindow') {

				$widgets .= $this->buildMaplistFilterWindow();

			}
			else if ($player->data['PluginRecordsEyepiece']['Window']['Action'] == 'showMaplistSortingWindow') {

				$widgets .= $this->buildMaplistSortingWindow();

			}
		}


		// Send all widgets
		if (!empty($widgets)) {
			// Send Manialink
			$this->sendManialink($widgets, $player->login, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onDedimaniaRecordsLoaded ($aseco, $records) {

		if ( ( isset($aseco->plugins['PluginDedimania']->db['Map']['Records']) ) && (count($aseco->plugins['PluginDedimania']->db['Map']['Records']) > 0) ) {
			// Records are loaded, now we can get them into 'DedimaniaRecords' and force reload of the DedimaniaRecordsWidget
			$this->config['States']['DedimaniaRecords']['NeedUpdate'] = true;
			$this->buildRecordWidgets(false, array('DedimaniaRecords' => true, 'LocalRecords' => false, 'LiveRankings' => false));
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.dedimania.php
	public function onDedimaniaRecord ($aseco, $record) {

		// Player reached an new Record at the Map, need to Update the 'DedimaniaRecords'
		$this->config['States']['DedimaniaRecords']['NeedUpdate']	= true;
		$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= true;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onLocalRecordsLoaded ($aseco, $records) {

		$this->config['States']['LocalRecords']['NeedUpdate']		= true;
		$this->config['States']['LocalRecords']['NoRecordsFound']	= false;
		$this->config['States']['LocalRecords']['ChkSum']		= false;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.local_records.php
	public function onLocalRecord ($aseco, $finish_item) {

		// Check if the Player has already a LocalRecord, if not, only then increase MostRecords
		// to prevent double countings.
		$found = false;
		foreach ($this->scores['LocalRecords'] as $item) {
			if ($finish_item->player->login == $item['login']) {
				$found = true;
				break;
			}
		}
		if ($found == false) {
			// Get the Player object
			$player = $aseco->server->players->player_list[$finish_item->player->login];

			// Increase Record count for this Player
			$query = "UPDATE `%prefix%players` SET `MostRecords` = `MostRecords` + 1 WHERE `PlayerId` = '". $player->id ."';";
			$result = $aseco->db->query($query);
			if (!$result) {
				$aseco->console('[RecordsEyepiece] UPDATE `MostRecords` failed. [for statement "'. $query .'"]!');
			}

			foreach ($this->scores['MostRecords'] as &$item) {
				if ($finish_item->player->login == $item['login']) {
					$item['score']++;
					break;
				}
			}
			unset($item);

			// Resort by 'score'
			$data = array();
			foreach ($this->scores['MostRecords'] as $key => $row) {
				$data[$key] = $row['score_plain'];
			}
			array_multisort($data, SORT_NUMERIC, SORT_DESC, $this->scores['MostRecords']);
			unset($data, $key, $row);
		}

		// Player reached an new Record at the Map, need to Update the 'LocalRecords'
		$this->config['States']['LocalRecords']['NeedUpdate']		= true;
		$this->config['States']['LocalRecords']['NoRecordsFound']	= false;
		$this->config['States']['LocalRecords']['ChkSum']		= false;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.rasp_jukebox.php/chat.admin.php
	// $command[0] = 'add', 'clear', 'drop', 'play', 'replay', 'restart', 'skip', 'previous', 'nextenv'
	// $command[1] = map data (or 'null' for the 'clear' action)
	public function onJukeboxChanged ($aseco, $command) {

		// Init
		$widgets = '';

		if ($command[0] == 'clear') {
			$this->cache['Map']['Jukebox'] = false;

			// Rebuild the Widgets
			$this->cache['MapWidget']['Window']	= $this->buildLastCurrentNextMapWindow();
			$this->cache['MapWidget']['Score']	= $this->buildMapWidget('score');
		}

		// Check for changed Jukebox and refresh if required
		$actions = array('add', 'drop', 'play', 'replay', 'restart', 'skip', 'previous', 'nextenv');
		if ( in_array($command[0], $actions) ) {
			// Is a Map in the Jukebox?
			if (count($aseco->plugins['PluginRaspJukebox']->jukebox) > 0) {
				foreach ($aseco->plugins['PluginRaspJukebox']->jukebox as $map) {
					// Need just the next juke'd Map Information, not more
					$this->cache['Map']['Jukebox'] = $map;
					break;
				}
				unset($map);
			}
			else {
				$this->cache['Map']['Jukebox'] = false;
			}


			// Rebuild the Widgets
			$this->cache['MapWidget']['Window']	= $this->buildLastCurrentNextMapWindow();
			$this->cache['MapWidget']['Score']	= $this->buildMapWidget('score');

			// Check if we are at score and refresh the "Next Map" Widget
			if ($aseco->server->gamestate == Server::SCORE) {

				if ( ($command[0] == 'replay') || ($command[0] == 'restart') || ($command[0] == 'skip') || ($command[0] == 'previous') || ($command[0] == 'nextenv') ) {
					// Display the MapWidget (if enabled)
					$widgets .= (($this->cache['MapWidget']['Score'] != false) ? $this->cache['MapWidget']['Score'] : '');
				}
			}
		}

		if (!empty($widgets)) {
			// Send Manialink to all Players
			$this->sendManialink($widgets, false, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from chat.admin.php, plugin.rasp_jukebox.php
	// $command[0] = 'add', 'remove', 'rename', 'juke', 'unjuke', 'read' & 'write'
	// $command[1] = filename of Map (or 'null' for the 'write' or 'read' action)
	public function onMapListChanged ($aseco, $command) {


		// Init
		$widgets = '';

		// Set to 'true' on several parameter to prevent redo this at the event 'onMapListModified'
		if ( ($command[0] == 'add') || ($command[0] == 'remove') || ($command[0] == 'rename') || ($command[0] == 'juke') ) {
			$this->config['States']['MaplistRefreshProgressed'] = true;
		}

		// Check for changed Maplist and refresh complete or partial
		if ($command[0] == 'read') {
			// Get the new Maplist
			$this->getMaplist(false);

			if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
				// Refresh the MapcountWidget
				$this->cache['MapcountWidget'] = $this->buildMapcountWidget();

				// Display the MapcountWidget to all Player
				$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
			}
		}
		else if ( ($command[0] == 'add') || ($command[0] == 'juke') ) {
			// Get the new Maplist
			$this->getMaplist($command[1]);

			if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
				// Refresh the MapcountWidget
				$this->cache['MapcountWidget'] = $this->buildMapcountWidget();

				// Display the MapcountWidget to all Player
				$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
			}
		}
		else if ( ($command[0] == 'remove') || ($command[0] == 'unjuke') ) {
			// Get the new Maplist
			$this->getMaplist($command[1]);

			if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
				// Refresh the MapcountWidget
				$this->cache['MapcountWidget'] = $this->buildMapcountWidget();

				// Display the MapcountWidget to all Player
				$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
			}
		}

		// Clean the local records cache from MaplistWindow at every Player
		if ( ($command[0] == 'read') || ($command[0] == 'remove') ) {
			foreach ($aseco->server->players->player_list as $player) {
				$player->data['PluginRecordsEyepiece']['Maplist']['Records'] = array();
			}
			unset($player);
		}

		if (!empty($widgets) && $aseco->server->gamestate != Server::SCORE) {
			// Send Manialink to all Players
			$this->sendManialink($widgets, false, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// $data[0]=CurChallengeIndex, $data[1]=NextChallengeIndex, $data[2]=IsListModified
	public function onMapListModified ($aseco, $data) {

		// Reload the Maplist now
		if ($data[2] !== false) {
			// Do the work not again, if already done at 'onMaplistChanged'
			if ($this->config['States']['MaplistRefreshProgressed'] == true) {
				$this->config['States']['MaplistRefreshProgressed'] = false;
				return;
			}

			// Init
			$widgets = '';

			// Get the new Maplist
			$this->getMaplist(false);

			if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
				// Refresh the MapcountWidget
				$this->cache['MapcountWidget']	= $this->buildMapcountWidget();

				// Display the MapcountWidget to all Player
				if ($aseco->server->gamestate == Server::RACE) {
					$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
				}
			}

			// Rebuild the Widgets
			$this->cache['MapWidget']['Window']	= $this->buildLastCurrentNextMapWindow();
			$this->cache['MapWidget']['Score']	= $this->buildMapWidget('score');


			// Include the MapWidget (if enabled)
			if ($aseco->server->gamestate == Server::SCORE) {
				$widgets .= (($this->cache['MapWidget']['Score'] != false) ? $this->cache['MapWidget']['Score'] : '');
			}

			if (!empty($widgets)) {
				// Send Manialink to all Players
				$this->sendManialink($widgets, false, 0);
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.musicserver.php
	public function onMusicboxReloaded ($aseco) {


		// Build the Playlist-Cache
		$this->getMusicServerPlaylist(false, false);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.vote_manager.php
	public function onVotingRestartMap ($aseco) {

		// Rebuild the Widgets
		$this->cache['MapWidget']['Score']	= $this->buildMapWidget('score');
		$this->cache['MapWidget']['Window']	= $this->buildLastCurrentNextMapWindow();
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.donate.php
	// $donation = [0]=login, [1]=planets
	public function onDonation ($aseco, $donation) {

		// Increase donations for this Player if in TOP
		$found = false;
		foreach ($this->scores['TopDonators'] as &$item) {
			if ($item['login'] == $donation[0]) {
				$item['score_plain'] += $donation[1];
				$item['score'] = $this->formatNumber($item['score_plain'], 0) .' P';

				// Maybe need to resort if one Player now donate more then an other
				$found = true;
				break;
			}
		}
		unset($item);
		if ($found == false) {
			// Get Player object
			if ($player = $aseco->server->players->getPlayerByLogin($donation[0])) {
				// Add the Player to the TopDonators
				$this->scores['TopDonators'][] = array(
					'login'		=> $player->login,
					'nickname'	=> $this->handleSpecialChars($player->nickname),
					'score'		=> $this->formatNumber((int)$donation[1], 0) .' P',
					'score_plain'	=> (int)$donation[1]
				);
			}
		}

		// Now resort the TopDonators by score
		$score = array();
		foreach ($this->scores['TopDonators'] as $key => $row) {
			$score[$key] = $row['score_plain'];
		}
		array_multisort($score, SORT_DESC, $this->scores['TopDonators']);
		unset($score, $row);

		// Refresh the Array now
		$this->getTopDonators();
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Event from plugin.tm-karma-dot-com.php or plugin.rasp_karma.php
	public function onKarmaChange ($aseco, $karma) {

		// Notice that the Karma need a refresh
		$this->config['States']['TopMaps']['NeedUpdate'] = true;
		$this->config['States']['TopVoters']['NeedUpdate'] = true;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onWarmUpStatusChanged ($aseco, $status) {

		// Store warm-up status
		$this->config['States']['WarmUpPhase'] = $status;

		// Display the RoundScoreWidget
		if ($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$aseco->server->gameinfo->mode][0]['ENABLED'][0] == true) {
			$this->buildRoundScoreWidget($aseco->server->gameinfo->mode, true);
		}

		$widget = false;
		if ($this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0] == true && $this->config['States']['WarmUpPhase'] == false) {
			$widget .= '<manialink id="WarmUpInfoWidget"></manialink>';
		}
		else if ($this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0] == true && $this->config['States']['WarmUpPhase'] == true) {
			$widget .= (($this->cache['WarmUpInfoWidget'] != false) ? $this->cache['WarmUpInfoWidget'] : '');
		}
		if ($widget != false) {
			$this->sendManialink($widget, false, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onUnloadingMap ($aseco, $uid) {

		// Close the Scoretable-Lists at all Players
		$widgets = $this->closeScoretableLists();
		$this->sendManialink($widgets, false, 0);

		// Check if it is time to switch from "normal" to NiceMode or back
		$this->checkServerLoad();

		// Refresh Scoretable lists
		$this->refreshScorelists();

		// Refresh the Playlist-Cache
		if ( ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) && ($this->config['States']['MusicServerPlaylist']['NeedUpdate'] == true) ) {
			$this->getMusicServerPlaylist(true, false);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onBeginRound ($aseco) {

		// Init
		$widgets = '';

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// At Gamemode 'Rounds' or 'Team' need to refresh now
		if ($gamemode == Gameinfo::ROUNDS || $gamemode == Gameinfo::TEAM || $gamemode == Gameinfo::CHASE) {

			// Build the RecordWidgets and ONLY in normal mode send it to each or given Player (if refresh is required)
			$this->buildRecordWidgets(false, false);

			if ($this->config['States']['NiceMode'] == true) {
				// Display the RecordWidgets to all Players
				$widgets .= $this->showRecordWidgets(false);
			}
		}

		// Build the RoundScoreWidget
		if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			// Reset round and display an empty Widget
			$this->scores['RoundScore'] = array();
			$widgets .= $this->buildRoundScoreWidget($gamemode, false);
		}

		// Send widgets to all Players
		if (!empty($widgets)) {
			// Send Manialink
			$this->sendManialink($widgets, false, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onEndRound ($aseco) {

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// At Gamemode 'Rounds', 'Team' or 'Cup' need to refresh now
		if ($gamemode == Gameinfo::ROUNDS || $gamemode == Gameinfo::TEAM || $gamemode == Gameinfo::CUP || $gamemode == Gameinfo::CHASE) {
			$this->config['States']['LiveRankings']['NeedUpdate']		= true;
			$this->config['States']['LiveRankings']['NoRecordsFound']	= false;

			// Force the refresh
			$this->config['States']['RefreshTimestampRecordWidgets'] = 0;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onLoadingMap ($aseco, $map_item) {

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// Special handling for Gamemode 'Laps' or 'Chase'
		if ($gamemode != Gameinfo::LAPS && $gamemode != Gameinfo::CHASE && !empty($aseco->registered_events['onPlayerCheckpoint'])) {
			// Unregister (possible registered) 'onPlayerCheckpoint' event for Gamemode 'Laps' or 'Chase' if this is not 'Laps' or 'Chase'
			foreach ($aseco->registered_events['onPlayerCheckpoint'] as &$item) {
				if ($item[0]->getClassname() == $this->getClassname()) {
					$aseco->console('[RecordsEyepiece] Unregister event "onPlayerCheckpoint", currently not required.');
					unset($item);
					break;
				}
			}
			unset($item);

			// Unregister (possible registered) 'onPlayerFinishLap' event for Gamemode 'Laps' if this is not 'Laps'
			foreach ($aseco->registered_events['onPlayerFinishLap'] as &$item) {
				if ($item[0]->getClassname() == $this->getClassname()) {
					$aseco->console('[RecordsEyepiece] Unregister event "onPlayerFinishLap", currently not required.');
					unset($item);
					break;
				}
			}
			unset($item);
		}
		else if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][Gameinfo::LAPS][0]['ENABLED'][0] == true || $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::LAPS][0]['ENABLED'][0] == true || $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::CHASE][0]['ENABLED'][0] == true) {
			// Register event 'onPlayerCheckpoint' in Gamemode 'Laps' or 'Chase'
			// if <live_rankings><laps> is enabled
			// or <round_score><gamemode><laps> is enabled
			// or <live_rankings><chase> is enabled
			// or <round_score><gamemode><chase> is enabled
			$found = false;
			foreach ($aseco->registered_events['onPlayerCheckpoint'] as $item) {
				if ($item[0]->getClassname() == $this->getClassname()) {
					$found = true;
					break;
				}
			}
			unset($item);
			if ($found == false) {
				$aseco->registerEvent('onPlayerCheckpoint', array($this, 'onPlayerCheckpoint'));
				$aseco->console('[RecordsEyepiece] Register event "onPlayerCheckpoint" to enabled wanted Widgets.');
			}

			// Register event 'onPlayerFinishLap' in Gamemode 'Laps' or 'Chase'
			// if <live_rankings><laps> is enabled
			// or <round_score><gamemode><laps> is enabled
			// if <live_rankings><chase> is enabled
			// or <round_score><gamemode><chase> is enabled
			$found = false;
			foreach ($aseco->registered_events['onPlayerFinishLap'] as $item) {
				if ($item[0]->getClassname() == $this->getClassname()) {
					$found = true;
					break;
				}
			}
			unset($item);
			if ($found == false) {
				$aseco->registerEvent('onPlayerFinishLap', array($this, 'onPlayerFinishLap'));
				$aseco->console('[RecordsEyepiece] Register event "onPlayerFinishLap" to enabled wanted Widgets.');
			}
		}


		// Setup the no-score Placeholder depending at the current Gamemode
		$this->config['PlaceholderNoScore'] = '-:--.---';


		// Setup the RoundScorePoints for the current Gamemodes
		if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			if ($gamemode == Gameinfo::ROUNDS) {
				if ($aseco->server->gameinfo->rounds['UseAlternateRules'] == true) {
					// Only the first wins, no draw!
					$this->config['RoundScore']['Points'][Gameinfo::ROUNDS] = array(1,0);
				}
				else {
					$this->config['RoundScore']['Points'][Gameinfo::ROUNDS] = $aseco->server->gameinfo->rounds['PointsRepartition'];
				}
			}
			else if ($gamemode == Gameinfo::CUP) {
				if ($aseco->server->gameinfo->cup['UseAlternateRules'] == true) {
					// Only the first wins, no draw!
					$this->config['RoundScore']['Points'][Gameinfo::CUP] = array(1,0);
				}
				else {
					$this->config['RoundScore']['Points'][Gameinfo::CUP] = $aseco->server->gameinfo->cup['PointsRepartition'];
				}
			}
			else if ($gamemode == Gameinfo::TEAM) {
				$this->config['RoundScore']['Points'][Gameinfo::TEAM] = array(1);
//				$this->config['RoundScore']['Points'][Gameinfo::TEAM] = $aseco->server->gameinfo->team['PointsRepartition'];
			}
		}

		foreach ($aseco->server->players->player_list as $player) {
			// Reset at each Player the Hash
			$this->cache['PlayerStates'][$player->login]['DedimaniaRecords']	= false;
			$this->cache['PlayerStates'][$player->login]['LocalRecords']	= false;
			$this->cache['PlayerStates'][$player->login]['LiveRankings']	= false;
			$this->cache['PlayerStates'][$player->login]['FinishScore']	= -1;

			// Clean the local recs cache from MaplistWindow and reset WindowAction to default
			$player->data['PluginRecordsEyepiece']['Window']['Action'] = false;
			$player->data['PluginRecordsEyepiece']['Window']['Page'] = 0;
			$player->data['PluginRecordsEyepiece']['Window']['MaxPage'] = 0;
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = false;
			$player->data['PluginRecordsEyepiece']['Maplist']['Records'] = array();
		}


		if ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
			// Clean up
			$this->cache['WinningPayoutPlayers'] = array();

			// Add all Players to the Cache
			foreach ($aseco->server->players->player_list as $player) {
				$this->cache['WinningPayoutPlayers'][$player->login] = array(
					'id'		=> $player->id,
					'login'		=> $player->login,
					'nickname'	=> $player->nickname,
					'ladderrank'	=> $player->ladderrank
				);
			}

			// Reset the limit and let the Player win again, only if this is not disabled.
			if ($this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RESET_LIMIT'][0] > 0) {
				foreach ($this->cache['PlayerWinnings'] as $login => $struct) {
					if ($this->cache['PlayerWinnings'][$login]['TimeStamp'] > 0) {
						if ( (time() >= ($this->cache['PlayerWinnings'][$login]['TimeStamp'] + $this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RESET_LIMIT'][0])) ) {
							// Reset when <reset_limit> was reached
							$this->cache['PlayerWinnings'][$login]['FinishPayment']	= 0;
							$this->cache['PlayerWinnings'][$login]['FinishPaid']	= 0;
							$this->cache['PlayerWinnings'][$login]['TimeStamp']	= 0;
						}
					}
				}
			}

			// Remove all old Players from the array.
			$new['PlayerWinnings'] = array();
			foreach ($this->cache['PlayerWinnings'] as $login => $struct) {
				if ($this->cache['PlayerWinnings'][$login]['TimeStamp'] > 0) {
					// Add all Players with an none empty Players
					$new['PlayerWinnings'][$login] = $struct;
				}
				else if ( isset($aseco->server->players->player_list[$login]) ) {
					// Add all Players that are currently connected
					$new['PlayerWinnings'][$login] = $struct;
				}
			}
			unset($this->cache['PlayerWinnings']);
			$this->cache['PlayerWinnings'] = $new['PlayerWinnings'];
			unset($new['PlayerWinnings']);
		}

		// Display the MapWidget
		$this->cache['MapWidget']['Race']	= $this->buildMapWidget('race');
		$this->cache['MapWidget']['Score']	= $this->buildMapWidget('score');
		$this->cache['MapWidget']['Window']	= $this->buildLastCurrentNextMapWindow();

		// At Gamemode 'Laps' and 'Chase' store the NbLabs from Dedicated-Server and NOT the
		// value from the $map_item, because they does not match the reality!
		if ($aseco->server->gameinfo->mode == Gameinfo::LAPS) {
			$this->cache['Map']['NbCheckpoints'] = $map_item->nbcheckpoints;
			$this->cache['Map']['NbLaps'] = $aseco->server->gameinfo->laps['ForceLapsNb'];
		}
		else if ($aseco->server->gameinfo->mode == Gameinfo::CHASE) {
			$this->cache['Map']['NbCheckpoints'] = $map_item->nbcheckpoints;
			$this->cache['Map']['NbLaps'] = $aseco->server->gameinfo->chase['ForceLapsNb'];
		}
		else {
			$this->cache['Map']['NbCheckpoints'] = $map_item->nbcheckpoints;
			$this->cache['Map']['NbLaps'] = $map_item->nblaps;
		}

	        // Store the forced Laps for 'Rounds', 'Team', 'Laps' and 'Cup'
		if ($gamemode == Gameinfo::ROUNDS) {
			$this->cache['Map']['ForcedLaps'] = $aseco->server->gameinfo->rounds['ForceLapsNb'];
		}
		else if ($gamemode == Gameinfo::TEAM) {
			$this->cache['Map']['ForcedLaps'] = $aseco->server->gameinfo->team['ForceLapsNb'];
		}
		else if ($gamemode == Gameinfo::LAPS) {
			$this->cache['Map']['ForcedLaps'] = $aseco->server->gameinfo->laps['ForceLapsNb'];
		}
		else if ($gamemode == Gameinfo::CUP) {
			$this->cache['Map']['ForcedLaps'] = $aseco->server->gameinfo->cup['ForceLapsNb'];
		}
		else {
			$this->cache['Map']['ForcedLaps'] = 0;
		}

		// Init
		$widgets = '';

		$widgets .= $this->buildClockWidget();

		if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the Music Widget to all Players
			$this->getCurrentSong();
			$this->cache['MusicWidget'] = $this->buildMusicWidget();

			if ($this->config['States']['NiceMode'] == false) {
				foreach ($aseco->server->players->player_list as $player) {

					// Display the MusicWidget only to the Player if they did'nt has them set to hidden
					if ($this->cache['MusicWidget'] != false) {
						$this->sendManialink($this->cache['MusicWidget'], $player->login, 0);
					}
				}
				unset($player);
			}
			else {
				$widgets .= (($this->cache['MusicWidget'] != false) ? $this->cache['MusicWidget'] : '');
			}
		}

		if ($this->config['TOPLIST_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the TopList Widget to all Players
			$widgets .= $this->cache['ToplistWidget'];
		}

		if ($this->config['FAVORITE_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the AddToFavorite Widget
			$widgets .= $this->cache['AddToFavoriteWidget']['Race'];
		}

		if ($this->config['VISITORS_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the Visitors-Widget to all Players
			$widgets .= (($this->cache['VisitorsWidget'] != false) ? $this->cache['VisitorsWidget'] : '');
		}

		$this->cache['WarmUpInfoWidget'] = $this->buildWarmUpInfoWidget();
		if ($this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0] == true && $this->config['States']['WarmUpPhase'] == true) {
			// Display the WarmUpInfoWidget to all Players
			$widgets .= (($this->cache['WarmUpInfoWidget'] != false) ? $this->cache['WarmUpInfoWidget'] : '');
		}

		$this->cache['MultiLapInfoWidget'] = $this->buildMultiLapInfoWidget();
		if ($this->config['MULTILAP_INFO_WIDGET'][0]['ENABLED'][0] == true && ($aseco->server->maps->current->multilap == true && ($gamemode != Gameinfo::TIME_ATTACK && $gamemode != Gameinfo::DOPPLER))) {
			// Display the MultiLapInfoWidget to all Players
			$widgets .= (($this->cache['MultiLapInfoWidget'] != false) ? $this->cache['MultiLapInfoWidget'] : '');
		}

		if ($this->config['SPECTATOR_INFO_WIDGET'][0]['ENABLED'][0] == true) {
			// Send the SpectatorInfoGetter to all Players
			$widgets .= $this->buildSpectatorInfoGetter();
		}

		if ($this->config['MANIAEXCHANGE_WIDGET'][0]['ENABLED'][0] == true) {
			// Refresh the ManiaExchangeWidget
			$this->cache['ManiaExchangeWidget'] = $this->buildManiaExchangeWidget();

			// Display the MapcountWidget to all Player
			$widgets .= (($this->cache['ManiaExchangeWidget'] != false) ? $this->cache['ManiaExchangeWidget'] : '');
		}

		if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
			// Refresh the MapcountWidget
			$this->cache['MapcountWidget'] = $this->buildMapcountWidget();

			// Display the MapcountWidget to all Player
			$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
		}

		// Display the PlacementWidgets at state 'race'
		if ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) {
			$widgets .= $this->cache['PlacementWidget']['Race'];
			if (isset($this->cache['PlacementWidget'][$gamemode])) {
				$widgets .= $this->cache['PlacementWidget'][$gamemode];
			}
		}


		// Reset states of the Widgets
		$this->config['States']['DedimaniaRecords']['NeedUpdate']		= true;
		$this->config['States']['DedimaniaRecords']['UpdateDisplay']		= true;
		$this->config['States']['LocalRecords']['NeedUpdate']			= true;
		$this->config['States']['LocalRecords']['UpdateDisplay']		= true;
		$this->config['States']['LocalRecords']['NoRecordsFound']		= false;
		$this->config['States']['LiveRankings']['NeedUpdate']			= true;
		$this->config['States']['LiveRankings']['UpdateDisplay']		= true;
		$this->config['States']['LiveRankings']['NoRecordsFound']		= false;


		// Load the current Rankings
		$this->cache['CurrentRankings'] = array();
		if (isset($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			if ($gamemode == Gameinfo::TEAM) {
				$this->cache['CurrentRankings'] = $this->getCurrentRanking(2,0);
			}
			else {
				// All other Gamemodes
				$this->cache['CurrentRankings'] = $this->getCurrentRanking(300,0);
			}
		}

		// Build the RecordWidgets and ONLY in normal mode send it to each or given Player (if refresh is required)
		$this->buildRecordWidgets(false, false);

		if ($this->config['States']['NiceMode'] == true) {
			// Display the RecordWidgets to all Players
			$widgets .= $this->showRecordWidgets(false);
		}

		// Just refreshed, mark as fresh
		$this->config['States']['DedimaniaRecords']['UpdateDisplay']		= false;
		$this->config['States']['LocalRecords']['UpdateDisplay']		= false;
		$this->config['States']['LiveRankings']['UpdateDisplay']		= false;

		// Set next refresh timestamp
		$this->config['States']['RefreshTimestampRecordWidgets']		= (time() + $this->config['FEATURES'][0]['REFRESH_INTERVAL'][0]);

		// Set next refresh preload timestamp
		$this->config['States']['RefreshTimestampPreload']			= (time() + 5);

		// Store the possible Placeholder from MX
		if ( (isset($aseco->server->maps->current->mx) ) && ($aseco->server->maps->current->mx != false) ) {
			$this->config['PlacementPlaceholders']['MAP_MX_PREFIX']		= $aseco->server->maps->current->mx->prefix;
			$this->config['PlacementPlaceholders']['MAP_MX_ID']		= $aseco->server->maps->current->mx->id;
			$this->config['PlacementPlaceholders']['MAP_MX_PAGEURL']	= $aseco->server->maps->current->mx->pageurl;
		}
		else {
			// Map not at MX or MX down
			$this->config['PlacementPlaceholders']['MAP_MX_PREFIX']		= false;
			$this->config['PlacementPlaceholders']['MAP_MX_ID']		= false;
			$this->config['PlacementPlaceholders']['MAP_MX_PAGEURL']	= false;
		}
		$this->config['PlacementPlaceholders']['MAP_NAME']			= $aseco->server->maps->current->name;
		$this->config['PlacementPlaceholders']['MAP_UID']			= $aseco->server->maps->current->uid;


		// Include the MapWidget (if enabled)
		$widgets .= (($this->cache['MapWidget']['Race'] != false) ? $this->cache['MapWidget']['Race'] : '');

		// Build an empty RoundScoreWidget
		if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			// Display an empty Widget
			$widgets .= $this->buildRoundScoreWidget($gamemode, false);
		}

//		if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
//			$widgets .= $this->buildLiveRankingsWidgetMS($gamemode, $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0]);
//		}

		// Send widgets to all Players
		if (!empty($widgets)) {
			// Send Manialink
			$this->sendManialink($widgets, false, 0);
		}


		// Reset state
		$this->config['States']['MaplistRefreshProgressed'] = false;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// $checkpt = [0]=Login, [1]=WaypointBlockId, [2]=Time [3]=WaypointIndex, [4]=CurrentLapTime, [6]=LapWaypointNumber
	// This event is only activated in Gamemode 'Laps'
	// if <live_rankings><laps> is enabled
	// or <round_score><gamemode><laps> is enabled
	// or <live_rankings><chase> is enabled
	// or <round_score><gamemode><chase> is enabled
	public function onPlayerCheckpoint ($aseco, $checkpt) {

		if (($aseco->server->gameinfo->mode == Gameinfo::LAPS && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::LAPS][0]['ENABLED'][0] == true) || ($aseco->server->gameinfo->mode == Gameinfo::CHASE && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::CHASE][0]['ENABLED'][0] == true)) {

			// Get the Player object
			$player = $aseco->server->players->player_list[$checkpt[0]];

			// Add the Score
			$this->scores['RoundScore'][$player->login] = array(
				'team'		=> $player->data['PluginRecordsEyepiece']['Prefs']['TeamId'],
				'checkpointid'	=> ($checkpt[3] - 1),
				'playerid'	=> $player->pid,
				'login'		=> $player->login,
				'nickname'	=> $this->handleSpecialChars($player->nickname),
				'score'		=> $aseco->formatTime($checkpt[2]),
				'score_plain'	=> $checkpt[2]
			);

			// Display the Widget
			$this->buildRoundScoreWidget($aseco->server->gameinfo->mode, true);
		}

		// Only work at 'Laps' or 'Chase'
		if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][Gameinfo::LAPS][0]['ENABLED'][0] == true) {
			// Let the LiveRankings refresh, when a Player drive through one
			$this->config['States']['LiveRankings']['NeedUpdate']		= true;
			$this->config['States']['LiveRankings']['NoRecordsFound']	= false;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// $checkpt = [0]=Login, [1]=WaypointBlockId, [2]=Time [3]=WaypointIndex, [4]=CurrentLapTime, [6]=LapWaypointNumber
	public function onPlayerFinishLap ($aseco, $checkpt) {

		if (($aseco->server->gameinfo->mode == Gameinfo::LAPS && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::LAPS][0]['ENABLED'][0] == true) || ($aseco->server->gameinfo->mode == Gameinfo::CHASE && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][Gameinfo::CHASE][0]['ENABLED'][0] == true)) {
			// Get the Player object
			$player = $aseco->server->players->player_list[$checkpt[0]];

			// Add the Score
			$this->scores['RoundScore'][$player->login] = array(
				'team'		=> $player->data['PluginRecordsEyepiece']['Prefs']['TeamId'],
				'checkpointid'	=> ($checkpt[3] - 1),
				'playerid'	=> $player->pid,
				'login'		=> $player->login,
				'nickname'	=> $this->handleSpecialChars($player->nickname),
				'score'		=> $aseco->formatTime($checkpt[2]),
				'score_plain'	=> $checkpt[2]
			);

			// Display the Widget
			$this->buildRoundScoreWidget($aseco->server->gameinfo->mode, true);
		}

		// Only work at 'Laps' or 'Chase'
		if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][Gameinfo::LAPS][0]['ENABLED'][0] == true) {
			// Let the LiveRankings refresh, when a Player drive through one
			$this->config['States']['LiveRankings']['NeedUpdate']		= true;
			$this->config['States']['LiveRankings']['NoRecordsFound']	= false;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// $checkpt = [0]=Login, [1]=WaypointBlockId, [2]=Time [3]=WaypointIndex, [4]=CurrentLapTime, [6]=LapWaypointNumber
	public function onPlayerFinishLine ($aseco, $checkpt) {

		if ($aseco->server->gameinfo->mode == Gameinfo::ROUNDS || $aseco->server->gameinfo->mode == Gameinfo::TEAM || $aseco->server->gameinfo->mode == Gameinfo::CUP || $aseco->server->gameinfo->mode == Gameinfo::TEAM_ATTACK) {
			// Get Player object
			$player = $aseco->server->players->getPlayerByLogin($checkpt[0]);

			// Add the Score
			$this->scores['RoundScore'][$checkpt[2]][] = array(
				'team'		=> $player->data['PluginRecordsEyepiece']['Prefs']['TeamId'],
				'checkpointid'	=> ($checkpt[3] - 1),
				'playerid'	=> $player->pid,
				'login'		=> $player->login,
				'nickname'	=> $this->handleSpecialChars($player->nickname),
				'score'		=> $aseco->formatTime($checkpt[2]),
				'score_plain'	=> $checkpt[2]
			);

			// Store personal best round-score for sorting on equal times of more Players
			if ( ( isset($this->scores['RoundScorePB'][$player->login]) ) && ($this->scores['RoundScorePB'][$player->login] > $checkpt[2]) ) {
				$this->scores['RoundScorePB'][$player->login] = $checkpt[2];
			}
			else {
				$this->scores['RoundScorePB'][$player->login] = $checkpt[2];
			}

			// Display the Widget
			$this->buildRoundScoreWidget($aseco->server->gameinfo->mode, true);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onRestartMap ($aseco, $uid) {

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// Close the Scoretable-Lists at all Players
		$this->sendManialink($this->closeScoretableLists(), false, 0);

		// Init
		$widgets = '';

		// Display the PlacementWidgets at state 'race'
		if ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) {
			$widgets .= $this->cache['PlacementWidget']['Race'];
			if (isset($this->cache['PlacementWidget'][$gamemode])) {
				$widgets .= $this->cache['PlacementWidget'][$gamemode];
			}
		}

		$widgets .= $this->buildClockWidget();

		if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the Music Widget to all Players
			if ($this->config['States']['NiceMode'] == false) {
				foreach ($aseco->server->players->player_list as $player) {

					// Display the MusicWidget only to the Player if they did'nt has them set to hidden
					if ($this->cache['MusicWidget'] != false) {
						$this->sendManialink($this->cache['MusicWidget'], $player->login, 0);
					}
				}
				unset($player);
			}

			else {
				$widgets .= (($this->cache['MusicWidget'] != false) ? $this->cache['MusicWidget'] : '');
			}
		}

		if ($this->config['TOPLIST_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the TopList Widget to all Players
			$widgets .= $this->cache['ToplistWidget'];
		}

		if ($this->config['FAVORITE_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the AddToFavorite Widget
			$widgets .= $this->cache['AddToFavoriteWidget']['Race'];
		}

		if ($this->config['VISITORS_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the Visitors-Widget to all Players
			$widgets .= (($this->cache['VisitorsWidget'] != false) ? $this->cache['VisitorsWidget'] : '');
		}

		if ($this->config['WARM_UP_INFO_WIDGET'][0]['ENABLED'][0] == true && $this->config['States']['WarmUpPhase'] == true) {
			// Display the WarmUpInfoWidget to all Players
			$widgets .= (($this->cache['WarmUpInfoWidget'] != false) ? $this->cache['WarmUpInfoWidget'] : '');
		}

		if ($this->config['MULTILAP_INFO_WIDGET'][0]['ENABLED'][0] == true && ($aseco->server->maps->current->multilap == true && ($gamemode != Gameinfo::TIME_ATTACK && $gamemode != Gameinfo::DOPPLER))) {
			// Display the MultiLapInfoWidget to all Players
			$widgets .= (($this->cache['MultiLapInfoWidget'] != false) ? $this->cache['MultiLapInfoWidget'] : '');
		}

		if ($this->config['SPECTATOR_INFO_WIDGET'][0]['ENABLED'][0] == true) {
			// Send the SpectatorInfoGetter to connecting Player
			$widgets .= $this->buildSpectatorInfoGetter();
		}

		if ($this->config['MANIAEXCHANGE_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the ManiaExchangeWidget to connecting Player
			$widgets .= (($this->cache['ManiaExchangeWidget'] != false) ? $this->cache['ManiaExchangeWidget'] : '');
		}

		if ($this->config['MAPCOUNT_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the MapcountWidget to all Player
			$widgets .= (($this->cache['MapcountWidget'] != false) ? $this->cache['MapcountWidget'] : '');
		}

		// Reset at each Player the Hash
		foreach ($aseco->server->players->player_list as $player) {
			$this->cache['PlayerStates'][$player->login]['DedimaniaRecords']	= false;
			$this->cache['PlayerStates'][$player->login]['LocalRecords']		= false;
			$this->cache['PlayerStates'][$player->login]['LiveRankings']		= false;
			$this->cache['PlayerStates'][$player->login]['FinishScore']		= -1;
		}
		unset($player);

		// Reset states of the Widgets
		$this->config['States']['DedimaniaRecords']['NeedUpdate']	= true;
		$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= true;
		$this->config['States']['LocalRecords']['NeedUpdate']		= true;
		$this->config['States']['LocalRecords']['UpdateDisplay']	= true;
		$this->config['States']['LocalRecords']['NoRecordsFound']	= false;
		$this->config['States']['LiveRankings']['NeedUpdate']		= true;
		$this->config['States']['LiveRankings']['UpdateDisplay']	= true;
		$this->config['States']['LiveRankings']['NoRecordsFound']	= false;

		// Build the RecordWidgets and ONLY in normal mode send it to each or given Player (if refresh is required)
		$this->buildRecordWidgets(false, false);

		if ($this->config['States']['NiceMode'] == true) {
			// Display the RecordWidgets to all Players
			$widgets .= $this->showRecordWidgets(false);
		}

		// Just refreshed, mark as fresh
		$this->config['States']['DedimaniaRecords']['UpdateDisplay']	= false;
		$this->config['States']['LocalRecords']['UpdateDisplay']	= false;
		$this->config['States']['LiveRankings']['UpdateDisplay']	= false;

		// Set next refresh timestamp
		$this->config['States']['RefreshTimestampRecordWidgets'] = (time() + $this->config['FEATURES'][0]['REFRESH_INTERVAL'][0]);

		// Display the MapWidget (if enabled)
		$widgets .= (($this->cache['MapWidget']['Race'] != false) ? $this->cache['MapWidget']['Race'] : '');

		// Clear the RoundScore array and hide the Widget
		if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			// Reset round
			$this->scores['RoundScore']	= array();
			$this->scores['RoundScorePB']	= array();

			// Reset Widget
			$widgets .= $this->buildRoundScoreWidget($gamemode, false);
		}

		// Send all widgets
		if ($widgets != '') {
			// Send Manialink
			$this->sendManialink($widgets, false, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function onEndMapRanking ($aseco, $race) {

		// Bail out if there are no Players
		if (count($aseco->server->players->player_list) == 0) {
			return;
		}

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// Init
		$widgets = '';

		// Close all RaceWidgets at all connected Players (incl. all Windows)
		$widgets .= $this->closeRaceWidgets(false, true);

		// Build the PlacementWidgets at state 'score'
		if ($this->config['PLACEMENT_WIDGET'][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildPlacementWidget('score');
		}

		if ($this->config['WINNING_PAYOUT'][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildWinningPayoutWidget();
		}

		if ($this->config['DONATION_WIDGET'][0]['ENABLED'][0] == true) {
			$widgets .= $this->cache['DonationWidget'];
		}

		if ($this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildTopAverageTimesForScore($this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['ENTRIES'][0]);

			// Reset for the new Map
			$this->scores['TopAverageTimes'] = array();
		}
		if ($this->config['SCORETABLE_LISTS'][0]['DEDIMANIA_RECORDS'][0]['ENABLED'][0] == true) {
			if ($this->config['States']['DedimaniaRecords']['NeedUpdate'] == true) {
				$this->getDedimaniaRecords();
			}
			$widgets .= $this->buildScorelistWidgetEntry('DedimaniaRecordsWidget', $this->config['SCORETABLE_LISTS'][0]['DEDIMANIA_RECORDS'][0], $this->scores['DedimaniaRecords'], array('score', 'nickname'));
		}
		if ($this->config['SCORETABLE_LISTS'][0]['LOCAL_RECORDS'][0]['ENABLED'][0] == true) {
			if ($this->config['States']['LocalRecords']['NeedUpdate'] == true) {
				$this->getLocalRecords($gamemode);
			}
			$widgets .= $this->buildScorelistWidgetEntry('LocalRecordsWidget', $this->config['SCORETABLE_LISTS'][0]['LOCAL_RECORDS'][0], $this->scores['LocalRecords'], array('score', 'nickname'));
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_RANKINGS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopRankings'] != false) ? $this->cache['TopRankings'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopWinners'] != false) ? $this->cache['TopWinners'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['MOST_RECORDS'][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildScorelistWidgetEntry('MostRecordsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['MOST_RECORDS'][0], $this->scores['MostRecords'], array('score', 'nickname'));
		}
		if ($this->config['SCORETABLE_LISTS'][0]['MOST_FINISHED'][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildScorelistWidgetEntry('MostFinishedWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['MOST_FINISHED'][0], $this->scores['MostFinished'], array('score', 'nickname'));
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_PLAYTIME'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopPlaytime'] != false) ? $this->cache['TopPlaytime'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_DONATORS'][0]['ENABLED'][0] == true) {
			$widgets .= $this->buildScorelistWidgetEntry('TopDonatorsWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_DONATORS'][0], $this->scores['TopDonators'], array('score', 'nickname'));
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopNations'] != false) ? $this->cache['TopNations'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_MAPS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopMaps'] != false) ? $this->cache['TopMaps'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_VOTERS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopVoters'] != false) ? $this->cache['TopVoters'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopBetwins'] != false) ? $this->cache['TopBetwins'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_WINNING_PAYOUTS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopWinningPayouts'] != false) ? $this->cache['TopWinningPayouts'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_VISITORS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopVisitors'] != false) ? $this->cache['TopVisitors'] : '');
		}
		if ($this->config['SCORETABLE_LISTS'][0]['TOP_ACTIVE_PLAYERS'][0]['ENABLED'][0] == true) {
			$widgets .= (($this->cache['TopActivePlayers'] != false) ? $this->cache['TopActivePlayers'] : '');
		}
		if ( ($gamemode == Gameinfo::ROUNDS) || ($gamemode == Gameinfo::CUP) ) {
			// Store the won RoundScore to the Database-Table
			$this->storePlayersRoundscore();

			// Refresh the TopRoundscore Array
			$this->getTopRoundscore();
			if ($this->config['SCORETABLE_LISTS'][0]['TOP_ROUNDSCORE'][0]['ENABLED'][0] == true) {
				$this->cache['TopRoundscore'] = $this->buildScorelistWidgetEntry('TopRoundscoreWidgetAtScore', $this->config['SCORETABLE_LISTS'][0]['TOP_ROUNDSCORE'][0], $this->scores['TopRoundscore'], array('score', 'nickname'));
				$widgets .= $this->cache['TopRoundscore'];
			}
		}

		$widgets .= $this->buildClockWidget();

		// Display the MapWidget (if enabled)
		$widgets .= (($this->cache['MapWidget']['Score'] != false) ? $this->cache['MapWidget']['Score'] : '');


		// Clear the RoundScore array and hide the Widget
		if (isset($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode]) && $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			// Reset round
			$this->scores['RoundScore']	= array();
			$this->scores['RoundScorePB']	= array();

			// Hide the Widget
			$widgets .= '<manialink id="RoundScoreWidget"></manialink>';
		}

		if ($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['ENABLED'][0] == true) {
			// Build & display the NextEnvironmentWidget
			$widgets .= $this->buildNextEnvironmentWidgetForScore();
		}

		if ($this->config['NEXT_GAMEMODE_WIDGET'][0]['ENABLED'][0] == true) {
			// Build & display the NextGamemodeWidget
			$widgets .= $this->buildNextGamemodeWidgetForScore();
		}

		if ($this->config['FAVORITE_WIDGET'][0]['ENABLED'][0] == true) {
			// Display the AddToFavorite Widget
			$widgets .= $this->cache['AddToFavoriteWidget']['Score'];
		}

		if ($widgets != '') {
			// Send Manialink to all Players
			$this->sendManialink($widgets, false, 0);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildToplistWidget () {
		return $this->templates['TOPLIST_WIDGET']['CONTENT'];
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildAddToFavoriteWidget ($mode = 'RACE') {

		$bg = "";
		if ($this->config['FAVORITE_WIDGET'][0][$mode][0]['BACKGROUND_DEFAULT'][0] != '') {
			$bg = '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['FAVORITE_WIDGET'][0][$mode][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['FAVORITE_WIDGET'][0][$mode][0]['BACKGROUND_FOCUS'][0] .'" scriptevents="1" id="ButtonAddToFavoriteWidget"/>';
		}
		else {
			$bg = '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['FAVORITE_WIDGET'][0][$mode][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['FAVORITE_WIDGET'][0][$mode][0]['BACKGROUND_SUBSTYLE'][0] .'" scriptevents="1" id="ButtonAddToFavoriteWidget"/>';
		}

		$xml = str_replace(
			array(
				'%posx%',
				'%posy%',
				'%widgetscale%',
				'%background%',
			),
			array(
				($this->config['FAVORITE_WIDGET'][0][$mode][0]['POS_X'][0] * 2.5),
				($this->config['FAVORITE_WIDGET'][0][$mode][0]['POS_Y'][0] * 1.875),
				$this->config['FAVORITE_WIDGET'][0][$mode][0]['SCALE'][0],
				$bg,
			),
			$this->templates['FAVORITE_WIDGET']['CONTENT']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildNextEnvironmentWidgetForScore () {
		global $aseco;

		$env = '';
		if ($aseco->server->maps->next->environment == 'Canyon') {
			$env = '<quad posn="4.025 -1.3125 0.06" sizen="20 7.5" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_CANYON'][0] .'"/>';
		}
		else if ($aseco->server->maps->next->environment == 'Stadium') {
			$env = '<quad posn="4.025 -1.3125 0.06" sizen="20 7.5" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_STADIUM'][0] .'"/>';
		}
		else if ($aseco->server->maps->next->environment == 'Valley') {
			$env = '<quad posn="4.025 -1.3125 0.06" sizen="20 7.5" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_VALLEY'][0] .'"/>';
		}

		$xml = str_replace(
			'%icon%',
			$env,
			$this->templates['NEXT_ENVIRONMENT']['CONTENT']
		);
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildNextGamemodeWidgetForScore () {
		global $aseco;

		if ($aseco->changing_to_gamemode !== false) {
			// Setup next Gamemode
			$gamemode = $aseco->changing_to_gamemode;
		}
		else {
			// Current Gamemode is the same as next Gamemode
			$gamemode = $aseco->server->gameinfo->mode;
		}
		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%'
			),
			array(
				'Icons128x32_1',
				(isset($this->config['Gamemodes'][$gamemode]) ? $this->config['Gamemodes'][$gamemode]['icon'] : 'BgQuadWhite')
			),
			$this->templates['NEXT_GAMEMODE']['CONTENT']
		);
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildVisitorsWidget () {

		// Build the VisitorsWidget
		$xml = str_replace(
			array(
				'%visitorcount%'
			),
			array(
				$this->scores['Visitors']
			),
			$this->templates['VISITORS_WIDGET']['CONTENT']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildWarmUpInfoWidget () {
		return $this->templates['WARM_UP_INFO_WIDGET']['CONTENT'];
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMultiLapInfoWidget () {
		global $aseco;


		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		$totallaps = 0;
		if ($aseco->plugins['PluginCheckpoints']->forcedlaps > 0) {
			$totallaps = $aseco->plugins['PluginCheckpoints']->forcedlaps;
		}
		else {
			$totallaps = $aseco->plugins['PluginCheckpoints']->nblaps;
		}

		// Build the MultiLapInfoWidget
		$xml = str_replace(
			array(
				'%totallaps%'
			),
			array(
				$totallaps
			),
			$this->templates['MULTILAP_INFO_WIDGET']['CONTENT']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildSpectatorInfoGetter () {
		return $this->templates['SPECTATOR_INFO_WIDGET']['GETTING_SCRIPT'];
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function updateSpectatorList ($spectator, $target) {
		global $aseco;

		// Update target
		$this->cache['SpectatorOverview'][$spectator] = $target;

		$targets = array();
		foreach ($this->cache['SpectatorOverview'] as $s => $t) {
			if (!empty($t)) {
				if (empty($targets[$t])) {
					$targets[$t] = 0;
				}
				$targets[$t] += 1;
			}
		}

		// Send Widget only to Players that have spectators
		foreach ($targets as $login => $amount) {
			$this->buildSpectatorInfoWidget($login, $amount);
		}

		$remove = array();
		foreach ($aseco->server->players->player_list as $player) {
			if (!isset($targets[$player->login])) {
				$remove[] = $player->login;
			}
		}

		// Remove Widget from all Players without
		$xml = '<manialink id="SpectatorInfoWidget"></manialink>';
		$aseco->addManialink($xml, implode(',', $remove));
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildSpectatorInfoWidget ($login, $amount) {
		global $aseco;

		$xml = str_replace(
			'%amount_spectators%',
			$amount,
			$this->templates['SPECTATOR_INFO_WIDGET']['WIDGET']
		);
		$aseco->sendManialink($xml, $login);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildImagePreload ($part = 1) {

//		// Free the display from the preloaded images
//		if ($part == 5) {
//			$xml  = '<manialink id="ImagePreloadBox1"></manialink>';
//			$xml .= '<manialink id="ImagePreloadBox2"></manialink>';
//			$xml .= '<manialink id="ImagePreloadBox3"></manialink>';
//			$xml .= '<manialink id="ImagePreloadBox4"></manialink>';
//			$xml .= '<manialink id="ImagePreloadBox5"></manialink>';
//			return $xml;
//		}

		$xml  = '<manialink id="ImagePreloadBox'. $part .'">';
		$xml .= '<frame posn="-120 -120 0">';		// Place outside visibility

		if ($part == 1) {
//			$xml .= '<quad posn="0 0 0" sizen="3.5 3.5" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_LEFT'][0] .'"/>';		// Loaded in Widgets, no need to preload
//			$xml .= '<quad posn="0 0 0" sizen="3.5 3.5" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_RIGHT'][0] .'"/>';	// Loaded in Widgets, no need to preload
//			$xml .= '<quad posn="0 0 0" sizen="2.1 2.1" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_SMALL'][0] .'"/>';	// Loaded in Widgets, no need to preload

			// Progress Bar
			$xml .= '<quad posn="0 0 0" sizen="22 22" halign="center" valign="center" image="'. $this->config['IMAGES'][0]['PROGRESS_INDICATOR'][0] .'"/>';

			$xml .= '<quad posn="0 0 0" sizen="21.25 16.09" image="'. $this->config['IMAGES'][0]['NO_SCREENSHOT'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="4 4" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_NORMAL'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="4 4" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_FOCUS'][0] .'"/>';
		}
		else if ($part == 2) {
			$xml .= '<quad posn="0 0 0" sizen="4 4" image="'. $this->config['IMAGES'][0]['WIDGET_MINUS_NORMAL'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="4 4" image="'. $this->config['IMAGES'][0]['WIDGET_MINUS_FOCUS'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="4 4" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="4 4" image="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="7.2 4.344" image="'. $this->config['IMAGES'][0]['WORLDMAP'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="3.2 3.2" image="'. $this->config['IMAGES'][0]['ICON_MANIA_EXCHANGE'][0] .'"/>';
		}
		else if ($part == 3) {
			// <environment>
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_CANYON'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['FOCUS'][0]['ICON_CANYON'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_STADIUM'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['FOCUS'][0]['ICON_STADIUM'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_VALLEY'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['FOCUS'][0]['ICON_VALLEY'][0] .'"/>';
		}
		else if ($part == 4) {
			// <mood>
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['SUNRISE'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['SUNRISE'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['DAY'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['DAY'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['SUNSET'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['SUNSET'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['NIGHT'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['NIGHT'][0] .'"/>';
		}
		else if ($part == 5) {
			// <continents>
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['AFRICA'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['ASIA'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['EUROPE'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['MIDDLE_EAST'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['NORTH_AMERICA'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['SOUTH_AMERICA'][0] .'"/>';
			$xml .= '<quad posn="0 0 0" sizen="10.88 5.44" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['OCEANIA'][0] .'"/>';
		}

		$xml .= '</frame>';
		$xml .= '</manialink>';

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildManiaExchangeWidget () {
		global $aseco;

		$xml = '';
		if ( isset($aseco->server->maps->current->mx->id) ) {
			if ( (isset($aseco->server->maps->current->mx->recordlist)) && (count($aseco->server->maps->current->mx->recordlist) > 0) ) {
				$score = $aseco->formatTime($aseco->server->maps->current->mx->recordlist[0]['replaytime']);
			}
			else {
				$score = 'NO';
			}

			// Build the ManiaExchangeWidget with ActionId
			$xml = $this->templates['MANIA_EXCHANGE']['HEADER'];
			if ($this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
				$xml .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_FOCUS'][0] .'" scriptevents="1" id="ButtonManiaExchangeWidget"/>';
			}
			else {
				$xml .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'" scriptevents="1" id="ButtonManiaExchangeWidget"/>';
			}
			$xml .= '<quad posn="-0.45 -8.625 0.002" sizen="5.25 3.9375" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_SMALL'][0] .'"/>';
			$xml .= str_replace(
				array(
					'%offline_record%',
					'%text%'
				),
				array(
					$score,
					'MX-RECORD'
				),
				$this->templates['MANIA_EXCHANGE']['FOOTER']
			);
		}
		else {
			// Build the ManiaExchangeWidget WITHOUT ActionId
			$xml = $this->templates['MANIA_EXCHANGE']['HEADER'];
			if ($this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
				$xml .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_FOCUS'][0] .'"/>';
			}
			else {
				$xml .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
			}
			$xml .= str_replace(
				array(
					'%offline_record%',
					'%text%'
				),
				array(
					'MAP IS',
					'NOT ON MX'
				),
				$this->templates['MANIA_EXCHANGE']['FOOTER']
			);
		}
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMapcountWidget () {
		global $aseco;

		// Build the MapcountWidget
		$xml = str_replace(
			array(
				'%mapcount%'
			),
			array(
				$this->formatNumber($aseco->server->maps->count(), 0)
			),
			$this->templates['MAPCOUNT']['CONTENT']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMusicWidget () {
		global $aseco;

		// Set the right Icon and Title position
		$position = (($this->config['MUSIC_WIDGET'][0]['POS_X'][0] < 0) ? 'right' : 'left');

		if ($position == 'right') {
			$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5));
			$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5));
			$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5));
		}
		else {
			$imagex	= $this->config['Positions'][$position]['image_open']['x'];
			$iconx	= $this->config['Positions'][$position]['icon']['x'];
			$titlex	= $this->config['Positions'][$position]['title']['x'];
		}

		// Build the MusicWidget
		$xml = str_replace(
			array(
				'%manialinkid%',
				'%actionid%',
				'%posx%',
				'%posy%',
				'%image_open_pos_x%',
				'%image_open_pos_y%',
				'%image_open%',
				'%posx_icon%',
				'%posy_icon%',
				'%posx_title%',
				'%posy_title%',
				'%halign%',
				'%backgroundwidth%',
				'%borderwidth%',
				'%widgetwidth%',
				'%title_background_width%',
				'%title%'
			),
			array(
				'MusicWidget',
				'showMusiclistWindow',
				($this->config['MUSIC_WIDGET'][0]['POS_X'][0] * 2.5),
				($this->config['MUSIC_WIDGET'][0]['POS_Y'][0] * 1.875),
				$imagex,
				-7.75,
				$this->config['Positions'][$position]['image_open']['image'],
				$iconx,
				$this->config['Positions'][$position]['icon']['y'],
				$titlex,
				$this->config['Positions'][$position]['title']['y'],
				$this->config['Positions'][$position]['title']['halign'],
				(($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5) - 0.5),
				(($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5) + 1),
				($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5),
				(($this->config['MUSIC_WIDGET'][0]['WIDTH'][0] * 2.5) - 2),
				$this->config['MUSIC_WIDGET'][0]['TITLE'][0]
			),
			$this->templates['MUSIC_WIDGET']['HEADER']
		);

		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="33.875 3.75" class="labels" text="'. $this->config['CurrentMusicInfos']['Title'] .'"/>';
		$xml .= '<label posn="2.5 -8.4375 0.04" sizen="37.125 3.75" class="labels" scale="0.9" text="by '. $this->config['CurrentMusicInfos']['Artist'] .'"/>';
//		if ($this->config['MUSIC_WIDGET'][0]['ADVERTISE'][0] == true) {
//			$xml .= '<quad posn="23.75 -11.625 0.05" sizen="13 3.1875" url="http://www.amazon.com/gp/search?ie=UTF8&amp;keywords='. urlencode($aseco->stripColors($this->config['CurrentMusicInfos']['Artist'], true)) .'&amp;tag=undefde-20&amp;index=digital-music&amp;linkCode=ur2&amp;camp=1789&amp;creative=9325" image="http://maniacdn.net/undef.de/uaseco/records-eyepiece/logo-amazon-normal.png" imagefocus="maniacdn.net/undef.de/uaseco/records-eyepiece/logo-amazon-focus.png"/>';
//		}
		$xml .= $this->templates['MUSIC_WIDGET']['FOOTER'];

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildClockWidget () {
		global $aseco;

		// Transform lowercase GameState 'race' (Server::RACE) or 'score' (Server::SCORE) to UPPERCASE
		$gamestate = strtoupper($aseco->server->gamestate);

		// Bail out if not enabled at gamestate
		if ($this->config['CLOCK_WIDGET'][0][$gamestate][0]['ENABLED'][0] == false) {
			return;
		}

		// Build the ClockWidget
		$bg = "";
		if ($this->config['CLOCK_WIDGET'][0][$gamestate][0]['BACKGROUND_DEFAULT'][0] != '') {
			$bg = '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['CLOCK_WIDGET'][0][$gamestate][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['CLOCK_WIDGET'][0][$gamestate][0]['BACKGROUND_FOCUS'][0] .'"/>';
		}
		else {
			$bg = '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['CLOCK_WIDGET'][0][$gamestate][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['CLOCK_WIDGET'][0][$gamestate][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}

		$xml = str_replace(
			array(
				'%posx%',
				'%posy%',
				'%widgetscale%',
				'%background%'
			),
			array(
				($this->config['CLOCK_WIDGET'][0][$gamestate][0]['POS_X'][0] * 2.5),
				($this->config['CLOCK_WIDGET'][0][$gamestate][0]['POS_Y'][0] * 1.875),
				$this->config['CLOCK_WIDGET'][0][$gamestate][0]['SCALE'][0],
				$bg
			),
			$this->templates['CLOCK_WIDGET']['CONTENT']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildPlacementWidget ($gamestate = 'score') {
		global $aseco;

		// Init
		$xml = '';

		// Preset the search pattern
		$searchpattern = '(%MAP_MX_PREFIX%|%MAP_MX_ID%|%MAP_MX_PAGEURL%|%MAP_UID%|%MAP_NAME%)';

		$mx = false;
		if ($this->config['PlacementPlaceholders']['MAP_MX_PREFIX'] != false) {
			$mx = true;
		}

		if ($gamestate === 'always') {

			// Build the Widgets at 'always'
			$xml .= '<manialink id="PlacementWidgetAlways" name="PlacementWidgetAlways" version="2">';
			$xml .= '<frame posn="0 0 0">';
			foreach ($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] as $placement) {
				if ($placement['DISPLAY'][0] == 'ALWAYS') {

					// First: Remove all Placeholder, that are not supported here,
					// because this <placement> are never refreshed!
					$xml = str_replace(
						array('%MAP_MX_PREFIX%','%MAP_MX_ID%','%MAP_UID%','%MAP_NAME%','%MAP_MX_PAGEURL%'),
						array('','','','',''),
						$xml
					);

					// Second: Build the <placement>
					$xml .= $this->getPlacementEntry($placement);
				}
			}
			$xml .= '</frame>';
			$xml .= '</manialink>';
		}

		if ($gamestate === Server::RACE) {

			// Build the Widgets at 'race'
			$xml .= '<manialink id="PlacementWidgetRace" name="PlacementWidgetRace" version="2">';
			$xml .= '<frame posn="0 0 0">';
			foreach ($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] as $placement) {
				if ($placement['DISPLAY'][0] == 'RACE') {

					// First: Remove all Placeholder, that are not supported here,
					// because this <placement> are never refreshed after map change!
					$xml = str_replace(
						array('%MAP_MX_PREFIX%','%MAP_MX_ID%','%MAP_UID%','%MAP_NAME%','%MAP_MX_PAGEURL%'),
						array('','','','',''),
						$xml
					);

					// Second: Build the <placement>
					$xml .= $this->getPlacementEntry($placement);
				}
			}
			$xml .= '</frame>';
			$xml .= '</manialink>';

			// Hide 'score' PlacementWidgets
			$xml .= '<manialink id="PlacementWidgetScore"></manialink>';
		}

		if ($gamestate === Gameinfo::ROUNDS || $gamestate === Gameinfo::TIME_ATTACK || $gamestate === Gameinfo::TEAM || $gamestate === Gameinfo::LAPS || $gamestate === Gameinfo::CUP) {

			// Build the Widgets at 'gamemode'
			$xml .= '<manialink id="PlacementWidgetGamemode" name="PlacementWidgetGamemode" version="2">';
			$xml .= '<frame posn="0 0 0">';
			foreach ($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] as $placement) {
				if ($placement['DISPLAY'][0] === $gamestate) {

					// First: Remove all Placeholder, that are not supported here,
					// because this <placement> are never refreshed after map change!
					$xml = str_replace(
						array('%MAP_MX_PREFIX%','%MAP_MX_ID%','%MAP_UID%','%MAP_NAME%','%MAP_MX_PAGEURL%'),
						array('','','','',''),
						$xml
					);

					// Second: Build the <placement>
					$xml .= $this->getPlacementEntry($placement);
				}
			}
			$xml .= '</frame>';
			$xml .= '</manialink>';

			// Hide 'score' PlacementWidgets
			$xml .= '<manialink id="PlacementWidgetScore"></manialink>';
		}

		if ($gamestate === Server::SCORE) {

			// Build the Widgets at 'score'
			$xml .= '<manialink id="PlacementWidgetScore" name="PlacementWidgetScore" version="2">';
			$xml .= '<frame posn="0 0 0">';
			foreach ($this->config['PLACEMENT_WIDGET'][0]['PLACEMENT'] as $placement) {
				if ($placement['DISPLAY'][0] == 'SCORE') {
					if ($mx == false) {
						// Try to find Placeholders and skip
						if ( isset($placement['URL'][0]) ) {
							if (preg_match($searchpattern, $placement['URL'][0]) > 0) {
								continue;
							}
						}
						if ( isset($placement['MANIALINK'][0]) ) {
							if (preg_match($searchpattern, $placement['MANIALINK'][0]) > 0) {
								continue;
							}
						}
					}
					$xml .= $this->getPlacementEntry($placement);
				}
			}
			$xml .= '</frame>';
			$xml .= '</manialink>';

			// Hide 'race' and 'gamemode' PlacementWidgets
			$xml .= '<manialink id="PlacementWidgetRace"></manialink>';
			$xml .= '<manialink id="PlacementWidgetGamemode"></manialink>';
		}




		// Replace the supported Placeholder, if already loaded
		// (at startup the event onPlayerConnect is always to early, the Map is not loaded yet)
		if ($mx == true) {
			$xml = str_replace(
				array(
					'%MAP_MX_PREFIX%',
					'%MAP_MX_ID%',
					'%MAP_MX_PAGEURL%'
				),
				array(
					$this->config['PlacementPlaceholders']['MAP_MX_PREFIX'],
					$this->config['PlacementPlaceholders']['MAP_MX_ID'],
					$this->config['PlacementPlaceholders']['MAP_MX_PAGEURL']
				),
				$xml
			);
		}
		if ($this->config['PlacementPlaceholders']['MAP_UID'] != false) {
			$xml = str_replace(
				array(
					'%MAP_UID%',
					'%MAP_NAME%'
				),
				array(
					$this->config['PlacementPlaceholders']['MAP_UID'],
					$this->config['PlacementPlaceholders']['MAP_NAME']
				),
				$xml
			);
		}

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getPlacementEntry ($placement) {

		// Check for includes and load/return only this content
		if ( isset($placement['INCLUDE'][0]) ) {
			$xml = file_get_contents($placement['INCLUDE'][0]);
			return str_replace(
				array(
					"\t",		// tab
					"\r",		// carriage return
					"\n",		// new line
					"\0",		// NUL-byte
					"\x0B",		// vertical tab
				),
				array(
					'',
					'',
					'',
					'',
					'',
				),
				trim($xml)
			);
		}


		$xml = '';

		// Build the background for the Widget
		if ( isset($placement['BACKGROUND_STYLE'][0]) ) {
			$xml .= '<quad posn="'. ($placement['POS_X'][0] * 2.5) .' '. ($placement['POS_Y'][0] * 1.875) .' '. ($placement['LAYER'][0] + 0.001) .'" sizen="'. $placement['WIDTH'][0] .' '. $placement['HEIGHT'][0] .'"';

			if (isset($placement['BACKGROUND_COLOR'][0])) {
				$xml .= ' bgcolor="'. $placement['BACKGROUND_COLOR'][0] .'"';
			}
			if (isset($placement['BACKGROUND_FOCUS'][0])) {
				$xml .= ' bgcolorfocus="'. $placement['BACKGROUND_FOCUS'][0] .'"';
			}
			else if (isset($placement['BACKGROUND_STYLE'][0]) && isset($placement['BACKGROUND_SUBSTYLE'][0])) {
				$xml .= ' style="'. $placement['BACKGROUND_STYLE'][0] .'" substyle="'. $placement['BACKGROUND_SUBSTYLE'][0] .'"';
			}
			if (isset($placement['URL'][0])) {
				$xml .= ' url="'. $placement['URL'][0] .'"';
			}
			else if (isset($placement['MANIALINK'][0])) {
				$xml .= ' manialink="'. $placement['MANIALINK'][0] .'"';
			}
			else if (isset($placement['ACTION_ID'][0])) {
				$xml .= ' action="'. $placement['ACTION_ID'][0] .'"';
			}
			else if (isset($placement['CHAT_MLID'][0])) {
				$xml .= ' action="PluginRecordsEyepiece?Action=releaseChatCommand&id='. $placement['CHAT_MLID'][0] .'"';
			}

			$xml .= '/>';
		}

		// Build the image quad for the Widget if required
		if ( isset($placement['IMAGE'][0]) ) {
			$xml .= '<quad posn="'. ($placement['POS_X'][0] * 2.5) .' '. ($placement['POS_Y'][0] * 1.875) .' '. ($placement['LAYER'][0] + 0.002) .'" sizen="'. $placement['WIDTH'][0] .' '. $placement['HEIGHT'][0] .'" image="'. $placement['IMAGE'][0] .'"';

			if (isset($placement['IMAGEFOCUS'][0])) {
				$xml .= ' imagefocus="'. $placement['IMAGEFOCUS'][0] .'"';
			}
			if (isset($placement['HALIGN'][0])) {
				$xml .= ' halign="'. $placement['HALIGN'][0] .'"';
			}
			if (isset($placement['VALIGN'][0])) {
				$xml .= ' valign="'. $placement['VALIGN'][0] .'"';
			}
			if (isset($placement['OPACITY'][0])) {
				$xml .= ' opacity="'. $placement['OPACITY'][0] .'"';
			}
			if (isset($placement['COLORIZE'][0])) {
				$xml .= ' colorize="'. $placement['COLORIZE'][0] .'"';
			}
			if (isset($placement['MODULATECOLOR'][0]) ) {
				$xml .= ' modulatecolor="'. $placement['MODULATECOLOR'][0] .'"';
			}
			if (isset($placement['URL'][0])) {
				$xml .= ' url="'. $placement['URL'][0] .'"';
			}
			else if (isset($placement['MANIALINK'][0])) {
				$xml .= ' manialink="'. $placement['MANIALINK'][0] .'"';
			}
			else if (isset($placement['ACTION_ID'][0])) {
				$xml .= ' action="'. $placement['ACTION_ID'][0] .'"';
			}
			else if (isset($placement['CHAT_MLID'][0])) {
				$xml .= ' action="PluginRecordsEyepiece?Action=releaseChatCommand&id='. $placement['CHAT_MLID'][0] .'"';
			}

			$xml .= '/>';
		}

		// Build the icon quad for the Widget if required
		if ( isset($placement['ICON_STYLE'][0]) ) {
			$xml .= '<quad posn="'. ($placement['POS_X'][0] * 2.5) .' '. ($placement['POS_Y'][0] * 1.875) .' '. ($placement['LAYER'][0] + 0.003) .'" sizen="'. $placement['WIDTH'][0] .' '. $placement['HEIGHT'][0] .'" style="'. $placement['ICON_STYLE'][0] .'" substyle="'. $placement['ICON_SUBSTYLE'][0] .'"';

			if (isset($placement['HALIGN'][0])) {
				$xml .= ' halign="'. $placement['HALIGN'][0] .'"';
			}
			if (isset($placement['VALIGN'][0])) {
				$xml .= ' valign="'. $placement['VALIGN'][0] .'"';
			}
			if (isset($placement['URL'][0])) {
				$xml .= ' url="'. $placement['URL'][0] .'"';
			}
			else if (isset($placement['MANIALINK'][0])) {
				$xml .= ' manialink="'. $placement['MANIALINK'][0] .'"';
			}
			else if (isset($placement['ACTION_ID'][0])) {
				$xml .= ' action="'. $placement['ACTION_ID'][0] .'"';
			}
			else if (isset($placement['CHAT_MLID'][0])) {
				$xml .= ' action="PluginRecordsEyepiece?Action=releaseChatCommand&id='. $placement['CHAT_MLID'][0] .'"';
			}

			$xml .= '/>';
		}

		// Build the text label for the Widget if required
		if ( isset($placement['TEXT'][0]) ) {
			$xml .= '<label posn="'. ($placement['POS_X'][0] * 2.5) .' '. ($placement['POS_Y'][0] * 1.875) .' '. ($placement['LAYER'][0] + 0.004) .'" sizen="'. $placement['WIDTH'][0] .' '. $placement['HEIGHT'][0] .'"';

			if (isset($placement['HALIGN'][0])) {
				$xml .= ' halign="'. $placement['HALIGN'][0] .'"';
			}
			if (isset($placement['VALIGN'][0])) {
				$xml .= ' valign="'. $placement['VALIGN'][0] .'"';
			}
			if (isset($placement['TEXTSIZE'][0])) {
				$xml .= ' textsize="'. $placement['TEXTSIZE'][0] .'"';
			}
			if (isset($placement['TEXTSCALE'][0])) {
				$xml .= ' scale="'. $placement['TEXTSCALE'][0] .'"';
			}
			if (isset($placement['OPACITY'][0])) {
				$xml .= ' opacity="'. $placement['OPACITY'][0] .'"';
			}

			$xml .= ' text="'. $placement['TEXT'][0] .'"/>';
		}

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function showRecordWidgets ($force_display = false) {
		global $aseco;

		// Bail out if Scoretable is displayed
		if ($aseco->server->gamestate == Server::SCORE) {
			return;
		}

		// Bail out if there are no Players
		if (count($aseco->server->players->player_list) == 0) {
			return;
		}

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		$widgets = '';
		if ( ($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) && ($this->config['NICEMODE'][0]['ALLOW'][0]['DEDIMANIA_RECORDS'][0] == true) ) {
			if ( ($this->config['States']['DedimaniaRecords']['UpdateDisplay'] == true) || ($force_display == true) ) {
				$widgets .= (($this->cache['DedimaniaRecords']['NiceMode'] != false) ? $this->cache['DedimaniaRecords']['NiceMode'] : '');
			}
		}
		if ( ($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) && ($this->config['NICEMODE'][0]['ALLOW'][0]['LOCAL_RECORDS'][0] == true) ) {
			if ( ($this->config['States']['LocalRecords']['UpdateDisplay'] == true) || ($force_display == true) ) {
				$widgets .= (($this->cache['LocalRecords']['NiceMode'] != false) ? $this->cache['LocalRecords']['NiceMode'] : '');
			}
		}
		if ( ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) && ($this->config['NICEMODE'][0]['ALLOW'][0]['LIVE_RANKINGS'][0] == true) ) {
			if ( ($this->config['States']['LiveRankings']['UpdateDisplay'] == true) || ($force_display == true) ) {
				$widgets .= (($this->cache['LiveRankings']['NiceMode'] != false) ? $this->cache['LiveRankings']['NiceMode'] : '');
			}
		}

		return $widgets;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// $target = the same as the normal $player object, but only this Player gets the requested Widgets
	// $force  = an array where the required Widgets are identified
	public function buildRecordWidgets ($target = false, $force = false) {
		global $aseco;

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		$buildDedimaniaRecordsWidget = false;
		$buildLocalRecordsWidget = false;
		$buildLiveRankingsWidget = false;
		if ( (isset($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) || (($this->config['NICEMODE'][0]['ALLOW'][0]['DEDIMANIA_RECORDS'][0] == true) && ($this->config['States']['NiceMode'] == true)) ) {
			// Refresh the Widget only if it needs an update
			if ($this->config['States']['DedimaniaRecords']['NeedUpdate'] == true) {

				// Get current Records
				$this->getDedimaniaRecords();
				$this->config['States']['DedimaniaRecords']['NeedUpdate'] = false;

				// Say yes to build the Widget
				$buildDedimaniaRecordsWidget = true;
			}
			if ($this->config['States']['DedimaniaRecords']['UpdateDisplay'] == true) {

				// Say yes to build the Widget
				$buildDedimaniaRecordsWidget = true;
			}
		}
		if ( (isset($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) || (($this->config['NICEMODE'][0]['ALLOW'][0]['LOCAL_RECORDS'][0] == true) && ($this->config['States']['NiceMode'] == true)) ) {
			// Refresh the Widget only if it needs an update
			if ($this->config['States']['LocalRecords']['NeedUpdate'] == true) {

				// Get current Records
				$this->getLocalRecords($gamemode);
				$this->config['States']['LocalRecords']['NeedUpdate'] = false;

				// Say yes to build the Widget
				$buildLocalRecordsWidget = true;
			}
			if ($this->config['States']['LocalRecords']['UpdateDisplay'] == true) {

				// Say yes to build the Widget
				$buildLocalRecordsWidget = true;
			}
		}
		if ( (isset($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) || (($this->config['NICEMODE'][0]['ALLOW'][0]['LIVE_RANKINGS'][0] == true) && ($this->config['States']['NiceMode'] == true)) ) {
			// Refresh the Widget only if it needs an update
			if ($this->config['States']['LiveRankings']['NeedUpdate'] == true) {

				// Get current Records
				$this->getLiveRankings($gamemode);
				$this->config['States']['LiveRankings']['NeedUpdate'] = false;

				// Say yes to build the Widget
				$buildLiveRankingsWidget = true;
			}
			if ($this->config['States']['LiveRankings']['UpdateDisplay'] == true) {

				// Say yes to build the Widget
				$buildLiveRankingsWidget = true;
			}
		}


		if ($this->config['States']['NiceMode'] == false) {

			// Clean mem (from possible reverted NiceMode)
			$this->cache['DedimaniaRecords']['NiceMode']	= false;
			$this->cache['LocalRecords']['NiceMode']	= false;
			$this->cache['LiveRankings']['NiceMode']	= false;

			// If we switched to score, bail out
			if ($aseco->server->gamestate == Server::SCORE) {
				return;
			}

			// Build the Widgets for all connected Players or given Player ($target same as $player)
			if ($target != false) {
				$player_list = array($target);
			}
			else {
				$player_list = $aseco->server->players->player_list;
			}
			foreach ($player_list as $player) {

				$widgets = '';
				if ( (($buildDedimaniaRecordsWidget == true) || ($force['DedimaniaRecords'] == true)) && (isset($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) ) {
					$widgets .= $this->buildRecordWidgetContent(
						$gamemode,
						$player,
						$this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0],
						'DEDIMANIA_RECORDS'
					);
				}
				if ( (($buildLocalRecordsWidget == true) || ($force['LocalRecords'] == true)) && (isset($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) ) {
					$widgets .= $this->buildRecordWidgetContent(
						$gamemode,
						$player,
						$this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0],
						'LOCAL_RECORDS'
					);
				}
				if ( (($buildLiveRankingsWidget == true) || ($force['LiveRankings'] == true)) && (isset($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode]) && $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) ) {
					$widgets .= $this->buildLiveRankingsWidget($player->login, $player->data['PluginRecordsEyepiece']['Prefs']['WidgetEmptyEntry'], $gamemode, $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0]);
				}

				if ($widgets != '') {
					// Send Manialink to given Player
					$this->sendManialink($widgets, $player->login, 0);
				}
			}
			unset($player);
		}
		else {

			// Build the RecordWidgets for all connected Players and ignore the Player specific highlites
			if ($buildDedimaniaRecordsWidget == true) {
				$this->cache['DedimaniaRecords']['NiceMode'] = $this->buildRecordWidgetContent(
					$gamemode,
					false,
					$this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0],
					'DEDIMANIA_RECORDS'
				);
				$this->config['States']['DedimaniaRecords']['UpdateDisplay'] = true;
			}
			if ($buildLocalRecordsWidget == true) {
				$this->cache['LocalRecords']['NiceMode'] = $this->buildRecordWidgetContent(
					$gamemode,
					false,
					$this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0],
					'LOCAL_RECORDS'
				);
				$this->config['States']['LocalRecords']['UpdateDisplay'] = true;
			}
			if ($buildLiveRankingsWidget == true) {
				$this->cache['LiveRankings']['NiceMode'] = $this->buildLiveRankingsWidget(false, false, $gamemode, $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0]);
				$this->config['States']['LiveRankings']['UpdateDisplay'] = true;
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function sendManialink ($widgets, $login = false, $timeout = 0) {
		global $aseco;

		if ($login != false) {
			// Send to given Player
			$aseco->sendManialink($widgets, $login, ($timeout * 1000), false);
		}
		else {
			// Send to all connected Players
			$aseco->sendManialink($widgets, false, ($timeout * 1000), false);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function sendProgressIndicator ($login) {

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'United',
				'Loading... please wait.',
				''
			),
			$this->templates['WINDOW']['HEADER']
		);
		$xml .= $this->templates['PROGRESS_INDICATOR']['CONTENT'];
		$xml .= $this->templates['WINDOW']['FOOTER'];

		// Send the progress indicator
		$this->sendManialink($xml, $login, 0);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function closeScoretableLists () {

		$ids = array(
			'MapWidget',
			'ClockWidget',
			'AddToFavoriteWidget',
			'DedimaniaRecordsWidget',
			'LocalRecordsWidget',
			'TopRankingsWidgetAtScore',
			'TopWinnersWidgetAtScore',
			'MostRecordsWidgetAtScore',
			'MostFinishedWidgetAtScore',
			'TopPlaytimeWidgetAtScore',
			'TopDonatorsWidgetAtScore',
			'TopNationsWidgetAtScore',
			'TopMapsWidgetAtScore',
			'TopVotersWidgetAtScore',
			'TopBetwinsWidgetAtScore',
			'TopRoundscoreWidgetAtScore',
			'TopAverageTimesWidgetAtScore',
			'NextGamemodeWidgetAtScore',
			'NextEnvironmentWidgetAtScore',
			'WinningPayoutWidgetAtScore',
			'DonationWidgetAtScore',
			'TopWinningPayoutsWidgetAtScore',
			'TopVisitorsWidgetAtScore',
			'TopActivePlayersWidgetAtScore',
		);

		$xml = '';
		foreach ($ids as $id) {
			$xml .= '<manialink id="'. $id .'"></manialink>';
		}

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function closeRaceWidgets ($login = false, $all = true) {

		if ($all == false) {
			// Do NOT close:
			//  - VisitorsWidget
			//  - MapCountWidget
			//  - ToplistWidget
			//  - RoundScoreWidget
			//  - AddToFavoriteWidget
			//  - ManiaExchangeWidget
			$ids = array(
				'DedimaniaRecordsWidget',
				'LocalRecordsWidget',
				'LiveRankingsWidget',
				'MusicWidget',
			);
		}
		else {
			$ids = array(
				'WarmUpInfoWidget',
				'MultiLapInfoWidget',
				'SpectatorInfoWidget',
				'VisitorsWidget',
				'MapCountWidget',
				'ToplistWidget',
				'DedimaniaRecordsWidget',
				'LocalRecordsWidget',
				'LiveRankingsWidget',
				'MusicWidget',
				'RoundScoreWidget',
				'AddToFavoriteWidget',
				'ManiaExchangeWidget',
				'ClockWidget',
			);
		}

		$xml = '';
		foreach ($ids as $id) {
			$xml .= '<manialink id="'. $id .'"></manialink>';
		}

		// Close all Windows (incl. SubWindows)
		$xml .= $this->closeAllWindows();

		if ($login != false) {
			// Send to given Player
			$this->sendManialink($xml, $login, 0);
		}
		else {
			// Return the xml
			return $xml;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function closeAllWindows () {

		$xml  = '<manialink id="MainWindow"></manialink>';
		$xml .= '<manialink id="SubWindow"></manialink>';
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function closeAllSubWindows () {
		return '<manialink id="SubWindow"></manialink>';
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildDonationWidget () {
		global $aseco;

		$val = explode(',', $this->config['DONATION_WIDGET'][0]['AMOUNTS'][0]);
		if ( isset($aseco->plugins['PluginDonate']) ) {
			$aseco->plugins['PluginDonate']->donation_values = array((int)$val[0], (int)$val[1], (int)$val[2], (int)$val[3], (int)$val[4], (int)$val[5], (int)$val[6]);
			$aseco->plugins['PluginDonate']->publicappr = (int)$this->config['DONATION_WIDGET'][0]['PUBLIC_APPRECIATION_THRESHOLD'][0];
		}


		// Setup Widget
		$xml = str_replace(
			array(
				'%widgetheight%'
			),
			array(
				(12.28125 + (count($val) * 3.46875))
			),
			$this->templates['DONATION_WIDGET']['HEADER']
		);

		$offset = 12.65625;
		$row = 0;
		foreach (range(0,9) as $i) {
			if ( isset($val[$i]) ) {
				$xml .= '<quad posn="0.5 -'. ($offset + $row) .' 0.2" sizen="10.5 3.1875" action="PluginRecordsEyepiece?Action=handlePlayerDonation&Amount='. abs((int)$val[$i]) .'" style="'. $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BUTTON_STYLE'][0] .'" substyle="'. $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BUTTON_SUBSTYLE'][0] .'"/>';
				$xml .= '<label posn="5.5 -'. ($offset + $row + 0.65625) .' 0.3" sizen="10 4.6875" halign="center" scale="0.8" textsize="1" textcolor="'. $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BUTTON_COLOR'][0] .'" text="'. $val[$i] .'$n $mP"/>';
				$row += 3.375;
			}
		}
		$xml .= $this->templates['DONATION_WIDGET']['FOOTER'];
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildWinningPayoutWidget () {
		global $aseco;

		// Bail out immediately at Gamemode 'Team'
		if ($aseco->server->gameinfo->mode == Gameinfo::TEAM) {
			return;
		}

		// Bail out if there are no Players
		if (count($aseco->server->players->player_list) == 0) {
			return;
		}


		// Find out how many Planets the Players has won total
		$players_planets = 0;
		foreach ($aseco->server->players->player_list as $player) {
			$players_planets += $this->cache['PlayerWinnings'][$player->login]['FinishPayment'];
		}
		unset($player);

		// Setup Widget
		$xml = $this->templates['WINNING_PAYOUT']['HEADER'];

		// If the Server runs out of Planets, disable payout until Planets are high enough
		if ( ($aseco->server->amount_planets - $players_planets) > $this->config['WINNING_PAYOUT'][0]['MINIMUM_SERVER_PLANETS'][0]) {

			// Get the current Rankings
			$ranks = $aseco->server->rankings->getTop50();

			// Find all Player they finished the Map
			$score = array();
			$i = 0;
			foreach ($ranks as $item) {
				if ( ($item->time > 0) || ($item->score > 0) ) {

					// Get Player object
					if (!$player = $aseco->server->players->getPlayerByLogin($item->login)) {
						continue;
					}

					// Check ignore list
					$ignore = false;
					if ( ($this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['OPERATOR'][0] == true) && ($aseco->isOperator($player)) ) {
						$ignore = true;
					}
					if ( ($this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['ADMIN'][0] == true) && ($aseco->isAdmin($player)) ) {
						$ignore = true;
					}
					if ( ($this->config['WINNING_PAYOUT'][0]['IGNORE'][0]['MASTERADMIN'][0] == true) && ($aseco->isMasterAdmin($player)) ) {
						$ignore = true;
					}

					if ($player == false) {
						// If the Player is already disconnected, use own Cache
						$player = $this->cache['WinningPayoutPlayers'][$item->login];

						$score[$i]['rank']		= $item->rank;
						$score[$i]['id']		= $player['id'];
						$score[$i]['login']		= $player['login'];
						$score[$i]['nickname']		= $this->handleSpecialChars($player['nickname']);
						$score[$i]['ladderrank']	= $player['ladderrank'];
						$score[$i]['won']		= 0;
						$score[$i]['disconnected']	= true;
						$score[$i]['ignore']		= $ignore;
					}
					else {
						$score[$i]['rank']		= $item->rank;
						$score[$i]['id']		= $player->id;
						$score[$i]['login']		= $player->login;
						$score[$i]['nickname']		= $this->handleSpecialChars($player->nickname);
						$score[$i]['ladderrank']	= $player->ladderrank;
						$score[$i]['won']		= 0;
						$score[$i]['disconnected']	= false;
						$score[$i]['ignore']		= $ignore;
					}
				}
				$i ++;
			}

			// Did enough Players finished this Map?
			if (count($score) >= $this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MINIMUM_AMOUNT'][0]) {

				// Add to the first three Player Planets, if they have an TMU account, above the <rank_limit> and connected
				foreach ($score as &$item) {
					if ($item['ladderrank'] >= $this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RANK_LIMIT'][0]) {
						if ( ($this->cache['PlayerWinnings'][$item['login']]['FinishPayment'] + $this->cache['PlayerWinnings'][$item['login']]['FinishPaid']) < $this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MAXIMUM_PLANETS'][0]) {
							if ( ($item['disconnected'] == false) && ($item['ignore'] == false) ) {
								switch ($item['rank']) {
									case 1:
										$this->cache['PlayerWinnings'][$item['login']]['FinishPayment'] += $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['FIRST'][0];
										$item['won'] = $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['FIRST'][0];
										break;
									case 2:
										$this->cache['PlayerWinnings'][$item['login']]['FinishPayment'] += $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['SECOND'][0];
										$item['won'] = $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['SECOND'][0];
										break;
									case 3:
										$this->cache['PlayerWinnings'][$item['login']]['FinishPayment'] += $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['THIRD'][0];
										$item['won'] = $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['THIRD'][0];
										break;
									default:
										break;
								}
							}
						}
					}

					if ($item['won'] > 0) {
						// Set a timestamp to activate the disable-to-win check
						$this->cache['PlayerWinnings'][$item['login']]['TimeStamp'] = time();
					}

					if ($item['rank'] >= 4) {
						// Skip now, only the first three Player can win
						break;
					}
				}
				unset($item);

				// Calculate the switch of message, from "Congratulation!" to the "Total: [N] P"
				$total_switch = $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['FIRST'][0] + $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['SECOND'][0] + $this->config['WINNING_PAYOUT'][0]['PAY_PLANETS'][0]['THIRD'][0];

				// Build the entries
				$line = 0;
				$offset = 5.625;
				$eventdata = array();
				foreach ($score as &$item) {
					switch ($item['rank']) {
						case 1:
							$xml .= '<quad posn="2.125 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.28125) .' 0.002" sizen="4.25 3" style="Icons64x64_1" substyle="First"/>';
							$eventdata[] = array(
								'place'		=> 1,
								'login'		=> $item['login'],
								'amount'	=> $item['won']
							);
							break;
						case 2:
							$xml .= '<quad posn="2.125 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.28125) .' 0.002" sizen="4.25 3" style="Icons64x64_1" substyle="Second"/>';
							$eventdata[] = array(
								'place'		=> 2,
								'login'		=> $item['login'],
								'amount'	=> $item['won']
							);
							break;
						case 3:
							$xml .= '<quad posn="2.125 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.28125) .' 0.002" sizen="4.25 3" style="Icons64x64_1" substyle="Third"/>';
							$eventdata[] = array(
								'place'		=> 3,
								'login'		=> $item['login'],
								'amount'	=> $item['won']
							);
							break;
					}

					// Build the Won and the Info column
					if ($item['disconnected'] == true) {
						// Player already disconnected
						$xml .= '<label posn="15.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.875 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="0 P"/>';
						$xml .= '<label posn="61.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="20 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['DISCONNECTED'][0] .'" text="Disconnected!"/>';
					}
					else if ($item['ignore'] == true) {
						// Player is in <winning_payout><ignore>
						$xml .= '<label posn="15.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.875 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="0 P"/>';
						$xml .= '<label posn="61.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="20 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['DISCONNECTED'][0] .'" text="No Payout!"/>';
					}
					else if ($item['ladderrank'] < $this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['RANK_LIMIT'][0]) {
						// <rank_limit> reached
						$xml .= '<label posn="15.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.875 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="0 P"/>';
						$xml .= '<label posn="61.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="20 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['RANK_LIMIT'][0] .'" text="Over Rank-Limit!"/>';
					}
					else if ( ( ($this->cache['PlayerWinnings'][$item['login']]['FinishPayment'] + $this->cache['PlayerWinnings'][$item['login']]['FinishPaid']) >= $this->config['WINNING_PAYOUT'][0]['PLAYERS'][0]['MAXIMUM_PLANETS'][0]) && ($item['won'] == 0) ) {
						// <maximum_planets> reached
						$xml .= '<label posn="15.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.875 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="0 P"/>';
						$xml .= '<label posn="61.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="20 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['RANK_LIMIT'][0] .'" text="Over Payout-Limit!"/>';
					}
					else {
						$xml .= '<label posn="15.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.875 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="+'. $item['won'] .' P"/>';

						// Display "Congratulation!" or "Total [N] P"
						if ($this->cache['PlayerWinnings'][$item['login']]['FinishPayment'] > $total_switch) {
							$xml .= '<label posn="61.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="20 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['WON'][0] .'" text="'. $this->formatNumber((int)$this->cache['PlayerWinnings'][$item['login']]['FinishPayment'], 0) .' P total"/>';
						}
						else {
							$xml .= '<label posn="61.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="20 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['WON'][0] .'" text="Congratulation!"/>';
						}
					}
					$xml .= '<label posn="16.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="28.5 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $item['nickname'] .'"/>';

					$line ++;
					if ($line >= 3) {
						break;
					}
				}
				unset($item);


				// Release Winning Planets event
				$aseco->releaseEvent('onPlayerWinPlanets', $eventdata);
				unset($eventdata);


				// Update `WinningPayout`...
				$query = "
				UPDATE `%prefix%players`
				SET `WinningPayout` = CASE `PlayerId`
				";

				$playerids = array();
				foreach ($score as $item) {
					if ($item['won'] > 0) {
						$playerids[] = $item['id'];
						$query .= 'WHEN '. $item['id'] .' THEN `WinningPayout` + '. $item['won'] .LF;
					}
				}
				unset($item);

				$query .= "
				END
				WHERE `PlayerId` IN (". implode(',', $playerids) .");
				";

				// ...only if one Player has a Score
				if (count($playerids) > 0) {
					$result = $aseco->db->query($query);
					if (!$result) {
						$aseco->console('[RecordsEyepiece] UPDATE `WinningPayout` failed: [for statement "'. str_replace("\t", '', $query) .'"]');
					}
				}
				unset($playerids);
			}
			else {
				// Not enough Players has finished this Map
				$xml .= '<quad posn="8.625 -4.875 0.04" sizen="12.5 12.5" halign="center" style="Icons64x64_1" substyle="YellowHigh"/>';
				$xml .= '<label posn="8.825 -8.875 0.05" sizen="23 0" halign="center" textsize="5" text="$O$000!"/>';
				$xml .= '<label posn="16.75 -5.625 0.002" sizen="59.875 3.1875" class="labels" scale="0.9" autonewline="1" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="Not enough Players finished Map,'. LF .'winning payment temporary off."/>';
			}
		}
		else {
			// Server out of Planets
			$xml .= '<quad posn="8.625 -4.875 0.04" sizen="12.5 12.5" halign="center" style="Icons64x64_1" substyle="YellowHigh"/>';
			$xml .= '<label posn="8.825 -8.875 0.05" sizen="23 0" halign="center" textsize="5" text="$O$000!"/>';
			$xml .= '<label posn="16.75 -5.625 0.002" sizen="59.875 3.1875" class="labels" scale="0.9" autonewline="1" textcolor="'. $this->config['WINNING_PAYOUT'][0]['COLORS'][0]['PLANETS'][0] .'" text="Server out of Planets now,'. LF .'winning payment turned off.'. LF .'Please donate some. =D"/>';
		}
		$xml .= $this->templates['WINNING_PAYOUT']['FOOTER'];

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function winningPayout ($player) {
		global $aseco;

		if ($this->cache['PlayerWinnings'][$player->login]['FinishPayment'] > 0) {
			// Pay the won Planets to the disconnected Player now
			$message = $aseco->formatText($this->config['MESSAGES'][0]['WINNING_MAIL_BODY'][0],
				(int)$this->cache['PlayerWinnings'][$player->login]['FinishPayment'],
				$aseco->server->login,
				$aseco->server->name
			);
			$message = str_replace('{br}', "%0A", $message);  // split long message

			$billid = false;
			try {
				$billid = $aseco->client->query('Pay', (string)$player->login, (int)$this->cache['PlayerWinnings'][$player->login]['FinishPayment'], (string)$aseco->formatColors($message) );
			}
			catch (Exception $exception) {
				$aseco->console('[RecordsEyepiece] Pay '. $this->cache['PlayerWinnings'][$player->login]['FinishPayment'] .' Planets to Player "'. $player->login .'" failed: [' . $exception->getCode() . '] ' . $exception->getMessage());
				return false;
			}

			// Payment done...
			$aseco->console('[RecordsEyepiece] Pay '. $this->cache['PlayerWinnings'][$player->login]['FinishPayment'] .' Planets to Player "'. $player->login .'" done. (BillId #'. $billid .')');

			// Store the paid-off amount of Planets
			$this->cache['PlayerWinnings'][$player->login]['FinishPaid'] = $this->cache['PlayerWinnings'][$player->login]['FinishPayment'];

			// Reset the counter to prevent payment at /admin shutdown
			$this->cache['PlayerWinnings'][$player->login]['FinishPayment'] = 0;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getDedimaniaRecords () {
		global $aseco;

		// Clean array
		$this->scores['DedimaniaRecords'] = array();

		if ( ( isset($aseco->plugins['PluginDedimania']->db['Map']['Records']) ) && (count($aseco->plugins['PluginDedimania']->db['Map']['Records']) > 0) ) {
			for ($i = 0; $i < count($aseco->plugins['PluginDedimania']->db['Map']['Records']); $i ++) {
				if ( ($this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0] === 0) || ($this->config['DEDIMANIA_RECORDS'][0]['DISPLAY_MAX_RECORDS'][0] > $i) ) {
					if ($aseco->plugins['PluginDedimania']->db['Map']['Records'][$i]['Best'] > 0) {
						$this->scores['DedimaniaRecords'][$i]['rank']		= ($i+1);
						$this->scores['DedimaniaRecords'][$i]['login']		= $aseco->plugins['PluginDedimania']->db['Map']['Records'][$i]['Login'];
						$this->scores['DedimaniaRecords'][$i]['nickname']	= $this->handleSpecialChars($aseco->plugins['PluginDedimania']->db['Map']['Records'][$i]['NickName']);
						$this->scores['DedimaniaRecords'][$i]['score']		= $aseco->formatTime($aseco->plugins['PluginDedimania']->db['Map']['Records'][$i]['Best']);
					}
				}
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getLocalRecords ($gamemode) {
		global $aseco;

		// Clean array
		$this->scores['LocalRecords'] = array();

		if (count($aseco->plugins['PluginLocalRecords']->records->record_list) == 0) {
			$this->config['States']['LocalRecords']['NoRecordsFound'] = true;
		}
		else {
			$i = 0;
			foreach ($aseco->plugins['PluginLocalRecords']->records->record_list as $entry) {
				$this->scores['LocalRecords'][$i]['rank']	= ($i+1);
				$this->scores['LocalRecords'][$i]['login']	= $entry->player->login;
				$this->scores['LocalRecords'][$i]['nickname']	= $this->handleSpecialChars($entry->player->nickname);
				$this->scores['LocalRecords'][$i]['score'] = $aseco->formatTime($entry->score);
				$i++;
			}
			unset($entry);

			$this->config['States']['LocalRecords']['ChkSum'] = $this->buildRecordDigest('locals', $aseco->plugins['PluginLocalRecords']->records->record_list);
			$this->config['States']['LocalRecords']['NoRecordsFound'] = false;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getLiveRankings ($gamemode) {
		global $aseco;

		if ($aseco->server->rankings->count() > 0) {
			// Clean before filling
			$this->scores['LiveRankings'] = array();

			$i = 0;
			foreach ($aseco->server->rankings->ranking_list as $login => $data) {
				if ($data->time > 0 || $data->score > 0) {

					$this->scores['LiveRankings'][$i]['rank']	= $data->rank;
					$this->scores['LiveRankings'][$i]['login']	= $data->login;
					$this->scores['LiveRankings'][$i]['nickname']	= $this->handleSpecialChars($data->nickname);
					if ($gamemode == Gameinfo::ROUNDS) {
						// Display Score instead Time?
						if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['DISPLAY_TYPE'][0] == true) {
							$this->scores['LiveRankings'][$i]['score'] = $aseco->formatTime($data->time);
						}
						else {
							if ( isset($aseco->server->gameinfo->rounds['PointsLimit']) ) {
								$remaining = ($aseco->server->gameinfo->rounds['PointsLimit'] - $data->score);
								if ($remaining < 0) {
									$remaining = 0;
								}
								$this->scores['LiveRankings'][$i]['score'] = str_replace(
									array(
										'{score}',
										'{remaining}',
										'{pointlimit}',
									),
									array(
										$data->score,
										$remaining,
										$aseco->server->gameinfo->rounds['PointsLimit']
									),
									$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['FORMAT'][0]
								);
							}
							else {
								$this->scores['LiveRankings'][$i]['score'] = $data->score;
							}
						}
					}
					else if ($gamemode == Gameinfo::TIME_ATTACK) {
						$this->scores['LiveRankings'][$i]['score'] = $aseco->formatTime($data->time);
					}
					else if ($gamemode == Gameinfo::TEAM) {
						// Player(Team) with score
						$this->scores['LiveRankings'][$i]['rank']	= $data->rank;
						$this->scores['LiveRankings'][$i]['score']	= $data->score;
					}
					else if ($gamemode == Gameinfo::LAPS) {
						// Display Checkpoints instead Time?
						if ($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['DISPLAY_TYPE'][0] == true) {
							$this->scores['LiveRankings'][$i]['score'] = $aseco->formatTime($data->time);
						}
						else {
							if (isset($this->cache['Map']['NbCheckpoints']) && isset($this->cache['Map']['NbLaps'])) {
								if ($aseco->server->maps->current->multilap == true) {
									$this->scores['LiveRankings'][$i]['score'] = count($data->cps) .'/'. ($this->cache['Map']['NbCheckpoints'] * $this->cache['Map']['NbLaps']);
								}
								else {
									$this->scores['LiveRankings'][$i]['score'] = count($data->cps) .'/'. $this->cache['Map']['NbCheckpoints'];
								}
							}
							else {
								$this->scores['LiveRankings'][$i]['score'] = count($data->cps) . ((count($data->cps) == 1) ? ' cp.' : ' cps.');
							}
						}
					}
					else if ($gamemode == Gameinfo::CUP) {
						if ( isset($aseco->server->gameinfo->cup['PointsLimit']) ) {
							$this->scores['LiveRankings'][$i]['score'] = $data->score .'/'. $aseco->server->gameinfo->cup['PointsLimit'];
						}
						else {
							$this->scores['LiveRankings'][$i]['score'] = $data->score;
						}
					}
					else if ($gamemode == Gameinfo::CHASE) {
						$this->scores['LiveRankings'][$i]['time'] = $aseco->formatTime($data->time);
						$this->scores['LiveRankings'][$i]['score'] = $aseco->formatTime($data->time);
					}
					else if ($gamemode == Gameinfo::DOPPLER) {
						$this->scores['LiveRankings'][$i]['score'] = $this->formatNumber($data->score, 0);
					}
					else {
						$this->scores['LiveRankings'][$i]['time'] = $aseco->formatTime($data->time);
						$this->scores['LiveRankings'][$i]['score'] = $data->score;
					}
				}
				else if ($gamemode == Gameinfo::TEAM) {
					// Team without score
					$this->scores['LiveRankings'][$i]['rank']	= $data->rank;
					$this->scores['LiveRankings'][$i]['score']	= 0;
					$this->scores['LiveRankings'][$i]['login']	= $data->login;
					$this->scores['LiveRankings'][$i]['nickname']	= $this->handleSpecialChars($data->nickname);
				}

				$i++;
			}

			if ($gamemode == Gameinfo::TEAM) {
				// Was TeamPointsLimit set?
				if ( isset($aseco->server->gameinfo->team['PointsLimit']) ) {
					$this->scores['LiveRankings'][0]['score'] = $this->scores['LiveRankings'][0]['score'] .'/'. $aseco->server->gameinfo->team['PointsLimit'] .' pts.';
					$this->scores['LiveRankings'][1]['score'] = $this->scores['LiveRankings'][1]['score'] .'/'. $aseco->server->gameinfo->team['PointsLimit'] .' pts.';
				}
				else {
					$this->scores['LiveRankings'][0]['score'] .= ' pts.';
					$this->scores['LiveRankings'][1]['score'] .= ' pts.';
				}
			}

			$this->config['States']['LiveRankings']['NoRecordsFound'] = false;
		}
		else {
			$this->config['States']['LiveRankings']['NoRecordsFound'] = true;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getVisitors () {
		global $aseco;

		$query = "
		SELECT
			MAX(`PlayerId`) AS `PlayerCount`
		FROM `%prefix%players`;
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['Visitors'] = 0;

				if ($row = $res->fetch_object()) {
					$this->scores['Visitors'] = $this->formatNumber((int)$row->PlayerCount, 0);
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopRankings ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`p`.`Login`,
			`p`.`Nickname`,
			(ROUND(`r`.`Average` / 1000) / 10) AS `Average`
		FROM `%prefix%players` AS `p`
		LEFT JOIN `%prefix%rankings` AS `r` ON `p`.`PlayerId` = `r`.`PlayerId`
		WHERE `r`.`Average` != 0
		ORDER BY `r`.`Average` ASC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopRankings'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopRankings'][$i]['rank']	= ($i+1);
					$this->scores['TopRankings'][$i]['login']	= $row->Login;
					$this->scores['TopRankings'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['TopRankings'][$i]['score']	= sprintf("%.1f", $row->Average);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopWinners ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`p`.`Login`,
			`p`.`Nickname`,
			`p`.`Wins`
		FROM `%prefix%players` AS `p`
		WHERE `p`.`Wins` > 0
		ORDER BY `p`.`Wins` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopWinners'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopWinners'][$i]['rank']		= ($i+1);
					$this->scores['TopWinners'][$i]['login']	= $row->Login;
					$this->scores['TopWinners'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['TopWinners'][$i]['score']	= $this->formatNumber((int)$row->Wins, 0);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMostRecords ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`Login`,
			`Nickname`,
			`MostRecords`
		FROM `%prefix%players`
		WHERE `MostRecords` > 0
		ORDER BY `MostRecords` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['MostRecords'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['MostRecords'][$i]['rank']	= ($i+1);
					$this->scores['MostRecords'][$i]['login']	= $row->Login;
					$this->scores['MostRecords'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['MostRecords'][$i]['score']	= $this->formatNumber((int)$row->MostRecords, 0);
					$this->scores['MostRecords'][$i]['score_plain']	= (int)$row->MostRecords;

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMostFinished ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`Login`,
			`Nickname`,
			`MostFinished`
		FROM `%prefix%players`
		WHERE `MostFinished` > 0
		ORDER BY `MostFinished` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['MostFinished'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['MostFinished'][$i]['rank']	= ($i+1);
					$this->scores['MostFinished'][$i]['login']	= $row->Login;
					$this->scores['MostFinished'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['MostFinished'][$i]['score']	= $this->formatNumber((int)$row->MostFinished, 0);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopPlaytime ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`p`.`Login`,
			`p`.`Nickname`,
			`p`.`TimePlayed`
		FROM `%prefix%players` AS `p`
		WHERE `p`.`TimePlayed` > 3600
		ORDER BY `p`.`TimePlayed` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopPlaytime'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopPlaytime'][$i]['rank']	= ($i+1);
					$this->scores['TopPlaytime'][$i]['login']	= $row->Login;
					$this->scores['TopPlaytime'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['TopPlaytime'][$i]['score']	= $this->formatNumber(round($row->TimePlayed / 3600), 0) . ' h';

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopDonators ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`Login`,
			`Nickname`,
			`Donations`
		FROM `%prefix%players`
		WHERE `Donations` != 0
		ORDER BY `Donations` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopDonators'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopDonators'][$i]['rank']	= ($i+1);
					$this->scores['TopDonators'][$i]['login']	= $row->Login;
					$this->scores['TopDonators'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['TopDonators'][$i]['score']	= $this->formatNumber((int)$row->Donations, 0) .' P';
					$this->scores['TopDonators'][$i]['score_plain']	= (int)$row->Donations;

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopNationList ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			COUNT(`Nation`) AS `Count`,
			`Nation`
		FROM `%prefix%players`
		GROUP BY `Nation`
		ORDER BY `Count` DESC
		". $appendix .";
		";

		$flagfix = array(
			'SCG'	=> 'SRB',
			'ROM'	=> 'ROU',
			'CAR'	=> 'CMR'
		);

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopNations'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopNations'][$i]['nation']	= (isset($flagfix[$row->Nation]) ? $flagfix[$row->Nation] : $row->Nation);
					$this->scores['TopNations'][$i]['count']	= $this->formatNumber((int)$row->Count, 0);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopMaps () {
		global $aseco;

		// Clean before filling
		$this->scores['TopMaps'] = array();

		// Copy the Maplist
		$data = $aseco->server->maps->map_list;

		// Sort by Karma
		$karma = array();
		foreach ($data as $key => $row) {
			$karma[$key] = $row->karma;
		}
		array_multisort($karma, SORT_NUMERIC, SORT_DESC, $data);
		unset($karma, $key, $row);

		$i = 0;
		foreach ($data as $key => $row) {

			// Do not add Maps with lower amount of votes
			if ($row->karma_votes < $this->config['FEATURES'][0]['KARMA'][0]['MIN_VOTES'][0]) {
				continue;
			}

			// Do not add Map with a Karma lower then 1 (only necessary for <calculation_method> 'rasp')
			if ($row->karma < 1) {
				continue;
			}

			// Do not add Maps without any votes
			if ($row->karma_votes == 0) {
				continue;
			}

			$this->scores['TopMaps'][$i]['rank']	= ($i+1);
			$this->scores['TopMaps'][$i]['karma']	= $row->karma;
			$this->scores['TopMaps'][$i]['map']	= $row->name;
			$i ++;
		}
		unset($data, $key, $row);

		$this->config['States']['TopMaps']['NeedUpdate'] = false;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopVoters ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			COUNT(`r`.`Score`) AS `vote_count`,
			`p`.`Login` AS `login`,
			`p`.`Nickname` AS `nickname`
		FROM `%prefix%ratings` AS `r`, `%prefix%players` AS `p`
		WHERE `r`.`PlayerId` = `p`.`PlayerId`
		GROUP BY `r`.`PlayerId`
		ORDER BY `vote_count` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopVoters'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopVoters'][$i]['rank']	= ($i+1);
					$this->scores['TopVoters'][$i]['score']	= $this->formatNumber((int)$row->vote_count, 0);
					$this->scores['TopVoters'][$i]['login']	= $row->login;
					$this->scores['TopVoters'][$i]['nickname']	= $this->handleSpecialChars($row->nickname);

					$i++;
				}

				$this->config['States']['TopVoters']['NeedUpdate'] = false;
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopBetwins ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		if ($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['DISPLAY'][0] == true) {
			// Calculate the Average
			$query = "
			SELECT
				`p`.`Login`,
				`p`.`Nickname`,
				((`b`.`wins` / `b`.`stake`) * `b`.`countwins`) AS `won`
			FROM `betting` AS `b`
			LEFT JOIN `%prefix%players` AS `p` ON `p`.`Login` = `b`.`login`
			WHERE `b`.`wins` > 0
			AND `p`.`Nickname` IS NOT NULL
			ORDER BY `won` DESC
			". $appendix .";
			";
		}
		else {
			// Get the Planets
			$query = "
			SELECT
				`p`.`Login`,
				`p`.`Nickname`,
				`b`.`wins` AS `won`
			FROM `betting` AS `b`
			LEFT JOIN `%prefix%players` AS `p` ON `p`.`Login` = `b`.`login`
			WHERE `b`.`wins` > 0
			AND `p`.`Nickname` IS NOT NULL
			ORDER BY `won` DESC
			". $appendix .";
			";
		}

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopBetwins'] = array();

				$i = 0;
				if ($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['DISPLAY'][0] == true) {
					// Wanna have the average
					while ($row = $res->fetch_object()) {
						$this->scores['TopBetwins'][$i]['rank']		= ($i+1);
						$this->scores['TopBetwins'][$i]['login']	= $row->Login;
						$this->scores['TopBetwins'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
						$this->scores['TopBetwins'][$i]['won']		= sprintf("%.2f", $row->won);

						$i++;
					}
				}
				else {
					// Wanna have the Planets
					while ($row = $res->fetch_object()) {
						$this->scores['TopBetwins'][$i]['rank']		= ($i+1);
						$this->scores['TopBetwins'][$i]['login']	= $row->Login;
						$this->scores['TopBetwins'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
						$this->scores['TopBetwins'][$i]['won']		= $this->formatNumber((int)$row->won, 0) .' P';

						$i++;
					}
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopWinningPayout ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		// Get the Planets
		$query = "
		SELECT
			`Login`,
			`Nickname`,
			`WinningPayout` AS `won`
		FROM `%prefix%players`
		WHERE `WinningPayout` > 0
		AND `Nickname` IS NOT NULL
		ORDER BY `won` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopWinningPayouts'] = array();

				// Wanna have the Planets
				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopWinningPayouts'][$i]['rank']		= ($i+1);
					$this->scores['TopWinningPayouts'][$i]['login']		= $row->Login;
					$this->scores['TopWinningPayouts'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['TopWinningPayouts'][$i]['won']		= $this->formatNumber((int)$row->won, 0) .' P';

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopRoundscore ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`RoundPoints`,
			`Login`,
			`Nickname`
		FROM `%prefix%players`
		WHERE `RoundPoints` > 0
		ORDER BY `RoundPoints` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopRoundscore'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopRoundscore'][$i]['rank']	= ($i+1);
					$this->scores['TopRoundscore'][$i]['score']	= $this->formatNumber((int)$row->RoundPoints, 0);
					$this->scores['TopRoundscore'][$i]['login']	= $row->Login;
					$this->scores['TopRoundscore'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopVisitors ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`Visits`,
			`Login`,
			`Nickname`
		FROM `%prefix%players`
		WHERE `Visits` > 0
		ORDER BY `Visits` DESC
		". $appendix .";
		";


		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopVisitors'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopVisitors'][$i]['rank']	= ($i+1);
					$this->scores['TopVisitors'][$i]['score']	= $this->formatNumber((int)$row->Visits, 0);
					$this->scores['TopVisitors'][$i]['login']	= $row->Login;
					$this->scores['TopVisitors'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopActivePlayers ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`Login`,
			`Nickname`,
			DATEDIFF('". date('Y-m-d H:i:s', time() - date('Z')) ."', `LastVisit`) AS `Days`
		FROM `%prefix%players`
		ORDER BY `LastVisit` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopActivePlayers'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopActivePlayers'][$i]['rank']		= ($i+1);
					$this->scores['TopActivePlayers'][$i]['login']		= $row->Login;
					$this->scores['TopActivePlayers'][$i]['nickname']	= $this->handleSpecialChars($row->Nickname);
					$this->scores['TopActivePlayers'][$i]['score']		= (($row->Days == 0) ? 'Today' : $this->formatNumber(-$row->Days, 0) .' d');
					$this->scores['TopActivePlayers'][$i]['score_plain']	= (int)$row->Days;

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getTopContinents ($limit = -1) {
		global $aseco;

		$appendix = '';
		if ($limit > 0) {
			$appendix = 'LIMIT '. $limit;
		}

		$query = "
		SELECT
			`p`.`Continent`,
			COUNT(`p`.`Continent`) AS `ContinentCount`
		FROM `%prefix%players` AS `p`
		WHERE `p`.`Continent` != ''
		GROUP BY `p`.`Continent`
		ORDER BY `ContinentCount` DESC
		". $appendix .";
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				// Clean before filling
				$this->scores['TopContinents'] = array();

				$i = 0;
				while ($row = $res->fetch_object()) {
					$this->scores['TopContinents'][$i]['count']	= $this->formatNumber((int)$row->ContinentCount, 0);
					$this->scores['TopContinents'][$i]['continent']	= $aseco->continent->abbrToContinent($row->Continent);

					$i++;
				}
			}
			$res->free_result();
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMapAuthor ($map, $for_chat = false) {
		global $aseco;

		if ($this->config['FEATURES'][0]['MAPLIST'][0]['AUTHOR_DISPLAY'][0] == 'nickname') {
			if ($for_chat == true) {
				return (!empty($map->author_nickname) ? $map->author_nickname : $map->author);
			}
			else {
				return (!empty($map->author_nickname) ? $aseco->handleSpecialChars($map->author_nickname) : $map->author);
			}
		}
		else {
			return $map->author;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getCurrentSong () {
		global $aseco;

		// Get current song and strip server path
		$current = $aseco->client->query('GetForcedMusic');
		if ( ($current['Url'] != '') || ($current['File'] != '') ) {
			if ( isset($aseco->plugins['PluginMusicServer']) ) {
				$songname = str_replace(strtolower($aseco->plugins['PluginMusicServer']->server), '', ($current['Url'] != '' ? strtolower($current['Url']) : strtolower($current['File'])));
			}
			else {
				$songname = ($current['Url'] != '' ? strtolower($current['Url']) : strtolower($current['File']));
			}

			for ($i = 0; $i < count($this->cache['MusicServerPlaylist']); $i ++) {
				if (strtolower($this->cache['MusicServerPlaylist'][$i]['File']) == $songname) {
					$this->config['CurrentMusicInfos'] = array(
						'Artist'	=> $this->cache['MusicServerPlaylist'][$i]['Artist'],
						'Title'		=> $this->cache['MusicServerPlaylist'][$i]['Title']
					);
					return;
				}
			}
		}

		$this->config['CurrentMusicInfos'] = array(
			'Artist'	=> 'nadeo',
			'Title'		=> 'In-game music',
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMusicServerPlaylist ($only_refresh = false, $output_info = false) {
		global $aseco;

		if ( !isset($aseco->plugins['PluginMusicServer']) ) {
			return;
		}

		if ($only_refresh == false) {

			// Clean before refill
			$this->cache['MusicServerPlaylist'] = array();

			if ($output_info == true) {
				$amount = count($aseco->plugins['PluginMusicServer']->songs);
				$aseco->console('[RecordsEyepiece] Reading '. $amount . (($amount == 1) ? ' Song' : ' Songs') .'...');
			}

			$id = 1;	// SongId starts from 1
			foreach ($aseco->plugins['PluginMusicServer']->songs as $song) {

				if ( (isset($aseco->plugins['PluginMusicServer']->tags[$song]['Artist'])) && (!empty($aseco->plugins['PluginMusicServer']->tags[$song]['Artist'])) ) {
					$this->cache['MusicServerPlaylist'][] = array(
						'SongId'	=> $id,
						'File'		=> $song,
						'Artist'	=> '$Z'. $this->handleSpecialChars(utf8_decode($aseco->plugins['PluginMusicServer']->tags[$song]['Artist'])),
						'Title'		=> '$Z'. $this->handleSpecialChars(utf8_decode($aseco->plugins['PluginMusicServer']->tags[$song]['Title']))
					);
				}
				else {
					// Try to convert filename into "Artist" and "Title",
					// e.g. "paul_kalkbrenner_-_gebrunn_gebrunn_(berlin_calling_mix).ogg"
					// to $artist = 'Paul Kalkbrenner', $title = 'Gebrunn Gebrunn (Berlin Calling Mix)'
					$artist = '---';
					$title = '(Without Ogg Vorbis Infotag)';

					// Replace "_" with " "
					$music = str_replace('_', ' ', $song);

					// Remove ".ogg" or ".mux"
					$music = str_ireplace(
						array(
							'.ogg',
							'.mux'
						),
						array(
							'',
							''
						),
						$music
					);

					$pieces = explode('-', $music);
					foreach ($pieces as &$item) {
						$item = trim($item);
					}
					unset($item);
					if (count($pieces) > 2) {
						$artist = $pieces[0];
						$title = $pieces[count($pieces)-1];
					}
					else {
						$artist = (isset($pieces[0]) ? $pieces[0] : $artist);
						$title = (isset($pieces[1]) ? $pieces[1] : $title);
					}

					$this->cache['MusicServerPlaylist'][] = array(
						'SongId'	=> $id,
						'File'		=> $song,
						'Artist'	=> '$Z'. $this->handleSpecialChars(utf8_decode(ucwords($artist))),
						'Title'		=> '$Z'. $this->handleSpecialChars(utf8_decode(ucwords($title)))
					);

					// Setup the $aseco->plugins['PluginMusicServer']->tags also
					$aseco->plugins['PluginMusicServer']->tags[$song]['Artist'] = $this->handleSpecialChars(utf8_decode(ucwords($artist)));
					$aseco->plugins['PluginMusicServer']->tags[$song]['Title'] = $this->handleSpecialChars(utf8_decode(ucwords($title)));
				}
				$id ++;
			}
			unset($song);


			if ($this->config['FEATURES'][0]['SONGLIST'][0]['SORTING'][0] == true) {
				// Build the arrays for sorting
				$artists = array();
				$titles = array();
				foreach ($this->cache['MusicServerPlaylist'] as $key => $row) {
					$artists[$key]	= strtolower($row['Artist']);
					$titles[$key]	= strtolower($row['Title']);
				}
				unset($row);

				// Sort by Artist and Title
				array_multisort($artists, SORT_ASC, $titles, SORT_ASC, $this->cache['MusicServerPlaylist']);
				unset($artists, $titles);
			}
		}
		else {
			// It is required to refresh the SongIds if a Player juke'd a Song,
			// because plugin.musicserver.php resorts the SongIds at this situation
			// in the function selectSong() at the event onEndMap.

			$id = 1;	// SongId starts from 1
			foreach ($aseco->plugins['PluginMusicServer']->songs as $song) {
				foreach ($this->cache['MusicServerPlaylist'] as &$item) {
					if ($item['File'] ==  strtolower($song)) {
						$item['SongId'] = $id;
					}
				}
				unset($item);

				$id ++;
			}
			unset($song);

			// Set status to "done"
			$this->config['States']['MusicServerPlaylist']['NeedUpdate'] = false;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getPlayerLocalRecords ($pid) {
		global $aseco;

		// Get Player's Record for each Map
		$query = "
		SELECT
			`r`.`PlayerId`,
			`r`.`Score`,
			`m`.`Uid`,
			`r`.`MapId`
		FROM `%prefix%records` AS `r`
		LEFT JOIN `%prefix%maps` AS `m` ON `m`.`MapId` = `r`.`MapId`
		WHERE `r`.`Score` != ''
		AND `GamemodeId` = ". $aseco->server->gameinfo->mode ."
		ORDER BY `r`.`MapId` ASC, `Score` ASC,`Date` ASC;
		";
		$result = $aseco->db->query($query);

		if ($result) {
			$last = false;
			$list = array();
			$pos = 1;
			while ($row = $result->fetch_object()) {

				// Reset Rank counter
				if ($last != $row->Uid) {
					$last = $row->Uid;
					$pos = 1;
				}

				// Do not count Rank if already in Maplist
				if ( isset($list[$row->Uid]) ) {
					continue;
				}

				// Only add the calling Player
				if ($row->PlayerId == $pid) {
					$list[$row->Uid] = array(
						'rank'	=> $pos,
						'score'	=> $row->Score,
					);
					continue;
				}
				$pos ++;
			}
			$result->free_result();
		}

		return $list;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getPlayerUnfinishedMaps ($pid) {
		global $aseco;

		// Get list of finished Maps
		$query = "
		SELECT
			`MapId`
		FROM `%prefix%times`
		WHERE `PlayerId` = '". $pid ."'
		AND `GamemodeId` = ". $aseco->server->gameinfo->mode ."
		GROUP BY `MapId`
		ORDER BY `MapId`;
		";
		$result = $aseco->db->query($query);

		if ($result) {
			$finished = array();
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_object())
					$finished[] = $row->MapId;
			}
			$result->free_result();

			if ( !empty($finished) ) {
				// Get list of unfinished Maps
				$query = "
				SELECT
					`Uid`
				FROM `%prefix%maps`
				WHERE `MapId` NOT IN (". implode(',', $finished) .");
				";
				$result = $aseco->db->query($query);

				if ($result) {
					$unfinished = array();
					while ($row = $result->fetch_object()) {
						// Add only Maps that are in the Maplist, skip none present Maps
						foreach ($aseco->server->maps->map_list as $map) {
							if ($map->uid == $row->Uid) {
								$unfinished[] = $row->Uid;
								break 1;
							}
						}
						unset($map);
					}
					$result->free_result();

					return $unfinished;
				}
				return array();
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function findPlayerRecords ($login) {

		$DedimaniaRecords	= false;
		$LocalRecords		= false;

		// Check for DedimaniaRecords
		if ( count($this->scores['DedimaniaRecords']) > 0) {
			foreach ($this->scores['DedimaniaRecords'] as $item) {
				if ($item['login'] == $login) {
					$DedimaniaRecords = true;
					break;
				}
			}
			unset($item);
		}

		// Check for LocalRecords
		if ( count($this->scores['LocalRecords']) > 0) {
			foreach ($this->scores['LocalRecords'] as $item) {
				if ($item['login'] == $login) {
					$LocalRecords = true;
					break;
				}
			}
			unset($item);
		}

		return array(
			'DedimaniaRecords'	=> $DedimaniaRecords,
			'LocalRecords'		=> $LocalRecords
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildScorelistWidgetEntry ($manialinkid, $settings, $list, $fieldnames) {

		$limit = $settings['ENTRIES'][0];
		if (!$limit) {
			$limit = 6;
		}
		$xml = str_replace(
			array(
				'%manialinkid%',
				'%posx%',
				'%posy%',
				'%widgetheight%',
				'%icon_style%',
				'%icon_substyle%',
				'%title%'
			),
			array(
				$manialinkid,
				($settings['POS_X'][0] * 2.5),
				($settings['POS_Y'][0] * 1.875),
				(($this->config['LineHeight'] * 1.875) * $settings['ENTRIES'][0] + 6.1875),
				$settings['ICON_STYLE'][0],
				$settings['ICON_SUBSTYLE'][0],
				$settings['TITLE'][0]
			),
			$this->templates['SCORETABLE_LISTS']['HEADER']
		);

		if ( count($list) > 0 ) {
			// Build the entries
			$line = 0;
			$offset = 5.625;
			foreach ($list as $item) {
				$xml .= '<label posn="5.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="4.25 3.1875" halign="right" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $item['rank'] .'."/>';
				$xml .= '<label posn="14.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.5 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $item[$fieldnames[0]] .'"/>';
				$xml .= '<label posn="14.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="25.5 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $item[$fieldnames[1]] .'"/>';

				$line ++;

				if ($line >= $limit) {
					break;
				}
			}
		}
		$xml .= str_replace(
			'%widgetscale%',
			$settings['SCALE'][0],
			$this->templates['SCORETABLE_LISTS']['FOOTER']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildTopNationsForScore ($limit = 6) {
		global $aseco;

		$xml = str_replace(
			array(
				'%manialinkid%',
				'%posx%',
				'%posy%',
				'%widgetheight%',
				'%icon_style%',
				'%icon_substyle%',
				'%title%'
			),
			array(
				'TopNationsWidgetAtScore',
				($this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['POS_X'][0] * 2.5),
				($this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['POS_Y'][0] * 1.875),
				(($this->config['LineHeight'] * 1.875) * $this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ENTRIES'][0] + 6.1875),
				$this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ICON_STYLE'][0],
				$this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ICON_SUBSTYLE'][0],
				$this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['TITLE'][0]
			),
			$this->templates['SCORETABLE_LISTS']['HEADER']
		);

		if ( count($this->scores['TopNations']) > 0 ) {
			// Build the entries
			$line = 0;
			$offset = 5.625;
			foreach ($this->scores['TopNations'] as $item) {
				$xml .= '<label posn="10 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="8.5 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $item['count'] .'"/>';
				$xml .= '<quad posn="11.625 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.7) .' 0.002" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/'. (($item['nation'] == 'OTH') ? 'other' : $item['nation']) .'.dds"/>';
				$xml .= '<label posn="17.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="21.875 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $aseco->country->iocToCountry($item['nation']) .'"/>';

				$line ++;

				if ($line >= $limit) {
					break;
				}
			}
			unset($item);
		}
		$xml .= str_replace(
			'%widgetscale%',
			$this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['SCALE'][0],
			$this->templates['SCORETABLE_LISTS']['FOOTER']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildTopAverageTimesForScore ($limit = 6) {
		global $aseco;

		$xml = str_replace(
			array(
				'%manialinkid%',
				'%posx%',
				'%posy%',
				'%widgetheight%',
				'%icon_style%',
				'%icon_substyle%',
				'%title%'
			),
			array(
				'TopAverageTimesWidgetAtScore',
				($this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['POS_X'][0] * 2.5),
				($this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['POS_Y'][0] * 1.875),
				(($this->config['LineHeight'] * 1.875) * $this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['ENTRIES'][0] + 6.1875),
				$this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['ICON_STYLE'][0],
				$this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['ICON_SUBSTYLE'][0],
				$this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['TITLE'][0]
			),
			$this->templates['SCORETABLE_LISTS']['HEADER']
		);

		if ( count($this->scores['TopAverageTimes']) > 0 ) {

			// Calculate the averaves for each Player
			$data = array();
			foreach ($aseco->server->players->player_list as $player) {

				// Skip Player without any finish
				if ( isset($this->scores['TopAverageTimes'][$player->login]) ) {
					$score = floor( array_sum($this->scores['TopAverageTimes'][$player->login]) / count($this->scores['TopAverageTimes'][$player->login]) );
					$data[] = array(
						'score'		=> $score,
						'nickname'	=> $this->handleSpecialChars($player->nickname)
					);
				}
			}
			unset($player);

			// Sort the result
			$scores = array();
			foreach ($data as $key => $row) {
				$scores[$key] = $row['score'];
			}
			array_multisort($scores, SORT_NUMERIC, $data);
			unset($scores, $row);

			// Build the entries
			$line = 0;
			$offset = 5.625;
			foreach ($data as $item) {
				$xml .= '<label posn="5.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="4.25 3.1875" halign="right" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . ($line + 1) .'."/>';
				$xml .= '<label posn="14.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="9.5 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime($item['score']) .'"/>';
				$xml .= '<label posn="14.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.002" sizen="25.5 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $item['nickname'] .'"/>';

				$line ++;

				if ($line >= $limit) {
					break;
				}
			}
			unset($item);
		}
		$xml .= str_replace(
			'%widgetscale%',
			$this->config['SCORETABLE_LISTS'][0]['TOP_AVERAGE_TIMES'][0]['SCALE'][0],
			$this->templates['SCORETABLE_LISTS']['FOOTER']
		);

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildRecordWidgetContent ($gamemode, $player, $limit = 100, $widget) {

		// Setup the listname from given $widget, e.g. 'DEDIMANIA_RECORDS' to 'DedimaniaRecords'
		$list = str_replace(' ', '', ucwords(implode(' ', explode('_', strtolower($widget)))));

		// Set the preset
		$preset = false;
		if ($player !== false) {
			$preset = $player->data['PluginRecordsEyepiece']['Prefs']['WidgetEmptyEntry'];
		}

		// Set the Topcount
		$topcount = $this->config[$widget][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Add Widget header
		$xml = $this->cache[$list][$gamemode]['WidgetHeader'];

		// Build the entries if already loaded
		if ( count($this->scores[$list]) > 0 ) {

			if ($this->config['States']['NiceMode'] == false) {
				// Build the "CloseToYou" Array
				$records = $this->buildCloseToYouArray($this->scores[$list], $preset, $limit, $topcount);

				// Now check if it is required to build this Manialink (only required in normal mode, nice mode send always)
				$digest = $this->buildCloseToYouDigest($records);
				if ($this->cache['PlayerStates'][$player->login][$list] != false) {
					if ( ($this->cache['PlayerStates'][$player->login][$list] != $digest) || ($this->config['States'][$list]['UpdateDisplay'] == true) ) {

						// Widget is different as before, store them and build the new Widget
						$this->cache['PlayerStates'][$player->login][$list] = $digest;
					}
					else {
						// Widget is unchanged, no need to send now
						return;
					}
				}
				else {
					// Widget is build first time for this Player, store them and build the new Widget
					$this->cache['PlayerStates'][$player->login][$list] = $digest;
				}
			}
			else {
				$records = $this->scores[$list];
			}

			// Create the Widget entries
			$line = 0;
			$behind_rankings = false;
			foreach ($records as $item) {

				// Mark all Players behind the current with an orange icon instead a green one
				if ($player !== false && $item['login'] == $player->login) {
					$behind_rankings = true;
				}

				// Mark connected Players with a record
				if ($this->config['FEATURES'][0]['MARK_ONLINE_PLAYER_RECORDS'][0] == true && $this->config['States']['NiceMode'] == false && $player !== false && $item['login'] != $player->login) {
					$xml .= $this->getConnectedPlayerRecord($item['login'], $line, $topcount, $behind_rankings, ($this->config[$widget][0]['WIDTH'][0] * 2.5));
				}

				// Build record entries
				$xml .= $this->getCloseToYouEntry($item, $line, $topcount, $this->config['PlaceholderNoScore'], ($this->config[$widget][0]['WIDTH'][0] * 2.5));

				$line ++;

				if ($line >= $limit) {
					break;
				}
			}
			unset($item);

		}
		else if ($player !== false) {
			// Create an empty entry
			$xml .= $this->getCloseToYouEntry($preset, 0, $topcount, $this->config['PlaceholderNoScore'], ($this->config[$widget][0]['WIDTH'][0] * 2.5));
		}

		// Add Widget footer
		$xml .= $this->cache[$list][$gamemode]['WidgetFooter'];

		// Send the Widget now
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildDedimaniaRecordsWidgetBody ($gamemode) {

		// Set the right Icon and Title position
		$position = (($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] < 0) ? 'right' : 'left');

		// Set the Topcount
		$topcount = $this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Calculate the widget height (+ 6 for title)
		$widget_height = (($this->config['LineHeight'] * 1.875) * $this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] + 6);

		if ($position == 'right') {
			$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5));
			$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5));
			$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5));
		}
		else {
			$imagex	= $this->config['Positions'][$position]['image_open']['x'];
			$iconx	= $this->config['Positions'][$position]['icon']['x'];
			$titlex	= $this->config['Positions'][$position]['title']['x'];
		}

		$build['header'] = str_replace(
			array(
				'%manialinkid%',
				'%actionid%',
				'%posx%',
				'%posy%',
				'%image_open_pos_x%',
				'%image_open_pos_y%',
				'%image_open%',
				'%posx_icon%',
				'%posy_icon%',
				'%icon_style%',
				'%icon_substyle%',
				'%halign%',
				'%posx_title%',
				'%posy_title%',
				'%backgroundwidth%',
				'%backgroundheight%',
				'%borderwidth%',
				'%borderheight%',
				'%widgetwidth%',
				'%widgetheight%',
				'%column_width_name%',
				'%column_height%',
				'%title_background_width%',
				'%title%'
			),
			array(
				'DedimaniaRecordsWidget',
				'showDedimaniaRecordsWindow',
				($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] * 2.5),
				($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['POS_Y'][0] * 1.875),
				$imagex,
				-($widget_height - 8.2),
				$this->config['Positions'][$position]['image_open']['image'],
				$iconx,
				$this->config['Positions'][$position]['icon']['y'],
				$this->config['DEDIMANIA_RECORDS'][0]['ICON_STYLE'][0],
				$this->config['DEDIMANIA_RECORDS'][0]['ICON_SUBSTYLE'][0],
				$this->config['Positions'][$position]['title']['halign'],
				$titlex,
				$this->config['Positions'][$position]['title']['y'],
				(($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 0.5),
				($widget_height - 0.375),
				(($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) + 1),
				($widget_height + 0.6),
				($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5),
				$widget_height,
				(($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 16.125),
				($widget_height - 5.8125),
				(($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 2),
				$this->config['DEDIMANIA_RECORDS'][0]['TITLE'][0]
			),
			$this->templates['RECORD_WIDGETS']['HEADER']
		);

		// Add Background for top X Players
		if ($topcount > 0) {
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] != '') {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] .'"/>';
			}
			else {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_SUBSTYLE'][0] .'"/>';
			}
		}

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<dedimania_records> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
Void MoveIt (Text _Id, Boolean _ScrollOut, Vec3 _Position) {
	declare Container <=> (Page.GetFirstChild(_Id) as CMlFrame);
	if (_ScrollOut == True) {
		if (Container.RelativePosition.X >= 0) {
			while (Container.RelativePosition.X < 200) {
				Container.RelativePosition.X += 4.0;
				yield;
			}
		}
		else if (Container.RelativePosition.X < 0) {
			while (Container.RelativePosition.X > -240) {
				Container.RelativePosition.X -= 4.0;
				yield;
			}
		}
	}
	else {
		Container.RelativePosition = _Position;
	}
}
main () {
	declare persistent Boolean RecordsEyepieceDedimaniaRecordsVisible = True;

	declare DedimaniaRecordsWidget <=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare Vec3 OriginalRelativePosition = DedimaniaRecordsWidget.RelativePosition;

	DedimaniaRecordsWidget.RelativeScale	= {$this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['SCALE'][0]};
	DedimaniaRecordsWidget.Visible		= RecordsEyepieceDedimaniaRecordsVisible;
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Check for pressed F9 to hide the Widget
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::KeyPress : {
					if (Event.KeyName == "F9") {
						if (DedimaniaRecordsWidget.Visible == False) {
							MoveIt(Page.MainFrame.ControlId, False, OriginalRelativePosition);
							RecordsEyepieceDedimaniaRecordsVisible = True;
						}
						else {
							MoveIt(Page.MainFrame.ControlId, True, OriginalRelativePosition);
							RecordsEyepieceDedimaniaRecordsVisible = False;
						}
						DedimaniaRecordsWidget.Visible = RecordsEyepieceDedimaniaRecordsVisible;
					}
				}
			}
		}
	}
}
--></script>
EOL;
		$build['footer'] = $maniascript . $this->templates['RECORD_WIDGETS']['FOOTER'];

		return $build;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLocalRecordsWidgetBody ($gamemode) {

		// Set the right Icon and Title position
		$position = (($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] < 0) ? 'right' : 'left');

		// Set the Topcount
		$topcount = $this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Calculate the widget height (+ 6 for title)
		$widget_height = (($this->config['LineHeight'] * 1.875) * $this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] + 6);

		if ($position == 'right') {
			$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5));
			$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5));
			$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5));
		}
		else {
			$imagex	= $this->config['Positions'][$position]['image_open']['x'];
			$iconx	= $this->config['Positions'][$position]['icon']['x'];
			$titlex	= $this->config['Positions'][$position]['title']['x'];
		}

		$build['header'] = str_replace(
			array(
				'%manialinkid%',
				'%actionid%',
				'%posx%',
				'%posy%',
				'%image_open_pos_x%',
				'%image_open_pos_y%',
				'%image_open%',
				'%posx_icon%',
				'%posy_icon%',
				'%icon_style%',
				'%icon_substyle%',
				'%halign%',
				'%posx_title%',
				'%posy_title%',
				'%backgroundwidth%',
				'%backgroundheight%',
				'%borderwidth%',
				'%borderheight%',
				'%widgetwidth%',
				'%widgetheight%',
				'%column_width_name%',
				'%column_height%',
				'%title_background_width%',
				'%title%'
			),
			array(
				'LocalRecordsWidget',
				'showLocalRecordsWindow',
				($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] * 2.5),
				($this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['POS_Y'][0] * 1.875),
				$imagex,
				-($widget_height - 8.2),
				$this->config['Positions'][$position]['image_open']['image'],
				$iconx,
				$this->config['Positions'][$position]['icon']['y'],
				$this->config['LOCAL_RECORDS'][0]['ICON_STYLE'][0],
				$this->config['LOCAL_RECORDS'][0]['ICON_SUBSTYLE'][0],
				$this->config['Positions'][$position]['title']['halign'],
				$titlex,
				$this->config['Positions'][$position]['title']['y'],
				(($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5) - 0.5),
				($widget_height - 0.375),
				(($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5) + 1),
				($widget_height + 0.6),
				($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5),
				$widget_height,
				(($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5) - 16.125),
				($widget_height - 5.8125),
				(($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5) - 2),
				$this->config['LOCAL_RECORDS'][0]['TITLE'][0]
			),
			$this->templates['RECORD_WIDGETS']['HEADER']
		);

		// Add Background for top X Players
		if ($topcount > 0) {
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] != '') {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] .'"/>';
			}
			else {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['LOCAL_RECORDS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_SUBSTYLE'][0] .'"/>';
			}
		}

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<local_records> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
Void MoveIt (Text _Id, Boolean _ScrollOut, Vec3 _Position) {
	declare Container <=> (Page.GetFirstChild(_Id) as CMlFrame);
	if (_ScrollOut == True) {
		if (Container.RelativePosition.X >= 0) {
			while (Container.RelativePosition.X < 200) {
				Container.RelativePosition.X += 4.0;
				yield;
			}
		}
		else if (Container.RelativePosition.X < 0) {
			while (Container.RelativePosition.X > -240) {
				Container.RelativePosition.X -= 4.0;
				yield;
			}
		}
	}
	else {
		Container.RelativePosition = _Position;
	}
}
main () {
	declare persistent Boolean RecordsEyepieceLocalRecordsVisible = True;

	declare LocalRecordsWidget		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare Vec3 OriginalRelativePosition	= LocalRecordsWidget.RelativePosition;

	LocalRecordsWidget.RelativeScale	= {$this->config['LOCAL_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['SCALE'][0]};
	LocalRecordsWidget.Visible 		= RecordsEyepieceLocalRecordsVisible;
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::KeyPress : {
					if (Event.KeyName == "F9") {
						if (LocalRecordsWidget.Visible == False) {
							MoveIt(Page.MainFrame.ControlId, False, OriginalRelativePosition);
							RecordsEyepieceLocalRecordsVisible = True;
						}
						else {
							MoveIt(Page.MainFrame.ControlId, True, OriginalRelativePosition);
							RecordsEyepieceLocalRecordsVisible = False;
						}
						LocalRecordsWidget.Visible = RecordsEyepieceLocalRecordsVisible;
					}
				}
			}
		}
	}
}
--></script>
EOL;
		$build['footer'] = $maniascript . $this->templates['RECORD_WIDGETS']['FOOTER'];

		return $build;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLiveRankingsWidgetMS ($gamemode, $limit = 50) {

		// Set the right Icon and Title position
		$position = (($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] < 0) ? 'right' : 'left');

		// Set the Topcount
		$topcount = $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Calculate the widget height (+ 6 for title)
		$widget_height = (($this->config['LineHeight'] * 1.875) * $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] + 6);

		if ($position == 'right') {
			$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
			$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
			$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
		}
		else {
			$imagex	= $this->config['Positions'][$position]['image_open']['x'];
			$iconx	= $this->config['Positions'][$position]['icon']['x'];
			$titlex	= $this->config['Positions'][$position]['title']['x'];
		}

		$build['header'] = str_replace(
			array(
				'%manialinkid%',
				'%actionid%',
				'%posx%',
				'%posy%',
				'%image_open_pos_x%',
				'%image_open_pos_y%',
				'%image_open%',
				'%posx_icon%',
				'%posy_icon%',
				'%icon_style%',
				'%icon_substyle%',
				'%halign%',
				'%posx_title%',
				'%posy_title%',
				'%backgroundwidth%',
				'%backgroundheight%',
				'%borderwidth%',
				'%borderheight%',
				'%widgetwidth%',
				'%widgetheight%',
				'%column_width_name%',
				'%column_height%',
				'%title_background_width%',
				'%title%'
			),
			array(
				'LiveRankingsWidget',
				'showLiveRankingsWindow',
				($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] * 2.5),
				($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['POS_Y'][0] * 1.875),
				$imagex,
				-($widget_height - 8.2),
				$this->config['Positions'][$position]['image_open']['image'],
				$iconx,
				$this->config['Positions'][$position]['icon']['y'],
				$this->config['LIVE_RANKINGS'][0]['ICON_STYLE'][0],
				$this->config['LIVE_RANKINGS'][0]['ICON_SUBSTYLE'][0],
				$this->config['Positions'][$position]['title']['halign'],
				$titlex,
				$this->config['Positions'][$position]['title']['y'],
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 0.5),
				($widget_height - 0.375),
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) + 1),
				($widget_height + 0.6),
				($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5),
				$widget_height,
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 16.125),
				($widget_height - 5.8125),
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 2),
				$this->config['LIVE_RANKINGS'][0]['TITLE'][0]
			),
			$this->templates['RECORD_WIDGETS']['HEADER']
		);

		// Add Background for top X Players
		if ($topcount > 0) {
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] != '') {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] .'"/>';
			}
			else {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_SUBSTYLE'][0] .'"/>';
			}
		}


// START: CHANGE posn/sizen to version="2"!!!!
		$offset = 3;
		$textcolor = 'FFFF';
		foreach (range(0,$limit) as $line) {
			$xml .= '<label posn="2.3 -'. ($this->config['LineHeight'] * $line + $offset) .' 0.005" sizen="1.7 1.7" halign="right" scale="0.9" text="" id="RecordsEyepieceLiveRankingsRank'. $line .'"/>';
			$xml .= '<label posn="6 -'. ($this->config['LineHeight'] * $line + $offset) .' 0.005" sizen="3.9 1.7" halign="right" scale="0.9" textcolor="'. $textcolor .'" text="" id="RecordsEyepieceLiveRankingsScore'. $line .'"/>';
			$xml .= '<label posn="6.2 -'. ($this->config['LineHeight'] * $line + $offset) .' 0.005" sizen="'. sprintf("%.02f", ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] - 6)) .' 1.7" scale="0.9" text="" id="RecordsEyepieceLiveRankingsNickname'. $line .'"/>';
		}

		// Add marker for LocalUser Rank left and right from the Widget
		$line = 0;
		$xml .= '<frame posn="0 -'. ($this->config['LineHeight'] * $line + $offset - 0.55) .' 0.004" id="RecordsEyepieceLiveRankingsMarker" hidden="true">';
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
			$xml .= '<quad posn="0.4 -0.3 0.004" sizen="'. ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] - 0.8) .' 2" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'" id="RecordsEyepieceLiveRankingsBackgroundMarker" hidden="true"/>';
			$xml .= '<quad posn="-2 -0.3 0.004" sizen="2 2" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
			$xml .= '<quad posn="'. $this->config['LIVE_RANKINGS'][0]['WIDTH'][0] .' -0.3 0.004" sizen="2 2" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="0.4 -0.3 0.004" sizen="'. ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] - 0.8) .' 2" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'" id="RecordsEyepieceLiveRankingsBackgroundMarker" hidden="true"/>';
			$xml .= '<quad posn="-2 -0.3 0.004" sizen="2 2" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
			$xml .= '<quad posn="'. $this->config['LIVE_RANKINGS'][0]['WIDTH'][0] .' -0.3 0.004" sizen="2 2" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
		}
		$xml .= '<quad posn="-1.8 -0.5 0.005" sizen="1.6 1.6" style="Icons64x64_1" substyle="ShowRight2"/>';
		$xml .= '<quad posn="'. ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] + 0.2) .' -0.5 0.005" sizen="1.6 1.6" style="Icons64x64_1" substyle="ShowLeft2"/>';
		$xml .= '</frame>';
// STOP: CHANGE posn/sizen to version="2"!!!!

		// Setup the total count of Checkpoints
		$totalcps = 0;
		if ( ($gamemode == Gameinfo::ROUNDS) || ($gamemode == Gameinfo::TEAM) || ($gamemode == Gameinfo::CUP) ) {
			if ($this->cache['Map']['ForcedLaps'] > 0) {
				$totalcps = $this->cache['Map']['NbCheckpoints'] * $this->cache['Map']['ForcedLaps'];
			}
			else if ($this->cache['Map']['NbLaps'] > 0) {
				$totalcps = $this->cache['Map']['NbCheckpoints'] * $this->cache['Map']['NbLaps'];
			}
			else {
				$totalcps = $this->cache['Map']['NbCheckpoints'];
			}
		}
		else if ( ($this->cache['Map']['NbLaps'] > 0) && ($gamemode == Gameinfo::LAPS) ) {
			$totalcps = $this->cache['Map']['NbCheckpoints'] * $this->cache['Map']['NbLaps'];
		}
		else {
			// All other Gamemodes
			$totalcps = $this->cache['Map']['NbCheckpoints'];
		}


		$ColorSelf	= '$'. substr($this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SELF'][0], 0, 3);
		$ColorTop	= '$'. substr($this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['TOP'][0], 0, 3);
		$ColorBetter	= '$'. substr($this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BETTER'][0], 0, 3);
		$ColorWorse	= '$'. substr($this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['WORSE'][0], 0, 3);

		$multilapmap = (($aseco->server->maps->current->multilap == true) ? 'True' : 'False');

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<live_rankings> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
#Include "TextLib" as TextLib
#Include "MathLib" as MathLib
Void MoveIt (Text _Id, Boolean _ScrollOut, Vec3 _Position) {
	declare Container <=> (Page.GetFirstChild(_Id) as CMlFrame);
	if (_ScrollOut == True) {
		if (Container.RelativePosition.X >= 0) {
			while (Container.RelativePosition.X < 200) {
				Container.RelativePosition.X += 4.0;
				yield;
			}
		}
		else if (Container.RelativePosition.X < 0) {
			while (Container.RelativePosition.X > -240) {
				Container.RelativePosition.X -= 4.0;
				yield;
			}
		}
	}
	else {
		Container.RelativePosition = _Position;
	}
}
Text FormatTime (Integer MwTime) {
	declare Text FormatedTime = "-:--.---";

	if (MwTime > 0) {
		FormatedTime = TextLib::TimeToText(MwTime, True) ^ MwTime % 10;
	}
	return FormatedTime;
}
main () {
	declare persistent Boolean RecordsEyepieceLiveRankingsVisible = True;

//	declare Text[Text] RecordsEyepiece;
//	RecordsEyepiece["LiveRankings"] = [
//		"Visible"	=> True,
//		"Position"	=> <12.333, 2.0, 0.5>
//	];
//log(RecordsEyepiece);

	declare LiveRankingsWidget		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare LiveRankingsMarker		<=> (Page.GetFirstChild("RecordsEyepieceLiveRankingsMarker") as CMlFrame);
	declare LiveRankingsMarkerBG		<=> (Page.GetFirstChild("RecordsEyepieceLiveRankingsBackgroundMarker") as CMlQuad);

	declare Vec3 OriginalRelativePosition = LiveRankingsWidget.RelativePosition;

	declare Text ColorSelf			= "{$ColorSelf}";
	declare Text ColorTop			= "{$ColorTop}";
	declare Text ColorBetter		= "{$ColorBetter}";
	declare Text ColorWorse			= "{$ColorWorse}";
	declare Integer MaxEntries		= {$limit} - 1;
	declare Integer TopCount		= {$topcount};
	declare Integer MarkerOffset		= {$offset};
	declare Real LineHeight			= {$this->config['LineHeight']};
	declare Boolean MultilapMap		= {$multilapmap};
	declare Integer TotalCheckpoints	= {$totalcps};
	declare Boolean UpdateWidget		= True;
	declare Integer RefreshInterval		= 500;
	declare Integer RefreshTime		= CurrentTime;
	declare Integer CurrentLap		= 0;		// Using own CurrentLap instead of Player.CurrentNbLaps
	declare Integer CurrentCheckpoint	= 0;
	declare Integer[Text] LiveRankings;

	LiveRankingsWidget.RelativeScale	= {$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['SCALE'][0]};

	LiveRankingsWidget.Visible = RecordsEyepieceLiveRankingsVisible;
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Check for pressed F9 to hide the Widget
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::KeyPress : {
					if (Event.KeyName == "F9") {
						if (LiveRankingsWidget.Visible == False) {
							MoveIt(Page.MainFrame.ControlId, False, OriginalRelativePosition);
							RecordsEyepieceLiveRankingsVisible = True;
						}
						else {
							MoveIt(Page.MainFrame.ControlId, True, OriginalRelativePosition);
							RecordsEyepieceLiveRankingsVisible = False;
						}
						LiveRankingsWidget.Visible = RecordsEyepieceLiveRankingsVisible;
					}
				}
			}
		}

		if (LiveRankingsWidget.Visible == False) {
			continue;
		}

//LiveRankings["Player01"] = 20000;      // Same time
//LiveRankings["Player02"] = 22000;
//LiveRankings["Player03"] = 24000;
//LiveRankings["Player04"] = 26000;
//LiveRankings["Player05"] = 28000;      // Same time
//LiveRankings["Player06"] = 30000;
//LiveRankings["Player07"] = 32000;
//LiveRankings["Player08"] = 34000;
//LiveRankings["Player09"] = 36000;
//LiveRankings["Player10"] = 38000;
//LiveRankings["Player11"] = 40000;
//LiveRankings["Player12"] = 42000;
//LiveRankings["Player13"] = 44000;
//LiveRankings["Player14"] = 46000;
//LiveRankings["Player15"] = 48000;
//LiveRankings["Player16"] = 50000;
//LiveRankings["Player17"] = 52000;
//LiveRankings["Player18"] = 54000;
//LiveRankings["Player19"] = 56000;
//LiveRankings["Player20"] = 58000;

		foreach (Player in Players) {
			CurrentCheckpoint = 0;
			declare LiveRankings_LastCheckpointCount for Player = -1;
			if (LiveRankings_LastCheckpointCount != Player.CurRace.Checkpoints.count) {
				LiveRankings_LastCheckpointCount = Player.CurRace.Checkpoints.count;

				if (MultilapMap == True) {
					// Reset when Player restarts
					if (LiveRankings_LastCheckpointCount == 0) {
						CurrentLap = 0;
					}

					// Count the Lap and reset the CurrentCheckpoint count
					if ( (CurrentCheckpoint > (TotalCheckpoints-1)) ) {
						CurrentLap += 1;
					}
					CurrentCheckpoint = LiveRankings_LastCheckpointCount - (CurrentLap * TotalCheckpoints);
				}
				else {
					CurrentCheckpoint = LiveRankings_LastCheckpointCount;
				}
//				log("LR: " ^ Player.Login ^ ": Current CP: " ^ CurrentCheckpoint ^ " of " ^ TotalCheckpoints ^ " on lap " ^ CurrentLap ^", CP-Times: "^ Player.CurRace.Checkpoints ^" MultiLap: "^ MultilapMap);
			}

			// Players finish the Map?
			if (CurrentCheckpoint == TotalCheckpoints) {

				declare Integer FinishScore = Player.CurRace.Checkpoints[LiveRankings_LastCheckpointCount-1];
				if (MultilapMap == True) {
					// Reduce last FinishScore with the before Scores
					declare Integer Index = (LiveRankings_LastCheckpointCount - TotalCheckpoints) - 1;
					if (Index > 0) {
						FinishScore -= Player.CurRace.Checkpoints[Index];
					}
				}

				// Check for a better FinishScore as before
				declare Boolean FoundPlayer = False;
				foreach (Nickname => LastScore in LiveRankings) {
					if (Player.Name == Nickname) {
						if (FinishScore < LastScore) {
							// Update entry with an new time
							LiveRankings[Player.Name] = FinishScore;
							UpdateWidget = True;
						}
						else {
							// Add entry with an time from last run
							LiveRankings[Player.Name] = LastScore;
						}
						FoundPlayer = True;
					}
				}
				if (FoundPlayer == False) {
					// Add an new entry
					LiveRankings[Player.Name] = FinishScore;
					UpdateWidget = True;
				}
			}
		}

		if ( (UpdateWidget == True) && (CurrentTime > RefreshTime) ) {

			// Sort by finish time/score
			declare SortedRanking = Integer[Text];
			SortedRanking = LiveRankings.sort();

			// Find the Rank of LocalUser
			declare Integer LocalUserRank = 0;
			declare Integer LocalUserScore = 0;
			declare Integer CurrentRank = 0;
			foreach (Nickname => Score in SortedRanking) {
				if (Nickname == LocalUser.Name) {
					LocalUserRank	= CurrentRank;
					LocalUserScore	= Score;
					break;
				}
				CurrentRank += 1;
			}
			if (SortedRanking.existskey(LocalUser.Name) == False) {
				SortedRanking[LocalUser.Name] = 0;
			}

			// Init RankingList-Array
			declare RankingList = Text[Text][Integer];
			for (Pos, 0, MaxEntries) {
				RankingList[Pos] = ["Rank" => "NULL", "Nickname" => "NULL", "Score" => "NULL"];
			}

			// Add Players that are in the TopCount
			CurrentRank = 0;
			foreach (Nickname => Score in SortedRanking) {
				if ((CurrentRank+1) <= TopCount) {
					RankingList[CurrentRank] = ["Rank" => TextLib::ToText(CurrentRank+1), "Nickname" => Nickname, "Score" => FormatTime(Score)];
				}
				CurrentRank += 1;
				if (CurrentRank > TopCount) {
					break;
				}
			}


			declare Integer LocalUserPosition = 0;
			if (SortedRanking.count == 0) {
				// Add the LocalUser as first entry of RankingList[] and remove the rest
				RankingList = Text[Text][Integer];
				RankingList[LocalUserPosition] = ["Rank" => TextLib::ToText(LocalUserRank+1), "Nickname" => LocalUser.Name, "Score" => FormatTime(LocalUserScore)];
			}
			else if ((LocalUserRank+1) > TopCount) {
				// Center the LocalUser into the rest of (MaxEntries - TopCount)
				LocalUserPosition = MathLib::CeilingInteger(MathLib::ToReal(((MaxEntries+1) - TopCount) / 2)) + TopCount;

				// Are there enough other entries to fill the space between TopCount and LocalUser,
				// if not adjust LocalUserPosition to fit into
				declare Integer[] PlayersBeforeLocalUserPosition;
				CurrentRank = 0;
				foreach (Nickname => Score in SortedRanking) {
					if (Nickname != LocalUser.Name) {
						PlayersBeforeLocalUserPosition.add(CurrentRank);
					}
					else {
						break;
					}
					CurrentRank += 1;
				}
				if ((LocalUserRank+1) > (PlayersBeforeLocalUserPosition.count - TopCount)) {
					LocalUserPosition = PlayersBeforeLocalUserPosition.count;
				}
				RankingList[LocalUserPosition] = ["Rank" => TextLib::ToText(LocalUserRank+1), "Nickname" => LocalUser.Name, "Score" => FormatTime(LocalUserScore)];
			}
			else if ( ((LocalUserRank+1) == SortedRanking.count) && ((LocalUserRank+1) > TopCount) ) {
				// Add the LocalUser to the end of RankingList[]
				RankingList[MaxEntries] = ["Rank" => TextLib::ToText(LocalUserRank+1), "Nickname" => LocalUser.Name, "Score" => FormatTime(LocalUserScore)];
				LocalUserPosition = MaxEntries;
			}
			else {
				LocalUserPosition = LocalUserRank;
			}


			// Find the space between TopCount <-> LocalUser <-> MaxEntries
			declare Integer[] FreeSpotPosBeforeLocalUser;
			declare Integer[] FreeSpotPosAfterLocalUser;
			foreach (EntryId => Item in RankingList) {
				if (Item["Score"] == "NULL") {
					if (EntryId < LocalUserPosition) {
						FreeSpotPosBeforeLocalUser.add(EntryId);
					}
					else if (EntryId > LocalUserPosition) {
						FreeSpotPosAfterLocalUser.add(EntryId);
					}
				}
			}

			// Fill the space between TopCount and LocalUserPosition
			declare Integer Index = 0;
			if (FreeSpotPosBeforeLocalUser.count > 0) {
				for (Pos, ((LocalUserRank+1) - FreeSpotPosBeforeLocalUser.count), LocalUserRank) {
					CurrentRank = 0;
					foreach (Nickname => Score in SortedRanking) {
						if ((CurrentRank+1) == Pos) {
							RankingList[FreeSpotPosBeforeLocalUser[Index]] = ["Rank" => TextLib::ToText(CurrentRank+1), "Nickname" => Nickname, "Score" => FormatTime(Score)];
							break;
						}
						CurrentRank += 1;
					}
					Index += 1;
				}
			}

			// Fill the space between LocalUserPosition and MaxEntries
			Index = 0;
			if (FreeSpotPosAfterLocalUser.count > 0) {
				declare Integer StartPos = LocalUserRank;
				if ((LocalUserRank+1) <= TopCount) {
					StartPos = TopCount - 1;
				}
				for (Pos, (StartPos+2), (StartPos + 1 + FreeSpotPosAfterLocalUser.count)) {
					CurrentRank = 0;
					foreach (Nickname => Score in SortedRanking) {
						if ((CurrentRank+1) == Pos) {
							RankingList[FreeSpotPosAfterLocalUser[Index]] = ["Rank" => TextLib::ToText(CurrentRank+1), "Nickname" => Nickname, "Score" => FormatTime(Score)];
							break;
						}
						CurrentRank += 1;
					}
					Index += 1;
				}
			}

			// Remove all "NULL" entries
			foreach (EntryId => Item in RankingList) {
				if (Item["Score"] == "NULL") {
					RankingList.removekey(EntryId);
				}
			}


			// Build the list entries and display it
			declare Integer Pos = 0;
			LocalUserPosition = 0;
			foreach (EntryId => Item in RankingList) {
				declare LiveRankingsRank	<=> (Page.GetFirstChild("RecordsEyepieceLiveRankingsRank" ^ Pos) as CMlLabel);
				declare LiveRankingsScore	<=> (Page.GetFirstChild("RecordsEyepieceLiveRankingsScore" ^ Pos) as CMlLabel);
				declare LiveRankingsNickname	<=> (Page.GetFirstChild("RecordsEyepieceLiveRankingsNickname" ^ Pos) as CMlLabel);

				if (Item["Nickname"] == LocalUser.Name) {
					LiveRankingsMarker.RelativePosition.Y = -((LineHeight * Pos + MarkerOffset - 0.65) * 1.875);
					LiveRankingsMarker.Visible = True;

					if ((Pos+1) > TopCount) {
						LiveRankingsMarkerBG.Visible = True;
					}
					else {
						LiveRankingsMarkerBG.Visible = False;
					}

					if (Item["Score"] == FormatTime(0)) {
						LiveRankingsRank.SetText("--.");
					}
					else {
						LiveRankingsRank.SetText(Item["Rank"] ^ ".");
					}
					LiveRankingsScore.SetText(ColorSelf ^ Item["Score"]);
					LiveRankingsNickname.SetText(Item["Nickname"]);

					LocalUserPosition = Pos;
				}
				else {
					declare Text HighlightColor = ColorWorse;
					if ((Pos+1) <= TopCount) {
						HighlightColor = ColorTop;
					}
					else if ( (TextLib::ToInteger(Item["Rank"]) < (LocalUserRank+1)) || (LocalUserRank == 0) ) {
						HighlightColor = ColorBetter;
					}

					LiveRankingsRank.SetText(Item["Rank"] ^ ".");
					LiveRankingsScore.SetText(HighlightColor ^ Item["Score"]);
					LiveRankingsNickname.SetText(Item["Nickname"]);
				}

				Pos += 1;
				if (Pos > MaxEntries) {
					break;
				}
			}
			if (LocalUserPosition > MaxEntries) {
				LiveRankingsMarker.Visible = False;
			}
			UpdateWidget = False;

			// Reset RefreshTime
			RefreshTime = (CurrentTime + RefreshInterval);
		}
	}
}
--></script>
EOL;
		$xml .= $maniascript;
		$xml .= $this->templates['RECORD_WIDGETS']['FOOTER'];

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLiveRankingsWidget ($login, $preset, $gamemode, $limit = 50) {
		global $aseco;

		// Set the Placeholder for "No Score"
		if ($gamemode == Gameinfo::ROUNDS && $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['DISPLAY_TYPE'][0] == false) {
			// Only set this if 'score' are to display, if 'time' use the default
			if ( isset($aseco->server->gameinfo->rounds['PointsLimit']) ) {
				$placeholder = str_replace(
					array(
						'{score}',
						'{remaining}',
						'{pointlimit}'
					),
					array(
						0,
						$aseco->server->gameinfo->rounds['PointsLimit'],
						$aseco->server->gameinfo->rounds['PointsLimit']
					),
					$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['FORMAT'][0]
				);
			}
			else {
				$placeholder = 0;
			}
		}
		else if ($gamemode == Gameinfo::LAPS && $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['DISPLAY_TYPE'][0] == false) {
			// Only set this if 'checkpoints' are to display, if 'time' use the default
			if (isset($this->cache['Map']['NbCheckpoints']) && isset($this->cache['Map']['NbLaps'])) {
				$placeholder = '0/'. ($this->cache['Map']['NbCheckpoints'] * $this->cache['Map']['NbLaps']);
			}
			else {
				$placeholder = '0 cps.';
			}
		}
		else {
			// All other set the default
			$placeholder = $this->config['PlaceholderNoScore'];
		}

		// Set the Topcount
		$topcount = $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Add Widget header
		$xml = $this->cache['LiveRankings'][$gamemode]['WidgetHeader'];

		// Build the entries if already loaded
		if (count($this->scores['LiveRankings']) > 0) {
			if ($this->config['States']['NiceMode'] == false && $gamemode != Gameinfo::TEAM) {
				// Build the "CloseToYou" Array, but not in 'Team' and NiceMode
				$records = $this->buildCloseToYouArray($this->scores['LiveRankings'], $preset, $limit, $topcount);
			}
			else if ($gamemode == Gameinfo::TEAM) {
				// Need to handle 'Team' other then all other Gamemodes
				$records = $this->scores['LiveRankings'];
				$records[0]['self'] = 0;
				$records[0]['rank'] = false;
				$records[1]['self'] = 0;
				$records[1]['rank'] = false;
			}
			else {
				$records = $this->scores['LiveRankings'];
			}

			// Now check if it is required to build this Manialink (only required in normal mode, nice mode send always)
			if ($this->config['States']['NiceMode'] == false) {
				$digest = $this->buildCloseToYouDigest($records);
				if ($this->cache['PlayerStates'][$login]['LiveRankings'] != false) {
					if ($this->cache['PlayerStates'][$login]['LiveRankings'] != $digest) {
						// Widget is different as before, store them and build the new Widget
						$this->cache['PlayerStates'][$login]['LiveRankings'] = $digest;
					}
					else {
						// Widget is unchanged, no need to send now
						return;
					}
				}
				else {
					// Widget is build first time for this Player, store them and build the new Widget
					$this->cache['PlayerStates'][$login]['LiveRankings'] = $digest;
				}
			}

			// Create the Widget entries
			$line = 0;
			foreach ($records as $item) {
				// No markers of connected Players with a record in LiveRankings,
				// that overload the Widget with marker, because (maybe) all Players are online right now.

				// Build record entries
				$xml .= $this->getCloseToYouEntry($item, $line, $topcount, $placeholder, ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));

				$line ++;

				if ($line >= $limit) {
					break;
				}
			}
			unset($item);

		}
		else if ($login != false) {
			// Create an empty entry
			$xml .= $this->getCloseToYouEntry($preset, 0, $topcount, $placeholder, ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
		}

		// Add Widget footer
		$xml .= $this->cache['LiveRankings'][$gamemode]['WidgetFooter'];

		// Send the Widget now
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLiveRankingsWidgetBody ($gamemode) {

		// Set the right Icon and Title position
		$position = (($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] < 0) ? 'right' : 'left');

		// Set the Topcount
		$topcount = $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Calculate the widget height (+ 6 for title)
		$widget_height = (($this->config['LineHeight'] * 1.875) * $this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] + 6);

		if ($position == 'right') {
			$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
			$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
			$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5));
		}
		else {
			$imagex	= $this->config['Positions'][$position]['image_open']['x'];
			$iconx	= $this->config['Positions'][$position]['icon']['x'];
			$titlex	= $this->config['Positions'][$position]['title']['x'];
		}

		$build['header'] = str_replace(
			array(
				'%manialinkid%',
				'%actionid%',
				'%posx%',
				'%posy%',
				'%image_open_pos_x%',
				'%image_open_pos_y%',
				'%image_open%',
				'%posx_icon%',
				'%posy_icon%',
				'%icon_style%',
				'%icon_substyle%',
				'%halign%',
				'%posx_title%',
				'%posy_title%',
				'%backgroundwidth%',
				'%backgroundheight%',
				'%borderwidth%',
				'%borderheight%',
				'%widgetwidth%',
				'%widgetheight%',
				'%column_width_name%',
				'%column_height%',
				'%title_background_width%',
				'%title%'
			),
			array(
				'LiveRankingsWidget',
				'showLiveRankingsWindow',
				($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] * 2.5),
				($this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['POS_Y'][0] * 1.875),
				$imagex,
				-($widget_height - 8.2),
				$this->config['Positions'][$position]['image_open']['image'],
				$iconx,
				$this->config['Positions'][$position]['icon']['y'],
				$this->config['LIVE_RANKINGS'][0]['ICON_STYLE'][0],
				$this->config['LIVE_RANKINGS'][0]['ICON_SUBSTYLE'][0],
				$this->config['Positions'][$position]['title']['halign'],
				$titlex,
				$this->config['Positions'][$position]['title']['y'],
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 0.5),
				($widget_height - 0.375),
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) + 1),
				($widget_height + 0.6),
				($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5),
				$widget_height,
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 16.125),
				($widget_height - 5.8125),
				(($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 2),
				$this->config['LIVE_RANKINGS'][0]['TITLE'][0]
			),
			$this->templates['RECORD_WIDGETS']['HEADER']
		);

		// Add Background for top X Players
		if ($topcount > 0) {
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] != '') {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] .'"/>';
			}
			else {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['LIVE_RANKINGS'][0]['WIDTH'][0] * 2.5) - 2) .' '. ($topcount * ($this->config['LineHeight'] * 1.875)) .'" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_SUBSTYLE'][0] .'"/>';
			}
		}

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<live_rankings> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
Void MoveIt (Text _Id, Boolean _ScrollOut, Vec3 _Position) {
	declare Container <=> (Page.GetFirstChild(_Id) as CMlFrame);
	if (_ScrollOut == True) {
		if (Container.RelativePosition.X >= 0) {
			while (Container.RelativePosition.X < 200) {
				Container.RelativePosition.X += 4.0;
				yield;
			}
		}
		else if (Container.RelativePosition.X < 0) {
			while (Container.RelativePosition.X > -240) {
				Container.RelativePosition.X -= 4.0;
				yield;
			}
		}
	}
	else {
		Container.RelativePosition = _Position;
	}
}
main () {
	declare persistent Boolean RecordsEyepieceLiveRankingsVisible = True;

	declare LiveRankingsWidget <=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare Vec3 OriginalRelativePosition = LiveRankingsWidget.RelativePosition;

	LiveRankingsWidget.RelativeScale	= {$this->config['LIVE_RANKINGS'][0]['GAMEMODE'][0][$gamemode][0]['SCALE'][0]};
	LiveRankingsWidget.Visible 		= RecordsEyepieceLiveRankingsVisible;
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Check for pressed F9 to hide the Widget
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::KeyPress : {
					if (Event.KeyName == "F9") {
						if (LiveRankingsWidget.Visible == False) {
							MoveIt(Page.MainFrame.ControlId, False, OriginalRelativePosition);
							RecordsEyepieceLiveRankingsVisible = True;
						}
						else {
							MoveIt(Page.MainFrame.ControlId, True, OriginalRelativePosition);
							RecordsEyepieceLiveRankingsVisible = False;
						}
						LiveRankingsWidget.Visible = RecordsEyepieceLiveRankingsVisible;
					}
				}
			}
		}
	}
}
--></script>
EOL;
		$build['footer'] = $maniascript . $this->templates['RECORD_WIDGETS']['FOOTER'];

		return $build;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildRoundScoreWidget ($gamemode, $send_direct = true) {
		global $aseco;

		if ($this->config['States']['WarmUpPhase'] == true) {
			// Add Widget header
			$xml = $this->cache['RoundScore'][$gamemode]['WarmUp']['WidgetHeader'];

			// WarmUp note
			$xml .= '<label posn="5.75 -6 0.004" sizen="'. sprintf("%.02f", (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) / 100 * 156.45 + 13.75)) .' 3.1875" class="labels" scale="0.9" autonewline="1" textcolor="FA0F" text="No Score during'. LF .'Warm-up!"/>';

			// Add Widget footer
			$xml .= $this->cache['RoundScore'][$gamemode]['WarmUp']['WidgetFooter'];
		}
		else if (count($this->scores['RoundScore']) > 0) {

			// Add Widget header
			$xml = $this->cache['RoundScore'][$gamemode]['Race']['WidgetHeader'];

			// Set the right Icon and Title position
			$position = (($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] < 0) ? 'right' : 'left');

			// Adjust the Points to the connected Player count
			if ( ($gamemode == Gameinfo::TEAM) && ($aseco->server->gameinfo->team['UseAlternateRules'] == true) ) {

				// Get Playercount
				$limit = count($aseco->server->players->player_list);
				if ($limit > $aseco->server->gameinfo->team['MaxPointsPerRound']) {
					$limit = $aseco->server->gameinfo->team['MaxPointsPerRound'];
				}

				// Build new Points array
				$rpoints = array();
				$i = 0;
				for ($pts = 0; $pts <= $limit; $pts++) {
					$rpoints[] = $limit - $i;
					$i++;
				}
			}
			else if ($gamemode != Gameinfo::LAPS && $gamemode != Gameinfo::CHASE) {
				$rpoints = $this->config['RoundScore']['Points'][$gamemode];
			}



			// BEGIN: Sort the times
			$round_score = array();

			if ($gamemode == Gameinfo::LAPS || $gamemode == Gameinfo::CHASE) {
				$cps = array();
				$scores = array();
				$pids = array();
				foreach ($this->scores['RoundScore'] as $key => $row) {
					$cps[$key]	= $row['checkpointid'];
					$scores[$key]	= $row['score_plain'];
					$pids[$key]	= $row['playerid'];
				}
				unset($key, $row);

				// Sort order: CHECKPOINTID, SCORE and PID
				array_multisort($cps, SORT_NUMERIC, SORT_DESC, $scores, SORT_NUMERIC, $pids, SORT_NUMERIC, $this->scores['RoundScore']);
				unset($cps, $scores, $pids);

				foreach ($this->scores['RoundScore'] as $item) {
					// Merge the score arrays together
					$round_score[] = $item;
				}
				unset($item);
			}
			else {
				// Sort all the Scores, look for equal times and sort them with the
				// personal best from this whole round and pid where required
				ksort($this->scores['RoundScore']);
				foreach ($this->scores['RoundScore'] as $item) {

					// Sort only times which was more then once driven
					if (count($item) > 1) {
						$scores = array();
						$pbs = array();
						$pids = array();
						foreach ($item as $key => $row) {
							$scores[$key]	= $row['score_plain'];
							$pbs[$key]  	= $this->scores['RoundScorePB'][$row['login']];
							$pids[$key]	= $row['playerid'];
						}
						// Sort order: SCORE, PB and PID, like the same way the dedicated server does
						array_multisort($scores, SORT_NUMERIC, $pbs, SORT_NUMERIC, $pids, SORT_NUMERIC, $item);
						unset($scores, $pbs, $pids, $row);
					}
					// Merge the score arrays together
					$round_score = array_merge($round_score, $item);
				}
				unset($item, $row);
			}
			// END: Sort the times

//	$aseco->dump('RoundScore', $this->scores['RoundScore'], $round_score);

			$line = 0;
			$offset = 5.625;
			$team_break = false;
			foreach ($round_score as $item) {

				// Adjust Team points
				if ($gamemode == Gameinfo::TEAM) {
					if ($aseco->server->gameinfo->team['UseAlternateRules'] == false) {
						if ($team_break == true) {
							$points = '0';
						}
						else if ($round_score[0]['team'] != $item['team']) {
							$points = '0';
							$team_break = true;
						}
						else {
							$points = ((isset($rpoints[$line])) ? $rpoints[$line] : end($rpoints));
						}
					}
					else {
						$points = ((isset($rpoints[$line])) ? $rpoints[$line] : end($rpoints));
					}
				}
				else if ($gamemode != Gameinfo::LAPS && $gamemode != Gameinfo::CHASE) {
					// All other Gamemodes except 'Laps' and 'Chase'
					$points = ((isset($rpoints[$line])) ? $rpoints[$line] : end($rpoints));
				}

				// Switch Color of Topcount
				if (($line+1) <= $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0]) {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['TOP'][0];
				}
				else if (($line+1) > $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0]) {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['WORSE'][0];
				}

				if ($position == 'left') {
					if ($gamemode == Gameinfo::TEAM) {
						$xml .= '<quad posn="-8.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.2625) .' 0.004" sizen="8.5 3.15" bgcolor="'. (($item['team'] == 0) ? '03D8' : 'D308') .'"/>';
						$xml .= '<label posn="-1.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.005" sizen="7.5 3.75" class="labels" halign="right" scale="0.9" textcolor="FFFF" text="$O+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $points .'"/>';
					}
					else if ($gamemode == Gameinfo::LAPS) {
						if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] != '') {
							$xml .= '<quad posn="-17.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="17.5 3.5625" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] .'"/>';
						}
						else {
							$xml .= '<quad posn="-17.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="17.5 3.5625" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_SUBSTYLE'][0] .'"/>';
						}
						$xml .= '<label posn="-6 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="12 3.75" class="labels" halign="right" scale="0.9" textcolor="'. (($item['checkpointid'] < $round_score[0]['checkpointid']) ? 'D02F' : '0D3F') .'" text="$O+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime(abs($item['score_plain'] - $round_score[0]['score_plain'])) .'"/>';
						$xml .= '<label posn="-1 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="3.25 3.75" class="labels" halign="right" scale="0.9" textcolor="'. (($item['checkpointid'] < $round_score[0]['checkpointid']) ? 'D02F' : '0D3F') .'" text="$O'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ($item['checkpointid']+1) .'"/>';
					}
					else if ($gamemode == Gameinfo::CHASE) {
						$xml .= '<quad posn="-17.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="17.5 3.5625" bgcolor="'. (($item['team'] == 0) ? '03D8' : 'D308') .'"/>';
						$xml .= '<label posn="-6 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="12 3.75" class="labels" halign="right" scale="0.9" textcolor="FFFF" text="+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime(abs($item['score_plain'] - $round_score[0]['score_plain'])) .'"/>';
						$xml .= '<label posn="-1 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="3.25 3.75" class="labels" halign="right" scale="0.9" textcolor="FFFF" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ($item['checkpointid']+1) .'"/>';
					}
					else {
						// Gameinfo::ROUNDS or Gameinfo::CUP
						if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] != '') {
							$xml .= '<quad posn="-10.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="10 3.5625" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] .'"/>';
						}
						else {
							$xml .= '<quad posn="-10.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="10 3.5625" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_SUBSTYLE'][0] .'"/>';
						}
						$xml .= '<label posn="-1.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="7.5 3.75" class="labels" halign="right" scale="0.9" textcolor="0D3F" text="$O+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $points .'"/>';
					}
				}
				else {
					if ($gamemode == Gameinfo::TEAM) {
						$xml .= '<quad posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 1.25) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.2625) .' 0.004" sizen="8.5 3.15" bgcolor="'. (($item['team'] == 0) ? '03D8' : 'D308') .'"/>';
						$xml .= '<label posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 9) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.005" sizen="7.5 3.75" class="labels" halign="right" scale="0.9" textcolor="FFFF" text="$O+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $points .'"/>';
					}
					else if ($gamemode == Gameinfo::LAPS) {
						if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] != '') {
							$xml .= '<quad posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 0.4) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="17.5 3.5625" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] .'"/>';
						}
						else {
							$xml .= '<quad posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 0.4) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="17.5 3.5625" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_SUBSTYLE'][0] .'"/>';
						}
						$xml .= '<label posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 11.5) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="12 3.5625" class="labels" halign="right" scale="0.9" textcolor="'. (($item['checkpointid'] < $round_score[0]['checkpointid']) ? 'D02F' : '0D3F') .'" text="$O+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime(abs($item['score_plain'] - $round_score[0]['score_plain'])) .'"/>';
						$xml .= '<label posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 17.5) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="3.25 3.5625" class="labels" halign="right" scale="0.9" textcolor="'. (($item['checkpointid'] < $round_score[0]['checkpointid']) ? 'D02F' : '0D3F') .'" text="$O'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ($item['checkpointid']+1) .'"/>';
					}
					else if ($gamemode == Gameinfo::CHASE) {
						$xml .= '<quad posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 0.4) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="17.5 3.5625" bgcolor="'. (($item['team'] == 0) ? '03D8' : 'D308') .'"/>';
						$xml .= '<label posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 11.5) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="12 3.75" class="labels" halign="right" scale="0.9" textcolor="FFFF" text="+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime(abs($item['score_plain'] - $round_score[0]['score_plain'])) .'"/>';
						$xml .= '<label posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 17.5) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="3.25 3.75" class="labels" halign="right" scale="0.9" textcolor="FFFF" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ($item['checkpointid']+1) .'"/>';
					}
					else {
						// Gameinfo::ROUNDS or Gameinfo::CUP
						if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] != '') {
							$xml .= '<quad posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 0.4) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="10 3.5625" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_BACKGROUND'][0] .'"/>';
						}
						else {
							$xml .= '<quad posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 0.4) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.003" sizen="10 3.5625" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_COMMON_SUBSTYLE'][0] .'"/>';
						}
						$xml .= '<label posn="'. (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 9) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="7.5 3.75" class="labels" halign="right" scale="0.9" textcolor="0D3F" text="$O+'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $points .'"/>';
					}
				}

				$xml .= '<label posn="5.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="4.25 3.1875" class="labels" halign="right" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ($line+1) .'."/>';
				$xml .= '<label posn="14.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="9.5 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $textcolor .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['score'] .'"/>';
				$xml .= '<label posn="15.25 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.004" sizen="'. sprintf("%.02f", (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) / 100 * 156.45)) .' 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['nickname'] .'"/>';

				$line ++;

				if ($line >= $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0]) {
					break;
				}
			}
			unset($item);

			// Add Widget footer
			$xml .= $this->cache['RoundScore'][$gamemode]['Race']['WidgetFooter'];
		}
		else {
			// Add Widget header
			$xml = $this->cache['RoundScore'][$gamemode]['Race']['WidgetHeader'];

			// Empty entry
			$xml .= '<label posn="5.75 -5.625 0.004" sizen="4.25 3.1875" class="labels" halign="right" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] .'--."/>';
			$xml .= '<label posn="14.75 -5.625 0.004" sizen="9.5 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['TOP'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] .'-:--.---"/>';
			$xml .= '<label posn="15.25 -5.625 0.004" sizen="'. sprintf("%.02f", (($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) / 100 * 156.45)) .' 3.1875" class="labels" scale="0.9" textcolor="FA0F" text=" Free For You!"/>';

			// Add Widget footer
			$xml .= $this->cache['RoundScore'][$gamemode]['Race']['WidgetFooter'];
		}

		if ($send_direct == true) {
			// Send the Widget now to all Player
			$this->sendManialink($xml, false, 0);
		}
		else {
			return $xml;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildRoundScoreWidgetBody ($gamemode, $operation) {

		// Set the right Icon and Title position
		$position = (($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] < 0) ? 'right' : 'left');

		// Set the Topcount
		$topcount = $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['TOPCOUNT'][0];

		// Calculate the widget height (+ 6 for title)
		$widget_height = (($this->config['LineHeight'] * 1.875) * $this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['ENTRIES'][0] + 6);

		if ($position == 'right') {
			$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5));
			$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5));
		}
		else {
			$iconx	= $this->config['Positions'][$position]['icon']['x'];
			$titlex	= $this->config['Positions'][$position]['title']['x'];
		}

		$build['header'] = str_replace(
			array(
				'%manialinkid%',
				'%posx%',
				'%posy%',
				'%widgetscale%',
				'%posx_icon%',
				'%posy_icon%',
				'%icon_style%',
				'%icon_substyle%',
				'%halign%',
				'%posx_title%',
				'%posy_title%',
				'%borderwidth%',
				'%borderheight%',
				'%widgetwidth%',
				'%widgetheight%',
				'%column_width_name%',
				'%column_height%',
				'%title_background_width%',
				'%title%'
			),
			array(
				'RoundScoreWidget',
				($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['POS_X'][0] * 2.5),
				($this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['POS_Y'][0] * 1.875),
				$this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['SCALE'][0],
				$iconx,
				$this->config['Positions'][$position]['icon']['y'],
				$this->config['ROUND_SCORE'][0][$operation][0]['ICON_STYLE'][0],
				$this->config['ROUND_SCORE'][0][$operation][0]['ICON_SUBSTYLE'][0],
				$this->config['Positions'][$position]['title']['halign'],
				$titlex,
				$this->config['Positions'][$position]['title']['y'],
				(($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) + 1),
				($widget_height + 0.6),
				($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5),
				$widget_height,
				(($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) - 16.125),
				($widget_height - 3.1),
				(($this->config['ROUND_SCORE'][0]['WIDTH'][0] * 2.5) - 2),
				$this->config['ROUND_SCORE'][0]['TITLE'][0]
			),
			$this->templates['ROUNDSCOWIDGET']['HEADER']
		);

		// Add Background for top X Players
		if ($topcount > 0) {
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] != '') {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 2) .' '. (($topcount * ($this->config['LineHeight'] * 1.875)) + 0.5625) .'" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_BACKGROUND'][0] .'"/>';
			}
			else {
				$build['header'] .= '<quad posn="1 -5.0625 0.004" sizen="'. (($this->config['DEDIMANIA_RECORDS'][0]['WIDTH'][0] * 2.5) - 2) .' '. (($topcount * ($this->config['LineHeight'] * 1.875)) + 0.5625) .'" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TOP_SUBSTYLE'][0] .'"/>';
			}
		}

		$build['footer'] = str_replace(
			'%widgetscale%',
			$this->config['ROUND_SCORE'][0]['GAMEMODE'][0][$gamemode][0]['SCALE'][0],
			$this->templates['ROUNDSCOWIDGET']['FOOTER']
		);

		return $build;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Fully stolen from plugins.fufi.widgets.php (thanks fufi) and changed to my needs
	public function buildCloseToYouArray ($records, $preset, $ctuCount, $topCount) {

		// Set login to compare later
		$login = $preset['login'];

		// Init arrays
		$result = array_fill(0, $ctuCount, null);
		$better = array();
		$worse = array();
		$self = null;
		$isbetter = true;

		// Constructs arrays with records of better and worse players than the specified player
		for ($i=0; $i<count($records); $i++) {

			// When Player leaves, then (in some situation) this could be incomplete, just ignore in this case
			if ( !isset($records[$i]) ) {
				continue;
			}

			$entry = $records[$i];
			$entry['rank'] = $i + 1;
			if ($isbetter) {
				if ($records[$i]['login'] == $login) {
					$self = $entry;
					$isbetter = false;
				}
				else {
					$better[] = $entry;
				}
			}
			else {
				$worse[] = $entry;
			}
		}

		// Do the top x stuff
		$arrayTop = array();
		if ( count($better) > $topCount){
			for ($i=0; $i<$topCount; $i++) {
				$arrayTop[$i] = array();
				$arrayTop[$i] = array_shift($better);
				$arrayTop[$i]['self'] = -1;
			}
			$ctuCount -= $topCount;
		}

		// Go through the possibile scenarios and choose the right one (wow, what an explanation^^)
		if (!$self) {
			$lastIdx = $ctuCount - 1;
			$result[$lastIdx] = array();
			$result[$lastIdx]['rank'] = $preset['rank'];
			$result[$lastIdx]['login'] = $preset['login'];
			$result[$lastIdx]['nickname'] = $preset['nickname'];
			$result[$lastIdx]['score'] = $this->config['PlaceholderNoScore'];		// Changed onLoadingMap at related Gamemode
			$result[$lastIdx]['self'] = 0;
			for ($i=count($better)-1; $i>=0; $i--) {
				if (--$lastIdx >= 0) {
					$result[$lastIdx] = $better[$i];
					$result[$lastIdx]['self'] = -1;
				}
			}
		}
		else {
			$hasbetter = true;
			$hasworse = true;
			$resultNew = array();

			$resultNew[0] = $self;
			$resultNew[0]['self'] = 0;

			$idx = 0;

			while ( (count($resultNew) < $ctuCount) && (($hasbetter) || ($hasworse)) ) {

				if ( ($hasbetter) && (count($better) >= ($idx+1)) ) {

					// Push one record before
					$rec = $better[count($better) - 1 - $idx];
					$rec['self'] = -1;
					$help = array();
					$help[0] = $rec;
					for ($i=0; $i<count($resultNew); $i++) {
						$help[$i+1] = $resultNew[$i];
					}
					$resultNew = $help;
				}
				else {
					$hasbetter = false;
				}
				if ( count($resultNew) < ($ctuCount) ) {
					if ( ($hasworse) && (count($worse) >= ($idx+1)) ) {

						// Push one record behind
						$rec = $worse[$idx];
						$rec['self'] = 1;
						$resultNew[] = $rec;
					}
					else {
						$hasworse = false;
					}
				}
				$idx ++;
			}
			$result = $resultNew;
		}
		$result = array_merge($arrayTop, $result);

		$resultNew = array();
		$count = 0;
		for ($i=0; $i<count($result); $i++) {
			if ($result[$i] != null){
				$resultNew[] = $result[$i];
				$count ++;
			}
		}
		$result = $resultNew;

		return $result;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// Fully stolen from plugins.fufi.widgets.php (thanks fufi)
	public function buildCloseToYouDigest ($array) {

		$result = '';
		for ($i = 0; $i < count($array); $i ++) {
			// When Player leaves, then (in some situation) this could be incomplete, just ignore in this case
			if ( !isset($array[$i]) ) {
				continue;
			}

			$result .= $array[$i]['rank'];
			$result .= $array[$i]['login'];
			$result .= $array[$i]['nickname'];
			$result .= $array[$i]['score'];
		}
		return md5($result);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	// $list = 'locals'
	public function buildRecordDigest ($list, $array) {

		if ($list == 'locals') {
			$result = '';
			foreach ($array as $entry) {
				$result .= $entry->player->login;
				$result .= $entry->player->nickname;
				$result .= $entry->score;
			}
			unset($entry);
			return md5($result);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getCloseToYouEntry ($item, $line, $topcount, $noscore, $widgetwidth) {

		// Set offset for calculation the line-heights
		$offset = 5.625;

		// Set default Text color
		$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0];

		// Do not build the Player related highlites if in NiceMode!
		$xml = '';
		if ($this->config['States']['NiceMode'] == false) {
			if ($item['self'] == -1) {
				if ($item['rank'] < ($topcount+1)) {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['TOP'][0];
				}
				else {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BETTER'][0];
				}
			}
			else if ($item['self'] == 1) {
				if ($item['rank'] < ($topcount+1)) {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['TOP'][0];
				}
				else {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['WORSE'][0];
				}
			}
			else {
				if ($item['rank'] != false) {
					$textcolor = $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SELF'][0];

					// Add a background for this Player with an record here
					if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
						$xml .= '<quad posn="1 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.005" sizen="'. ($widgetwidth - 2) .' 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
					}
					else {
						$xml .= '<quad posn="1 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.005" sizen="'. ($widgetwidth - 2) .' 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
					}

					// $item['rank'] is set 'false' in Team to skip the highlite here in $this->buildLiveRankingsWidget()
					if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
						$xml .= '<quad posn="-3.675 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.005" sizen="3.375 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
						$xml .= '<quad posn="'. ($widgetwidth + 0.2) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.004" sizen="3.375 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
					}
					else {
						$xml .= '<quad posn="-3.675 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.005" sizen="3.375 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
						$xml .= '<quad posn="'. ($widgetwidth + 0.2) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.5625) .' 0.004" sizen="3.375 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
					}
					$xml .= '<quad posn="-3.475 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.375) .' 0.006" sizen="3 3" style="Icons64x64_1" substyle="ShowRight2"/>';
					$xml .= '<quad posn="'. ($widgetwidth + 0.4) .' -'. (($this->config['LineHeight'] * 1.875) * $line + $offset - 0.375) .' 0.006" sizen="3 3" style="Icons64x64_1" substyle="ShowLeft2"/>';
				}
			}
		}

		if ($item['rank'] != false) {
			if ( ($this->config['States']['NiceMode'] == true) && ($item['rank'] <= $topcount) ) {
				$textcolor = $this->config['NICEMODE'][0]['COLORS'][0]['TOP'][0];
			}
			else if ( ($this->config['States']['NiceMode'] == true) && ($item['rank'] > $topcount) ) {
				$textcolor = $this->config['NICEMODE'][0]['COLORS'][0]['WORSE'][0];
			}

			$xml .= '<label posn="5.75 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.005" sizen="4.25 3.1875" halign="right" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['rank'] .'."/>';
			$xml .= '<label posn="15 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.005" sizen="9.75 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $textcolor .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ( (isset($item['score'])) ? $item['score'] : $noscore) .'"/>';
		}
		else {
			// In Team nobody has a rank
			$xml .= '<label posn="15 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.005" sizen="13.5 3.1875" halign="right" class="labels" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['DEFAULT'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . ( (isset($item['score'])) ? $item['score'] : $noscore) .'"/>';
		}
		$xml .= '<label posn="15.5 -'. (($this->config['LineHeight'] * 1.875) * $line + $offset) .' 0.005" sizen="'. sprintf("%.02f", ($widgetwidth - 15)) .' 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['nickname'] .'"/>';

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getConnectedPlayerRecord ($login, $line, $topcount, $behind_rank = false, $widgetwidth) {
		global $aseco;

		// Is the given Player currently online? If true, mark her/his Record at other Players.
		if ( isset($aseco->server->players->player_list[$login]) ) {
			$xml = '';

			// Add a background for this Player with an record here
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] != '') {
				$xml .= '<quad posn="1 -'. (($this->config['LineHeight'] * 1.875) * $line + 5.0625) .' 0.005" sizen="'. ($widgetwidth - 2) .' 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
			}
			else {
				$xml .= '<quad posn="1 -'. (($this->config['LineHeight'] * 1.875) * $line + 5.0625) .' 0.005" sizen="'. ($widgetwidth - 2) .' 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
			}

			// Add a marker for Player with an record here (left and right from the Widget)
			if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] != '') {
				$xml .= '<quad posn="-3.675 -'. (($this->config['LineHeight'] * 1.875) * $line + 5.0625) .' 0.005" sizen="3.375 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
				$xml .= '<quad posn="'. ($widgetwidth + 0.2) .' -'. (($this->config['LineHeight'] * 1.875) * $line + 5.0625) .' 0.005" sizen="3.375 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
			}
			else {
				$xml .= '<quad posn="-3.675 -'. (($this->config['LineHeight'] * 1.875) * $line + 5.0625) .' 0.005" sizen="3.375 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
				$xml .= '<quad posn="'. ($widgetwidth + 0.2) .' -'. (($this->config['LineHeight'] * 1.875) * $line + 5.0625) .' 0.005" sizen="3.375 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
			}
			if ($behind_rank == true) {
				$marker = array('style' => 'Icons64x64_1', 'substyle' => 'NotBuddy');
			}
			else {
				$marker = array('style' => 'Icons64x64_1', 'substyle' => 'Buddy');
			}
			$xml .= '<quad posn="-3.375 -'. (($this->config['LineHeight'] * 1.875) * $line + 5.4375) .' 0.006" sizen="2.625 2.625" style="'. $marker['style'] .'" substyle="'. $marker['substyle'] .'"/>';
			$xml .= '<quad posn="'. ($widgetwidth + 0.7) .' -'. (($this->config['LineHeight'] * 1.875) * $line + 5.4375) .' 0.006" sizen="2.625 2.625" style="'. $marker['style'] .'" substyle="'. $marker['substyle'] .'"/>';

			return $xml;
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildDedimaniaRecordsWindow ($login) {
		global $aseco;

		$buttons = '<frame posn="160.1875 -101.8125 0.04">';
		$buttons .= '<quad posn="18.0625 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '</frame>';

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				$this->config['DEDIMANIA_RECORDS'][0]['ICON_STYLE'][0],
				$this->config['DEDIMANIA_RECORDS'][0]['ICON_SUBSTYLE'][0],
				$this->config['DEDIMANIA_RECORDS'][0]['TITLE'][0],
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		// Build Link to the Map at dedimania.net
		$dedimode = '';
		$gamemode = $aseco->server->gameinfo->mode;
		if ( ($gamemode == Gameinfo::ROUNDS) || ($gamemode == Gameinfo::TEAM) || ($gamemode == Gameinfo::CUP) ) {
			$dedimode = '&amp;Mode=M1';
		}
		else if ( ($gamemode == Gameinfo::TIME_ATTACK) || ($gamemode == Gameinfo::LAPS) ) {
			$dedimode = '&amp;Mode=M2';
		}
		$xml .= '<frame posn="71.5 -102.1875 0.04">';
		$xml .= '<label posn="30 0 0.02" sizen="75 4.875" class="labels" halign="center" scale="0.8" url="http://dedimania.net/tm2stats/?do=stat'. $dedimode .'&amp;&RecOrder3=RANK-ASC&amp;UId='. $aseco->server->maps->current->uid .'&amp;Show=RECORDS" text="MORE INFO ON DEDIMANIA.NET" style="CardButtonMediumWide"/>';
		$xml .= '</frame>';

		$xml .= '<frame posn="8 -12.1875 1">';
		$xml .= '<quad posn="0 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="47.625 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="95.25 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="142.875 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';


		// Add all connected PlayerLogins
		$players = array();
		foreach ($aseco->server->players->player_list as $player) {
			$players[] = $player->login;
		}
		unset($player);


		$rank = 1;
		$line = 0;
		$offset = 0;
		foreach ($this->scores['DedimaniaRecords'] as $item) {
			// Mark current connected Players
			if ($item['login'] == $login) {
				if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
				}
				else {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
				}
			}
			else if ( in_array($item['login'], $players) ) {
				if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] != '') {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
				}
				else {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
				}
			}
			$xml .= '<label posn="'. (6.5 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="5 3.1875" class="labels" halign="right" scale="0.9" text="'. $rank .'."/>';
			$xml .= '<label posn="'. (16 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="10 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $item['score'] .'"/>';
			$xml .= '<label posn="'. (17.25 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="28 3.1875" class="labels" scale="0.9" text="'. $item['nickname'] .'"/>';

			$line ++;
			$rank ++;

			// Reset lines
			if ($line >= 25) {
				$offset += 47.625;
				$line = 0;
			}

			// Display max. 100 entries, count start from 1
			if ($rank >= 101) {
				break;
			}
		}
		unset($item);
		$xml .= '</frame>';

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLocalRecordsWindow ($page, $login) {
		global $aseco;

		// Get the total of records
		$totalrecs = count($this->scores['LocalRecords']);

		// Determind the maxpages
		$maxpages = ceil($totalrecs / 100);
		if ($page > $maxpages) {
			$page = $maxpages - 1;
		}

		$buttons = '';

		$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';

		// Frame for Previous-/Next-Buttons
		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			// First
			$buttons .= '<frame posn="0 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageFirst" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.5 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';

			// Previous (-5)
			$buttons .= '<frame posn="6.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrevTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame posn="12.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			// First
			$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-5)
			$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-1)
			$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if (($page + 1) < $maxpages) {
			// Next (+1)
			$buttons .= '<frame posn="18.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Next (+5)
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNextTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Last
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageLast" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.25 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="3.275 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';
		}
		else {
			// Next (+1)
			$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Next (+5)
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Last
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}
		$buttons .= '</frame>';


		// Create Windowtitle
		if (count($this->scores['LocalRecords']) == 0) {
			$title = $this->config['LOCAL_RECORDS'][0]['TITLE'][0];
		}
		else {
			$title = $this->config['LOCAL_RECORDS'][0]['TITLE'][0] .'   |   Page '. ($page+1) .'/'. $maxpages .'   |   '. $this->formatNumber($totalrecs, 0) . (($totalrecs == 1) ? ' Record' : ' Records');
		}

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				$this->config['LOCAL_RECORDS'][0]['ICON_STYLE'][0],
				$this->config['LOCAL_RECORDS'][0]['ICON_SUBSTYLE'][0],
				$title,
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		$xml .= '<frame posn="8 -12.1875 1">';
		$xml .= '<quad posn="0 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="47.625 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="95.25 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="142.875 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';


		// Add all connected PlayerLogins
		$players = array();
		foreach ($aseco->server->players->player_list as $player) {
			$players[] = $player->login;
		}


		$entries = 0;
		$line = 0;
		$offset = 0;
		for ($i = ($page * 100); $i < (($page * 100) + 100); $i ++) {

			// Is there a record?
			if ( !isset($this->scores['LocalRecords'][$i]) ) {
				break;
			}

			$item = $this->scores['LocalRecords'][$i];

			// Mark current connected Players
			if ($item['login'] == $login) {
				if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
				}
				else {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
				}
			}
			else if ( in_array($item['login'], $players) ) {
				if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] != '') {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
				}
				else {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
				}
			}
			$xml .= '<label posn="'. (6.5 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="5 3.1875" class="labels" halign="right" scale="0.9" text="'. $item['rank'] .'."/>';
			$xml .= '<label posn="'. (16 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="10 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $item['score'] .'"/>';
			$xml .= '<label posn="'. (17.25 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="28 3.1875" class="labels" scale="0.9" text="'. $item['nickname'] .'"/>';

			$line ++;

			// Reset lines
			if ($line >= 25) {
				$offset += 47.625;
				$line = 0;
			}
		}
		$xml .= '</frame>';

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return array(
			'xml'		=> $xml,
			'maxpage'	=> ($maxpages - 1),
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLiveRankingsWindow ($page, $login) {
		global $aseco;

		// Get the total entries
		$totalentries = count($this->scores['LiveRankings']);

		// Determind the maxpages
		$maxpages = ceil($totalentries / 100);
		if ($page > $maxpages) {
			$page = $maxpages - 1;
		}

		$buttons = '';

		// Button up
		$buttons .= '<frame posn="178.25 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';

		// Frame for Previous/Next Buttons
		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if ( ($page < 3) && ($totalentries > 100) && (($page + 1) < $maxpages) ) {
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';
		}
		else {
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		$buttons .= '</frame>';


		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				$this->config['LIVE_RANKINGS'][0]['ICON_STYLE'][0],
				$this->config['LIVE_RANKINGS'][0]['ICON_SUBSTYLE'][0],
				$this->config['LIVE_RANKINGS'][0]['TITLE'][0],
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		$xml .= '<frame posn="8 -12.1875 1">';
		$xml .= '<quad posn="0 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="47.625 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="95.25 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="142.875 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';

		$line = 0;
		$offset = 0;
		for ($i = ($page * 100); $i < (($page * 100) + 100); $i ++) {

			// Is there a rank?
			if ( !isset($this->scores['LiveRankings'][$i]) ) {
				break;
			}

			$item = $this->scores['LiveRankings'][$i];

			// Mark current Player
			if ($item['login'] == $login) {
				if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
				}
				else {
					$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.43125 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
				}
			}
			$xml .= '<label posn="'. (6.5 + $offset) .' -'. (3.43125 * $line) .' 0.03" sizen="5 3.1875" class="labels" halign="right" scale="0.9" text="'. $item['rank'] .'."/>';
			$xml .= '<label posn="'. (16 + $offset) .' -'. (3.43125 * $line) .' 0.03" sizen="10 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $item['score'] .'"/>';
			$xml .= '<label posn="'. (17.25 + $offset) .' -'. (3.43125 * $line) .' 0.03" sizen="28 3.1875" class="labels" scale="0.9" text="'. $item['nickname'] .'"/>';

			$line ++;

			// Reset lines
			if ($line >= 25) {
				$offset += 47.625;
				$line = 0;
			}
		}
		$xml .= '</frame>';

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return array(
			'xml'		=> $xml,
			'maxpage'	=> ($maxpages - 1),
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildScorelistWindowEntry ($page, $target, $widget, $fieldnames) {
		global $aseco;

		// Setup the listname from given $widget, e.g. 'TOP_RANKINGS' to 'TopRankings'
		$list = str_replace(' ', '', ucwords(implode(' ', explode('_', strtolower($widget)))));

		// Get the total of records
		$totalentries = count($this->scores[$list]);

		// Determind the maxpages
		$maxpages = ceil($totalentries / 100);
		if ($page > $maxpages) {
			$page = $maxpages - 1;
		}

		$buttons = '';

		// Button up
		$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';

		// Frame for Previous-/Next-Buttons
		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			// First
			$buttons .= '<frame posn="0 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageFirst" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.5 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';

			// Previous (-5)
			$buttons .= '<frame posn="6.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrevTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame posn="12.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			// First
			$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-5)
			$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-1)
			$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if (($page + 1) < $maxpages) {
			// Next (+1)
			$buttons .= '<frame posn="18.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Next (+5)
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNextTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Last
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageLast" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.25 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="3.275 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';
		}
		else {
			// Next (+1)
			$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Next (+5)
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Last
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}
		$buttons .= '</frame>';


		// Create Windowtitle
		if (count($this->scores[$list]) == 0) {
			$title = $this->config['SCORETABLE_LISTS'][0][$widget][0]['TITLE'][0];
		}
		else {
			$title = $this->config['SCORETABLE_LISTS'][0][$widget][0]['TITLE'][0] .'   |   Page '. ($page+1) .'/'. $maxpages .'   |   '. $this->formatNumber($totalentries, 0) . (($totalentries == 1) ? ' Entry' : ' Entries');
		}

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				$this->config['SCORETABLE_LISTS'][0][$widget][0]['ICON_STYLE'][0],
				$this->config['SCORETABLE_LISTS'][0][$widget][0]['ICON_SUBSTYLE'][0],
				$title,
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		// Add all connected PlayerLogins
		$logins = array();
		foreach ($aseco->server->players->player_list as $player) {
			if ($player->login != $target) {
				$logins[] = $player->login;
			}
		}

		$xml .= '<frame posn="8 -12.1875 1">';
		$xml .= '<quad posn="0 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="47.625 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="95.25 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="142.875 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';

		$entries = 0;
		$rank = 1;
		$line = 0;
		$offset = 0;
		for ($i = ($page * 100); $i < (($page * 100) + 100); $i ++) {

			// Is there a record?
			if ( !isset($this->scores[$list][$i]) ) {
				break;
			}

			$item = $this->scores[$list][$i];

			// Mark current connected Players
			if (isset($item['login'])) {
				if ($item['login'] == $target) {
					if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
						$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.4312 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
					}
					else {
						$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.4312 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
					}
				}
				else if (in_array($item['login'], $logins)) {
					if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] != '') {
						$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.4312 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
					}
					else {
						$xml .= '<quad posn="'. ($offset + 0.5) .' '. (((3.43125 * $line - 0.375) > 0) ? -(3.4312 * $line - 0.375) : 0.375) .' 0.03" sizen="43.375 3.43125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
					}
				}
			}
			$xml .= '<label posn="'. (6.5 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="5 3.1875" class="labels" halign="right" scale="0.9" text="'. $item['rank'] .'."/>';
			$xml .= '<label posn="'. (16 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="10 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $item[$fieldnames[0]] .'"/>';
			$xml .= '<label posn="'. (17.25 + $offset) .' -'. (3.43125 * $line) .' 0.04" sizen="28 3.1875" class="labels" scale="0.9" text="'. $item[$fieldnames[1]] .'"/>';

			$line ++;
			$rank ++;

			// Reset lines
			if ($line >= 25) {
				$offset += 47.625;
				$line = 0;
			}
		}
		$xml .= '</frame>';

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return array(
			'xml'		=> $xml,
			'maxpage'	=> ($maxpages - 1),
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildLastCurrentNextMapWindow () {
		global $aseco;

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'Browse',
				'Playlist overview',
				''
			),
			$this->templates['WINDOW']['HEADER']
		);


		$xml .= '<frame posn="8 -10.6875 0.05">';		// BEGIN: Content Frame

		// Last Map
		$xml .= '<frame posn="0 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="60.125 88.125" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="59.125 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['LAST'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['LAST'][0]['ICON_SUBSTYLE'][0] .'"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="59 0" class="labels" text="'. $this->config['MAP_WIDGET'][0]['TITLES'][0]['LAST'][0] .'"/>';
		$xml .= '<quad posn="29.7 -6.75 0.03" sizen="42.2 31" halign="center" bgcolor="FFF9"/>';
		$xml .= '<label posn="29.7 -20.625 0.04" sizen="35 3.75" halign="center" class="labels" text="Press DEL if can not see an Image here!"/>';
		$xml .= '<quad posn="29.7 -7.25 0.50" sizen="41.2 30" halign="center" image="'. $aseco->handleSpecialChars($this->getMapImageUrl($aseco->server->maps->previous->uid) .'?.jpg') .'"/>';
		$xml .= '<label posn="3.5 -39.375 0.02" sizen="52.5 5.625" class="labels" textsize="2" text="'. $this->handleSpecialChars($aseco->server->maps->previous->name) .'"/>';
		$xml .= '<quad posn="3.75 -43.125 0.04" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/'. (strtoupper($aseco->server->maps->previous->author_nation) == 'OTH' ? 'other' : $aseco->server->maps->previous->author_nation) .'.dds"/>';
		$xml .= '<label posn="8.65 -43.6875 0.02" sizen="46 5.625" class="labels" text="by '. $this->getMapAuthor($aseco->server->maps->previous) .'"/>';
		$xml .= '<frame posn="7.4 -61.875 0">';	// BEGIN: Times frame
		$xml .= '<quad posn="0 13.3125 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalNadeo"/>';
		$xml .= '<quad posn="0 9 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalGold"/>';
		$xml .= '<quad posn="0 4.6875 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalSilver"/>';
		$xml .= '<quad posn="0 0.375 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalBronze"/>';
		$xml .= '<quad posn="0.5 -3.375 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Advanced"/>';
		$xml .= '<quad posn="0.5 -7.68749 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Manialink"/>';
		$xml .= '<label posn="1.25 12.9375 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->previous->author_time) .'"/>';
		$xml .= '<label posn="1.25 8.625 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->previous->goldtime) .'"/>';
		$xml .= '<label posn="1.25 4.3125 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->previous->silvertime) .'"/>';
		$xml .= '<label posn="1.25 0 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->previous->bronzetime) .'"/>';
		$xml .= '<label posn="1.25 -4.3125 0.1" sizen="20 3.75" class="labels" text="'. $aseco->server->maps->previous->environment .'"/>';
		$xml .= '<label posn="1.25 -8.625 0.1" sizen="20 3.75" class="labels" text="'. $aseco->server->maps->previous->mood .'"/>';
		$xml .= '</frame>';			// END: Times frame
		if ($aseco->server->maps->previous->mx !== false && $aseco->server->maps->previous->mx->pageurl != false) {
			$xml .= '<frame posn="26.5 -61.875 0">';	// BEGIN: MX Mapinfos
			$xml .= '<label posn="0 12.9375 0.1" sizen="12.5 4.125" class="labels" text="Type:"/>';
			$xml .= '<label posn="0 8.625 0.1" sizen="12.5 3.75" class="labels" text="Style:"/>';
			$xml .= '<label posn="0 4.3125 0.1" sizen="12.5 3.75" class="labels" text="Difficult:"/>';
			$xml .= '<label posn="0 0 0.1" sizen="12.5 3.75" class="labels" text="Routes:"/>';
			$xml .= '<label posn="0 -4.3125 0.1" sizen="12.5 4.875" class="labels" text="Awards:"/>';
			$xml .= '<label posn="0 -8.625 0.1" sizen="12.5 4.875" class="labels" text="Section:"/>';
			$xml .= '<label posn="12.75 12.9375 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->previous->mx->type .'"/>';
			$xml .= '<label posn="12.75 8.625 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->previous->mx->style .'"/>';
			$xml .= '<label posn="12.75 4.3125 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->previous->mx->diffic .'"/>';
			$xml .= '<label posn="12.75 0 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->previous->mx->routes .'"/>';
			$xml .= '<label posn="12.75 -4.3125 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->previous->mx->awards .'"/>';
			$xml .= '<label posn="12.75 -8.625 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->previous->mx->section .'"/>';
			$xml .= '</frame>';			// END: MX Mapinfos

			// Button "Visit Page"
			if ($aseco->server->maps->previous->mx->pageurl != false) {
				$xml .= '<frame posn="15 -74.0625 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->previous->mx->pageurl) .'" text="VISIT MAP PAGE" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}

			// Button "Download Map"
			if ($aseco->server->maps->previous->mx->dloadurl != false) {
				$xml .= '<frame posn="15 -78.28125 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->previous->mx->dloadurl) .'" text="DOWNLOAD MAP" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}

			// Button "Download Replay"
			if ($aseco->server->maps->previous->mx->replayurl != false) {
				$xml .= '<frame posn="15 -82.5 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->previous->mx->replayurl) .'" text="DOWNLOAD REPLAY" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}
		}
		$xml .= '</frame>';


		// Current Map
		$xml .= '<frame posn="63.625 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="60.125 88.125" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="59.125 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['CURRENT'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['CURRENT'][0]['ICON_SUBSTYLE'][0] .'"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="59 0" class="labels" text="'. $this->config['MAP_WIDGET'][0]['TITLES'][0]['CURRENT'][0] .'"/>';
		$xml .= '<quad posn="29.7 -6.75 0.03" sizen="42.2 31" halign="center" bgcolor="FFF9"/>';
		$xml .= '<label posn="29.7 -20.625 0.04" sizen="35 3.75" halign="center" class="labels" text="Press DEL if can not see an Image here!"/>';
		$xml .= '<quad posn="29.7 -7.25 0.50" sizen="41.2 30" halign="center" image="'. $aseco->handleSpecialChars($this->getMapImageUrl($aseco->server->maps->current->uid) .'?.jpg') .'"/>';
		$xml .= '<label posn="3.5 -39.375 0.02" sizen="52.5 5.625" class="labels" textsize="2" text="'. $this->handleSpecialChars($aseco->server->maps->current->name) .'"/>';
		$xml .= '<quad posn="3.75 -43.125 0.04" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/'. (strtoupper($aseco->server->maps->current->author_nation) == 'OTH' ? 'other' : $aseco->server->maps->current->author_nation) .'.dds"/>';
		$xml .= '<label posn="8.65 -43.6875 0.02" sizen="46 5.625" class="labels" text="by '. $this->getMapAuthor($aseco->server->maps->current) .'"/>';
		$xml .= '<frame posn="7.4 -61.875 0">';	// BEGIN: Times frame
		$xml .= '<quad posn="0 13.3125 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalNadeo"/>';
		$xml .= '<quad posn="0 9 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalGold"/>';
		$xml .= '<quad posn="0 4.6875 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalSilver"/>';
		$xml .= '<quad posn="0 0.375 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalBronze"/>';
		$xml .= '<quad posn="0.5 -3.375 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Advanced"/>';
		$xml .= '<quad posn="0.5 -7.68749 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Manialink"/>';
		$xml .= '<label posn="1.25 12.9375 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->current->author_time) .'"/>';
		$xml .= '<label posn="1.25 8.625 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->current->goldtime) .'"/>';
		$xml .= '<label posn="1.25 4.3125 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->current->silvertime) .'"/>';
		$xml .= '<label posn="1.25 0 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->current->bronzetime) .'"/>';
		$xml .= '<label posn="1.25 -4.3125 0.1" sizen="20 3.75" class="labels" text="'. $aseco->server->maps->current->environment .'"/>';
		$xml .= '<label posn="1.25 -8.625 0.1" sizen="20 3.75" class="labels" text="'. $aseco->server->maps->current->mood .'"/>';
		$xml .= '</frame>';			// END: Times frame
		if ($aseco->server->maps->current->mx !== false && $aseco->server->maps->current->mx->pageurl != false) {
			$xml .= '<frame posn="26.5 -61.875 0">';	// BEGIN: MX Mapinfos
			$xml .= '<label posn="0 12.9375 0.1" sizen="12.5 4.125" class="labels" text="Type:"/>';
			$xml .= '<label posn="0 8.625 0.1" sizen="12.5 3.75" class="labels" text="Style:"/>';
			$xml .= '<label posn="0 4.3125 0.1" sizen="12.5 3.75" class="labels" text="Difficult:"/>';
			$xml .= '<label posn="0 0 0.1" sizen="12.5 3.75" class="labels" text="Routes:"/>';
			$xml .= '<label posn="0 -4.3125 0.1" sizen="12.5 4.875" class="labels" text="Awards:"/>';
			$xml .= '<label posn="0 -8.625 0.1" sizen="12.5 4.875" class="labels" text="Section:"/>';
			$xml .= '<label posn="12.75 12.9375 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->current->mx->type .'"/>';
			$xml .= '<label posn="12.75 8.625 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->current->mx->style .'"/>';
			$xml .= '<label posn="12.75 4.3125 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->current->mx->diffic .'"/>';
			$xml .= '<label posn="12.75 0 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->current->mx->routes .'"/>';
			$xml .= '<label posn="12.75 -4.3125 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->current->mx->awards .'"/>';
			$xml .= '<label posn="12.75 -8.625 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->current->mx->section .'"/>';
			$xml .= '</frame>';			// END: MX Mapinfos

			// Button "Visit Page"
			if ($aseco->server->maps->current->mx->pageurl != false) {
				$xml .= '<frame posn="15 -74.0625 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->current->mx->pageurl) .'" text="VISIT MAP PAGE" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}

			// Button "Download Map"
			if ($aseco->server->maps->current->mx->dloadurl != false) {
				$xml .= '<frame posn="15 -78.28125 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->current->mx->dloadurl) .'" text="DOWNLOAD MAP" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}

			// Button "Download Replay"
			if ($aseco->server->maps->current->mx->replayurl != false) {
				$xml .= '<frame posn="15 -82.5 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->current->mx->replayurl) .'" text="DOWNLOAD REPLAY" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}
		}
		$xml .= '</frame>';


		// Next Map
		$xml .= '<frame posn="127.125 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="60.125 88.125" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="59.125 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['NEXT'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['NEXT'][0]['ICON_SUBSTYLE'][0] .'"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="59 0" class="labels" text="'. $this->config['MAP_WIDGET'][0]['TITLES'][0]['NEXT'][0] .'"/>';
		$xml .= '<quad posn="29.7 -6.75 0.03" sizen="42.2 31" halign="center" bgcolor="FFF9"/>';
		$xml .= '<label posn="29.7 -20.625 0.04" sizen="35 3.75" halign="center" class="labels" text="Press DEL if can not see an Image here!"/>';
		$xml .= '<quad posn="29.7 -7.25 0.50" sizen="41.2 30" halign="center" image="'. $aseco->handleSpecialChars($this->getMapImageUrl($aseco->server->maps->next->uid) .'?.jpg') .'"/>';
		$xml .= '<label posn="3.5 -39.375 0.02" sizen="52.5 5.625" class="labels" textsize="2" text="'. $this->handleSpecialChars($aseco->server->maps->next->name) .'"/>';
		$xml .= '<quad posn="3.75 -43.125 0.04" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/'. (strtoupper($aseco->server->maps->next->author_nation) == 'OTH' ? 'other' : $aseco->server->maps->next->author_nation) .'.dds"/>';
		$xml .= '<label posn="8.65 -43.6875 0.02" sizen="46 5.625" class="labels" text="by '. $this->getMapAuthor($aseco->server->maps->next) .'"/>';
		$xml .= '<frame posn="7.4 -61.875 0">';	// BEGIN: Times frame
		$xml .= '<quad posn="0 13.3125 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalNadeo"/>';
		$xml .= '<quad posn="0 9 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalGold"/>';
		$xml .= '<quad posn="0 4.6875 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalSilver"/>';
		$xml .= '<quad posn="0 0.375 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalBronze"/>';
		$xml .= '<quad posn="0.5 -3.375 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Advanced"/>';
		$xml .= '<quad posn="0.5 -7.68749 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Manialink"/>';
		$xml .= '<label posn="1.25 12.9375 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->next->author_time) .'"/>';
		$xml .= '<label posn="1.25 8.625 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->next->goldtime) .'"/>';
		$xml .= '<label posn="1.25 4.3125 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->next->silvertime) .'"/>';
		$xml .= '<label posn="1.25 0 0.1" sizen="20 3.75" class="labels" text="'. $aseco->formatTime($aseco->server->maps->next->bronzetime) .'"/>';
		$xml .= '<label posn="1.25 -4.3125 0.1" sizen="20 3.75" class="labels" text="'. $aseco->server->maps->next->environment .'"/>';
		$xml .= '<label posn="1.25 -8.625 0.1" sizen="20 3.75" class="labels" text="'. $aseco->server->maps->next->mood .'"/>';
		$xml .= '</frame>';			// END: Times frame
		if ($aseco->server->maps->next->mx !== false && $aseco->server->maps->next->mx->pageurl != false) {
			$xml .= '<frame posn="26.5 -61.875 0">';	// BEGIN: MX Mapinfos
			$xml .= '<label posn="0 12.9375 0.1" sizen="12.5 4.125" class="labels" text="Type:"/>';
			$xml .= '<label posn="0 8.625 0.1" sizen="12.5 3.75" class="labels" text="Style:"/>';
			$xml .= '<label posn="0 4.3125 0.1" sizen="12.5 3.75" class="labels" text="Difficult:"/>';
			$xml .= '<label posn="0 0 0.1" sizen="12.5 3.75" class="labels" text="Routes:"/>';
			$xml .= '<label posn="0 -4.3125 0.1" sizen="12.5 4.875" class="labels" text="Awards:"/>';
			$xml .= '<label posn="0 -8.625 0.1" sizen="12.5 4.875" class="labels" text="Section:"/>';
			$xml .= '<label posn="12.75 12.9375 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->next->mx->type .'"/>';
			$xml .= '<label posn="12.75 8.625 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->next->mx->style .'"/>';
			$xml .= '<label posn="12.75 4.3125 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->next->mx->diffic .'"/>';
			$xml .= '<label posn="12.75 0 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->next->mx->routes .'"/>';
			$xml .= '<label posn="12.75 -4.3125 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->next->mx->awards .'"/>';
			$xml .= '<label posn="12.75 -8.625 0.1" sizen="26.25 3.75" class="labels" text=" '. $aseco->server->maps->next->mx->section .'"/>';
			$xml .= '</frame>';			// END: MX Mapinfos

			// Button "Visit Page"
			if ($aseco->server->maps->next->mx->pageurl != false) {
				$xml .= '<frame posn="15 -74.0625 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->next->mx->pageurl) .'" text="VISIT MAP PAGE" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}

			// Button "Download Map"
			if ($aseco->server->maps->next->mx->dloadurl != false) {
				$xml .= '<frame posn="15 -78.28125 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->next->mx->dloadurl) .'" text="DOWNLOAD MAP" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}

			// Button "Download Replay"
			if ($aseco->server->maps->next->mx->replayurl != false) {
				$xml .= '<frame posn="15 -82.5 0.04">';
				$xml .= '<label posn="15 0 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->next->mx->replayurl) .'" text="DOWNLOAD REPLAY" style="CardButtonSmall"/>';
				$xml .= '</frame>';
			}
		}
		$xml .= '</frame>';


		$xml .= '</frame>';				// END: Content Frame
		$xml .= $this->templates['WINDOW']['FOOTER'];

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildAskDropMapFromPlaylist () {
		global $aseco;

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons64x64_1',
				'TrackInfo',
				'Notice',
				''
			),
			$this->templates['SUBWINDOW']['HEADER']
		);

		// Ask
		$xml .= '<label posn="8.75 -11.25 0.04" sizen="85 0" textsize="2" scale="0.8" autonewline="1" maxline="7" text="Do you really want to drop the complete Jukebox?"/>';
		$xml .= '<label posn="59.375 -42 0.02" sizen="30 3.75" halign="center" textsize="1" scale="0.8" action="PluginRecordsEyepiece?Action=dropMapFromPlaylist" text="YES" style="CardButtonMediumS"/>';
		$xml .= '<label posn="82.5 -42 0.02" sizen="30 3.75" halign="center" textsize="1" scale="0.8" id="RecordsEyepieceSubWindowClose" ScriptEvents="1" text="NO" style="CardButtonMediumS"/>';

		$xml .= $this->templates['SUBWINDOW']['FOOTER'];

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMaplistWindow ($page, $player) {
		global $aseco;

		// Filter activity requested?
		$maplist = array();
		$listoptions = '';	// Title addition
		if ( is_array($player->data['PluginRecordsEyepiece']['Maplist']['Filter']) ) {
			if ( isset($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['environment']) ){
				// Filter for environment
				foreach ($aseco->server->maps->map_list as $map) {
					if (strtoupper($map->environment) == $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['environment']) {
						$maplist[] = $map->uid;
					}
				}
				unset($map);
				$listoptions = '(Filter: Only env. '. ucfirst(strtolower($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['environment'])) .')';
			}
			else if ( isset($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['mood'])) {
				foreach ($aseco->server->maps->map_list as $map) {
					if (strtoupper($map->mood) == $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['mood']) {
						$maplist[] = $map->uid;
					}
				}
				unset($map);
				$listoptions = '(Filter: Only mood '. ucfirst(strtolower($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['mood'])) .')';
			}
			else if ( isset($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['author']) ){
				// Filter for MapAuthor
				foreach ($aseco->server->maps->map_list as $map) {
					if ($map->author == $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['author']) {
						$maplist[] = $map->uid;
					}
				}
				unset($map);
				$listoptions = '(Filter: Only Maps by '. $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['author'] .')';
			}
			else if ( isset($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'])) {
				if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NORANK') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (!isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'])) {
							$maplist[] = $map->uid;
						}
					}
					unset($map);
					$listoptions = '(Filter: Not Ranked Maps)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'ONLYRANK') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'])) {
							$maplist[] = $map->uid;
						}
					}
					unset($map);
					$listoptions = '(Filter: Only Ranked Maps)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NOAUTHOR') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid])) {
							if ($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['score'] > $map->author_time) {
								$maplist[] = $map->uid;
							}
						}
					}
					unset($map);
					$listoptions = '(Filter: No Author Time)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NOGOLD') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid])) {
							if ($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['score'] > $map->goldtime) {
								$maplist[] = $map->uid;
							}
						}
					}
					unset($map);
					$listoptions = '(Filter: No Gold Time)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NOSILVER') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid])) {
							if ($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['score'] > $map->silvertime) {
								$maplist[] = $map->uid;
							}
						}
					}
					unset($map);
					$listoptions = '(Filter: No Silver Time)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NOBRONZE') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid])) {
							if ($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['score'] > $map->bronzetime) {
								$maplist[] = $map->uid;
							}
						}
					}
					unset($map);
					$listoptions = '(Filter: No Bronze Time)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NORECENT') {
					foreach ($aseco->server->maps->map_list as $map) {
						if ($aseco->server->maps->history->isMapInHistoryByUid($map->uid) !== true) {
							$maplist[] = $map->uid;
						}
					}
					$listoptions = '(Filter: No Recent)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'ONLYRECENT') {
					foreach ($aseco->server->maps->history->map_list as $item) {
						foreach ($aseco->server->maps->map_list as $map) {
							if ($map->uid == $item['uid']) {
								$maplist[] = $map->uid;
							}
						}
						unset($map);
					}
					unset($uid);
					$listoptions = '(Filter: Only Recent)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'JUKEBOX') {
					foreach ($aseco->plugins['PluginRaspJukebox']->jukebox as $item) {
						foreach ($aseco->server->maps->map_list as $map) {
							// Find the Maps from the Jukebox
							if ($item['uid'] == $map->uid) {
								$maplist[] = $map->uid;
								break;
							}
						}
						unset($map);
					}
					unset($item);
					$listoptions = '(Filter: Only Jukebox)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'ONLYMULTILAP') {
					foreach ($aseco->server->maps->map_list as $map) {
						if ($map->multilap == true) {
							$maplist[] = $map->uid;
						}
					}
					unset($map);
					$listoptions = '(Filter: Only Multilap)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NOMULTILAP') {
					foreach ($aseco->server->maps->map_list as $map) {
						if ($map->multilap != true) {
							$maplist[] = $map->uid;
						}
					}
					unset($map);
					$listoptions = '(Filter: No Multilap)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['cmd'] == 'NOFINISH') {
					foreach ($aseco->server->maps->map_list as $map) {
						if (in_array($map->uid, $player->data['PluginRecordsEyepiece']['Maplist']['Unfinished']) ) {
							$maplist[] = $map->uid;
						}
					}
					unset($map);
					$listoptions = '(Filter: Not Finished Maps)';
				}
			}
			else if ( isset($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'])) {
				if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'BEST') {
					$list = array();
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'])) {
							$tmp = $map;
							$tmp->rank = $player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'];
							$list[] = $map;
						}
					}

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->rank;
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Best Player Rank)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'WORST') {
					$list = array();
					foreach ($aseco->server->maps->map_list as $map) {
						if (isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'])) {
							$tmp = $map;
							$tmp->rank = $player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'];
							$list[] = $map;
						}
					}

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->rank;
					}
					array_multisort($sort, SORT_DESC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Worst Player Rank)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'SHORTEST') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->author_time;
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Shortest Author Time)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'LONGEST') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->author_time;
					}
					array_multisort($sort, SORT_DESC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Longest Author Time)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'NEWEST') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->id;
					}
					array_multisort($sort, SORT_DESC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Newest Maps First)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'OLDEST') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->id;
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Oldest Maps First)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'MAPNAME') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key]	= strtolower($row->name_stripped);
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: By Map Name)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'AUTHORNAME') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key]	= strtolower($row->author);
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: By Author Name)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'BESTMAPS') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->karma;
					}
					array_multisort($sort, SORT_DESC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Karma Best Maps)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'WORSTMAPS') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->karma;
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: Karma Worst Maps)';
				}
				else if ($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['sort'] == 'AUTHORNATION') {
					$list = $aseco->server->maps->map_list;

					// Sort the array now
					$sort = array();
					foreach ($list as $key => $row) {
						$sort[$key] = $row->author_nation;
					}
					array_multisort($sort, SORT_ASC, $list);
					unset($sort, $row);

					foreach ($list as $map) {
						$maplist[] = $map->uid;
					}

					$listoptions = '(Sorting: By Author Nation)';
				}
			}
			else if ( isset($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['key'])) {
				foreach ($aseco->server->maps->map_list as $map) {
					if (
						(stripos($map->author, $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['key']) !== false)
						||
						(stripos($map->name_stripped, $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['key']) !== false)
						||
						(stripos($map->filename, $player->data['PluginRecordsEyepiece']['Maplist']['Filter']['key']) !== false)
					)
					{
						$maplist[] = $map->uid;
					}
					$listoptions = '(Search: &apos;'. $this->handleSpecialChars($player->data['PluginRecordsEyepiece']['Maplist']['Filter']['key']) .'&apos;)';
				}
				unset($map);
			}
		}
		else {
			// No Filter, show all Maps
			foreach ($aseco->server->maps->map_list as $map) {
				$maplist[] = $map->uid;
			}
		}


		$subwin = '';
		if (count($maplist) == 0) {

			$subwin = str_replace(
				array(
					'%icon_style%',
					'%icon_substyle%',
					'%window_title%',
					'%prev_next_buttons%'
				),
				array(
					'Icons64x64_1',
					'TrackInfo',
					'Notice',
					''
				),
				$this->templates['SUBWINDOW']['HEADER']
			);
			$subwin .= '<label posn="7.5 -11.25 0.04" sizen="105 0" textsize="2" scale="0.8" autonewline="1" maxline="7" text="This filter return an empty result, which means that no Track match your wished filter."/>';
			$subwin .= '<label posn="49.5 -42 0.02" sizen="20 3.75" halign="center" textsize="1" scale="0.8" id="RecordsEyepieceSubWindowClose" ScriptEvents="1" text="OK" style="CardButtonMediumS"/>';
			$subwin .= $this->templates['SUBWINDOW']['FOOTER'];

			// Filter does not match, show all Tracks
			foreach ($aseco->server->maps->map_list as $map) {
				$maplist[] = $map->uid;
			}

			// Reset all Filters/Titles
			$listoptions = '';
			$player->data['PluginRecordsEyepiece']['Maplist']['Filter'] = false;
		}


		// Get the total of Maps
		$totalmaps = count($maplist);

		// Determind the maxpages
		$maxpages = ceil($totalmaps / 20);
		if ($page > $maxpages) {
			$page = $maxpages - 1;
		}

		// Determine admin ability to drop all jukeboxed and to add recent played Maps
		$dropall = $aseco->allowAbility($player, 'dropjukebox');
		$add_recent = $aseco->allowAbility($player, 'chat_jb_recent');



		$buttons = '';

		// Button "Drop current juke'd Map"
		if ($aseco->allowAbility($player, 'clearjukebox')) {
			$buttons .= '<frame posn="127.0625 -101.8125 0.04">';
//			$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=askDropMapFromPlaylist" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons128x32_1" substyle="Settings"/>';
			$buttons .= '<label posn="1.8 -1.3 0.15" sizen="20 0" textsize="2" style="TextCardRaceRank" text="$S$W$O$F00/"/>';
			$buttons .= '</frame>';
		}


		// Filter Buttons
		$buttons .= '<frame posn="136.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistFilterWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="142.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistSortingWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
		$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="UIConstructionSimple_Buttons" substyle="Validate"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
//		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';


		// Frame for Previous-/Next-Buttons
		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			// First
			$buttons .= '<frame posn="0 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageFirst" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.5 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';

			// Previous (-5)
			$buttons .= '<frame posn="6.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrevTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame posn="12.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			// First
			$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-5)
			$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-1)
			$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if ( ($totalmaps > 20) && (($page + 1) < $maxpages) ) {
			// Next (+1)
			$buttons .= '<frame posn="18.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Next (+5)
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNextTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Last
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageLast" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.25 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="3.275 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';
		}
		else {
			// Next (+1)
			$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Next (+5)
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Last
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}
		$buttons .= '</frame>';


		// Create Windowtitle depending on the $maplist
		if (count($maplist) == 0) {
			$title = 'Maps on this Server';
		}
		else {
			$title = 'Maps on this Server   |   Page '. ($page+1) .'/'. $maxpages .'   |   '. $this->formatNumber($totalmaps, 0) . (($totalmaps == 1) ? ' Map' : ' Maps') .' '. $listoptions;
		}

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'Browse',
				$title,
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);


		$line = 0;
		$offset = 0;


		$xml .= '<frame posn="8 -10.6875 0.05">';
		if (count($maplist) > 0) {
			$map_count = 1;
			for ($i = ($page * 20); $i < (($page * 20) + 20); $i ++) {

				// Is there a Map?
				if (!isset($maplist[$i])) {
					break;
				}

				// Get Map
				$map = $aseco->server->maps->getMapByUid($maplist[$i]);

				// Find the Player who has juked this Map
				$login = false;
				$juked = 0;
				$tid = 1;
				foreach ($aseco->plugins['PluginRaspJukebox']->jukebox as $item) {
					if ($item['uid'] == $map->uid) {
						$login = $item['Login'];
						$juked = $tid;
						break;
					}
					$tid++;
				}
				unset($item);

//				// Find the Player who has juked this Map
//				$login = false;
//				$juked = false;
//				if ($playlist = $aseco->server->maps->playlist->getPlaylistEntryById($map->id) !== false) {
//					$login = $playlist['login'];
//					$juked = true;
//				}

				$xml .= '<frame posn="'. $offset .' -'. (17.71875 * $line) .' 1">';
				if ($aseco->server->maps->current->uid == $map->uid && $juked == false) {
					// Current map
//					$xml .= '<quad posn="0 0 0.02" sizen="44.375 17.25" bgcolor="BgsPlayerCard" substyle="BgRacePlayerName"/>';
//					$xml .= '<quad posn="1 -0.6749 0.04" sizen="42.375 3.75" style="BgsPlayerCard" substyle="ProgressBar"/>';
					$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="0099FF55"/>';
					$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=addMapToPlaylist&uid='. $map->uid .'" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_PLUS_FOCUS'][0] .'"/>';
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
					$xml .= '<label posn="15 -1.21875 0.05" sizen="18.25 0" class="labels" textsize="1" text="#'. ($i+1) .'"/>';
					$xml .= '<quad posn="1.5 -0.9375 0.05" sizen="12.5 2.8125" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['LOGOS'][0][strtoupper($map->environment)][0] .'"/>';
					$xml .= '<label posn="1.5 -5.0625 0.04" sizen="41.5 3" class="labels" text="'. $this->handleSpecialChars($map->name) .'"/>';
					$xml .= '<quad posn="1.5 -7.975 0.04" sizen="3.375 3.375" image="file://Skins/Avatars/Flags/'. (strtoupper($map->author_nation) == 'OTH' ? 'other' : $map->author_nation) .'.dds"/>';
					$xml .= '<label posn="6.125 -8.4375 0.04" sizen="41 2.75" class="labels" scale="0.9" text="by '. $aseco->stripColors($this->getMapAuthor($map), true) .'"/>';
				}
				else if ($aseco->server->maps->current->uid != $map->uid && $aseco->server->maps->history->isMapInHistoryByUid($map->uid) === false && $juked == false) {
					// Default (not current, not recent, not juked)
//					$xml .= '<quad posn="0 0 0.02" sizen="44.375 17.25" bgcolor="BgsPlayerCard" substyle="BgRacePlayerName"/>';
//					$xml .= '<quad posn="1 -0.6749 0.04" sizen="42.375 3.75" style="BgsPlayerCard" substyle="ProgressBar"/>';
					$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
					$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=addMapToPlaylist&uid='. $map->uid .'" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_PLUS_FOCUS'][0] .'"/>';
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
					$xml .= '<label posn="15 -1.21875 0.05" sizen="18.25 0" class="labels" textsize="1" text="#'. ($i+1) .'"/>';
					$xml .= '<quad posn="1.5 -0.9375 0.05" sizen="12.5 2.8125" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['LOGOS'][0][strtoupper($map->environment)][0] .'"/>';
					$xml .= '<label posn="1.5 -5.0625 0.04" sizen="41.5 3" class="labels" text="'. $this->handleSpecialChars($map->name) .'"/>';
					$xml .= '<quad posn="1.5 -7.975 0.04" sizen="3.375 3.375" image="file://Skins/Avatars/Flags/'. (strtoupper($map->author_nation) == 'OTH' ? 'other' : $map->author_nation) .'.dds"/>';
					$xml .= '<label posn="6.125 -8.4375 0.04" sizen="41 2.75" class="labels" scale="0.9" text="by '. $aseco->stripColors($this->getMapAuthor($map), true) .'"/>';
				}
				else if ($aseco->server->maps->current->uid != $map->uid && $aseco->server->maps->history->isMapInHistoryByUid($map->uid) === true && $juked == true) {
					// This is a recent but juked Map
//					$xml .= '<quad posn="0 0 0.02" sizen="44.375 17.25" bgcolor="BgsPlayerCard" substyle="BgRacePlayerName"/>';
//					$xml .= '<quad posn="0.675 -0.6375 0.04" sizen="43.5 4.125" style="BgsButtons" substyle="BgButtonMediumSpecial"/>';
					$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
					if ( ($dropall) || ($login == $player->login) ) {
						$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=removeMapFromPlaylist&uid='. $map->uid .'" image="'. $this->config['IMAGES'][0]['WIDGET_MINUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_MINUS_FOCUS'][0] .'"/>';
					}
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="00DD00FF"/>';
					$xml .= '<label posn="15 -1.21875 0.05" sizen="18.25 0" class="labels" textsize="1" textcolor="000F" text="#'. ($i+1) .'"/>';
					$xml .= '<quad posn="1.5 -0.9375 0.05" sizen="12.5 2.8125" modulatecolor="000" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['LOGOS'][0][strtoupper($map->environment)][0] .'"/>';
					$xml .= '<label posn="1.5 -5.0625 0.04" sizen="41.5 3" class="labels" textcolor="FFF8" text="'. $map->name_stripped .'"/>';
					$xml .= '<quad posn="1.5 -7.975 0.04" sizen="3.375 3.375" image="file://Skins/Avatars/Flags/'. (strtoupper($map->author_nation) == 'OTH' ? 'other' : $map->author_nation) .'.dds" opacity="0.3"/>';
					$xml .= '<label posn="6.125 -8.4375 0.04" sizen="41 2.75" class="labels" scale="0.9" textcolor="FFF8" text="by '. $aseco->stripColors($this->getMapAuthor($map), true) .'"/>';
				}
				else if ($aseco->server->maps->current->uid != $map->uid && $aseco->server->maps->history->isMapInHistoryByUid($map->uid) === true) {
					// This is a recent Map
//					$xml .= '<quad posn="0 0 0.02" sizen="44.375 17.25" bgcolor="BgsPlayerCard" substyle="BgRacePlayerName"/>';
//					$xml .= '<quad posn="1 -0.6749 0.04" sizen="42.375 3.75" style="BgsPlayerCard" substyle="BgRacePlayerName"/>';
					$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
					if ($add_recent) {
						$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=addMapToPlaylist&uid='. $map->uid .'" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_PLUS_FOCUS'][0] .'"/>';
					}
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
					$xml .= '<label posn="15 -1.21875 0.05" sizen="18.25 0" class="labels" textsize="1" textcolor="FFF8" text="#'. ($i+1) .'"/>';
					$xml .= '<quad posn="1.5 -0.9375 0.05" sizen="12.5 2.8125" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['LOGOS'][0][strtoupper($map->environment)][0] .'" opacity="0.3"/>';
					$xml .= '<label posn="1.5 -5.0625 0.04" sizen="41.5 3" class="labels" textcolor="FFF8" text="'. $map->name_stripped .'"/>';
					$xml .= '<quad posn="1.5 -7.975 0.04" sizen="3.375 3.375" image="file://Skins/Avatars/Flags/'. (strtoupper($map->author_nation) == 'OTH' ? 'other' : $map->author_nation) .'.dds" opacity="0.3"/>';
					$xml .= '<label posn="6.125 -8.4375 0.04" sizen="41 2.75" class="labels" scale="0.9" textcolor="FFF8" text="by '. $aseco->stripColors($this->getMapAuthor($map), true) .'"/>';
				}
				else {
					// This is a juked Map
//					$xml .= '<quad posn="0 0 0.02" sizen="44.375 17.25" bgcolor="BgsPlayerCard" substyle="BgRacePlayerName"/>';
//					$xml .= '<quad posn="0.675 -0.6375 0.04" sizen="43.5 4.125" style="BgsButtons" substyle="BgButtonMediumSpecial"/>';
					if ($aseco->server->maps->current->uid == $map->uid) {
						$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="0099FF55"/>';
					}
					else {
						$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
					}
					if ( ($dropall) || ($login == $player->login) ) {
						$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=removeMapFromPlaylist&uid='. $map->uid .'" image="'. $this->config['IMAGES'][0]['WIDGET_MINUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_MINUS_FOCUS'][0] .'"/>';
					}
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="00DD00FF"/>';
					$xml .= '<label posn="15 -1.21875 0.05" sizen="18.25 0" class="labels" textcolor="000F" textsize="1" text="#'. ($i+1) .'"/>';
					$xml .= '<quad posn="1.5 -0.9375 0.05" sizen="12.5 2.8125" modulatecolor="000" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['LOGOS'][0][strtoupper($map->environment)][0] .'"/>';
					$xml .= '<label posn="1.5 -5.0625 0.04" sizen="41.5 3" class="labels" text="'. $this->handleSpecialChars($map->name) .'"/>';
					$xml .= '<quad posn="1.5 -7.975 0.04" sizen="3.375 3.375" image="file://Skins/Avatars/Flags/'. (strtoupper($map->author_nation) == 'OTH' ? 'other' : $map->author_nation) .'.dds"/>';
					$xml .= '<label posn="6.125 -8.4375 0.04" sizen="41 2.75" class="labels" scale="0.9" text="by '. $aseco->stripColors($this->getMapAuthor($map), true) .'"/>';
				}

				if ($aseco->server->maps->current->uid != $map->uid && $aseco->server->maps->history->isMapInHistoryByUid($map->uid) === true) {
					// This is a recent Map

					// Authortime
					$xml .= '<quad posn="1.2 -12.7 0.04" sizen="3 3" style="BgRaceScore2" substyle="ScoreReplay" opacity="0.3"/>';
					$xml .= '<label posn="4.525 -13.40625 0.04" sizen="14.5 2.8125" class="labels" scale="0.75" text="'. $aseco->formatTime($map->author_time) .'" opacity="0.3"/>';

					// Player Rank
					$pos = isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank']) ? $player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'] : 0;
					$xml .= '<quad posn="16 -12.75 0.04" sizen="3 3" style="BgRaceScore2" substyle="LadderRank" opacity="0.3"/>';
					$xml .= '<label posn="19.25 -13.40625 0.04" sizen="9.5 2.8125" class="labels" scale="0.75" text="'. (($pos >= 1 && $pos <= $aseco->plugins['PluginLocalRecords']->records->getMaxRecords()) ? sprintf("%0". strlen($aseco->plugins['PluginLocalRecords']->records->getMaxRecords()) ."d.", $pos) : '$ZNone') .'" opacity="0.3"/>';

					// Local Map Karma
					$xml .= '<quad posn="28.725 -12.75 0.04" sizen="3 3" style="Icons64x64_1" substyle="StateFavourite" modulatecolor="F30" opacity="0.3"/>';
					$xml .= '<label posn="32 -13.40625 0.04" sizen="5.5 2.8125" class="labels" scale="0.75" text="L'. $map->karma .'" opacity="0.3"/>';
				}
				else {
					// Authortime
					$xml .= '<quad posn="1.2 -12.7 0.04" sizen="3 3" style="BgRaceScore2" substyle="ScoreReplay"/>';
					$xml .= '<label posn="4.525 -13.40625 0.04" sizen="14.5 2.8125" class="labels" scale="0.75" text="'. $aseco->formatTime($map->author_time) .'"/>';

					// Player Rank
					$pos = isset($player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank']) ? $player->data['PluginRecordsEyepiece']['Maplist']['Records'][$map->uid]['rank'] : 0;
					$xml .= '<quad posn="16 -12.75 0.04" sizen="3 3" style="BgRaceScore2" substyle="LadderRank"/>';
					$xml .= '<label posn="19.25 -13.40625 0.04" sizen="9.5 2.8125" class="labels" scale="0.75" text="'. (($pos >= 1 && $pos <= $aseco->plugins['PluginLocalRecords']->records->getMaxRecords()) ? sprintf("%0". strlen($aseco->plugins['PluginLocalRecords']->records->getMaxRecords()) ."d.", $pos) : '$ZNone') .'"/>';

					// Local Map Karma
					$xml .= '<quad posn="28.725 -12.75 0.04" sizen="3 3" style="Icons64x64_1" substyle="StateFavourite" modulatecolor="F30"/>';
					$xml .= '<label posn="32 -13.40625 0.04" sizen="5.5 2.8125" class="labels" scale="0.75" text="L'. $map->karma .'"/>';
				}

				$xml .= '</frame>';

				$line ++;

				// Reset lines
				if ($line >= 5) {
					$offset += 47.625;
					$line = 0;
				}

				$map_count ++;
			}
		}
		$xml .= '</frame>';
		$xml .= $this->templates['WINDOW']['FOOTER'];

		// Add the SubWindow (if there is one)
		$xml .= $subwin;

		return array(
			'xml'		=> $xml,
			'maxpage'	=> ($maxpages - 1),
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMaplistFilterWindow () {
		global $aseco;

		$buttons  = '<frame posn="127.0625 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="136.0625 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
//		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistFilterWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="142.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistSortingWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
		$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="UIConstructionSimple_Buttons" substyle="Validate"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '</frame>';

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'NewTrack',
				'Filter options for Maplist',
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		$xml .= '<frame posn="8 -10.6875 1">'; // Content Window

		// No Author Time
		$xml .= '<frame posn="0 0 0">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsNoAuthorTime" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="MedalsBig" substyle="MedalNadeo"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="No Author Time"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps where you did not beat the author time on."/>';
		$xml .= '</frame>';

		// Only Recent Maps
		$xml .= '<frame posn="0 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyRecentMaps" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="LoadTrack"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Only Recent Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps that have been played recently."/>';
		$xml .= '</frame>';

		// No Recent Maps
		$xml .= '<frame posn="0 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterNoRecentMaps" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="LoadTrack"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="No Recent Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps that have been played not recently."/>';
		$xml .= '</frame>';

		// No Gold Time
		$xml .= '<frame posn="47.625 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsNoGoldTime" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="MedalsBig" substyle="MedalGold"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="No Gold Time"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps where you did not beat the gold time on."/>';
		$xml .= '</frame>';

		// Only Ranked Maps
		$xml .= '<frame posn="47.625 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsWithRank" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="BgRaceScore2" substyle="LadderRank"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Only Ranked Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps where you already have a rank received."/>';
		$xml .= '</frame>';

		// Not Ranked Maps
		$xml .= '<frame posn="47.625 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsWithoutRank" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="BgRaceScore2" substyle="LadderRank"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Not Ranked Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps where you not already have a rank received."/>';
		$xml .= '</frame>';

		// No Silver Time
		$xml .= '<frame posn="95.25 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsNoSilverTime" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="MedalsBig" substyle="MedalSilver"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="No Silver Time"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps where you did not beat the silver time on."/>';
		$xml .= '</frame>';

		// Only Multilap Maps
		$xml .= '<frame posn="95.25 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMultilapMaps" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Only Multilap Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps that are multilaps Maps."/>';
		$xml .= '</frame>';

		// No Multilap Maps
		$xml .= '<frame posn="95.25 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterNoMultilapMaps" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="No Multilap Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps that are not multilaps Maps."/>';
		$xml .= '</frame>';

		// All Maps
		$xml .= '<frame posn="95.25 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindow" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Browse"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="All Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display all Maps, that are currently available on this Server."/>';
		$xml .= '</frame>';

		// No Bronze Time
		$xml .= '<frame posn="142.875 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsNoBronzeTime" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="MedalsBig" substyle="MedalBronze"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="No Bronze Time"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps where you did not beat the bronze time on."/>';
		$xml .= '</frame>';

		// Not Finished
		$xml .= '<frame posn="142.875 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyMapsNotFinished" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Finish"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons64x64_1" substyle="Close"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Not Finished"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps that you did not have finished yet."/>';
		$xml .= '</frame>';

		// Select Authorname
		$xml .= '<frame posn="142.875 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMapAuthorlistWindow" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="ChallengeAuthor"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Select Authorname"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Select an Authorname and display only Maps from this author."/>';
		$xml .= '</frame>';

		// Current Jukebox
		$xml .= '<frame posn="142.875 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterJukeboxedMaps" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Load"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Current Jukebox"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display only Maps, that are in the jukebox to get played."/>';
		$xml .= '</frame>';


		// Mood
		$xml .= '<frame posn="0 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="92 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="91 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="Icons128x128_1" substyle="Manialink"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Map mood"/>';

		// Sunrise
		if ($this->cache['MaplistCounts']['Mood']['SUNRISE'] > 0) {
			$xml .= '<quad posn="1.5 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterMapsWithMoodSunrise" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['SUNRISE'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['SUNRISE'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="1.5 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['SUNRISE'][0] .'"/>';
		}

		// Day
		if ($this->cache['MaplistCounts']['Mood']['DAY'] > 0) {
			$xml .= '<quad posn="24.5 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterMapsWithMoodDay" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['DAY'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['DAY'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="24.5 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['DAY'][0] .'"/>';
		}

		// Sunset
		if ($this->cache['MaplistCounts']['Mood']['SUNSET'] > 0) {
			$xml .= '<quad posn="47.5 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterMapsWithMoodSunset" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['SUNSET'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['SUNSET'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="47.5 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['SUNSET'][0] .'"/>';
		}

		// Night
		if ($this->cache['MaplistCounts']['Mood']['NIGHT'] > 0) {
			$xml .= '<quad posn="70.5 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterMapsWithMoodNight" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['NIGHT'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['MOOD'][0]['FOCUS'][0]['NIGHT'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="70.5 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['MOOD'][0]['ENABLED'][0]['NIGHT'][0] .'"/>';
		}
		$xml .= '</frame>';


		// Map environment
		$xml .= '<frame posn="0 -70.875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="187.25 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="186.25 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Advanced"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Map environment"/>';

		// 'Canyon'
		if ($this->cache['MaplistCounts']['Environment']['CANYON'] > 0) {
			$xml .= '<quad posn="1.5 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyCanyonMaps" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_CANYON'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['FOCUS'][0]['ICON_CANYON'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="1.5 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_CANYON'][0] .'"/>';
		}

		// 'Stadium'
		if ($this->cache['MaplistCounts']['Environment']['STADIUM'] > 0) {
			$xml .= '<quad posn="22.03125 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyStadiumMaps" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_STADIUM'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['FOCUS'][0]['ICON_STADIUM'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="22.03125 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_STADIUM'][0] .'"/>';
		}

		// 'Valley'
		if ($this->cache['MaplistCounts']['Environment']['VALLEY'] > 0) {
			$xml .= '<quad posn="42.5625 -5.625 0.06" sizen="20 10" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterOnlyValleyMaps" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_VALLEY'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['FOCUS'][0]['ICON_VALLEY'][0] .'"/>';
		}
		else {
			$xml .= '<quad posn="42.5625 -5.625 0.06" sizen="20 10" opacity="0.5" colorize="FFF" image="'. $this->config['IMAGES'][0]['ENVIRONMENT'][0]['ENABLED'][0]['ICON_VALLEY'][0] .'"/>';
		}

		$xml .= '<quad posn="63.09375 -5.625 0.06" sizen="20 10" bgcolor="0003"/>';
		$xml .= '<quad posn="83.625 -5.625 0.06" sizen="20 10" bgcolor="0003"/>';
		$xml .= '<quad posn="104.15625 -5.625 0.06" sizen="20 10" bgcolor="0003"/>';
		$xml .= '<quad posn="124.6875 -5.625 0.06" sizen="20 10" bgcolor="0003"/>';
		$xml .= '<quad posn="145.21875 -5.625 0.06" sizen="20 10" bgcolor="0003"/>';
		$xml .= '<quad posn="165.75 -5.625 0.06" sizen="20 10" bgcolor="0003"/>';

		$xml .= '</frame>';

		$xml .= '</frame>'; // Content Window

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMaplistSortingWindow () {
		global $aseco;

		$buttons  = '<frame posn="127.0625 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="136.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistFilterWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="142.0625 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
//		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistSortingWindow" style="Icons64x64_1" substyle="Maximize"/>';
//		$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
//		$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="UIConstructionSimple_Buttons" substyle="Validate"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '</frame>';

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'NewTrack',
				'Sort options for Maplist',
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		$xml .= '<frame posn="8 -10.6875 1">'; // Content Window

		// All Maps
		$xml .= '<frame posn="0 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindow" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Browse"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="All Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Display all Maps, that are currently available on this Server."/>';
		$xml .= '</frame>';

		// Best Ranked Maps
		$xml .= '<frame posn="0 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingBestPlayerRank" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="BgRaceScore2" substyle="LadderRank"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Best Ranked Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by Rank,'. LF .' from best to worst."/>';
		$xml .= '</frame>';

		// Worst Ranked Maps
		$xml .= '<frame posn="0 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingWorstPlayerRank" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="BgRaceScore2" substyle="LadderRank"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Worst Ranked Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by Rank,'. LF .' from worst to best."/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="0 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="0 -70.875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// Sort by Mapname
		$xml .= '<frame posn="47.625 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingByMapname" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="NewTrack"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Sort by Mapname"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort all currently available Maps by Mapname."/>';
		$xml .= '</frame>';

		// Shortest Maps
		$xml .= '<frame posn="47.625 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingShortestAuthorTime" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Race"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Shortest Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by Authortime,'. LF .'from shortest to longest."/>';
		$xml .= '</frame>';

		// Longest Maps
		$xml .= '<frame posn="47.625 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingLongestAuthorTime" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Race"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Longest Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by Authortime,'. LF .'from longest to shortest."/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="47.625 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="47.625 -70.875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// Sort by Authorname
		$xml .= '<frame posn="95.25 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingByAuthorname" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="ChallengeAuthor"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Sort by Authorname"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort all currently available Maps by Authorname."/>';
		$xml .= '</frame>';

		// Newest Maps First
		$xml .= '<frame posn="95.25 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingNewestMapsFirst" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="LoadTrack"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Newest Maps First"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by age,'. LF .'from newest to oldest."/>';
		$xml .= '</frame>';

		// Oldest Maps First
		$xml .= '<frame posn="95.25 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingOldestMapsFirst" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="LoadTrack"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Oldest Maps First"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by age,'. LF .'from oldest to newest."/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="95.25 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="95.25 -70.875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// Sort by Authornation
		$xml .= '<frame posn="142.875 0 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingByAuthorNation" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="UIConstructionSimple_Buttons" substyle="Validate"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Sort by Authornation"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort all currently available Maps by Authornation."/>';
		$xml .= '</frame>';

		// Karma Best Maps
		$xml .= '<frame posn="142.875 -17.71875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingByKarmaBestMapsFirst" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Challenge"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Karma Best Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by Karma,'. LF .'from best to worst."/>';
		$xml .= '</frame>';

		// Karma Worst Maps
		$xml .= '<frame posn="142.875 -35.4375 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingByKarmaWorstMapsFirst" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x128_1" substyle="Challenge"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Karma Worst Maps"/>';
		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="Sort Maps by Karma,'. LF .'from worst to best."/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="142.875 -53.15625 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		// FREE
		$xml .= '<frame posn="142.875 -70.875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF33"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FF55"/>';
//		$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
//		$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=showMaplistWindowSortingXXX" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
//		$xml .= '<quad posn="0.5 -0.5 0.06" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Laps"/>';
//		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="xxx"/>';
//		$xml .= '<label posn="2.5 -5.0625 0.04" sizen="40 3.75" scale="0.9" class="labels" autonewline="1" text="xxx"/>';
		$xml .= '</frame>';

		$xml .= '</frame>'; // Content Window

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMapAuthorlistWindow ($page, $player) {
		global $aseco;

		// Get the total of authors
		$totalauthors = count($this->cache['MapAuthors']);

		// Determind the maxpages
		$maxpages = ceil($totalauthors / 80);
		if ($page > $maxpages) {
			$page = $maxpages - 1;
		}

		$buttons = '';

		// Filter Buttons
		$buttons .= '<frame posn="136.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistFilterWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="142.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistSortingWindow" style="Icons64x64_1" substyle="Maximize"/>';
		$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
		$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="UIConstructionSimple_Buttons" substyle="Validate"/>';
		$buttons .= '</frame>';

		$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
//		$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showMaplistFilterWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';


		// Frame for Previous-/Next-Buttons
		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			// First
			$buttons .= '<frame posn="0 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageFirst" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.5 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';

			// Previous (-5)
			$buttons .= '<frame posn="6.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrevTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';

			// Previous (-1)
			$buttons .= '<frame posn="12.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			// First
			$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-5)
			$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Previous (-1)
			$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if ( ($totalauthors > 20) && (($page + 1) < $maxpages) ) {
			// Next (+1)
			$buttons .= '<frame posn="18.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Next (+5)
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNextTwo" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';

			// Last
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageLast" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="-0.25 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '<quad posn="3.275 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
			$buttons .= '</frame>';
		}
		else {
			// Next (+1)
			$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Next (+5)
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

			// Last
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}
		$buttons .= '</frame>';


		// Create Windowtitle depending on the $this->cache['MapAuthors']
		if (count($this->cache['MapAuthors']) == 0) {
			$title = 'Select Mapauthor for filtering the Maplist';
		}
		else {
			$title = 'Select Mapauthor for filtering the Maplist   |   Page '. ($page+1) .'/'. $maxpages .'   |   '. $this->formatNumber($totalauthors, 0) . (($totalauthors == 1) ? ' Author' : ' Authors');
		}

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'NewTrack',
				$title,
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);


		$line_height = 4.38749;
		$line = 0;
		$author_count = 1;
		$offset = 0;
		$xml .= '<frame posn="7.75 -9.375 0">';
		for ($i = ($page * 80); $i < (($page * 80) + 80); $i ++) {

			// Is there a Author?
			if ( !isset($this->cache['MapAuthors'][$i]) ) {
				break;
			}

			$xml .= '<quad posn="'. (0 + $offset) .' -'. ($line_height * $line + 1.6875) .' 0.10" sizen="44.375 4.125" action="PluginRecordsEyepiece?Action=showMaplistWindowFilterAuthor&Author='. $aseco->handleSpecialChars($this->cache['MapAuthors'][$i]) .'" bgcolor="FFFFFFAA" bgcolorfocus="9FCB1ACC"/>';
			$xml .= '<label posn="'. (2.5 + $offset) .' -'. ($line_height * $line + 2.8125) .' 0.11" sizen="41.875 0" class="labels" scale="0.9" textcolor="05CF" text="'. $this->cache['MapAuthors'][$i] .'"/>';

			$line ++;

			// Reset lines
			if ($line >= 20) {
				$offset += 47.625;
				$line = 0;
			}

			$author_count++;
		}
		$xml .= '</frame>';

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return array(
			'xml'		=> $xml,
			'maxpage'	=> ($maxpages - 1),
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildTopNationsWindow ($page) {
		global $aseco;

		if ( count($this->scores['TopNations']) > 0) {
			// Get the total of records
			$totalentries = count($this->scores['TopNations']);

			// Determind the maxpages
			$maxpages = ceil($totalentries / 100);
			if ($page > $maxpages) {
				$page = $maxpages - 1;
			}

			$buttons = '';

			$buttons .= '<frame posn="148.0625 -101.8125 0.04">';
//			$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
			$buttons .= '</frame>';

			// Frame for Previous-/Next-Buttons
			$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

			// Previous button
			if ($page > 0) {
				// First
				$buttons .= '<frame posn="0 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageFirst" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="1.1 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '<quad posn="1.5 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
				$buttons .= '</frame>';

				// Previous (-5)
				$buttons .= '<frame posn="6.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrevTwo" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '</frame>';

				// Previous (-1)
				$buttons .= '<frame posn="12.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '</frame>';
			}
			else {
				// First
				$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Previous (-5)
				$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Previous (-1)
				$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			}

			// Next button (display only if more pages to display)
			if (($page + 1) < $maxpages) {
				// Next (+1)
				$buttons .= '<frame posn="18.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '</frame>';

				// Next (+5)
				$buttons .= '<frame posn="24.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNextTwo" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '</frame>';

				// Last
				$buttons .= '<frame posn="30.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageLast" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="-0.25 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '<quad posn="3.275 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
				$buttons .= '</frame>';
			}
			else {
				// Next (+1)
				$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Next (+5)
				$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Last
				$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			}
			$buttons .= '</frame>';


			// Create Windowtitle
			if (count($this->scores['TopNations']) == 0) {
				$title = $this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['TITLE'][0];
			}
			else {
				$title = $this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['TITLE'][0] .'   |   Page '. ($page+1) .'/'. $maxpages .'   |   '. $this->formatNumber($totalentries, 0) . (($totalentries == 1) ? ' Entry' : ' Entries');
			}

			$xml = str_replace(
				array(
					'%icon_style%',
					'%icon_substyle%',
					'%window_title%',
					'%prev_next_buttons%'
				),
				array(
					$this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ICON_STYLE'][0],
					$this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ICON_SUBSTYLE'][0],
					$title,
					$buttons
				),
				$this->templates['WINDOW']['HEADER']
			);

			$xml .= '<frame posn="8 -12.1875 1">';
			$xml .= '<quad posn="0 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
			$xml .= '<quad posn="47.625 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
			$xml .= '<quad posn="95.25 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
			$xml .= '<quad posn="142.875 1.5 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';

			$entry = 1;
			$line = 0;
			$offset = 0;
			foreach ($this->scores['TopNations'] as $item) {
				$xml .= '<label posn="'. (7.875 + $offset) .' -'. (3.43125 * $line) .' 0.03" sizen="6.625 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['count'] .'"/>';
				$xml .= '<quad posn="'. (9.75 + $offset) .' '. (($line == 0) ? 0.5625 : -(3.43125 * $line - 0.5625)) .' 0.03" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/'. (($item['nation'] == 'OTH') ? 'other' : $item['nation']) .'.dds"/>';
				$xml .= '<label posn="'. (15.25 + $offset) .' -'. (3.43125 * $line) .' 0.03" sizen="29.25 3.1875" scale="0.9" class="labels" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $aseco->country->iocToCountry($item['nation']) .'"/>';

				$line ++;
				$entry ++;

				// Reset lines
				if ($line >= 25) {
					$offset += 47.625;
					$line = 0;
				}

				// Display max. 100 entries, count start from 1
				if ($entry >= 101) {
					break;
				}
			}
			$xml .= '</frame>';

			$xml .= $this->templates['WINDOW']['FOOTER'];
			return array(
				'xml'		=> $xml,
				'maxpage'	=> ($maxpages - 1),
			);

		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildTopContinentsWindow () {
		global $aseco;

		$buttons = '<frame posn="160.1875 -101.8125 0.04">';
		$buttons .= '<quad posn="18.0625 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		$buttons .= '</frame>';

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				$this->config['SCORETABLE_LISTS'][0]['TOP_CONTINENTS'][0]['ICON_STYLE'][0],
				$this->config['SCORETABLE_LISTS'][0]['TOP_CONTINENTS'][0]['ICON_SUBSTYLE'][0],
				$this->config['SCORETABLE_LISTS'][0]['TOP_CONTINENTS'][0]['TITLE'][0],
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		// Get the Continent counts
		$ccounts = array(
			'Europe'	=> 0,
			'Africa'	=> 0,
			'Asia'		=> 0,
			'Middle East'	=> 0,
			'North America'	=> 0,
			'South America'	=> 0,
			'Oceania'	=> 0,
		);
		foreach ($this->scores['TopContinents'] as $item) {
			$ccounts[$item['continent']] = $item['count'];
		}

		// Worldmap
		$xml .= '<frame posn="2.5 -9.375 0.01">';
		$xml .= '<quad posn="30 -9.375 0.02" sizen="132 73.5" image="'. $this->config['IMAGES'][0]['WORLDMAP'][0] .'"/>';
		$xml .= '</frame>';

		// Europe
		$xml .= '<frame posn="75 -11.25 0.01">';
		$xml .= '<quad posn="40.5 0 0.03" sizen="0.25 28.875" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['EUROPE'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 3.75" class="labels" text="$OEUROPE"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 3.75" class="labels" scale="0.8" text="'. $ccounts['Europe'] .' '. (($ccounts['Europe'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		// Asia
		$xml .= '<frame posn="132.5 -23.125 0.01">';
		$xml .= '<quad posn="-0.7 0 0.03" sizen="0.25 28.125" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['ASIA'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 3.75" class="labels" text="$OASIA"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 3.75" class="labels" scale="0.8" text="'. $ccounts['Asia'] .' '. (($ccounts['Asia'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		// Oceania
		$xml .= '<frame posn="150.75 -47.5 0.01">';
		$xml .= '<quad posn="-0.8 0 0.03" sizen="0.3 22.5" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['OCEANIA'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 3.75" class="labels" text="$OOCEANIA"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 3.75" class="labels" scale="0.8" text="'. $ccounts['Oceania'] .' '. (($ccounts['Oceania'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		// North America
		$xml .= '<frame posn="20 -15 0.01">';
		$xml .= '<quad posn="40.5 0 0.03" sizen="0.25 28.125" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['NORTH_AMERICA'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 2.8" class="labels" text="$ONORTH AMERICA"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 2.5" class="labels" scale="0.8" text="'. $ccounts['North America'] .' '. (($ccounts['North America'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		// South America
		$xml .= '<frame posn="21.5 -67.5 0.01">';
		$xml .= '<quad posn="0 0.7 0.03" sizen="52.5 0.3" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['SOUTH_AMERICA'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 3.75" class="labels" text="$OSOUTH AMERICA"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 3.75" class="labels" scale="0.8" text="'. $ccounts['South America'] .' '. (($ccounts['South America'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		// Africa
		$xml .= '<frame posn="62.5 -89.0625 0.01">';
		$xml .= '<quad posn="40.5 26.25 0.03" sizen="0.25 35.625" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['AFRICA'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 3.75" class="labels" text="$OAFRICA"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 3.75" class="labels" scale="0.8" text="'. $ccounts['Africa'] .' '. (($ccounts['Africa'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		// Middle East
		$xml .= '<frame posn="120 -87.1875 0.01">';
		$xml .= '<quad posn="-0.7 33.75 0.03" sizen="0.25 43.125" bgcolor="999F"/>';
		$xml .= '<quad posn="0 0 0.03" sizen="40 9.375" bgcolor="0009"/>';
		$xml .= '<quad posn="1.25 -0.9375 0.04" sizen="7.6 7.6" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0]['MIDDLE_EAST'][0] .'"/>';
		$xml .= '<label posn="10 -1.875 0.04" sizen="28 3.75" class="labels" text="$OMIDDLE EAST"/>';
		$xml .= '<label posn="10 -5.25 0.04" sizen="35 3.75" class="labels" scale="0.8" text="'. $ccounts['Middle East'] .' '. (($ccounts['Middle East'] == 1) ? 'Player' : 'Players') .'"/>';
		$xml .= '</frame>';

		$xml .= $this->templates['WINDOW']['FOOTER'];
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildManiaExchangeMapInfoWindow () {
		global $aseco;

		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'Icons128x128_1',
				'LoadTrack',
				'Mania-Exchange Map Info',
				''
			),
			$this->templates['WINDOW']['HEADER']
		);

		$xml .= '<frame posn="1.75 0 0">';	// BEGIN: Main frame
		$xml .= '<quad posn="6.25 -10.6875 0.02" sizen="139.625 87.9" bgcolor="FFFFFF55"/>';

		$xml .= '<quad posn="9.25 -13.625 0.03" sizen="62.5 45.5" bgcolor="FFF9"/>';
		$xml .= '<label posn="40.5 -33.9375 0.04" sizen="62 3.75" class="labels" halign="center" text="Press DEL if can not see an Image here!"/>';
		$xml .= '<quad posn="9.5 -13.875 0.50" sizen="62 45" image="'. $aseco->handleSpecialChars($this->getMapImageUrl($aseco->server->maps->current->uid) .'?.jpg') .'"/>';
		$xml .= '<label posn="9.25 -61.125 0.04" sizen="80 5.625" class="labels" textsize="3" text="'. $this->handleSpecialChars($aseco->server->maps->current->name) .'"/>';
		$xml .= '<quad posn="9.25 -65.8125 0.04" sizen="4.125 4.125" image="file://Skins/Avatars/Flags/'. (strtoupper($aseco->server->maps->current->author_nation) == 'OTH' ? 'other' : $aseco->server->maps->current->author_nation) .'.dds"/>';
		$xml .= '<label posn="15.5 -66.3749 0.04" sizen="80 3.75" class="labels" textsize="2" scale="0.9" text="by '. $aseco->server->maps->current->author .'"/>';

		$date_time = $aseco->server->maps->current->mx->uploaded;
		if ($aseco->server->maps->current->mx->uploaded != $aseco->server->maps->current->mx->updated) {
			$date_time = $aseco->server->maps->current->mx->updated;
		}
		$xml .= '<label posn="9.25 -70.5 0.04" sizen="45 2.8125" class="labels" scale="0.8" text="from '. preg_replace('/^(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2})\.\d+$/', "\\1 \\2", $date_time) .'"/>';
		$xml .= '<label posn="54.25 -70.5 0.04" sizen="45 2.8125" class="labels" scale="0.8" text="MX-ID: '. $aseco->server->maps->current->mx->id .'"/>';

		// Author comment
		if ($aseco->server->maps->current->mx->acomment != '') {
			$acomment = $aseco->server->maps->current->mx->original_acomment;

			// Replace <br> with LF
			$acomment = str_ireplace(array('<br>', '<br />'), LF, $acomment);

			// Replace BB Code links
			$acomment = preg_replace('#\[url=#i', '$L[', $acomment);
			$acomment = preg_replace('#\[/url\]#i', '$L', $acomment);

			// Remove BB Code
			$acomment = preg_replace('#\[[a-z=]+\]#Ui', '', $acomment);
			$acomment = preg_replace('#\[/[a-z]+\]#Ui', '', $acomment);

			// Remove (simple) HTML Code
			$acomment = preg_replace('#<.*>#Ui', '', $acomment);
			$acomment = preg_replace('#</.*>#Ui', '', $acomment);

			$xml .= '<label posn="9.25 -75 0.04" sizen="148.5 24" class="labels" scale="0.9" autonewline="1" maxline="8" text="'. $aseco->handleSpecialChars($acomment) .'"/>';
		}

		// Times
		$xml .= '<frame posn="83 -28.375 0">';
		$xml .= '<quad posn="0 13.5 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalNadeo"/>';
		$xml .= '<quad posn="0 9 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalGold"/>';
		$xml .= '<quad posn="0 4.6875 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalSilver"/>';
		$xml .= '<quad posn="0 0.375 0.1" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalBronze"/>';
		$xml .= '<quad posn="0.5 -3.375 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Advanced"/>';
		$xml .= '<quad posn="0.5 -7.68749 0.1" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Manialink"/>';

		$xml .= '<label posn="1.25 12.9375 0.1" sizen="20 3.75" class="labels" scale="0.9" text="'. $aseco->formatTime($aseco->server->maps->current->author_time) .'"/>';
		$xml .= '<label posn="1.25 8.625 0.1" sizen="20 3.75" class="labels" scale="0.9" text="'. $aseco->formatTime($aseco->server->maps->current->goldtime) .'"/>';
		$xml .= '<label posn="1.25 4.3125 0.1" sizen="20 3.75" class="labels" scale="0.9" text="'. $aseco->formatTime($aseco->server->maps->current->silvertime) .'"/>';
		$xml .= '<label posn="1.25 0 0.1" sizen="20 3.75" class="labels" scale="0.9" text="'. $aseco->formatTime($aseco->server->maps->current->bronzetime) .'"/>';
		$xml .= '<label posn="1.25 -4.3125 0.1" sizen="20 3.75" class="labels" scale="0.9" text="'. $aseco->server->maps->current->environment .'"/>';
		$xml .= '<label posn="1.25 -8.625 0.1" sizen="20 3.75" class="labels" scale="0.9" text="'. $aseco->server->maps->current->mood .'"/>';
		$xml .= '</frame>';

		// MX Mapinfos
		$xml .= '<frame posn="103.75 -28.375 0">';
		$xml .= '<label posn="0 12.9375 0.1" sizen="12.5 4.125" class="labels" scale="0.9" text="Type:"/>';
		$xml .= '<label posn="0 8.625 0.1" sizen="12.5 3.75" class="labels" scale="0.9" text="Style:"/>';
		$xml .= '<label posn="0 4.3125 0.1" sizen="12.5 3.75" class="labels" scale="0.9" text="Difficult:"/>';
		$xml .= '<label posn="0 0 0.1" sizen="12.5 3.75" class="labels" scale="0.9" text="Routes:"/>';
		$xml .= '<label posn="0 -4.3125 0.1" sizen="12.5 4.875" class="labels" scale="0.9" text="Awards:"/>';
		$xml .= '<label posn="0 -8.625 0.1" sizen="12.5 4.875" class="labels" scale="0.9" text="Section:"/>';

		$xml .= '<label posn="12.75 12.9375 0.1" sizen="36.25 3.75" class="labels" scale="0.9" text=" '. $aseco->server->maps->current->mx->type .'"/>';
		$xml .= '<label posn="12.75 8.625 0.1" sizen="36.25 3.75" class="labels" scale="0.9" text=" '. $aseco->server->maps->current->mx->style .'"/>';
		$xml .= '<label posn="12.75 4.3125 0.1" sizen="36.25 3.75" class="labels" scale="0.9" text=" '. $aseco->server->maps->current->mx->diffic .'"/>';
		$xml .= '<label posn="12.75 0 0.1" sizen="36.25 3.75" class="labels" scale="0.9" text=" '. $aseco->server->maps->current->mx->routes .'"/>';
		$xml .= '<label posn="12.75 -4.3125 0.1" sizen="36.25 3.75" class="labels" scale="0.9" text=" '. $aseco->server->maps->current->mx->awards .'"/>';
		$xml .= '<label posn="12.75 -8.625 0.1" sizen="36.25 3.75" class="labels" scale="0.9" text=" '. $aseco->server->maps->current->mx->section .'"/>';
		$xml .= '</frame>';


		// Button "Visit Page"
		if ($aseco->server->maps->current->mx->pageurl != false) {
			$xml .= '<label posn="107 -45.0625 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->current->mx->pageurl) .'" text="VISIT MAP PAGE" style="CardButtonSmall"/>';
		}

		// Button "Download Map"
		if ($aseco->server->maps->current->mx->dloadurl != false) {
			$xml .= '<label posn="107 -50.1875 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->current->mx->dloadurl) .'" text="DOWNLOAD MAP" style="CardButtonSmall"/>';
		}

		// Button "Download Replay"
		if ($aseco->server->maps->current->mx->replayurl != false) {
			$xml .= '<label posn="107 -55.3125 0.02" sizen="30 3.75" class="labels" halign="center" scale="0.8" url="'. $aseco->handleSpecialChars($aseco->server->maps->current->mx->replayurl) .'" text="DOWNLOAD REPLAY" style="CardButtonSmall"/>';
		}


		// Mania-Exchange Records
		$xml .= '<frame posn="149.125 -10.6875 1">';
		$xml .= '<quad posn="0 0 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="Icons128x32_1" substyle="RT_Cup"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="Mania-Exchange Records"/>';
		$xml .= '<frame posn="0 -5.0625 0.04">';	// Entries
		if ( (isset($aseco->server->maps->current->mx->recordlist)) && (count($aseco->server->maps->current->mx->recordlist) > 0) ) {
			$entry = 1;
			$line = 0;
			foreach ($aseco->server->maps->current->mx->recordlist as $item) {
				$xml .= '<label posn="5.25 -'. (3.28125 * $line) .' 0.01" sizen="6.625 3.1875" class="labels" halign="right" scale="0.9" text="'. $entry .'."/>';
				$xml .= '<label posn="15.25 -'. (3.28125 * $line) .' 0.01" sizen="10 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $aseco->formatTime($item['replaytime']) .'"/>';
				$xml .= '<label posn="16.5 -'. (3.28125 * $line) .' 0.01" sizen="24 3.1875" class="labels" scale="0.9" text="'. $this->handleSpecialChars($item['username']) .'"/>';

				$entry ++;
				$line ++;

				// Display max. 25 entries (thats the max. from MX), count start from 1
				if ($entry >= 26) {
					break;
				}
			}
		}
		$xml .= '</frame>';	// Entries
		$xml .= '</frame>';

		$xml .= '</frame>';	// END: Main frame

		$xml .= $this->templates['WINDOW']['FOOTER'];

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMusiclistWindow ($page, $caller) {
		global $aseco;

		// Get the total of songs
		$totalsongs = ((count($this->cache['MusicServerPlaylist']) < 1900) ? count($this->cache['MusicServerPlaylist']) : 1900);

		if ($totalsongs > 0) {

			// Determind the maxpages
			$maxpages = ceil($totalsongs / 20);
			if ($page > $maxpages) {
				$page = $maxpages - 1;
			}

			// Button "Drop current juke'd Song"
			$buttons = '<frame posn="127.0625 -101.8125 0.04">';
//			$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=askDropMapFromPlaylist" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons128x32_1" substyle="Settings"/>';
			$buttons .= '<label posn="1.8 -1.3 0.15" sizen="20 0" textsize="2" style="TextCardRaceRank" text="$S$W$O$F00/"/>';
			$buttons .= '</frame>';

//			$buttons = '<frame posn="88.875 -99.9375 0.04">';
//			$buttons .= '<quad posn="0 -1 0.12" sizen="3 3" action="PluginRecordsEyepiece?Action=dropCurrentSongFromJukebox" style="Icons64x64_1" substyle="Maximize"/>';
//			$buttons .= '<quad posn="0.4 -1.4 0.13" sizen="2.1 2.1" bgcolor="000F"/>';
//			$buttons .= '<quad posn="0.3 -1.3 0.14" sizen="2.4 2.4" style="Icons128x32_1" substyle="Settings"/>';
//			$buttons .= '<label posn="0.81 -1.25 0.15" sizen="6 6" textsize="1" style="TextCardRaceRank" text="$S$W$O$F00/"/>';
//			$buttons .= '</frame>';

			// Frame for Previous-/Next-Buttons
			$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

			// Previous button
			if ($page > 0) {
				// First
				$buttons .= '<frame posn="0 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageFirst" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="1.1 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '<quad posn="1.5 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
				$buttons .= '</frame>';

				// Previous (-5)
				$buttons .= '<frame posn="6.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrevTwo" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '</frame>';

				// Previous (-1)
				$buttons .= '<frame posn="12.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
				$buttons .= '</frame>';
			}
			else {
				// First
				$buttons .= '<quad posn="0.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Previous (-5)
				$buttons .= '<quad posn="6.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Previous (-1)
				$buttons .= '<quad posn="12.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			}

			// Next button (display only if more pages to display)
			if ( ($page < 95) && ($totalsongs > 20) && (($page + 1) < $maxpages) ) {
				// Next (+1)
				$buttons .= '<frame posn="18.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '</frame>';

				// Next (+5)
				$buttons .= '<frame posn="24.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNextTwo" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="-0.35 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '<quad posn="1.1 -0.28125 0.15" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '</frame>';

				// Last
				$buttons .= '<frame posn="30.0625 0 0.05">';
				$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageLast" style="Icons64x64_1" substyle="Maximize"/>';
				$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
				$buttons .= '<quad posn="-0.25 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
				$buttons .= '<quad posn="3.275 -1.05625 0.15" sizen="1 3.1875" bgcolor="CCCF"/>';
				$buttons .= '</frame>';
			}
			else {
				// Next (+1)
				$buttons .= '<quad posn="18.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Next (+5)
				$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';

				// Last
				$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
			}
			$buttons .= '</frame>';


			$xml = str_replace(
				array(
					'%icon_style%',
					'%icon_substyle%',
					'%window_title%',
					'%prev_next_buttons%'
				),
				array(
					$this->config['MUSIC_WIDGET'][0]['ICON_STYLE'][0],
					$this->config['MUSIC_WIDGET'][0]['ICON_SUBSTYLE'][0],
					'Choose the next Song   |   Page '. ($page+1) .'/'. $maxpages .'   |   '. $this->formatNumber($totalsongs, 0) . (($totalsongs == 1) ? ' Song' : ' Songs'),
					$buttons
				),
				$this->templates['WINDOW']['HEADER']
			);

			$line = 0;
			$offset = 0;
			$xml .= '<frame posn="8 -10.6875 1">';
			for ($i = ($page * 20); $i < (($page * 20) + 20); $i ++) {

				// Is there a song?
				if ( !isset($this->cache['MusicServerPlaylist'][$i]) ) {
					break;
				}

				// Get filename of Song
				$song = &$this->cache['MusicServerPlaylist'][$i];

				// Find the Player who has juked this Song (if it is juked)
				$login = false;
				$juked = false;
				if ( isset($aseco->plugins['PluginMusicServer']) ) {
					foreach ($aseco->plugins['PluginMusicServer']->jukebox as $pl => $songid) {
						if ($song['SongId'] == $songid) {
							$login = $pl;
							$juked = true;
							break;
						}
					}
					unset($songid);
				}

				$xml .= '<frame posn="'. $offset .' -'. (17.71875 * $line) .' 1">';
				if ($juked == false) {
					if ( ($this->config['CurrentMusicInfos']['Artist'] == $song['Artist']) && ($this->config['CurrentMusicInfos']['Title'] == $song['Title']) ) {
						// Current Song
						$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="0099FF55"/>';
						$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
						$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=addSongToJukebox&id='. $song['SongId'] .'" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_PLUS_FOCUS'][0] .'"/>';
					}
					else {
						// Default
						$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
						$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
						$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=addSongToJukebox&id='. $song['SongId'] .'" image="'. $this->config['IMAGES'][0]['WIDGET_PLUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_PLUS_FOCUS'][0] .'"/>';
					}
					$xml .= '<label posn="5.5 -1.22 0.04" sizen="43.25 0" class="labels" text="Song #'. ($i+1) .'"/>';
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="3.75 3.75" style="'. $this->config['MUSIC_WIDGET'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MUSIC_WIDGET'][0]['ICON_SUBSTYLE'][0] .'"/>';
					$xml .= '<label posn="2.5 -5.0625 0.04" sizen="39.625 3.75" class="labels" text="'. $song['Title'] .'"/>';
					$xml .= '<label posn="2.5 -8.4375 0.04" sizen="42.875 3.75" class="labels" scale="0.9" text="by '. $song['Artist'] .'"/>';
				}
				else {
					// Juked Song
					$xml .= '<quad posn="0 0 0.02" sizen="44.375 16.5" bgcolor="FFFFFF55"/>';
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="00DD00FF"/>';
					if ($login == $caller) {
						$xml .= '<quad posn="36.425 -8.6 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action=dropCurrentSongFromJukebox" image="'. $this->config['IMAGES'][0]['WIDGET_MINUS_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_MINUS_FOCUS'][0] .'"/>';
					}
					$xml .= '<label posn="5.5 -1.22 0.04" sizen="43.25 0" class="labels" textcolor="000F" text="Song #'. ($i+1) .'"/>';
					$xml .= '<quad posn="0.5 -0.5 0.04" sizen="3.75 3.75" style="'. $this->config['MUSIC_WIDGET'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MUSIC_WIDGET'][0]['ICON_SUBSTYLE'][0] .'"/>';
					$xml .= '<label posn="2.5 -5.0625 0.04" sizen="39.625 3.75" class="labels" text="'. $aseco->stripColors($song['Title'], true) .'"/>';
					$xml .= '<label posn="2.5 -8.4375 0.04" sizen="42.875 3.75" class="labels" scale="0.9" text="by '. $aseco->stripColors($song['Artist'], true) .'"/>';
				}

//				// Mark current Song
//				if ( ($this->config['CurrentMusicInfos']['Artist'] == $song['Artist']) && ($this->config['CurrentMusicInfos']['Title'] == $song['Title']) ) {
//					$xml .= '<quad posn="40 0 0.06" sizen="6.25 4.6875" style="BgRaceScore2" substyle="Fame"/>';
//				}
//				$xml .= '<quad posn="2.25 -12.9375 0.05" sizen="13 3.1875" url="http://www.amazon.com/gp/search?ie=UTF8&amp;keywords='. urlencode($aseco->stripColors(str_replace('&amp;', '&', $song['Artist']), true)) .'&amp;tag=undefde-20&amp;index=digital-music&amp;linkCode=ur2&amp;camp=1789&amp;creative=9325" image="maniacdn.net/undef.de/uaseco/records-eyepiece/logo-amazon-normal.png" imagefocus="maniacdn.net/undef.de/uaseco/records-eyepiece/logo-amazon-focus.png"/>';
				$xml .= '</frame>';

				$line ++;

				// Reset lines
				if ($line >= 5) {
					$offset += 47.625;
					$line = 0;
				}
			}
			$xml .= '</frame>';

			$xml .= $this->templates['WINDOW']['FOOTER'];
			return array(
				'xml'		=> $xml,
				'maxpage'	=> ($maxpages - 1),
			);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildMapWidget ($state = 'race') {
		global $aseco;

		if ($this->config['MAP_WIDGET'][0]['ENABLED'][0] == true) {

			$xml = false;
			if ($state == 'race') {

				// Set the right Icon and Title position
				$position = (($this->config['MAP_WIDGET'][0]['RACE'][0]['POS_X'][0] < 0) ? 'right' : 'left');

				if ($position == 'right') {
					$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5));
					$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5));
					$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5));
				}
				else {
					$imagex	= $this->config['Positions'][$position]['image_open']['x'];
					$iconx	= $this->config['Positions'][$position]['icon']['x'];
					$titlex	= $this->config['Positions'][$position]['title']['x'];
				}

				// Create the MapWidget at Race
				$xml = str_replace(
					array(
						'%image_open_pos_x%',
						'%image_open%',
						'%posx_icon%',
						'%posy_icon%',
						'%posx_title%',
						'%posy_title%',
						'%halign%',
						'%mapname%',
						'%authortime%',
						'%author%',
						'%author_nation%'
					),
					array(
						$imagex,
						$this->config['Positions'][$position]['image_open']['image'],
						$iconx,
						$this->config['Positions'][$position]['icon']['y'],
						$titlex,
						$this->config['Positions'][$position]['title']['y'],
						$this->config['Positions'][$position]['title']['halign'],
						$this->handleSpecialChars($aseco->server->maps->current->name),
						$aseco->formatTime($aseco->server->maps->current->author_time),
						$this->getMapAuthor($aseco->server->maps->current),
						(strtoupper($aseco->server->maps->current->author_nation) == 'OTH' ? 'other' : $aseco->server->maps->current->author_nation)
					),
					$this->templates['MAP_WIDGET']['RACE']['HEADER']
				);
				$xml .= $this->templates['MAP_WIDGET']['RACE']['FOOTER'];

			}
			else if ($state == 'score') {

				// Set the right Icon and Title position
				$position = (($this->config['MAP_WIDGET'][0]['RACE'][0]['POS_X'][0] < 0) ? 'right' : 'left');

				if ($position == 'right') {
					$imagex	= ($this->config['Positions'][$position]['image_open']['x'] + ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5));
					$iconx	= ($this->config['Positions'][$position]['icon']['x'] + ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5));
					$titlex	= ($this->config['Positions'][$position]['title']['x'] + ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5));
				}
				else {
					$imagex	= $this->config['Positions'][$position]['image_open']['x'];
					$iconx	= $this->config['Positions'][$position]['icon']['x'];
					$titlex	= $this->config['Positions'][$position]['title']['x'];
				}

				// Setup defaults
				$type = $this->config['MAP_WIDGET'][0]['SCORE'][0]['DISPLAY'][0];
				$title = $this->config['MAP_WIDGET'][0]['TITLES'][0]['NEXT'][0];
				$icon = array(
					$this->config['MAP_WIDGET'][0]['ICONS'][0]['NEXT'][0]['ICON_STYLE'][0],
					$this->config['MAP_WIDGET'][0]['ICONS'][0]['NEXT'][0]['ICON_SUBSTYLE'][0]
				);

				// Check for changing display
				if (strtoupper($type) == 'CURRENT') {
					$title = $this->config['MAP_WIDGET'][0]['TITLES'][0]['CURRENT'][0];
					$icon = array(
						$this->config['MAP_WIDGET'][0]['ICONS'][0]['CURRENT'][0]['ICON_STYLE'][0],
						$this->config['MAP_WIDGET'][0]['ICONS'][0]['CURRENT'][0]['ICON_SUBSTYLE'][0]
					);
				}

				$map = false;
				if (strtoupper($type) == 'NEXT') {
					$map = $aseco->server->maps->next;
				}
				else {
					$map = $aseco->server->maps->current;
				}

				// Create the MapWidget at Score
				$xml = str_replace(
					array(
						'%posx_icon%',
						'%posy_icon%',
						'%posx_title%',
						'%posy_title%',
						'%halign%',
						'%icon_style%',
						'%icon_substyle%',
						'%title%',
						'%mapname%',
						'%authortime%',
						'%author%',
						'%author_nation%',
						'%env%',
						'%mood%',
						'%goldtime%',
						'%silvertime%',
						'%bronzetime%'
					),
					array(
						$iconx,
						$this->config['Positions'][$position]['icon']['y'],
						$titlex,
						$this->config['Positions'][$position]['title']['y'],
						$this->config['Positions'][$position]['title']['halign'],
						$icon[0],
						$icon[1],
						$title,
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $this->handleSpecialChars($map->name),
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime($map->author_time),
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $this->getMapAuthor($map),
						(strtoupper($map->author_nation) == 'OTH' ? 'other' : $map->author_nation),
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $map->environment,
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $map->mood,
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime($map->goldtime),
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime($map->silvertime),
						$this->config['STYLE'][0]['WIDGET_SCORE'][0]['FORMATTING_CODES'][0] . $aseco->formatTime($map->bronzetime)
					),
					$this->templates['MAP_WIDGET']['SCORE']['HEADER']
				);
				$xml .= $this->templates['MAP_WIDGET']['SCORE']['FOOTER'];
			}

			if ($xml != false) {
				return $xml;
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildToplistWindowEntry ($data, $logins, $target) {
		global $aseco;

		$xml  = '<quad posn="0 0 0.02" sizen="44.375 87.9" bgcolor="FFFFFF55"/>';
		$xml .= '<quad posn="0.5 -0.5 0.04" sizen="43.375 3.75" bgcolor="0099FFDD"/>';
		$xml .= '<quad posn="0.5 -0.5 0.05" sizen="3.75 3.75" style="'. $data['icon_style'] .'" substyle="'. $data['icon_substyle'] .'"/>';
		$xml .= '<label posn="5.5 -1.22 0.05" sizen="43.25 0" class="labels" text="'. $data['title'] .'"/>';
		$xml .= '<quad posn="36.425 -80 0.03" sizen="8.75 8.75" action="PluginRecordsEyepiece?Action='. $data['actionid'] .'" image="'. $this->config['IMAGES'][0]['WIDGET_OK_NORMAL'][0] .'" imagefocus="'. $this->config['IMAGES'][0]['WIDGET_OK_FOCUS'][0] .'"/>';
		if ( count($this->scores[$data['list']]) > 0) {
			$xml .= '<frame posn="0 -5.0625 0.04">';	// Entries
			$rank = 1;
			$line = 0;
			foreach ($this->scores[$data['list']] as $item) {
				if ($data['list'] == 'TopNations') {
					$xml .= '<label posn="7.875 -'. (3.28125 * $line) .' 0.02" sizen="6.625 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['count'] .'"/>';
					$xml .= '<quad posn="9.75 '. (($line == 0) ? 0.5625 : -(3.28125 * $line - 0.5625)) .' 0.02" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/'. (($item['nation'] == 'OTH') ? 'other' : $item['nation']) .'.dds"/>';
					$xml .= '<label posn="15.25 -'. (3.28125 * $line) .' 0.02" sizen="29.25 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $aseco->country->iocToCountry($item['nation']) .'"/>';
				}
				else if ($data['list'] == 'TopContinents') {
					$continent = str_replace(' ', '_', strtoupper($item['continent']));

					$xml .= '<label posn="7.875 -'. (3.28125 * $line) .' 0.03" sizen="6.25 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['count'] .'"/>';
					$xml .= '<quad posn="9.75 '. (($line == 0) ? 0.5625 : -(3.28125 * $line - 0.5625)) .' 0.03" sizen="3.75 3.75" image="'. $this->config['IMAGES'][0]['CONTINENTS'][0][$continent][0] .'"/>';
					$xml .= '<label posn="15.25 -'. (3.28125 * $line) .' 0.03" sizen="29.25 3.1875" class="labels" scale="0.9" text="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['FORMATTING_CODES'][0] . $item['continent'] .'"/>';
				}
				else {
					// Mark current connected Players
					if (isset($item['login'])) {
						if ($item['login'] == $target) {
							if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] != '') {
								$xml .= '<quad posn="0.5 '. (((3.28125 * $line - 0.375) > 0) ? -(3.28125 * $line - 0.375) : 0.375) .' 0.01" sizen="43.375 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_BACKGROUND'][0] .'"/>';
							}
							else {
								$xml .= '<quad posn="0.5 '. (((3.28125 * $line - 0.375) > 0) ? -(3.28125 * $line - 0.375) : 0.375) .' 0.01" sizen="43.375 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_SELF_SUBSTYLE'][0] .'"/>';
							}
						}
						else if (in_array($item['login'], $logins)) {
							if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] != '') {
								$xml .= '<quad posn="0.5 '. (((3.28125 * $line - 0.375) > 0) ? -(3.28125 * $line - 0.375) : 0.375) .' 0.01" sizen="43.375 3.375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_BACKGROUND'][0] .'"/>';
							}
							else {
								$xml .= '<quad posn="0.5 '. (((3.28125 * $line - 0.375) > 0) ? -(3.28125 * $line - 0.375) : 0.375) .' 0.01" sizen="43.375 3.375" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['HIGHLITE_OTHER_SUBSTYLE'][0] .'"/>';
							}
						}
					}
					$xml .= '<label posn="6.5 -'. (3.28125 * $line) .' 0.02" sizen="5 3.1875" class="labels" halign="right" scale="0.9" text="'. $rank .'."/>';
					$xml .= '<label posn="16 -'. (3.28125 * $line) .' 0.02" sizen="10 3.1875" class="labels" halign="right" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['SCORES'][0] .'" text="'. $item[$data['fieldnames'][0]] .'"/>';
					$xml .= '<label posn="17.25 -'. (3.28125 * $line) .' 0.02" sizen="28 3.1875" class="labels" scale="0.9" text="'. $item[$data['fieldnames'][1]] .'"/>';
				}

				$line ++;
				$rank ++;

				// Display max. 26 entries, count start from 1
				if ($rank >= 26) {
					break;
				}
			}
			unset($item);
			$xml .= '</frame>';			// Entries
		}

		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildToplistWindow ($page = 0, $login) {
		global $aseco;

		// Get current Gamemode
		$gamemode = $aseco->server->gameinfo->mode;

		// Add all connected PlayerLogins
		$players = array();
		foreach ($aseco->server->players->player_list as $player) {
			if ($player->login != $login) {
				$players[] = $player->login;
			}
		}


		$toplists = array();

		// DedimaniaRecords
		if ($this->config['DEDIMANIA_RECORDS'][0]['GAMEMODE'][0][$gamemode][0]['ENABLED'][0] == true) {
			$toplists[] = array(
				'actionid'	=> 'showDedimaniaRecordsWindow',
				'icon_style'	=> $this->config['DEDIMANIA_RECORDS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['DEDIMANIA_RECORDS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['DEDIMANIA_RECORDS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'DedimaniaRecords',
			);
		}

		// LocalRecords
		$toplists[] = array(
			'actionid'	=> 'showLocalRecordsWindow',
			'icon_style'	=> $this->config['LOCAL_RECORDS'][0]['ICON_STYLE'][0],
			'icon_substyle'	=> $this->config['LOCAL_RECORDS'][0]['ICON_SUBSTYLE'][0],
			'title'		=> $this->config['LOCAL_RECORDS'][0]['TITLE'][0],
			'fieldnames'	=> array('score', 'nickname'),
			'list'		=> 'LocalRecords',
		);

		// LiveRankingsWindow
		$toplists[] = array(
			'actionid'	=> 'showLiveRankingsWindow',
			'icon_style'	=> $this->config['LIVE_RANKINGS'][0]['ICON_STYLE'][0],
			'icon_substyle'	=> $this->config['LIVE_RANKINGS'][0]['ICON_SUBSTYLE'][0],
			'title'		=> $this->config['LIVE_RANKINGS'][0]['TITLE'][0],
			'fieldnames'	=> array('score', 'nickname'),
			'list'		=> 'LiveRankings',
		);

		// TopRanks
		if ( count($this->scores['TopRankings']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopRankingsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_RANKINGS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_RANKINGS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_RANKINGS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopRankings',
			);
		}

		// TopWinners
		if ( count($this->scores['TopWinners']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopWinnersWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_WINNERS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopWinners',
			);
		}

		// MostRecords
		if ( count($this->scores['MostRecords']) ) {
			$toplists[] = array(
				'actionid'	=> 'showMostRecordsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['MOST_RECORDS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['MOST_RECORDS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['MOST_RECORDS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'MostRecords',
			);
		}

		// MostFinished
		if ( count($this->scores['MostFinished']) ) {
			$toplists[] = array(
				'actionid'	=> 'showMostFinishedWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['MOST_FINISHED'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['MOST_FINISHED'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['MOST_FINISHED'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'MostFinished',
			);
		}

		// TopPlaytime
		if ( count($this->scores['TopPlaytime']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopPlaytimeWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_PLAYTIME'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_PLAYTIME'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_PLAYTIME'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopPlaytime',
			);
		}

		// TopActivePlayers
		if ( count($this->scores['TopActivePlayers']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopActivePlayersWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_ACTIVE_PLAYERS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_ACTIVE_PLAYERS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_ACTIVE_PLAYERS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopActivePlayers',
			);
		}

		// TopRoundscore
		if ( count($this->scores['TopRoundscore']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopRoundscoreWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_ROUNDSCORE'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_ROUNDSCORE'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_ROUNDSCORE'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopRoundscore',
			);
		}

		// TopVisitors
		if ( count($this->scores['TopVisitors']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopVisitorsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_VISITORS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_VISITORS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_VISITORS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopVisitors',
			);
		}

		// TopNations
		if ( count($this->scores['TopNations']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopNationsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_NATIONS'][0]['TITLE'][0],
				'fieldnames'	=> array('count', 'nation'),
				'list'		=> 'TopNations',
			);
		}

		// TopContinents
		if ( count($this->scores['TopContinents']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopContinentsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_CONTINENTS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_CONTINENTS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_CONTINENTS'][0]['TITLE'][0],
				'fieldnames'	=> array('count', 'continent'),
				'list'		=> 'TopContinents',
			);
		}

		// TopVoters
		if ( count($this->scores['TopVoters']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopVotersWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_VOTERS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_VOTERS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_VOTERS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopVoters',
			);
		}

		// TopMaps
		if ( count($this->scores['TopMaps']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopMapsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_MAPS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_MAPS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_MAPS'][0]['TITLE'][0],
				'fieldnames'	=> array('karma', 'map'),
				'list'		=> 'TopMaps',
			);
		}

		// TopDonators
		if ( count($this->scores['TopDonators']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopDonatorsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_DONATORS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_DONATORS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_DONATORS'][0]['TITLE'][0],
				'fieldnames'	=> array('score', 'nickname'),
				'list'		=> 'TopDonators',
			);
		}

		// TopWinnigPayout
		if ( count($this->scores['TopWinningPayouts']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopWinningPayoutWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_WINNING_PAYOUTS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_WINNING_PAYOUTS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_WINNING_PAYOUTS'][0]['TITLE'][0],
				'fieldnames'	=> array('won', 'nickname'),
				'list'		=> 'TopWinningPayouts',
			);
		}

		// TopBetwins
		if ( count($this->scores['TopBetwins']) ) {
			$toplists[] = array(
				'actionid'	=> 'showTopBetwinsWindow',
				'icon_style'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['ICON_STYLE'][0],
				'icon_substyle'	=> $this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['ICON_SUBSTYLE'][0],
				'title'		=> $this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['TITLE'][0],
				'fieldnames'	=> array('won', 'nickname'),
				'list'		=> 'TopBetwins',
			);
		}

		if ($page >= ceil(count($toplists) / 4)) {
			return;
		}


		$buttons = '';

		// Button up
		$buttons .= '<frame posn="178.25 -101.8125 0.04">';
		$buttons .= '<quad posn="0.1375 -0.28125 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
//		$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=showToplistWindow" style="Icons64x64_1" substyle="ToolUp"/>';
		$buttons .= '</frame>';

		// Frame for Previous/Next Buttons
		$buttons .= '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if ($page < ceil(count($toplists) / 4 - 1)) {
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';
		}
		else {
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}
		$buttons .= '</frame>';


		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'BgRaceScore2',
				'LadderRank',
				'Top Rankings   |   Page '. ($page+1) .'/'. ceil(count($toplists) / 4),
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);
		$xml .= '<frame posn="8 -10.6875 1">'; // Content Window

		// Build the Content of this Page
		$pos = 0;
		foreach (range(($page * 4),($page * 4 + 3)) as $id) {
			if ( isset($toplists[$id]) ) {
				$xml .= '<frame posn="'. (47.625 * $pos) .' 0 1">';
				$xml .= $this->buildToplistWindowEntry($toplists[$id], $players, $login);
				$xml .= '</frame>';
				$pos ++;
			}
		}

		$xml .= '</frame>';	// Content Window
		$xml .= $this->templates['WINDOW']['FOOTER'];
		return array(
			'xml'		=> $xml,
			'maxpage'	=> ceil(count($toplists) / 4 - 1),
		);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function buildHelpWindow ($page) {
		global $aseco;

		// Frame for Previous/Next Buttons
		$buttons = '<frame posn="160.1875 -101.8125 0.04">';

		// Previous button
		if ($page > 0) {
			$buttons .= '<frame posn="24.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPagePrev" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowLeft2"/>';
			$buttons .= '</frame>';
		}
		else {
			$buttons .= '<quad posn="24.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		// Next button (display only if more pages to display)
		if ($page < 2) {	// Currently only 3 page there
			$buttons .= '<frame posn="30.0625 0 0.05">';
			$buttons .= '<quad posn="0 0 0.12" sizen="5.625 5.625" action="PluginRecordsEyepiece?Action=WindowPageNext" style="Icons64x64_1" substyle="Maximize"/>';
			$buttons .= '<quad posn="0.85 -0.8 0.13" sizen="3.94 3.94" bgcolor="000F"/>';
			$buttons .= '<quad posn="0.4 -0.28125 0.14" sizen="4.875 4.875" style="Icons64x64_1" substyle="ShowRight2"/>';
			$buttons .= '</frame>';
		}
		else {
			$buttons .= '<quad posn="30.1375 -0.281 0.12" sizen="5.0625 5.0625" style="UIConstructionSimple_Buttons" substyle="Item"/>';
		}

		$buttons .= '</frame>';


		$xml = str_replace(
			array(
				'%icon_style%',
				'%icon_substyle%',
				'%window_title%',
				'%prev_next_buttons%'
			),
			array(
				'BgRaceScore2',
				'LadderRank',
				'$L[http://www.undef.name/UASECO/Records-Eyepiece.php]Records-Eyepiece/'. $this->getVersion() .'$L for UASECO',
				$buttons
			),
			$this->templates['WINDOW']['HEADER']
		);

		// Set the content
		$xml .= '<frame posn="7.5 -11.25 0.01">';
		$xml .= '<quad posn="153.4 0 0.11" sizen="34.1 87.1875" image="maniacdn.net/undef.de/uaseco/records-eyepiece/welcome-records-eyepiece-normal.jpg" imagefocus="maniacdn.net/undef.de/uaseco/records-eyepiece/welcome-records-eyepiece-focus.jpg" url="http://www.undef.name/UASECO/Records-Eyepiece.php"/>';

		if ($page == 0) {
			// Begin Help for Players

			// Key "F9"
			$xml .= '<label posn="0 0 0.01" sizen="42.5 3.75" class="labels" textcolor="FFFF" text="F9"/>';
			$xml .= '<label posn="47.5 0 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Toggle the display of some Widgets"/>';

			// Command "/eyepiece"
			$xml .= '<label posn="0 -3.75 0.01" sizen="42.5 3.75" class="labels" text="/eyepiece help"/>';
			$xml .= '<label posn="47.5 -3.75 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Display this help"/>';

			// Command "/emusic"
			if ($this->config['MUSIC_WIDGET'][0]['ENABLED'][0] == true) {
				$xml .= '<label posn="0 -7.5 0.01" sizen="42.5 3.75" class="labels" text="/emusic"/>';
				$xml .= '<label posn="47.5 -7.5 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Lists musics currently on the server"/>';
			}

			// Command "/estat [PARAMETER]"
			$xml .= '<label posn="0 -15 0.01" sizen="42.5 3.75" class="labels" text="/estat [PARAMETER]"/>';
			$xml .= '<label posn="47.5 -15 0.01" sizen="95 3.75" autonewline="1" class="labels" textcolor="FF0F" text="Optional parameter can be:$FFF'. LF .'dedirecs, localrecs, topnations, topranks, topwinners, mostrecords, mostfinished, topplaytime, topdonators, toptracks, topvoters, topvisitors, topactive, toppayouts, toproundscore'. (($this->config['SCORETABLE_LISTS'][0]['TOP_BETWINS'][0]['ENABLED'][0] == true) ? ', topbetwins' : '') .'"/>';

			// Command "/elist [PARAMETER]"
			$xml .= '<label posn="0 -33.75 0.01" sizen="42.5 3.75" class="labels" text="/elist [PARAMETER]"/>';
			$xml .= '<label posn="47.5 -33.75 0.01" sizen="95 3.75" autonewline="1" class="labels" textcolor="FF0F" text="Lists tracks currently on the server, optional parameter can be:'. LF .'$FFFjukebox, author, authorname, map, norecent, onlyrecent, norank, onlyrank, nomulti, onlymulti, noauthor, nogold, nosilver, nobronze, nofinish, best, worst, shortest, longest, newest, oldest, sortauthor, bestkarma, worstkarma'. LF .'$FF0or a keyword to search for"/>';

			if ($this->config['FEATURES'][0]['MARK_ONLINE_PLAYER_RECORDS'][0] == true) {
				$xml .= '<quad posn="1.125 -73.5 0.02" sizen="3.25 2.625" style="Icons64x64_1" substyle="Buddy"/>';
				$xml .= '<label posn="7.5 -73.5 0.01" sizen="175 0" class="labels" text="Marker for an other Player that is currently online at this Server with a record and is ranked before you"/>';

				$xml .= '<quad posn="1.325 -78.75 0.02" sizen="2.75 2.625" style="Icons64x64_1" substyle="NotBuddy"/>';
				$xml .= '<label posn="7.5 -78.75 0.01" sizen="175 0" class="labels" text="Marker for an other Player that is currently online at this Server with a record and is ranked behind you"/>';
			}

			$xml .= '<quad posn="0.75 -83.8125 0.02" sizen="4 3" style="Icons64x64_1" substyle="ShowRight2"/>';
			$xml .= '<label posn="7.5 -84 0.01" sizen="175 0" class="labels" text="Marker for your driven record"/>';
		}
		else if ($page == 1) {
			// Begin Help for MasterAdmins only
			$xml .= '<label posn="0 0 0.01" sizen="142.5 3.75" class="labels" textcolor="FF0F" text="Commands for MasterAdmins only:"/>';

			// Command "/eyeset reload"
			$xml .= '<label posn="0 -3.75 0.01" sizen="42.5 3.75" class="labels" text="/eyeset reload"/>';
			$xml .= '<label posn="47.5 -3.75 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Reloads the records_eyepiece.xml"/>';

			// Command "/eyeset lfresh [INT]"
			$xml .= '<label posn="0 -7.5 0.01" sizen="42.5 3.75" class="labels" text="/eyeset lfresh [INT]"/>';
			$xml .= '<label posn="47.5 -7.5 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Set the normal &lt;refresh_interval&gt; sec."/>';

			// Command "/eyeset hfresh [INT]"
			$xml .= '<label posn="0 -11.25 0.01" sizen="42.5 3.75" class="labels" text="/eyeset hfresh [INT]"/>';
			$xml .= '<label posn="47.5 -11.25 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Set the nice &lt;refresh_interval&gt; sec."/>';

			// Command "/eyeset llimit [INT]"
			$xml .= '<label posn="0 -15 0.01" sizen="42.5 3.75" class="labels" text="/eyeset llimit [INT]"/>';
			$xml .= '<label posn="47.5 -15 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Set the nice &lt;lower_limit&gt; Players"/>';

			// Command "/eyeset ulimit [INT]"
			$xml .= '<label posn="0 -18.75 0.01" sizen="42.5 3.75" class="labels" text="/eyeset ulimit [INT]"/>';
			$xml .= '<label posn="47.5 -18.75 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Set the nice &lt;upper_limit&gt; Players"/>';

			// Command "/eyeset forcenice (true|false)"
			$xml .= '<label posn="0 -22.5 0.01" sizen="42.5 3.75" class="labels" text="/eyeset forcenice (true|false)"/>';
			$xml .= '<label posn="47.5 -22.5 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Set the &lt;nicemode&gt;&lt;force&gt;"/>';

			// Command "/eyeset playermarker (true|false)"
			$xml .= '<label posn="0 -26.25 0.01" sizen="42.5 3.75" class="labels" text="/eyeset playermarker (true|false)"/>';
			$xml .= '<label posn="47.5 -26.25 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Set the &lt;features&gt;&lt;mark_online_player_records&gt;"/>';


			// Begin Help for MasterAdmins only
			$xml .= '<label posn="0 -41.25 0.01" sizen="142.5 3.75" class="labels" textcolor="FF0F" text="Commands for Op/Admin/MasterAdmin:"/>';

			// Command "/eyepiece payouts"
			$xml .= '<label posn="0 -45 0.01" sizen="42.5 3.75" class="labels" text="/eyepiece payouts"/>';
			$xml .= '<label posn="47.5 -45 0.01" sizen="95 3.75" class="labels" textcolor="FF0F" text="Show the outstanding winning payouts"/>';
		}
		else {
			// Begin About
			$xml .= '<label posn="0 0 0.01" sizen="137.5 0" autonewline="1" class="labels" textcolor="FF0F" text="This plugin based upon the well known and good old FuFi.Widgets who accompanied us for years, it was written from scratch to change the look and feel of the Widgets and to make it easier to configure.'. LF.LF .'Some new features are included to have more information available and easily accessible. The famous feature (i think) is the clock which displays the local time without to choose the local timezone, no more need to calculate the local time from a Server far away!'. LF.LF .'Another nice feature are the clickable Record-Widgets to display all the driven records and not just a few in the small Widgets.'. LF.LF .'The extended $FFF$L[http://www.mania-exchange.com/]ManiaExchange-Mapinfo$L$FF0 Window display more information of a Map as the default currently does and also in a very nice way.'. LF.LF .'The next very nice thing is the Maplist where you can easily add a Map to the Playlist. The integrated filter options makes it easy for e.g. list only Maps with the mood night or only Canyon Maps or only Maps from a selected Mapauthor...'. LF.LF .'$OHave fun with the Records-Eyepiece!"/>';
		}
		$xml .= '</frame>';


		$xml .= $this->templates['WINDOW']['FOOTER'];
		return $xml;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function loadTemplates () {
		global $aseco;


		//--------------------------------------------------------------//
		// BEGIN: Widget for SpectatorInfoWidget			//
		//--------------------------------------------------------------//
$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<spectator_info_widget> (getter) @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Integer RefreshInterval		= 1000;
	declare Integer RefreshTime		= CurrentTime;
	declare Text PreviousStatus		= "";
	declare Text CurrentStatus		= "";

	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		if (CurrentTime > RefreshTime) {
			// https://forum.maniaplanet.com/viewtopic.php?p=228759#p228759
			if (GUIPlayer != Null) {
				if (GUIPlayer.Login != InputPlayer.Login) {
					CurrentStatus = ""^ GUIPlayer.Login;
				}
				else {
					CurrentStatus = "";
				}
			}
			else {
				CurrentStatus = "";
			}
			if (CurrentStatus != PreviousStatus) {
				PreviousStatus = CurrentStatus;
				TriggerPageAction("PluginRecordsEyepiece?Action=spectatorUpdate&Spectator="^ InputPlayer.Login ^"&Target="^ CurrentStatus);
			}

			// Reset RefreshTime
			RefreshTime = (CurrentTime + RefreshInterval);
		}
	}
}
--></script>
EOL;
		$content  = '<manialink id="SpectatorInfoGetter" name="SpectatorInfoGetter" version="2">';
		$content .= $maniascript;
		$content .= '</manialink>';
		$this->templates['SPECTATOR_INFO_WIDGET']['GETTING_SCRIPT'] = $content;



		// %amount_spectators%
		$content  = '<manialink id="SpectatorInfoWidget" name="SpectatorInfoWidget" version="2">';
		$content .= '<frame posn="'. ($this->config['SPECTATOR_INFO_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['SPECTATOR_INFO_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="SpectatorInfoWidget">';
		if ($this->config['SPECTATOR_INFO_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['SPECTATOR_INFO_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['SPECTATOR_INFO_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['SPECTATOR_INFO_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_SPECTATOR'][0] .'"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="" id="Label_SpectatorAmount"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['SPECTATOR_INFO_WIDGET'][0]['TEXT_COLOR'][0] .'" text="SPECTATING"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<spectator_info_widget> (widget) @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {

	declare CMlControl Frame_SpectatorInfoWidget	<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare CMlLabel Label_SpectatorAmount		<=> (Page.GetFirstChild("Label_SpectatorAmount") as CMlLabel);
	declare Integer AmountSpectators		= %amount_spectators%;

	Frame_SpectatorInfoWidget.RelativeScale		= {$this->config['SPECTATOR_INFO_WIDGET'][0]['SCALE'][0]};

	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Hide the Widget for Spectators (also temporary one)
		if (InputPlayer.IsSpawned == False) {
			Frame_SpectatorInfoWidget.Hide();
			continue;
		}
		else {
			Frame_SpectatorInfoWidget.Show();
		}

		if (AmountSpectators == 1) {
			Label_SpectatorAmount.Value = ""^ AmountSpectators ^" PLAYER";
		}
		else {
			Label_SpectatorAmount.Value = ""^ AmountSpectators ^" PLAYERS";
		}
	}
}
--></script>
EOL;
		$content .= '</manialink>';
		$this->templates['SPECTATOR_INFO_WIDGET']['WIDGET'] = $content;

		unset($content, $maniascript);
		//--------------------------------------------------------------//
		// END: Widget for SpectatorInfoWidget				//
		//--------------------------------------------------------------//



		//--------------------------------------------------------------//
		// BEGIN: Widget for MultiLapInfo				//
		//--------------------------------------------------------------//
		// %totallaps%
		$content  = '<manialink id="MultiLapInfoWidget" name="MultiLapInfoWidget" version="2">';
		$content .= '<frame posn="'. ($this->config['MULTILAP_INFO_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['MULTILAP_INFO_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="MultiLapInfoWidget">';
		if ($this->config['MULTILAP_INFO_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['MULTILAP_INFO_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['MULTILAP_INFO_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['MULTILAP_INFO_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}
		$content .= '<quad posn="5.75 -0.5625 0.002" sizen="8 8" halign="center" style="BgRaceScore2" substyle="Laps"/>';
		$content .= '<label posn="5.75 -3 0.003" sizen="8 6" halign="center" scale="0.5" textcolor="FFFFFF" text="$OLAST" hidden="true" id="Label_LastLapInfo"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="0 of 0" id="Label_MultilapProgression"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['MULTILAP_INFO_WIDGET'][0]['TEXT_COLOR'][0] .'" text="MULTI LAP"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<multilap_info_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
#Include "TextLib" as TextLib
Integer Blink (Text _ChildId, Integer _NextChange) {
	declare Container <=> (Page.GetFirstChild(_ChildId) as CMlLabel);
	declare Vec3 ColorDefault = TextLib::ToColor("888888");
	declare Vec3 ColorBlink = TextLib::ToColor("FFF500");

	if (CurrentTime >= _NextChange) {
		if (Container.TextColor == ColorBlink) {
			Container.TextColor = ColorDefault;
		}
		else {
			Container.TextColor = ColorBlink;
		}
		return (CurrentTime + 250);
	}
	return _NextChange;
}
main () {
	declare CMlControl Frame_MultiLapInfoWidget <=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare CMlLabel Label_LastLapInfo <=> (Page.GetFirstChild("Label_LastLapInfo") as CMlLabel);
	declare CMlLabel Label_MultilapProgression <=> (Page.GetFirstChild("Label_MultilapProgression") as CMlLabel);

	Frame_MultiLapInfoWidget.RelativeScale	= {$this->config['MULTILAP_INFO_WIDGET'][0]['SCALE'][0]};

	declare Integer TotalLaps		= %totallaps%;
	declare Integer RefreshInterval		= 250;
	declare Integer RefreshTime		= CurrentTime;
	declare Integer BlinkNextChange		= 0;

	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Hide the Widget for Spectators (also temporary one)
		if (InputPlayer.IsSpawned == False) {
			Frame_MultiLapInfoWidget.Hide();
			continue;
		}
		else {
			Frame_MultiLapInfoWidget.Show();
		}

		if (CurrentTime > RefreshTime) {
			if ((InputPlayer.CurrentNbLaps + 1) <= TotalLaps) {
				Label_MultilapProgression.Value = (InputPlayer.CurrentNbLaps + 1) ^" of "^ TotalLaps;
				Label_LastLapInfo.Hide();
			}
			if ((InputPlayer.CurrentNbLaps + 1) >= TotalLaps) {
				Label_LastLapInfo.Show();
				BlinkNextChange = Blink("Label_LastLapInfo", BlinkNextChange);
			}

			// Reset RefreshTime
			RefreshTime = (CurrentTime + RefreshInterval);
		}
	}
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['MULTILAP_INFO_WIDGET']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for MultiLapInfo					//
		//--------------------------------------------------------------//



		//--------------------------------------------------------------//
		// BEGIN: Widget for WarmUpInfo					//
		//--------------------------------------------------------------//
		$content  = '<manialink id="WarmUpInfoWidget" name="WarmUpInfoWidget" version="2">';
		$content .= '<frame posn="'. ($this->config['WARM_UP_INFO_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['WARM_UP_INFO_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="WarmUpInfoWidget">';
		if ($this->config['WARM_UP_INFO_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['WARM_UP_INFO_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['WARM_UP_INFO_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['WARM_UP_INFO_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}
		$content .= '<quad posn="5.75 -0.5625 0.002" sizen="6 6" halign="center" style="BgRaceScore2" substyle="Warmup"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="0 of 0" id="Label_WarmUpProgression"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['WARM_UP_INFO_WIDGET'][0]['TEXT_COLOR'][0] .'" text="WARM-UP"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<warm_up_info_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare CMlControl Frame_WarmUpInfoWidget <=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare CMlLabel Label_WarmUpProgression <=> (Page.GetFirstChild("Label_WarmUpProgression") as CMlLabel);

	declare netread Integer Net_LibWU2_WarmUpPlayedNb for Teams[0];
	declare netread Integer Net_LibWU2_WarmUpDuration for Teams[0];

	Frame_WarmUpInfoWidget.RelativeScale	= {$this->config['WARM_UP_INFO_WIDGET'][0]['SCALE'][0]};

	declare PrevWarmUpPlayedNb		= -1;
	declare PrevWarmUpDuration		= -1;
	declare Integer RefreshInterval		= 250;
	declare Integer RefreshTime		= CurrentTime;

	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Hide the Widget for Spectators (also temporary one)
		if (InputPlayer.IsSpawned == False) {
			Frame_WarmUpInfoWidget.Hide();
			continue;
		}
		else {
			Frame_WarmUpInfoWidget.Show();
		}


		if (CurrentTime > RefreshTime) {
			if (PrevWarmUpPlayedNb != Net_LibWU2_WarmUpPlayedNb || PrevWarmUpDuration != Net_LibWU2_WarmUpDuration) {
				PrevWarmUpPlayedNb = Net_LibWU2_WarmUpPlayedNb;
				PrevWarmUpDuration = Net_LibWU2_WarmUpDuration;

				Label_WarmUpProgression.Value = Net_LibWU2_WarmUpPlayedNb ^" of "^ Net_LibWU2_WarmUpDuration;
			}

			// Reset RefreshTime
			RefreshTime = (CurrentTime + RefreshInterval);
		}
	}
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['WARM_UP_INFO_WIDGET']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for WarmUpInfo					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget ProgressIndicator				//
		//--------------------------------------------------------------//
		$content  = '<quad posn="100.5 -50.35 0.11" sizen="55 55" halign="center" valign="center" image="'. $this->config['IMAGES'][0]['PROGRESS_INDICATOR'][0] .'"/>';
		$content .= '<label posn="100.5 -75.2 0.12" sizen="55 55" halign="center" textsize="2" textcolor="FFFF" text="$SLoading... please wait."/>';

		$this->templates['PROGRESS_INDICATOR']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for ProgressIndicator				//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget Donation (at Score)				//
		//--------------------------------------------------------------//
		// %widgetheight%
		$header  = '<manialink id="DonationWidgetAtScore" name="DonationWidgetAtScore" version="2">';
		$header .= '<frame posn="'. ($this->config['DONATION_WIDGET'][0]['WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['DONATION_WIDGET'][0]['WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="DonationWidgetAtScore">';
		if ($this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BACKGROUND_COLOR'][0] != '') {
			$header .= '<quad posn="0 0 0.001" sizen="11.5 %widgetheight%" bgcolor="'. $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BACKGROUND_COLOR'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="0 0 0.001" sizen="11.5 %widgetheight%" style="'. $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['DONATION_WIDGET'][0]['WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_DONATE'][0] .'"/>';
		$header .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="PLEASE"/>';
		$header .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['DONATION_WIDGET'][0]['TEXT_COLOR'][0] .'" text="DONATE"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<donation_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['DONATION_WIDGET'][0]['WIDGET'][0]['SCALE'][0]};
}
--></script>
EOL;

		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['DONATION_WIDGET']['HEADER'] = $header;
		$this->templates['DONATION_WIDGET']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: Widget for Donation (at Score)				//
		//--------------------------------------------------------------//





		//--------------------------------------------------------------//
		// BEGIN: Widget for WinningPayout				//
		//--------------------------------------------------------------//
		$header  = '<manialink id="WinningPayoutWidgetAtScore" name="WinningPayoutWidgetAtScore" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="'. ($this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="WinningPayoutWidgetAtScore">';
		if ($this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['BACKGROUND_COLOR'][0] != '') {
			$header .= '<quad posn="0 0 0.001" sizen="63.75 '. (($this->config['LineHeight'] * 1.875) * 5.625 + 6.375) .'" bgcolor="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['BACKGROUND_COLOR'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="0 0 0.001" sizen="63.75 '. (($this->config['LineHeight'] * 1.875) * 5.625 + 6.375) .'" style="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}

		// Icon and Title
		if ($this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.002" sizen="61.75 3.75" bgcolor="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.002" sizen="61.75 3.75" style="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="'. $this->config['Positions']['left']['icon']['x'] .' '. $this->config['Positions']['left']['icon']['y'] .' 0.004" sizen="3.75 3.75" halign="center" valign="center2" style="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['ICON_SUBSTYLE'][0] .'"/>';
		$header .= '<label posn="'. $this->config['Positions']['left']['title']['x'] .' '. $this->config['Positions']['left']['title']['y'] .' 0.004" sizen="50.5 2.4" textsize="1" text="'. $this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['TITLE'][0] .'"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<winning_payout> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['WINNING_PAYOUT'][0]['WIDGET'][0]['SCALE'][0]};
}
--></script>
EOL;

		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['WINNING_PAYOUT']['HEADER'] = $header;
		$this->templates['WINNING_PAYOUT']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: Widget for WinningPayout				//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for Scoretable Lists				//
		//--------------------------------------------------------------//
		// %manialinkid%
		// %posx%, %posy%, %widgetscale%
		// %widgetheight%
		// %icon_style%, %icon_substyle%
		// %title%
		$header  = '<manialink id="%manialinkid%" name="%manialinkid%" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="%posx% %posy% 0" id="%manialinkid%">';
		if ($this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_COLOR'][0] != '') {
			$header .= '<quad posn="0 0 0.001" sizen="39.4 %widgetheight%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_COLOR'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="0 0 0.001" sizen="39.4 %widgetheight%" style="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}

		// Icon and Title
		if ($this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.002" sizen="37.4 3.75" bgcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.002" sizen="37.4 3.75" style="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="'. $this->config['Positions']['left']['icon']['x'] .' '. $this->config['Positions']['left']['icon']['y'] .' 0.004" sizen="3.75 3.75" halign="center" valign="center2" style="%icon_style%" substyle="%icon_substyle%"/>';
		$header .= '<label posn="'. $this->config['Positions']['left']['title']['x'] .' '. $this->config['Positions']['left']['title']['y'] .' 0.004" sizen="32 2.6" class="labels" text="%title%"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<scoretable_lists> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= %widgetscale%;
}
--></script>
EOL;

		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['SCORETABLE_LISTS']['HEADER'] = $header;
		$this->templates['SCORETABLE_LISTS']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: Widget for Scoretable Lists				//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: MapWidget (RACE)					//
		//--------------------------------------------------------------//
		// %image_open_pos_x%, %image_open%
		// %mapname%, %authortime%, %author%, %author_nation%
		$header  = '<manialink id="MapWidget" name="MapWidget" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="'. ($this->config['MAP_WIDGET'][0]['RACE'][0]['POS_X'][0] * 2.5) .' '. ($this->config['MAP_WIDGET'][0]['RACE'][0]['POS_Y'][0] * 1.875) .' 0" id="MapWidget">';
		$header .= '<quad posn="0.25 -0.1875 0" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 0.5) .' 15.65625" action="PluginRecordsEyepiece?Action=showLastCurrentNextMapWindow" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_FOCUS'][0] .'"/>';
		$header .= '<quad posn="-0.2 0.3 0.001" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) + 0.4) .' 17.15625" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="0 0 0.02" sizen="'. ($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) .' 16.03125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="%image_open_pos_x% -7.75 0.03" sizen="8.75 8.75" image="%image_open%"/>';

		// Icon and Title
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.03" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 2) .' 3.75" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.03" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 2) .' 3.75" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="%posx_icon% %posy_icon% 0.04" sizen="3.75 3.75" halign="center" valign="center2" style="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['CURRENT'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MAP_WIDGET'][0]['ICONS'][0]['CURRENT'][0]['ICON_SUBSTYLE'][0] .'"/>';
		$header .= '<label posn="%posx_title% %posy_title% 0.04" sizen="32 2.6" class="labels" halign="%halign%" text="'. $this->config['MAP_WIDGET'][0]['TITLES'][0]['CURRENT'][0] .'"/>';

		$header .= '<label posn="2.5 -5.0625 0.04" sizen="33.875 3.75" class="labels" text="%mapname%"/>';
		$header .= '<quad posn="2.5 -7.875 0.04" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/%author_nation%.dds"/>';
		$header .= '<label posn="7.5 -8.4375 0.04" sizen="32.5 3.75" class="labels" scale="0.8" text="by %author%"/>';
		$header .= '<quad posn="2.5 -11.31875 0.04" sizen="3.75 3.75" style="BgRaceScore2" substyle="ScoreReplay"/>';
		$header .= '<label posn="7.5 -12.28125 0.04" sizen="15 3.75" class="labels" scale="0.7" text="%authortime%"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<map_widget><race> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['MAP_WIDGET'][0]['RACE'][0]['SCALE'][0]};
}
--></script>
EOL;

		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['MAP_WIDGET']['RACE']['HEADER'] = $header;
		$this->templates['MAP_WIDGET']['RACE']['FOOTER'] = $footer;

		unset($header, $mx, $footer);
		//--------------------------------------------------------------//
		// END: MapWidget (RACE)					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: MapWidget (SCORE)					//
		//--------------------------------------------------------------//
		// %posx_icon%, %posy_icon%, %icon_style%, %icon_substyle%
		// %posx_title%, %posy_title%, %halign%, %title%
		// %mapname%, %author%, %author_nation%, %env%, %mood%, %authortime%, %goldtime%, %silvertime%, %bronzetime%
		$header  = '<manialink id="MapWidget" name="MapWidget" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="'. ($this->config['MAP_WIDGET'][0]['SCORE'][0]['POS_X'][0] * 2.5) .' '. ($this->config['MAP_WIDGET'][0]['SCORE'][0]['POS_Y'][0] * 1.875) .' 0" id="MapWidget">';
		if ($this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_COLOR'][0] != '') {
			$header .= '<quad posn="0.25 -0.1875 0.001" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 0.5) .' 26.4375" bgcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_COLOR'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="0.25 -0.1875 0.001" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 0.5) .' 26.4375" style="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}

		// Icon and Title
		if ($this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.002" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 2) .' 3.75" bgcolor="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.002" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 2) .' 3.75" style="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_SCORE'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="%posx_icon% %posy_icon% 0.004" sizen="3.75 3.75" halign="center" valign="center2" style="%icon_style%" substyle="%icon_substyle%"/>';
		$header .= '<label posn="%posx_title% %posy_title% 0.004" sizen="32 2.6" class="labels" halign="%halign%" text="%title%"/>';

		// Frame for the Mapinfo "Defaults"
		$header .= '<frame posn="1 -19.125 0">';
		$header .= '<label posn="2.125 13.5 0.11" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 6.5) .' 3.75" class="labels" text="%mapname%"/>';
		$header .= '<quad posn="2.125 10.375 0.04" sizen="3.75 3.75" image="file://Skins/Avatars/Flags/%author_nation%.dds"/>';
		$header .= '<label posn="7.875 9.5 0.11" sizen="'. (($this->config['MAP_WIDGET'][0]['WIDTH'][0] * 2.5) - 7.375) .' 2" class="labels" scale="0.9" text="by %author%"/>';
		$header .= '</frame>';

		// Frame for the Mapinfo "Details"
		$header .= '<frame posn="0 -20.125 0">';
		$header .= '<quad posn="6.875 6.3375 0.11" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Advanced"/>';
		$header .= '<label posn="8.25 5.6 0.11" sizen="12 2" class="labels" scale="0.8" text="%env%"/>';
		$header .= '<quad posn="24.125 6.61875 0.11" sizen="3.75 3.75" halign="right" style="Icons128x128_1" substyle="Manialink"/>';
		$header .= '<label posn="25.5 5.6 0.11" sizen="12 2" class="labels" scale="0.8" text="%mood%"/>';
		$header .= '</frame>';

		// Frame for the Mapinfo "Times"
		$header .= '<frame posn="0 -27.1875 0">';
		$header .= '<quad posn="6.875 9.5625 0.11" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalNadeo"/>';
		$header .= '<label posn="8.25 8.5 0.11" sizen="15 3.75" class="labels" scale="0.8" text="%authortime%"/>';
		$header .= '<quad posn="6.875 5.8125 0.11" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalGold"/>';
		$header .= '<label posn="8.25 5.0 0.11" sizen="15 3.75" class="labels" scale="0.8" text="%goldtime%"/>';
		$header .= '<quad posn="24.125 9.5625 0.11" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalSilver"/>';
		$header .= '<label posn="25.5 8.5 0.11" sizen="15 3.75" class="labels" scale="0.8" text="%silvertime%"/>';
		$header .= '<quad posn="24.125 5.8125 0.11" sizen="3.75 3.75" halign="right" style="MedalsBig" substyle="MedalBronze"/>';
		$header .= '<label posn="25.5 5.0 0.11" sizen="15 3.75" class="labels" scale="0.8" text="%bronzetime%"/>';
		$header .= '</frame>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<map_widget><score> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['MAP_WIDGET'][0]['SCORE'][0]['SCALE'][0]};
}
--></script>
EOL;

		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['MAP_WIDGET']['SCORE']['HEADER'] = $header;
		$this->templates['MAP_WIDGET']['SCORE']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: MapWidget (SCORE)					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for Clock					//
		//--------------------------------------------------------------//
		// %posx%, %posy%, %widgetscale%
		// %background%
		$content  = '<manialink id="ClockWidget" name="ClockWidget" version="2">';
		$content .= '<frame posn="%posx% %posy% 0" id="ClockWidget">';

		// Content
		$content .= '%background%';
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_CLOCK'][0] .'"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="" id="RecordsEyepieceLabelLocalTime"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['CLOCK_WIDGET'][0]['TEXT_COLOR'][0] .'" text="LOCAL TIME"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<clock_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
#Include "TextLib" as TextLib
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= %widgetscale%;

	declare LabelLocalTime		<=> (Page.GetFirstChild("RecordsEyepieceLabelLocalTime") as CMlLabel);
	declare Text PrevTime		= CurrentLocalDateText;

	while (True) {
		yield;

		// Throttling to work only on every second
		if (PrevTime != CurrentLocalDateText) {
			PrevTime = CurrentLocalDateText;
			LabelLocalTime.Value = TextLib::SubString(CurrentLocalDateText, 11, 20);
		}
	}
}
--></script>
EOL;

		$content .= '</frame>';
		$content .= $maniascript;
		$content .= '</manialink>';

		$this->templates['CLOCK_WIDGET']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for Clock					//
		//--------------------------------------------------------------//





		//--------------------------------------------------------------//
		// BEGIN: Widget for TopList					//
		//--------------------------------------------------------------//
		$content  = '<manialink id="ToplistWidget" name="ToplistWidget" version="2">';
		$content .= '<frame posn="'. ($this->config['TOPLIST_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['TOPLIST_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="ToplistWidget">';
		if ($this->config['TOPLIST_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['TOPLIST_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['TOPLIST_WIDGET'][0]['BACKGROUND_FOCUS'][0] .'" scriptevents="1" id="ButtonToplistWidget"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['TOPLIST_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['TOPLIST_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'" scriptevents="1" id="ButtonToplistWidget"/>';
		}
		$content .= '<quad posn="-0.45 -8.625 0.002" sizen="5.25 3.9375" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_SMALL'][0] .'"/>';
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_RANKINGS'][0] .'"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="MORE"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['TOPLIST_WIDGET'][0]['TEXT_COLOR'][0] .'" text="RANKING"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<toplist_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['TOPLIST_WIDGET'][0]['SCALE'][0]};
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseOver : {
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 2, 1.0);
				}

				case CMlEvent::Type::MouseClick : {
					TriggerPageAction("PluginRecordsEyepiece?Action=showToplistWindow");
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 0, 1.0);
				}
			}
		}
	}
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['TOPLIST_WIDGET']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for TopList					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: NextEnvironment at Score				//
		//--------------------------------------------------------------//
		// %icon%
		$content  = '<manialink id="NextEnvironmentWidgetAtScore" name="NextEnvironmentWidgetAtScore" version="2">';
		$content .= '<frame posn="'. ($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="NextEnvironmentWidgetAtScore">';
		if ($this->config['NEXT_ENVIRONMENT_WIDGET'][0]['BACKGROUND_COLOR'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="27.75 12.19" bgcolor="'. $this->config['NEXT_ENVIRONMENT_WIDGET'][0]['BACKGROUND_COLOR'][0] .'"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="27.75 12.19" style="'. $this->config['NEXT_ENVIRONMENT_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['VISITORS_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}
		$content .= '%icon%';
		$content .= '<label posn="14 -9.75 0.002" sizen="41.25 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['NEXT_ENVIRONMENT_WIDGET'][0]['TEXT_COLOR'][0] .'" text="NEXT ENVIRONMENT"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<next_environment_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['NEXT_ENVIRONMENT_WIDGET'][0]['SCALE'][0]};
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['NEXT_ENVIRONMENT']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: NextEnvironment at Score				//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: NextGamemode at Score					//
		//--------------------------------------------------------------//
		// %icon_style%, %icon_substyle%
		$content  = '<manialink id="NextGamemodeWidgetAtScore" name="NextGamemodeWidgetAtScore" version="2">';
		$content .= '<frame posn="'. ($this->config['NEXT_GAMEMODE_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['NEXT_GAMEMODE_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="NextGamemodeWidgetAtScore">';
		if ($this->config['NEXT_GAMEMODE_WIDGET'][0]['BACKGROUND_COLOR'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['NEXT_GAMEMODE_WIDGET'][0]['BACKGROUND_COLOR'][0] .'"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['NEXT_GAMEMODE_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['NEXT_GAMEMODE_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		}
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" style="%icon_style%" substyle="%icon_substyle%"/>';
		$content .= '<label posn="5.75 -7.3875 0.002" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['NEXT_GAMEMODE_WIDGET'][0]['TEXT_COLOR'][0] .'" text="NEXT"/>';
		$content .= '<label posn="5.75 -9.3875 0.002" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['NEXT_GAMEMODE_WIDGET'][0]['TEXT_COLOR'][0] .'" text="GAMEMODE"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<next_gamemode_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['NEXT_GAMEMODE_WIDGET'][0]['SCALE'][0]};
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['NEXT_GAMEMODE']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: NextGamemode at Score					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for Visitors					//
		//--------------------------------------------------------------//
		// %visitorcount%
		$content  = '<manialink id="VisitorsWidget" name="VisitorsWidget" version="2">';
		$content .= '<frame posn="'. ($this->config['VISITORS_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['VISITORS_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="VisitorsWidget">';
		if ($this->config['VISITORS_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['VISITORS_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['VISITORS_WIDGET'][0]['BACKGROUND_FOCUS'][0] .'" scriptevents="1" id="ButtonVisitorsWidget"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['VISITORS_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['VISITORS_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'" scriptevents="1" id="ButtonVisitorsWidget"/>';
		}
		$content .= '<quad posn="-0.45 -8.625 0.002" sizen="5.25 3.9375" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_SMALL'][0] .'"/>';
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_VISITORS'][0] .'"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="%visitorcount%"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['VISITORS_WIDGET'][0]['TEXT_COLOR'][0] .'" text="VISITORS"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<visitors_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['VISITORS_WIDGET'][0]['SCALE'][0]};
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Check for MouseEvents
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseOver : {
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 2, 1.0);
				}
				case CMlEvent::Type::MouseClick : {
					TriggerPageAction("PluginRecordsEyepiece?Action=showTopNationsWindow");
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 0, 1.0);
				}
			}
		}
	}
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['VISITORS_WIDGET']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for Visitors					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for ManiaExchange				//
		//--------------------------------------------------------------//
		// %offline_record%, %text%
		$header  = '<manialink id="ManiaExchangeWidget" name="ManiaExchangeWidget" version="2">';
		$header .= '<frame posn="'. ($this->config['MANIAEXCHANGE_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['MANIAEXCHANGE_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="ManiaExchangeWidget">';

		$footer = '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_MANIA_EXCHANGE'][0] .'"/>';
		$footer .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="%offline_record%"/>';
		$footer .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['MANIAEXCHANGE_WIDGET'][0]['TEXT_COLOR'][0] .'" text="%text%"/>';
		$footer .= '</frame>';
$footer .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<maniaexchange_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['MANIAEXCHANGE_WIDGET'][0]['SCALE'][0]};
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseOver : {
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 2, 1.0);
				}
				case CMlEvent::Type::MouseClick : {
					TriggerPageAction("PluginRecordsEyepiece?Action=showManiaExchangeMapInfoWindow");
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 0, 1.0);
				}
			}
		}
	}
}
--></script>
EOL;
		$footer .= '</manialink>';

		$this->templates['MANIA_EXCHANGE']['HEADER'] = $header;
		$this->templates['MANIA_EXCHANGE']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: Widget for ManiaExchangeWidget				//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for MapCount					//
		//--------------------------------------------------------------//
		// %mapcount%
		$content  = '<manialink id="MapCountWidget" name="MapCountWidget" version="2">';
		$content .= '<frame posn="'. ($this->config['MAPCOUNT_WIDGET'][0]['POS_X'][0] * 2.5) .' '. ($this->config['MAPCOUNT_WIDGET'][0]['POS_Y'][0] * 1.875) .' 0" id="MapCountWidget">';
		if ($this->config['MAPCOUNT_WIDGET'][0]['BACKGROUND_DEFAULT'][0] != '') {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" bgcolor="'. $this->config['MAPCOUNT_WIDGET'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['MAPCOUNT_WIDGET'][0]['BACKGROUND_FOCUS'][0] .'" scriptevents="1" id="ButtonMapCountWidget"/>';
		}
		else {
			$content .= '<quad posn="0 0 0.001" sizen="11.5 12.19" style="'. $this->config['MAPCOUNT_WIDGET'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['MAPCOUNT_WIDGET'][0]['BACKGROUND_SUBSTYLE'][0] .'" scriptevents="1" id="ButtonMapCountWidget"/>';
		}
		$content .= '<quad posn="-0.45 -8.625 0.002" sizen="5.25 3.9375" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_SMALL'][0] .'"/>';
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_MAPS'][0] .'"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="%mapcount%"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['MAPCOUNT_WIDGET'][0]['TEXT_COLOR'][0] .'"  text="MAPS"/>';
		$content .= '</frame>';
$content .= <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<mapcount_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= {$this->config['MAPCOUNT_WIDGET'][0]['SCALE'][0]};
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseOver : {
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 2, 1.0);
				}
				case CMlEvent::Type::MouseClick : {
					TriggerPageAction("PluginRecordsEyepiece?Action=showMaplistWindow");
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 0, 1.0);
				}
			}
		}
	}
}
--></script>
EOL;
		$content .= '</manialink>';

		$this->templates['MAPCOUNT']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for Mapcount					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for Favorite					//
		//--------------------------------------------------------------//
		// %posx%, %posy%, %widgetscale%
		// %background%
		$content  = '<manialink id="AddToFavoriteWidget" name="AddToFavoriteWidget" version="2">';
		$content .= '<frame posn="%posx% %posy% 0" id="AddToFavoriteWidget">';
		$content .= '%background%';
		$content .= '<quad posn="-0.45 -8.625 0.002" sizen="5.25 3.9375" image="'. $this->config['IMAGES'][0]['WIDGET_OPEN_SMALL'][0] .'"/>';
		$content .= '<quad posn="5.75 -0.18 0.002" sizen="6.4 6.4" halign="center" modulatecolor="DDDDDD" image="'. $this->config['IMAGES'][0]['ICON_FAVORITES'][0] .'" id="Quad_FavoIcon"/>';
		$content .= '<label posn="5.75 -6.775 0.1" sizen="10.6 2.5" halign="center" textsize="1" scale="0.95" text="ADD"/>';
		$content .= '<label posn="5.75 -9.3875 0.1" sizen="17 2.4" halign="center" textsize="1" scale="0.6" textcolor="'. $this->config['FAVORITE_WIDGET'][0]['TEXT_COLOR'][0] .'" text="FAVORITE"/>';
		$content .= '</frame>';

		$url = 'addfavorite?action=add&game=ManiaPlanet&server='. rawurlencode($aseco->server->login) .'&name='. rawurlencode($aseco->server->name) .'&zone='. rawurlencode(implode('|', $aseco->server->zone)) .'&player=';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<favorite_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
#Include "TextLib" as TextLib
#Include "AnimLib" as AnimLib
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare Quad_FavoIcon		<=> (Page.GetFirstChild("Quad_FavoIcon") as CMlQuad);

	declare Boolean Zoomed		= False;
	declare Integer StartTime	= 0;
	declare Integer RefreshInterval	= 900;
	declare Integer RefreshTime	= CurrentTime;

	Container.RelativeScale		= %widgetscale%;
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Throttling to work only on every second
		if (CurrentTime > RefreshTime) {
			StartTime = CurrentTime;

			// Reset RefreshTime
			RefreshTime = (CurrentTime + RefreshInterval);
		}
		Quad_FavoIcon.Opacity = AnimLib::EaseLinear(CurrentTime - StartTime, 1.0, -1.0, RefreshInterval);

		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseOver : {
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 2, 1.0);
				}
				case CMlEvent::Type::MouseClick : {
					OpenLink("$url" ^ InputPlayer.Login ^"&nickname="^ TextLib::StripFormatting(InputPlayer.Name), CMlScript::LinkType::ManialinkBrowser);
					Audio.PlaySoundEvent(CAudioManager::ELibSound::Valid, 0, 1.0);
				}
			}
		}
	}
}
--></script>
EOL;
		$content .= $maniascript;
		$content .= '</manialink>';

		$this->templates['FAVORITE_WIDGET']['CONTENT'] = $content;

		unset($content);
		//--------------------------------------------------------------//
		// END: Widget for Favorite					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Widget for MusicWidget				//
		//--------------------------------------------------------------//
		// %manialinkid%
		// %posx%, %posy%
		// %backgroundwidth%
		// %borderwidth%
		// %widgetwidth%
		// %title_background_width%
		// %actionid%
		// %image_open_pos_x%, %image_open_pos_y%, %image_open%
		// %posx_icon%, %posy_icon%
		// %posx_title%, %posy_title%
		// %halign%, %title%
		$header  = '<manialink id="%manialinkid%" name="%manialinkid%" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="%posx% %posy% 0" id="%manialinkid%">';
		$header .= '<quad posn="0.25 -0.1875 0" sizen="%backgroundwidth% 15.65625" action="PluginRecordsEyepiece?Action=%actionid%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_FOCUS'][0] .'"/>';
		$header .= '<quad posn="-0.5 0.5625 0.001" sizen="%borderwidth% 17.15625" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="0 0 0.002" sizen="%widgetwidth% 16.03125" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="%image_open_pos_x% %image_open_pos_y% 0.05" sizen="8.75 8.75" image="%image_open%"/>';

		// Icon and Title
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.003" sizen="%title_background_width% 3.75" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.003" sizen="%title_background_width% 3.75" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="%posx_icon% %posy_icon% 0.004" sizen="3.75 3.75" halign="center" valign="center2" style="'. $this->config['MUSIC_WIDGET'][0]['ICON_STYLE'][0] .'" substyle="'. $this->config['MUSIC_WIDGET'][0]['ICON_SUBSTYLE'][0] .'"/>';
		$header .= '<label posn="%posx_title% %posy_title% 0.004" sizen="32 2.6" class="labels" halign="%halign%" text="%title%"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<music_widget> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
Void MoveIt (Text _Id, Boolean _ScrollOut, Vec3 _Position) {
	declare Container <=> (Page.GetFirstChild(_Id) as CMlFrame);
	if (_ScrollOut == True) {
		if (Container.RelativePosition.X >= 0) {
			while (Container.RelativePosition.X < 200) {
				Container.RelativePosition.X += 4.0;
				yield;
			}
		}
		else if (Container.RelativePosition.X < 0) {
			while (Container.RelativePosition.X > -240) {
				Container.RelativePosition.X -= 4.0;
				yield;
			}
		}
	}
	else {
		Container.RelativePosition = _Position;
	}
}
main () {
	declare persistent Boolean RecordsEyepieceMusicWidgetVisible = True;

	declare MusicWidget <=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	declare Vec3 OriginalRelativePosition = MusicWidget.RelativePosition;

	MusicWidget.RelativeScale	= {$this->config['MUSIC_WIDGET'][0]['SCALE'][0]};
	MusicWidget.Visible		= RecordsEyepieceMusicWidgetVisible;
	while (True) {
		yield;
		if (!PageIsVisible || InputPlayer == Null) {
			continue;
		}

		// Check for pressed F9 to hide the Widget
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::KeyPress : {
					if (Event.KeyName == "F9") {
						if (MusicWidget.Visible == False) {
							MoveIt(Page.MainFrame.ControlId, False, OriginalRelativePosition);
							RecordsEyepieceMusicWidgetVisible = True;
						}
						else {
							MoveIt(Page.MainFrame.ControlId, True, OriginalRelativePosition);
							RecordsEyepieceMusicWidgetVisible = False;
						}
						MusicWidget.Visible = RecordsEyepieceMusicWidgetVisible;
					}
				}
			}
		}
	}
}
--></script>
EOL;
		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['MUSIC_WIDGET']['HEADER'] = $header;
		$this->templates['MUSIC_WIDGET']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: Widget for MusicWidget					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: RecordWidgets (Dedimania, Locals, Live)		//
		//--------------------------------------------------------------//
		// %manialinkid%
		// %actionid%
		// %posx%, %posy%
		// %backgroundwidth% %backgroundheight%
		// %borderwidth%, %borderheight%
		// %widgetwidth%, %widgetheight%
		// %column_width_name%, %column_height%
		// %image_open_pos_x%, %image_open_pos_y%, %image_open%
		// %title_background_width%
		// %posx_icon%, %posy_icon%, %icon_style%, %icon_substyle%
		// %posx_title%, %posy_title%
		// %halign%, %title%
		$header  = '<manialink id="%manialinkid%" name="%manialinkid%" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="%posx% %posy% 0" id="%manialinkid%">';
		$header .= '<quad posn="0.25 -0.1875 0" sizen="%backgroundwidth% %backgroundheight%" action="PluginRecordsEyepiece?Action=%actionid%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_DEFAULT'][0] .'" bgcolorfocus="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_FOCUS'][0] .'"/>';
		$header .= '<quad posn="-0.5 0.5625 0.001" sizen="%borderwidth% %borderheight%" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="0 0 0.002" sizen="%widgetwidth% %widgetheight%" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="1 -4.875 0.003" sizen="3.75 %column_height%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BACKGROUND_RANK'][0] .'"/>';
		$header .= '<quad posn="6 -4.875 0.003" sizen="9.125 %column_height%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BACKGROUND_SCORE'][0] .'"/>';
		$header .= '<quad posn="15.125 -4.875 0.003" sizen="%column_width_name% %column_height%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BACKGROUND_NAME'][0] .'"/>';
		$header .= '<quad posn="%image_open_pos_x% %image_open_pos_y% 0.05" sizen="8.75 8.75" image="%image_open%"/>';

		// Icon and Title
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.003" sizen="%title_background_width% 3.75" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.003" sizen="%title_background_width% 3.75" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="%posx_icon% %posy_icon% 0.004" sizen="3.75 3.75" halign="center" valign="center2" style="%icon_style%" substyle="%icon_substyle%"/>';
		$header .= '<label posn="%posx_title% %posy_title% 0.004" sizen="32 2.6" class="labels" halign="%halign%" text="%title%"/>';

		$footer  = '</frame>';
		$footer .= '</manialink>';

		$this->templates['RECORD_WIDGETS']['HEADER'] = $header;
		$this->templates['RECORD_WIDGETS']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: RecordWidgets (Dedimania, Locals, Live)			//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: RoundScoreWidget 					//
		//--------------------------------------------------------------//
		// %manialinkid%
		// %posx%, %posy%, %widgetscale%
		// %borderwidth%, %borderheight%
		// %widgetwidth%, %widgetheight%
		// %column_width_name%, %column_height%
		// %title_background_width%
		// %image_open_pos_x%, %image_open_pos_y%, %image_open%
		// %posx_icon%, %posy_icon%, %icon_style%, %icon_substyle%
		// %posx_title%, %posy_title%
		// %halign%, %title%
		$header  = '<manialink id="%manialinkid%" name="%manialinkid%" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['DEFAULT'][0] .'"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="%posx% %posy% 0" id="%manialinkid%">';
		$header .= '<quad posn="0.25 -0.1875 0" sizen="%widgetwidth% %widgetheight%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_DEFAULT'][0] .'"/>';
		$header .= '<quad posn="-0.5 0.5625 0.001" sizen="%borderwidth% %borderheight%" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BORDER_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="0 0 0.002" sizen="%widgetwidth% %widgetheight%" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="1 -4.875 0.003" sizen="5 %column_height%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BACKGROUND_RANK'][0] .'"/>';
		$header .= '<quad posn="6 -4.875 0.003" sizen="9.125 %column_height%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BACKGROUND_SCORE'][0] .'"/>';
		$header .= '<quad posn="15.125 -4.875 0.003" sizen="%column_width_name% %column_height%" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['COLORS'][0]['BACKGROUND_NAME'][0] .'"/>';

		// Icon and Title
		if ($this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] != '') {
			$header .= '<quad posn="1 -0.675 0.003" sizen="%title_background_width% 3.75" bgcolor="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_BACKGROUND'][0] .'"/>';
		}
		else {
			$header .= '<quad posn="1 -0.675 0.003" sizen="%title_background_width% 3.75" style="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WIDGET_RACE'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		}
		$header .= '<quad posn="%posx_icon% %posy_icon% 0.004" sizen="3.75 3.75" halign="center" valign="center2" style="%icon_style%" substyle="%icon_substyle%"/>';
		$header .= '<label posn="%posx_title% %posy_title% 0.004" sizen="32 2.6" class="labels" halign="%halign%" text="%title%"/>';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	<round_score> @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Container		<=> (Page.GetFirstChild(Page.MainFrame.ControlId) as CMlFrame);
	Container.RelativeScale		= %widgetscale%;
}
--></script>
EOL;

		$footer  = '</frame>';
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['ROUNDSCOWIDGET']['HEADER'] = $header;
		$this->templates['ROUNDSCOWIDGET']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: RoundScoreWidget					//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: Window						//
		//--------------------------------------------------------------//
		// %icon_style%, %icon_substyle%
		// %window_title%
		// %prev_next_buttons%
		$header  = '<manialink id="SubWindow"></manialink>';		// Always close sub windows
		$header .= '<manialink id="MainWindow" name="MainWindow" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="FFFF"/>';
		$header .= '</stylesheet>';
		if ($this->config['STYLE'][0]['WINDOW'][0]['LIGHTBOX'][0]['ENABLED'][0] == true) {
			$header .= '<quad posn="-160 90 18.49" sizen="320 180" bgcolor="'. $this->config['STYLE'][0]['WINDOW'][0]['LIGHTBOX'][0]['BGCOLOR'][0] .'" id="Lightbox"/>';
		}
		else {
			$header .= '<quad posn="-320 0 18.49" sizen="2.5 1.875" bgcolor="FFF0" id="Lightbox"/>';
		}
		$header .= '<frame posn="-102 57.28125 10.50" id="Window">';	// BEGIN: Window Frame
		$header .= '<quad posn="-0.5 0.375 0.01" sizen="204.5 110.625" style="'. $this->config['STYLE'][0]['WINDOW'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WINDOW'][0]['BACKGROUND_SUBSTYLE'][0] .'" id="WindowBody" ScriptEvents="1"/>';
		$header .= '<quad posn="4.5 -7.68749 0.02" sizen="194.25 93.5625" bgcolor="'. $this->config['STYLE'][0]['WINDOW'][0]['CONTENT_BGCOLOR'][0] .'"/>';

		// Header Line
		$header .= '<quad posn="-1.5 1.125 0.02" sizen="206.5 11.25" style="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="-1.5 1.125 0.03" sizen="206.5 11.25" style="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_SUBSTYLE'][0] .'" id="WindowTitle" ScriptEvents="1"/>';

		// Title
		$header .= '<quad posn="2.5 -1.7 0.04" sizen="5.5 5.5" style="%icon_style%" substyle="%icon_substyle%"/>';
		$header .= '<label posn="9.75 -3.1 0.04" sizen="188.5 5" class="labels" textsize="2" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WINDOW'][0]['HEADLINE_TEXTCOLOR'][0] .'" text="%window_title%"/>';

		// Minimize Button
		$header .= '<frame posn="187.5 -0.28125 0.05">';
		$header .= '<quad posn="0 0 0.01" sizen="8.44 8.44" style="Icons64x64_1" substyle="ArrowUp" id="WindowMinimize" ScriptEvents="1"/>';
		$header .= '<quad posn="2.25 -2.4 0.02" sizen="3.75 3.75" bgcolor="EEEF"/>';
		$header .= '<label posn="4.3 -4.5 0.03" sizen="15 0" class="labels" halign="center" valign="center" textsize="3" textcolor="000F" text="$O-"/>';
		$header .= '</frame>';

		// Close Button
		$header .= '<frame posn="193.5 -0.28125 0.05">';
		$header .= '<quad posn="0 0 0.01" sizen="8.44 8.44" style="Icons64x64_1" substyle="ArrowUp" id="WindowClose" ScriptEvents="1"/>';
		$header .= '<quad posn="2.25 -2.4 0.02" sizen="3.75 3.75" bgcolor="EEEF"/>';
		$header .= '<quad posn="1.25 -1.3125 0.03" sizen="5.82 5.82" style="Icons64x64_1" substyle="Close"/>';
		$header .= '</frame>';

		$header .= '<label posn="17 -104.625 0.04" sizen="40 3.75" class="labels" halign="center" valign="center2" textsize="1" scale="0.7" action="PluginRecordsEyepiece?Action=showHelpWindow" focusareacolor1="0000" focusareacolor2="FFF5" textcolor="000F" text="RECORDS-EYEPIECE/'. $this->getVersion() .'"/>';
		$header .= '%prev_next_buttons%';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	Window @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
#Include "TextLib" as TextLib
Void HideFrame (Text ChildId) {
	declare CMlControl Container <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	Container.Unload();
}
Void WipeOut (Text ChildId) {
	declare CMlControl Container <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	if (Container != Null) {
		declare Real EndPosnX = 0.0;
		declare Real EndPosnY = 0.0;
		declare Real PosnDistanceX = (EndPosnX - Container.RelativePosition.X);
		declare Real PosnDistanceY = (EndPosnY - Container.RelativePosition.Y);

		while (Container.RelativeScale > 0.0) {
			Container.RelativePosition.X += (PosnDistanceX / 20);
			Container.RelativePosition.Y += (PosnDistanceY / 20);
			Container.RelativeScale -= 0.05;
			yield;
		}
		Container.Unload();

//		// Disable catching ESC key
//		EnableMenuNavigationInputs = False;
	}
}
Void Minimize (Text ChildId) {
	declare CMlControl Container <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	declare Real EndPosnX = -102.0;
	declare Real EndPosnY = 57.28125;
	declare Real PosnDistanceX = (EndPosnX - Container.RelativePosition.X);
	declare Real PosnDistanceY = (EndPosnY - Container.RelativePosition.Y);

	while (Container.RelativeScale > 0.2) {
		Container.RelativePosition.X += (PosnDistanceX / 16);
		Container.RelativePosition.Y += (PosnDistanceY / 16);
		Container.RelativeScale -= 0.05;
		yield;
	}
}
Void Maximize (Text ChildId) {
	declare CMlControl Container <=> (Page.GetFirstChild(ChildId) as CMlFrame);
	declare Real EndPosnX = -102.0;
	declare Real EndPosnY = 57.28125;
	declare Real PosnDistanceX = (EndPosnX - Container.RelativePosition.X);
	declare Real PosnDistanceY = (EndPosnY - Container.RelativePosition.Y);

	while (Container.RelativeScale < 1.0) {
		Container.RelativePosition.X += (PosnDistanceX / 16);
		Container.RelativePosition.Y += (PosnDistanceY / 16);
		Container.RelativeScale += 0.05;
		yield;
	}
}
main () {
	declare Boolean RecordsEyepieceSubWindowVisible for UI = True;
	declare CMlControl Container <=> (Page.GetFirstChild("Window") as CMlFrame);
	declare CMlQuad Quad;
	declare Boolean MoveWindow = False;
	declare Boolean IsMinimized = False;
	declare Real MouseDistanceX = 0.0;
	declare Real MouseDistanceY = 0.0;

//	// Enable catching ESC key
//	EnableMenuNavigationInputs = True;

	while (True) {
		yield;
		if (MoveWindow == True) {
			Container.RelativePosition.X = (MouseDistanceX + MouseX);
			Container.RelativePosition.Y = (MouseDistanceY + MouseY);
		}
		if (MouseLeftButton == True) {
			foreach (Event in PendingEvents) {
				if (Event.ControlId == "WindowTitle") {
					MouseDistanceX = (Container.RelativePosition.X - MouseX);
					MouseDistanceY = (Container.RelativePosition.Y - MouseY);
					MoveWindow = True;
				}
			}
		}
		else {
			MoveWindow = False;
		}
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseClick : {
					if (Event.ControlId == "WindowClose") {
						RecordsEyepieceSubWindowVisible = False;
						WipeOut("Window");
						HideFrame("Lightbox");
					}
					else if (Event.ControlId == "WindowMinimize" && IsMinimized == False) {
						Minimize("Window");
						IsMinimized = True;
					}
					else if (Event.ControlId == "WindowBody" && IsMinimized == True) {
						Maximize("Window");
						IsMinimized = False;
					}
				}
//				case CMlEvent::Type::KeyPress : {
//					if (Event.KeyName == "Escape") {
//						WipeOut("RecordsEyepieceWindow");
//					}
//				}
			}
		}
	}
}
--></script>
EOL;
		// Footer
		$footer  = '</frame>';				// END: Window Frame
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['WINDOW']['HEADER'] = $header;
		$this->templates['WINDOW']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: Window							//
		//--------------------------------------------------------------//




		//--------------------------------------------------------------//
		// BEGIN: SubWindow						//
		//--------------------------------------------------------------//
		// %icon_style%, %icon_substyle%
		// %window_title%
		// %prev_next_buttons%
		$header  = '<manialink id="SubWindow" name="SubWindow" version="2">';
		$header .= '<stylesheet>';
		$header .= '<style class="labels" textsize="1" scale="1" textcolor="FFFF"/>';
		$header .= '</stylesheet>';
		$header .= '<frame posn="-49.5 30 21.5" id="RecordsEyepieceSubWindow">';	// BEGIN: Window Frame
		$header .= '<quad posn="-0.5 0.375 0.01" sizen="99.25 52.21875" style="'. $this->config['STYLE'][0]['WINDOW'][0]['BACKGROUND_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WINDOW'][0]['BACKGROUND_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="4.5 -7.68749 0.02" sizen="89 33.28125" bgcolor="'. $this->config['STYLE'][0]['WINDOW'][0]['CONTENT_BGCOLOR'][0] .'"/>';

		// Header Line
		$header .= '<quad posn="-1.5 1.125 0.02" sizen="101.25 11.25" style="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_SUBSTYLE'][0] .'"/>';
		$header .= '<quad posn="-1.5 1.125 0.03" sizen="101.25 11.25" style="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_STYLE'][0] .'" substyle="'. $this->config['STYLE'][0]['WINDOW'][0]['TITLE_SUBSTYLE'][0] .'"/>';

		// Title
		$header .= '<quad posn="2.5 -1.7 0.04" sizen="5.5 5.5" style="%icon_style%" substyle="%icon_substyle%"/>';
		$header .= '<label posn="9.75 -3.1 0.04" sizen="92.5 5" class="labels" textsize="2" scale="0.9" textcolor="'. $this->config['STYLE'][0]['WINDOW'][0]['HEADLINE_TEXTCOLOR'][0] .'" text="%window_title%"/>';

		// Close Button
		$header .= '<frame posn="88.5 -0.28125 0.05">';
		$header .= '<quad posn="0 0 0.01" sizen="8.44 8.44" style="Icons64x64_1" substyle="ArrowUp" id="RecordsEyepieceSubWindowClose" ScriptEvents="1"/>';
		$header .= '<quad posn="2.25 -2.4 0.02" sizen="3.75 3.75" bgcolor="EEEF"/>';
		$header .= '<quad posn="1.25 -1.3125 0.03" sizen="5.82 5.82" style="Icons64x64_1" substyle="Close"/>';
		$header .= '</frame>';

		$header .= '%prev_next_buttons%';

$maniascript = <<<EOL
<script><!--
 /*
 * ----------------------------------
 * Function:	SubWindow @ plugin.records_eyepiece.php
 * Author:	undef.de
 * Website:	http://www.undef.name
 * License:	GPLv3
 * ----------------------------------
 */
main () {
	declare Boolean RecordsEyepieceSubWindowVisible for UI = True;
	declare CMlControl Container <=> (Page.GetFirstChild("RecordsEyepieceSubWindow") as CMlFrame);
	RecordsEyepieceSubWindowVisible = True;

	while (True) {
		yield;
		foreach (Event in PendingEvents) {
			switch (Event.Type) {
				case CMlEvent::Type::MouseClick : {
					if (Event.ControlId == "RecordsEyepieceSubWindowClose") {
						RecordsEyepieceSubWindowVisible = False;
					}
				}
			}
		}
		if (RecordsEyepieceSubWindowVisible == False) {
			Container.Hide();
		}
	}
}
--></script>
EOL;

		// Footer
		$footer  = '</frame>';				// END: Window Frame
		$footer .= $maniascript;
		$footer .= '</manialink>';

		$this->templates['SUBWINDOW']['HEADER'] = $header;
		$this->templates['SUBWINDOW']['FOOTER'] = $footer;

		unset($header, $footer);
		//--------------------------------------------------------------//
		// END: SubWindow							//
		//--------------------------------------------------------------//
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function checkServerLoad () {
		global $aseco;

		if ( ($this->config['NICEMODE'][0]['ENABLED'][0] == true) && ($this->config['NICEMODE'][0]['FORCE'][0] == false) ) {

			// Get Playercount
			$player_count = count($aseco->server->players->player_list);

			// Check Playercount and if to high, switch to nicemode
			if ( ($this->config['States']['NiceMode'] == false) && ($player_count >= $this->config['NICEMODE'][0]['LIMITS'][0]['UPPER_LIMIT'][0]) ) {

				// Turn nicemode on
				$this->config['States']['NiceMode'] = true;

				// Make sure the Widgets are refreshed without the Player highlites
				$this->config['States']['DedimaniaRecords']['NeedUpdate']	= true;
				$this->config['States']['LocalRecords']['NeedUpdate']		= true;

				// Set new refresh interval
				$this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] = $this->config['NICEMODE'][0]['REFRESH_INTERVAL'][0];
			}
			else if ( ($this->config['States']['NiceMode'] == true) && ($player_count <= $this->config['NICEMODE'][0]['LIMITS'][0]['LOWER_LIMIT'][0]) ) {

				// Turn nicemode off
				$this->config['States']['NiceMode'] = false;

				// Restore default refresh interval
				$this->config['FEATURES'][0]['REFRESH_INTERVAL'][0] = $this->config['REFRESH_INTERVAL_DEFAULT'][0];
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function formatNumber ($num, $dec) {

		if ( ($this->config['FEATURES'][0]['SHORTEN_NUMBERS'][0] == true) && ($num > 1000) ) {
			return intval($num / 1000) .'k';
		}
		else {
			return number_format($num, $dec, $this->config['NumberFormat'][$this->config['FEATURES'][0]['NUMBER_FORMAT'][0]]['decimal_sep'], $this->config['NumberFormat'][$this->config['FEATURES'][0]['NUMBER_FORMAT'][0]]['thousands_sep']);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMapImageUrl ($uid) {
		global $aseco;

		foreach ($aseco->server->maps->map_list as $map) {
			if ($map->uid == $uid) {
				if ($this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ENABLED'][0] == true && $map->mx === false) {
					if (!is_file($aseco->settings['mapimages_path']. $map->uid .'.jpg')) {
						$aseco->console('[RecordsEyepiece] Map Image file "'. $aseco->settings['mapimages_path']. $map->uid .'.jpg' .'" does not exists!');
					}
					else {
						return $this->config['FEATURES'][0]['MAPLIST'][0]['MAPIMAGES'][0]['ACCESS_URL'][0] . $map->uid .'.jpg';
					}
				}
				else if ($map->mx !== false && !empty($map->mx->imageurl)) {
					return $map->mx->imageurl;
				}
				else {
					return $this->config['IMAGES'][0]['NO_SCREENSHOT'][0];
				}
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getCurrentRanking ($limit, $start) {
		global $aseco;

		return $aseco->server->rankings->getRange($start, $limit);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function getMaplist ($mapfile = false) {
		global $aseco;

		// Init environment/mood counter
		$this->cache['MaplistCounts']['Environment'] = array(
			'CANYON'	=> 0,
			'STADIUM'	=> 0,
			'VALLEY'	=> 0,
		);
		$this->cache['MaplistCounts']['Mood'] = array(
			'SUNRISE'	=> 0,
			'DAY'		=> 0,
			'SUNSET'	=> 0,
			'NIGHT'		=> 0
		);

		// Clean up before filling
		$this->cache['MapAuthors'] = array();

		foreach ($aseco->server->maps->map_list as $mapob) {
			// Add the MapAuthor to the list
			$this->cache['MapAuthors'][] = $mapob->author;

			// Setup the Cache for the AuthorNation
			if (isset($mapob->author_nation) && $mapob->author_nation != 'OTH') {
				$this->cache['MapAuthorNation'][$mapob->author] = $mapob->author_nation;
			}

			// Count this environment for Maplistfilter
			$this->cache['MaplistCounts']['Environment'][strtoupper($mapob->environment)] ++;

			// Count this mood for Maplistfilter
			$this->cache['MaplistCounts']['Mood'][strtoupper($mapob->mood)] ++;
		}

		// Load the Karma for all Maps
		$this->calculateMapKarma();

		if (count($this->cache['MapAuthors']) > 0) {
			// Make the MapAuthors list unique and sort them
			$this->cache['MapAuthors'] = array_unique($this->cache['MapAuthors']);
			natcasesort($this->cache['MapAuthors']);
			$this->cache['MapAuthors'] = array_values($this->cache['MapAuthors']);
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function calculateMapKarma () {
		global $aseco;

		$data = array();
		if ($this->config['FEATURES'][0]['KARMA'][0]['CALCULATION_METHOD'][0] == 'tmkarma') {
			$votings = array();
			$values = array(
				'Fantastic'	=> 3,
				'Beautiful'	=> 2,
				'Good'		=> 1,
				'Bad'		=> -1,
				'Poor'		=> -2,
				'Waste'		=> -3,
			);

			// Count all votings for each Map
			foreach ($values as $name => $vote) {
				$query = "
				SELECT
					`m`.`MapId`,
					COUNT(`Score`) AS `Count`
				FROM `%prefix%maps` AS `m`
				LEFT JOIN `%prefix%ratings` AS `k` ON `m`.`MapId` = `k`.`MapId`
				WHERE `k`.`Score` = ". $vote ."
				GROUP BY `m`.`MapId`;
				";

				$res = $aseco->db->query($query);
				if ($res) {
					if ($res->num_rows > 0) {
						while ($row = $res->fetch_object()) {
							$votings[$row->MapId][$name] = $row->Count;
						}
					}
					$res->free_result();
				}
			}
			unset( $vote);


			// Make sure all Maps has set all possible "votes"
			foreach ($votings as $id => $unused) {
				foreach ($values as $name => $vote) {
					if ( !isset($votings[$id][$name]) ) {
						$votings[$id][$name] = 0;
					}
				}
			}
			unset($values, $vote, $id, $unused);


			foreach ($votings as $MapId => $unused) {
				$totalvotes = (
					$votings[$MapId]['Fantastic'] +
					$votings[$MapId]['Beautiful'] +
					$votings[$MapId]['Good'] +
					$votings[$MapId]['Bad'] +
					$votings[$MapId]['Poor'] +
					$votings[$MapId]['Waste']
				);

				// Prevention of "illegal division by zero"
				if ($totalvotes == 0) {
					$totalvotes = 0.0000000000001;
				}

				$good_votes = (
					($votings[$MapId]['Fantastic'] * 100) +
					($votings[$MapId]['Beautiful'] * 80) +
					($votings[$MapId]['Good'] * 60)
				);
				$bad_votes = (
					($votings[$MapId]['Bad'] * 40) +
					($votings[$MapId]['Poor'] * 20) +
					($votings[$MapId]['Waste'] * 0)
				);

				// Store on MapId the Karma and Totalvotes
				$data[$MapId] = array(
					'karma'		=> floor( ($good_votes + $bad_votes) / $totalvotes),
					'votes'		=> $totalvotes,
				);
			}
			unset($MapId, $unused);
		}
		else {
			// Calculate the local Karma like RASP/Karma
			$query = "
			SELECT
				`MapId`,
				SUM(`Score`) AS `Karma`,
				COUNT(`Score`) AS `Count`
			FROM `%prefix%ratings`
			GROUP BY `MapId`;
			";

			$res = $aseco->db->query($query);
			if ($res) {
				if ($res->num_rows > 0) {
					while ($row = $res->fetch_object()) {
						$data[$row->MapId]['karma'] = $row->Karma;
						$data[$row->MapId]['votes'] = $row->Count;
					}
				}
				$res->free_result();
			}
		}


		// Add Karma to Maplist
		foreach ($aseco->server->maps->map_list as &$map) {
			$map->karma		= (isset($data[$map->id]) ? $data[$map->id]['karma'] : 0);
			$map->karma_votes	= (isset($data[$map->id]) ? $data[$map->id]['votes'] : 0);
		}
		unset($data, $map);
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function loadPlayerNations () {
		global $aseco;

		$logins = array();
		$query = "
		SELECT
			`Login`,
			`Nation`
		FROM `%prefix%players`;
		";

		$res = $aseco->db->query($query);
		if ($res) {
			if ($res->num_rows > 0) {
				while ($row = $res->fetch_object()) {
					$logins[$row->Login] = $row->Nation;
				}
			}
			$res->free_result();
		}
		return $logins;
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function storePlayersRoundscore () {
		global $aseco;

		if ($aseco->server->rankings->count() > 0) {
			$query = "
			UPDATE `%prefix%players`
			SET `RoundPoints` = CASE `PlayerId`
			";

			// Add all Players with a Score
			$ranks = array();

			$i = 0;
			foreach ($aseco->server->rankings->ranking_list as $login => $data) {
				if ($data->score > 0) {
					$ranks[] = array(
						'pid'	=> $aseco->server->players->getPlayerIdByLogin($login),
						'score'	=> $data->score,
					);
				}
			}

			if (count($ranks) > 0) {
				// Sort by PlayerId
				$sort = array();
				foreach ($ranks as $key => $row) {
					$sort[$key] = $row['pid'];
				}
				array_multisort($sort, SORT_NUMERIC, SORT_ASC, $ranks);
				unset($sort);

				$playerids = array();
				foreach ($ranks as $key => $row) {
					$playerids[] = $row['pid'];
					$query .= "WHEN ". $row['pid'] ." THEN `RoundPoints` + ". $row['score'] .LF;
				}

				$query .= "
				END
				WHERE `PlayerId` IN (". implode(',', $playerids) .");
				";

				// Update only if one Player has a Score
				if (count($playerids) > 0) {
					$result = $aseco->db->query($query);
					if (!$result) {
						$aseco->console('[RecordsEyepiece] UPDATE `RoundPoints` failed: [for statement "'. str_replace("\t", '', $query) .'"]');
					}
				}
			}
		}
	}

	/*
	#///////////////////////////////////////////////////////////////////////#
	#									#
	#///////////////////////////////////////////////////////////////////////#
	*/

	public function handleSpecialChars ($string) {
		global $aseco;

		// Remove links, e.g. "$(L|H|P)[...]...$(L|H|P)"
		$string = preg_replace('/\${1}(L|H|P)\[.*?\](.*?)\$(L|H|P)/i', '$2', $string);
		$string = preg_replace('/\${1}(L|H|P)\[.*?\](.*?)/i', '$2', $string);
		$string = preg_replace('/\${1}(L|H|P)(.*?)/i', '$2', $string);

		// Remove $S (shadow)
		// Remove $H (manialink)
		// Remove $W (wide)
		// Remove $I (italic)
		// Remove $L (link)
		// Remove $O (bold)
		// Remove $N (narrow)
		$string = preg_replace('/\${1}[SHWILON]/i', '', $string);


		if ($this->config['FEATURES'][0]['ILLUMINATE_NAMES'][0] == true) {
			// Replace too dark colors with lighter ones
			$string = preg_replace('/\${1}(000|111|222|333|444|555)/i', '\$AAA', $string);
		}


		// Convert &
		// Convert "
		// Convert '
		// Convert >
		// Convert <
		$string = str_replace(
				array(
					'&',
					'"',
					"'",
					'>',
					'<'
				),
				array(
					'&amp;',
					'&quot;',
					'&apos;',
					'&gt;',
					'&lt;'
				),
				$string
		);
		$string = $aseco->stripNewlines($string);

		return $aseco->validateUTF8String($string);
	}
}

?>