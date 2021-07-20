<?php

namespace refaltor\SimpleLobbyCmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;

class Commands extends Command
{
    public $x;
    public $y;
    public $z;
    public $level;
    public $plugin;
    public $message;

    public function __construct(int $x, int $y, int $z, string $level, Plugin $plugin, string $name, string $description = "", ?string $message = null, string $usageMessage = null, array $aliases = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->level = $level;
        $this->plugin = $plugin;
        $this->message = $message;

        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        $level = Server::getInstance()->getLevelByName($this->level);
        if (is_null($level)){
            $this->plugin->getServer()->getPluginManager()->disablePlugin($this->plugin);
        }
        $position = new Position($this->x, $this->y, $this->z, $level);
        $sender->teleport($position);
        if (!is_null($this->message)) $sender->sendMessage($this->message);
    }
}
