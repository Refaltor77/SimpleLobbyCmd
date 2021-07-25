<?php

namespace refaltor\SimpleLobbyCmd;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    public function onEnable()
    {
        $this->saveResource('config.yml');
        $array = $this->getConfig()->get('commands');
        $command = $this->getServer()->getCommandMap();
        foreach ($array as $name => $keys){
            $command->register('SimpleLobbyCmd', new Commands($keys['x'], $keys['y'], $keys['z'], $keys['world'], $this, $name, $keys['description'], $keys['message']));
            $this->getServer()->getLogger()->info('§c'.$name.' loaded !');
        }
    }
}
