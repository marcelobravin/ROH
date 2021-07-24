<?php
function getStage ($number)
{
    $array = getStages();
    return $array[$number-1];
}

function getSessionStage ()
{
    $stageNumber = $_SESSION['stageNumber'];
    $stage = getStage( $stageNumber );
    return $stage;
}
/*pode ser boss */
function setSessionStage ($number)
{
    $_SESSION['stageNumber'] = $number;
}

function getBossStage ($fileName)
{
    $array = getStages();
    return $array[$fileName];
}

/*
    Stages matrix
*/
function getStages ()
{
    return array(
        array(
            'number'         => 1
            , 'scene'        => 'house'
            , 'sky'          => 'Night_Starry.png'
            , 'bgm'          => 'My-Fat-Cat.mp3'
            , 'instructions' => 'basicMecanics'
            , 'resources'    => "
                \$\$this.load.image('cover'     , 'assets/images/icons/decorations/tree-round.png'),
            "
            , 'bgY'       => 14
        )
        , array(
            'number'         => 2
            , 'scene'        => 'convenience-store'
            , 'sky'          => 'Dawn_StarryVariant.png'
            , 'bgm'          => 'BoxCat_Games_-_10_-_Epic_Song.mp3'
            , 'instructions' => 'intermediateMecanics'
            , 'resources'    => "
                \$\$this.load.image('push'      , 'assets/images/icons/shopping-cart.png'),
            "
        )
        , array(
            'number'         => 3
            , 'scene'        => 'castle'
            , 'sky'          => 'Sunny.png'
            , 'bgm'          => '25+Norwegian+Folk+Songs+and+Dances,+Op.+17+-+23.+Have+You+By+Chances+Seen+My+Wife+-+Saag+Du+Nokke+Kjaerringa+Mi+(For+Recorder+Ensemble+-+Papalin).mp3'
            , 'instructions' => 'traps'
            , 'resources'    => "
                \$\$this.load.audio('flame'     , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3'),

                \$\$this.load.image('swords'    , 'assets/images/icons/swords.png'),
                \$\$this.load.image('cover'     , 'assets/images/icons/decorations/corn.png'),
                \$\$this.load.image('sun'       , 'assets/images/particles/sun.png'),
            "
        )
        , array(
            'number'         => 4
            , 'scene'        => 'japanese-gate'
            , 'sky'          => 'haze.png'
            , 'bgm'          => 'Serenity-Before-Fuji.mp3'
            , 'instructions' => 'gifts'
            , 'resources'    => "
                \$\$this.load.audio('flame'     , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3'),

                \$\$this.load.image('fire'      , 'assets/images/icons/fire-blue.png'),
                \$\$this.load.image('whirlwind' , 'assets/images/icons/whirlwind.png'),
            "
        )
        , array(
            'number'         => 5
            , 'scene'        => 'taco'
            , 'sky'          => 'Dusk_Creepy.png'
            , 'bgm'          => 'Bumbling-Burglars_Looping.mp3'
            , 'instructions' => 'peppers'
            , 'resources'    => "
                \$\$this.load.image('cactus'    , 'assets/images/icons/cactus.png'),
            "
        )
        , array(
            'number'         => 6
            , 'scene'        => 'construction-site'
            , 'sky'          => 'Stormy.png'
            , 'bgm'          => 'BoxCat_Games_-_09_-_eCommerce.mp3'
            , 'instructions' => 'elevators'
            , 'resources'    => "
                \$\$this.load.image('push'      , 'assets/images/icons/barrel.png'),
            "
        )
        , array(
            'number'         => 7
            , 'scene'        => 'mountain'
            , 'sky'          => 'skyfinal.png'
            , 'bgm'          => 'Fantasy_Game_Background_Looping.mp3'
            , 'instructions' => 'winds'
            , 'resources'    => "
                \$\$this.load.audio('wind'      , 'assets/audio/SE/windhowl-[AudioTrimmer.com].wav'),

                \$\$this.load.image('cover'     , 'assets/images/icons/decorations/tree-pointy.png'),
                \$\$this.load.image('falling'   , 'assets/images/icons/droplet.png'),
            "
        )
        , array(
            'number'         => 8
            , 'scene'        => 'ferris-wheel'
            , 'sky'          => 'Night_Romantic.png'
            , 'bgm'          => 'Here-Come-the-Weirds_v001.mp3'
            , 'instructions' => 'balloons'
            , 'resources'    => "
                \$\$this.load.image('balloon'   , 'assets/images/icons/balloon.png'),
            "
        )
        , array(
            'number'         => 9
            , 'scene'        => 'bank'
            , 'sky'          => 'Stormy-reverseY.png'
            , 'bgm'          => 'BoxCat_Games_-_01_-_Breaking_In.mp3'
            , 'instructions' => 'transit'
            , 'resources'    => "
                \$\$this.load.audio('honk'      , 'assets/audio/SE/Car_Honk_2.mp3'),
                \$\$this.load.audio('honkLong'  , 'assets/audio/SE/Car_Honk_Long_3.mp3'),

                \$\$this.load.image('car1'      , 'assets/images/icons/vehicles/ambulance.png'),
                \$\$this.load.image('car2'      , 'assets/images/icons/vehicles/bus.png'),
                \$\$this.load.image('car3'      , 'assets/images/icons/vehicles/car.png'),
                \$\$this.load.image('car4'      , 'assets/images/icons/vehicles/car2.png'),
                \$\$this.load.image('car5'      , 'assets/images/icons/vehicles/fire-truck.png'),
                \$\$this.load.image('car6'      , 'assets/images/icons/vehicles/microbus.png'),
                \$\$this.load.image('car7'      , 'assets/images/icons/vehicles/police-car.png'),
                \$\$this.load.image('car8'      , 'assets/images/icons/vehicles/rv.png'),
                \$\$this.load.image('car9'      , 'assets/images/icons/vehicles/taxi.png'),
                \$\$this.load.image('car10'     , 'assets/images/icons/vehicles/truck.png'),
            "
        )
        , array(
            'number'         => 10
            , 'scene'        => 'building'
            , 'sky'          => 'Night_Starry-recortado.png'
            , 'bgm'          => 'Blissful-Trance.mp3'
            , 'instructions' => 'airTransit'
            , 'resources'    => "
                \$\$this.load.audio('honk'      , 'assets/audio/SE/Car_Honk_2.mp3'),
                \$\$this.load.audio('honkLong'  , 'assets/audio/SE/Car_Honk_Long_3.mp3'),

                \$\$this.load.image('helicopter', 'assets/images/icons/vehicles/helicopter.png'),
                \$\$this.load.image('car1'      , 'assets/images/icons/vehicles/ambulance.png'),
                \$\$this.load.image('car2'      , 'assets/images/icons/vehicles/bus.png'),
                \$\$this.load.image('car3'      , 'assets/images/icons/vehicles/car.png'),
                \$\$this.load.image('car4'      , 'assets/images/icons/vehicles/car2.png'),
                \$\$this.load.image('car5'      , 'assets/images/icons/vehicles/fire-truck.png'),
                \$\$this.load.image('car6'      , 'assets/images/icons/vehicles/microbus.png'),
                \$\$this.load.image('car7'      , 'assets/images/icons/vehicles/police-car.png'),
                \$\$this.load.image('car8'      , 'assets/images/icons/vehicles/rv.png'),
                \$\$this.load.image('car9'      , 'assets/images/icons/vehicles/taxi.png'),
                \$\$this.load.image('car10'     , 'assets/images/icons/vehicles/truck.png'),
            "
            // , 'bgY'       => 20
        )
        , array(
            'number'         => 11
            , 'scene'        => 'derelict-house'
            , 'sky'          => 'Dusk_Apocalyptic.png'
            , 'bgm'          => '1975_newgrounds_jermai.mp3'
            , 'instructions' => 'holes'
            , 'resources'    => "
                \$\$this.load.audio('lightning' , 'assets/audio/SE/Damp Electric Shock 3.mp3'),
                \$\$this.load.audio('flame'     , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3'),

                \$\$this.load.image('falling'   , 'assets/images/icons/lightning.png'),
                \$\$this.load.image('fire'      , 'assets/images/icons/fire.png'),
                \$\$this.load.image('push'      , 'assets/images/icons/shopping-cart.png'),
            "
            , 'bgY'       => 14
        )
        , array(
            'number'         => 12
            , 'scene'        => 'clock-tower'
            , 'sky'          => 'Dawn_WithStars.png'
            , 'bgm'          => 'Enterin The Skies.mp3'
            , 'instructions' => 'lightnings'
            , 'resources'    => "
                \$\$this.load.audio('lightning' , 'assets/audio/SE/Damp Electric Shock 3.mp3'),

                \$\$this.load.image('falling'   , 'assets/images/icons/lightning.png'),
                \$\$this.load.image('push'      , 'assets/images/icons/trash-bin.png'),
                \$\$this.load.image('static'    , 'assets/images/icons/barrier.png'),
            "
        )
        , array(
            'number'         => 13
            , 'scene'        => 'arab'
            , 'sky'          => 'Night_Starry.png'
            , 'bgm'          => 'Mind Over Matter.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.audio('wind'      , 'assets/audio/SE/windhowl-[AudioTrimmer.com].wav'),

                \$\$this.load.image('cactus'    , 'assets/images/icons/cactus.png'),
                \$\$this.load.image('cover'     , 'assets/images/icons/decorations/palm-tree.png'),
                \$\$this.load.image('moon'      , 'assets/images/icons/full-moon.png');
                \$\$this.load.image('moon-new'  , 'assets/images/icons/new-moon.png');
            "
        )
        , array(
            'number'         => 14
            , 'scene'        => 'japanese-castle'
            , 'sky'          => 'Dusk_Apocalyptic.png'
            , 'bgm'          => 'BoxCat_Games_-_05_-_Battle_Boss.mp3'
            , 'instructions' => 'whirlwinds'
            , 'resources'    => "
                \$\$this.load.image('whirlwind' , 'assets/images/icons/whirlwind.png'),
                \$\$this.load.image('fire'      , 'assets/images/icons/fire.png'),
            "
            , 'bgY'       => 16
        )
        , array(
            'number'         => 15
            , 'scene'        => 'neon'
            , 'sky'          => 'Starfield.png'
            , 'bgm'          => 'Etude+Op.+25+no.+9+in+G+flat+major+-+Butterfly.mp3'
            , 'instructions' => 'neons'
            , 'resources'    => "
                \$\$this.load.audio('lightning' , 'assets/audio/SE/Damp Electric Shock 3.mp3'),

                \$\$this.load.image('lightning' , 'assets/images/icons/lightning.png'),
                \$\$this.load.image('push'      , 'assets/images/icons/box-wood.png'),
                \$\$this.load.image('static'    , 'assets/images/icons/box-metal.png'),
            "
        )
        , array(
            'number'         => 16
            , 'scene'        => 'eiffel'
            , 'sky'          => 'Starfield.png'
            , 'bgm'          => 'prepare_your_swords.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
            "
            , 'bgY'       => 16
        )
        , array(
            'number'         => 17
            , 'scene'        => 'mountain-snowy'
            , 'sky'          => 'horror.png'
            , 'bgm'          => 'RPG-Battle-Climax.mp3'
            , 'instructions' => 'blizzards'
            , 'resources'    => "
                \$\$this.load.audio('freeze'       , 'assets/audio/SE/ICE Thin Smashed Brittle Fragments 05.mp3'),
                \$\$this.load.audio('wind'         , 'assets/audio/SE/windhowl-[AudioTrimmer.com].wav'),

                \$\$this.load.image('hoppingStuff' , 'assets/images/icons/snow-flake.png'),
                \$\$this.load.image('cover'        , 'assets/images/icons/decorations/tree-pointy.png'),
            "
        )
        , array(
            'number'         => 18
            , 'scene'        => 'circus'
            , 'sky'          => 'harrier-bg.png'
            , 'bgm'          => 'Action-Rhythm-1.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.image('balloon'      , 'assets/images/icons/balloon.png'),
            "
            , 'bgY'       => 14
        )
        , array(
            'number'         => 19
            , 'scene'        => 'vulcano'
            , 'sky'          => 'sunset.png'
            , 'bgm'          => 'BoxCat_Games_-_25_-_Victory.mp3'
            , 'instructions' => 'tremors'
            , 'resources'    => "
                \$\$this.load.audio('flame'        , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3'),
                // \$\$this.load.audio('tremor'       , 'assets/audio/SE/equake6.wav'),
                \$\$this.load.audio('tremor'       , 'assets/audio/SE/QUAKE+3-[AudioTrimmer.com].mp3'),

                \$\$this.load.image('falling'      , 'assets/images/icons/fire2.png'),
                \$\$this.load.image('fire'         , 'assets/images/icons/fire.png'),
            "
        )
        , array(
            'number'         => 20
            , 'scene'        => 'hospital'
            , 'sky'          => 'zpos.png'
            , 'bgm'          => 'feeding frenzy.ogg'
            , 'instructions' => 'bacterias'
            , 'resources'    => "
                \$\$this.load.audio('honk'         , 'assets/audio/SE/Car_Honk_2.mp3'),
                \$\$this.load.audio('honkLong'     , 'assets/audio/SE/Car_Honk_Long_3.mp3'),

                \$\$this.load.image('helicopter'   , 'assets/images/icons/vehicles/helicopter.png'),
                \$\$this.load.image('car1'         , 'assets/images/icons/vehicles/ambulance.png'),
                \$\$this.load.image('car2'         , 'assets/images/icons/vehicles/bus.png'),
                \$\$this.load.image('car3'         , 'assets/images/icons/vehicles/car.png'),
                \$\$this.load.image('car4'         , 'assets/images/icons/vehicles/car2.png'),
                \$\$this.load.image('car5'         , 'assets/images/icons/vehicles/fire-truck.png'),
                \$\$this.load.image('car6'         , 'assets/images/icons/vehicles/microbus.png'),
                \$\$this.load.image('car7'         , 'assets/images/icons/vehicles/police-car.png'),
                \$\$this.load.image('car8'         , 'assets/images/icons/vehicles/rv.png'),
                \$\$this.load.image('car9'         , 'assets/images/icons/vehicles/taxi.png'),
                \$\$this.load.image('car10'        , 'assets/images/icons/vehicles/truck.png'),
                \$\$this.load.image('hoppingStuff' , 'assets/images/icons/bacteria.png'),
            "
        )
        , array(
            'number'         => 26
            , 'scene'        => 'hindu'
            , 'sky'          => 'zpos.png'
            , 'bgm'          => 'feeding frenzy.ogg'
            , 'instructions' => 'none'
            , 'resources'    => "
            "
        )

        # ---------------------------------------------------------------------- bosses

        , 'boss-1' => array(
            'number'         => 5
            , 'bossNumber'   => 1
            , 'scene'        => 'hindu'
            , 'sky'          => 'Dusk_Creepy-recortado.png'
            , 'bgm'          => 'Realm Of Hades.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.audio('noMercy'     , 'assets/audio/SE/boss/No_mercy-Hipis-1227409429.wav');
                \$\$this.load.audio('bossHit'     , 'assets/audio/SE/boss/monster-breathe-223-sound-effect-71151734.mp3');
                \$\$this.load.audio('bossBreak'   , 'assets/audio/SE/boss/scream-huge-monster-02-sound-effect-29144288.mp3');
                \$\$this.load.audio('aleluia'     , 'assets/audio/SE/voices/voice-clip-male-334-sound-effect-96444703.mp3');

                \$\$this.load.audio('freeze'      , 'assets/audio/SE/ICE Thin Smashed Brittle Fragments 05.mp3'),

                \$\$this.load.image('fire'        , 'assets/images/icons/fire.png');
                \$\$this.load.image('hoppingStuff','assets/images/icons/snow-flake.png'),

                \$\$this.load.spritesheet('enemy' , 'assets/images/sprites/monster-sprite-png-1.png', {
                    frameWidth : 192,
                    frameHeight: 192
                });
            "
            , 'bgY'       => 8
        )

        , 'boss-2' => array(
            'number'         => 10
            , 'bossNumber'   => 2
            , 'scene'        => 'church'
            , 'sky'          => 'Dawn_WithStars - Copia.png'
            , 'bgm'          => 'battleThemeA.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.audio('noMercy'    , 'assets/audio/SE/boss/167890__erdie__monster.wav');
                \$\$this.load.audio('bossHit'    , 'assets/audio/SE/boss/monster-breathe-223-sound-effect-71151734.mp3');
                \$\$this.load.audio('bossBreak'  , 'assets/audio/SE/boss/scream-huge-monster-02-sound-effect-29144288.mp3');
                \$\$this.load.audio('aleluia'    , 'assets/audio/SE/voices/voice-clip-male-334-sound-effect-96444703.mp3');

                \$\$this.load.audio('flame'      , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3');

                \$\$this.load.image('fire'       , 'assets/images/icons/fire.png');

                \$\$this.load.spritesheet('enemy', 'assets/images/sprites/monster-sprite-png-2.png', {
                    frameWidth : 192,
                    frameHeight: 192
                });
            "
            , 'bgY'       => 16
        )

        , 'boss-3' => array(
            'number'         => 15
            , 'bossNumber'   => 3
            , 'scene'        => 'temple'
            , 'sky'          => 'starfield.jpg'
            , 'bgm'          => 'BoxCat_Games_-_20_-_Battle_Normal.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.audio('noMercy'    , 'assets/audio/SE/boss/scream-huge-monster-01-sound-effect-93972779.mp3');
                \$\$this.load.audio('bossHit'    , 'assets/audio/SE/boss/monster-breathe-223-sound-effect-71151734.mp3');
                \$\$this.load.audio('bossBreak'  , 'assets/audio/SE/boss/scream-huge-monster-02-sound-effect-29144288.mp3');
                \$\$this.load.audio('aleluia'    , 'assets/audio/SE/voices/voice-clip-male-334-sound-effect-96444703.mp3');

                \$\$this.load.audio('lightning'  , 'assets/audio/SE/Damp Electric Shock 3.mp3');
                \$\$this.load.audio('flame'      , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3');

                \$\$this.load.image('fire'       , 'assets/images/icons/fire.png');
                \$\$this.load.image('falling'    , 'assets/images/icons/lightning.png');

                \$\$this.load.spritesheet('enemy', 'assets/images/sprites/monster-sprite-png-3.png', {
                    frameWidth : 192,
                    frameHeight: 192
                });
            "
            , 'bgY'       => 16
        )

        , 'boss-4' => array(
            'number'         => 20
            , 'bossNumber'   => 4
            , 'sky'          => 'Dusk_Apocalyptic.png'
            , 'scene'        => 'synagogue'
            , 'bgm'          => 'Dark Descent.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.audio('noMercy'    , 'assets/audio/SE/boss/scream-huge-monster-09-sound-effect-80786133.mp3');
                \$\$this.load.audio('bossHit'    , 'assets/audio/SE/boss/monster-breathe-223-sound-effect-71151734.mp3');
                \$\$this.load.audio('bossBreak'  , 'assets/audio/SE/boss/scream-huge-monster-02-sound-effect-29144288.mp3');
                \$\$this.load.audio('aleluia'    , 'assets/audio/SE/voices/voice-clip-male-334-sound-effect-96444703.mp3');

                \$\$this.load.audio('lightning'  , 'assets/audio/SE/Damp Electric Shock 3.mp3');
                \$\$this.load.audio('flame'      , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3');

                \$\$this.load.image('fire'       , 'assets/images/icons/fire.png');
                \$\$this.load.image('falling'    , 'assets/images/icons/fire2.png'),

                \$\$this.load.spritesheet('enemy', 'assets/images/sprites/monster-sprite-png-4.png', {
                    frameWidth : 192,
                    frameHeight: 192
                });
            "
            , 'bgY'       => 16
        )

        , 'boss-5' => array(
            'number'         => 25
            , 'bossNumber'   => 5
            , 'sky'          => 'space3.png'
            , 'scene'        => 'synagogue'
            , 'bgm'          => 'Dark Descent.mp3'
            , 'instructions' => 'none'
            , 'resources'    => "
                \$\$this.load.audio('noMercy'    , 'assets/audio/SE/boss/scream-huge-monster-09-sound-effect-80786133.mp3');
                \$\$this.load.audio('bossHit'    , 'assets/audio/SE/boss/monster-breathe-223-sound-effect-71151734.mp3');
                \$\$this.load.audio('bossBreak'  , 'assets/audio/SE/boss/scream-huge-monster-02-sound-effect-29144288.mp3');
                \$\$this.load.audio('aleluia'    , 'assets/audio/SE/voices/voice-clip-male-334-sound-effect-96444703.mp3');

                \$\$this.load.audio('lightning'  , 'assets/audio/SE/Damp Electric Shock 3.mp3');
                \$\$this.load.audio('flame'      , 'assets/audio/SE/Fire-Torch-Whoosh-Med 2.mp3');

                \$\$this.load.image('fire'       , 'assets/images/icons/fire.png');
                \$\$this.load.image('falling'    , 'assets/images/icons/fire2.png'),

                \$\$this.load.spritesheet('enemy', 'assets/images/sprites/hero.png', {
                    frameWidth : 32,
                    frameHeight: 48
                });
            "
            , 'bgY'       => 16
        )
    );
}
?>