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
    );
}
?>
